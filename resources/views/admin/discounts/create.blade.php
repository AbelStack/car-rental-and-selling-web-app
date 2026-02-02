@extends('layouts.app')

@section('title', 'Create Discount - Admin')

@section('content')
<div class="min-h-screen bg-soft-white py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.discounts.index') }}" 
                   class="inline-flex items-center text-slate-600 hover:text-neon-blue transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Discounts
                </a>
            </div>
            <h1 class="text-3xl font-bold text-slate-900">Create New Discount</h1>
            <p class="text-slate-600 mt-2">Set up a new discount for your rental or sales business</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.discounts.store') }}" method="POST" id="discount-form">
                @csrf
                
                <div class="p-6 space-y-6">
                    
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Discount Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent @error('name') border-red-500 @enderror"
                                       placeholder="e.g., Christmas Special">
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-slate-700 mb-2">Discount Type *</label>
                                <select name="type" id="type" required onchange="toggleTypeFields()"
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent @error('type') border-red-500 @enderror">
                                    <option value="">Select Type</option>
                                    <option value="holiday" {{ old('type') === 'holiday' ? 'selected' : '' }}>Holiday Discount</option>
                                    <option value="duration" {{ old('type') === 'duration' ? 'selected' : '' }}>Duration Discount</option>
                                </select>
                                @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="percentage" class="block text-sm font-medium text-slate-700 mb-2">Discount Percentage *</label>
                                <div class="relative">
                                    <input type="number" name="percentage" id="percentage" value="{{ old('percentage') }}" 
                                           step="0.01" min="0.01" max="50" required
                                           class="w-full px-3 py-2 pr-8 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent @error('percentage') border-red-500 @enderror"
                                           placeholder="5.00">
                                    <span class="absolute right-3 top-2 text-slate-500">%</span>
                                </div>
                                @error('percentage')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-slate-500">Maximum 50%</p>
                            </div>

                            <div>
                                <label for="applies_to" class="block text-sm font-medium text-slate-700 mb-2">Applies To *</label>
                                <select name="applies_to" id="applies_to" required
                                        class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent @error('applies_to') border-red-500 @enderror">
                                    <option value="">Select Application</option>
                                    <option value="rental" {{ old('applies_to') === 'rental' ? 'selected' : '' }}>Rental Only</option>
                                    <option value="selling" {{ old('applies_to') === 'selling' ? 'selected' : '' }}>Selling Only</option>
                                    <option value="both" {{ old('applies_to') === 'both' ? 'selected' : '' }}>Both Rental & Selling</option>
                                </select>
                                @error('applies_to')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent @error('description') border-red-500 @enderror"
                                      placeholder="Optional description of the discount">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Holiday Discount Fields -->
                    <div id="holiday-fields" class="hidden">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Holiday Period</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-slate-700 mb-2">Start Date *</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent @error('start_date') border-red-500 @enderror">
                                @error('start_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-slate-700 mb-2">End Date *</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent @error('end_date') border-red-500 @enderror">
                                @error('end_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Duration Discount Fields -->
                    <div id="duration-fields" class="hidden">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Duration Conditions</h3>
                        <div class="bg-slate-50 rounded-lg p-4 mb-4">
                            <p class="text-sm text-slate-600 mb-2">
                                <strong>Note:</strong> Duration discounts apply automatically based on rental length. 
                                You can define multiple tiers (e.g., 7-13 days = 3%, 14+ days = 6%).
                            </p>
                        </div>
                        
                        <div id="conditions-container">
                            <div class="condition-row grid grid-cols-1 md:grid-cols-4 gap-4 items-end mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Min Days</label>
                                    <input type="number" name="conditions[0][min_days]" min="1" 
                                           class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                                           placeholder="7">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Max Days (Optional)</label>
                                    <input type="number" name="conditions[0][max_days]" min="1" 
                                           class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                                           placeholder="13">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Percentage</label>
                                    <div class="relative">
                                        <input type="number" name="conditions[0][percentage]" step="0.01" min="0.01" max="50" 
                                               class="w-full px-3 py-2 pr-8 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                                               placeholder="3.00">
                                        <span class="absolute right-3 top-2 text-slate-500">%</span>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" onclick="removeCondition(this)" 
                                            class="w-full px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" onclick="addCondition()" 
                                class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Another Condition
                        </button>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end space-x-3">
                    <a href="{{ route('admin.discounts.index') }}" 
                       class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-neon-blue text-white rounded-lg hover:bg-blue-dark transition-all duration-200 shadow-sm">
                        Create Discount
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let conditionIndex = 1;

function toggleTypeFields() {
    const type = document.getElementById('type').value;
    const holidayFields = document.getElementById('holiday-fields');
    const durationFields = document.getElementById('duration-fields');
    
    if (type === 'holiday') {
        holidayFields.classList.remove('hidden');
        durationFields.classList.add('hidden');
        
        // Make holiday fields required
        document.getElementById('start_date').required = true;
        document.getElementById('end_date').required = true;
    } else if (type === 'duration') {
        holidayFields.classList.add('hidden');
        durationFields.classList.remove('hidden');
        
        // Remove holiday field requirements
        document.getElementById('start_date').required = false;
        document.getElementById('end_date').required = false;
    } else {
        holidayFields.classList.add('hidden');
        durationFields.classList.add('hidden');
        
        // Remove all requirements
        document.getElementById('start_date').required = false;
        document.getElementById('end_date').required = false;
    }
}

function addCondition() {
    const container = document.getElementById('conditions-container');
    const newCondition = document.createElement('div');
    newCondition.className = 'condition-row grid grid-cols-1 md:grid-cols-4 gap-4 items-end mb-4';
    newCondition.innerHTML = `
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Min Days</label>
            <input type="number" name="conditions[${conditionIndex}][min_days]" min="1" 
                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                   placeholder="14">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Max Days (Optional)</label>
            <input type="number" name="conditions[${conditionIndex}][max_days]" min="1" 
                   class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                   placeholder="Leave empty for no limit">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Percentage</label>
            <div class="relative">
                <input type="number" name="conditions[${conditionIndex}][percentage]" step="0.01" min="0.01" max="50" 
                       class="w-full px-3 py-2 pr-8 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                       placeholder="6.00">
                <span class="absolute right-3 top-2 text-slate-500">%</span>
            </div>
        </div>
        <div>
            <button type="button" onclick="removeCondition(this)" 
                    class="w-full px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                Remove
            </button>
        </div>
    `;
    container.appendChild(newCondition);
    conditionIndex++;
}

function removeCondition(button) {
    const conditionRows = document.querySelectorAll('.condition-row');
    if (conditionRows.length > 1) {
        button.closest('.condition-row').remove();
    }
}

// Initialize form based on old input (for validation errors)
document.addEventListener('DOMContentLoaded', function() {
    const type = document.getElementById('type').value;
    if (type) {
        toggleTypeFields();
    }
});
</script>
@endsection