<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\Expense;
use App\Models\EventRegistration;
use App\Models\Season;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $seasons = Season::oldest()->pluck('name', 'name')->toArray();
        $selectedSeason = $request->input('season');

        // Query builders
        $studentsQuery = EventRegistration::where('payment_status', 'approved');
        $contributionsQuery = Contribution::query();
        $expensesQuery = Expense::query();
        
        $events = \App\Models\Event::latest()->get();

        if ($selectedSeason) {
            $studentsQuery->whereHas('event', function ($q) use ($selectedSeason) {
                $q->where('season', $selectedSeason);
            });
            $contributionsQuery->where('season', $selectedSeason);
            $expensesQuery->where('season', $selectedSeason);
        }

        $studentIncome = $studentsQuery->sum('fee_paid');
        $contributionsTotal = $contributionsQuery->sum('amount');
        
        $totalIncome = $studentIncome + $contributionsTotal;
        $totalExpenses = $expensesQuery->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        $contributions = $contributionsQuery->latest('date')->get();
        $expenses = $expensesQuery->latest('date')->get();

        return view('admin.finance.index', compact(
            'seasons', 
            'events',
            'selectedSeason', 
            'studentIncome', 
            'contributionsTotal', 
            'totalIncome', 
            'totalExpenses', 
            'balance',
            'contributions',
            'expenses'
        ));
    }

    public function storeContribution(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'season' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Contribution::create($validated);
        return back()->with('success', 'Contribution added successfully.');
    }

    public function updateContribution(Request $request, Contribution $contribution)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'season' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $contribution->update($validated);
        return back()->with('success', 'Contribution updated successfully.');
    }

    public function destroyContribution(Contribution $contribution)
    {
        $contribution->delete();
        return back()->with('success', 'Contribution deleted successfully.');
    }

    public function storeExpense(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'season' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Expense::create($validated);
        return back()->with('success', 'Expense added successfully.');
    }

    public function updateExpense(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'season' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $expense->update($validated);
        return back()->with('success', 'Expense updated successfully.');
    }

    public function destroyExpense(Expense $expense)
    {
        $expense->delete();
        return back()->with('success', 'Expense deleted successfully.');
    }

    public function print(Request $request)
    {
        $type = $request->input('type', 'both'); // 'contributions', 'expenses', 'both'
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $season = $request->input('season');
        $eventId = $request->input('event_id');

        $contributions = collect();
        $expenses = collect();
        $studentIncome = 0;
        $eventName = null;

        if ($eventId) {
            $event = \App\Models\Event::find($eventId);
            if ($event) {
                $eventName = $event->title;
                // If event is selected, we override the season with the event's season just to be consistent, or just keep it
                if (!$season) {
                    $season = $event->season;
                }
            }
        }

        // Student Income (Registrations)
        if ($type === 'both' || $type === 'students') { // Although UI might only pass 'both'
            $studentsQuery = EventRegistration::where('payment_status', 'approved');
            if ($season) {
                $studentsQuery->whereHas('event', function ($q) use ($season) {
                    $q->where('season', $season);
                });
            }
            if ($eventId) {
                $studentsQuery->where('event_id', $eventId);
            }
            if ($startDate) {
                // Assuming students have created_at as their payment date or use updated_at
                $studentsQuery->whereDate('updated_at', '>=', $startDate);
            }
            if ($endDate) {
                $studentsQuery->whereDate('updated_at', '<=', $endDate);
            }
            $studentIncome = $studentsQuery->sum('fee_paid');
        }

        if ($type === 'contributions' || $type === 'both') {
            $cQuery = Contribution::query();
            if ($startDate) $cQuery->whereDate('date', '>=', $startDate);
            if ($endDate) $cQuery->whereDate('date', '<=', $endDate);
            if ($season) $cQuery->where('season', $season);
            $contributions = $cQuery->orderBy('date', 'asc')->get();
        }

        if ($type === 'expenses' || $type === 'both') {
            $eQuery = Expense::query();
            if ($startDate) $eQuery->whereDate('date', '>=', $startDate);
            if ($endDate) $eQuery->whereDate('date', '<=', $endDate);
            if ($season) $eQuery->where('season', $season);
            $expenses = $eQuery->orderBy('date', 'asc')->get();
        }

        return view('admin.finance.print', compact('type', 'startDate', 'endDate', 'season', 'eventId', 'eventName', 'studentIncome', 'contributions', 'expenses'));
    }
}
