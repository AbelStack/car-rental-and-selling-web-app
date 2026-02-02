@extends('layouts.app')

@section('title', 'Contact Us - Premium Vehicle Services')

@section('content')
<!-- 🎯 CINEMATIC CONTACT HERO SECTION -->
<section class="relative min-h-screen overflow-hidden">
    <!-- 1️⃣ IMMERSIVE BACKGROUND LAYER -->
    <div class="absolute inset-0 contact-immersion-layer">
        <!-- Beautiful Customer Support Icon Background -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat contact-hero-image" 
             style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2340&q=80'); 
                    background-position: center center; 
                    transform: scale(1.05);">
        </div>
        
        <!-- Custom Support Icon Overlay -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="customer-support-icon-overlay">
                <!-- Large Customer Support Icon -->
                <div class="support-icon-container">
                    <svg class="support-main-icon" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Headset Circle Background -->
                        <circle cx="100" cy="100" r="90" fill="url(#supportGradient)" opacity="0.1"/>
                        <circle cx="100" cy="100" r="75" fill="url(#supportGradient)" opacity="0.05"/>
                        
                        <!-- Headset Icon -->
                        <path d="M100 40C75 40 55 60 55 85V115C55 125 62 133 71 133H79V95C79 82 89 72 102 72H98C111 72 121 82 121 95V133H129C138 133 145 125 145 115V85C145 60 125 40 100 40Z" fill="url(#headsetGradient)"/>
                        
                        <!-- Left Ear Cup -->
                        <rect x="45" y="85" width="20" height="35" rx="10" fill="url(#earCupGradient)"/>
                        
                        <!-- Right Ear Cup -->
                        <rect x="135" y="85" width="20" height="35" rx="10" fill="url(#earCupGradient)"/>
                        
                        <!-- Microphone -->
                        <path d="M135 110L155 125C157 126 157 129 155 130L150 133C148 134 145 133 144 131L135 120" stroke="url(#micGradient)" stroke-width="4" stroke-linecap="round"/>
                        <circle cx="155" cy="127" r="6" fill="url(#micTipGradient)"/>
                        
                        <!-- Gradients -->
                        <defs>
                            <linearGradient id="supportGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#1D4ED8;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="headsetGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#2563EB;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#1E40AF;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="earCupGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#F59E0B;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#D97706;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="micGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#10B981;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="micTipGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#EF4444;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#DC2626;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                    </svg>
                    
                    <!-- Floating Support Elements -->
                    <div class="floating-elements">
                        <div class="support-bubble bubble-1">💬</div>
                        <div class="support-bubble bubble-2">📞</div>
                        <div class="support-bubble bubble-3">✉️</div>
                        <div class="support-bubble bubble-4">🎧</div>
                    </div>
                    
                    <!-- Animated Rings -->
                    <div class="support-rings">
                        <div class="support-ring ring-1"></div>
                        <div class="support-ring ring-2"></div>
                        <div class="support-ring ring-3"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enhanced cinematic gradient overlays -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/70 to-slate-900/40"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-transparent to-soft-white/90"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
        
        <!-- Premium accent glows with contact theme -->
        <div class="absolute inset-0 bg-gradient-to-br from-neon-blue/15 via-transparent to-light-orange/10"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse-soft"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-light-orange/15 rounded-full blur-3xl animate-pulse-soft" style="animation-delay: 2s;"></div>
        
        <!-- Floating contact elements -->
        <div class="absolute top-20 right-20 w-32 h-32 bg-white/5 rounded-full backdrop-blur-sm animate-float"></div>
        <div class="absolute bottom-32 right-32 w-24 h-24 bg-neon-blue/10 rounded-full backdrop-blur-sm animate-float" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-40 left-20 w-20 h-20 bg-light-orange/10 rounded-full backdrop-blur-sm animate-float" style="animation-delay: 3s;"></div>
    </div>
    
    <!-- 2️⃣ PREMIUM CONTENT LAYER -->
    <div class="relative z-20 min-h-screen flex items-center">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Premium Brand Message -->
                <div class="contact-brand-container relative">
                    <!-- Enhanced readability background -->
                    <div class="absolute -inset-12 bg-gradient-to-r from-slate-900/30 via-slate-900/20 to-transparent rounded-3xl backdrop-blur-md border border-white/10"></div>
                    
                    <!-- Premium Badge -->
                    <div class="contact-badge opacity-0 transform translate-y-8 relative z-10" style="animation: slideInUp 0.8s ease-out 0.2s forwards;">
                        <div class="inline-flex items-center space-x-3 bg-white/15 backdrop-blur-xl rounded-full px-6 py-3 mb-8 border border-white/20">
                            <div class="w-3 h-3 bg-neon-blue rounded-full animate-pulse-soft shadow-lg shadow-neon-blue/50"></div>
                            <span class="text-sm font-semibold text-white">
                                {{ app()->getLocale() === 'am' ? '24/7 የደንበኛ አገልግሎት' : '24/7 Customer Support' }}
                            </span>
                            <svg class="w-4 h-4 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Cinematic Headline -->
                    <div class="contact-headline mb-8 relative z-10">
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.4s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">እኛን</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">Get In</span>
                            @endif
                        </div>
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.6s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text leading-tight tracking-tight drop-shadow-lg">ያግኙን</span>
                            @else
                                <span class="text-6xl lg:text-7xl font-bold text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text leading-tight tracking-tight drop-shadow-lg">Touch</span>
                            @endif
                        </div>
                        <div class="headline-line opacity-0 transform translate-y-8" style="animation: slideInUp 0.8s ease-out 0.8s forwards;">
                            @if(app()->getLocale() === 'am')
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">ዛሬ</span>
                            @else
                                <span class="text-5xl lg:text-6xl font-medium text-slate-200 leading-tight drop-shadow-xl">Today</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Premium Subtitle -->
                    <div class="contact-subtitle opacity-0 transform translate-y-6 relative z-10" style="animation: slideInUp 0.6s ease-out 1.0s forwards;">
                        <div class="bg-slate-900/40 backdrop-blur-xl rounded-2xl p-6 border border-white/10">
                            <p class="text-xl lg:text-2xl text-slate-100 leading-relaxed max-w-2xl font-light">
                                @if(app()->getLocale() === 'am')
                                    ጥያቄዎች፣ ድጋፍ ወይም አስተያየቶች አሉዎት? የእኛ ባለሙያ ቡድን እርስዎን ለመርዳት ዝግጁ ነው። በማንኛውም ጊዜ ያግኙን።
                                @else
                                    Have questions, need support, or want to share feedback? Our expert team is ready to help you. Reach out anytime.
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Contact Methods -->
                    <div class="contact-methods opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.3s forwards;">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="w-12 h-12 bg-neon-blue/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'ስልክ' : 'Phone' }}</div>
                                <div class="text-xs text-slate-300 mt-1">{{ app()->getLocale() === 'am' ? 'ፈጣን ምላሽ' : 'Quick Response' }}</div>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="w-12 h-12 bg-light-orange/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'ኢሜይል' : 'Email' }}</div>
                                <div class="text-xs text-slate-300 mt-1">{{ app()->getLocale() === 'am' ? 'ዝርዝር ምላሽ' : 'Detailed Response' }}</div>
                            </div>
                            <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="w-12 h-12 bg-green-400/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-slate-200">{{ app()->getLocale() === 'am' ? 'ቦታ' : 'Location' }}</div>
                                <div class="text-xs text-slate-300 mt-1">{{ app()->getLocale() === 'am' ? 'ቀጥተኛ ጉብኝት' : 'Direct Visit' }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Action Button -->
                    <div class="contact-actions opacity-0 transform translate-y-4 relative z-10" style="animation: slideInUp 0.5s ease-out 1.6s forwards;">
                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                            <a href="#contact-form" class="premium-cta-primary scroll-smooth">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'መልእክት ይላኩ' : 'Send Message' }}
                            </a>
                            <a href="#faq-section" class="premium-cta-secondary scroll-smooth">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ተደጋጋሚ ጥያቄዎች' : 'View FAQ' }}
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Contact Info Cards
                <div class="hidden lg:block contact-info-showcase relative">
                    <div class="opacity-0 transform translate-x-8" style="animation: slideInRight 0.8s ease-out 1.8s forwards;"> -->
                        <!-- Main Contact Card
                        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 shadow-2xl">
                            <div class="text-center mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-neon-blue to-blue-glow rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h2m-4 0V6a2 2 0 012-2h6a2 2 0 012 2v2"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Info' }}
                                </h3>
                                <p class="text-slate-300">
                                    {{ app()->getLocale() === 'am' ? 'በማንኛውም ጊዜ ይደውሉ' : 'Reach us anytime' }}
                                </p>
                            </div> -->
                            
                            <!-- Contact Details
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-neon-blue rounded-full"></div>
                                    <span class="text-sm">+251-911-000-000</span>
                                </div>
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-light-orange rounded-full"></div>
                                    <span class="text-sm">info@addisdrive.com</span>
                                </div>
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                    <span class="text-sm">Addis Ababa, Ethiopia</span>
                                </div>
                                <div class="flex items-center space-x-3 text-slate-200">
                                    <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                                    <span class="text-sm">{{ app()->getLocale() === 'am' ? 'ሰኞ - ቅዳሜ: 8:00 - 18:00' : 'Mon - Sat: 8:00 - 18:00' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<!-- 📝 PREMIUM CONTACT FORM SECTION -->
<section id="contact-form" class="py-20 bg-soft-white">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center space-x-2 bg-neon-blue/10 rounded-full px-4 py-2 mb-4">
                <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                <span class="text-sm font-medium text-neon-blue">
                    {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Form' }}
                </span>
            </div>
            <h2 class="text-display text-slate-900 mb-4">
                @if(app()->getLocale() === 'am')
                    መልእክት ይላኩ
                @else
                    Send us a Message
                @endif
            </h2>
            <p class="text-body max-w-2xl mx-auto">
                @if(app()->getLocale() === 'am')
                    ጥያቄዎች፣ አስተያየቶች ወይም ድጋፍ ያስፈልግዎታል? የእኛ ቡድን በ24 ሰዓት ውስጥ ይመልሳል።
                @else
                    Have questions, feedback, or need support? Our team will respond within 24 hours.
                @endif
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Contact Form -->
            <div class="animate-on-scroll relative" style="animation-delay: 0.2s;">
    
    <!-- Glow background -->
    <div class="absolute -inset-1 bg-gradient-to-r from-neon-blue/20 via-transparent to-light-orange/20 blur-2xl rounded-3xl"></div>

    <div class="card-premium relative p-8 rounded-3xl backdrop-blur-xl
                bg-white/90 border border-white/40
                shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                hover:shadow-[0_30px_80px_rgba(0,0,0,0.12)]
                transition-all duration-500">

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 shadow-lg animate-slideInDown">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-green-800">
                            {{ app()->getLocale() === 'am' ? 'ተሳክቷል!' : 'Success!' }}
                        </h4>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        @if(session('message_id'))
                            <p class="text-green-600 text-xs mt-1">
                                {{ app()->getLocale() === 'am' ? 'መልእክት ID: ' : 'Message ID: ' }}#{{ session('message_id') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 shadow-lg animate-slideInDown">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-red-800">
                            {{ app()->getLocale() === 'am' ? 'ስህተት!' : 'Error!' }}
                        </h4>
                        <p class="text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-200 shadow-lg animate-slideInDown">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-amber-800 mb-2">
                            {{ app()->getLocale() === 'am' ? 'እባክዎን የሚከተሉትን ያርሙ:' : 'Please correct the following:' }}
                        </h4>
                        <ul class="space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-amber-700 text-sm flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 bg-amber-500 rounded-full flex-shrink-0"></div>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-7" id="contactForm">
            @csrf

            <!-- Name -->
            <div class="group">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                    <svg class="w-4 h-4 text-neon-blue group-focus-within:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ሙሉ ስም' : 'Full Name' }}
                    <span class="text-red-500">*</span>
                </label>

                <input type="text" name="name" required
                    value="{{ old('name') }}"
                    class="w-full rounded-2xl px-4 py-3
                           border {{ $errors->has('name') ? 'border-red-300 bg-red-50' : 'border-slate-300 bg-white/80' }}
                           shadow-sm
                           focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20
                           hover:border-neon-blue/60
                           transition-all duration-300
                           focus:-translate-y-0.5"
                    placeholder="{{ app()->getLocale() === 'am' ? 'የእርስዎን ሙሉ ስም ያስገቡ' : 'Enter your full name' }}">
                
                @error('name')
                    <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="group">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                    <svg class="w-4 h-4 text-neon-blue group-focus-within:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ኢሜይል' : 'Email Address' }}
                    <span class="text-red-500">*</span>
                </label>

                <input type="email" name="email" required
                    value="{{ old('email') }}"
                    class="w-full rounded-2xl px-4 py-3
                           border {{ $errors->has('email') ? 'border-red-300 bg-red-50' : 'border-slate-300 bg-white/80' }}
                           shadow-sm
                           focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20
                           hover:border-neon-blue/60
                           transition-all duration-300
                           focus:-translate-y-0.5"
                    placeholder="{{ app()->getLocale() === 'am' ? 'የእርስዎን ኢሜይል አድራሻ ያስገቡ' : 'Enter your email address' }}">
                
                @error('email')
                    <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="group">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                    <svg class="w-4 h-4 text-neon-blue group-focus-within:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 5a2 2 0 012-2h3"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ስልክ ቁጥር' : 'Phone Number' }}
                    <span class="text-slate-400 text-xs">({{ app()->getLocale() === 'am' ? 'አማራጭ' : 'Optional' }})</span>
                </label>

                <input type="tel" name="phone"
                    value="{{ old('phone') }}"
                    class="w-full rounded-2xl px-4 py-3
                           border {{ $errors->has('phone') ? 'border-red-300 bg-red-50' : 'border-slate-300 bg-white/80' }}
                           shadow-sm
                           focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20
                           hover:border-neon-blue/60
                           transition-all duration-300
                           focus:-translate-y-0.5"
                    placeholder="{{ app()->getLocale() === 'am' ? '+251911000000' : '+251911000000' }}">
                
                @error('phone')
                    <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Subject -->
            <div class="group">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                    <svg class="w-4 h-4 text-neon-blue group-focus-within:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 3h10l4 6-9 12L3 9z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'ርዕስ' : 'Subject' }}
                    <span class="text-red-500">*</span>
                </label>

                <input type="text" name="subject" required
                    value="{{ old('subject') }}"
                    class="w-full rounded-2xl px-4 py-3
                           border {{ $errors->has('subject') ? 'border-red-300 bg-red-50' : 'border-slate-300 bg-white/80' }}
                           shadow-sm
                           focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20
                           hover:border-neon-blue/60
                           transition-all duration-300
                           focus:-translate-y-0.5"
                    placeholder="{{ app()->getLocale() === 'am' ? 'የመልእክትዎን ርዕስ ያስገቡ' : 'Enter your message subject' }}">
                
                @error('subject')
                    <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Message -->
            <div class="group">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                    <svg class="w-4 h-4 text-neon-blue group-focus-within:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'መልእክት' : 'Message' }}
                    <span class="text-red-500">*</span>
                </label>

                <div class="relative">
                    <textarea rows="6" name="message" required
                        class="w-full rounded-2xl px-4 py-3
                               border {{ $errors->has('message') ? 'border-red-300 bg-red-50' : 'border-slate-300 bg-white/80' }}
                               shadow-sm resize-none
                               focus:border-neon-blue focus:ring-4 focus:ring-neon-blue/20
                               hover:border-neon-blue/60
                               transition-all duration-300
                               focus:-translate-y-0.5"
                        placeholder="{{ app()->getLocale() === 'am' ? 'የእርስዎን መልእክት እዚህ ይጻፉ...' : 'Write your message here...' }}"
                        maxlength="2000"
                        oninput="updateCharCount(this)">{{ old('message') }}</textarea>
                    
                    <div class="absolute bottom-3 right-3 text-xs text-slate-400">
                        <span id="charCount">0</span>/2000
                    </div>
                </div>
                
                @error('message')
                    <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" id="submitBtn"
                class="relative w-full mt-4
                       rounded-2xl py-4
                       font-semibold text-white
                       bg-gradient-to-r from-neon-blue to-light-orange
                       shadow-xl shadow-neon-blue/20
                       hover:shadow-2xl hover:scale-[1.02]
                       active:scale-95
                       disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100
                       transition-all duration-300 overflow-hidden">

                <span class="relative z-10 flex items-center justify-center gap-2" id="submitContent">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 19l9 2-9-18-9 18 9-2z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'መልእክት ላክ' : 'Send Message' }}
                </span>

                <span class="absolute inset-0 bg-white/20 opacity-0 hover:opacity-100 transition duration-300"></span>
                
                <!-- Loading state -->
                <span class="relative z-10 hidden items-center justify-center gap-2" id="loadingContent">
                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'እየላከ...' : 'Sending...' }}
                </span>
            </button>

            <!-- Form Help Text -->
            <div class="mt-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-slate-600">
                        <p class="font-medium mb-1">
                            {{ app()->getLocale() === 'am' ? 'ማስታወሻ:' : 'Note:' }}
                        </p>
                        <ul class="space-y-1 text-xs">
                            <li>{{ app()->getLocale() === 'am' ? '• እኛ በ24 ሰዓት ውስጥ ምላሽ እንሰጣለን' : '• We respond within 24 hours' }}</li>
                            <li>{{ app()->getLocale() === 'am' ? '• አስቸኳይ ጉዳዮች ለሆኑ በቀጥታ ይደውሉ' : '• For urgent matters, please call directly' }}</li>
                            <li>{{ app()->getLocale() === 'am' ? '• የእርስዎ መረጃ በሚስጥር ይጠበቃል' : '• Your information is kept confidential' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>


            <!-- Contact Information -->
            <div class="animate-on-scroll relative" style="animation-delay: 0.4s;">

    <!-- Ambient glow -->
    <div class="absolute -inset-1 bg-gradient-to-br from-neon-blue/20 via-transparent to-light-orange/20 blur-3xl rounded-3xl"></div>

    <div class="relative space-y-8">

        <!-- Contact Details -->
        <div class="card-premium p-7 rounded-3xl
                    bg-white/90 backdrop-blur-xl
                    border border-white/40
                    shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                    hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)]
                    transition-all duration-500">

            <h3 class="text-heading text-slate-900 mb-8 tracking-tight">
                {{ app()->getLocale() === 'am' ? 'የመገናኛ መረጃ' : 'Contact Information' }}
            </h3>

            <div class="space-y-6">

                <!-- Phone -->
                <div class="group flex items-start gap-4 p-3 rounded-2xl
                            hover:bg-neon-blue/5 transition-all duration-300">

                    <div class="w-11 h-11 rounded-xl
                                bg-neon-blue/10
                                flex items-center justify-center
                                group-hover:scale-110
                                group-hover:shadow-lg group-hover:shadow-neon-blue/20
                                transition-all duration-300">
                        <svg class="w-5 h-5 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435z"/>
                        </svg>
                    </div>

                    <div>
                        <h4 class="font-semibold text-slate-900">
                            {{ app()->getLocale() === 'am' ? 'ስልክ' : 'Phone' }}
                        </h4>
                        <p class="text-slate-600">+251-911-000-000</p>
                        <p class="text-slate-600">+251-911-000-001</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="group flex items-start gap-4 p-3 rounded-2xl
                            hover:bg-light-orange/5 transition-all duration-300">

                    <div class="w-11 h-11 rounded-xl
                                bg-light-orange/10
                                flex items-center justify-center
                                group-hover:scale-110
                                group-hover:shadow-lg group-hover:shadow-light-orange/20
                                transition-all duration-300">
                        <svg class="w-5 h-5 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998z"/>
                        </svg>
                    </div>

                    <div>
                        <h4 class="font-semibold text-slate-900">
                            {{ app()->getLocale() === 'am' ? 'ኢሜይል' : 'Email' }}
                        </h4>
                        <p class="text-slate-600">info@addisdrive.com</p>
                        <p class="text-slate-600">support@addisdrive.com</p>
                    </div>
                </div>

                <!-- Address -->
                <div class="group flex items-start gap-4 p-3 rounded-2xl
                            hover:bg-green-400/5 transition-all duration-300">

                    <div class="w-11 h-11 rounded-xl
                                bg-green-400/10
                                flex items-center justify-center
                                group-hover:scale-110
                                group-hover:shadow-lg group-hover:shadow-green-400/20
                                transition-all duration-300">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9z"/>
                        </svg>
                    </div>

                    <div>
                        <h4 class="font-semibold text-slate-900">
                            {{ app()->getLocale() === 'am' ? 'አድራሻ' : 'Address' }}
                        </h4>
                        <p class="text-slate-600">Addis Ababa, Ethiopia</p>
                        <p class="text-slate-600">Bole Sub City, Woreda 03</p>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="group flex items-start gap-4 p-3 rounded-2xl
                            hover:bg-yellow-400/5 transition-all duration-300">

                    <div class="w-11 h-11 rounded-xl
                                bg-yellow-400/10
                                flex items-center justify-center
                                group-hover:scale-110
                                group-hover:shadow-lg group-hover:shadow-yellow-400/20
                                transition-all duration-300">
                        <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16z"/>
                        </svg>
                    </div>

                    <div>
                        <h4 class="font-semibold text-slate-900">
                            {{ app()->getLocale() === 'am' ? 'የስራ ሰዓት' : 'Business Hours' }}
                        </h4>
                        <p class="text-slate-600">
                            {{ app()->getLocale() === 'am'
                                ? 'ሰኞ - ቅዳሜ: 8:00 - 18:00'
                                : 'Monday - Saturday: 8:00 AM - 6:00 PM' }}
                        </p>
                        <p class="text-slate-600">
                            {{ app()->getLocale() === 'am'
                                ? 'እሁድ: 9:00 - 17:00'
                                : 'Sunday: 9:00 AM - 5:00 PM' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Response Time -->
        <div class="card-premium p-6 rounded-3xl
                    bg-gradient-to-br from-neon-blue/10 to-light-orange/10
                    backdrop-blur-xl
                    border border-white/40
                    shadow-lg hover:shadow-xl
                    transition-all duration-500">

            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 rounded-xl bg-neon-blue/15
                            flex items-center justify-center
                            animate-pulse">
                    <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16z"/>
                    </svg>
                </div>

                <h4 class="font-semibold text-slate-900">
                    {{ app()->getLocale() === 'am' ? 'ምላሽ ጊዜ' : 'Response Time' }}
                </h4>
            </div>

            <p class="text-slate-700 leading-relaxed">
                {{ app()->getLocale() === 'am'
                    ? 'እኛ በ24 ሰዓት ውስጥ ለሁሉም መልእክቶች ምላሽ እንሰጣለን። አስቸኳይ ጉዳዮች ለሆኑ፣ እባክዎን በቀጥታ ይደውሉ።'
                    : 'We respond to all messages within 24 hours. For urgent matters, please call us directly.' }}
            </p>
        </div>

    </div>
</div>

        </div>
    </div>
</section>

<!-- ❓ ANIMATED FAQ SECTION -->
<section id="faq-section" class="relative py-24 bg-white overflow-hidden">

    <!-- Ambient background glow -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-neon-blue/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-light-orange/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center mb-20 animate-on-scroll">
            <div class="inline-flex items-center gap-2 bg-light-orange/10 rounded-full px-5 py-2 mb-5
                        shadow-sm backdrop-blur-md">
                <svg class="w-4 h-4 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0z"/>
                </svg>
                <span class="text-sm font-semibold tracking-wide text-light-orange">
                    {{ app()->getLocale() === 'am' ? 'ተደጋጋሚ ጥያቄዎች' : 'Frequently Asked Questions' }}
                </span>
            </div>

            <h2 class="text-display text-slate-900 mb-5 tracking-tight">
                {{ app()->getLocale() === 'am'
                    ? 'ተደጋጋሚ ጥያቄዎች'
                    : "Got Questions? We've Got Answers" }}
            </h2>

            <p class="text-body max-w-2xl mx-auto text-slate-600">
                {{ app()->getLocale() === 'am'
                    ? 'በተደጋጋሚ የሚጠየቁ ጥያቄዎች እና መልሶች። የሚፈልጉትን ካላገኙ፣ እባክዎን ያግኙን።'
                    : "Find answers to the most commonly asked questions. Can't find what you're looking for? Contact us directly." }}
            </p>
        </div>

        <!-- FAQ Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- FIRST COLUMN -->
            <div class="space-y-5">

                <!-- FAQ 1 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="card-premium rounded-3xl overflow-hidden border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'እንዴት ተሽከርካሪ ልከራይ እችላለሁ?' : 'How can I rent a vehicle?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'መጀመሪያ መለያ መፍጠር፣ KYC ማረጋገጫ ማጠናቀቅ፣ ተሽከርካሪ መምረጥ እና በቻፓ መክፈል ይኖርብዎታል።' : 'Create an account, complete KYC, choose a vehicle, and pay securely via Chapa.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="card-premium overflow-hidden rounded-3xl border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'KYC ማረጋገጫ ምንድን ነው?' : 'What is KYC verification?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'KYC (Know Your Customer) የማንነት ማረጋገጫ ሂደት ነው። የመታወቂያ ካርድ፣ የመንጃ ፈቃድ እና ሌሎች ሰነዶች ማቅረብ ያስፈልጋል።' : 'KYC (Know Your Customer) is an identity verification process. You need to provide ID card, driving license, and other documents.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="card-premium overflow-hidden rounded-3xl border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'የክፍያ ዘዴዎች ምንድን ናቸው?' : 'What payment methods do you accept?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'እኛ ቻፓ ክፍያ ስርዓት እንጠቀማለን። ይህ ሞባይል ባንኪንግ፣ ባንክ ካርዶች እና ሌሎች የኢትዮጵያ ክፍያ ዘዴዎችን ይደግፋል።' : 'We use Chapa payment system, which supports mobile banking, bank cards, and other Ethiopian payment methods.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.4s;">
                    <div class="card-premium overflow-hidden rounded-3xl border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'ተሽከርካሪ መግዛት እችላለሁ?' : 'Can I buy a vehicle?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'አዎ! እኛ የተረጋገጡ ተሽከርካሪዎችን ለሽያጭ እናቀርባለን።' : 'Yes! We offer verified vehicles for sale. All vehicles are inspected by professionals and come with legal documentation.' }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- SECOND COLUMN -->
            <div class="space-y-5">

                <!-- FAQ 5 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.5s;">
                    <div class="card-premium overflow-hidden rounded-3xl border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'የደንበኛ ድጋፍ እንዴት ማግኘት እችላለሁ?' : 'How can I get customer support?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'የእኛ ቡድን 24/7 ይገኛል። በስልክ፣ ኢሜይል ወይም በዚህ ገጽ ላይ ባለው የመልእክት ቅጽ ማግኘት ይችላሉ።' : 'Our team is available 24/7. You can reach us by phone, email, or through the contact form on this page.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.6s;">
                    <div class="card-premium overflow-hidden rounded-3xl border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'የኪራይ ዋጋ እንዴት ይሰላል?' : 'How is rental pricing calculated?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'የኪራይ ዋጋ በተሽከርካሪ ዓይነት፣ የኪራይ ቆይታ እና ተጨማሪ አገልግሎቶች መሰረት ይሰላል።' : 'Rental pricing depends on vehicle type, rental duration, and additional services selected.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 7 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.7s;">
                    <div class="card-premium overflow-hidden rounded-3xl border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ጥናት እንዴት ይከናወናል?' : 'How is vehicle inspection done?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎች በሙሉ በሙያ ባለሙያዎች ይፈተሻሉ። የሕግ ሰነዶች እና የሁኔታ ሪፖርቶች በተዘጋጀ መልኩ ይሰጣሉ።' : 'Vehicles are fully inspected by professionals. Reports on legal documents and condition are provided.' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 8 -->
                <div class="faq-item animate-on-scroll" style="animation-delay: 0.8s;">
                    <div class="card-premium overflow-hidden rounded-3xl border border-white/40
                                bg-white/90 backdrop-blur-xl shadow-[0_20px_60px_rgba(0,0,0,0.08)]
                                hover:shadow-[0_30px_90px_rgba(0,0,0,0.12)] transition-all duration-500">
                        <button onclick="toggleFAQ(this)" class="faq-question w-full p-6 text-left focus:outline-none group">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-semibold text-slate-900 group-hover:text-neon-blue transition">
                                    {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ጥናት ውጤት ምንድን ነው?' : 'What is included in the inspection report?' }}
                                </h3>
                                <span class="w-9 h-9 rounded-xl bg-neon-blue/10 flex items-center justify-center group-hover:bg-neon-blue/20 transition-all duration-300">
                                    <svg class="faq-icon w-4 h-4 text-neon-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-6 pb-6 text-slate-600 leading-relaxed">
                                {{ app()->getLocale() === 'am' ? 'የሁኔታ ሪፖርት፣ ማስታወቂያ እና የሕግ ሰነዶች ይካተታሉ።' : 'Includes vehicle condition report, alerts for issues, and all legal documents.' }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Optional Contact CTA -->
        <div class="mt-16 text-center animate-on-scroll">
            <a href="#contact" class="inline-block bg-neon-blue text-white font-semibold px-8 py-4 rounded-full
                                     shadow-lg hover:shadow-xl hover:bg-light-orange transition-all duration-300">
                {{ app()->getLocale() === 'am' ? 'እኛን ያግኙ' : 'Contact Us' }}
            </a>
        </div>
    </div>

</section>

<!-- FAQ Toggle Script -->
<script>
    function toggleFAQ(button){
        const answer = button.nextElementSibling;
        const icon = button.querySelector('.faq-icon');
        if(answer.style.maxHeight){
            answer.style.maxHeight = null;
            icon.style.transform = 'rotate(0deg)';
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
            icon.style.transform = 'rotate(180deg)';
        }
    }
</script>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('📞 Premium Contact Page Loaded');
    
    // Initialize form enhancements
    initializeContactForm();
    
    // Smooth scroll for anchor links
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

// Enhanced Contact Form Functionality
function initializeContactForm() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitContent = document.getElementById('submitContent');
    const loadingContent = document.getElementById('loadingContent');
    
    if (!form) return;
    
    // Initialize character count
    const messageTextarea = form.querySelector('textarea[name="message"]');
    if (messageTextarea) {
        updateCharCount(messageTextarea);
    }
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        // Show loading state
        showLoadingState(submitBtn, submitContent, loadingContent);
        
        // Validate form before submission
        if (!validateForm(form)) {
            e.preventDefault();
            hideLoadingState(submitBtn, submitContent, loadingContent);
            return false;
        }
        
        // Form is valid, allow submission
        // Loading state will be hidden when page reloads or redirects
    });
    
    // Real-time validation
    const inputs = form.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            clearFieldError(this);
        });
    });
    
    // Auto-hide success/error messages after 10 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.animate-slideInDown');
        alerts.forEach(alert => {
            alert.style.transition = 'all 0.5s ease-out';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 500);
        });
    }, 10000);
}

