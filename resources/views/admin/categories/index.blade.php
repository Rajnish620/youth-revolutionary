@extends('layouts.admin')

@section('title', 'Categories - Admin Panel')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-tags text-[#F1400C]"></i>
                <span>Categories</span>
            </h1>
            <p class="text-xs text-gray-500 mt-1">Manage dynamic categories for competitions and events</p>
        </div>
        <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'create-category'}))" class="px-5 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 self-start sm:self-auto cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Category</span>
        </button>
    </div>

    <!-- Alert Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Categories Data Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">ID</th>
                        <th class="py-4 px-6">Name</th>
                        <th class="py-4 px-6">Created At</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-extrabold text-xs text-gray-500">
                                #{{ $category->id }}
                            </td>
                            <td class="py-4 px-6 font-extrabold text-sm text-gray-900">
                                {{ $category->name }}
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">
                                {{ $category->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-category-{{ $category->id }}'}))" 
                                       class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-[#340C6F] hover:text-white text-gray-600 flex items-center justify-center transition-all cursor-pointer" title="Edit Category">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>

                                    <!-- Edit Category Modal -->
                                    <x-modal name="edit-category-{{ $category->id }}" title="Edit Category" maxWidth="sm">
                                        @include('admin.modals.edit-category', ['category' => $category])
                                    </x-modal>

                                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-red-500 hover:text-white text-gray-500 flex items-center justify-center transition-all" title="Delete Category">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-400 text-sm">
                                No categories found. Click "Add Category" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

    <!-- Add Category Modal Component -->
    <x-modal name="create-category" title="Add Category" maxWidth="sm">
        @include('admin.modals.create-category')
    </x-modal>

</div>
@endsection
