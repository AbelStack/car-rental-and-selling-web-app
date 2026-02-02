@extends('layouts.app')

@section('title', 'Dashboard - Addis Drive Vehicle Services')

@section('content')
<!-- Modern Dashboard with Advanced Animations -->
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-purple-600/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-indigo-400/20 to-cyan-600/20 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-purple-400/10 to-pink-600/10 rounded-full blur-2xl animate-pulse-slow"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Enhanced Page Header with Glass Morphism -->
        <div class="mb-12 transform animate-slide-down">
            <div class="backdrop-blur-xl bg-white/30 border border-white/20 rounded-3xl p-8 shadow-2xl">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-4">
                            <!-- Animated Avatar -->
                            <div class="relative">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg animate-glow">
                                    <span class="text-2xl font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-3 border-white animate-pulse"></div>
                            </div>
                            
                            <div>
                                <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent animate-gradient">
                                    @if(app()->getLocale() === 'am')
                                        እንኳን ደህና መጡ, {{ auth()->user()->name }}
                                    @else
                                        Welcome back, {{ auth()->user()->name }}
                                    @endif
                                </h1>
                                <p class="text-lg text-gray-600 mt-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                                    @if(app()->getLocale() === 'am')
                                        የእርስዎ የመኪና ማከራያ እና ሽያጭ ዳሽቦርድ
                                    @else
                                        Your Addis Drive Dashboard
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        @if(config('app.debug'))
                        <div class="mt-4 px-4 py-2 bg-gray-100/50 rounded-lg backdrop-blur-sm">
                            <p class="text-sm text-gray-600">Debug: User ID {{ auth()->user()->id }} ({{ auth()->user()->email }})</p>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Time and Date Display -->
                    <div class="mt-6 lg:mt-0 lg:ml-8">
                        <div class="text-right">
                            <div class="text-2xl font-bold text-gray-800" id="current-time"></div>
                            <div class="text-sm text-gray-600" id="current-date"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced KYC Verification Alert -->
        @if(!auth()->user()->isKycVerified())
            <div class="mb-8 transform animate-slide-up" style="animation-delay: 0.3s;">
                <div class="backdrop-blur-xl bg-gradient-to-r from-amber-50/80 to-orange-50/80 border border-amber-200/50 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center animate-bounce-gentle">
                                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-amber-900 mb-2">
                                @if(app()->getLocale() === 'am')
                                    🔐 KYC ማረጋገጫ ያስፈልጋል
                                @else
                                    🔐 KYC Verification Required
                                @endif
                            </h3>
                            <p class="text-amber-800 mb-4 leading-relaxed">
                                @if(app()->getLocale() === 'am')
                                    ተሽከርካሪዎችን ለመከራየት እና ለመግዛት የእርስዎን ማንነት ማረጋገጥ ያስፈልጋል። እባክዎ KYC ማረጋገጫዎን ያጠናቅቁ።
                                @else
                                    You need to verify your identity to rent and purchase vehicles. Please complete your KYC verification to unlock all features.
                                @endif
                            </p>
                            <a href="{{ route('kyc.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-orange-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                @if(app()->getLocale() === 'am')
                                    KYC ማረጋገጫ ጀምር
                                @else
                                    Start KYC Verification
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Statistics Cards with Glass Morphism -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Bookings Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.1s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <!-- Animated Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-blue">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['total_bookings'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">
                                    @if(app()->getLocale() === 'am')
                                        ጠቅላላ ቦታ ማስያዝ
                                    @else
                                        Total Bookings
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['total_bookings'] / 10) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">
                            @if(app()->getLocale() === 'am')
                                የዚህ ወር እንቅስቃሴ
                            @else
                                This month's activity
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Active Bookings Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.2s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-emerald-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-green">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['active_bookings'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">
                                    @if(app()->getLocale() === 'am')
                                        ንቁ ቦታ ማስያዝ
                                    @else
                                        Active Bookings
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['active_bookings'] / 5) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">
                            @if(app()->getLocale() === 'am')
                                በአሁኑ ጊዜ ንቁ
                            @else
                                Currently active
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Purchases Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.3s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-purple">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['total_purchases'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">
                                    @if(app()->getLocale() === 'am')
                                        ጠቅላላ ግዢዎች
                                    @else
                                        Total Purchases
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['total_purchases'] / 3) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">
                            @if(app()->getLocale() === 'am')
                                የተጠናቀቁ ግዢዎች
                            @else
                                Completed purchases
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Completed Purchases Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.4s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-red-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-orange">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['completed_purchases'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">
                                    @if(app()->getLocale() === 'am')
                                        የተጠናቀቁ ግዢዎች
                                    @else
                                        Completed Purchases
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['completed_purchases'] / 3) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">
                            @if(app()->getLocale() === 'am')
                                ተሳክተዋል
                            @else
                                Successfully completed
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Recent Activity Section -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-12">
            <!-- Recent Bookings with Modern Design -->
            <div class="transform animate-slide-left" style="animation-delay: 0.5s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl shadow-xl overflow-hidden">
                    <!-- Header with Gradient -->
                    <div class="bg-gradient-to-r from-blue-500/10 to-purple-600/10 px-6 py-4 border-b border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @if(app()->getLocale() === 'am')
                                    የቅርብ ጊዜ ቦታ ማስያዝ
                                @else
                                    Recent Bookings
                                @endif
                            </h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $bookings->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if($bookings->count() > 0)
                            <div class="space-y-4">
                                @foreach($bookings as $index => $booking)
                                    <div class="group flex items-center justify-between p-4 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl hover:bg-white/70 transition-all duration-300 transform hover:scale-[1.02] animate-fade-in-up" style="animation-delay: {{ 0.6 + ($index * 0.1) }}s;">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative flex-shrink-0">
                                                @if($booking->vehicle->primary_image)
                                                    <img class="h-14 w-14 rounded-xl object-cover shadow-lg group-hover:shadow-xl transition-shadow duration-300" src="{{ $booking->vehicle->primary_image }}" alt="{{ $booking->vehicle->full_name }}">
                                                @else
                                                    <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-lg">
                                                        <svg class="h-7 w-7 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">{{ $booking->vehicle->full_name }}</p>
                                                <p class="text-xs text-gray-600 font-medium">{{ $booking->booking_reference }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $booking->pickup_date->format('M d') }} - {{ $booking->return_date->format('M d, Y') }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                                @if($booking->status === 'confirmed') bg-gradient-to-r from-green-100 to-green-200 text-green-800
                                                @elseif($booking->status === 'pending_payment') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800
                                                @elseif($booking->status === 'cancelled') bg-gradient-to-r from-red-100 to-red-200 text-red-800
                                                @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 @endif">
                                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                            <p class="text-lg font-bold text-gray-900 mt-2">ETB {{ number_format($booking->total_amount, 0) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('dashboard.bookings') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    @if(app()->getLocale() === 'am')
                                        ሁሉንም ይመልከቱ
                                    @else
                                        View All Bookings
                                    @endif
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">
                                    @if(app()->getLocale() === 'am')
                                        ገና ምንም ቦታ አላስያዙም።
                                    @else
                                        No bookings yet.
                                    @endif
                                </p>
                                <p class="text-sm text-gray-400 mt-2">
                                    @if(app()->getLocale() === 'am')
                                        የመጀመሪያ ቦታ ማስያዝዎን ይጀምሩ!
                                    @else
                                        Start your first booking today!
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Purchases with Modern Design -->
            <div class="transform animate-slide-right" style="animation-delay: 0.6s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl shadow-xl overflow-hidden">
                    <!-- Header with Gradient -->
                    <div class="bg-gradient-to-r from-purple-500/10 to-pink-600/10 px-6 py-4 border-b border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                @if(app()->getLocale() === 'am')
                                    የቅርብ ጊዜ ግዢዎች
                                @else
                                    Recent Purchases
                                @endif
                            </h3>
                            <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $purchases->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if($purchases->count() > 0)
                            <div class="space-y-4">
                                @foreach($purchases as $index => $purchase)
                                    <div class="group flex items-center justify-between p-4 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl hover:bg-white/70 transition-all duration-300 transform hover:scale-[1.02] animate-fade-in-up" style="animation-delay: {{ 0.7 + ($index * 0.1) }}s;">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative flex-shrink-0">
                                                @if($purchase->vehicle->primary_image)
                                                    <img class="h-14 w-14 rounded-xl object-cover shadow-lg group-hover:shadow-xl transition-shadow duration-300" src="{{ $purchase->vehicle->primary_image }}" alt="{{ $purchase->vehicle->full_name }}">
                                                @else
                                                    <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-lg">
                                                        <svg class="h-7 w-7 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-purple-500 rounded-full border-2 border-white animate-pulse"></div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">{{ $purchase->vehicle->full_name }}</p>
                                                <p class="text-xs text-gray-600 font-medium">{{ $purchase->purchase_reference }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $purchase->created_at->format('M d, Y') }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                                @if($purchase->status === 'completed') bg-gradient-to-r from-green-100 to-green-200 text-green-800
                                                @elseif($purchase->status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800
                                                @elseif($purchase->status === 'rejected') bg-gradient-to-r from-red-100 to-red-200 text-red-800
                                                @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 @endif">
                                                {{ ucfirst($purchase->status) }}
                                            </span>
                                            <p class="text-lg font-bold text-gray-900 mt-2">ETB {{ number_format($purchase->total_amount, 0) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('dashboard.purchases') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    @if(app()->getLocale() === 'am')
                                        ሁሉንም ይመልከቱ
                                    @else
                                        View All Purchases
                                    @endif
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">
                                    @if(app()->getLocale() === 'am')
                                        ገና ምንም አልገዙም።
                                    @else
                                        No purchases yet.
                                    @endif
                                </p>
                                <p class="text-sm text-gray-400 mt-2">
                                    @if(app()->getLocale() === 'am')
                                        የመጀመሪያ ግዢዎን ይጀምሩ!
                                    @else
                                        Start your first purchase today!
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-white shadow rounded-lg animate__animated animate__fadeInUp">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    @if(app()->getLocale() === 'am')
                        ፈጣን እርምጃዎች
                    @else
                        Quick Actions
                    @endif
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- KYC Verification Status -->
                    <a href="{{ route('kyc.index') }}" class="bg-{{ auth()->user()->isKycVerified() ? 'green' : 'yellow' }}-50 hover:bg-{{ auth()->user()->isKycVerified() ? 'green' : 'yellow' }}-100 p-4 rounded-lg text-center transition duration-300 animate-button-hover animate-scale-on-hover">
                        <svg class="mx-auto h-8 w-8 text-{{ auth()->user()->isKycVerified() ? 'green' : 'yellow' }}-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <p class="text-sm font-medium text-{{ auth()->user()->isKycVerified() ? 'green' : 'yellow' }}-600">
                            @if(app()->getLocale() === 'am')
                                {{ auth()->user()->isKycVerified() ? 'KYC ተረጋግጧል' : 'KYC ማረጋገጫ' }}
                            @else
                                {{ auth()->user()->isKycVerified() ? 'KYC Verified' : 'KYC Verification' }}
                            @endif
                        </p>
                        @if(!auth()->user()->isKycVerified())
                            <p class="text-xs text-{{ auth()->user()->isKycVerified() ? 'green' : 'yellow' }}-500 mt-1">
                                @if(app()->getLocale() === 'am')
                                    ማረጋገጫ ያስፈልጋል
                                @else
                                    Verification Required
                                @endif
                            </p>
                        @endif
                    </a>
                    
                    <a href="{{ route('vehicles.rentals') }}" class="bg-blue-50 hover:bg-blue-100 p-4 rounded-lg text-center transition duration-300 animate-button-hover animate-scale-on-hover">
                        <svg class="mx-auto h-8 w-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm font-medium text-blue-600">
                            @if(app()->getLocale() === 'am')
                                መኪና ይከራዩ
                            @else
                                Rent a Car
                            @endif
                        </p>
                    </a>
                    
                    <a href="{{ route('vehicles.sales') }}" class="bg-green-50 hover:bg-green-100 p-4 rounded-lg text-center transition duration-300 animate-button-hover animate-scale-on-hover">
                        <svg class="mx-auto h-8 w-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <p class="text-sm font-medium text-green-600">
                            @if(app()->getLocale() === 'am')
                                መኪና ይግዙ
                            @else
                                Buy a Car
                            @endif
                        </p>
                    </a>
                    
                    <a href="{{ route('dashboard.profile') }}" class="bg-purple-50 hover:bg-purple-100 p-4 rounded-lg text-center transition duration-300 animate-button-hover animate-scale-on-hover">
                        <svg class="mx-auto h-8 w-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <p class="text-sm font-medium text-purple-600">
                            @if(app()->getLocale() === 'am')
                                መገለጫ
                            @else
                                Profile
                            @endif
                        </p>
                    </a>
                    
                    <a href="{{ route('contact.show') }}" class="bg-orange-50 hover:bg-orange-100 p-4 rounded-lg text-center transition duration-300 animate-button-hover animate-scale-on-hover">
                        <svg class="mx-auto h-8 w-8 text-orange-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="text-sm font-medium text-orange-600">
                            @if(app()->getLocale() === 'am')
                                ድጋፍ
                            @else
                                Support
                            @endif
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@vite(['resources/js/app.js'])
<script>
// Dashboard-specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize time display
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        const dateElement = document.getElementById('current-date');
        
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }
        
        if (dateElement) {
            dateElement.textContent = now.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
    }
    
    // Update time immediately and then every second
    updateTime();
    setInterval(updateTime, 1000);
    
    // Enhanced counter animation for statistics cards
    function animateCounters() {
        const counters = document.querySelectorAll('.counter[data-target]');
        
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        counters.forEach(counter => {
            observer.observe(counter);
        });
    }
    
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    }
    
    // Initialize counter animations
    animateCounters();
    
    // Add enhanced hover effects for cards
    const cards = document.querySelectorAll('.group');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Progress bar animations
    const progressBars = document.querySelectorAll('.animate-progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        
        setTimeout(() => {
            bar.style.transition = 'width 1.5s ease-out';
            bar.style.width = width;
        }, 500);
    });
});
</script>
@endpush

@push('styles')
<style>
/* Enhanced Glass Morphism Effects */
.backdrop-blur-xl {
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
}

/* Counter Animation Styles */
.counter {
    font-variant-numeric: tabular-nums;
    transition: all 0.3s ease;
}

/* Enhanced Glow Animations */
@keyframes glow-blue {
    0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
    50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.8); }
}