// Character count update
function updateCharCount(textarea) {
    const charCount = document.getElementById('charCount');
    if (charCount) {
        const count = textarea.value.length;
        charCount.textContent = count;
        
        // Change color based on character count
        if (count > 1800) {
            charCount.className = 'text-red-500 font-medium';
        } else if (count > 1500) {
            charCount.className = 'text-amber-500 font-medium';
        } else {
            charCount.className = 'text-slate-400';
        }
    }
}

// Form validation
function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    return isValid;
}

// Individual field validation
function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';
    
    // Clear previous errors
    clearFieldError(field);
    
    // Required field validation
    if (field.hasAttribute('required') && !value) {
        errorMessage = getRequiredFieldMessage(fieldName);
        isValid = false;
    }
    
    // Specific field validations
    if (value && isValid) {
        switch (fieldName) {
            case 'name':
                if (value.length < 2) {
                    errorMessage = '{{ app()->getLocale() === 'am' ? 'ስም ቢያንስ 2 ቁምፊዎች ሊኖረው ይገባል' : 'Name must be at least 2 characters long' }}';
                    isValid = false;
                }
                break;
                
            case 'email':
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    errorMessage = '{{ app()->getLocale() === 'am' ? 'እባክዎን ትክክለኛ ኢሜይል አድራሻ ያስገቡ' : 'Please enter a valid email address' }}';
                    isValid = false;
                }
                break;
                
            case 'phone':
                if (value && value.length < 10) {
                    errorMessage = '{{ app()->getLocale() === 'am' ? 'ስልክ ቁጥር ቢያንስ 10 ቁጥሮች ሊኖረው ይገባል' : 'Phone number must be at least 10 digits' }}';
                    isValid = false;
                }
                break;
                
            case 'subject':
                if (value.length < 5) {
                    errorMessage = '{{ app()->getLocale() === 'am' ? 'ርዕስ ቢያንስ 5 ቁምፊዎች ሊኖረው ይገባል' : 'Subject must be at least 5 characters long' }}';
                    isValid = false;
                }
                break;
                
            case 'message':
                if (value.length < 10) {
                    errorMessage = '{{ app()->getLocale() === 'am' ? 'መልእክት ቢያንስ 10 ቁምፊዎች ሊኖረው ይገባል' : 'Message must be at least 10 characters long' }}';
                    isValid = false;
                } else if (value.length > 2000) {
                    errorMessage = '{{ app()->getLocale() === 'am' ? 'መልእክት ከ2000 ቁምፊዎች መብለጥ አይችልም' : 'Message cannot exceed 2000 characters' }}';
                    isValid = false;
                }
                break;
        }
    }
    
    // Show error if validation failed
    if (!isValid) {
        showFieldError(field, errorMessage);
    }
    
    return isValid;
}

