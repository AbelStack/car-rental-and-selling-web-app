@extends('layouts.app')

@section('title', 'Purchase Details - ' . $purchase->purchase_reference)

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="{{ route('dashboard.purchases') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        @if(app()->getLocale() === 'am')
                            ግዢ ዝርዝር
                        @else
                            Purchase Details
                        @endif
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">{{ $purchase->purchase_reference }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Purchase Status -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            @if(app()->getLocale() === 'am')
                                ሁኔታ
                            @else
                                Purchase Status
                            @endif
                        </h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($purchase->status === 'completed') bg-green-100 text-green-800
                            @elseif($purchase->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($purchase->status === 'rejected') bg-red-100 text-red-800
                            @elseif($purchase->status === 'processing') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if(app()->getLocale() === 'am')
                                @switch($purchase->status)
                                    @case('completed') ተጠናቅቋል @break
                                    @case('pending') በመጠባበቅ ላይ @break
                                    @case('rejected') ተቀባይነት አላገኘም @break
                                    @case('processing') በሂደት ላይ @break
                                    @default {{ ucfirst($purchase->status) }}
                                @endswitch
                            @else
                                {{ ucfirst($purchase->status) }}
                            @endif
                        </span>
                    </div>
                    
                    @if($purchase->status === 'pending')
                        <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">
                                        @if(app()->getLocale() === 'am')
                                            ክፍያ ያስፈልጋል
                                        @else
                                            Payment Required
                                        @endif
                                    </h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>
                                            @if(app()->getLocale() === 'am')
                                                ይህንን ግዢ ለማጠናቀቅ ክፍያ ያስፈልጋል።
                                            @else
                                                Payment is required to complete this purchase.
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mt-4">
                                        <form action="{{ route('chapa.purchase.pay', $purchase) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                @if(app()->getLocale() === 'am')
                                                    በChapa ይክፈሉ
                                                @else
                                                    Pay with Chapa
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Vehicle Information -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የተገዛ ተሽከርካሪ
                        @else
                            Purchased Vehicle
                        @endif
                    </h3>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            @if($purchase->vehicle->primary_image)
                                <img class="h-24 w-24 rounded-lg object-cover" src="{{ $purchase->vehicle->primary_image }}" alt="{{ $purchase->vehicle->full_name }}">
                            @else
                                <div class="h-24 w-24 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-medium text-gray-900">{{ $purchase->vehicle->full_name }}</h4>
                            <div class="mt-2 grid grid-cols-2 gap-4 text-sm text-gray-500">
                                <div>
                                    @if(app()->getLocale() === 'am')
                                        አመት: {{ $purchase->vehicle->year }}
                                    @else
                                        Year: {{ $purchase->vehicle->year }}
                                    @endif
                                </div>
                                <div>
                                    @if(app()->getLocale() === 'am')
                                        አይነት: {{ ucfirst($purchase->vehicle->type) }}
                                    @else
                                        Type: {{ ucfirst($purchase->vehicle->type) }}
                                    @endif
                                </div>
                                <div>
                                    @if(app()->getLocale() === 'am')
                                        ነዳጅ: {{ ucfirst($purchase->vehicle->fuel_type) }}
                                    @else
                                        Fuel: {{ ucfirst($purchase->vehicle->fuel_type) }}
                                    @endif
                                </div>
                                <div>
                                    @if(app()->getLocale() === 'am')
                                        ማስተላለፊያ: {{ ucfirst($purchase->vehicle->transmission) }}
                                    @else
                                        Transmission: {{ ucfirst($purchase->vehicle->transmission) }}
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('vehicles.show', $purchase->vehicle) }}" 
                                    class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                    @if(app()->getLocale() === 'am')
                                        ተሽከርካሪ ዝርዝር ይመልከቱ →
                                    @else
                                        View Vehicle Details →
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchase Details -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            ግዢ ዝርዝሮች
                        @else
                            Purchase Details
                        @endif
                    </h3>
                    
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የግዢ ቀን
                                @else
                                    Purchase Date
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $purchase->created_at->format('M d, Y \a\t g:i A') }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የግዢ ማጣቀሻ
                                @else
                                    Purchase Reference
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $purchase->purchase_reference }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የተዘመነበት ቀን
                                @else
                                    Last Updated
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $purchase->updated_at->format('M d, Y \a\t g:i A') }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    ጠቅላላ መጠን
                                @else
                                    Total Amount
                                @endif
                            </dt>
                            <dd class="mt-1 text-lg font-medium text-gray-900">ETB {{ number_format($purchase->total_amount, 0) }}</dd>
                        </div>
                    </dl>
                    
                    @if($purchase->notes)
                        <div class="mt-6">
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    ማስታወሻዎች
                                @else
                                    Notes
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $purchase->notes }}</dd>
                        </div>
                    @endif
                </div>

                <!-- Payment Information -->
                @if($purchase->payment)
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            @if(app()->getLocale() === 'am')
                                የክፍያ መረጃ
                            @else
                                Payment Information
                            @endif
                        </h3>
                        
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">
                                    @if(app()->getLocale() === 'am')
                                        የክፍያ ማጣቀሻ
                                    @else
                                        Payment Reference
                                    @endif
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $purchase->payment->payment_reference }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">
                                    @if(app()->getLocale() === 'am')
                                        የክፍያ ሁኔታ
                                    @else
                                        Payment Status
                                    @endif
                                </dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($purchase->payment->status === 'completed') bg-green-100 text-green-800
                                        @elseif($purchase->payment->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($purchase->payment->status === 'failed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($purchase->payment->status) }}
                                    </span>
                                </dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">
                                    @if(app()->getLocale() === 'am')
                                        የክፍያ ዘዴ
                                    @else
                                        Payment Method
                                    @endif
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $purchase->payment->payment_method)) }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">
                                    @if(app()->getLocale() === 'am')
                                        የክፍያ ቀን
                                    @else
                                        Payment Date
                                    @endif
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $purchase->payment->created_at->format('M d, Y \a\t g:i A') }}</dd>
                            </div>
                        </dl>
                        
                        @if($purchase->payment->status === 'pending' || $purchase->payment->status === 'failed')
                            <div class="mt-6">
                                <a href="{{ route('payments.status', $purchase->payment) }}" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    @if(app()->getLocale() === 'am')
                                        የክፍያ ሁኔታ ይመልከቱ
                                    @else
                                        View Payment Status
                                    @endif
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Purchase Summary -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            ግዢ ማጠቃለያ
                        @else
                            Purchase Summary
                        @endif
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የተሽከርካሪ ዋጋ
                                @else
                                    Vehicle Price
                                @endif
                            </span>
                            <span class="text-sm font-medium text-gray-900">ETB {{ number_format($purchase->vehicle->sale_price, 0) }}</span>
                        </div>
                        
                        @if($purchase->discount_amount > 0)
                        <!-- Discount Information -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 my-3">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                    <span class="text-sm font-medium text-green-800">
                                        @if(app()->getLocale() === 'am')
                                            ቅናሽ ተተግብሯል
                                        @else
                                            Discount Applied
                                        @endif
                                    </span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $purchase->discount_type === 'holiday' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }}">
                                        {{ ucfirst($purchase->discount_type) }}
                                    </span>
                                </div>
                                <span class="text-sm font-bold text-green-600">{{ $purchase->discount_percentage }}% OFF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-green-700">
                                    @if(app()->getLocale() === 'am')
                                        ቅናሽ መጠን
                                    @else
                                        Discount Amount
                                    @endif
                                </span>
                                <span class="text-sm font-medium text-green-800">-ETB {{ number_format($purchase->discount_amount, 0) }}</span>
                            </div>
                            @if($purchase->discount_reason)
                            <div class="mt-2 text-xs text-green-700">
                                <strong>{{ app()->getLocale() === 'am' ? 'ምክንያት:' : 'Reason:' }}</strong> {{ $purchase->discount_reason }}
                            </div>
                            @endif
                        </div>
                        @endif
                        
                        <div class="border-t pt-4">
                            <div class="flex justify-between">
                                <span class="text-base font-medium text-gray-900">
                                    @if(app()->getLocale() === 'am')
                                        ጠቅላላ
                                    @else
                                        Total
                                    @endif
                                </span>
                                <span class="text-base font-medium text-gray-900">ETB {{ number_format($purchase->total_amount, 0) }}</span>
                            </div>
                            @if($purchase->discount_amount > 0)
                            <div class="text-xs text-gray-500 mt-1">
                                @if(app()->getLocale() === 'am')
                                    የመጀመሪያ ዋጋ: ETB {{ number_format($purchase->original_total, 0) }}
                                @else
                                    Original price: ETB {{ number_format($purchase->original_total, 0) }}
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            እርምጃዎች
                        @else
                            Actions
                        @endif
                    </h3>
                    
                    <div class="space-y-3">
                        @if($purchase->status === 'pending')
                            <form action="{{ route('chapa.purchase.pay', $purchase) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    @if(app()->getLocale() === 'am')
                                        በChapa ክፍያ ያጠናቅቁ
                                    @else
                                        Complete Payment with Chapa
                                    @endif
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('dashboard.purchases') }}" 
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            @if(app()->getLocale() === 'am')
                                ሁሉንም ግዢዎች ይመልከቱ
                            @else
                                View All Purchases
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Purchase Timeline -->
                <div class="mt-6 bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የግዢ ታሪክ
                        @else
                            Purchase Timeline
                        @endif
                    </h3>
                    
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
                                                <p class="text-sm text-gray-500">
                                                    @if(app()->getLocale() === 'am')
                                                        ግዢ ተፈጥሯል
                                                    @else
                                                        Purchase created
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-400">{{ $purchase->created_at->format('M d, Y \a\t g:i A') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            @if($purchase->payment)
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
                                                    <p class="text-sm text-gray-500">
                                                        @if(app()->getLocale() === 'am')
                                                            ክፍያ ተጀመረ
                                                        @else
                                                            Payment initiated
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-gray-400">{{ $purchase->payment->created_at->format('M d, Y \a\t g:i A') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            @if($purchase->status === 'completed')
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
                                                    <p class="text-sm text-gray-500">
                                                        @if(app()->getLocale() === 'am')
                                                            ግዢ ተጠናቅቋል
                                                        @else
                                                            Purchase completed
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-gray-400">{{ $purchase->updated_at->format('M d, Y \a\t g:i A') }}</p>
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

