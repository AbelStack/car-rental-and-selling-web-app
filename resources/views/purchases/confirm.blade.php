@extends('layouts.app')

@section('title', 'Confirm Purchase - ' . $vehicle->full_name)

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-4">
                    <!-- Step 1: Vehicle Selection -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 bg-green-500 text-white rounded-full text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-900">
                            {{ app()->getLocale() === 'am' ? 'ተሽከርካሪ ምርጫ' : 'Vehicle Selection' }}
                        </span>
                    </div>
                    
                    <div class="w-8 h-px bg-gray-300"></div>
                    
                    <!-- Step 2: User Information -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 bg-blue-500 text-white rounded-full text-sm font-medium">2</div>
                        <span class="ml-2 text-sm font-medium text-blue-600">
                            {{ app()->getLocale() === 'am' ? 'የተጠቃሚ መረጃ' : 'User Information' }}
                        </span>
                    </div>
                    
                    <div class="w-8 h-px bg-gray-300"></div>
                    
                    <!-- Step 3: Payment -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-300 text-gray-500 rounded-full text-sm font-medium">3</div>
                        <span class="ml-2 text-sm font-medium text-gray-500">
                            {{ app()->getLocale() === 'am' ? 'ክፍያ' : 'Payment' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">
                {{ app()->getLocale() === 'am' ? 'ግዢ ያረጋግጡ' : 'Confirm Your Purchase' }}
            </h1>
            <p class="mt-2 text-gray-600">
                {{ app()->getLocale() === 'am' ? 'የተጠቃሚ መረጃዎን ያረጋግጡ እና ግዢዎን ያጠናቅቁ' : 'Confirm your information and complete your purchase' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content - User Information Form -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">
                        {{ app()->getLocale() === 'am' ? 'የተጠቃሚ መረጃ' : 'User Information' }}
                    </h2>
                    
                    <form id="purchase-form" method="POST" action="{{ route('purchases.store', $vehicle) }}">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ሙሉ ስም' : 'Full Name' }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="full_name" name="full_name" 
                                       value="{{ old('full_name', auth()->user()->name) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ስልክ ቁጥር' : 'Phone Number' }} <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="phone" name="phone" 
                                       value="{{ old('phone', auth()->user()->phone) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ኢሜይል አድራሻ' : 'Email Address' }} <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" 
                                       value="{{ old('email', auth()->user()->email) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- National ID / Passport -->
                            <div>
                                <label for="national_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'am' ? 'መታወቂያ ቁጥር / ፓስፖርት' : 'National ID / Passport' }}
                                </label>
                                <input type="text" id="national_id" name="national_id" 
                                       value="{{ old('national_id', auth()->user()->national_id ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('national_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ከተማ' : 'City' }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="city" name="city" 
                                       value="{{ old('city', auth()->user()->city ?? '') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'am' ? 'አድራሻ' : 'Address' }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="address" name="address" 
                                       value="{{ old('address', auth()->user()->address ?? '') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Save Information Checkbox -->
                        <div class="mt-6">
                            <div class="flex items-center">
                                <input type="checkbox" id="save_info" name="save_info" value="1" checked
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="save_info" class="ml-2 block text-sm text-gray-700">
                                    {{ app()->getLocale() === 'am' ? 'ይህንን መረጃ ለወደፊት ግዢዎች አስቀምጥ' : 'Save this information for future purchases' }}
                                </label>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mt-6">
                            <div class="flex items-start">
                                <input type="checkbox" id="terms" name="terms" value="1" required
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                                <label for="terms" class="ml-2 block text-sm text-gray-700">
                                    {{ app()->getLocale() === 'am' ? 'እኔ' : 'I agree to the' }}
                                    <button type="button" onclick="showTermsModal()" class="text-blue-600 hover:text-blue-800 underline font-medium">
                                        {{ app()->getLocale() === 'am' ? 'የአገልግሎት ውሎች' : 'Terms of Service' }}
                                    </button>
                                    {{ app()->getLocale() === 'am' ? 'እና' : 'and' }}
                                    <button type="button" onclick="showPrivacyModal()" class="text-blue-600 hover:text-blue-800 underline font-medium">
                                        {{ app()->getLocale() === 'am' ? 'የግላዊነት ፖሊሲ' : 'Privacy Policy' }}
                                    </button>
                                    {{ app()->getLocale() === 'am' ? 'ን አንብቤ ተስማምቻለሁ' : '' }}
                                    <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('terms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('vehicles.show', $vehicle) }}" 
                               class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ተመለስ' : 'Back to Vehicle' }}
                            </a>
                            
                            <button type="submit" id="proceed-btn"
                                    class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ግዢ ያጠናቅቁ እና ይክፈሉ' : 'Complete Purchase & Pay' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar - Order Summary -->
            <div class="lg:col-span-1">
                <!-- Vehicle Summary -->
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'የተመረጠ ተሽከርካሪ' : 'Selected Vehicle' }}
                    </h3>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            @if($vehicle->primary_image)
                                <img class="h-20 w-20 rounded-lg object-cover" src="{{ $vehicle->primary_image }}" alt="{{ $vehicle->full_name }}">
                            @else
                                <div class="h-20 w-20 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">{{ $vehicle->full_name }}</h4>
                            <div class="mt-1 text-sm text-gray-500">
                                {{ $vehicle->year }} • {{ number_format($vehicle->mileage) }} km
                            </div>
                            <div class="mt-1 text-sm text-gray-500">
                                {{ ucfirst($vehicle->condition) }} • {{ ucfirst($vehicle->fuel_type) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'የትዕዛዝ ማጠቃለያ' : 'Order Summary' }}
                    </h3>
                    
                    <div id="order-summary">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">
                                    {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ዋጋ' : 'Vehicle Price' }}
                                </span>
                                <span class="font-medium">ETB {{ number_format($vehicle->sale_price, 0) }}</span>
                            </div>
                            
                            <!-- Discount will be calculated and shown here -->
                            <div id="discount-section" class="hidden">
                                <div class="flex justify-between text-green-600">
                                    <span>{{ app()->getLocale() === 'am' ? 'ቅናሽ' : 'Discount' }} (<span id="discount-percent"></span>%)</span>
                                    <span>-$<span id="discount-amount">0.00</span></span>
                                </div>
                                <div class="text-xs text-green-700 mt-1">
                                    <span id="discount-reason"></span>
                                </div>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">
                                    {{ app()->getLocale() === 'am' ? 'ታክስ (15%)' : 'Tax (15%)' }}
                                </span>
                                <span class="font-medium">ETB <span id="tax-amount">{{ number_format($vehicle->sale_price * 0.15, 0) }}</span></span>
                            </div>
                            
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">
                                        {{ app()->getLocale() === 'am' ? 'ጠቅላላ' : 'Total' }}
                                    </span>
                                    <span class="text-lg font-semibold text-gray-900">ETB <span id="total-amount">{{ number_format($vehicle->sale_price * 1.15, 0) }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Methods -->
                    <div class="mt-6 pt-6 border-t">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">
                            {{ app()->getLocale() === 'am' ? 'የክፍያ ዘዴዎች' : 'Payment Methods' }}
                        </h4>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ app()->getLocale() === 'am' ? 'ሞባይል ባንኪንግ' : 'Mobile Banking' }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ app()->getLocale() === 'am' ? 'ባንክ ዝውውር' : 'Bank Transfer' }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-700">{{ app()->getLocale() === 'am' ? 'ሌሎች የተደገፉ አማራጮች' : 'Other Supported Options' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calculate discount on page load
    calculateOrderSummary();
    
    // Auto-save user information
    const form = document.getElementById('purchase-form');
    const inputs = form.querySelectorAll('input[type="text"], input[type="tel"], input[type="email"]');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (document.getElementById('save_info').checked) {
                // Auto-save logic could be implemented here
                console.log('Auto-saving user information...');
            }
        });
    });
});

function calculateOrderSummary() {
    const vehiclePrice = {{ $vehicle->sale_price }};
    
    fetch('{{ route("discount.preview") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            type: 'selling',
            amount: vehiclePrice,
            start_date: new Date().toISOString().split('T')[0]
        })
    })
    .then(response => response.json())
    .then(result => {
        const discountSection = document.getElementById('discount-section');
        const taxAmountSpan = document.getElementById('tax-amount');
        const totalAmountSpan = document.getElementById('total-amount');
        
        let finalPrice = vehiclePrice;
        
        if (result.has_discount) {
            // Show discount section
            discountSection.classList.remove('hidden');
            document.getElementById('discount-percent').textContent = result.discount.percentage;
            document.getElementById('discount-amount').textContent = parseFloat(result.discount_amount).toFixed(2);
            document.getElementById('discount-reason').textContent = result.discount_reason;
            
            finalPrice = parseFloat(result.final_amount);
        } else {
            // Hide discount section
            discountSection.classList.add('hidden');
        }
        
        // Calculate tax on final price
        const taxAmount = finalPrice * 0.15;
        const totalAmount = finalPrice + taxAmount;
        
        // Update display
        taxAmountSpan.textContent = taxAmount.toFixed(2);
        totalAmountSpan.textContent = totalAmount.toFixed(2);
    })
    .catch(error => {
        console.error('Error calculating discount:', error);
        // Keep original calculations if discount calculation fails
    });
}
</script>
@endpush