// Get required field message
function getRequiredFieldMessage(fieldName) {
    const messages = {
        'name': '{{ app()->getLocale() === 'am' ? 'እባክዎን ስምዎን ያስገቡ' : 'Please enter your name' }}',
        'email': '{{ app()->getLocale() === 'am' ? 'እባክዎን ኢሜይልዎን ያስገቡ' : 'Please enter your email' }}',
        'subject': '{{ app()->getLocale() === 'am' ? 'እባክዎን ርዕስ ያስገቡ' : 'Please enter a subject' }}',
        'message': '{{ app()->getLocale() === 'am' ? 'እባክዎን መልእክትዎን ያስገቡ' : 'Please enter your message' }}'
    };
    
    return messages[fieldName] || '{{ app()->getLocale() === 'am' ? 'ይህ ሜዳ ያስፈልጋል' : 'This field is required' }}';
}

// Show field error
function showFieldError(field, message) {
    // Add error styling to field
    field.classList.remove('border-slate-300', 'bg-white/80');
    field.classList.add('border-red-300', 'bg-red-50');
    
    // Remove existing error message
    clearFieldError(field);
    
    // Create and show error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'mt-2 flex items-center gap-2 text-red-600 text-sm field-error';
    errorDiv.innerHTML = `
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        ${message}
    `;
    
    field.parentNode.appendChild(errorDiv);
}

