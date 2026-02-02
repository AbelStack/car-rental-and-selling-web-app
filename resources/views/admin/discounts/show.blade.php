@extends('layouts.app')

@section('title', 'Discount Details - Admin')

@section('content')
<div class="min-h-screen bg-soft-white py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
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
            
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $discount->name }}</h1>
                    <div class="flex items-center space-x-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $discount->type === 'holiday' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($discount->type) }} Discount
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $discount->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="w-2 h-2 rounded-full mr-2 {{ $discount->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                            {{ $discount->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                
                <div class="mt-4 lg:mt-0 flex space-x-3">
                    <form action="{{ route('admin.discounts.toggle-status', $discount) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center px-4 py-2 
                            {{ $discount->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}
                            rounded-lg transition-all duration-200">
                            {{ $discount->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.discounts.edit', $discount) }}" 
                       class="inline-flex items-center px-4 py-2 bg-neon-blue text-white rounded-lg hover:bg-blue-dark transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Discount
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Discount Details -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Discount Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Discount Percentage</label>
                            <p class="text-2xl font-bold text-neon-blue">{{ $discount->percentage }}%</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Applies To</label>
                            <p class="text-lg font-medium text-slate-900">{{ ucfirst($discount->applies_to) }}</p>
                        </div>
                        
                        @if($discount->type === 'holiday')
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Start Date</label>
                            <p class="text-lg font-medium text-slate-900">{{ $discount->start_date->format('M j, Y') }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">End Date</label>
                            <p class="text-lg font-medium text-slate-900">{{ $discount->end_date->format('M j, Y') }}</p>
                        </div>
                        @endif
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-500 mb-1">Description</label>
                            <p class="text-slate-900">{{ $discount->description ?: 'No description provided' }}</p>
                        </div>
                    </div>
                    
                    @if($discount->type === 'duration' && $discount->conditions)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-slate-500 mb-3">Duration Conditions</label>
                        <div class="space-y-2">
                            @foreach($discount->conditions as $condition)
                            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                                <span class="text-slate-900">
                                    {{ $condition['min_days'] }} 
                                    @if(isset($condition['max_days']))
                                        - {{ $condition['max_days'] }}
                                    @else
                                        +
                                    @endif
                                    days
                                </span>
                                <span class="font-medium text-neon-blue">{{ $condition['percentage'] }}%</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Usage Statistics -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-lg font-semibold text-slate-900 mb-4">Usage Statistics</h2>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-slate-900">{{ $usage_stats['total_bookings'] }}</div>
                            <div class="text-sm text-slate-500">Rental Bookings</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-slate-900">{{ $usage_stats['total_purchases'] }}</div>
                            <div class="text-sm text-slate-500">Vehicle Purchases</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">${{ number_format($usage_stats['total_discount_given'], 2) }}</div>
                            <div class="text-sm text-slate-500">Total Discount Given</div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-2xl font-bold text-neon-blue">${{ number_format($usage_stats['total_revenue_impact'], 2) }}</div>
                            <div class="text-sm text-slate-500">Revenue Impact</div>
                        </div>
                    </div>
                </div>

                <!-- Activity Log -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-900">Activity Log</h2>
                    </div>
                    
                    <div class="p-6">
                        @forelse($recentLogs as $log)
                        <div class="flex items-start space-x-4 pb-4 {{ !$loop->last ? 'border-b border-slate-100 mb-4' : '' }}">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center">
                                    @if($log->action === 'created')
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    @elseif($log->action === 'updated')
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    @elseif($log->action === 'applied')
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-slate-900">{{ $log->description }}</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    @if($log->user)
                                    <span class="text-xs text-slate-500">by {{ $log->user->name }}</span>
                                    @endif
                                    <span class="text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-slate-500 text-center py-8">No activity recorded yet</p>
                        @endforelse
                        
                        @if($recentLogs->hasPages())
                        <div class="mt-6">
                            {{ $recentLogs->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Quick Actions</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('admin.discounts.edit', $discount) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-neon-blue text-white rounded-lg hover:bg-blue-dark transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Discount
                        </a>
                        
                        <form action="{{ route('admin.discounts.toggle-status', $discount) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 
                                {{ $discount->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}
                                rounded-lg transition-all duration-200">
                                {{ $discount->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        
                        @if(!$discount->bookings()->exists() && !$discount->purchases()->exists())
                        <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this discount? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Discount
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                <!-- Discount Info -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Discount Information</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wide">Created</label>
                            <p class="text-sm text-slate-900">{{ $discount->created_at->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wide">Last Updated</label>
                            <p class="text-sm text-slate-900">{{ $discount->updated_at->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                        
                        @if($discount->type === 'holiday')
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wide">Status</label>
                            @php
                                $now = now();
                                $isActive = $discount->is_active && $now->between($discount->start_date, $discount->end_date);
                                $isPending = $discount->is_active && $now->lt($discount->start_date);
                                $isExpired = $now->gt($discount->end_date);
                            @endphp
                            
                            @if($isActive)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 mr-1"></span>
                                    Currently Active
                                </span>
                            @elseif($isPending)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 mr-1"></span>
                                    Pending Start
                                </span>
                            @elseif($isExpired)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400 mr-1"></span>
                                    Expired
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1"></span>
                                    Inactive
                                </span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection