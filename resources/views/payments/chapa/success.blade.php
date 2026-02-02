@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ app()->getLocale() === 'am' ? 'ክፍያ ተሳክቷል!' : 'Payment Successful!' }}
            </h1>
            <p class="text-lg text-gray-600">
                {{ app()->getLocale() === 'am' ? 'እንኳን ደስ አለዎት! ክፍያዎ በተሳካ ሁኔታ ተጠናቅቋል።' : 'Congratulations! Your payment has been processed successfully.' }}
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
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ app()->getLocale() === 'am' ? 'ተሳክቷል' : 'Success' }}
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

        @if($transaction->payable_type === 'App\Models\Purchase')
            <!-- Purchase Success Details -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'የተገዛ ተሽከርካሪ' : 'Purchased Vehicle' }}
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
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                {{ app()->getLocale() === 'am' ? 'ተሽጧል' : 'SOLD' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps for Purchase -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">
                            {{ app()->getLocale() === 'am' ? 'ቀጣይ እርምጃዎች' : 'Next Steps' }}
                        </h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>{{ app()->getLocale() === 'am' ? 'የእኛ ቡድን በ24 ሰዓት ውስጥ ያገኝዎታል' : 'Our team will contact you within 24 hours' }}</li>
                                <li>{{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ሰነዶች ይዘጋጃሉ' : 'Vehicle documents will be prepared' }}</li>
                                <li>{{ app()->getLocale() === 'am' ? 'የመረከቢያ ቀጠሮ ይይዛል' : 'Delivery appointment will be scheduled' }}</li>
                                <li>{{ app()->getLocale() === 'am' ? 'የመጨረሻ ፍተሻ እና ማረጋገጫ' : 'Final inspection and handover' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($transaction->payable_type === 'App\Models\Booking')
            <!-- Booking Success Details -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'የተያዘ ተሽከርካሪ' : 'Booked Vehicle' }}
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
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ app()->getLocale() === 'am' ? 'ተረጋግጧል' : 'CONFIRMED' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if($transaction->payable_type === 'App\Models\Purchase')
                <a href="{{ route('purchases.show', $transaction->payable) }}" 
                   class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ app()->getLocale() === 'am' ? 'የግዢ ዝርዝሮች ይመልከቱ' : 'View Purchase Details' }}
                </a>
            @elseif($transaction->payable_type === 'App\Models\Booking')
                <a href="{{ route('bookings.show', $transaction->payable) }}" 
                   class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ app()->getLocale() === 'am' ? 'የቦታ ማስያዝ ዝርዝሮች ይመልከቱ' : 'View Booking Details' }}
                </a>
            @endif
            
            <a href="{{ route('dashboard') }}" 
               class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ app()->getLocale() === 'am' ? 'ወደ ዳሽቦርድ ይሂዱ' : 'Go to Dashboard' }}
            </a>
            
            <a href="{{ route('vehicles.sales') }}" 
               class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ app()->getLocale() === 'am' ? 'ተጨማሪ ተሽከርካሪዎች ይመልከቱ' : 'Browse More Vehicles' }}
            </a>
        </div>

        <!-- Contact Support -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 mb-2">
                {{ app()->getLocale() === 'am' ? 'ጥያቄ አለዎት? እኛን ያግኙን:' : 'Have questions? Contact us:' }}
            </p>
            <a href="{{ route('contact.show') }}" class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                {{ app()->getLocale() === 'am' ? 'የደንበኞች አገልግሎት' : 'Customer Support' }}
            </a>
        </div>
    </div>
</div>
@endsection