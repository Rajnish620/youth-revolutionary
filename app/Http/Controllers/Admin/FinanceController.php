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
}
