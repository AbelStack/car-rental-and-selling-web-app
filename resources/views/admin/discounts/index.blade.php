@extends('layouts.app')

@section('title', 'Discount Management - Admin')

@section('content')
<div class="min-h-screen bg-soft-white py-8">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Discount Management</h1>
                    <p class="text-slate-600">Manage holiday and duration discounts for your rental and sales business</p>
                </div>
                <div class="mt-4 lg:mt-0 flex space-x-3">
                    <a href="{{ route('admin.discounts.analytics') }}" 
                       class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Analytics
                    </a>
                    <a href="{{ route('admin.discounts.create') }}" 
                       class="inline-flex items-center px-6 py-2 bg-neon-blue text-white rounded-xl hover:bg-blue-dark transition-all duration-200 shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Discount
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Total Discount Given</p>
                        <p class="text-2xl font-bold text-slate-900">${{ number_format($statistics['total_discount_amount'], 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Discounted Transactions</p>
                        <p class="text-2xl font-bold text-slate-900">{{ number_format($statistics['total_discounted_transactions']) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Average Discount</p>
                        <p class="text-2xl font-bold text-slate-900">{{ number_format($statistics['average_discount_percentage'], 1) }}%</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-slate-600">Active Discounts</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $discounts->where('is_active', true)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discounts Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">All Discounts</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Discount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Percentage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Applies To</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Period</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($discounts as $discount)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-slate-900">{{ $discount->name }}</div>
                                    @if($discount->description)
                                    <div class="text-sm text-slate-500">{{ Str::limit($discount->description, 50) }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $discount->type === 'holiday' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($discount->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">
                                {{ $discount->percentage }}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $discount->applies_to === 'both' ? 'bg-green-100 text-green-800' : 
                                       ($discount->applies_to === 'rental' ? 'bg-orange-100 text-orange-800' : 'bg-indigo-100 text-indigo-800') }}">
                                    {{ ucfirst($discount->applies_to) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                @if($discount->type === 'holiday')
                                    {{ $discount->start_date->format('M j') }} - {{ $discount->end_date->format('M j, Y') }}
                                @else
                                    Always Active
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.discounts.toggle-status', $discount) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-all duration-200
                                        {{ $discount->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                        <span class="w-2 h-2 rounded-full mr-2 {{ $discount->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                        {{ $discount->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.discounts.show', $discount) }}" 
                                       class="text-neon-blue hover:text-blue-dark transition-colors duration-200">
                                        View
                                    </a>
                                    <a href="{{ route('admin.discounts.edit', $discount) }}" 
                                       class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                                        Edit
                                    </a>
                                    @if(!$discount->bookings()->exists() && !$discount->purchases()->exists())
                                    <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this discount?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                            Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <h3 class="text-lg font-medium text-slate-900 mb-2">No discounts found</h3>
                                    <p class="text-slate-500 mb-4">Get started by creating your first discount.</p>
                                    <a href="{{ route('admin.discounts.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-neon-blue text-white rounded-lg hover:bg-blue-dark transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Create Discount
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Discount Preview Tool -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Discount Preview Tool</h3>
                <form id="preview-form" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Type</label>
                            <select name="type" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent">
                                <option value="rental">Rental</option>
                                <option value="selling">Selling</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Amount ($)</label>
                            <input type="number" name="amount" step="0.01" min="1" 
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                                   placeholder="100.00">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Start Date (Optional)</label>
                            <input type="date" name="start_date" 
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">End Date (Optional)</label>
                            <input type="date" name="end_date" 
                                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-neon-blue text-white py-2 px-4 rounded-lg hover:bg-blue-dark transition-all duration-200">
                        Preview Discount
                    </button>
                </form>
                <div id="preview-result" class="mt-4 hidden">
                    <!-- Preview results will be shown here -->
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Recent Activity</h3>
                <div class="space-y-3">
                    @php
                        $recentLogs = \App\Models\DiscountLog::with(['discount', 'user'])
                            ->latest()
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @forelse($recentLogs as $log)
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-900">{{ $log->description }}</p>
                            <p class="text-xs text-slate-500">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-slate-500">No recent activity</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('preview-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    fetch('{{ route("admin.discounts.preview") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        const resultDiv = document.getElementById('preview-result');
        
        if (result.has_discount) {
            resultDiv.innerHTML = `
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h4 class="font-medium text-green-900 mb-2">Discount Applied!</h4>
                    <div class="text-sm text-green-800 space-y-1">
                        <p><strong>Original Amount:</strong> $${result.original_amount}</p>
                        <p><strong>Discount:</strong> $${result.discount_amount} (${result.discount.percentage}%)</p>
                        <p><strong>Final Amount:</strong> $${result.final_amount}</p>
                        <p><strong>Reason:</strong> ${result.discount_reason}</p>
                    </div>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-medium text-yellow-900 mb-2">No Discount Available</h4>
                    <p class="text-sm text-yellow-800">No applicable discounts found for the given criteria.</p>
                </div>
            `;
        }
        
        resultDiv.classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
        const resultDiv = document.getElementById('preview-result');
        resultDiv.innerHTML = `
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <h4 class="font-medium text-red-900 mb-2">Error</h4>
                <p class="text-sm text-red-800">Failed to preview discount. Please try again.</p>
            </div>
        `;
        resultDiv.classList.remove('hidden');
    });
});
</script>
@endsection