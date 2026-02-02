@extends('layouts.app')

@section('title', 'Premium Vehicle Sales - Addis Drive')

@section('content')
<!-- 🎯 CINEMATIC PREMIUM HERO SECTION -->
<section class="relative min-h-screen overflow-hidden">
    <!-- 1️⃣ IMMERSIVE BACKGROUND LAYER -->
    <div class="absolute inset-0 sales-immersion-layer">
        <!-- High-resolution luxury sales fleet image with dynamic perspective -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat sales-hero-image" 
             style="background-image: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2083&q=80'); 
                    background-position: 65% center; 
                    transform: scale(1.05);">
        </div>
        
        <!-- Enhanced cinematic gradient overlays -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/70 to-slate-900/40"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-transparent to-soft-white/90"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
        
        <!-- Premium accent glows with sales theme -->
        <div class="absolute inset-0 bg-gradient-to-br from-light-orange/15 via-transparent to-neon-blue/10"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-light-orange/20 rounded-full blur-3xl animate-pulse-soft"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-neon-blue/15 rounded-full blur-3xl animate-pulse-soft" style="animation-delay: 2s;"></div>
        
        <!-- Floating sales elements -->
        <div class="absolute top-20 right-20 w-32 h-32 bg-white/5 rounded-full backdrop-blur-sm animate-float"></div>
        <div class="absolute bottom-32 right-32 w-24 h-24 bg-light-orange/10 rounded-full backdrop-blur-sm animate-float" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-40 left-20 w-20 h-20 bg-neon-blue/10 rounded-full backdrop-blur-sm animate-float" style="animation-delay: 3s;"></div>
    </div>
    
    <!-- 2️⃣ PREMIUM CONTENT LAYER -->
    <div class="relative z-20 min-h-screen flex items-center">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Premium Brand Message -->
                <div class="sales-brand-container relative">
                    <!-- Enhanced readability background -->
                    <div class="absolute -inset-12 bg-gradient-to-r from-slate-900/30 via-slate-900/20 to-transparent rounded-3xl backdrop-blur-md border border-white/10"></div>
                    
                    <!-- Premium Badge -->
                    <div class="sales-badge opacity-0 transform translate-y-8 relative z-10" style="animation: slideInUp 0.8s ease-out 0.2s forwards;">
                        <div class="inline-flex items-center space-x-3 bg-white/15 backdrop-blur-xl rounded-full px-6 py-3 mb-8 border border-white/20">
                            <div class="w-3 h-3 bg-light-orange rounded-full animate-pulse-soft shadow-lg shadow-light-orange/50"></div>
                            <span class="text-sm font-semibold text-white">
                                {{ app()->getLocale() === 'am' ? 'ፕሪሚየም የሽያጭ አገልግሎት' : 'Premium Vehicle Sales' }}
                            </span>
                            <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Cinematic Headline -->
                    <div class="sales-headline mb-8 relative z-10">
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.4s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">የተሽከርካሪ</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">Premium</span>
                            @endif
                        </div>
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.6s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-light-orange via-orange-glow to-neon-blue bg-clip-text leading-tight tracking-tight drop-shadow-lg">ሽያጭ</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-light-orange via-orange-glow to-neon-blue bg-clip-text leading-tight tracking-tight drop-shadow-lg">Vehicle</span>
                            @endif
                        </div>
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.8s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">አገልግሎት</span>
                            @else
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">Sales</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Premium Subtitle -->
                    <div class="sales-subtitle opacity-0 transform translate-y-6 relative z-10" style="animation: slideInUp 0.6s ease-out 1.0s forwards;">
                        <div class="bg-slate-900/40 backdrop-blur-xl rounded-2xl p-6 border border-white/10">
                            <p class="text-xl lg:text-2xl text-slate-100 leading-relaxed max-w-2xl font-light">
                                @if(app()->getLocale() === 'am')
                                    የተረጋገጡ ተሽከርካሪዎች፣ ግልጽ ዋጋ እና የቻፓ ደህንነቱ የተጠበቀ ክፍያ። የእርስዎን ፍጹም ተሽከርካሪ ያግኙ።
                                @else
                                    Verified vehicles, transparent pricing, and secure Chapa payments. Find your perfect vehicle with complete confidence.
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Premium Stats -->
                    <div class="sales-stats opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.3s forwards;">
                        <div class="grid grid-cols-3 gap-6 mt-8">
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="text-3xl font-bold text-light-orange mb-1 drop-shadow-lg">{{ $vehicles->total() }}+</div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎች' : 'Vehicles' }}</div>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="text-3xl font-bold text-green-400 mb-1 drop-shadow-lg">100%</div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'የተረጋገጠ' : 'Verified' }}</div>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="text-3xl font-bold text-neon-blue mb-1 drop-shadow-lg">24/7</div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'ድጋፍ' : 'Support' }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Action Buttons -->
                    <div class="sales-actions opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.6s forwards;">
                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                            <a href="#vehicles-grid" class="premium-cta-primary scroll-smooth">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎችን ይመልከቱ' : 'Explore Vehicles' }}
                            </a>
                            <a href="{{ route('contact.show') }}" class="premium-cta-secondary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Expert' }}
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Premium Features Showcase
                <div class="hidden lg:block sales-features-showcase relative">
                    <div class="opacity-0 transform translate-x-8" style="animation: slideInRight 0.8s ease-out 1.8s forwards;"> -->
                        <!-- Main Feature Card
                        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 shadow-2xl">
                            <div class="text-center mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-light-orange to-orange-glow rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ ግዢ' : 'Secure Purchase' }}
                                </h3>
                                <p class="text-slate-300">
                                    {{ app()->getLocale() === 'am' ? 'በቻፓ ክፍያ ይግዙ' : 'Buy with Chapa payment' }}
                                </p>
                            </div> -->
                            
                            <!-- Feature List
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-light-orange rounded-full"></div>
                                    <span class="text-sm">{{ app()->getLocale() === 'am' ? 'KYC የተረጋገጠ' : 'KYC Verified' }}</span>
                                </div>
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                    <span class="text-sm">{{ app()->getLocale() === 'am' ? 'የተረጋገጡ ተሽከርካሪዎች' : 'Verified Vehicles' }}</span>
                                </div>
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-neon-blue rounded-full"></div>
                                    <span class="text-sm">{{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ ክፍያ' : 'Secure Payment' }}</span>
                                </div>
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                                    <span class="text-sm">{{ app()->getLocale() === 'am' ? 'ፈጣን ሂደት' : 'Fast Process' }}</span>
                                </div>
                            </div> -->
                        <!-- </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<!-- 🔍 ADVANCED SEARCH & FILTERS -->
<section class="py-14 bg-gradient-to-br from-white via-slate-50 to-white border-b border-slate-200 relative overflow-hidden">
    <!-- Ambient Background -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-neon-blue/5 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-light-orange/5 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-premium p-8 lg:p-10 rounded-3xl bg-white/90 backdrop-blur-xl border border-slate-200 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.12)] animate-on-scroll hover:shadow-[0_35px_80px_-20px_rgba(0,0,0,0.18)] transition-all duration-500">
            
            <form method="GET" action="{{ route('vehicles.sales') }}" class="space-y-8">

                <!-- Primary Filters Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Make -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-neon-blue group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ብራንድ' : 'Vehicle Make' }}
                        </label>
                        <select name="make"
                            class="w-full rounded-2xl border-slate-300 bg-white shadow-sm
                                   focus:border-neon-blue focus:ring-neon-blue/40 focus:ring-4
                                   transition-all duration-300 hover:shadow-md">
                            <option value="">{{ app()->getLocale() === 'am' ? 'ሁሉም ብራንዶች' : 'All Makes' }}</option>
                            @foreach($makes as $make)
                                <option value="{{ $make }}" {{ request('make') === $make ? 'selected' : '' }}>{{ $make }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-light-orange group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ምድብ' : 'Category' }}
                        </label>
                        <select name="category"
                            class="w-full rounded-2xl border-slate-300 bg-white shadow-sm
                                   focus:border-light-orange focus:ring-light-orange/40 focus:ring-4
                                   transition-all duration-300 hover:shadow-md">
                            <option value="">{{ app()->getLocale() === 'am' ? 'ሁሉም ምድቦች' : 'All Categories' }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year From -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-500 group-hover:text-neon-blue transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ከ ዓመት' : 'Year From' }}
                        </label>
                        <select name="year_from"
                            class="w-full rounded-2xl border-slate-300 shadow-sm
                                   focus:border-neon-blue focus:ring-neon-blue/40 focus:ring-4
                                   transition-all duration-300 hover:shadow-md">
                            <option value="">{{ app()->getLocale() === 'am' ? 'ማንኛውም' : 'Any' }}</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year_from') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year To -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-500 group-hover:text-light-orange transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'እስከ ዓመት' : 'Year To' }}
                        </label>
                        <select name="year_to"
                            class="w-full rounded-2xl border-slate-300 shadow-sm
                                   focus:border-light-orange focus:ring-light-orange/40 focus:ring-4
                                   transition-all duration-300 hover:shadow-md">
                            <option value="">{{ app()->getLocale() === 'am' ? 'ማንኛውም' : 'Any' }}</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year_to') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Price + Actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-8 border-t border-slate-200">
                    
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price"
                        class="w-full rounded-2xl border-slate-300 shadow-sm
                               focus:ring-4 focus:ring-neon-blue/40 focus:border-neon-blue
                               transition-all duration-300 hover:shadow-md">

                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price"
                        class="w-full rounded-2xl border-slate-300 shadow-sm
                               focus:ring-4 focus:ring-light-orange/40 focus:border-light-orange
                               transition-all duration-300 hover:shadow-md">

                    <div class="flex items-end space-x-3">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center rounded-2xl
                                   bg-gradient-to-r from-neon-blue to-blue-dark
                                   text-white font-semibold py-3
                                   hover:scale-[1.03] hover:shadow-xl transition-all duration-300">
                            {{ app()->getLocale() === 'am' ? 'ፈልግ' : 'Search' }}
                        </button>

                        <button type="button" onclick="clearFilters()"
                            class="inline-flex items-center justify-center rounded-2xl
                                   border border-slate-300 px-5 py-3 font-semibold
                                   hover:bg-slate-100 hover:scale-105 transition-all duration-300">
                            {{ app()->getLocale() === 'am' ? 'አጽዳ' : 'Clear' }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>


<!-- 📊 RESULTS & SORTING -->
<section class="py-8 bg-soft-white">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-10 relative">

    <!-- Results Count -->
    <div class="animate-on-scroll">
        <h2 class="text-heading text-slate-900 mb-2 tracking-tight
                   bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900
                   bg-clip-text text-transparent">
            {{ app()->getLocale() === 'am' ? 'ለሽያጭ የቀረቡ ተሽከርካሪዎች' : 'Vehicles for Sale' }}
        </h2>

        <p class="text-slate-600 flex items-center space-x-2">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl
                         bg-neon-blue/10 text-neon-blue font-semibold text-sm">
                {{ $vehicles->total() }}
            </span>
            <span>
                @if(app()->getLocale() === 'am')
                    ተሽከርካሪዎች ተገኝተዋል
                @else
                    vehicles found
                @endif
            </span>
        </p>
    </div>

    <!-- Sort Options -->
    <div class="animate-on-scroll flex items-center gap-4"
         style="animation-delay: 0.2s;">

        <label class="text-sm font-semibold text-slate-700 whitespace-nowrap
                       flex items-center gap-2">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl
                         bg-light-orange/10 text-light-orange">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                </svg>
            </span>
            {{ app()->getLocale() === 'am' ? 'ደርድር በ:' : 'Sort by:' }}
        </label>

        <select
            onchange="updateSort(this.value)"
            class="rounded-2xl border-slate-300 bg-white px-4 py-2.5 pr-10
                   shadow-sm
                   focus:border-light-orange focus:ring-4 focus:ring-light-orange/30
                   hover:shadow-md hover:border-slate-400
                   transition-all duration-300 cursor-pointer">

            <option value="created_at-desc" {{ request('sort') === 'created_at' && request('order') === 'desc' ? 'selected' : '' }}>
                {{ app()->getLocale() === 'am' ? 'አዲስ' : 'Newest' }}
            </option>

            <option value="price-asc" {{ request('sort') === 'price' && request('order') === 'asc' ? 'selected' : '' }}>
                {{ app()->getLocale() === 'am' ? 'ዋጋ: ዝቅተኛ → ከፍተኛ' : 'Price: Low → High' }}
            </option>

            <option value="price-desc" {{ request('sort') === 'price' && request('order') === 'desc' ? 'selected' : '' }}>
                {{ app()->getLocale() === 'am' ? 'ዋጋ: ከፍተኛ → ዝቅተኛ' : 'Price: High → Low' }}
            </option>

            <option value="year-desc" {{ request('sort') === 'year' && request('order') === 'desc' ? 'selected' : '' }}>
                {{ app()->getLocale() === 'am' ? 'ዓመት: አዲስ → ድሮ' : 'Year: Newest → Oldest' }}
            </option>
        </select>
    </div>

</div>


        <!-- 🎁 ACTIVE DISCOUNTS BANNER -->
        @php
            $activeDiscounts = \App\Services\DiscountService::class;
            $discountService = app($activeDiscounts);
            $salesDiscounts = $discountService->getActiveDiscounts('selling');
        @endphp

        @if($salesDiscounts->count() > 0)
        <div class="mb-12 bg-gradient-to-r from-light-orange/10 via-orange-light/20 to-neon-blue/10 rounded-2xl p-8 border border-orange-light/30">
            <div class="text-center mb-6">
                <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-light-orange to-orange-dark text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'am' ? 'ንቁ ቅናሾች' : 'Active Discounts' }}</span>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">
                    {{ app()->getLocale() === 'am' ? 'የሽያጭ ቅናሾች' : 'Vehicle Sales Discounts' }}
                </h2>
                <p class="text-slate-600">
                    {{ app()->getLocale() === 'am' ? 'በተሽከርካሪ ግዢዎ ላይ ቆጣቢ ይሁኑ' : 'Save money on your vehicle purchase' }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($salesDiscounts as $discount)
                <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-{{ $discount->type === 'holiday' ? 'purple' : 'orange' }}-500 to-{{ $discount->type === 'holiday' ? 'purple' : 'orange' }}-600 rounded-lg flex items-center justify-center">
                                @if($discount->type === 'holiday')
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">{{ $discount->name }}</h3>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $discount->type === 'holiday' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }}">
                                    {{ ucfirst($discount->type) }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-green-600">{{ $discount->percentage }}%</div>
                            <div class="text-xs text-slate-500">{{ app()->getLocale() === 'am' ? 'ቅናሽ' : 'OFF' }}</div>
                        </div>
                    </div>
                    
                    <p class="text-sm text-slate-600 mb-4">{{ $discount->description }}</p>
                    
                    @if($discount->type === 'holiday')
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">{{ app()->getLocale() === 'am' ? 'ጊዜ:' : 'Period:' }}</span>
                            <span class="font-medium text-slate-900">
                                {{ $discount->start_date->format('M j') }} - {{ $discount->end_date->format('M j, Y') }}
                            </span>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
            
            <!-- Sales Discount Calculator -->
            <div class="mt-8 bg-white rounded-xl p-6 shadow-sm border border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'የቅናሽ ካልኩሌተር' : 'Discount Calculator' }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ዋጋ ($)' : 'Vehicle Price ($)' }}
                        </label>
                        <input type="number" id="sales-calc-amount" step="0.01" min="1" 
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-light-orange focus:border-transparent"
                               placeholder="25000.00">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            {{ app()->getLocale() === 'am' ? 'የግዢ ቀን' : 'Purchase Date' }}
                        </label>
                        <input type="date" id="sales-calc-date" value="{{ date('Y-m-d') }}"
                               class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-light-orange focus:border-transparent">
                    </div>
                    <div>
                        <button onclick="calculateSalesDiscount()" 
                                class="w-full bg-light-orange text-slate-800 py-2 px-4 rounded-lg hover:bg-orange-dark hover:text-white transition-all duration-200 font-semibold">
                            {{ app()->getLocale() === 'am' ? 'ሰላሳ' : 'Calculate' }}
                        </button>
                    </div>
                </div>
                <div id="sales-calc-result" class="mt-4 hidden">
                    <!-- Results will be shown here -->
                </div>
            </div>
        </div>
        @endif

        <!-- 🚗 PREMIUM VEHICLE GRID -->
        <div id="vehicles-grid">
        @if($vehicles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($vehicles as $index => $vehicle)
                    <div class="card-premium card-glow-orange animate-on-scroll" style="animation-delay: {{ $index * 0.1 }}s;">
                        <!-- Vehicle Image -->
                        <div class="relative h-64 bg-gradient-to-br from-slate-100 to-slate-200 rounded-t-xl overflow-hidden">
                            @if($vehicle->primary_image)
                                <img src="{{ $vehicle->primary_image }}" 
                                     alt="{{ $vehicle->full_name }}" 
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <!-- Fallback for broken images -->
                                <div class="hidden items-center justify-center h-full bg-gradient-to-br from-slate-100 to-slate-200">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-slate-500">{{ $vehicle->full_name }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                        <p class="text-sm text-slate-500">{{ $vehicle->full_name }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg">
                                    {{ app()->getLocale() === 'am' ? 'ለሽያጭ' : 'For Sale' }}
                                </span>
                            </div>
                            
                            <!-- Condition Badge -->
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm rounded-xl px-3 py-1.5 shadow-lg">
                                <span class="text-xs font-semibold text-slate-700">{{ ucfirst($vehicle->condition) }}</span>
                            </div>
                            
                            <!-- Price Badge -->
                            <div class="absolute bottom-4 right-4 bg-white/95 backdrop-blur-sm rounded-xl px-4 py-2 shadow-lg">
                                <div class="text-xl font-bold text-orange-dark">ETB {{ number_format($vehicle->sale_price, 0) }}</div>
                                <div class="text-xs text-slate-500 text-center">{{ app()->getLocale() === 'am' ? 'ታክስ ጨምሮ' : 'Tax included' }}</div>
                            </div>
                        </div>
                        
                        <!-- Vehicle Info -->
                        <div class="p-6">
                            <h3 class="text-heading text-slate-900 mb-3">{{ $vehicle->full_name }}</h3>
                            
                            <!-- Vehicle Features Grid -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-orange-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $vehicle->year }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-orange-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    <span>{{ number_format($vehicle->mileage) }} km</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-orange-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    <span>{{ ucfirst($vehicle->transmission) }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-orange-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                    </svg>
                                    <span>{{ ucfirst($vehicle->fuel_type) }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-orange-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <span>{{ ucfirst($vehicle->category) }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-orange-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3H5v12a2 2 0 002 2h2V3z"/>
                                    </svg>
                                    <span>{{ $vehicle->color }}</span>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            @if($vehicle->features && count($vehicle->features) > 0)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(array_slice($vehicle->features, 0, 3) as $feature)
                                            <span class="bg-orange-light/30 text-orange-dark text-xs font-medium px-2 py-1 rounded-full">
                                                {{ $feature }}
                                            </span>
                                        @endforeach
                                        @if(count($vehicle->features) > 3)
                                            <span class="bg-slate-100 text-slate-600 text-xs font-medium px-2 py-1 rounded-full">
                                                +{{ count($vehicle->features) - 3 }} {{ app()->getLocale() === 'am' ? 'ተጨማሪ' : 'more' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-3">

    <!-- Details Button (same as rental secondary) -->
    <a href="{{ route('vehicles.show', $vehicle) }}"
       class="btn-secondary flex-1 text-center
              relative overflow-hidden
              rounded-2xl px-4 py-3
              font-semibold
              text-slate-700
              hover:text-neon-blue
              transition-all duration-300
              hover:-translate-y-0.5 hover:shadow-lg
              focus:outline-none focus:ring-4 focus:ring-neon-blue/20">

        <svg class="w-4 h-4 text-slate-500 transition-transform duration-300 
                    group-hover:scale-110 group-hover:text-blue-600"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                     c4.478 0 8.268 2.943 9.542 7
                     -1.274 4.057-5.064 7-9.542 7
                     -4.477 0-8.268-2.943-9.542-7z"/>
        </svg>

        <span class="tracking-wide">
            {{ app()->getLocale() === 'am' ? 'ዝርዝር' : 'Details' }}
        </span>
    </a>

    @auth
        <!-- Buy Button (same as rental primary) -->
        <a href="{{ route('purchases.create', $vehicle) }}"
           class="group flex-1 inline-flex items-center justify-center gap-2 rounded-xl
                  bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600
                  px-5 py-3 text-sm font-semibold text-white
                  shadow-md transition-all duration-300 ease-out
                  hover:-translate-y-0.5 hover:shadow-xl
                  hover:from-blue-500 hover:to-purple-500
                  focus:outline-none focus:ring-2 focus:ring-indigo-400/40">

            <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-6"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0
                         9 9 0 0118 0z"/>
            </svg>

            <span class="tracking-wide">
                 {{ app()->getLocale() === 'am' ? 'ይግዙ' : 'Buy This Car' }}
            </span>
        </a>
    @else
        <!-- Login to Buy (same primary color) -->
        <a href="{{ route('login') }}"
           class="group flex-1 inline-flex items-center justify-center gap-2 rounded-xl
                  bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600
                  px-5 py-3 text-sm font-semibold text-white
                  shadow-md transition-all duration-300 ease-out
                  hover:-translate-y-0.5 hover:shadow-xl
                  hover:from-blue-500 hover:to-purple-500
                  focus:outline-none focus:ring-2 focus:ring-indigo-400/40">

            <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 16l-4-4m0 0l4-4m-4 4h14
                         m-5 4v1a3 3 0 01-3 3H6
                         a3 3 0 01-3-3V7
                         a3 3 0 013-3h7
                         a3 3 0 013 3v1"/>
            </svg>

            <span class="tracking-wide">
                {{ app()->getLocale() === 'am' ? 'ይግዙ' : 'Buy This Car' }}
            </span>
        </a>
    @endauth

</div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Premium Pagination -->
            <div class="mt-12 animate-on-scroll">
                <div class="flex justify-center">
                    {{ $vehicles->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @else
            <!-- No Results State -->
            <div class="text-center py-20 animate-on-scroll">
                <div class="w-32 h-32 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-heading text-slate-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'ምንም ተሽከርካሪ አልተገኘም' : 'No Vehicles Found' }}
                </h3>
                <p class="text-body mb-8 max-w-md mx-auto">
                    {{ app()->getLocale() === 'am' ? 'የፍለጋ መስፈርቶችዎን ይለውጡ እና እንደገና ይሞክሩ። ወይም ሁሉንም ተሽከርካሪዎች ይመልከቱ።' : 'Try adjusting your search criteria or view all available vehicles in our sales inventory.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="clearFilters()" class="btn-cta">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ሁሉንም ተሽከርካሪዎች አሳይ' : 'Show All Vehicles' }}
                    </button>
                    <a href="{{ route('contact.show') }}" class="btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Us' }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🛒 Premium Sales Platform Loaded');
    
    // Add form ID to the form for the search button
    const form = document.querySelector('form[method="GET"]');
    if (form) {
        form.id = 'filter-form';
    }
    
    // Smooth scroll for CTA button
    document.querySelector('a[href="#vehicles-grid"]')?.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector('[id="vehicles-grid"], .grid');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

function updateSort(value) {
    const [sort, order] = value.split('-');
    const url = new URL(window.location);
    url.searchParams.set('sort', sort);
    url.searchParams.set('order', order);
    window.location.href = url.toString();
}

function clearFilters() {
    window.location.href = '{{ route("vehicles.sales") }}';
}

// Sales Discount Calculator
function calculateSalesDiscount() {
    const amount = document.getElementById('sales-calc-amount').value;
    const date = document.getElementById('sales-calc-date').value;
    
    if (!amount || !date) {
        alert('{{ app()->getLocale() === 'am' ? 'እባክዎ ሁሉንም መስኮች ይሙሉ' : 'Please fill all fields' }}');
        return;
    }
    
    fetch('{{ route("discount.preview") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            type: 'selling',
            amount: amount,
            start_date: date
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(result => {
        const resultDiv = document.getElementById('sales-calc-result');
        
        if (result.has_discount) {
            resultDiv.innerHTML = `
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h4 class="font-medium text-green-900 mb-3">{{ app()->getLocale() === 'am' ? 'ቅናሽ ተተግብሯል!' : 'Discount Applied!' }}</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-green-700 font-medium">{{ app()->getLocale() === 'am' ? 'የመጀመሪያ ዋጋ:' : 'Original Price:' }}</span>
                            <div class="text-lg font-bold text-slate-900">ETB ${result.original_amount}</div>
                        </div>
                        <div>
                            <span class="text-green-700 font-medium">{{ app()->getLocale() === 'am' ? 'ቅናሽ:' : 'Discount:' }}</span>
                            <div class="text-lg font-bold text-green-600">-ETB ${result.discount_amount}</div>
                        </div>
                        <div>
                            <span class="text-green-700 font-medium">{{ app()->getLocale() === 'am' ? 'የመጨረሻ ዋጋ:' : 'Final Price:' }}</span>
                            <div class="text-lg font-bold text-light-orange">ETB ${result.final_amount}</div>
                        </div>
                        <div>
                            <span class="text-green-700 font-medium">{{ app()->getLocale() === 'am' ? 'ቅናሽ ፐርሰንት:' : 'Discount %:' }}</span>
                            <div class="text-lg font-bold text-green-600">${result.discount.percentage}%</div>
                        </div>
                    </div>
                    <div class="mt-3 p-3 bg-green-100 rounded-lg">
                        <p class="text-sm text-green-800"><strong>{{ app()->getLocale() === 'am' ? 'ምክንያት:' : 'Reason:' }}</strong> ${result.discount_reason}</p>
                    </div>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-medium text-yellow-900 mb-2">{{ app()->getLocale() === 'am' ? 'ምንም ቅናሽ አልተገኘም' : 'No Discount Available' }}</h4>
                    <p class="text-sm text-yellow-800">{{ app()->getLocale() === 'am' ? 'ለተሰጡት መስፈርቶች ተገቢ ቅናሽ አልተገኘም።' : 'No applicable discounts found for the given criteria.' }}</p>
                </div>
            `;
        }
        
        resultDiv.classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
        const resultDiv = document.getElementById('sales-calc-result');
        
        let errorMessage = '{{ app()->getLocale() === 'am' ? 'ቅናሽ ማስላት አልተሳካም። እባክዎ እንደገና ይሞክሩ።' : 'Failed to calculate discount. Please try again.' }}';
        
        // Check if it's a network error
        if (error.message.includes('HTTP error')) {
            errorMessage = '{{ app()->getLocale() === 'am' ? 'የአገልግሎት ስህተት። እባክዎ ቆይተው ይሞክሩ።' : 'Service error. Please try again later.' }}';
        }
        
        resultDiv.innerHTML = `
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <h4 class="font-medium text-red-900 mb-2">{{ app()->getLocale() === 'am' ? 'ስህተት' : 'Error' }}</h4>
                <p class="text-sm text-red-800">${errorMessage}</p>
                <p class="text-xs text-red-600 mt-2">{{ app()->getLocale() === 'am' ? 'ዝርዝር:' : 'Details:' }} ${error.message}</p>
            </div>
        `;
        resultDiv.classList.remove('hidden');
    });
}
</script>

<style>
/* 🎨 HERO SECTION ANIMATIONS */
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

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes pulseSoft {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

/* Animation Classes */
.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-pulse-soft {
    animation: pulseSoft 2s ease-in-out infinite;
}

/* Premium CTA Button Styles */
.premium-cta-primary {
    @apply inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-light-orange to-orange-dark rounded-2xl shadow-xl transition-all duration-300 hover:shadow-2xl hover:shadow-light-orange/25 hover:scale-105 border border-light-orange/50;
}

.premium-cta-secondary {
    @apply inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 shadow-xl transition-all duration-300 hover:bg-white/20 hover:scale-105;
}

/* Glass morphism effects */
.backdrop-blur-xl {
    backdrop-filter: blur(24px);
}

.backdrop-blur-md {
    backdrop-filter: blur(12px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sales-headline .headline-line span {
        @apply text-4xl lg:text-5xl;
    }
    
    .premium-cta-primary,
    .premium-cta-secondary {
        @apply px-6 py-3 text-base;
    }
}
</style>
@endpush
@endsection