// Clear field error
function clearFieldError(field) {
    // Remove error styling
    field.classList.remove('border-red-300', 'bg-red-50');
    field.classList.add('border-slate-300', 'bg-white/80');
    
    // Remove error message
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

// Show loading state
function showLoadingState(submitBtn, submitContent, loadingContent) {
    submitBtn.disabled = true;
    submitContent.classList.add('hidden');
    loadingContent.classList.remove('hidden');
    loadingContent.classList.add('flex');
}

// Hide loading state
function hideLoadingState(submitBtn, submitContent, loadingContent) {
    submitBtn.disabled = false;
    submitContent.classList.remove('hidden');
    loadingContent.classList.add('hidden');
    loadingContent.classList.remove('flex');
}

// FAQ Toggle Function
function toggleFAQ(button) {
    const faqItem = button.closest('.faq-item');
    const answer = faqItem.querySelector('.faq-answer');
    const icon = button.querySelector('.faq-icon');
    
    // Close all other FAQ items
    document.querySelectorAll('.faq-item').forEach(item => {
        if (item !== faqItem) {
            const otherAnswer = item.querySelector('.faq-answer');
            const otherIcon = item.querySelector('.faq-icon');
            otherAnswer.style.maxHeight = '0px';
            otherIcon.style.transform = 'rotate(0deg)';
            item.classList.remove('active');
        }
    });
    
    // Toggle current FAQ item
    if (faqItem.classList.contains('active')) {
        answer.style.maxHeight = '0px';
        icon.style.transform = 'rotate(0deg)';
        faqItem.classList.remove('active');
    } else {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.style.transform = 'rotate(180deg)';
        faqItem.classList.add('active');
    }
}
</script>

<style>
/* 🎨 CONTACT PAGE ANIMATIONS */
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

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
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

@keyframes shake {
    0%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-2px);
    }
    20%, 40%, 60%, 80% {
        transform: translateX(2px);
    }
}

