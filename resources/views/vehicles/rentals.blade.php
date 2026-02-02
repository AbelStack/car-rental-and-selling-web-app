@extends('layouts.app')

@section('title', 'Premium Vehicle Rentals - Addis Drive')

@section('content')
<!-- 🎯 CINEMATIC PREMIUM HERO SECTION -->
<section class="relative min-h-screen overflow-hidden">
    <!-- 1️⃣ IMMERSIVE BACKGROUND LAYER -->
    <div class="absolute inset-0 rental-immersion-layer">
        <!-- High-resolution luxury rental fleet image with dynamic perspective -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat rental-hero-image" 
             style="background-image: url('https://images.unsplash.com/photo-1555215695-3004980ad54e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); 
                    background-position: 65% center; 
                    transform: scale(1.05);">
        </div>
        
        <!-- Enhanced cinematic gradient overlays -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/70 to-slate-900/40"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-transparent to-soft-white/90"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
        
        <!-- Premium accent glows with rental theme -->
        <div class="absolute inset-0 bg-gradient-to-br from-neon-blue/15 via-transparent to-light-orange/10"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse-soft"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-light-orange/15 rounded-full blur-3xl animate-pulse-soft" style="animation-delay: 2s;"></div>
        
        <!-- Floating rental elements -->
        <div class="absolute top-20 right-20 w-32 h-32 bg-white/5 rounded-full backdrop-blur-sm animate-float"></div>
        <div class="absolute bottom-32 right-32 w-24 h-24 bg-neon-blue/10 rounded-full backdrop-blur-sm animate-float" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-40 left-20 w-20 h-20 bg-light-orange/10 rounded-full backdrop-blur-sm animate-float" style="animation-delay: 3s;"></div>
    </div>
    
    <!-- 2️⃣ PREMIUM CONTENT LAYER -->
    <div class="relative z-20 min-h-screen flex items-center">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Premium Brand Message -->
                <div class="rental-brand-container relative">
                    <!-- Enhanced readability background -->
                    <div class="absolute -inset-12 bg-gradient-to-r from-slate-900/30 via-slate-900/20 to-transparent rounded-3xl backdrop-blur-md border border-white/10"></div>
                    
                    <!-- Premium Badge -->
                    <div class="rental-badge opacity-0 transform translate-y-8 relative z-10" style="animation: slideInUp 0.8s ease-out 0.2s forwards;">
                        <div class="inline-flex items-center space-x-3 bg-white/15 backdrop-blur-xl rounded-full px-6 py-3 mb-8 border border-white/20">
                            <div class="w-3 h-3 bg-neon-blue rounded-full animate-pulse-soft shadow-lg shadow-neon-blue/50"></div>
                            <span class="text-sm font-semibold text-white">
                                {{ app()->getLocale() === 'am' ? 'ፕሪሚየም የኪራይ አገልግሎት' : 'Premium Rental Fleet' }}
                            </span>
                            <svg class="w-4 h-4 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Cinematic Headline -->
                    <div class="rental-headline mb-8 relative z-10">
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.4s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">የተሽከርካሪ</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">Premium</span>
                            @endif
                        </div>
                        <!-- <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.6s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text leading-tight tracking-tight drop-shadow-lg">ኪራይ</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text leading-tight tracking-tight drop-shadow-lg">Vehicle</span>
                            @endif
                        </div> -->
                        
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.8s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">አገልግሎት</span>
                            @else
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">Rentals</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Premium Subtitle -->
                    <div class="rental-subtitle opacity-0 transform translate-y-6 relative z-10" style="animation: slideInUp 0.6s ease-out 1.0s forwards;">
                        <div class="bg-slate-900/40 backdrop-blur-xl rounded-2xl p-6 border border-white/10">
                            <p class="text-xl lg:text-2xl text-slate-100 leading-relaxed max-w-2xl font-light">
                                @if(app()->getLocale() === 'am')
                                    የተረጋገጡ ተሽከርካሪዎች፣ ተለዋዋጭ የኪራይ አማራጮች እና የቻፓ ደህንነቱ የተጠበቀ ክፍያ። ራስዎ ይንዱ ወይም ከሹፌር ጋር።
                                @else
                                    Verified vehicles, flexible rental options, and secure Chapa payments. Self-drive or with professional drivers for your perfect journey.
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Premium Stats -->
                    <div class="rental-stats opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.3s forwards;">
                        <div class="grid grid-cols-3 gap-6 mt-8">
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="text-3xl font-bold text-neon-blue mb-1 drop-shadow-lg">{{ $vehicles->total() }}+</div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎች' : 'Vehicles' }}</div>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="text-3xl font-bold text-light-orange mb-1 drop-shadow-lg">24/7</div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'ድጋፍ' : 'Support' }}</div>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="text-3xl font-bold text-green-400 mb-1 drop-shadow-lg">100%</div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'የተረጋገጠ' : 'Verified' }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Action Buttons -->
                    <div class="rental-actions opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.6s forwards;">
                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                            <a href="#vehicle-search" class="premium-cta-primary scroll-smooth">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ተሽከርካሪ ይፈልጉ' : 'Find Your Vehicle' }}
                            </a>
                            <a href="{{ route('contact.show') }}" class="premium-cta-secondary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 7.89a1 1 0 001.42 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Us' }}
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Premium Features Showcase
                <div class="hidden lg:block rental-features-showcase relative">
                    <div class="opacity-0 transform translate-x-8" style="animation: slideInRight 0.8s ease-out 1.8s forwards;"> -->
                        <!-- Main Feature Card
                        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 shadow-2xl">
                            <div class="text-center mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-neon-blue to-blue-glow rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ፈጣን ቦታ ማስያዝ' : 'Instant Booking' }}
                                </h3>
                                <p class="text-slate-300">
                                    {{ app()->getLocale() === 'am' ? 'በደቂቃዎች ውስጥ ይከራዩ' : 'Book in minutes' }}
                                </p>
                            </div> -->
                            
                            <!-- Feature List
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-slate-200 font-medium">
                                        {{ app()->getLocale() === 'am' ? 'KYC የተረጋገጠ' : 'KYC Verified Users' }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-slate-200 font-medium">
                                        {{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ ቻፓ' : 'Secure Chapa Payments' }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-orange-500/20 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="text-slate-200 font-medium">
                                        {{ app()->getLocale() === 'am' ? 'የተረጋገጡ ተሽከርካሪዎች' : 'Verified Vehicles' }}
                                    </span>
                                </div>
                            </div> -->
                        <!-- </div> -->
                        
                        <!-- Floating Mini Cards -->
                        <div class="absolute -top-4 -right-4 w-16 h-16 bg-light-orange/20 backdrop-blur-sm rounded-xl flex items-center justify-center animate-float border border-light-orange/30">
                            <svg class="w-8 h-8 text-light-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-neon-blue/20 backdrop-blur-sm rounded-xl flex items-center justify-center animate-float border border-neon-blue/30" style="animation-delay: 1s;">
                            <svg class="w-8 h-8 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 3️⃣ SCROLL INDICATOR -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-30">
        <div class="opacity-0 animate-bounce" style="animation: fadeInBounce 1s ease-out 2s forwards;">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-pulse"></div>
            </div>
            <p class="text-white/70 text-xs mt-2 text-center font-medium">
                {{ app()->getLocale() === 'am' ? 'ወደ ታች ይሸብልሉ' : 'Scroll Down' }}
            </p>
        </div>
    </div>
</section>

<!-- 🔍 ADVANCED SEARCH & FILTERS -->
<section id="vehicle-search" class="py-20 relative overflow-hidden">
    <!-- Enhanced Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-soft-white via-blue-light/10 to-orange-light/5"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-neon-blue/3 rounded-full blur-3xl animate-pulse-soft"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-light-orange/4 rounded-full blur-3xl animate-pulse-soft" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-neon-blue/2 to-light-orange/2 rounded-full blur-2xl"></div>
    
    <div class="relative z-10 max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Enhanced Section Header -->
        <div class="text-center mb-16 animate-on-scroll">
            <!-- Premium Badge -->
            <div class="inline-flex items-center space-x-3 bg-white/90 backdrop-blur-xl rounded-full px-8 py-4 mb-8 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                <div class="w-3 h-3 bg-neon-blue rounded-full animate-pulse shadow-lg shadow-neon-blue/50"></div>
                <!-- <svg class="w-6 h-6 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg> -->
                <span class="text-sm font-bold text-neon-blue tracking-wide">
                    {{ app()->getLocale() === 'am' ? 'ስማርት ፍለጋ ሲስተም' : 'Smart Search System' }}
                </span>
                <div class="w-3 h-3 bg-light-orange rounded-full animate-pulse shadow-lg shadow-light-orange/50" style="animation-delay: 1s;"></div>
            </div>
            
            <!-- Main Heading -->
            <h2 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                @if(app()->getLocale() === 'am')
                    <span class="text-slate-900">የእርስዎን ተሽከርካሪ</span><br>
                    <span class="text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text animate-gradient-x">ያግኙ</span>
                @else
                    <span class="text-slate-900">Find Your Perfect</span><br>
                    <span class="text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text animate-gradient-x">Vehicle</span>
                @endif
            </h2>
            
            <!-- Enhanced Subtitle -->
            <div class="max-w-3xl mx-auto">
                <p class="text-xl text-slate-600 leading-relaxed mb-4">
                    @if(app()->getLocale() === 'am')
                        የተራቀቁ ማጣሪያዎችን በመጠቀም የሚፈልጉትን ተሽከርካሪ በቀላሉ ያግኙ
                    @else
                        Use our advanced filters to easily find the perfect rental vehicle for your needs
                    @endif
                </p>
                <div class="flex items-center justify-center space-x-6 text-sm text-slate-500">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ app()->getLocale() === 'am' ? 'ፈጣን ፍለጋ' : 'Instant Search' }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ app()->getLocale() === 'am' ? 'ስማርት ማጣሪያዎች' : 'Smart Filters' }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ app()->getLocale() === 'am' ? 'የተረጋገጡ ውጤቶች' : 'Verified Results' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🌟 PREMIUM SEARCH CARD -->
<div
    class="search-premium-card animate-on-scroll
           bg-white/80 backdrop-blur-2xl
           rounded-3xl
           shadow-[0_30px_80px_rgba(0,120,255,0.15)]
           border border-neon-blue/20
           p-10
           transition-all duration-700
           hover:shadow-[0_40px_120px_rgba(255,165,0,0.25)]
           hover:-translate-y-1"
    style="animation-delay: 0.2s;"
>
    <form method="GET" action="{{ route('vehicles.rentals') }}" class="space-y-14">

        <!-- ===================== -->
        <!-- 🚗 PRIMARY FILTERS -->
        <!-- ===================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Make -->
            <div class="filter-group group">
                <label class="filter-label mb-3 block">
                    <div class="label-content space-y-1">
                        <span class="label-title text-sm font-semibold text-slate-800 tracking-wide">
                            {{ app()->getLocale() === 'am' ? 'ብራንድ' : 'Vehicle Make' }}
                        </span>
                        <span class="label-subtitle text-xs text-slate-500">
                            {{ app()->getLocale() === 'am' ? 'የመኪና ብራንድ ይምረጡ' : 'Choose your preferred brand' }}
                        </span>
                    </div>
                </label>

                <select
                    name="make"
                    class="premium-select
                           w-full
                           rounded-xl
                           border border-slate-200
                           bg-white
                           px-4 py-3
                           text-slate-700
                           transition-all duration-300
                           focus:border-neon-blue
                           focus:ring-4 focus:ring-neon-blue/20
                           hover:border-neon-blue/60"
                >
                    <option value="">{{ app()->getLocale() === 'am' ? 'ሁሉም ብራንዶች' : 'All Makes' }}</option>
                    @foreach($makes as $make)
                        <option value="{{ $make }}" {{ request('make') === $make ? 'selected' : '' }}>
                            {{ $make }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div class="filter-group group">
                <label class="filter-label mb-3 block">
                    <div class="label-content space-y-1">
                        <span class="label-title text-sm font-semibold text-slate-800">
                            {{ app()->getLocale() === 'am' ? 'ምድብ' : 'Category' }}
                        </span>
                        <span class="label-subtitle text-xs text-slate-500">
                            {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ አይነት' : 'Vehicle type' }}
                        </span>
                    </div>
                </label>

                <select
                    name="category"
                    class="premium-select
                           w-full rounded-xl
                           border border-slate-200
                           bg-white
                           px-4 py-3
                           transition-all duration-300
                           hover:border-light-orange
                           focus:border-light-orange
                           focus:ring-4 focus:ring-light-orange/20"
                >
                    <option value="">{{ app()->getLocale() === 'am' ? 'ሁሉም ምድቦች' : 'All Categories' }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Min Price -->
            <div class="filter-group group">
                <label class="filter-label mb-3 block">
                    <span class="text-sm font-semibold text-slate-800">
                        {{ app()->getLocale() === 'am' ? 'ዝቅተኛ ዋጋ' : 'Min Price / Day' }}
                    </span>
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">$</span>
                    <input
                        type="number"
                        name="min_price"
                        value="{{ request('min_price') }}"
                        class="premium-input
                               w-full rounded-xl
                               border border-slate-200
                               bg-white
                               pl-8 pr-4 py-3
                               transition-all duration-300
                               hover:border-neon-blue
                               focus:border-neon-blue
                               focus:ring-4 focus:ring-neon-blue/20"
                    >
                </div>
            </div>

            <!-- Max Price -->
            <div class="filter-group group">
                <label class="filter-label mb-3 block">
                    <span class="text-sm font-semibold text-slate-800">
                        {{ app()->getLocale() === 'am' ? 'ከፍተኛ ዋጋ' : 'Max Price / Day' }}
                    </span>
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">$</span>
                    <input
                        type="number"
                        name="max_price"
                        value="{{ request('max_price') }}"
                        class="premium-input
                               w-full rounded-xl
                               border border-slate-200
                               bg-white
                               pl-8 pr-4 py-3
                               transition-all duration-300
                               hover:border-light-orange
                               focus:border-light-orange
                               focus:ring-4 focus:ring-light-orange/20"
                    >
                </div>
            </div>
        </div>

        <!-- ===================== -->
        <!-- 📅 DATE SECTION -->
        <!-- ===================== -->
        <div class="pt-10 border-t border-slate-200/60">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Pickup -->
                <input
                    type="date"
                    name="pickup_date"
                    class="premium-input
                           w-full rounded-xl
                           border border-slate-200
                           bg-white
                           px-4 py-3
                           transition-all duration-300
                           hover:border-neon-blue
                           focus:ring-4 focus:ring-neon-blue/20"
                >

                <!-- Return -->
                <input
                    type="date"
                    name="return_date"
                    class="premium-input
                           w-full rounded-xl
                           border border-slate-200
                           bg-white
                           px-4 py-3
                           transition-all duration-300
                           hover:border-light-orange
                           focus:ring-4 focus:ring-light-orange/20"
                >

                <!-- Actions -->
                <div class="flex gap-4">
                    <button
                        type="submit"
                        class="flex-1
                               rounded-xl
                               bg-gradient-to-r from-neon-blue to-blue-dark
                               text-white font-semibold
                               py-3
                               shadow-lg shadow-neon-blue/30
                               transition-all duration-500
                               hover:scale-105 hover:shadow-xl"
                    >
                        {{ app()->getLocale() === 'am' ? 'ፈልግ' : 'Search' }}
                    </button>

                    <button
                        type="button"
                        class="flex-1
                               rounded-xl
                               border border-light-orange
                               text-light-orange
                               font-semibold
                               py-3
                               transition-all duration-500
                               hover:bg-light-orange hover:text-white"
                    >
                        {{ app()->getLocale() === 'am' ? 'አጽዳ' : 'Clear' }}
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

        
        <!-- Search Tips -->
        <!-- <div class="mt-12 animate-on-scroll" style="animation-delay: 0.4s;">
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-white/50 shadow-lg">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">
                            {{ app()->getLocale() === 'am' ? 'ፍለጋ ምክሮች' : 'Search Tips' }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-600">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-neon-blue rounded-full"></div>
                                <span>{{ app()->getLocale() === 'am' ? 'ሁሉንም ማጣሪያዎች ባዶ ይተዉ ሁሉንም ተሽከርካሪዎች ለማየት' : 'Leave all filters empty to see all vehicles' }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-light-orange rounded-full"></div>
                                <span>{{ app()->getLocale() === 'am' ? 'የዋጋ ክልል ይጠቀሙ በበጀትዎ ውስጥ ለማግኘት' : 'Use price range to find vehicles within your budget' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>

<!-- 📊 RESULTS & SORTING -->
<section
    class="py-16 bg-soft-white relative overflow-hidden
           before:absolute before:inset-0
           before:bg-[radial-gradient(circle_at_top_left,rgba(0,120,255,0.06),transparent_40%)]
           after:absolute after:inset-0
           after:bg-[radial-gradient(circle_at_bottom_right,rgba(255,165,0,0.06),transparent_40%)]">

    <!-- Ambient Blobs -->
    <div class="absolute top-0 left-0 w-80 h-80 bg-neon-blue/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-light-orange/10 rounded-full blur-[120px]"></div>

    <div class="relative z-10 max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- 🌟 RESULTS HEADER CARD -->
        <div
            class="results-header-card animate-on-scroll
                   bg-white/80 backdrop-blur-2xl
                   rounded-3xl
                   border border-neon-blue/20
                   shadow-[0_30px_90px_rgba(0,120,255,0.15)]
                   p-8 lg:p-10
                   transition-all duration-700
                   hover:-translate-y-1
                   hover:shadow-[0_40px_120px_rgba(255,165,0,0.25)]">

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-10">

                <!-- ===================== -->
                <!-- 📊 RESULTS INFO -->
                <!-- ===================== -->
                <div class="results-info space-y-4">

                    <div class="flex items-center space-x-4">
                        <div
                            class="results-icon
                                   w-12 h-12
                                   rounded-xl
                                   bg-gradient-to-br from-neon-blue/15 to-neon-blue/5
                                   border border-neon-blue/20
                                   flex items-center justify-center
                                   shadow-inner">
                            <svg class="w-6 h-6 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                            </svg>
                        </div>

                        <h2 class="results-title text-xl md:text-2xl font-bold text-slate-800 tracking-tight">
                            {{ app()->getLocale() === 'am' ? 'የተገኙ ተሽከርካሪዎች' : 'Available Vehicles' }}
                        </h2>
                    </div>

                    <div class="results-count text-slate-600 text-sm md:text-base">
                        <span class="count-number text-2xl font-extrabold text-neon-blue mr-1">
                            {{ $vehicles->total() }}
                        </span>
                        {{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎች ተገኝተዋል' : 'vehicles found' }}
                    </div>

                    @if(request()->hasAny(['make', 'category', 'min_price', 'max_price', 'pickup_date', 'return_date']))
                        <div class="active-filters">
                            <span
                                class="filter-indicator
                                       inline-flex items-center gap-2
                                       px-4 py-2
                                       rounded-full
                                       bg-light-orange/10
                                       text-light-orange
                                       text-xs font-semibold
                                       border border-light-orange/30
                                       animate-pulse">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 4h18l-7 8v6l-4 2v-8L3 4z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ማጣሪያዎች ተተግብረዋል' : 'Filters Applied' }}
                            </span>
                        </div>
                    @endif
                </div>

                <!-- ===================== -->
                <!-- 🔀 SORT & VIEW -->
                <!-- ===================== -->
                <div
                    class="sort-section animate-on-scroll
                           flex flex-col sm:flex-row items-start sm:items-center gap-6
                           bg-white/60 backdrop-blur-xl
                           rounded-2xl
                           border border-slate-200
                           px-6 py-4
                           shadow-md"
                    style="animation-delay: 0.2s;">

                    <!-- Sort -->
                    <div class="sort-container flex items-center gap-3">
                        <label class="sort-label flex items-center gap-2 text-sm font-semibold text-slate-600">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ደርድር በ:' : 'Sort by:' }}
                        </label>

                        <select
                            onchange="updateSort(this.value)"
                            class="premium-sort-select
                                   rounded-xl
                                   border border-slate-200
                                   bg-white
                                   px-4 py-2
                                   text-sm
                                   transition-all duration-300
                                   hover:border-neon-blue
                                   focus:border-neon-blue
                                   focus:ring-4 focus:ring-neon-blue/20">
                            <option value="created_at-desc">Newest</option>
                            <option value="price-asc">Price: Low → High</option>
                            <option value="price-desc">Price: High → Low</option>
                        </select>
                    </div>

                    <!-- View Toggle -->
                    <div class="view-toggle flex gap-2">
                        <button
                            class="view-btn active
                                   w-10 h-10
                                   rounded-xl
                                   bg-neon-blue text-white
                                   flex items-center justify-center
                                   shadow-lg shadow-neon-blue/30
                                   transition-all duration-300
                                   hover:scale-110">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h6v6H4zM14 6h6v6h-6zM4 16h6v6H4zM14 16h6v6h-6z"/>
                            </svg>
                        </button>

                        <button
                            class="view-btn
                                   w-10 h-10
                                   rounded-xl
                                   border border-slate-300
                                   text-slate-500
                                   flex items-center justify-center
                                   transition-all duration-300
                                   hover:bg-light-orange hover:text-white
                                   hover:border-light-orange">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- 🎁 ACTIVE DISCOUNTS BANNER -->
@php
    $activeDiscounts = \App\Services\DiscountService::class;
    $discountService = app($activeDiscounts);
    $rentalDiscounts = $discountService->getActiveDiscounts('rental');
@endphp

@if($rentalDiscounts->count() > 0)
<section class="py-8 bg-gradient-to-r from-neon-blue/10 via-blue-light/20 to-light-orange/10 border-y border-blue-light/30">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-6">
            <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-neon-blue to-blue-glow text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                </svg>
                <span>{{ app()->getLocale() === 'am' ? 'ንቁ ቅናሾች' : 'Active Discounts' }}</span>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 mb-2">
                {{ app()->getLocale() === 'am' ? 'የኪራይ ቅናሾች' : 'Rental Discounts Available' }}
            </h2>
            <p class="text-slate-600">
                {{ app()->getLocale() === 'am' ? 'በኪራይዎ ላይ ቆጣቢ ይሁኑ' : 'Save money on your rental bookings' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($rentalDiscounts as $discount)
            <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-{{ $discount->type === 'holiday' ? 'purple' : 'blue' }}-500 to-{{ $discount->type === 'holiday' ? 'purple' : 'blue' }}-600 rounded-lg flex items-center justify-center">
                            @if($discount->type === 'holiday')
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-900">{{ $discount->name }}</h3>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                {{ $discount->type === 'holiday' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($discount->type) }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-green-600">{{ $discount->percentage }}%</div>
                        <div class="text-xs text-slate-500">{{ app()->getLocale() === 'am' ? 'ቅናش' : 'OFF' }}</div>
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
                @else
                    @if($discount->conditions)
                        <div class="space-y-2">
                            <div class="text-sm text-slate-500 mb-2">{{ app()->getLocale() === 'am' ? 'ሁኔታዎች:' : 'Conditions:' }}</div>
                            @foreach($discount->conditions as $condition)
                                <div class="flex items-center justify-between text-sm bg-slate-50 rounded-lg px-3 py-2">
                                    <span class="text-slate-600">
                                        {{ $condition['min_days'] }}
                                        @if(isset($condition['max_days']))
                                            - {{ $condition['max_days'] }}
                                        @else
                                            +
                                        @endif
                                        {{ app()->getLocale() === 'am' ? 'ቀናት' : 'days' }}
                                    </span>
                                    <span class="font-medium text-green-600">{{ $condition['percentage'] }}% {{ app()->getLocale() === 'am' ? 'ቅናش' : 'OFF' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
            @endforeach
        </div>
        
        <!-- Discount Calculator Tool -->
        <div class="mt-8 bg-white rounded-xl p-6 shadow-sm border border-slate-200">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">
                {{ app()->getLocale() === 'am' ? 'የቅናሽ ካልኩሌተር' : 'Discount Calculator' }}
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        {{ app()->getLocale() === 'am' ? 'የኪራይ መጠን ($)' : 'Rental Amount ($)' }}
                    </label>
                    <input type="number" id="calc-amount" step="0.01" min="1" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent"
                           placeholder="100.00">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        {{ app()->getLocale() === 'am' ? 'የመነሻ ቀን' : 'Start Date' }}
                    </label>
                    <input type="date" id="calc-start-date" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        {{ app()->getLocale() === 'am' ? 'የመጨረሻ ቀን' : 'End Date' }}
                    </label>
                    <input type="date" id="calc-end-date" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-neon-blue focus:border-transparent">
                </div>
                <div>
                    <button onclick="calculateDiscount()" 
                            class="w-full bg-neon-blue text-white py-2 px-4 rounded-lg hover:bg-blue-dark transition-all duration-200">
                        {{ app()->getLocale() === 'am' ? 'ሰላሳ' : 'Calculate' }}
                    </button>
                </div>
            </div>
            <div id="calc-result" class="mt-4 hidden">
                <!-- Results will be shown here -->
            </div>
        </div>
    </div>
</section>
@endif

        <!-- 🚗 PREMIUM VEHICLE GRID -->
        @if($vehicles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($vehicles as $index => $vehicle)
                    <div class="card-premium card-glow-blue animate-on-scroll" style="animation-delay: {{ $index * 0.1 }}s;">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                        </svg>
                                        <p class="text-sm text-slate-500">{{ $vehicle->full_name }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-slate-500">{{ $vehicle->full_name }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg">
                                    {{ app()->getLocale() === 'am' ? 'ይገኛል' : 'Available' }}
                                </span>
                            </div>
                            
                            <!-- Price Badge -->
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm rounded-xl px-4 py-2 shadow-lg">
                                <div class="text-xl font-bold text-neon-blue">ETB {{ number_format($vehicle->rental_price_per_day, 0) }}</div>
                                <div class="text-xs text-slate-500 text-center">{{ app()->getLocale() === 'am' ? '/ቀን' : '/day' }}</div>
                            </div>
                            
                            <!-- Driving Options Overlay -->
                            <div class="absolute bottom-4 left-4 flex space-x-2">
                                @if($vehicle->self_drive_available)
                                    <span class="bg-neon-blue/90 text-white text-xs font-medium px-2 py-1 rounded-full backdrop-blur-sm">
                                        {{ app()->getLocale() === 'am' ? 'ራስዎ ይንዱ' : 'Self Drive' }}
                                    </span>
                                @endif
                                @if($vehicle->with_driver_available)
                                    <span class="bg-light-orange/90 text-slate-800 text-xs font-medium px-2 py-1 rounded-full backdrop-blur-sm">
                                        {{ app()->getLocale() === 'am' ? 'ከሹፌር ጋር' : 'With Driver' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Vehicle Info -->
                        <div class="p-6">
                            <h3 class="text-heading text-slate-900 mb-3">{{ $vehicle->full_name }}</h3>
                            
                            <!-- Vehicle Features Grid -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    <span>{{ ucfirst($vehicle->transmission) }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span>{{ $vehicle->seating_capacity }} {{ app()->getLocale() === 'am' ? 'መቀመጫ' : 'seats' }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                    </svg>
                                    <span>{{ ucfirst($vehicle->fuel_type) }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <span>{{ ucfirst($vehicle->category) }}</span>
                                </div>
                            </div>
                            
                            <!-- Driver Cost Info -->
                            @if($vehicle->with_driver_available && $vehicle->driver_cost_per_day)
                                <div class="bg-orange-light/30 rounded-lg p-3 mb-4">
                                    <div class="flex items-center space-x-2 text-sm">
                                        <svg class="w-4 h-4 text-orange-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span class="text-orange-dark font-medium">
                                            +ETB {{ number_format($vehicle->driver_cost_per_day, 0) }}/{{ app()->getLocale() === 'am' ? 'ቀን ለሹፌር' : 'day for driver' }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Action Buttons -->
                            <!-- <div class="flex space-x-3">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="btn-secondary flex-1 text-center">
                                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    {{ app()->getLocale() === 'am' ? 'ዝርዝር' : 'Details' }}
                                </a>
                                
                                @auth
                                    <a href="{{ route('bookings.create', $vehicle) }}" class="btn-primary flex-1 text-center">
                                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ app()->getLocale() === 'am' ? 'ይከራዩ' : 'Rent Now' }}
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-primary flex-1 text-center">
                                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        {{ app()->getLocale() === 'am' ? 'ይከራዩ' : 'Rent Now' }}
                                    </a>
                                @endauth
                            </div> -->
                            <div class="flex space-x-4 mt-4">
    
    <!-- 🔍 Details Button -->
    <a href="{{ route('vehicles.show', $vehicle) }}"
       class="group flex-1 inline-flex items-center justify-center gap-2 rounded-xl 
              bg-white/90 backdrop-blur-md border border-slate-200
              px-5 py-3 text-sm font-semibold text-slate-700
              shadow-sm transition-all duration-300 ease-out
              hover:-translate-y-0.5 hover:shadow-lg hover:border-slate-300
              hover:bg-white
              focus:outline-none focus:ring-2 focus:ring-blue-500/30">

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
        <!-- 🚗 Rent Now (Authenticated) -->
        <a href="{{ route('bookings.create', $vehicle) }}"
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
                {{ app()->getLocale() === 'am' ? 'ይከራዩ' : 'Rent Now' }}
            </span>
        </a>
    @else
        <!-- 🔐 Rent Now (Guest) -->
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
                {{ app()->getLocale() === 'am' ? 'ይከራዩ' : 'Rent Now' }}
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
        @else
            <!-- No Results State -->
            <div class="text-center py-20 animate-on-scroll">
                <div class="w-32 h-32 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-heading text-slate-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'ምንም ተሽከርካሪ አልተገኘም' : 'No Vehicles Found' }}
                </h3>
                <p class="text-body mb-8 max-w-md mx-auto">
                    {{ app()->getLocale() === 'am' ? 'የፍለጋ መስፈርቶችዎን ይለውጡ እና እንደገና ይሞክሩ። ወይም ሁሉንም ተሽከርካሪዎች ይመልከቱ።' : 'Try adjusting your search criteria or view all available vehicles in our rental fleet.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="clearFilters()" class="btn-primary">
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
    console.log('🚗 Premium Rental Fleet Loaded');
    
    // Parallax effect for rental hero image
    const rentalImage = document.querySelector('.rental-hero-image');
    let ticking = false;
    
    function updateRentalParallax() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.2;
        
        if (rentalImage) {
            rentalImage.style.transform = `scale(1.05) translateY(${rate}px)`;
        }
        ticking = false;
    }
    
    function requestRentalTick() {
        if (!ticking) {
            requestAnimationFrame(updateRentalParallax);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestRentalTick);
    
    // Update return date when pickup date changes
    const pickupInput = document.querySelector('input[name="pickup_date"]');
    const returnInput = document.querySelector('input[name="return_date"]');
    
    if (pickupInput && returnInput) {
        pickupInput.addEventListener('change', function() {
            const pickupDate = new Date(this.value);
            const minReturnDate = new Date(pickupDate);
            minReturnDate.setDate(minReturnDate.getDate() + 1);
            returnInput.min = minReturnDate.toISOString().split('T')[0];
            
            if (returnInput.value && new Date(returnInput.value) <= pickupDate) {
                returnInput.value = minReturnDate.toISOString().split('T')[0];
            }
        });
    }
    
    // Smooth scroll for CTA buttons
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
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
    window.location.href = '{{ route("vehicles.rentals") }}';
}

// Discount Calculator
function calculateDiscount() {
    const amount = document.getElementById('calc-amount').value;
    const startDate = document.getElementById('calc-start-date').value;
    const endDate = document.getElementById('calc-end-date').value;
    
    if (!amount || !startDate || !endDate) {
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
            type: 'rental',
            amount: amount,
            start_date: startDate,
            end_date: endDate
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(result => {
        const resultDiv = document.getElementById('calc-result');
        
        if (result.has_discount) {
            resultDiv.innerHTML = `
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h4 class="font-medium text-green-900 mb-3">{{ app()->getLocale() === 'am' ? 'ቅናሽ ተተግብሯል!' : 'Discount Applied!' }}</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-green-700 font-medium">{{ app()->getLocale() === 'am' ? 'የመጀመሪያ መጠን:' : 'Original Amount:' }}</span>
                            <div class="text-lg font-bold text-slate-900">ETB ${result.original_amount}</div>
                        </div>
                        <div>
                            <span class="text-green-700 font-medium">{{ app()->getLocale() === 'am' ? 'ቅናሽ:' : 'Discount:' }}</span>
                            <div class="text-lg font-bold text-green-600">-ETB ${result.discount_amount}</div>
                        </div>
                        <div>
                            <span class="text-green-700 font-medium">{{ app()->getLocale() === 'am' ? 'የመጨረሻ መጠን:' : 'Final Amount:' }}</span>
                            <div class="text-lg font-bold text-neon-blue">ETB ${result.final_amount}</div>
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
        const resultDiv = document.getElementById('calc-result');
        
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
/* 🎨 CINEMATIC RENTAL HERO STYLES */

/* Rental immersion layer */
.rental-immersion-layer {
    will-change: transform;
}

.rental-hero-image {
    will-change: transform;
    transition: transform 0.1s ease-out;
}

/* Rental brand container */
.rental-brand-container {
    position: relative;
}

.rental-brand-container::before {
    content: '';
    position: absolute;
    top: -3rem;
    left: -3rem;
    right: 3rem;
    bottom: -3rem;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, transparent 50%, rgba(253, 186, 116, 0.05) 100%);
    border-radius: 3rem;
    backdrop-filter: blur(8px);
    z-index: -1;
}

/* Rental headline animations */
.rental-headline .headline-line {
    display: block;
    margin-bottom: 0.5rem;
}

.rental-headline .headline-line span {
    text-shadow: 0 6px 30px rgba(0, 0, 0, 0.4);
}

/* Rental badge styling */
.rental-badge {
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.rental-subtitle {
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.rental-subtitle p {
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
}

/* Rental stats enhanced styling */
.rental-stats {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.rental-stats .text-center:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 35px rgba(255, 255, 255, 0.15);
}

/* Rental actions styling */
.rental-actions {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Premium CTA Buttons for Rental */
.premium-cta-primary {
    @apply inline-flex items-center px-8 py-4 bg-neon-blue text-white font-semibold rounded-2xl;
    @apply transition-all duration-300 ease-out;
    @apply hover:bg-blue-dark hover:shadow-xl hover:shadow-neon-blue/40;
    @apply transform hover:-translate-y-2 hover:scale-105;
    @apply border border-neon-blue/30;
    backdrop-filter: blur(15px);
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.4);
}

.premium-cta-primary:active {
    transform: translateY(-1px) scale(1.02);
}

.premium-cta-secondary {
    @apply inline-flex items-center px-8 py-4 bg-white/15 text-white font-semibold rounded-2xl;
    @apply transition-all duration-300 ease-out;
    @apply hover:bg-light-orange hover:text-slate-900 hover:shadow-xl hover:shadow-light-orange/40;
    @apply transform hover:-translate-y-2 hover:scale-105;
    @apply border border-white/30 hover:border-light-orange;
    backdrop-filter: blur(15px);
}

.premium-cta-secondary:active {
    transform: translateY(-1px) scale(1.02);
}

/* Rental features showcase */
.rental-features-showcase {
    position: relative;
}

/* 🔍 PREMIUM SEARCH SECTION STYLES */

/* Search Premium Card */
.search-premium-card {
    @apply bg-white/98 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/60 p-12;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.96) 100%);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

.search-premium-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 35px 70px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(255, 255, 255, 0.7), inset 0 1px 0 rgba(255, 255, 255, 0.9);
}

/* Enhanced Filter Group Styling */
.filter-group {
    @apply relative;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.filter-group:hover {
    transform: translateY(-4px);
}

/* Enhanced Filter Label */
.filter-label {
    @apply flex items-start space-x-4 text-sm font-bold text-slate-800 mb-6;
    transition: all 0.3s ease;
}

.filter-label:hover {
    @apply text-neon-blue;
}

.label-icon {
    @apply w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0;
    transition: all 0.4s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.filter-group:hover .label-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.2);
}

.label-content {
    @apply flex flex-col;
}

.label-title {
    @apply text-base font-bold text-slate-900 leading-tight;
}

.label-subtitle {
    @apply text-xs text-slate-500 mt-1 leading-relaxed;
}

/* Premium Select Styling */
.premium-select {
    @apply w-full px-5 py-4 bg-white/90 backdrop-blur-sm border-2 border-slate-200 rounded-2xl;
    @apply text-slate-900 font-semibold shadow-lg;
    @apply focus:outline-none focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20;
    @apply hover:border-slate-300 hover:shadow-xl;
    @apply transition-all duration-300 ease-out;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.9) 100%);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

.premium-select:focus {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15), 0 0 0 4px rgba(37, 99, 235, 0.1);
}

/* Premium Input Styling */
.premium-input {
    @apply w-full px-5 py-4 bg-white/90 backdrop-blur-sm border-2 border-slate-200 rounded-2xl;
    @apply text-slate-900 font-semibold shadow-lg placeholder-slate-400;
    @apply focus:outline-none focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20;
    @apply hover:border-slate-300 hover:shadow-xl;
    @apply transition-all duration-300 ease-out;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.9) 100%);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

.premium-input:focus {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15), 0 0 0 4px rgba(37, 99, 235, 0.1);
}

/* Enhanced Date Selection Section */
.date-selection-section {
    @apply mt-12;
}

.section-divider {
    @apply flex items-center justify-center space-x-6;
}

.divider-line {
    @apply flex-1 h-px bg-gradient-to-r from-transparent via-slate-300 to-transparent;
}

.divider-icon-enhanced {
    @apply relative w-16 h-16 bg-white/95 backdrop-blur-sm rounded-full flex items-center justify-center shadow-xl border-2 border-white/60;
    transition: all 0.4s ease;
}

.divider-icon-enhanced:hover {
    @apply bg-neon-blue/10 border-neon-blue/30;
    transform: scale(1.15) rotate(10deg);
}

.icon-glow {
    @apply absolute inset-0 rounded-full;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
    animation: pulse 2s infinite;
}

/* Enhanced Action Buttons */
.action-buttons-enhanced {
    @apply flex flex-col space-y-4 mt-8;
}

.search-btn-primary {
    @apply relative flex items-center justify-center px-8 py-4 bg-gradient-to-r from-neon-blue to-blue-dark text-white font-bold rounded-2xl;
    @apply transition-all duration-300 ease-out overflow-hidden;
    @apply hover:shadow-2xl hover:shadow-neon-blue/40;
    @apply transform hover:-translate-y-2 hover:scale-105;
    @apply focus:outline-none focus:ring-4 focus:ring-neon-blue/30;
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

.search-btn-primary:active {
    transform: translateY(-1px) scale(1.02);
}

.btn-content {
    @apply relative z-10 flex items-center space-x-3;
}

.btn-glow {
    @apply absolute inset-0 bg-gradient-to-r from-blue-glow/20 to-neon-blue/20 rounded-2xl;
    animation: glow 2s ease-in-out infinite alternate;
}

.search-btn-secondary {
    @apply relative flex items-center justify-center px-8 py-4 bg-white/95 text-slate-700 font-bold rounded-2xl;
    @apply transition-all duration-300 ease-out border-2 border-slate-200;
    @apply hover:bg-light-orange hover:text-slate-900 hover:border-light-orange hover:shadow-2xl hover:shadow-light-orange/40;
    @apply transform hover:-translate-y-2 hover:scale-105;
    @apply focus:outline-none focus:ring-4 focus:ring-light-orange/30;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.95) 100%);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

.search-btn-secondary:active {
    transform: translateY(-1px) scale(1.02);
}

/* Gradient Animation */
@keyframes animate-gradient-x {
    0%, 100% {
        background-size: 200% 200%;
        background-position: left center;
    }
    50% {
        background-size: 200% 200%;
        background-position: right center;
    }
}

.animate-gradient-x {
    animation: animate-gradient-x 3s ease infinite;
}

/* Enhanced Glow Animation */
@keyframes glow {
    0% {
        opacity: 0.5;
        transform: scale(0.95);
    }
    100% {
        opacity: 0.8;
        transform: scale(1.05);
    }
}

/* 📊 RESULTS & SORTING STYLES */

/* Results Header Card */
.results-header-card {
    @apply bg-white/95 backdrop-blur-xl rounded-3xl shadow-xl border border-white/50 p-8 mb-12;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.95) 100%);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.5);
}

.results-header-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(255, 255, 255, 0.6);
}

/* Results Info */
.results-info {
    @apply flex-1;
}

.results-icon {
    @apply w-12 h-12 bg-neon-blue/10 rounded-2xl flex items-center justify-center;
    transition: all 0.3s ease;
}

.results-icon:hover {
    @apply bg-neon-blue/20;
    transform: scale(1.1);
}

.results-title {
    @apply text-2xl lg:text-3xl font-bold text-slate-900;
    background: linear-gradient(135deg, #1E293B 0%, #2563EB 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.results-count {
    @apply text-lg text-slate-600 font-medium;
}

.count-number {
    @apply text-2xl font-bold text-neon-blue;
}

.active-filters {
    @apply mt-3;
}

.filter-indicator {
    @apply inline-flex items-center space-x-2 bg-light-orange/20 text-orange-dark px-4 py-2 rounded-full text-sm font-medium;
    @apply border border-light-orange/30;
}

/* Sort Section */
.sort-section {
    @apply flex items-center space-x-6;
}

.sort-container {
    @apply flex items-center space-x-3;
}

.sort-label {
    @apply flex items-center space-x-2 text-sm font-semibold text-slate-700 whitespace-nowrap;
}

.premium-sort-select {
    @apply px-4 py-3 bg-white/90 backdrop-blur-sm border-2 border-slate-200 rounded-xl;
    @apply text-slate-900 font-medium shadow-sm min-w-48;
    @apply focus:outline-none focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20;
    @apply hover:border-slate-300 hover:shadow-md;
    @apply transition-all duration-300 ease-out;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.9) 100%);
}

.premium-sort-select:focus {
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
}

/* View Toggle */
.view-toggle {
    @apply flex items-center space-x-1 bg-slate-100 rounded-xl p-1;
}

.view-btn {
    @apply p-3 rounded-lg transition-all duration-200 text-slate-500 hover:text-slate-700;
}

.view-btn.active {
    @apply bg-white text-neon-blue shadow-sm;
}

.view-btn:hover:not(.active) {
    @apply bg-white/50;
}

/* Enhanced animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(40px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInBounce {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    50% {
        opacity: 0.5;
        transform: translateY(-5px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile responsive improvements */
@media (max-width: 768px) {
    .rental-hero-image {
        background-position: center center !important;
    }
    
    .rental-headline .headline-line span {
        font-size: 3rem !important;
    }
    
    .rental-brand-container::before {
        top: -1.5rem;
        left: -1.5rem;
        right: 1.5rem;
        bottom: -1.5rem;
    }
    
    .rental-stats .grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .rental-actions .flex {
        flex-direction: column;
        width: 100%;
    }
    
    .premium-cta-primary,
    .premium-cta-secondary {
        width: 100%;
        justify-content: center;
    }
    
    .search-premium-card {
        @apply p-6;
    }
    
    .filter-group {
        margin-bottom: 1.5rem;
    }
    
    .action-buttons {
        @apply flex-col space-y-3;
    }
    
    .sort-section {
        @apply flex-col space-y-4 space-x-0 items-stretch;
    }
    
    .sort-container {
        @apply flex-col space-y-2 space-x-0 items-stretch;
    }
    
    .premium-sort-select {
        @apply min-w-full;
    }
    
    .results-header-card {
        @apply p-6;
    }
    
    .results-title {
        @apply text-xl;
    }
}

/* Scroll indicator styling */
.scroll-indicator {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
        transform: translate3d(0,0,0);
    }
    40%, 43% {
        transform: translate3d(0,-8px,0);
    }
    70% {
        transform: translate3d(0,-4px,0);
    }
    90% {
        transform: translate3d(0,-2px,0);
    }
}

/* Enhanced glass effects */
.rental-features-showcase .bg-white\/10 {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
}

.rental-features-showcase .bg-white\/10:hover {
    background: rgba(255, 255, 255, 0.18);
    transform: translateY(-5px);
    box-shadow: 0 35px 70px rgba(0, 0, 0, 0.3);
}

/* Premium floating elements */
.rental-features-showcase .animate-float {
    animation: float 4s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    25% {
        transform: translateY(-10px) rotate(1deg);
    }
    50% {
        transform: translateY(-5px) rotate(-1deg);
    }
    75% {
        transform: translateY(-15px) rotate(0.5deg);
    }
}

/* Enhanced backdrop blur for better readability */
.rental-subtitle .bg-slate-900\/40 {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(25px) saturate(150%);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.rental-badge .bg-white\/15 {
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.25);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

/* Premium gradient text effects */
.rental-headline .bg-gradient-to-r {
    background: linear-gradient(135deg, #2563EB 0%, #60A5FA 30%, #FDBA74 70%, #FED7AA 100%);
    background-size: 200% 200%;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

/* Focus states for accessibility */
.premium-select:focus,
.premium-input:focus,
.search-btn-primary:focus,
.search-btn-secondary:focus,
.premium-sort-select:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
}

/* Hover effects for interactive elements */
.filter-group:hover .premium-select,
.filter-group:hover .premium-input {
    border-color: rgba(37, 99, 235, 0.3);
    box-shadow: 0 5px 15px rgba(37, 99, 235, 0.1);
}

/* Loading states */
.search-btn-primary:disabled,
.search-btn-secondary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Success states */
.filter-indicator {
    animation: slideInFromRight 0.5s ease-out;
}

@keyframes slideInFromRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>
@endpush
@endsection
