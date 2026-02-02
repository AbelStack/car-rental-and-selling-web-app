@extends('layouts.app')

@section('title', 'Premium Vehicle Services - Addis Drive')

@section('content')
<!-- 🎯 FULL PAGE CAR BACKGROUND -->
<div class="fixed inset-0 car-immersion-layer" style="z-index: -1;">
    <!-- High-resolution luxury car image with 3/4 angle perspective -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat car-hero-image" 
         style="background-image: url('https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2069&q=80'); 
                background-position: 70% center; 
                transform: scale(1.1);">
    </div>
    
    <!-- Enhanced gradient overlay for better text readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/85 via-slate-900/60 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-900/40 via-transparent to-slate-900/60"></div>
    
    <!-- Subtle accent glows -->
    <div class="absolute inset-0 bg-gradient-to-r from-neon-blue/10 via-transparent to-light-orange/8"></div>
    
    <!-- Bottom fade for smooth transition -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
    
    <!-- Parallax motion container -->
    <div class="absolute inset-0 parallax-container"></div>
</div>

<!-- 🎯 CINEMATIC BOOKING STAGE - THREE-LAYER COMPOSITION -->
<section class="relative min-h-screen overflow-hidden">
    <!-- 2️⃣ MID LAYER - BRAND MESSAGE (LEFT-WEIGHTED) -->
    <div class="relative z-20 min-h-screen flex items-center">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Brand Content - Left Aligned with Enhanced Contrast -->
                <div class="brand-message-container relative">
                    <!-- Background accent for better readability -->
                    <div class="absolute -inset-8 bg-gradient-to-r from-slate-900/20 via-slate-900/10 to-transparent rounded-3xl backdrop-blur-sm"></div>
                    
                    <!-- Editorial Style Headline with High Contrast -->
                    <div class="editorial-headline mb-8 relative z-10">
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.3s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">የተሽከርካሪ</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">Premium</span>
                            @endif
                        </div>
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.6s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text leading-tight tracking-tight drop-shadow-lg">ኪራይ እና ሽያጭ</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text leading-tight tracking-tight drop-shadow-lg">Mobility</span>
                            @endif
                        </div>
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.9s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">በአዲስ መንገድ</span>
                            @else
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">Redefined</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Enhanced Subline with Better Contrast -->
                    <!-- <div class="subline opacity-0 transform translate-y-6 relative z-10" style="animation: slideInUp 0.6s ease-out 1.2s forwards;">
                        <div class="bg-slate-900/30 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                            <p class="text-xl lg:text-2xl text-slate-100 leading-relaxed max-w-2xl font-light">
                                @if(app()->getLocale() === 'am')
                                    በቻፓ የተጠበቀ ክፍያ፣ የKYC ማረጋገጫ እና የተረጋገጡ ተሽከርካሪዎች። ፈጣን፣ ደህንነቱ የተጠበቀ እና ሙሉ በሙሉ ዲጂታል ልምድ።
                                @else
                                    Secure Chapa payments, KYC verification, and verified vehicles. Experience the future of automotive transactions with complete peace of mind.
                                @endif
                            </p>
                        </div>
                    </div> -->
                    
                    <!-- Enhanced Trust Indicators with Premium Styling -->
                    <!-- <div class="trust-indicators opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.5s forwards;">
                        <div class="flex items-center space-x-8 mt-8">
                            <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse-soft shadow-lg shadow-green-400/50"></div>
                                <span class="text-sm font-semibold text-white">{{ app()->getLocale() === 'am' ? 'የተረጋገጠ KYC' : 'Verified KYC' }}</span>
                            </div>
                            <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                                <div class="w-3 h-3 bg-neon-blue rounded-full animate-pulse-soft shadow-lg shadow-neon-blue/50" style="animation-delay: 0.5s;"></div>
                                <span class="text-sm font-semibold text-white">{{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ ቻፓ' : 'Secure Chapa' }}</span>
                            </div>
                            <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                                <div class="w-3 h-3 bg-light-orange rounded-full animate-pulse-soft shadow-lg shadow-light-orange/50" style="animation-delay: 1s;"></div>
                                <span class="text-sm font-semibold text-white">{{ app()->getLocale() === 'am' ? '24/7 ድጋፍ' : '24/7 Support' }}</span>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- Call-to-Action Buttons for Better Engagement -->
                    <!-- <div class="cta-buttons opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.8s forwards;">
                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                            <a href="{{ route('vehicles.rentals') }}" class="premium-cta-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ኪራይ ይጀምሩ' : 'Start Renting' }}
                            </a>
                            <a href="{{ route('vehicles.sales') }}" class="premium-cta-secondary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'መኪና ይግዙ' : 'Buy Vehicle' }}
                            </a>
                        </div>
                    </div> -->
                </div>
                
                <!-- Right side - Smart Search Bar -->
                <div class="flex items-center justify-center">
                    <div class="w-full max-w-lg">
                        @include('components.smart-search-bar')
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 🔍 FLOATING ACTION STRIP (Sticky Mini-Search) -->
<div id="floating-search" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 transition-all duration-300 opacity-0 translate-y-4">
    <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-slate-200/50 p-4">
        <div class="flex items-center space-x-4">
            <!-- Search Type Tabs -->
            <div class="flex items-center space-x-2">
                <button type="button" id="floating-rent-tab" class="floating-search-tab active px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200" onclick="switchFloatingTab('rent')">
                    <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ኪራይ' : 'Rent' }}
                </button>
                <button type="button" id="floating-buy-tab" class="floating-search-tab px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200" onclick="switchFloatingTab('buy')">
                    <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ግዢ' : 'Buy' }}
                </button>
            </div>
            
            <!-- Divider -->
            <div class="w-px h-6 bg-slate-200"></div>
            
            <!-- Search Input & Button -->
            <div class="flex items-center space-x-3">
                <input type="text" 
                       id="floating-search-input"
                       placeholder="{{ app()->getLocale() === 'am' ? 'የመኪና ዓይነት ይፈልጉ...' : 'Search vehicle type...' }}" 
                       class="bg-transparent border-none outline-none text-sm placeholder-slate-400 w-48 focus:placeholder-slate-300 transition-colors duration-200"
                       autocomplete="off"
                       onkeypress="handleFloatingSearchKeypress(event)">
                
                <button type="button" onclick="performFloatingSearch()" class="btn-primary px-4 py-2 text-sm hover:scale-105 transition-transform duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 🎨 FEATURED EXPERIENCE BLOCKS (Stacked Panels) -->
<section class="py-20 bg-soft-white/95 backdrop-blur-sm relative z-10">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center space-x-2 bg-blue-light/50 rounded-full px-4 py-2 mb-4">
                <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-sm font-medium text-neon-blue">
                    {{ app()->getLocale() === 'am' ? 'ተወዳጅ ምርጫዎች' : 'Featured Selection' }}
                </span>
            </div>
            <h2 class="text-display text-slate-900 mb-4">
                @if(app()->getLocale() === 'am')
                    የተመረጡ ተሽከርካሪዎች
                @else
                    Curated Vehicle Collection
                @endif
            </h2>
            <p class="text-body max-w-2xl mx-auto">
                @if(app()->getLocale() === 'am')
                    በእጅ የተመረጡ፣ የተረጋገጡ እና ለአገልግሎት ዝግጁ የሆኑ ተሽከርካሪዎች
                @else
                    Hand-picked, verified, and service-ready vehicles for your perfect journey
                @endif
            </p>
        </div>

        <!-- Experience Tabs (Enhanced & Fixed) -->
        <div class="flex justify-center mb-12 animate-on-scroll" style="animation-delay: 0.2s;">
            <div class="bg-white rounded-2xl p-2 shadow-sm border border-slate-200 relative">
                <!-- Tab Indicator Background
                <div id="tab-indicator" class="absolute top-2 left-2 h-12 bg-gradient-to-r from-neon-blue to-blue-glow rounded-xl transition-all duration-300 ease-out shadow-lg" style="width: calc(50% - 4px);"></div>
                
                <button onclick="switchTab('rental')" id="rental-tab" class="experience-tab active px-8 py-3 rounded-xl font-medium transition-all duration-300 relative z-10" tabindex="0" role="tab" aria-selected="true" aria-controls="rental-panel">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ኪራይ ተሽከርካሪዎች' : 'Rental Fleet' }}
                </button>
                <button onclick="switchTab('sales')" id="sales-tab" class="experience-tab px-8 py-3 rounded-xl font-medium transition-all duration-300 relative z-10" tabindex="0" role="tab" aria-selected="false" aria-controls="sales-panel">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ለሽያጭ ተሽከርካሪዎች' : 'Sales Inventory' }}
                </button> -->
            </div>
        </div>
        
        <!-- Debug Info (Remove after testing) -->
        <div id="debug-info" class="text-center mb-4 text-sm text-gray-500" style="display: none;">
            <p>Debug: <span id="debug-message">Tabs initialized</span></p>
        </div>

        <!-- Rental Vehicles Panel -->
        <div id="rental-panel" class="experience-panel" role="tabpanel" aria-labelledby="rental-tab" tabindex="0">
            @if($featuredRentals && $featuredRentals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredRentals as $index => $vehicle)
                        <div class="card-premium card-glow-blue animate-on-scroll" style="animation-delay: {{ $index * 0.1 }}s;">
                            <!-- Vehicle Image -->
                            <div class="relative h-56 bg-gradient-to-br from-slate-100 to-slate-200 rounded-t-xl overflow-hidden">
                                @if($vehicle->primary_image)
                                    <img src="{{ $vehicle->primary_image }}" 
                                         alt="{{ $vehicle->full_name }}" 
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ app()->getLocale() === 'am' ? 'ዝግጁ' : 'Available' }}
                                    </span>
                                </div>
                                
                                <!-- Price Badge -->
                                <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm rounded-lg px-3 py-2">
                                    <span class="text-lg font-bold text-neon-blue">ETB {{ number_format($vehicle->rental_price_per_day, 0) }}</span>
                                    <span class="text-xs text-slate-500 block">{{ app()->getLocale() === 'am' ? '/ቀን' : '/day' }}</span>
                                </div>
                            </div>
                            
                            <!-- Vehicle Info -->
                            <div class="p-6">
                                <h3 class="text-heading text-slate-900 mb-2">{{ $vehicle->full_name }}</h3>
                                
                                <!-- Vehicle Features -->
                                <div class="flex items-center space-x-4 text-sm text-slate-500 mb-4">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        <span>{{ ucfirst($vehicle->transmission) }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span>{{ $vehicle->seating_capacity }} {{ app()->getLocale() === 'am' ? 'መቀመጫ' : 'seats' }}</span>
                                    </div>
                                </div>
                                
                                <!-- Category -->
                                <div class="mb-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-light text-neon-blue">
                                        {{ ucfirst($vehicle->category) }}
                                    </span>
                                </div>
                                
                                <!-- Action Button -->
                                <a href="{{ route('vehicles.show', $vehicle) }}"
   class="btn-primary w-full text-center relative overflow-hidden px-6 py-3
          font-semibold text-white bg-neon-blue/90 hover:bg-neon-blue/100
          rounded-xl shadow-lg shadow-neon-blue/30 hover:shadow-xl
          transition-all duration-500 ease-in-out transform hover:-translate-y-1
          hover:scale-105 active:scale-95 active:translate-y-0
          before:absolute before:top-0 before:left-0 before:w-0 before:h-full
          before:bg-white/10 before:transition-all before:duration-500 before:ease-in-out
          hover:before:w-full">
    {{ app()->getLocale() === 'am' ? 'ዝርዝር ይመልከቱ' : 'View Details' }}
</a>

                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- View All Button -->
                <div class="text-center mt-12 animate-on-scroll" style="animation-delay: 0.6s;">
    <a href="{{ route('vehicles.rentals') }}"
       class="btn-secondary inline-flex items-center relative overflow-hidden px-6 py-3
              font-semibold text-white bg-light-orange/90 hover:bg-light-orange/100
              rounded-xl shadow-md shadow-light-orange/30 hover:shadow-lg
              transition-all duration-500 ease-in-out transform hover:-translate-y-1
              hover:scale-105 active:scale-95 active:translate-y-0
              before:absolute before:top-0 before:left-0 before:w-0 before:h-full
              before:bg-white/10 before:transition-all before:duration-500 before:ease-in-out
              hover:before:w-full">
        {{ app()->getLocale() === 'am' ? 'ሁሉንም የኪራይ ተሽከርካሪዎች ይመልከቱ' : 'View All Rental Vehicles' }}
        <svg class="w-5 h-5 ml-2 transform transition-transform duration-500 ease-in-out group-hover:translate-x-1" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
    </a>
</div>

            @else
                <!-- No Rentals Available -->
                <div class="text-center py-16 animate-on-scroll">
                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </div>
                    <h3 class="text-heading text-slate-900 mb-2">
                        {{ app()->getLocale() === 'am' ? 'የኪራይ ተሽከርካሪዎች አልተገኙም' : 'No Rental Vehicles Available' }}
                    </h3>
                    <p class="text-body mb-6">
                        {{ app()->getLocale() === 'am' ? 'በቅርቡ አዳዲስ ተሽከርካሪዎች እንጨምራለን' : 'We\'re adding new vehicles to our rental fleet soon' }}
                    </p>
                    <a href="{{ route('contact.show') }}" class="btn-secondary">
                        {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Us' }}
                    </a>
                </div>
            @endif
        </div>

        <!-- Sales Vehicles Panel -->
        <div id="sales-panel" class="experience-panel hidden" role="tabpanel" aria-labelledby="sales-tab" tabindex="0">
            @if($featuredSales && $featuredSales->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredSales as $index => $vehicle)
                        <div class="card-premium card-glow-orange animate-on-scroll" style="animation-delay: {{ $index * 0.1 }}s;">
                            <!-- Vehicle Image -->
                            <div class="relative h-56 bg-gradient-to-br from-slate-100 to-slate-200 rounded-t-xl overflow-hidden">
                                @if($vehicle->primary_image)
                                    <img src="{{ $vehicle->primary_image }}" 
                                         alt="{{ $vehicle->full_name }}" 
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Condition Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-light-orange text-slate-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ ucfirst($vehicle->condition) }}
                                    </span>
                                </div>
                                
                                <!-- Price Badge -->
                                <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm rounded-lg px-3 py-2">
                                    <span class="text-lg font-bold text-orange-dark">ETB {{ number_format($vehicle->sale_price, 0) }}</span>
                                </div>
                            </div>
                            
                            <!-- Vehicle Info -->
                            <div class="p-6">
                                <h3 class="text-heading text-slate-900 mb-2">{{ $vehicle->full_name }}</h3>
                                
                                <!-- Vehicle Features -->
                                <div class="flex items-center space-x-4 text-sm text-slate-500 mb-4">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        <span>{{ number_format($vehicle->mileage) }} km</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $vehicle->year }}</span>
                                    </div>
                                </div>
                                
                                <!-- Category -->
                                <div class="mb-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-light text-orange-dark">
                                        {{ ucfirst($vehicle->category) }}
                                    </span>
                                </div>
                                
                                <!-- Action Button -->
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="btn-cta w-full text-center">
                                    {{ app()->getLocale() === 'am' ? 'ዝርዝር ይመልከቱ' : 'View Details' }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- View All Button -->
                <div class="text-center mt-12 animate-on-scroll" style="animation-delay: 0.6s;">
                    <a href="{{ route('vehicles.sales') }}" class="btn-secondary inline-flex items-center">
                        {{ app()->getLocale() === 'am' ? 'ሁሉንም የሽያጭ ተሽከርካሪዎች ይመልከቱ' : 'View All Sales Vehicles' }}
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @else
                <!-- No Sales Available -->
                <div class="text-center py-16 animate-on-scroll">
                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-heading text-slate-900 mb-2">
                        {{ app()->getLocale() === 'am' ? 'የሽያጭ ተሽከርካሪዎች አልተገኙም' : 'No Sales Vehicles Available' }}
                    </h3>
                    <p class="text-body mb-6">
                        {{ app()->getLocale() === 'am' ? 'በቅርቡ አዳዲስ ተሽከርካሪዎች እንጨምራለን' : 'We\'re adding new vehicles to our sales inventory soon' }}
                    </p>
                    <a href="{{ route('contact.show') }}" class="btn-secondary">
                        {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Us' }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- 🏆 TRUST STORY SECTION (Editorial Style) -->
<section class="py-20 bg-white/95 backdrop-blur-sm relative z-10">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Trust Content -->
            <div class="animate-on-scroll">
                <div class="inline-flex items-center space-x-2 bg-green-100 rounded-full px-4 py-2 mb-6">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-green-700">
                        {{ app()->getLocale() === 'am' ? 'የተረጋገጠ እና ደህንነቱ የተጠበቀ' : 'Verified & Secure' }}
                    </span>
                </div>
                
                <h2 class="text-display text-slate-900 mb-6">
                    @if(app()->getLocale() === 'am')
                        ለምን ሺዎች ደንበኞች <span class="text-neon-blue">እኛን ይመርጣሉ</span>
                    @else
                        Why Thousands Trust <span class="text-neon-blue">Our Platform</span>
                    @endif
                </h2>
                
                <p class="text-body mb-8">
                    @if(app()->getLocale() === 'am')
                        በኢትዮጵያ ውስጥ የመጀመሪያው ሙሉ በሙሉ ዲጂታል የተሽከርካሪ መድረክ። የKYC ማረጋገጫ፣ የቻፓ ክፍያ እና የተረጋገጡ ተሽከርካሪዎች ያለን ብቸኛው አገልግሎት ነን።
                    @else
                        Ethiopia's first fully digital vehicle platform. We're the only service with KYC verification, Chapa payments, and verified vehicles - setting the gold standard for automotive transactions.
                    @endif
                </p>
                
                <!-- Trust Features -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 mb-1">
                                {{ app()->getLocale() === 'am' ? 'የKYC ማረጋገጫ' : 'KYC Identity Verification' }}
                            </h4>
                            <p class="text-sm text-slate-600">
                                {{ app()->getLocale() === 'am' ? 'ሁሉም ተጠቃሚዎች በመንግስት መታወቂያ የተረጋገጡ ናቸው' : 'Every user verified with government ID for maximum security' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 mb-1">
                                {{ app()->getLocale() === 'am' ? 'የቻፓ ደህንነቱ የተጠበቀ ክፍያ' : 'Chapa Secure Payments' }}
                            </h4>
                            <p class="text-sm text-slate-600">
                                {{ app()->getLocale() === 'am' ? 'ሁሉም ክፍያዎች በቻፓ የተጠበቁ እና የተመሰጠሩ ናቸው' : 'All payments protected and encrypted through Chapa gateway' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 mb-1">
                                {{ app()->getLocale() === 'am' ? '24/7 ደንበኛ ድጋፍ' : '24/7 Customer Support' }}
                            </h4>
                            <p class="text-sm text-slate-600">
                                {{ app()->getLocale() === 'am' ? 'በማንኛውም ጊዜ የሚገኝ ባለሙያ ድጋፍ' : 'Expert support available anytime you need assistance' }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Statistics -->
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-slate-200">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-neon-blue mb-1">1000+</div>
                        <div class="text-sm text-slate-600">{{ app()->getLocale() === 'am' ? 'ደንበኞች' : 'Happy Customers' }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-neon-blue mb-1">500+</div>
                        <div class="text-sm text-slate-600">{{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎች' : 'Vehicles' }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-neon-blue mb-1">99%</div>
                        <div class="text-sm text-slate-600">{{ app()->getLocale() === 'am' ? 'እርካታ' : 'Satisfaction' }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Trust Visual -->
            <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="relative">
                    <!-- Main Image Placeholder -->
                    <div class="bg-gradient-to-br from-blue-light to-orange-light rounded-2xl p-12 text-center">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <svg class="w-16 h-16 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ሙሉ በሙሉ የተጠበቀ' : 'Fully Protected' }}
                        </h3>
                        <p class="text-slate-600">
                            {{ app()->getLocale() === 'am' ? 'የእርስዎ ደህንነት ቅድሚያችን ነው' : 'Your security is our priority' }}
                        </p>
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center animate-float">
                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center animate-float" style="animation-delay: 1s;">
                        <svg class="w-8 h-8 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 🚀 CLOSING CTA SECTION -->
<section class="py-20 bg-slate-900/95 backdrop-blur-sm text-white relative overflow-hidden z-10">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-neon-blue/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-light-orange/10 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- CTA Content -->
        <div class="animate-on-scroll">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-8">
                <div class="w-2 h-2 bg-light-orange rounded-full animate-pulse-soft"></div>
                <span class="text-sm font-medium text-slate-300">
                    {{ app()->getLocale() === 'am' ? 'ዛሬ ይጀምሩ' : 'Start Today' }}
                </span>
            </div>
        </div>
        
        <div class="animate-on-scroll" style="animation-delay: 0.2s;">
            <h2 class="text-display text-white mb-6">
                @if(app()->getLocale() === 'am')
                    የእርስዎን ተሽከርካሪ <span class="text-light-orange">ጉዞ ይጀምሩ</span>
                @else
                    Start Your Vehicle <span class="text-light-orange">Journey Today</span>
                @endif
            </h2>
        </div>
        
        <div class="animate-on-scroll" style="animation-delay: 0.4s;">
            <p class="text-subheading text-slate-300 max-w-3xl mx-auto mb-12">
                @if(app()->getLocale() === 'am')
                    በደቂቃዎች ውስጥ ይመዝገቡ፣ KYC ያጠናቅቁ እና የተሽከርካሪ አገልግሎታችንን ይጠቀሙ። ፈጣን፣ ደህንነቱ የተጠበቀ እና ሙሉ በሙሉ ዲጂታል።
                @else
                    Register in minutes, complete KYC verification, and access our premium vehicle services. Fast, secure, and completely digital experience.
                @endif
            </p>
        </div>
        
        <!-- CTA Buttons -->
        <div class="animate-on-scroll flex flex-col sm:flex-row gap-6 justify-center items-center mb-16" style="animation-delay: 0.6s;">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary text-lg px-8 py-4 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ዳሽቦርድ ይሂዱ' : 'Go to Dashboard' }}
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary text-lg px-8 py-4 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ነፃ መለያ ይፍጠሩ' : 'Create Free Account' }}
                </a>
            @endauth
            
            <a href="{{ route('contact.show') }}" class="btn-secondary text-lg px-8 py-4 shadow-lg hover:shadow-xl bg-white/10 border-white/30 text-white hover:bg-white hover:text-slate-900">
                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a1 1 0 001.42 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Us' }}
            </a>
        </div>
        
        <!-- Final Trust Indicators -->
        <div class="animate-on-scroll flex flex-wrap justify-center items-center gap-8 text-sm text-slate-400" style="animation-delay: 0.8s;">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ' : 'Secure Platform' }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ app()->getLocale() === 'am' ? 'የተረጋገጠ KYC' : 'Verified Users' }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                </svg>
                <span>{{ app()->getLocale() === 'am' ? 'ተመራጭ አገልግሎት' : 'Trusted Service' }}</span>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<!-- Smart Search Bar JavaScript -->
<script src="{{ asset('js/smart-search.js') }}"></script>

<script>
// Define switchTab function globally first
window.switchTab = function(tab) {
    console.log('🎯 switchTab called with:', tab);
    
    // Update debug info
    const debugMessage = document.getElementById('debug-message');
    if (debugMessage) {
        debugMessage.textContent = `Switching to ${tab} tab...`;
        document.getElementById('debug-info').style.display = 'block';
    }
    
    const rentalTab = document.getElementById('rental-tab');
    const salesTab = document.getElementById('sales-tab');
    const rentalPanel = document.getElementById('rental-panel');
    const salesPanel = document.getElementById('sales-panel');
    const tabIndicator = document.getElementById('tab-indicator');
    
    // Debug: Check if elements exist
    console.log('🔍 Elements found:', {
        rentalTab: !!rentalTab,
        salesTab: !!salesTab,
        rentalPanel: !!rentalPanel,
        salesPanel: !!salesPanel,
        tabIndicator: !!tabIndicator
    });
    
    if (rentalTab && salesTab && rentalPanel && salesPanel) {
        // Remove active class from all tabs first
        rentalTab.classList.remove('active');
        salesTab.classList.remove('active');
        rentalTab.setAttribute('aria-selected', 'false');
        salesTab.setAttribute('aria-selected', 'false');
        
        // Hide all panels first
        rentalPanel.classList.add('hidden');
        salesPanel.classList.add('hidden');
        
        // Show selected tab and panel
        if (tab === 'rental') {
            rentalTab.classList.add('active');
            rentalTab.setAttribute('aria-selected', 'true');
            rentalPanel.classList.remove('hidden');
            
            // Move tab indicator
            if (tabIndicator) {
                tabIndicator.style.transform = 'translateX(0)';
            }
            
            // Update debug info
            if (debugMessage) {
                debugMessage.textContent = 'Rental tab active';
            }
            
            // Trigger animation for rental cards
            setTimeout(() => {
                const rentalCards = rentalPanel.querySelectorAll('.card-premium');
                rentalCards.forEach((card, index) => {
                    card.style.animationDelay = `${index * 0.1}s`;
                    card.classList.add('animate-on-scroll');
                });
            }, 100);
            
        } else if (tab === 'sales') {
            salesTab.classList.add('active');
            salesTab.setAttribute('aria-selected', 'true');
            salesPanel.classList.remove('hidden');
            
            // Move tab indicator
            if (tabIndicator) {
                tabIndicator.style.transform = 'translateX(100%)';
            }
            
            // Update debug info
            if (debugMessage) {
                debugMessage.textContent = 'Sales tab active';
            }
            
            // Trigger animation for sales cards
            setTimeout(() => {
                const salesCards = salesPanel.querySelectorAll('.card-premium');
                salesCards.forEach((card, index) => {
                    card.style.animationDelay = `${index * 0.1}s`;
                    card.classList.add('animate-on-scroll');
                });
            }, 100);
        }
        
        console.log('✅ Tab switched successfully to:', tab);
    } else {
        console.error('❌ Some tab elements not found!');
        if (debugMessage) {
            debugMessage.textContent = 'Error: Tab elements not found!';
        }
    }
};

document.addEventListener('DOMContentLoaded', function() {
    console.log('🎨 Cinematic Booking Stage Loaded');
    
    // Initialize Experience Tabs
    console.log('Initializing Experience Tabs...');
    
    // Ensure rental tab is active by default
    setTimeout(() => {
        switchTab('rental');
    }, 100);
    
    // Add click event listeners for tabs
    const rentalTabBtn = document.getElementById('rental-tab');
    const salesTabBtn = document.getElementById('sales-tab');
    
    if (rentalTabBtn) {
        rentalTabBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Rental tab clicked');
            switchTab('rental');
        });
        
        // Keyboard navigation
        rentalTabBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                switchTab('rental');
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                salesTabBtn.focus();
                switchTab('sales');
            }
        });
    }
    
    if (salesTabBtn) {
        salesTabBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Sales tab clicked');
            switchTab('sales');
        });
        
        // Keyboard navigation
        salesTabBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                switchTab('sales');
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                rentalTabBtn.focus();
                switchTab('rental');
            }
        });
    }
    
    // Parallax effect for car image (full page background)
    const carImage = document.querySelector('.car-hero-image');
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.2; // Reduced rate for subtle effect
        
        if (carImage) {
            carImage.style.transform = `scale(1.1) translateY(${rate}px)`;
        }
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestTick);
    
    // Smart booking dock scroll behavior
    const smartDock = document.querySelector('.smart-search-dock');
    let dockTransformed = false;
    
    window.addEventListener('scroll', function() {
        const scrollY = window.scrollY;
        const heroHeight = window.innerHeight;
        
        if (scrollY > heroHeight * 0.8 && !dockTransformed) {
            // Transform to sticky command bar
            smartDock.style.position = 'fixed';
            smartDock.style.top = '100px';
            smartDock.style.left = '50%';
            smartDock.style.transform = 'translateX(-50%) scale(0.85)';
            smartDock.style.zIndex = '1000';
            smartDock.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            dockTransformed = true;
        } else if (scrollY <= heroHeight * 0.8 && dockTransformed) {
            // Reset to original position
            smartDock.style.position = 'absolute';
            smartDock.style.top = 'auto';
            smartDock.style.left = 'auto';
            smartDock.style.transform = 'translateY(0)';
            smartDock.style.zIndex = '30';
            dockTransformed = false;
        }
    });
    
    // Service type switching (simplified for sales only)
    window.switchServiceType = function(type) {
        // Since we only have sales interface now, this function is simplified
        const salesService = document.getElementById('sales-service');
        const salesInterface = document.getElementById('sales-interface');
        
        // Always show sales interface
        if (salesInterface) {
            salesInterface.classList.remove('hidden');
            salesInterface.style.opacity = '1';
            salesInterface.style.transform = 'translateY(0)';
        }
        
        if (salesService) {
            salesService.classList.add('active');
        }
    };
    
    // Enhanced input interactions
    const smartInputs = document.querySelectorAll('.smart-input');
    
    smartInputs.forEach(input => {
        const inputGroup = input.closest('.input-group');
        const ripple = inputGroup.querySelector('.input-ripple');
        
        // Focus effects
        input.addEventListener('focus', function() {
            inputGroup.classList.add('focused');
            
            // Expand panel slightly
            const dock = inputGroup.closest('.smart-search-dock');
            dock.style.transform = 'translateY(-5px) scale(1.02)';
            
            // Blur background subtly
            document.body.style.backdropFilter = 'blur(2px)';
        });
        
        input.addEventListener('blur', function() {
            inputGroup.classList.remove('focused');
            
            // Reset panel
            const dock = inputGroup.closest('.smart-search-dock');
            dock.style.transform = 'translateY(0) scale(1)';
            
            // Remove background blur
            document.body.style.backdropFilter = 'none';
        });
        
        // Input ripple effect
        input.addEventListener('input', function() {
            ripple.style.animation = 'inputRipple 0.6s ease-out';
            setTimeout(() => {
                ripple.style.animation = '';
            }, 600);
        });
        
        // Date picker slide animation
        if (input.type === 'date') {
            input.addEventListener('click', function() {
                this.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
        }
    });
    
    // CTA button interactions
    const ctaButtons = document.querySelectorAll('.cta-book-now');
    
    ctaButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            const arrow = this.querySelector('.cta-arrow');
            arrow.style.transform = 'translateX(5px)';
            
            // Soft peach glow
            this.style.boxShadow = '0 15px 35px rgba(253, 186, 116, 0.4)';
        });
        
        button.addEventListener('mouseleave', function() {
            const arrow = this.querySelector('.cta-arrow');
            arrow.style.transform = 'translateX(0)';
            this.style.boxShadow = '0 10px 25px rgba(253, 186, 116, 0.3)';
        });
        
        button.addEventListener('click', function(e) {
            const ripple = this.querySelector('.cta-ripple');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            ripple.style.animation = 'ctaRipple 0.6s ease-out';
            
            setTimeout(() => {
                ripple.style.animation = '';
            }, 600);
        });
    });
    
    // 🔍 FLOATING SEARCH FUNCTIONALITY
    let currentSearchType = 'rent';
    const vehicleSuggestions = [
        // Rental Fleet - Sedans
        'Mercedes-Benz E-Class', 'Toyota Camry', 'Honda Accord', 'Honda Civic', 'Hyundai Elantra', 'Nissan Altima', 'Toyota Corolla',
        // Rental Fleet - SUVs
        'Honda CR-V', 'Toyota RAV4', 'Ford Explorer', 'Jeep Wrangler', 'Chevrolet Tahoe', 'Hyundai Tucson',
        // Rental Fleet - Trucks
        'Ford F-150', 'Chevrolet Silverado', 'RAM 1500',
        // Rental Fleet - Vans
        'Toyota Sienna', 'Honda Odyssey',
        // Rental Fleet - Luxury/Sports
        'BMW 4 Series', 'Audi A5',
        
        // Sales Inventory - Economy & Compact
        'Toyota Yaris', 'Kia Rio', 'Chevrolet Spark', 'Mitsubishi Mirage', 'Suzuki Swift', 'Volkswagen Polo',
        // Sales Inventory - Sedans
        'Hyundai Sonata', 'Kia Forte', 'Mazda 6', 'Subaru Impreza', 'Volkswagen Passat', 'Skoda Octavia',
        // Sales Inventory - SUVs
        'Mazda CX-5', 'Nissan Pathfinder', 'Mitsubishi Outlander', 'Peugeot 3008', 'Renault Duster', 'Chevrolet Traverse', 'Lexus RX 350',
        // Sales Inventory - Pickups
        'Toyota Hilux', 'Isuzu D-Max', 'Nissan Navara', 'Ford Ranger Raptor',
        // Sales Inventory - Vans
        'Volkswagen Transporter', 'Mercedes-Benz Vito', 'Toyota HiAce',
        // Sales Inventory - Luxury
        'BMW X6', 'Audi Q8', 'Lexus LC 500', 'Jaguar F-Type',
        
        // Generic searches
        'Sedan', 'SUV', 'Truck', 'Van', 'Luxury', 'Compact', 'Economy', 'Sports', 'Pickup'
    ];

    // Floating search elements
    const floatingRentTab = document.getElementById('floating-rent-tab');
    const floatingBuyTab = document.getElementById('floating-buy-tab');
    const floatingSearchForm = document.getElementById('floating-search-form');
    const floatingSearchInput = document.getElementById('floating-search-input');
    const floatingSearchSuggestions = document.getElementById('floating-search-suggestions');

    // Tab switching functionality
    if (floatingRentTab && floatingBuyTab) {
        floatingRentTab.addEventListener('click', function() {
            console.log('Rent tab clicked');
            currentSearchType = 'rent';
            floatingRentTab.classList.add('active');
            floatingBuyTab.classList.remove('active');
            if (floatingSearchForm) {
                floatingSearchForm.action = '{{ route("vehicles.rentals") }}';
            }
            if (floatingSearchInput) {
                floatingSearchInput.placeholder = '{{ app()->getLocale() === "am" ? "የኪራይ መኪና ይፈልጉ..." : "Search rental cars..." }}';
            }
        });

        floatingBuyTab.addEventListener('click', function() {
            console.log('Buy tab clicked');
            currentSearchType = 'buy';
            floatingBuyTab.classList.add('active');
            floatingRentTab.classList.remove('active');
            if (floatingSearchForm) {
                floatingSearchForm.action = '{{ route("vehicles.sales") }}';
            }
            if (floatingSearchInput) {
                floatingSearchInput.placeholder = '{{ app()->getLocale() === "am" ? "የሽያጭ መኪና ይፈልጉ..." : "Search cars for sale..." }}';
            }
        });
    }

    // Set initial form action
    if (floatingSearchForm) {
        floatingSearchForm.action = '{{ route("vehicles.rentals") }}';
    }

    // Search input functionality with suggestions
    if (floatingSearchInput && floatingSearchSuggestions) {
        floatingSearchInput.addEventListener('input', function() {
            console.log('Search input changed:', this.value);
            const query = this.value.toLowerCase().trim();
            
            if (query.length > 0) {
                const filteredSuggestions = vehicleSuggestions.filter(vehicle => 
                    vehicle.toLowerCase().includes(query)
                );
                
                if (filteredSuggestions.length > 0) {
                    showFloatingSuggestions(filteredSuggestions);
                } else {
                    hideFloatingSuggestions();
                }
            } else {
                hideFloatingSuggestions();
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!floatingSearchInput.contains(e.target) && !floatingSearchSuggestions.contains(e.target)) {
                hideFloatingSuggestions();
            }
        });

        // Handle keyboard navigation
        floatingSearchInput.addEventListener('keydown', function(e) {
            const suggestions = floatingSearchSuggestions.querySelectorAll('.suggestion-item');
            const activeSuggestion = floatingSearchSuggestions.querySelector('.suggestion-item.active');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (activeSuggestion) {
                    activeSuggestion.classList.remove('active');
                    const next = activeSuggestion.nextElementSibling;
                    if (next) {
                        next.classList.add('active');
                    } else {
                        suggestions[0]?.classList.add('active');
                    }
                } else {
                    suggestions[0]?.classList.add('active');
                }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (activeSuggestion) {
                    activeSuggestion.classList.remove('active');
                    const prev = activeSuggestion.previousElementSibling;
                    if (prev) {
                        prev.classList.add('active');
                    } else {
                        suggestions[suggestions.length - 1]?.classList.add('active');
                    }
                } else {
                    suggestions[suggestions.length - 1]?.classList.add('active');
                }
            } else if (e.key === 'Enter') {
                if (activeSuggestion) {
                    e.preventDefault();
                    floatingSearchInput.value = activeSuggestion.textContent.trim();
                    hideFloatingSuggestions();
                    floatingSearchForm.submit();
                }
            } else if (e.key === 'Escape') {
                hideFloatingSuggestions();
            }
        });
    }

    // Form submission
    if (floatingSearchForm) {
        floatingSearchForm.addEventListener('submit', function(e) {
            console.log('Form submitted');
            const searchValue = floatingSearchInput ? floatingSearchInput.value.trim() : '';
            if (!searchValue) {
                e.preventDefault();
                console.log('No search value, redirecting to:', currentSearchType);
                // Just redirect to the appropriate page without search
                window.location.href = currentSearchType === 'rent' ? '{{ route("vehicles.rentals") }}' : '{{ route("vehicles.sales") }}';
            }
            // If there's a search value, let the form submit normally
        });
    }

    // Helper functions for floating search suggestions
    function showFloatingSuggestions(suggestions) {
        const floatingSearchSuggestions = document.getElementById('floating-search-suggestions');
        if (!floatingSearchSuggestions) return;

        floatingSearchSuggestions.innerHTML = suggestions.map(suggestion => `
            <div class="suggestion-item" onclick="selectFloatingSuggestion('${suggestion}')">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span>${suggestion}</span>
            </div>
        `).join('');
        
        floatingSearchSuggestions.classList.remove('hidden');
    }

    function hideFloatingSuggestions() {
        const floatingSearchSuggestions = document.getElementById('floating-search-suggestions');
        if (floatingSearchSuggestions) {
            floatingSearchSuggestions.classList.add('hidden');
            // Remove active states
            floatingSearchSuggestions.querySelectorAll('.suggestion-item').forEach(item => {
                item.classList.remove('active');
            });
        }
    }

    window.selectFloatingSuggestion = function(suggestion) {
        const floatingSearchInput = document.getElementById('floating-search-input');
        const floatingSearchForm = document.getElementById('floating-search-form');
        
        if (floatingSearchInput && floatingSearchForm) {
            floatingSearchInput.value = suggestion;
            hideFloatingSuggestions();
            floatingSearchForm.submit();
        }
    };
    
    // Floating search bar scroll effect (keep existing)
    window.addEventListener('scroll', function() {
        const floatingSearch = document.getElementById('floating-search');
        if (floatingSearch) {
            if (window.scrollY > 600) {
                console.log('Showing floating search at scroll:', window.scrollY);
                floatingSearch.classList.remove('opacity-0', 'translate-y-4');
                floatingSearch.classList.add('opacity-100', 'translate-y-0');
            } else {
                floatingSearch.classList.add('opacity-0', 'translate-y-4');
                floatingSearch.classList.remove('opacity-100', 'translate-y-0');
            }
        } else {
            console.log('Floating search element not found');
        }
    });

