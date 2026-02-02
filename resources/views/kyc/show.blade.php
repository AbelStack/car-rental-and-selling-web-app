@extends('layouts.app')

@section('title', app()->getLocale() === 'am' ? 'KYC ማረጋገጫ ዝርዝር - Addis Drive' : 'KYC Verification Details - Addis Drive')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="{{ route('kyc.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        @if(app()->getLocale() === 'am')
                            KYC ማረጋገጫ ዝርዝር
                        @else
                            KYC Verification Details
                        @endif
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(app()->getLocale() === 'am')
                            የማንነት ማረጋገጫ መረጃ እና ሁኔታ
                        @else
                            Identity verification information and status
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Verification Status -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            @if(app()->getLocale() === 'am')
                                ማረጋገጫ ሁኔታ
                            @else
                                Verification Status
                            @endif
                        </h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($kyc->status === 'approved') bg-green-100 text-green-800
                            @elseif($kyc->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($kyc->status === 'rejected') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if(app()->getLocale() === 'am')
                                @switch($kyc->status)
                                    @case('approved') ጸድቋል @break
                                    @case('pending') በመጠባበቅ ላይ @break
                                    @case('rejected') ተቀባይነት አላገኘም @break
                                    @default {{ ucfirst($kyc->status) }}
                                @endswitch
                            @else
                                {{ ucfirst($kyc->status) }}
                            @endif
                        </span>
                    </div>
                    
                    @if($kyc->status === 'approved')
                        <div class="bg-green-50 border border-green-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800">
                                        @if(app()->getLocale() === 'am')
                                            ማረጋገጫ ተጠናቅቋል
                                        @else
                                            Verification Approved
                                        @endif
                                    </h3>
                                    <div class="mt-2 text-sm text-green-700">
                                        <p>
                                            @if(app()->getLocale() === 'am')
                                                የእርስዎ KYC ማረጋገጫ ተጠናቅቋል። አሁን ተሽከርካሪዎችን መከራየት እና መግዛት ይችላሉ።
                                            @else
                                                Your KYC verification has been approved. You can now rent and purchase vehicles.
                                            @endif
                                        </p>
                                        @if($kyc->expires_at)
                                            <p class="mt-1">
                                                @if(app()->getLocale() === 'am')
                                                    የሚያበቃበት ቀን: {{ $kyc->expires_at->format('M d, Y') }}
                                                @else
                                                    Expires on: {{ $kyc->expires_at->format('M d, Y') }}
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($kyc->status === 'pending')
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
                                            በመጠባበቅ ላይ
                                        @else
                                            Under Review
                                        @endif
                                    </h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>
                                            @if(app()->getLocale() === 'am')
                                                የእርስዎ KYC ማረጋገጫ በመመርመር ላይ ነው። እባክዎ ይጠብቁ።
                                            @else
                                                Your KYC verification is under review. Please wait for admin approval.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($kyc->status === 'rejected')
                        <div class="bg-red-50 border border-red-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        @if(app()->getLocale() === 'am')
                                            ተቀባይነት አላገኘም
                                        @else
                                            Verification Rejected
                                        @endif
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>
                                            @if(app()->getLocale() === 'am')
                                                የእርስዎ KYC ማረጋገጫ ተቀባይነት አላገኘም።
                                            @else
                                                Your KYC verification has been rejected.
                                            @endif
                                        </p>
                                        @if($kyc->rejection_reason)
                                            <p class="mt-1 font-medium">
                                                @if(app()->getLocale() === 'am')
                                                    ምክንያት: {{ $kyc->rejection_reason }}
                                                @else
                                                    Reason: {{ $kyc->rejection_reason }}
                                                @endif
                                            </p>
                                        @endif
                                        <div class="mt-3">
                                            <a href="{{ route('kyc.create') }}" 
                                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                @if(app()->getLocale() === 'am')
                                                    እንደገና ይሞክሩ
                                                @else
                                                    Submit New Application
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Personal Information -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የግል መረጃ
                        @else
                            Personal Information
                        @endif
                    </h3>
                    
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    ሙሉ ስም
                                @else
                                    Full Name
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->full_name }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የወሲብ ዓይነት
                                @else
                                    Gender
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($kyc->gender) }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የልደት ቀን
                                @else
                                    Date of Birth
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->date_of_birth->format('M d, Y') }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    ዜግነት
                                @else
                                    Nationality
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->nationality }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የተወለደበት ቦታ
                                @else
                                    Place of Birth
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->place_of_birth }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Document Information -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የሰነድ መረጃ
                        @else
                            Document Information
                        @endif
                    </h3>
                    
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የሰነድ ዓይነት
                                @else
                                    Document Type
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($kyc->document_type === 'national_id')
                                    @if(app()->getLocale() === 'am')
                                        ብሄራዊ መታወቂያ
                                    @else
                                        National ID
                                    @endif
                                @else
                                    @if(app()->getLocale() === 'am')
                                        ፓስፖርት
                                    @else
                                        Passport
                                    @endif
                                @endif
                            </dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የሰነድ ቁጥር
                                @else
                                    Document Number
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->document_number }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    የሚያበቃበት ቀን
                                @else
                                    Expiry Date
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->document_expiry_date->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Address Information -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የአድራሻ መረጃ
                        @else
                            Address Information
                        @endif
                    </h3>
                    
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    አድራሻ መስመር 1
                                @else
                                    Address Line 1
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->address_line_1 }}</dd>
                        </div>
                        
                        @if($kyc->address_line_2)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">
                                    @if(app()->getLocale() === 'am')
                                        አድራሻ መስመር 2
                                    @else
                                        Address Line 2
                                    @endif
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $kyc->address_line_2 }}</dd>
                            </div>
                        @endif
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    ከተማ
                                @else
                                    City
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->city }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">
                                @if(app()->getLocale() === 'am')
                                    ክልል
                                @else
                                    Region
                                @endif
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $kyc->region }}</dd>
                        </div>
                        
                        @if($kyc->postal_code)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">
                                    @if(app()->getLocale() === 'am')
                                        የፖስታ ኮድ
                                    @else
                                        Postal Code
                                    @endif
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $kyc->postal_code }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Verification Timeline -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የማረጋገጫ ታሪክ
                        @else
                            Verification Timeline
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
                                                        ማመልከቻ ቀርቧል
                                                    @else
                                                        Application submitted
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-400">{{ $kyc->created_at->format('M d, Y \a\t g:i A') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            @if($kyc->status !== 'pending')
                                <li>
                                    <div class="relative">
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full {{ $kyc->status === 'approved' ? 'bg-green-500' : 'bg-red-500' }} flex items-center justify-center ring-8 ring-white">
                                                    @if($kyc->status === 'approved')
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    @else
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">
                                                        @if($kyc->status === 'approved')
                                                            @if(app()->getLocale() === 'am')
                                                                ማረጋገጫ ጸድቋል
                                                            @else
                                                                Verification approved
                                                            @endif
                                                        @else
                                                            @if(app()->getLocale() === 'am')
                                                                ማረጋገጫ ተቀባይነት አላገኘም
                                                            @else
                                                                Verification rejected
                                                            @endif
                                                        @endif
                                                    </p>
                                                    @if($kyc->verified_at)
                                                        <p class="text-xs text-gray-400">{{ $kyc->verified_at->format('M d, Y \a\t g:i A') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Documents -->
                <div class="mt-6 bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if(app()->getLocale() === 'am')
                            የተላኩ ሰነዶች
                        @else
                            Submitted Documents
                        @endif
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                @if(app()->getLocale() === 'am')
                                    የሰነድ ፊት ገጽ
                                @else
                                    Document Front
                                @endif
                            </span>
                            <a href="{{ route('kyc.document.download', [$kyc, 'front']) }}" 
                               class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                                @if(app()->getLocale() === 'am')
                                    አውርድ
                                @else
                                    Download
                                @endif
                            </a>
                        </div>
                        
                        @if($kyc->document_back_path)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">
                                    @if(app()->getLocale() === 'am')
                                        የሰነድ ኋላ ገጽ
                                    @else
                                        Document Back
                                    @endif
                                </span>
                                <a href="{{ route('kyc.document.download', [$kyc, 'back']) }}" 
                                   class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                                    @if(app()->getLocale() === 'am')
                                        አውርድ
                                    @else
                                        Download
                                    @endif
                                </a>
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                @if(app()->getLocale() === 'am')
                                    ሴልፊ ፎቶ
                                @else
                                    Selfie Photo
                                @endif
                            </span>
                            <a href="{{ route('kyc.document.download', [$kyc, 'selfie']) }}" 
                               class="text-blue-600 hover:text-blue-500 text-sm font-medium">
                                @if(app()->getLocale() === 'am')
                                    አውርድ
                                @else
                                    Download
                                @endif
                            </a>
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
                        <a href="{{ route('kyc.index') }}" 
                           class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            @if(app()->getLocale() === 'am')
                                ወደ KYC ዝርዝር ተመለስ
                            @else
                                Back to KYC Overview
                            @endif
                        </a>
                        
                        @if($kyc->status === 'rejected')
                            <a href="{{ route('kyc.create') }}" 
                               class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                @if(app()->getLocale() === 'am')
                                    አዲስ ማመልከቻ ያስገቡ
                                @else
                                    Submit New Application
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
