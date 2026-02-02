@extends('layouts.app')

@section('title', 'Booking Details - Admin Panel')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('admin.bookings.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Booking {{ $booking->booking_reference }}
                    </h2>
                </div>
                <div class="flex space-x-3">
                    @if($booking->status === 'pending_approval')
                        <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve Booking
                            </button>
                        </form>
                    @endif
                    @if(in_array($booking->status, ['pending_approval', 'confirmed']))
                        <button onclick="document.getElementById('reject-modal').classList.remove('hidden')" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reject Booking
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Booking Details -->
            <div class="lg:col-span-2">
                <!-- Vehicle Information -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Vehicle Information</h3>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                @if($booking->vehicle->primary_image)
                                    <img class="h-24 w-24 rounded-lg object-cover" src="{{ $booking->vehicle->primary_image }}" alt="{{ $booking->vehicle->full_name }}">
                                @else
                                    <div class="h-24 w-24 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-medium text-gray-900">{{ $booking->vehicle->full_name }}</h4>
                                <div class="mt-2 grid grid-cols-2 gap-4 text-sm text-gray-500">
                                    <div>Type: {{ ucfirst($booking->vehicle->type) }}</div>
                                    <div>Fuel: {{ ucfirst($booking->vehicle->fuel_type) }}</div>
                                    <div>Transmission: {{ ucfirst($booking->vehicle->transmission) }}</div>
                                    <div>Seats: {{ $booking->vehicle->seats }}</div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('admin.vehicles.show', $booking->vehicle) }}" 
                                        class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                        View Vehicle Details →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Booking Information</h3>
                        
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Booking Reference</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->booking_reference }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($booking->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status === 'pending_approval') bg-blue-100 text-blue-800
                                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                        @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                                        @elseif($booking->status === 'active') bg-purple-100 text-purple-800
                                        @elseif($booking->status === 'completed') bg-gray-100 text-gray-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Pickup Date</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->pickup_date->format('M d, Y \a\t g:i A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Return Date</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->return_date->format('M d, Y \a\t g:i A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Pickup Location</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->pickup_location }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Return Location</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->return_location }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->pickup_date->diffInDays($booking->return_date) }} days</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Total Amount</dt>
                                <dd class="mt-1 text-lg font-medium text-gray-900">${{ number_format($booking->total_amount, 2) }}</dd>
                            </div>
                        </dl>

                        @if($booking->special_requests)
                            <div class="mt-6">
                                <dt class="text-sm font-medium text-gray-500">Special Requests</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->special_requests }}</dd>
                            </div>
                        @endif

                        @if($booking->rejection_reason)
                            <div class="mt-6">
                                <dt class="text-sm font-medium text-gray-500">Rejection Reason</dt>
                                <dd class="mt-1 text-sm text-red-600">{{ $booking->rejection_reason }}</dd>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Information -->
                @if($booking->payment)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Payment Information</h3>
                            
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Payment Reference</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->payment->payment_reference }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Payment Status</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($booking->payment->status === 'completed') bg-green-100 text-green-800
                                            @elseif($booking->payment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->payment->status === 'failed') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($booking->payment->status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $booking->payment->payment_method)) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Amount</dt>
                                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($booking->payment->amount, 2) }}</dd>
                                </div>
                                @if($booking->payment->transaction_id)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Transaction ID</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->payment->transaction_id }}</dd>
                                    </div>
                                @endif
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Payment Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->payment->created_at->format('M d, Y \a\t g:i A') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Customer Information -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Customer Information</h3>
                        
                        <div class="text-center mb-4">
                            <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center mx-auto mb-2">
                                <span class="text-gray-600 font-bold text-xl">
                                    {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                </span>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900">{{ $booking->user->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $booking->user->email }}</p>
                        </div>

                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="tel:{{ $booking->user->phone }}" class="text-blue-600 hover:text-blue-500">
                                        {{ $booking->user->phone }}
                                    </a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Member Since</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->user->created_at->format('M d, Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Total Bookings</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->user->bookings->count() }}</dd>
                            </div>
                        </dl>

                        <div class="mt-6">
                            <a href="{{ route('admin.users.show', $booking->user) }}" 
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                View Customer Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Booking Timeline -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Booking Timeline</h3>
                        
                        <div class="flow-root">
                            <ul class="-mb-8">
                                <li>
                                    <div class="relative pb-8">
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                    <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">Booking created</p>
                                                    <p class="text-xs text-gray-400">{{ $booking->created_at->format('M d, Y \a\t g:i A') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                @if($booking->payment && $booking->payment->created_at)
                                    <li>
                                        <div class="relative pb-8">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Payment submitted</p>
                                                        <p class="text-xs text-gray-400">{{ $booking->payment->created_at->format('M d, Y \a\t g:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                @if($booking->approved_at)
                                    <li>
                                        <div class="relative">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Booking approved</p>
                                                        <p class="text-xs text-gray-400">{{ $booking->approved_at->format('M d, Y \a\t g:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                @if($booking->rejected_at)
                                    <li>
                                        <div class="relative">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Booking rejected</p>
                                                        <p class="text-xs text-gray-400">{{ $booking->rejected_at->format('M d, Y \a\t g:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="reject-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Booking</h3>
            <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700">Rejection Reason</label>
                    <textarea name="rejection_reason" id="rejection_reason" rows="4" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500"
                        placeholder="Please provide a reason for rejecting this booking..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Reject Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
