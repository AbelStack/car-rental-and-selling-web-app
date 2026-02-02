/**
 * 🔍 SMART SEARCH BAR - INTELLIGENT SEARCH SYSTEM
 * Premium JavaScript implementation for car rental & sales search
 */

class SmartSearchBar {
    constructor() {
        this.searchInput = document.getElementById('smartSearchInput');
        this.searchSuggestions = document.getElementById('searchSuggestions');
        this.rentModeBtn = document.getElementById('rentModeBtn');
        this.buyModeBtn = document.getElementById('buyModeBtn');
        
        this.currentMode = 'rent'; // Default mode
        this.searchTimeout = null;
        this.isLoading = false;
        
        // Search patterns and keywords
        this.searchPatterns = {
            brands: ['toyota', 'mercedes', 'bmw', 'ford', 'honda', 'nissan', 'hyundai', 'kia', 'volkswagen', 'audi'],
            categories: ['suv', 'sedan', 'pickup', 'hatchback', 'coupe', 'convertible', 'wagon', 'minivan'],
            purposes: ['rent', 'buy', 'rental', 'purchase', 'lease'],
            budgets: ['cheap', 'budget', 'affordable', 'premium', 'luxury', 'under', 'below', 'birr', 'etb'],
            fuel: ['electric', 'diesel', 'gasoline', 'hybrid', 'petrol', 'gas'],
            transmission: ['automatic', 'manual', 'cvt', 'auto'],
            features: ['4wd', '4x4', 'awd', 'sunroof', 'leather', 'gps', 'bluetooth']
        };
        
        // Amharic translations
        this.amharicTerms = {
            'ኪራይ': 'rent',
            'ግዢ': 'buy',
            'ቶዮታ': 'toyota',
            'መርሴዲስ': 'mercedes',
            'ቢኤምደብሊው': 'bmw',
            'ፎርድ': 'ford',
            'ሆንዳ': 'honda',
            'ኒሳን': 'nissan',
            'ሃይንዳይ': 'hyundai',
            'ኪያ': 'kia',
            'ኤስዩቪ': 'suv',
            'ሴዳን': 'sedan',
            'ፒክአፕ': 'pickup',
            'ኤሌክትሪክ': 'electric',
            'ዲዘል': 'diesel',
            'ቤንዚን': 'gasoline',
            'አውቶማቲክ': 'automatic',
            'ማኑዋል': 'manual',
            'ርካሽ': 'cheap',
            'ቡድጀት': 'budget',
            'ብር': 'birr'
        };
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        
        // Debug: Check if quick chips are found
        const quickChips = document.querySelectorAll('.quick-chip');
        console.log('🔍 Smart Search Bar initialized');
        console.log('🎯 Found', quickChips.length, 'quick chips');
        
        // Add a simple test click handler to verify chips are clickable
        quickChips.forEach((chip, index) => {
            console.log(`Chip ${index}:`, chip.dataset.search, chip.dataset.mode);
        });
    }
    