@keyframes glow-green {
    0%, 100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.5); }
    50% { box-shadow: 0 0 30px rgba(34, 197, 94, 0.8); }
}

@keyframes glow-purple {
    0%, 100% { box-shadow: 0 0 20px rgba(147, 51, 234, 0.5); }
    50% { box-shadow: 0 0 30px rgba(147, 51, 234, 0.8); }
}

@keyframes glow-orange {
    0%, 100% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.5); }
    50% { box-shadow: 0 0 30px rgba(249, 115, 22, 0.8); }
}

.animate-glow-blue {
    animation: glow-blue 2s ease-in-out infinite;
}

.animate-glow-green {
    animation: glow-green 2s ease-in-out infinite;
}

.animate-glow-purple {
    animation: glow-purple 2s ease-in-out infinite;
}

.animate-glow-orange {
    animation: glow-orange 2s ease-in-out infinite;
}

/* Enhanced Slide Animations */
@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-left {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slide-right {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-up {
    animation: slide-up 0.6s ease-out forwards;
}

.animate-slide-down {
    animation: slide-down 0.5s ease-out forwards;
}

.animate-slide-left {
    animation: slide-left 0.6s ease-out forwards;
}

.animate-slide-right {
    animation: slide-right 0.6s ease-out forwards;
}

.animate-fade-in-up {
    animation: fade-in-up 0.5s ease-out forwards;
}

/* Floating Animation */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
    animation-delay: 2s;
}

/* Pulse Animation */
@keyframes pulse-slow {
    0%, 100% { opacity: 0.8; }
    50% { opacity: 0.4; }
}

.animate-pulse-slow {
    animation: pulse-slow 4s ease-in-out infinite;
}

/* Gradient Animation */
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

/* Bounce Gentle */
@keyframes bounce-gentle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.animate-bounce-gentle {
    animation: bounce-gentle 2s ease-in-out infinite;
}

/* Count Up Animation */
@keyframes count-up {
    from { opacity: 0; transform: scale(0.5); }
    to { opacity: 1; transform: scale(1); }
}

.animate-count-up {
    animation: count-up 0.5s ease-out;
}

/* Progress Bar Animation */
.animate-progress-bar {
    transition: width 1.5s ease-out;
    transform-origin: left;
}

/* Enhanced Card Hover Effects */
.group:hover .animate-glow-blue,
.group:hover .animate-glow-green,
.group:hover .animate-glow-purple,
.group:hover .animate-glow-orange {
    animation-duration: 1s;
}

/* Responsive Animations */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Loading States */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: loading-shimmer 1.5s infinite;
}

@keyframes loading-shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}
</style>
@endpush
@endsection
