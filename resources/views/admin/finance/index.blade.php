@extends('layouts.admin')

@section('title', 'Finance Management')

@section('content')
<div x-data="financeApp()" class="p-4 lg:p-8 flex-1 overflow-y-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Finance Management</h1>
            <p class="text-sm text-gray-500 mt-1">Track income, contributions, and expenses.</p>
        </div>
        
        <form action="{{ route('admin.finance.index') }}" method="GET" class="flex items-center gap-2">
            <select name="season" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-brand-purple focus:border-brand-purple block w-full p-2.5 shadow-sm">
                <option value="">All Seasons</option>
                @foreach($seasons as $season)
                    <option value="{{ $season }}" {{ $selectedSeason == $season ? 'selected' : '' }}>Season: {{ $season }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Student Income -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-center justify-between mb-4">
                <h3 class="text-gray-500 text-sm font-medium">Student Payments</h3>
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-2xl font-bold text-gray-900">₹{{ number_format($studentIncome, 2) }}</span>
            </div>
        </div>

        <!-- External Contributions -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-center justify-between mb-4">
                <h3 class="text-gray-500 text-sm font-medium">Contributions</h3>
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-2xl font-bold text-gray-900">₹{{ number_format($contributionsTotal, 2) }}</span>
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-center justify-between mb-4">
                <h3 class="text-gray-500 text-sm font-medium">Total Expenses</h3>
                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-trend-down"></i>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-2xl font-bold text-gray-900">₹{{ number_format($totalExpenses, 2) }}</span>
            </div>
        </div>

        <!-- Balance -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-center justify-between mb-4">
                <h3 class="text-gray-500 text-sm font-medium">Total Balance</h3>
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                    <i class="fa-solid fa-vault"></i>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-2xl font-bold text-gray-900">₹{{ number_format($balance, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Main Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Contributions Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-900">Contributions</h2>
                <button @click="openContributionModal()" class="bg-brand-purple hover:bg-brand-purple/90 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                    <i class="fa-solid fa-plus mr-1.5"></i> Add
                </button>
            </div>
            <div class="flex-1 overflow-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50/80 text-gray-700 text-xs uppercase font-semibold sticky top-0">
                        <tr>
                            <th class="px-5 py-3 border-b border-gray-100">Date</th>
                            <th class="px-5 py-3 border-b border-gray-100">Contributor</th>
                            <th class="px-5 py-3 border-b border-gray-100 text-right">Amount</th>
                            <th class="px-5 py-3 border-b border-gray-100 text-center w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($contributions as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3 whitespace-nowrap">{{ $item->date->format('d M Y') }}</td>
                            <td class="px-5 py-3 font-medium text-gray-900">
                                {{ $item->name }}
                                @if($item->description)
                                <div class="text-xs text-gray-400 font-normal mt-0.5 truncate max-w-[150px]" title="{{ $item->description }}">{{ $item->description }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right font-bold text-green-600">₹{{ number_format($item->amount, 2) }}</td>
                            <td class="px-5 py-3 text-center">
                                <button @click="openContributionModal({{ $item }})" class="text-blue-500 hover:text-blue-700 mr-2" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('admin.finance.contributions.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this contribution?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-gray-500">
                                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                    <i class="fa-solid fa-receipt text-xl"></i>
                                </div>
                                No contributions found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Expenses Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-900">Expenses</h2>
                <button @click="openExpenseModal()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                    <i class="fa-solid fa-plus mr-1.5"></i> Add
                </button>
            </div>
            <div class="flex-1 overflow-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50/80 text-gray-700 text-xs uppercase font-semibold sticky top-0">
                        <tr>
                            <th class="px-5 py-3 border-b border-gray-100">Date</th>
                            <th class="px-5 py-3 border-b border-gray-100">Item/Event</th>
                            <th class="px-5 py-3 border-b border-gray-100 text-right">Amount</th>
                            <th class="px-5 py-3 border-b border-gray-100 text-center w-24">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($expenses as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3 whitespace-nowrap">{{ $item->date->format('d M Y') }}</td>
                            <td class="px-5 py-3 font-medium text-gray-900">
                                {{ $item->item_name }}
                                @if($item->description)
                                <div class="text-xs text-gray-400 font-normal mt-0.5 truncate max-w-[150px]" title="{{ $item->description }}">{{ $item->description }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right font-bold text-red-500">₹{{ number_format($item->amount, 2) }}</td>
                            <td class="px-5 py-3 text-center">
                                <button @click="openExpenseModal({{ $item }})" class="text-blue-500 hover:text-blue-700 mr-2" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('admin.finance.expenses.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-gray-500">
                                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                    <i class="fa-solid fa-money-bill-wave text-xl"></i>
                                </div>
                                No expenses found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Contribution Modal -->
    <div x-show="showContributionModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showContributionModal" @click="showContributionModal = false" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm"></div>

            <div x-show="showContributionModal" class="relative inline-block w-full max-w-lg p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl sm:my-8" x-transition.scale.origin.bottom>
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                    <h3 class="text-xl font-bold text-gray-900" x-text="editingContribution ? 'Edit Contribution' : 'Add Contribution'"></h3>
                    <button @click="showContributionModal = false" class="text-gray-400 hover:text-gray-500 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form :action="editingContribution ? '{{ url('admin/finance/contributions') }}/' + contributionForm.id : '{{ route('admin.finance.contributions.store') }}'" method="POST">
                    @csrf
                    <template x-if="editingContribution">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Contributor Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" x-model="contributionForm.name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring-brand-purple text-sm p-2.5 border">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Amount (₹) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="amount" x-model="contributionForm.amount" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring-brand-purple text-sm p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Date <span class="text-red-500">*</span></label>
                                <input type="date" name="date" x-model="contributionForm.date" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring-brand-purple text-sm p-2.5 border">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Season</label>
                            <select name="season" x-model="contributionForm.season" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring-brand-purple text-sm p-2.5 border">
                                <option value="">Select Season (Optional)</option>
                                @foreach($seasons as $s)
                                    <option value="{{ $s }}">{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                            <textarea name="description" x-model="contributionForm.description" rows="2" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring-brand-purple text-sm p-2.5 border"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-50">
                        <button type="button" @click="showContributionModal = false" class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-brand-purple hover:bg-brand-purple/90 rounded-xl shadow-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Expense Modal -->
    <div x-show="showExpenseModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showExpenseModal" @click="showExpenseModal = false" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm"></div>

            <div x-show="showExpenseModal" class="relative inline-block w-full max-w-lg p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl sm:my-8" x-transition.scale.origin.bottom>
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                    <h3 class="text-xl font-bold text-gray-900" x-text="editingExpense ? 'Edit Expense' : 'Add Expense'"></h3>
                    <button @click="showExpenseModal = false" class="text-gray-400 hover:text-gray-500 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form :action="editingExpense ? '{{ url('admin/finance/expenses') }}/' + expenseForm.id : '{{ route('admin.finance.expenses.store') }}'" method="POST">
                    @csrf
                    <template x-if="editingExpense">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Item / Event Name <span class="text-red-500">*</span></label>
                            <input type="text" name="item_name" x-model="expenseForm.item_name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm p-2.5 border">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Amount (₹) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="amount" x-model="expenseForm.amount" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm p-2.5 border">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Date <span class="text-red-500">*</span></label>
                                <input type="date" name="date" x-model="expenseForm.date" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm p-2.5 border">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Season</label>
                            <select name="season" x-model="expenseForm.season" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm p-2.5 border">
                                <option value="">Select Season (Optional)</option>
                                @foreach($seasons as $s)
                                    <option value="{{ $s }}">{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Description / Details</label>
                            <textarea name="description" x-model="expenseForm.description" rows="2" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm p-2.5 border"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-50">
                        <button type="button" @click="showExpenseModal = false" class="px-5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-xl shadow-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function financeApp() {
    return {
        showContributionModal: false,
        editingContribution: false,
        contributionForm: { id: null, name: '', amount: '', date: new Date().toISOString().slice(0, 10), season: '{{ $selectedSeason ?? '' }}', description: '' },
        
        showExpenseModal: false,
        editingExpense: false,
        expenseForm: { id: null, item_name: '', amount: '', date: new Date().toISOString().slice(0, 10), season: '{{ $selectedSeason ?? '' }}', description: '' },
        
        openContributionModal(item = null) {
            if (item) {
                this.editingContribution = true;
                this.contributionForm = { 
                    id: item.id, 
                    name: item.name, 
                    amount: item.amount, 
                    date: item.date.split('T')[0], 
                    season: item.season || '', 
                    description: item.description || '' 
                };
            } else {
                this.editingContribution = false;
                this.contributionForm = { id: null, name: '', amount: '', date: new Date().toISOString().slice(0, 10), season: '{{ $selectedSeason ?? '' }}', description: '' };
            }
            this.showContributionModal = true;
        },

        openExpenseModal(item = null) {
            if (item) {
                this.editingExpense = true;
                this.expenseForm = { 
                    id: item.id, 
                    item_name: item.item_name, 
                    amount: item.amount, 
                    date: item.date.split('T')[0], 
                    season: item.season || '', 
                    description: item.description || '' 
                };
            } else {
                this.editingExpense = false;
                this.expenseForm = { id: null, item_name: '', amount: '', date: new Date().toISOString().slice(0, 10), season: '{{ $selectedSeason ?? '' }}', description: '' };
            }
            this.showExpenseModal = true;
        }
    }
}
</script>
@endsection