    bindEvents() {
        // Search input events
        this.searchInput.addEventListener('input', (e) => this.handleSearchInput(e));
        this.searchInput.addEventListener('focus', () => this.handleSearchFocus());
        this.searchInput.addEventListener('blur', () => this.handleSearchBlur());
        this.searchInput.addEventListener('keydown', (e) => this.handleKeydown(e));
        
        // Mode toggle events
        this.rentModeBtn.addEventListener('click', () => this.setMode('rent'));
        this.buyModeBtn.addEventListener('click', () => this.setMode('buy'));
        
        // Quick chip events - Use event delegation for better reliability
        document.addEventListener('click', (e) => {
            if (e.target.closest('.quick-chip')) {
                this.handleQuickChip(e);
            }
        });
        
        // Click outside to close suggestions
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.smart-search-container')) {
                this.hideSuggestions();
            }
        });
    }
    
    handleSearchInput(e) {
        const query = e.target.value.trim();
        
        // Clear previous timeout
        if (this.searchTimeout) {
            clearTimeout(this.searchTimeout);
        }
        
        // Debounce search
        this.searchTimeout = setTimeout(() => {
            if (query.length >= 2) {
                this.performSearch(query);
            } else {
                this.hideSuggestions();
            }
        }, 300);
    }
    
    handleSearchFocus() {
        const query = this.searchInput.value.trim();
        if (query.length >= 2) {
            this.showSuggestions();
        }
    }
    
    handleSearchBlur() {
        // Delay hiding to allow clicking on suggestions
        setTimeout(() => {
            this.hideSuggestions();
        }, 200);
    }
    
    handleKeydown(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.executeSearch(this.searchInput.value.trim());
        } else if (e.key === 'Escape') {
            this.hideSuggestions();
            this.searchInput.blur();
        }
    }
    
    handleQuickChip(e) {
        const chip = e.target.closest('.quick-chip');
        if (!chip) return;
        
        e.preventDefault();
        e.stopPropagation();
        
        const searchTerm = chip.dataset.search;
        const mode = chip.dataset.mode;
        
        console.log('🔍 Quick chip clicked:', { searchTerm, mode });
        
        // Set mode and search term
        this.setMode(mode);
        this.searchInput.value = searchTerm;
        
        // Add visual feedback
        chip.style.transform = 'scale(0.95)';
        setTimeout(() => {
            chip.style.transform = '';
        }, 150);
        
        // Execute search
        setTimeout(() => {
            this.executeSearch(searchTerm);
        }, 200);
    }
    
    setMode(mode) {
        this.currentMode = mode;
        
        // Update button states
        this.rentModeBtn.classList.toggle('active', mode === 'rent');
        this.buyModeBtn.classList.toggle('active', mode === 'buy');
        
        // Update placeholder
        const placeholder = mode === 'rent' 
            ? (document.documentElement.lang === 'am' 
                ? 'ለኪራይ ተሽከርካሪ ይፈልጉ... (ምሳሌ: ቶዮታ SUV)'
                : 'Search cars to rent... (e.g., Toyota SUV)')
            : (document.documentElement.lang === 'am'
                ? 'ለግዢ ተሽከርካሪ ይፈልጉ... (ምሳሌ: መርሴዲስ ሴዳን)'
                : 'Search cars to buy... (e.g., Mercedes sedan)');
        
        this.searchInput.placeholder = placeholder;
        
        console.log(`🔄 Search mode changed to: ${mode}`);
    }
    
    performSearch(query) {
        this.showLoading();
        
        // Simulate API call delay
        setTimeout(() => {
            const suggestions = this.generateSuggestions(query);
            this.displaySuggestions(suggestions);
            this.hideLoading();
        }, 200);
    }
    
    generateSuggestions(query) {
        const normalizedQuery = this.normalizeQuery(query.toLowerCase());
        const suggestions = [];
        
        // Brand suggestions
        this.searchPatterns.brands.forEach(brand => {
            if (brand.includes(normalizedQuery) || normalizedQuery.includes(brand)) {
                suggestions.push({
                    type: 'brand',
                    text: `${this.capitalize(brand)} ${this.currentMode === 'rent' ? 'rentals' : 'for sale'}`,
                    query: `${brand} ${this.currentMode}`,
                    icon: 'car',
                    category: 'Brand'
                });
            }
        });
        
        // Category suggestions
        this.searchPatterns.categories.forEach(category => {
            if (category.includes(normalizedQuery) || normalizedQuery.includes(category)) {
                suggestions.push({
                    type: 'category',
                    text: `${this.capitalize(category)} ${this.currentMode === 'rent' ? 'rentals' : 'for sale'}`,
                    query: `${category} ${this.currentMode}`,
                    icon: 'category',
                    category: 'Type'
                });
            }
        });
        
        // Budget suggestions
        if (normalizedQuery.includes('cheap') || normalizedQuery.includes('budget') || normalizedQuery.includes('affordable')) {
            suggestions.push({
                type: 'budget',
                text: `Affordable ${this.currentMode === 'rent' ? 'rentals' : 'cars for sale'}`,
                query: `cheap ${this.currentMode}`,
                icon: 'dollar',
                category: 'Budget'
            });
        }
        
        // Fuel type suggestions
        this.searchPatterns.fuel.forEach(fuel => {
            if (fuel.includes(normalizedQuery) || normalizedQuery.includes(fuel)) {
                suggestions.push({
                    type: 'fuel',
                    text: `${this.capitalize(fuel)} cars ${this.currentMode === 'rent' ? 'for rent' : 'for sale'}`,
                    query: `${fuel} ${this.currentMode}`,
                    icon: 'fuel',
                    category: 'Fuel Type'
                });
            }
        });
        
        // Transmission suggestions
        this.searchPatterns.transmission.forEach(trans => {
            if (trans.includes(normalizedQuery) || normalizedQuery.includes(trans)) {
                suggestions.push({
                    type: 'transmission',
                    text: `${this.capitalize(trans)} transmission`,
                    query: `${trans} ${this.currentMode}`,
                    icon: 'gear',
                    category: 'Transmission'
                });
            }
        });
        
        // Limit suggestions
        return suggestions.slice(0, 8);
    }
    
    normalizeQuery(query) {
        // Convert Amharic terms to English
        let normalized = query;
        Object.keys(this.amharicTerms).forEach(amharic => {
            normalized = normalized.replace(amharic, this.amharicTerms[amharic]);
        });
        return normalized;
    }
    
    displaySuggestions(suggestions) {
        const container = this.searchSuggestions.querySelector('.suggestions-content');
        
        if (suggestions.length === 0) {
            container.innerHTML = `
                <div class="text-center py-8 text-slate-500">
                    <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p>${document.documentElement.lang === 'am' ? 'ምንም ውጤት አልተገኘም' : 'No suggestions found'}</p>
                </div>
            `;
        } else {
            container.innerHTML = suggestions.map(suggestion => `
                <div class="suggestion-item" data-query="${suggestion.query}">
                    <div class="suggestion-icon">
                        ${this.getIconSVG(suggestion.icon)}
                    </div>
                    <span class="suggestion-text">${suggestion.text}</span>
                    <span class="suggestion-category">${suggestion.category}</span>
                </div>
            `).join('');
            
            // Bind click events
            container.querySelectorAll('.suggestion-item').forEach(item => {
                item.addEventListener('click', (e) => {
                    const query = e.currentTarget.dataset.query;
                    this.executeSearch(query);
                });
            });
        }
        
        this.showSuggestions();
    }
    
    showSuggestions() {
        this.searchSuggestions.classList.remove('hidden');
        setTimeout(() => {
            this.searchSuggestions.style.opacity = '1';
            this.searchSuggestions.style.transform = 'translateY(0)';
        }, 10);
    }
    
    hideSuggestions() {
        this.searchSuggestions.style.opacity = '0';
        this.searchSuggestions.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            this.searchSuggestions.classList.add('hidden');
        }, 200);
    }
    
    showLoading() {
        if (this.isLoading) return;
        this.isLoading = true;
        
        const loadingHTML = `
            <div class="search-loading">
                <div class="search-spinner"></div>
            </div>
        `;
        
        this.searchInput.parentElement.insertAdjacentHTML('beforeend', loadingHTML);
    }
    
    hideLoading() {
        this.isLoading = false;
        const loading = this.searchInput.parentElement.querySelector('.search-loading');
        if (loading) {
            loading.remove();
        }
    }
    
    executeSearch(query) {
        if (!query.trim()) return;
        
        // Determine search intent and redirect
        const intent = this.analyzeSearchIntent(query);
        const redirectUrl = this.buildRedirectUrl(intent);
        
        console.log('🔍 Executing search:', { query, intent, redirectUrl });
        
        // Add visual feedback
        this.searchInput.style.transform = 'scale(0.98)';
        setTimeout(() => {
            this.searchInput.style.transform = '';
        }, 150);
        
        // Redirect with a slight delay for UX
        setTimeout(() => {
            window.location.href = redirectUrl;
        }, 300);
    }
    
    analyzeSearchIntent(query) {
        const normalizedQuery = this.normalizeQuery(query.toLowerCase());
        const intent = {
            mode: this.currentMode,
            brand: null,
            category: null,
            budget: null,
            fuel: null,
            transmission: null,
            features: []
        };
        
        // Detect mode from query if not explicitly set
        if (normalizedQuery.includes('rent') || normalizedQuery.includes('rental')) {
            intent.mode = 'rent';
        } else if (normalizedQuery.includes('buy') || normalizedQuery.includes('purchase') || normalizedQuery.includes('sale')) {
            intent.mode = 'buy';
        }
        
        // Detect brand
        this.searchPatterns.brands.forEach(brand => {
            if (normalizedQuery.includes(brand)) {
                intent.brand = brand;
            }
        });
        
        // Detect category
        this.searchPatterns.categories.forEach(category => {
            if (normalizedQuery.includes(category)) {
                intent.category = category;
            }
        });
        
        // Detect budget
        if (normalizedQuery.includes('cheap') || normalizedQuery.includes('budget') || normalizedQuery.includes('affordable')) {
            intent.budget = 'low';
        } else if (normalizedQuery.includes('premium') || normalizedQuery.includes('luxury')) {
            intent.budget = 'high';
        }
        
        // Extract price range
        const priceMatch = normalizedQuery.match(/under\s+(\d+)|below\s+(\d+)|(\d+)\s*birr|(\d+)\s*etb/);
        if (priceMatch) {
            intent.maxPrice = parseInt(priceMatch[1] || priceMatch[2] || priceMatch[3] || priceMatch[4]);
        }
        
        // Detect fuel type
        this.searchPatterns.fuel.forEach(fuel => {
            if (normalizedQuery.includes(fuel)) {
                intent.fuel = fuel;
            }
        });
        
        // Detect transmission
        this.searchPatterns.transmission.forEach(trans => {
            if (normalizedQuery.includes(trans)) {
                intent.transmission = trans;
            }
        });
        
        return intent;
    }
    
    buildRedirectUrl(intent) {
        const baseUrl = intent.mode === 'rent' ? '/vehicles/rentals' : '/vehicles/buying';
        const params = new URLSearchParams();
        
        // Add search query
        params.set('search', this.searchInput.value.trim());
        
        // Add filters based on intent
        if (intent.brand) params.set('brand', intent.brand);
        if (intent.category) params.set('category', intent.category);
        if (intent.fuel) params.set('fuel_type', intent.fuel);
        if (intent.transmission) params.set('transmission', intent.transmission);
        if (intent.maxPrice) params.set('max_price', intent.maxPrice);
        if (intent.budget === 'low') params.set('budget', 'low');
        if (intent.budget === 'high') params.set('budget', 'high');
        
        return `${baseUrl}?${params.toString()}`;
    }
    
    getIconSVG(iconType) {
        const icons = {
            car: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>',
            category: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>',
            dollar: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/></svg>',
            fuel: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
            gear: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'
        };
        
        return icons[iconType] || icons.car;
    }
    
    capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
}