@if(session('redirect_to_payment') && $purchase->status === 'pending')
<!-- Auto-redirect to payment modal -->
<div id="payment-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">
                {{ app()->getLocale() === 'am' ? 'ግዢ ተፈጥሯል!' : 'Purchase Created!' }}
            </h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    {{ app()->getLocale() === 'am' ? 'የእርስዎን ግዢ ለማጠናቀቅ ደህንነቱ የተጠበቀ ክፍያ ያስፈልጋል።' : 'Secure payment is required to complete your purchase.' }}
                </p>
                <p class="text-sm text-gray-600 mt-2 font-medium">
                    {{ app()->getLocale() === 'am' ? 'ጠቅላላ መጠን: $' . number_format($purchase->total_amount, 2) : 'Total Amount: $' . number_format($purchase->total_amount, 2) }}
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <form action="{{ route('chapa.purchase.pay', $purchase) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" id="proceed-payment-btn"
                            class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'በChapa ክፍያ ያጠናቅቁ' : 'Pay with Chapa' }}
                    </button>
                </form>
                <button onclick="closePaymentModal()" 
                        class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    {{ app()->getLocale() === 'am' ? 'ቆይተው ይክፈሉ' : 'Pay Later' }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function closePaymentModal() {
    document.getElementById('payment-modal').style.display = 'none';
}

// Auto-focus on payment button
document.addEventListener('DOMContentLoaded', function() {
    const paymentBtn = document.getElementById('proceed-payment-btn');
    if (paymentBtn) {
        paymentBtn.focus();
    }
});
</script>
@endif

@endsection