// 🔍 SIMPLE FLOATING SEARCH FUNCTIONS (Global scope)
let currentFloatingSearchType = 'rent';

// Test function to show floating search immediately
function showFloatingSearchForTest() {
    const floatingSearch = document.getElementById('floating-search');
    if (floatingSearch) {
        floatingSearch.classList.remove('opacity-0', 'translate-y-4');
        floatingSearch.classList.add('opacity-100', 'translate-y-0');
        console.log('Floating search shown for testing');
    }
}

// Show floating search after 2 seconds for testing
setTimeout(showFloatingSearchForTest, 2000);

function switchFloatingTab(type) {
    console.log('Switching to:', type);
    currentFloatingSearchType = type;
    
    const rentTab = document.getElementById('floating-rent-tab');
    const buyTab = document.getElementById('floating-buy-tab');
    const searchInput = document.getElementById('floating-search-input');
    
    if (rentTab && buyTab && searchInput) {
        if (type === 'rent') {
            rentTab.classList.add('active');
            buyTab.classList.remove('active');
            searchInput.placeholder = '{{ app()->getLocale() === "am" ? "የኪራይ መኪና ይፈልጉ..." : "Search rental cars..." }}';
        } else {
            buyTab.classList.add('active');
            rentTab.classList.remove('active');
            searchInput.placeholder = '{{ app()->getLocale() === "am" ? "የሽያጭ መኪና ይፈልጉ..." : "Search cars for sale..." }}';
        }
    }
}