/* 🚨 ERROR HANDLING ANIMATIONS */
.animate-slideInDown {
    animation: slideInDown 0.5s ease-out;
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}

.field-error {
    animation: slideInDown 0.3s ease-out;
}

/* Form field states */
.form-field-error {
    animation: shake 0.5s ease-in-out;
    border-color: #ef4444 !important;
    background-color: #fef2f2 !important;
}

.form-field-success {
    border-color: #10b981 !important;
    background-color: #f0fdf4 !important;
}

/* Loading button states */
.btn-loading {
    position: relative;
    pointer-events: none;
}

.btn-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

/* 🎧 CUSTOMER SUPPORT ICON OVERLAY */
.customer-support-icon-overlay {
    position: relative;
    width: 400px;
    height: 400px;
    opacity: 0.15;
    animation: iconFloat 6s ease-in-out infinite;
}

@keyframes iconFloat {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(2deg);
    }
}

.support-icon-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.support-main-icon {
    width: 200px;
    height: 200px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    filter: drop-shadow(0 0 20px rgba(37, 99, 235, 0.3));
    animation: iconPulse 4s ease-in-out infinite;
}

@keyframes iconPulse {
    0%, 100% {
        filter: drop-shadow(0 0 20px rgba(37, 99, 235, 0.3));
    }
    50% {
        filter: drop-shadow(0 0 30px rgba(37, 99, 235, 0.5));
    }
}

