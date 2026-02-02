{{-- 🔍 SMART SEARCH BAR COMPONENT - PREMIUM DESIGN --}}
<div class="smart-search-container relative z-30" id="smartSearchContainer">
    <!-- Search Bar Main Container -->
    <div class="search-bar-wrapper relative">
        <!-- Enhanced Search Input with Premium Styling -->
        <div class="search-input-container relative group">
            <div class="search-input-backdrop absolute inset-0 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 group-focus-within:shadow-3xl group-focus-within:bg-white transition-all duration-300"></div>
            
            <!-- Search Icon -->
            <div class="absolute left-6 top-1/2 transform -translate-y-1/2 z-10">
                <svg class="w-6 h-6 text-slate-400 group-focus-within:text-neon-blue transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            
            <!-- Main Search Input -->
            <input 
                type="text" 
                id="smartSearchInput"
                class="smart-search-input relative z-10 w-full pl-16 pr-32 py-6 bg-transparent text-lg font-medium text-slate-800 placeholder-slate-500 border-none outline-none"
                placeholder="{{ app()->getLocale() === 'am' ? 'ተሽከርካሪ ይፈልጉ... (ምሳሌ: ቶዮታ ኪራይ, SUV ግዢ)' : 'Search cars to rent or buy... (e.g., Toyota rent, SUV buy)' }}"
                autocomplete="off"
                spellcheck="false"
            >
            
            <!-- Search Mode Toggle -->
            <div class="absolute right-6 top-1/2 transform -translate-y-1/2 z-10">
                <div class="search-mode-toggle flex items-center bg-slate-100 rounded-full p-1 border border-slate-200">
                    <button type="button" class="mode-btn active" data-mode="rent" id="rentModeBtn">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-semibold">{{ app()->getLocale() === 'am' ? 'ኪራይ' : 'Rent' }}</span>
                    </button>
                    <button type="button" class="mode-btn" data-mode="buy" id="buyModeBtn">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="text-sm font-semibold">{{ app()->getLocale() === 'am' ? 'ግዢ' : 'Buy' }}</span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Search Suggestions Dropdown -->
        <div class="search-suggestions absolute top-full left-0 right-0 mt-2 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 max-h-96 overflow-y-auto hidden" id="searchSuggestions">
            <div class="suggestions-content p-4">
                <!-- Dynamic suggestions will be populated here -->
            </div>
        </div>
    </div>
    
    <!-- QuickSearch Chips --> 
    <div class="quick-search-chips mt-6 opacity-0 transform translate-y-4" style="animation: slideInUp 0.6s ease-out 2.1s forwards;">
        <div class="flex flex-wrap gap-3 justify-center">
            <button class="quick-chip" data-search="rent SUV" data-mode="rent" onclick="handleQuickChipClick(this)">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                {{ app()->getLocale() === 'am' ? 'SUV ኪራይ' : 'Rent SUV' }}
            </button>
            
            <button class="quick-chip" data-search="cheap rentals" data-mode="rent" onclick="handleQuickChipClick(this)">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
                {{ app()->getLocale() === 'am' ? 'ርካሽ ኪራይ' : 'Cheap Rentals' }}
            </button>
            
            <button class="quick-chip" data-search="buy Toyota" data-mode="buy" onclick="handleQuickChipClick(this)">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                {{ app()->getLocale() === 'am' ? 'ቶዮታ ግዢ' : 'Buy Toyota' }}
            </button>
            
            <button class="quick-chip" data-search="electric cars" data-mode="buy" onclick="handleQuickChipClick(this)">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                {{ app()->getLocale() === 'am' ? 'ኤሌክትሪክ መኪናዎች' : 'Electric Cars' }}
            </button>
            
            <button class="quick-chip" data-search="automatic transmission" data-mode="rent" onclick="handleQuickChipClick(this)">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ app()->getLocale() === 'am' ? 'አውቶማቲክ' : 'Automatic' }}
            </button>
            
            <button class="quick-chip" data-search="top deals" data-mode="buy" onclick="handleQuickChipClick(this)">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                {{ app()->getLocale() === 'am' ? 'ምርጥ ዲልዎች' : 'Top Deals' }}
            </button>
        </div>
    </div>
    

</div>

<script>
// Immediate Quick Chip functionality (inline backup)
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 Quick Chip inline script loaded');
    
    // Test if chips are clickable
    const chips = document.querySelectorAll('.quick-chip');
    console.log('Found', chips.length, 'quick chips');
    
    // Add click listeners as backup
    chips.forEach(chip => {
        chip.addEventListener('click', function(e) {
            console.log('🔍 Inline chip click detected');
            if (typeof handleQuickChipClick === 'function') {
                handleQuickChipClick(this);
            }
        });
    });
});
</script>

<style>
/* Smart Search Bar Styles */
.smart-search-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1rem;
}

.search-input-container {
    position: relative;
    height: 80px;
}

.smart-search-input {
    font-size: 1.125rem;
    line-height: 1.5;
}

.smart-search-input:focus {
    outline: none;
}

.smart-search-input::placeholder {
    color: #64748b;
    font-weight: 400;
}

/* Search Mode Toggle */
.search-mode-toggle {
    background: rgba(248, 250, 252, 0.9);
    backdrop-filter: blur(8px);
}

.mode-btn {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #64748b;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.mode-btn.active {
    background: #2563eb;
    color: white;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.mode-btn:hover:not(.active) {
    background: rgba(37, 99, 235, 0.1);
    color: #2563eb;
}

/* Quick Search Chips */
.quick-search-chips {
    margin-top: 1.5rem;
    position: relative;
    z-index: 20;
}

.quick-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #475569;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    pointer-events: auto;
    position: relative;
    z-index: 10;
}

.quick-chip:hover {
    background: rgba(37, 99, 235, 0.95);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
}

.quick-chip:active {
    transform: translateY(0);
}

/* Search Suggestions */
.search-suggestions {
    z-index: 50;
    max-height: 400px;
    overflow-y: auto;
}

.suggestion-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    cursor: pointer;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.suggestion-item:hover {
    background: rgba(37, 99, 235, 0.1);
}

.suggestion-icon {
    width: 1rem;
    height: 1rem;
    margin-right: 0.75rem;
    color: #64748b;
}

.suggestion-text {
    font-size: 0.875rem;
    color: #374151;
}

.suggestion-category {
    font-size: 0.75rem;
    color: #9ca3af;
    margin-left: auto;
}

/* Animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse-soft {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

.animate-pulse-soft {
    animation: pulse-soft 2s ease-in-out infinite;
}

/* Responsive Design */
@media (max-width: 768px) {
    .smart-search-container {
        padding: 0 0.5rem;
    }
    
    .search-input-container {
        height: 70px;
    }
    
    .smart-search-input {
        font-size: 1rem;
        padding-left: 3rem;
        padding-right: 8rem;
    }
    
    .quick-search-chips {
        margin-top: 1rem;
    }
    
    .quick-chip {
        padding: 0.5rem 1rem;
        font-size: 0.8125rem;
    }
    
    .mode-btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.8125rem;
    }
}

/* Focus and Active States */
.search-input-container:focus-within .search-input-backdrop {
    background: rgba(255, 255, 255, 0.98);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(37, 99, 235, 0.1);
    border-color: rgba(37, 99, 235, 0.2);
}

/* Loading State */
.search-loading {
    position: absolute;
    right: 8rem;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
}

.search-spinner {
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #e5e7eb;
    border-top-color: #2563eb;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>