function performFloatingSearch() {
    console.log('Performing search for:', currentFloatingSearchType);
    const searchInput = document.getElementById('floating-search-input');
    const searchValue = searchInput ? searchInput.value.trim() : '';
    
    let targetUrl;
    if (currentFloatingSearchType === 'rent') {
        targetUrl = '{{ route("vehicles.rentals") }}';
    } else {
        targetUrl = '{{ route("vehicles.sales") }}';
    }
    
    if (searchValue) {
        targetUrl += '?search=' + encodeURIComponent(searchValue);
    }
    
    console.log('Redirecting to:', targetUrl);
    window.location.href = targetUrl;
}

function handleFloatingSearchKeypress(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        performFloatingSearch();
    }
}

    // 🔍 FLOATING SEARCH FUNCTIONALITY
    let currentSearchType = 'rent';
    const vehicleSuggestions = [
        'Toyota Camry', 'Honda Civic', 'BMW X5', 'Mercedes C-Class', 'Audi A4',
        'Nissan Altima', 'Hyundai Elantra', 'Ford Focus', 'Volkswagen Jetta',
        'Mazda CX-5', 'Subaru Outback', 'Lexus ES', 'Infiniti Q50', 'Acura TLX'
    ];

    // Floating search tab switching
    document.addEventListener('DOMContentLoaded', function() {
        const floatingRentTab = document.getElementById('floating-rent-tab');
        const floatingBuyTab = document.getElementById('floating-buy-tab');
        const floatingSearchForm = document.getElementById('floating-search-form');
        const floatingSearchInput = document.getElementById('floating-search-input');
        const floatingSearchSuggestions = document.getElementById('floating-search-suggestions');

        // Tab switching functionality
        if (floatingRentTab && floatingBuyTab) {
            floatingRentTab.addEventListener('click', function() {
                currentSearchType = 'rent';
                floatingRentTab.classList.add('active');
                floatingBuyTab.classList.remove('active');
                floatingSearchForm.action = '{{ route("vehicles.rentals") }}';
                floatingSearchInput.placeholder = '{{ app()->getLocale() === "am" ? "የኪራይ መኪና ይፈልጉ..." : "Search rental cars..." }}';
            });

            floatingBuyTab.addEventListener('click', function() {
                currentSearchType = 'buy';
                floatingBuyTab.classList.add('active');
                floatingRentTab.classList.remove('active');
                floatingSearchForm.action = '{{ route("vehicles.sales") }}';
                floatingSearchInput.placeholder = '{{ app()->getLocale() === "am" ? "የሽያጭ መኪና ይፈልጉ..." : "Search cars for sale..." }}';
            });
        }

        // Set initial form action
        if (floatingSearchForm) {
            floatingSearchForm.action = '{{ route("vehicles.rentals") }}';
        }

        // Search input functionality with suggestions
        if (floatingSearchInput && floatingSearchSuggestions) {
            floatingSearchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                
                if (query.length > 0) {
                    const filteredSuggestions = vehicleSuggestions.filter(vehicle => 
                        vehicle.toLowerCase().includes(query)
                    );
                    
                    if (filteredSuggestions.length > 0) {
                        showFloatingSuggestions(filteredSuggestions);
                    } else {
                        hideFloatingSuggestions();
                    }
                } else {
                    hideFloatingSuggestions();
                }
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!floatingSearchInput.contains(e.target) && !floatingSearchSuggestions.contains(e.target)) {
                    hideFloatingSuggestions();
                }
            });

            // Handle keyboard navigation
            floatingSearchInput.addEventListener('keydown', function(e) {
                const suggestions = floatingSearchSuggestions.querySelectorAll('.suggestion-item');
                const activeSuggestion = floatingSearchSuggestions.querySelector('.suggestion-item.active');
                
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    if (activeSuggestion) {
                        activeSuggestion.classList.remove('active');
                        const next = activeSuggestion.nextElementSibling;
                        if (next) {
                            next.classList.add('active');
                        } else {
                            suggestions[0]?.classList.add('active');
                        }
                    } else {
                        suggestions[0]?.classList.add('active');
                    }
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    if (activeSuggestion) {
                        activeSuggestion.classList.remove('active');
                        const prev = activeSuggestion.previousElementSibling;
                        if (prev) {
                            prev.classList.add('active');
                        } else {
                            suggestions[suggestions.length - 1]?.classList.add('active');
                        }
                    } else {
                        suggestions[suggestions.length - 1]?.classList.add('active');
                    }
                } else if (e.key === 'Enter') {
                    if (activeSuggestion) {
                        e.preventDefault();
                        floatingSearchInput.value = activeSuggestion.textContent.trim();
                        hideFloatingSuggestions();
                        floatingSearchForm.submit();
                    }
                } else if (e.key === 'Escape') {
                    hideFloatingSuggestions();
                }
            });
        }

        // Form submission
        if (floatingSearchForm) {
            floatingSearchForm.addEventListener('submit', function(e) {
                const searchValue = floatingSearchInput.value.trim();
                if (!searchValue) {
                    e.preventDefault();
                    // Just redirect to the appropriate page without search
                    window.location.href = currentSearchType === 'rent' ? '{{ route("vehicles.rentals") }}' : '{{ route("vehicles.sales") }}';
                }
                // If there's a search value, let the form submit normally
            });
        }
    });

    // Helper functions for floating search suggestions
    function showFloatingSuggestions(suggestions) {
        const floatingSearchSuggestions = document.getElementById('floating-search-suggestions');
        if (!floatingSearchSuggestions) return;

        floatingSearchSuggestions.innerHTML = suggestions.map(suggestion => `
            <div class="suggestion-item" onclick="selectFloatingSuggestion('${suggestion}')">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span>${suggestion}</span>
            </div>
        `).join('');
        
        floatingSearchSuggestions.classList.remove('hidden');
    }

    function hideFloatingSuggestions() {
        const floatingSearchSuggestions = document.getElementById('floating-search-suggestions');
        if (floatingSearchSuggestions) {
            floatingSearchSuggestions.classList.add('hidden');
            // Remove active states
            floatingSearchSuggestions.querySelectorAll('.suggestion-item').forEach(item => {
                item.classList.remove('active');
            });
        }
    }

    function selectFloatingSuggestion(suggestion) {
        const floatingSearchInput = document.getElementById('floating-search-input');
        const floatingSearchForm = document.getElementById('floating-search-form');
        
        if (floatingSearchInput && floatingSearchForm) {
            floatingSearchInput.value = suggestion;
            hideFloatingSuggestions();
            floatingSearchForm.submit();
        }
    }
});
</script>

