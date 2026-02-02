@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Failed Icon -->
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-red-100 mb-6">
                <svg class="h-12 w-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ app()->getLocale() === 'am' ? 'ክፍያ አልተሳካም' : 'Payment Failed' }}
            </h1>
            <p class="text-lg text-gray-600">
                {{ app()->getLocale() === 'am' ? 'ይቅርታ፣ ክፍያዎ ሊሰራ አልቻለም። እባክዎ እንደገና ይሞክሩ።' : 'Sorry, your payment could not be processed. Please try again.' }}
            </p>
        </div>

        <!-- Transaction Details -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                {{ app()->getLocale() === 'am' ? 'የክፍያ ዝርዝሮች' : 'Payment Details' }}
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ app()->getLocale() === 'am' ? 'የክፍያ ማጣቀሻ' : 'Payment Reference' }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $transaction->chapa_tx_ref }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ app()->getLocale() === 'am' ? 'መጠን' : 'Amount' }}
                    </dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900">ETB {{ number_format($transaction->amount, 0) }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ app()->getLocale() === 'am' ? 'ሁኔታ' : 'Status' }}
                    </dt>
                    <dd class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ app()->getLocale() === 'am' ? 'አልተሳካም' : 'Failed' }}
                        </span>
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ app()->getLocale() === 'am' ? 'ቀን' : 'Date' }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaction->created_at->format('M d, Y \a\t g:i A') }}</dd>
                </div>
            </div>
        </div>
        <!-- Failure Reasons -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        {{ app()->getLocale() === 'am' ? 'ክፍያ ያልተሳካበት ምክንያት' : 'Common Reasons for Payment Failure' }}
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>{{ app()->getLocale() === 'am' ? 'በሂሳብዎ ውስጥ በቂ ገንዘብ አለመኖር' : 'Insufficient funds in your account' }}</li>
                            <li>{{ app()->getLocale() === 'am' ? 'የባንክ ካርድ ወይም የክፍያ ዘዴ ችግር' : 'Bank card or payment method issues' }}</li>
                            <li>{{ app()->getLocale() === 'am' ? 'የኔትወርክ ግንኙነት ችግር' : 'Network connectivity problems' }}</li>
                            <li>{{ app()->getLocale() === 'am' ? 'የክፍያ ሂደት ጊዜ ማብቂያ' : 'Payment session timeout' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if($transaction->payable_type === 'App\Models\Purchase')
            <!-- Purchase Details -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'የተመረጠ ተሽከርካሪ' : 'Selected Vehicle' }}
                </h2>
                
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        @if($transaction->payable->vehicle->primary_image)
                            <img class="h-24 w-24 rounded-lg object-cover" src="{{ $transaction->payable->vehicle->primary_image }}" alt="{{ $transaction->payable->vehicle->full_name }}">
                        @else
                            <div class="h-24 w-24 rounded-lg bg-gray-200 flex items-center justify-center">
                                <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900">{{ $transaction->payable->vehicle->full_name }}</h3>
                        <div class="mt-1 text-sm text-gray-500">
                            {{ $transaction->payable->vehicle->year }} • {{ number_format($transaction->payable->vehicle->mileage) }} km
                        </div>
                        <div class="mt-1 text-sm text-gray-500">
                            {{ ucfirst($transaction->payable->vehicle->condition) }} • {{ ucfirst($transaction->payable->vehicle->fuel_type) }}
                        </div>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ app()->getLocale() === 'am' ? 'ክፍያ በመጠባበቅ ላይ' : 'PAYMENT PENDING' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($transaction->payable_type === 'App\Models\Booking')
            <!-- Booking Details -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'የተመረጠ ተሽከርካሪ' : 'Selected Vehicle' }}
                </h2>
                
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        @if($transaction->payable->vehicle->primary_image)
                            <img class="h-24 w-24 rounded-lg object-cover" src="{{ $transaction->payable->vehicle->primary_image }}" alt="{{ $transaction->payable->vehicle->full_name }}">
                        @else
                            <div class="h-24 w-24 rounded-lg bg-gray-200 flex items-center justify-center">
                                <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900">{{ $transaction->payable->vehicle->full_name }}</h3>
                        <div class="mt-1 text-sm text-gray-500">
                            {{ app()->getLocale() === 'am' ? 'ከ' : 'From' }} {{ $transaction->payable->start_date->format('M d, Y') }} 
                            {{ app()->getLocale() === 'am' ? 'እስከ' : 'to' }} {{ $transaction->payable->end_date->format('M d, Y') }}
                        </div>
                        <div class="mt-1 text-sm text-gray-500">
                            {{ $transaction->payable->total_days }} {{ app()->getLocale() === 'am' ? 'ቀናት' : 'days' }}
                        </div>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ app()->getLocale() === 'am' ? 'ክፍያ በመጠባበቅ ላይ' : 'PAYMENT PENDING' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if($transaction->payable_type === 'App\Models\Purchase')
                <form action="{{ route('chapa.purchase.pay', $transaction->payable) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ክፍያ እንደገና ይሞክሩ' : 'Retry Payment' }}
                    </button>
                </form>
            @elseif($transaction->payable_type === 'App\Models\Booking')
                <form action="{{ route('chapa.booking.pay', $transaction->payable) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ክፍያ እንደገና ይሞክሩ' : 'Retry Payment' }}
                    </button>
                </form>
            @endif
            
            <a href="{{ route('dashboard') }}" 
               class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ app()->getLocale() === 'am' ? 'ወደ ዳሽቦርድ ይሂዱ' : 'Go to Dashboard' }}
            </a>
            
            <a href="{{ route('vehicles.sales') }}" 
               class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ app()->getLocale() === 'am' ? 'ተጨማሪ ተሽከርካሪዎች ይመልከቱ' : 'Browse More Vehicles' }}
            </a>
        </div>

        <!-- Contact Support -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 mb-2">
                {{ app()->getLocale() === 'am' ? 'እርዳታ ያስፈልግዎታል? እኛን ያግኙን:' : 'Need help? Contact us:' }}
            </p>
            <a href="{{ route('contact.show') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                {{ app()->getLocale() === 'am' ? 'የደንበኞች አገልግሎት' : 'Customer Support' }}
            </a>
        </div>
    </div>
</div>
@endsection