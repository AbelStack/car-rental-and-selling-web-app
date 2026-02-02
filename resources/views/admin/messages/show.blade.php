@extends('layouts.app')

@section('title', 'Message Details - Admin Panel')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="{{ route('admin.messages.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Message from {{ $message->name }}
                </h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Message Content -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <!-- Message Header -->
                        <div class="border-b border-gray-200 pb-4 mb-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $message->subject }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        From: {{ $message->name }} &lt;{{ $message->email }}&gt;
                                    </p>
                                    @if($message->phone)
                                        <p class="text-sm text-gray-500">
                                            Phone: {{ $message->phone }}
                                        </p>
                                    @endif
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($message->status === 'new') bg-red-100 text-red-800
                                    @elseif($message->status === 'read') bg-yellow-100 text-yellow-800
                                    @elseif($message->status === 'replied') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($message->status) }}
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Received {{ $message->created_at->format('M d, Y \a\t g:i A') }}
                            </p>
                        </div>

                        <!-- Message Body -->
                        <div class="prose max-w-none">
                            <div class="whitespace-pre-wrap text-gray-900">{{ $message->message }}</div>
                        </div>

                        @if($message->replied_at)
                            <!-- Previous Reply -->
                            <div class="mt-8 border-t border-gray-200 pt-6">
                                <h4 class="text-md font-medium text-gray-900 mb-4">Previous Reply</h4>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $message->repliedBy->name ?? 'Admin' }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $message->replied_at->format('M d, Y \a\t g:i A') }}
                                        </p>
                                    </div>
                                    <div class="whitespace-pre-wrap text-gray-700">{{ $message->admin_reply }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reply Form -->
                @if($message->status !== 'replied')
                    <div class="mt-6 bg-white shadow rounded-lg">
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="px-4 pt-5 sm:px-6">
                                <div class="rounded-md bg-green-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="px-4 pt-5 sm:px-6">
                                <div class="rounded-md bg-red-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('admin.messages.reply', $message) }}" method="POST" id="replyForm">
                            @csrf
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                    Send Reply
                                </h3>
                                
                                <div>
                                    <label for="reply_message" class="block text-sm font-medium text-gray-700">Reply Message</label>
                                    <textarea name="reply_message" id="reply_message" rows="6" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('reply_message') border-red-300 @enderror"
                                        placeholder="Type your reply here...">{{ old('reply_message') }}</textarea>
                                    @error('reply_message')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-4 flex items-center">
                                    <input type="checkbox" name="send_email" id="send_email" value="1" 
                                           {{ old('send_email', true) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <label for="send_email" class="ml-2 text-sm text-gray-700">
                                        Send reply via email to {{ $message->email }}
                                    </label>
                                </div>
                                
                                <div class="mt-2 text-xs text-gray-500">
                                    <p>💡 <strong>Tip:</strong> When "Send reply via email" is checked, the customer will receive your response directly in their inbox.</p>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" id="submitBtn"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span id="submitText">Send Reply</span>
                                    <svg id="loadingSpinner" class="hidden animate-spin -mr-1 ml-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Message Info -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Message Information</h3>
                        
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($message->status === 'new') bg-red-100 text-red-800
                                        @elseif($message->status === 'read') bg-yellow-100 text-yellow-800
                                        @elseif($message->status === 'replied') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                </dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Received</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $message->created_at->format('M d, Y \a\t g:i A') }}</dd>
                            </div>
                            
                            @if($message->read_at)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Read</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $message->read_at->format('M d, Y \a\t g:i A') }}</dd>
                                </div>
                            @endif
                            
                            @if($message->replied_at)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Replied</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $message->replied_at->format('M d, Y \a\t g:i A') }}</dd>
                                </div>
                                
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Replied By</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $message->repliedBy->name ?? 'Admin' }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Contact Information</h3>
                        
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $message->name }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:{{ $message->email }}" class="text-blue-600 hover:text-blue-500">
                                        {{ $message->email }}
                                    </a>
                                </dd>
                            </div>
                            
                            @if($message->phone)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a href="tel:{{ $message->phone }}" class="text-blue-600 hover:text-blue-500">
                                            {{ $message->phone }}
                                        </a>
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                        
                        <div class="space-y-3">
                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Reply via Email Client
                            </a>
                            
                            @if($message->phone)
                                <a href="tel:{{ $message->phone }}" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Call {{ $message->phone }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const replyForm = document.getElementById('replyForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const replyTextarea = document.getElementById('reply_message');
    const sendEmailCheckbox = document.getElementById('send_email');

    // Form submission handling
    if (replyForm) {
        replyForm.addEventListener('submit', function(e) {
            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Sending...';
            loadingSpinner.classList.remove('hidden');
            
            // Add visual feedback
            submitBtn.classList.add('opacity-75');
        });
    }

    // Auto-resize textarea
    if (replyTextarea) {
        replyTextarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Character counter
        const maxLength = 2000;
        const counter = document.createElement('div');
        counter.className = 'text-xs text-gray-500 mt-1 text-right';
        counter.id = 'charCounter';
        replyTextarea.parentNode.appendChild(counter);
        
        function updateCounter() {
            const remaining = maxLength - replyTextarea.value.length;
            counter.textContent = `${replyTextarea.value.length}/${maxLength} characters`;
            
            if (remaining < 100) {
                counter.className = 'text-xs text-orange-500 mt-1 text-right';
            } else if (remaining < 0) {
                counter.className = 'text-xs text-red-500 mt-1 text-right font-medium';
            } else {
                counter.className = 'text-xs text-gray-500 mt-1 text-right';
            }
        }
        
        replyTextarea.addEventListener('input', updateCounter);
        updateCounter(); // Initial count
    }

    // Email checkbox feedback
    if (sendEmailCheckbox) {
        sendEmailCheckbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.classList.add('font-medium', 'text-blue-700');
                label.classList.remove('text-gray-700');
            } else {
                label.classList.remove('font-medium', 'text-blue-700');
                label.classList.add('text-gray-700');
            }
        });
        
        // Trigger initial state
        sendEmailCheckbox.dispatchEvent(new Event('change'));
    }

    // Auto-save draft (optional enhancement)
    let draftTimeout;
    if (replyTextarea) {
        replyTextarea.addEventListener('input', function() {
            clearTimeout(draftTimeout);
            draftTimeout = setTimeout(() => {
                const draft = this.value;
                if (draft.length > 10) {
                    localStorage.setItem(`reply_draft_{{ $message->id }}`, draft);
                    
                    // Show draft saved indicator
                    let indicator = document.getElementById('draftIndicator');
                    if (!indicator) {
                        indicator = document.createElement('div');
                        indicator.id = 'draftIndicator';
                        indicator.className = 'text-xs text-green-600 mt-1';
                        this.parentNode.appendChild(indicator);
                    }
                    indicator.textContent = '✓ Draft saved';
                    
                    setTimeout(() => {
                        if (indicator) indicator.textContent = '';
                    }, 2000);
                }
            }, 1000);
        });
        
        // Load draft on page load
        const savedDraft = localStorage.getItem(`reply_draft_{{ $message->id }}`);
        if (savedDraft && !replyTextarea.value) {
            replyTextarea.value = savedDraft;
            replyTextarea.dispatchEvent(new Event('input'));
        }
    }

    // Clear draft after successful submission
    const successMessage = document.querySelector('.bg-green-50');
    if (successMessage) {
        localStorage.removeItem(`reply_draft_{{ $message->id }}`);
    }

    console.log('✅ Admin reply system initialized');
});
</script>
@endpush