<!-- Terms of Service Modal -->
<div id="termsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ app()->getLocale() === 'am' ? 'የአገልግሎት ውሎች' : 'Terms of Service' }}
                </h3>
                <button onclick="closeTermsModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="max-h-96 overflow-y-auto text-sm text-gray-700 space-y-4">
                @if(app()->getLocale() === 'am')
                    <h4 class="font-semibold">1. የአገልግሎት ተቀባይነት</h4>
                    <p>በእኛ የተሽከርካሪ ኪራይ እና ሽያጭ አገልግሎት በመጠቀምዎ እነዚህን ውሎች ተቀብለዋል።</p>
                    
                    <h4 class="font-semibold">2. የተሽከርካሪ ሽያጭ ውሎች</h4>
                    <p>• ሁሉም ተሽከርካሪዎች በተገለጸው ሁኔታ ይሸጣሉ</p>
                    <p>• ዋጋዎች ታክስ ጨምሮ ናቸው</p>
                    <p>• ክፍያ በቻፓ በኩል ደህንነቱ የተጠበቀ ነው</p>
                    <p>• ሽያጭ ከተጠናቀቀ በኋላ መመለስ አይቻልም</p>
                    
                    <h4 class="font-semibold">3. KYC ማረጋገጫ</h4>
                    <p>ተሽከርካሪ ለመግዛት KYC ማረጋገጫ ያስፈልጋል። ይህ የመንግስት መታወቂያ እና የአድራሻ ማረጋገጫን ያካትታል።</p>
                    
                    <h4 class="font-semibold">4. ክፍያ ውሎች</h4>
                    <p>• ሁሉም ክፍያዎች በቻፓ በኩል ይከናወናሉ</p>
                    <p>• ክፍያ ካልተሳካ ተሽከርካሪው ለሌሎች ይቀራል</p>
                    <p>• የክፍያ ማረጋገጫ በ24 ሰዓት ውስጥ ይላካል</p>
                    
                    <h4 class="font-semibold">5. ተሽከርካሪ ማረከቢያ</h4>
                    <p>• ተሽከርካሪ ማረከቢያ በእኛ ቢሮ ይከናወናል</p>
                    <p>• ሁሉም ሰነዶች በማረከቢያ ጊዜ ይሰጣሉ</p>
                    <p>• የመጨረሻ ፍተሻ በማረከቢያ ጊዜ ይደረጋል</p>
                    
                    <h4 class="font-semibold">6. ዋስትና</h4>
                    <p>ተሽከርካሪዎች በተገለጸው ሁኔታ ይሸጣሉ። ተጨማሪ ዋስትና በተናጠል ይሰጣል።</p>
                    
                    <h4 class="font-semibold">7. ተጠያቂነት</h4>
                    <p>ኩባንያው ከሽያጭ በኋላ ለሚከሰቱ ችግሮች ተጠያቂ አይደለም።</p>
                @else
                    <h4 class="font-semibold">1. Acceptance of Terms</h4>
                    <p>By using our vehicle rental and sales service, you accept these terms and conditions.</p>
                    
                    <h4 class="font-semibold">2. Vehicle Sales Terms</h4>
                    <p>• All vehicles are sold in the condition described</p>
                    <p>• Prices include applicable taxes</p>
                    <p>• Payment is processed securely through Chapa</p>
                    <p>• Sales are final and non-refundable</p>
                    
                    <h4 class="font-semibold">3. KYC Verification</h4>
                    <p>KYC verification is required to purchase vehicles. This includes government-issued ID and address verification.</p>
                    
                    <h4 class="font-semibold">4. Payment Terms</h4>
                    <p>• All payments are processed through Chapa</p>
                    <p>• If payment fails, the vehicle remains available to others</p>
                    <p>• Payment confirmation will be sent within 24 hours</p>
                    
                    <h4 class="font-semibold">5. Vehicle Delivery</h4>
                    <p>• Vehicle pickup is at our office location</p>
                    <p>• All documents will be provided at pickup</p>
                    <p>• Final inspection will be conducted at pickup</p>
                    
                    <h4 class="font-semibold">6. Warranty</h4>
                    <p>Vehicles are sold as described. Additional warranty may be provided separately.</p>
                    
                    <h4 class="font-semibold">7. Liability</h4>
                    <p>The company is not liable for issues that arise after the sale is completed.</p>
                @endif
            </div>
            <div class="flex justify-end mt-6">
                <button onclick="closeTermsModal()" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    {{ app()->getLocale() === 'am' ? 'ዝጋ' : 'Close' }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Policy Modal -->
<div id="privacyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ app()->getLocale() === 'am' ? 'የግላዊነት ፖሊሲ' : 'Privacy Policy' }}
                </h3>
                <button onclick="closePrivacyModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="max-h-96 overflow-y-auto text-sm text-gray-700 space-y-4">
                @if(app()->getLocale() === 'am')
                    <h4 class="font-semibold">1. መረጃ ስብሰባ</h4>
                    <p>እኛ የሚከተሉትን የግል መረጃዎች እንሰበስባለን:</p>
                    <p>• ሙሉ ስም</p>
                    <p>• ስልክ ቁጥር</p>
                    <p>• ኢሜይል አድራሻ</p>
                    <p>• የመታወቂያ ቁጥር</p>
                    <p>• አድራሻ</p>
                    
                    <h4 class="font-semibold">2. መረጃ አጠቃቀም</h4>
                    <p>የእርስዎን መረጃ የምንጠቀመው:</p>
                    <p>• ግዢዎችን ለማስኬድ</p>
                    <p>• KYC ማረጋገጫ ለማድረግ</p>
                    <p>• ከእርስዎ ጋር ለመገናኘት</p>
                    <p>• የአገልግሎት ማሻሻያ ለማድረግ</p>
                    
                    <h4 class="font-semibold">3. መረጃ ማጋራት</h4>
                    <p>የእርስዎን መረጃ ከሶስተኛ ወገን ጋር አንጋራም፣ በሕግ የሚጠበቅ ካልሆነ በስተቀር።</p>
                    
                    <h4 class="font-semibold">4. መረጃ ደህንነት</h4>
                    <p>የእርስዎን መረጃ በደህንነት እንጠብቃለን እና ያልተፈቀደ መዳረሻን እንከላከላለን።</p>
                    
                    <h4 class="font-semibold">5. ኩኪዎች</h4>
                    <p>የእኛ ድረ-ገጽ ኩኪዎችን ይጠቀማል የተሻለ ተሞክሮ ለመስጠት።</p>
                    
                    <h4 class="font-semibold">6. የእርስዎ መብቶች</h4>
                    <p>እርስዎ መብት አለዎት:</p>
                    <p>• የእርስዎን መረጃ ለማየት</p>
                    <p>• መረጃ ለማስተካከል</p>
                    <p>• መረጃ ለመሰረዝ</p>
                    
                    <h4 class="font-semibold">7. ያግኙን</h4>
                    <p>ስለ ግላዊነት ጥያቄ ካለዎት እባክዎ ያግኙን።</p>
                @else
                    <h4 class="font-semibold">1. Information Collection</h4>
                    <p>We collect the following personal information:</p>
                    <p>• Full name</p>
                    <p>• Phone number</p>
                    <p>• Email address</p>
                    <p>• National ID number</p>
                    <p>• Address</p>
                    
                    <h4 class="font-semibold">2. Information Usage</h4>
                    <p>We use your information to:</p>
                    <p>• Process purchases</p>
                    <p>• Conduct KYC verification</p>
                    <p>• Communicate with you</p>
                    <p>• Improve our services</p>
                    
                    <h4 class="font-semibold">3. Information Sharing</h4>
                    <p>We do not share your information with third parties, except as required by law.</p>
                    
                    <h4 class="font-semibold">4. Data Security</h4>
                    <p>We protect your information with security measures and prevent unauthorized access.</p>
                    
                    <h4 class="font-semibold">5. Cookies</h4>
                    <p>Our website uses cookies to provide a better user experience.</p>
                    
                    <h4 class="font-semibold">6. Your Rights</h4>
                    <p>You have the right to:</p>
                    <p>• Access your information</p>
                    <p>• Correct your information</p>
                    <p>• Delete your information</p>
                    
                    <h4 class="font-semibold">7. Contact Us</h4>
                    <p>If you have privacy questions, please contact us.</p>
                @endif
            </div>
            <div class="flex justify-end mt-6">
                <button onclick="closePrivacyModal()" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    {{ app()->getLocale() === 'am' ? 'ዝጋ' : 'Close' }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showTermsModal() {
    document.getElementById('termsModal').classList.remove('hidden');
}

function closeTermsModal() {
    document.getElementById('termsModal').classList.add('hidden');
}

function showPrivacyModal() {
    document.getElementById('privacyModal').classList.remove('hidden');
}

function closePrivacyModal() {
    document.getElementById('privacyModal').classList.add('hidden');
}

// Close modals when clicking outside
document.getElementById('termsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTermsModal();
    }
});

document.getElementById('privacyModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePrivacyModal();
    }
});
</script>

@endsection