// Global function for inline onclick handlers (backup)
window.handleQuickChipClick = function(chip) {
    console.log('🎯 Global quick chip click handler called');
    
    const searchTerm = chip.dataset.search;
    const mode = chip.dataset.mode;
    
    console.log('🔍 Quick chip clicked (global):', { searchTerm, mode });
    
    // If SmartSearchBar instance exists, use it
    if (window.smartSearchBar) {
        window.smartSearchBar.setMode(mode);
        window.smartSearchBar.searchInput.value = searchTerm;
        window.smartSearchBar.executeSearch(searchTerm);
    } else {
        // Fallback: direct redirect
        console.log('⚠️ SmartSearchBar not found, using fallback redirect');
        const baseUrl = mode === 'rent' ? '/vehicles/rentals' : '/vehicles/sales';
        const params = new URLSearchParams();
        params.set('search', searchTerm);
        window.location.href = `${baseUrl}?${params.toString()}`;
    }
    
    // Visual feedback
    chip.style.transform = 'scale(0.95)';
    setTimeout(() => {
        chip.style.transform = '';
    }, 150);
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('smartSearchInput')) {
        window.smartSearchBar = new SmartSearchBar();
        console.log('🚀 Smart Search Bar loaded successfully');
    }
});

// Fallback initialization with delay
setTimeout(() => {
    if (!window.smartSearchBar && document.getElementById('smartSearchInput')) {
        console.log('🔄 Fallback initialization of Smart Search Bar');
        window.smartSearchBar = new SmartSearchBar();
    }
}, 1000);

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SmartSearchBar;
}