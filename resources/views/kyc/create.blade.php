@extends('layouts.app')

@section('title', 'Submit KYC Verification')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ app()->getLocale() === 'am' ? 'KYC ማረጋገጫ ያቅርቡ' : 'Submit KYC Verification' }}
                    </h1>
                    <p class="text-gray-600 mt-1">
                        {{ app()->getLocale() === 'am' ? 'የእርስዎን ማንነት ለማረጋገጥ የሚያስፈልጉ ሰነዶች ያቅርቡ' : 'Provide required documents to verify your identity' }}
                    </p>
                </div>
                <a href="{{ route('kyc.index') }}" class="text-gray-600 hover:text-gray-900">
                    {{ app()->getLocale() === 'am' ? 'ተመለስ' : 'Back' }}
                </a>
            </div>
        </div>

        <!-- KYC Form -->
        <form action="{{ route('kyc.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Document Type Selection -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? '1. የሰነድ አይነት ይምረጡ' : '1. Select Document Type' }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative">
                        <input type="radio" name="document_type" value="national_id" class="sr-only peer" required>
                        <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-4 0V4a2 2 0 014 0v2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">
                                        {{ app()->getLocale() === 'am' ? 'የመታወቂያ ካርድ' : 'National ID Card' }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ app()->getLocale() === 'am' ? 'የኢትዮጵያ መታወቂያ ካርድ' : 'Ethiopian National ID Card' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="relative">
                        <input type="radio" name="document_type" value="passport" class="sr-only peer">
                        <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">
                                        {{ app()->getLocale() === 'am' ? 'ፓስፖርት' : 'Passport' }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ app()->getLocale() === 'am' ? 'የኢትዮጵያ ፓስፖርት' : 'Ethiopian Passport' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                @error('document_type')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Document Information -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? '2. የሰነድ መረጃ' : '2. Document Information' }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የሰነድ ቁጥር' : 'Document Number' }} *
                        </label>
                        <input type="text" name="document_number" value="{{ old('document_number') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               required>
                        @error('document_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የሰነድ ማለቂያ ቀን' : 'Document Expiry Date' }}
                        </label>
                        <input type="date" name="document_expiry_date" value="{{ old('document_expiry_date') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('document_expiry_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? '3. የግል መረጃ' : '3. Personal Information' }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ሙሉ ስም' : 'Full Name' }} *
                        </label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               required>
                        @error('full_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የተወለደበት ቀን' : 'Date of Birth' }} *
                        </label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               required>
                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ጾታ' : 'Gender' }} *
                        </label>
                        <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">{{ app()->getLocale() === 'am' ? 'ይምረጡ' : 'Select Gender' }}</option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'am' ? 'ወንድ' : 'Male' }}
                            </option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'am' ? 'ሴት' : 'Female' }}
                            </option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ዜግነት' : 'Nationality' }} *
                        </label>
                        <input type="text" name="nationality" value="{{ old('nationality', 'Ethiopian') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               required>
                        @error('nationality')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የተወለደበት ቦታ' : 'Place of Birth' }}
                        </label>
                        <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('place_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? '4. የአድራሻ መረጃ' : '4. Address Information' }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'አድራሻ መስመር 1' : 'Address Line 1' }} *
                        </label>
                        <input type="text" name="address_line_1" value="{{ old('address_line_1') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               required>
                        @error('address_line_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'አድራሻ መስመር 2' : 'Address Line 2' }}
                        </label>
                        <input type="text" name="address_line_2" value="{{ old('address_line_2') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('address_line_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ከተማ' : 'City' }} *
                        </label>
                        <input type="text" name="city" value="{{ old('city') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               required>
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ክልል' : 'Region' }} *
                        </label>
                        <input type="text" name="region" value="{{ old('region') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               required>
                        @error('region')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የፖስታ ኮድ' : 'Postal Code' }}
                        </label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Document Upload -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? '5. ሰነዶችን ይላኩ' : '5. Upload Documents' }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Document Front -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የሰነድ ፊት ገጽ' : 'Document Front Side' }} *
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                            <input type="file" name="document_front" accept="image/*" class="hidden" id="document_front" required>
                            <label for="document_front" class="cursor-pointer">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ፋይል ይምረጡ' : 'Choose file' }}</p>
                            </label>
                        </div>
                        @error('document_front')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Document Back (for National ID) -->
                    <div id="document_back_container" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የሰነድ ኋላ ገጽ' : 'Document Back Side' }} *
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                            <input type="file" name="document_back" accept="image/*" class="hidden" id="document_back">
                            <label for="document_back" class="cursor-pointer">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ፋይል ይምረጡ' : 'Choose file' }}</p>
                            </label>
                        </div>
                        @error('document_back')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Selfie with Document -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ከሰነድ ጋር ሴልፊ' : 'Selfie with Document' }} *
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                            <input type="file" name="selfie" accept="image/*" class="hidden" id="selfie" required>
                            <label for="selfie" class="cursor-pointer">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ፋይል ይምረጡ' : 'Choose file' }}</p>
                            </label>
                        </div>
                        @error('selfie')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <h4 class="font-medium text-blue-800 mb-2">
                        {{ app()->getLocale() === 'am' ? 'የፎቶ መመሪያዎች' : 'Photo Guidelines' }}
                    </h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• {{ app()->getLocale() === 'am' ? 'ፎቶዎች ግልጽ እና ሊነበቡ የሚችሉ መሆን አለባቸው' : 'Photos must be clear and readable' }}</li>
                        <li>• {{ app()->getLocale() === 'am' ? 'ከ5MB በታች መሆን አለባቸው' : 'Must be under 5MB in size' }}</li>
                        <li>• {{ app()->getLocale() === 'am' ? 'JPEG, PNG ወይም JPG ፎርማት' : 'JPEG, PNG or JPG format only' }}</li>
                        <li>• {{ app()->getLocale() === 'am' ? 'ሴልፊው ሰነዱን በግልጽ ማሳየት አለበት' : 'Selfie must clearly show the document' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        {{ app()->getLocale() === 'am' ? 'በመቀጠል የእርስዎን KYC ማረጋገጫ ለግምገማ እንልካለን።' : 'By continuing, we will submit your KYC verification for review.' }}
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        {{ app()->getLocale() === 'am' ? 'KYC ማረጋገጫ ያቅርቡ' : 'Submit KYC Verification' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const documentTypeInputs = document.querySelectorAll('input[name="document_type"]');
    const documentBackContainer = document.getElementById('document_back_container');
    const documentBackInput = document.getElementById('document_back');

    documentTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === 'national_id') {
                documentBackContainer.style.display = 'block';
                documentBackInput.required = true;
            } else {
                documentBackContainer.style.display = 'none';
                documentBackInput.required = false;
            }
        });
    });

    // File upload preview
    const fileInputs = ['document_front', 'document_back', 'selfie'];
    fileInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling || this.parentElement.querySelector('label');
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
                    label.querySelector('p').textContent = `${fileName} (${fileSize}MB)`;
                }
            });
        }
    });
});
</script>
@endsection