<style>
/* 🎨 CINEMATIC HERO STYLES */

/* Car immersion layer - Full page background */
.car-immersion-layer {
    will-change: transform;
}

.car-hero-image {
    will-change: transform;
    transition: transform 0.1s ease-out;
}

/* Editorial headline animations */
.headline-line {
    display: block;
    margin-bottom: 0.5rem;
}

.subline {
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.trust-indicators {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Smart booking dock */
.smart-search-dock {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
}

.smart-search-dock:hover {
    transform: translateY(-2px);
}

/* Service toggle buttons */
.service-toggle {
    @apply text-slate-600 transition-all duration-300;
}

.service-toggle.active {
    @apply bg-neon-blue text-white shadow-lg;
}

.service-toggle:hover:not(.active) {
    @apply bg-slate-200 text-slate-800;
}

/* Smart input system */
.input-group {
    @apply relative;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.input-group.focused {
    transform: translateY(-2px);
}

.input-icon {
    @apply absolute left-4 top-1/2 transform -translate-y-1/2 z-10;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.input-group.focused .input-icon {
    transform: translateY(-50%) scale(1.1);
}

/* 🔍 FLOATING SEARCH STYLES */
.floating-search-tab {
    @apply text-slate-600 bg-transparent hover:text-neon-blue hover:bg-neon-blue/10;
}

.floating-search-tab.active {
    @apply text-white bg-gradient-to-r from-neon-blue to-blue-glow shadow-sm;
}

.floating-search-tab:hover {
    @apply transform scale-105;
}

#floating-search-suggestions {
    animation: slideDown 0.2s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.suggestion-item {
    @apply px-4 py-3 text-sm text-slate-700 hover:bg-neon-blue/10 hover:text-neon-blue cursor-pointer transition-all duration-200 flex items-center space-x-3;
}

.suggestion-item:first-child {
    @apply rounded-t-xl;
}

.suggestion-item:last-child {
    @apply rounded-b-xl;
}

.suggestion-item.active {
    @apply bg-neon-blue/15 text-neon-blue;
}

.smart-input {
    @apply w-full pl-12 pr-4 py-4 bg-white/80 backdrop-blur-sm border-2 border-slate-200 rounded-2xl;
    @apply text-slate-900 placeholder-slate-500 font-medium;
    @apply focus:outline-none focus:border-neon-blue focus:bg-white;
    @apply transition-all duration-300 ease-out;
}

.smart-input:focus {
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
    transform: translateY(-1px);
}

.input-ripple {
    @apply absolute inset-0 rounded-2xl pointer-events-none;
    background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.1), transparent);
    transform: translateX(-100%);
}

/* CTA Button - Large Orange with Premium Effects */
.cta-book-now {
    @apply relative bg-light-orange text-slate-900 font-bold text-lg px-12 py-4 rounded-2xl;
    @apply flex items-center justify-center overflow-hidden;
    @apply transition-all duration-300 ease-out;
    box-shadow: 0 10px 25px rgba(253, 186, 116, 0.3);
    min-width: 200px;
}

.cta-book-now:hover {
    @apply bg-orange-dark text-white;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 15px 35px rgba(253, 186, 116, 0.4);
}

.cta-book-now:active {
    transform: translateY(-1px) scale(1.01);
}

.cta-text {
    @apply relative z-10;
}

.cta-arrow {
    @apply relative z-10 transition-transform duration-300;
}

.cta-ripple {
    @apply absolute bg-white/30 rounded-full pointer-events-none;
    transform: scale(0);
}

/* Booking interface transitions */
.booking-interface {
    @apply transition-all duration-500 ease-out;
}

.booking-interface.hidden {
    @apply opacity-0 pointer-events-none;
    transform: translateY(20px);
}

/* Premium CTA Buttons in Hero */
.premium-cta-primary {
    @apply inline-flex items-center px-8 py-4 bg-neon-blue text-white font-semibold rounded-2xl;
    @apply transition-all duration-300 ease-out;
    @apply hover:bg-blue-dark hover:shadow-xl hover:shadow-neon-blue/30;
    @apply transform hover:-translate-y-1 hover:scale-105;
    @apply border border-neon-blue/20;
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
}

.premium-cta-primary:active {
    transform: translateY(0) scale(1.02);
}

.premium-cta-secondary {
    @apply inline-flex items-center px-8 py-4 bg-white/20 text-white font-semibold rounded-2xl;
    @apply transition-all duration-300 ease-out;
    @apply hover:bg-light-orange hover:text-slate-900 hover:shadow-xl hover:shadow-light-orange/30;
    @apply transform hover:-translate-y-1 hover:scale-105;
    @apply border border-white/30 hover:border-light-orange;
    backdrop-filter: blur(10px);
}

.premium-cta-secondary:active {
    transform: translateY(0) scale(1.02);
}

/* Enhanced brand message styling */
.brand-message-container {
    position: relative;
}

.brand-message-container::before {
    content: '';
    position: absolute;
    top: -2rem;
    left: -2rem;
    right: 2rem;
    bottom: -2rem;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, transparent 50%, rgba(253, 186, 116, 0.05) 100%);
    border-radius: 2rem;
    backdrop-filter: blur(5px);
    z-index: -1;
}

/* Enhanced text shadows and readability */
.headline-line span {
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.subline p {
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

/* Trust indicators enhanced styling */
.trust-indicators .flex {
    transition: all 0.3s ease;
}

.trust-indicators .flex:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
}

/* Mobile responsive improvements */
@media (max-width: 768px) {
    .car-hero-image {
        background-position: center center !important;
        transform: scale(1.2) !important; /* Slightly larger scale for mobile */
    }
    
    /* Ensure sections have proper backgrounds on mobile */
    section {
        position: relative;
        z-index: 10;
    }
    
    .headline-line span {
        font-size: 3rem !important;
    }
    
    .smart-search-dock {
        margin: 0 1rem;
    }
    
    .smart-search-dock .bg-white\/95 {
        padding: 1.5rem;
    }
    
    .service-toggle {
        padding: 0.75rem 1.5rem;
        font-size: 0.875rem;
    }
    
    .cta-book-now {
        width: 100%;
        justify-content: center;
    }
    
    .brand-message-container::before {
        top: -1rem;
        left: -1rem;
        right: 1rem;
        bottom: -1rem;
    }
    
    .trust-indicators .flex {
        flex-direction: column;
        space-y: 1rem;
    }
    
    .trust-indicators > div {
        flex-direction: column;
        align-items: flex-start;
        space-x: 0;
        space-y: 1rem;
    }
    
    .cta-buttons .flex {
        flex-direction: column;
        width: 100%;
    }
    
    .premium-cta-primary,
    .premium-cta-secondary {
        width: 100%;
        justify-content: center;
    }
}

/* Animation keyframes */
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

@keyframes inputRipple {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

@keyframes ctaRipple {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(4);
        opacity: 0;
    }
}

/* Experience Tab Styles (Enhanced) */
.experience-tab {
    @apply text-slate-600 hover:text-slate-800 transition-all duration-300 cursor-pointer;
    @apply hover:bg-transparent;
    position: relative;
    z-index: 10;
}

.experience-tab.active {
    @apply text-white;
    background: transparent !important;
}

.experience-tab:hover:not(.active) {
    @apply text-slate-800;
}

.experience-tab:focus {
    @apply outline-none ring-2 ring-neon-blue ring-opacity-50 ring-offset-2;
}

#tab-indicator {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1;
}

.experience-panel {
    @apply transition-all duration-500 ease-in-out;
    @apply opacity-100;
}

.experience-panel.hidden {
    @apply opacity-0;
    display: none !important;
}

/* Smooth fade-in animation for panels */
.experience-panel:not(.hidden) {
    animation: fadeInUp 0.6s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Search Tab Styles (keep existing) */
.search-tab {
    @apply text-slate-600 hover:text-neon-blue hover:bg-blue-light/50 transition-all duration-200;
}

.search-tab.active {
    @apply bg-neon-blue text-white;
}

/* Enhanced Card Hover Effects (keep existing) */
.card-premium:hover {
    @apply shadow-2xl -translate-y-2;
}

.card-glow-blue:hover {
    box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.25);
}

.card-glow-orange:hover {
    box-shadow: 0 25px 50px -12px rgba(253, 186, 116, 0.25);
}
</style>
@endpush
@endsection