/* Floating Support Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.support-bubble {
    position: absolute;
    font-size: 24px;
    animation: bubbleFloat 8s ease-in-out infinite;
    opacity: 0.8;
    filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.5));
}

.bubble-1 {
    top: 20%;
    left: 15%;
    animation-delay: 0s;
}

.bubble-2 {
    top: 25%;
    right: 20%;
    animation-delay: 2s;
}

.bubble-3 {
    bottom: 30%;
    left: 20%;
    animation-delay: 4s;
}

.bubble-4 {
    bottom: 25%;
    right: 15%;
    animation-delay: 6s;
}

@keyframes bubbleFloat {
    0%, 100% {
        transform: translateY(0px) scale(1);
    }
    25% {
        transform: translateY(-15px) scale(1.1);
    }
    50% {
        transform: translateY(-5px) scale(0.9);
    }
    75% {
        transform: translateY(-20px) scale(1.05);
    }
}

/* Animated Rings */
.support-rings {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.support-ring {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    border: 2px solid rgba(37, 99, 235, 0.3);
    animation: ringExpand 4s ease-in-out infinite;
}

.ring-1 {
    width: 250px;
    height: 250px;
    animation-delay: 0s;
}

.ring-2 {
    width: 300px;
    height: 300px;
    animation-delay: 1.3s;
}

.ring-3 {
    width: 350px;
    height: 350px;
    animation-delay: 2.6s;
}

@keyframes ringExpand {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
        border-color: rgba(37, 99, 235, 0.8);
    }
    50% {
        opacity: 0.6;
        border-color: rgba(245, 158, 11, 0.6);
    }
    100% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0;
        border-color: rgba(16, 185, 129, 0.3);
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
    @apply inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-neon-blue to-blue-glow rounded-2xl shadow-xl transition-all duration-300 hover:shadow-2xl hover:shadow-neon-blue/25 hover:scale-105 border border-neon-blue/50;
}

