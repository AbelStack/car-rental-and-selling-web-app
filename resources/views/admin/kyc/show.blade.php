@extends('layouts.app')

@section('title', 'KYC Verification Details - Admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">KYC Verification Details</h1>
            <p class="text-gray-600">Review and verify user identity documents</p>
        </div>
        <a href="{{ route('admin.kyc.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            ← Back to KYC List
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Information -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">User Information</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Name</label>
                        <p class="text-gray-900">{{ $kyc->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="text-gray-900">{{ $kyc->user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Phone</label>
                        <p class="text-gray-900">{{ $kyc->user->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Registration Date</label>
                        <p class="text-gray-900">{{ $kyc->user->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Current KYC Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $kyc->user->getKycStatusBadgeClass() }}">
                            {{ ucfirst(str_replace('_', ' ', $kyc->user->kyc_status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Verification Status -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Verification Status</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $kyc->getStatusBadgeClass() }}">
                            {{ ucfirst(str_replace('_', ' ', $kyc->status)) }}
                        </span>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Submitted</label>
                        <p class="text-gray-900">{{ $kyc->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Attempt Number</label>
                        <p class="text-gray-900">#{{ $kyc->attempt_number }} of 3</p>
                    </div>
                    @if($kyc->verified_at)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Verified At</label>
                            <p class="text-gray-900">{{ $kyc->verified_at->format('M d, Y H:i') }}</p>
                        </div>
                    @endif
                    @if($kyc->verifiedBy)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Verified By</label>
                            <p class="text-gray-900">{{ $kyc->verifiedBy->name }}</p>
                        </div>
                    @endif
                    @if($kyc->rejection_reason)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Rejection Reason</label>
                            <p class="text-red-700 bg-red-50 p-3 rounded-lg">{{ $kyc->rejection_reason }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Document Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Document Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Document Type</label>
                            <p class="text-gray-900">{{ $kyc->getDocumentTypeLabel() }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Document Number</label>
                            <p class="text-gray-900 font-mono">{{ $kyc->document_number }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Full Name (on document)</label>
                            <p class="text-gray-900">{{ $kyc->full_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date of Birth</label>
                            <p class="text-gray-900">{{ $kyc->date_of_birth->format('M d, Y') }} (Age: {{ $kyc->getAge() }})</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Gender</label>
                            <p class="text-gray-900">{{ ucfirst($kyc->gender) }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nationality</label>
                            <p class="text-gray-900">{{ $kyc->nationality }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        @if($kyc->document_expiry_date)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Document Expiry</label>
                                <p class="text-gray-900">{{ $kyc->document_expiry_date->format('M d, Y') }}</p>
                            </div>
                        @endif
                        @if($kyc->place_of_birth)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Place of Birth</label>
                                <p class="text-gray-900">{{ $kyc->place_of_birth }}</p>
                            </div>
                        @endif
                        <div>
                            <label class="text-sm font-medium text-gray-500">Address</label>
                            <p class="text-gray-900">
                                {{ $kyc->address_line_1 }}<br>
                                @if($kyc->address_line_2){{ $kyc->address_line_2 }}<br>@endif
                                {{ $kyc->city }}, {{ $kyc->region }}
                                @if($kyc->postal_code) {{ $kyc->postal_code }}@endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Images -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Document Images</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Document Front -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Document Front</h3>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                            <a href="{{ route('admin.kyc.document.download', [$kyc, 'front']) }}" 
                               class="text-blue-600 hover:text-blue-800" target="_blank">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm">View Document Front</p>
                            </a>
                        </div>
                    </div>

                    <!-- Document Back -->
                    @if($kyc->document_back_path)
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Document Back</h3>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                <a href="{{ route('admin.kyc.document.download', [$kyc, 'back']) }}" 
                                   class="text-blue-600 hover:text-blue-800" target="_blank">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm">View Document Back</p>
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Selfie -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Selfie Photo</h3>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                            <a href="{{ route('admin.kyc.document.download', [$kyc, 'selfie']) }}" 
                               class="text-blue-600 hover:text-blue-800" target="_blank">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <p class="text-sm">View Selfie</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @if($kyc->isPending())
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                    <div class="flex space-x-4">
                        <!-- Approve Button -->
                        <form action="{{ route('admin.kyc.approve', $kyc) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors"
                                    onclick="return confirm('Are you sure you want to approve this KYC verification? This will grant the user full access to booking and purchasing.')">
                                ✓ Approve KYC
                            </button>
                        </form>

                        <!-- Reject Button -->
                        <button onclick="showRejectModal()" 
                                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            ✗ Reject KYC
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <form action="{{ route('admin.kyc.reject', $kyc) }}" method="POST">
                @csrf
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Reject KYC Verification</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason *</label>
                        <textarea name="rejection_reason" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Please provide a detailed reason for rejection..." required></textarea>
                        <p class="text-xs text-gray-500 mt-1">This reason will be shown to the user so they can correct the issues.</p>
                    </div>
                    
                    <!-- Common rejection reasons -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Common Reasons (click to use)</label>
                        <div class="space-y-1">
                            <button type="button" onclick="setRejectionReason('Document image is blurry or unclear. Please upload a clearer photo.')" 
                                    class="block w-full text-left text-xs text-blue-600 hover:text-blue-800 p-1">
                                • Document image is blurry or unclear
                            </button>
                            <button type="button" onclick="setRejectionReason('Selfie photo does not match the ID document photo. Please retake the selfie.')" 
                                    class="block w-full text-left text-xs text-blue-600 hover:text-blue-800 p-1">
                                • Selfie doesn't match ID photo
                            </button>
                            <button type="button" onclick="setRejectionReason('Document appears to be expired. Please upload a valid, non-expired document.')" 
                                    class="block w-full text-left text-xs text-blue-600 hover:text-blue-800 p-1">
                                • Document appears to be expired
                            </button>
                            <button type="button" onclick="setRejectionReason('Information provided does not match the document details. Please verify all information is correct.')" 
                                    class="block w-full text-left text-xs text-blue-600 hover:text-blue-800 p-1">
                                • Information doesn't match document
                            </button>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-3 bg-gray-50 flex justify-end space-x-3">
                    <button type="button" onclick="hideRejectModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700">
                        Reject KYC
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showRejectModal() {
    document.getElementById('rejectModal').classList.remove('hidden');
}

function hideRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.querySelector('textarea[name="rejection_reason"]').value = '';
}

function setRejectionReason(reason) {
    document.querySelector('textarea[name="rejection_reason"]').value = reason;
}
</script>
@endsection
