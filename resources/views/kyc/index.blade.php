@extends('layouts.app')

@section('title', 'KYC Verification')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ app()->getLocale() === 'am' ? 'የማንነት ማረጋገጫ (KYC)' : 'KYC Verification' }}
                    </h1>
                    <p class="text-gray-600 mt-1">
                        {{ app()->getLocale() === 'am' ? 'የእርስዎን ማንነት ያረጋግጡ ተሽከርካሪ ለመከራየት እና ለመግዛት' : 'Verify your identity to rent and purchase vehicles' }}
                    </p>
                </div>
                
                @if($user->canSubmitKyc())
                    <a href="{{ route('kyc.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        {{ app()->getLocale() === 'am' ? 'KYC ማረጋገጫ ጀምር' : 'Start KYC Verification' }}
                    </a>
                @endif
            </div>
        </div>

        <!-- KYC Status Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">
                    {{ app()->getLocale() === 'am' ? 'የማረጋገጫ ሁኔታ' : 'Verification Status' }}
                </h2>
                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $user->getKycStatusBadgeClass() }}">
                    {{ ucfirst(str_replace('_', ' ', $user->kyc_status)) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Verification Level -->
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-900">{{ $user->verification_level }}</div>
                    <div class="text-sm text-gray-600">{{ $user->getVerificationLevelLabel() }}</div>
                </div>

                <!-- KYC Attempts -->
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-900">{{ $user->kyc_attempts }}/3</div>
                    <div class="text-sm text-gray-600">
                        {{ app()->getLocale() === 'am' ? 'የማረጋገጫ ሙከራዎች' : 'Verification Attempts' }}
                    </div>
                </div>

                <!-- Permissions -->
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="space-y-1">
                        <div class="flex items-center justify-center space-x-2">
                            @if($user->can_book)
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <span class="text-sm text-green-600">{{ app()->getLocale() === 'am' ? 'መከራየት' : 'Can Rent' }}</span>
                            @else
                                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                <span class="text-sm text-red-600">{{ app()->getLocale() === 'am' ? 'መከራየት አይችልም' : 'Cannot Rent' }}</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            @if($user->can_purchase)
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <span class="text-sm text-green-600">{{ app()->getLocale() === 'am' ? 'መግዛት' : 'Can Buy' }}</span>
                            @else
                                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                <span class="text-sm text-red-600">{{ app()->getLocale() === 'am' ? 'መግዛት አይችልም' : 'Cannot Buy' }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current KYC Information -->
        @if($currentKyc)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'የአሁኑ KYC ማረጋገጫ' : 'Current KYC Verification' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Document Information -->
                    <div>
                        <h3 class="font-medium text-gray-900 mb-3">
                            {{ app()->getLocale() === 'am' ? 'የሰነድ መረጃ' : 'Document Information' }}
                        </h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'የሰነድ አይነት' : 'Document Type' }}:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $currentKyc->getDocumentTypeLabel() }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'የሰነድ ቁጥር' : 'Document Number' }}:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $currentKyc->document_number }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ሙሉ ስም' : 'Full Name' }}:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $currentKyc->full_name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'የተወለደበት ቀን' : 'Date of Birth' }}:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $currentKyc->date_of_birth->format('M d, Y') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Status Information -->
                    <div>
                        <h3 class="font-medium text-gray-900 mb-3">
                            {{ app()->getLocale() === 'am' ? 'የማረጋገጫ ሁኔታ' : 'Verification Status' }}
                        </h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ሁኔታ' : 'Status' }}:</dt>
                                <dd>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $currentKyc->getStatusBadgeClass() }}">
                                        {{ ucfirst(str_replace('_', ' ', $currentKyc->status)) }}
                                    </span>
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'የቀረበበት ቀን' : 'Submitted' }}:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $currentKyc->created_at->format('M d, Y H:i') }}</dd>
                            </div>
                            @if($currentKyc->verified_at)
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'የተረጋገጠበት ቀን' : 'Verified' }}:</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $currentKyc->verified_at->format('M d, Y H:i') }}</dd>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-600">{{ app()->getLocale() === 'am' ? 'ሙከራ ቁጥር' : 'Attempt' }}:</dt>
                                <dd class="text-sm font-medium text-gray-900">#{{ $currentKyc->attempt_number }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                @if($currentKyc->rejection_reason)
                    <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <h4 class="font-medium text-red-800 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የመቃወም ምክንያት' : 'Rejection Reason' }}
                        </h4>
                        <p class="text-red-700">{{ $currentKyc->rejection_reason }}</p>
                    </div>
                @endif

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('kyc.show', $currentKyc) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        {{ app()->getLocale() === 'am' ? 'ዝርዝር ይመልከቱ' : 'View Details' }}
                    </a>
                    
                    @if($currentKyc->canResubmit() && $user->canSubmitKyc())
                        <a href="{{ route('kyc.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            {{ app()->getLocale() === 'am' ? 'እንደገና ያቅርቡ' : 'Resubmit' }}
                        </a>
                    @endif
                </div>
            </div>
        @else
            <!-- No KYC Submitted -->
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ app()->getLocale() === 'am' ? 'KYC ማረጋገጫ አልተጀመረም' : 'No KYC Verification Started' }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        {{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎችን ለመከራየት እና ለመግዛት የእርስዎን ማንነት ማረጋገጥ ያስፈልጋል።' : 'You need to verify your identity to rent and purchase vehicles.' }}
                    </p>
                    
                    @if($user->canSubmitKyc())
                        <a href="{{ route('kyc.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'KYC ማረጋገጫ ጀምር' : 'Start KYC Verification' }}
                        </a>
                    @else
                        <div class="text-red-600">
                            {{ app()->getLocale() === 'am' ? 'የKYC ማረጋገጫ ሙከራዎች ተጠናቅቀዋል። እባክዎ ድጋፍ ያግኙ።' : 'KYC verification attempts exhausted. Please contact support.' }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