.premium-cta-secondary {
    @apply inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 shadow-xl transition-all duration-300 hover:bg-white/20 hover:scale-105;
}

/* FAQ Animations */
.faq-item {
    transition: all 0.3s ease;
}

.faq-item:hover {
    transform: translateY(-2px);
}

.faq-item.active {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
}

.faq-answer {
    transition: max-height 0.3s ease-in-out;
}

.faq-icon {
    transition: transform 0.3s ease;
}

/* Glass morphism effects */
.backdrop-blur-xl {
    backdrop-filter: blur(24px);
}

.backdrop-blur-md {
    backdrop-filter: blur(12px);
}

/* Enhanced form focus states */
.group:focus-within label {
    color: #2563eb;
    transform: translateY(-1px);
}

.group:focus-within svg {
    color: #2563eb;
    transform: scale(1.1);
}

/* Success message styling */
.success-message {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: 1px solid #10b981;
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);
}

/* Error message styling */
.error-message {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    border: 1px solid #ef4444;
    box-shadow: 0 10px 25px rgba(239, 68, 68, 0.2);
}

/* Warning message styling */
.warning-message {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: 1px solid #f59e0b;
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.2);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .contact-headline .headline-line span {
        @apply text-4xl lg:text-5xl;
    }
    
    .premium-cta-primary,
    .premium-cta-secondary {
        @apply px-6 py-3 text-base;
    }
    
    .faq-item {
        margin-bottom: 1rem;
    }
    
    .customer-support-icon-overlay {
        width: 300px;
        height: 300px;
    }
    
    .support-main-icon {
        width: 150px;
        height: 150px;
    }
}

/* Scroll smooth behavior */
html {
    scroll-behavior: smooth;
}

/* Focus visible for accessibility */
button:focus-visible,
input:focus-visible,
textarea:focus-visible {
    outline: 2px solid #2563eb;
    outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .card-premium {
        border-width: 2px;
    }
    
    .field-error {
        font-weight: 600;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endpush
@endsection
