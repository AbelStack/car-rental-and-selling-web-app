@extends('layouts.app')

@section('title', 'Discount Analytics - Admin')

@section('content')
<div class="min-h-screen bg-soft-white py-8">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.discounts.index') }}" 
                   class="inline-flex items-center text-slate-600 hover:text-neon-blue transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Discounts
                </a>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Discount Analytics</h1>
            <p class="text-slate-600">Comprehensive insights into discount performance and usage</p>
        </div>

        <!-- Date Range Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
            <form method="GET" action="{{ route('admin.discounts.analytics') }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Start Date</label>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" 
                           class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">End Date</label>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" 
                           class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent">
                </div>
                <button type="submit" class="bg-neon-blue text-white px-6 py-2 rounded-lg hover:bg-blue-dark transition-all duration-200">
                    Update Report
                </button>
            </form>
        </div>

        <!-- Key Metrics -->
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
                        <p class="text-sm font-medium text-slate-600">Revenue Impact</p>
                        <p class="text-2xl font-bold text-slate-900">${{ number_format($statistics['total_original_amount'], 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Monthly Trends Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Monthly Discount Trends</h2>
                <div class="space-y-4">
                    @foreach($monthlyTrends as $trend)
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                        <div>
                            <div class="font-medium text-slate-900">{{ $trend['month'] }}</div>
                            <div class="text-sm text-slate-500">{{ $trend['total_transactions'] }} transactions</div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-green-600">${{ number_format($trend['total_discount_amount'], 2) }}</div>
                            <div class="text-xs text-slate-500">discount given</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Performing Discounts -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Top Performing Discounts</h2>
                <div class="space-y-4">
                    @forelse($topDiscounts as $discount)
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-{{ $discount->type === 'holiday' ? 'purple' : 'blue' }}-500 to-{{ $discount->type === 'holiday' ? 'purple' : 'blue' }}-600 rounded-lg flex items-center justify-center">
                                @if($discount->type === 'holiday')
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-slate-900">{{ $discount->name }}</div>
                                <div class="text-sm text-slate-500">{{ $discount->percentage }}% discount</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-neon-blue">{{ $discount->bookings_count + $discount->purchases_count }}</div>
                            <div class="text-xs text-slate-500">uses</div>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-500 text-center py-8">No discount usage data available</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Detailed Breakdown -->
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Detailed Breakdown</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Rental vs Sales -->
                    <div>
                        <h3 class="text-md font-medium text-slate-900 mb-4">Discount Distribution</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    <span class="text-sm font-medium text-slate-900">Rental Bookings</span>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-blue-600">{{ $statistics['total_discounted_bookings'] }}</div>
                                    <div class="text-xs text-slate-500">transactions</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                    <span class="text-sm font-medium text-slate-900">Vehicle Purchases</span>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-orange-600">{{ $statistics['total_discounted_purchases'] }}</div>
                                    <div class="text-xs text-slate-500">transactions</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Impact -->
                    <div>
                        <h3 class="text-md font-medium text-slate-900 mb-4">Financial Impact</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                                <span class="text-sm text-slate-600">Original Revenue</span>
                                <span class="font-medium text-slate-900">${{ number_format($statistics['total_original_amount'], 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                <span class="text-sm text-slate-600">Total Discounts</span>
                                <span class="font-medium text-red-600">-${{ number_format($statistics['total_discount_amount'], 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg border-t-2 border-green-200">
                                <span class="text-sm font-medium text-slate-900">Final Revenue</span>
                                <span class="font-bold text-green-600">${{ number_format($statistics['total_final_amount'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Options -->
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Export Reports</h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.reports.export', 'discounts') }}?start_date={{ $startDate->format('Y-m-d') }}&end_date={{ $endDate->format('Y-m-d') }}" 
                   class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export CSV
                </a>
                
                <button onclick="window.print()" 
                        class="inline-flex items-center px-4 py-2 bg-neon-blue text-white rounded-lg hover:bg-blue-dark transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Report
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white !important;
    }
    
    .bg-white {
        box-shadow: none !important;
        border: 1px solid #e5e7eb !important;
    }
}
</style>
@endsection