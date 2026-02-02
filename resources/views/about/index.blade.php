@extends('layouts.app')

@section('title', 'About Us - Premium Vehicle Services | Addis Drive')

@section('content')

<!-- 1️⃣ IMMERSIVE BRAND INTRO (Hero About Section) -->
<section class="relative min-h-screen overflow-hidden">
    <!-- Cinematic Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
             style="background-image: url('https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'); 
                    transform: scale(1.1);">
        </div>
        <!-- Enhanced gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/70 to-slate-900/50"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-transparent to-soft-white/95"></div>
        <!-- Subtle accent glows -->
        <div class="absolute inset-0 bg-gradient-to-r from-neon-blue/15 via-transparent to-light-orange/10"></div>
        <!-- Animated light movement -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-1/3 right-1/4 w-80 h-80 bg-light-orange/15 rounded-full blur-3xl animate-pulse-soft"></div>
        </div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 min-h-screen flex items-center">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-4xl">
                <!-- Large confident headline -->
                <div class="hero-headline opacity-0 transform translate-y-8" style="animation: slideInUp 1s ease-out 0.5s forwards;">
                    <h1 class="text-6xl lg:text-7xl font-bold text-white leading-tight tracking-tight mb-6">
                        @if(app()->getLocale() === 'am')
                            <span class="block">የተሽከርካሪ</span>
                            <span class="block text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text">አገልግሎት መሪ</span>
                        @else
                            <span class="block">Redefining</span>
                            <span class="block text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text">Vehicle Services</span>
                        @endif
                    </h1>
                </div>
                
                <!-- Emotional sub-text -->
                <div class="hero-description opacity-0 transform translate-y-8" style="animation: slideInUp 1s ease-out 0.8s forwards;">
                    <p class="text-xl lg:text-2xl text-slate-300 leading-relaxed mb-8 max-w-3xl">
                        @if(app()->getLocale() === 'am')
                            በኢትዮጵያ ውስጥ የመጀመሪያው ዲጂታል የተሽከርካሪ መድረክ፣ ዘመናዊ ቴክኖሎጂን ከአካባቢያዊ ፍላጎቶች ጋር በማጣመር የተሽከርካሪ ኪራይ እና ሽያጭ አገልግሎትን እንደገና እየቀየረ ነው።
                        @else
                            Ethiopia's first digital vehicle platform, revolutionizing car rental and sales through cutting-edge technology, local expertise, and unwavering commitment to excellence.
                        @endif
                    </p>
                </div>
                
                <!-- Trust badge strip -->
                <div class="trust-badges opacity-0 transform translate-y-8" style="animation: slideInUp 1s ease-out 1.1s forwards;">
                    <div class="flex flex-wrap items-center gap-6 text-sm text-slate-400">
                        <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'am' ? 'የተረጋገጠ' : 'Verified' }}</span>
                        </div>
                        <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
                            <svg class="w-5 h-5 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ' : 'Secure' }}</span>
                        </div>
                        <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
                            <svg class="w-5 h-5 text-light-orange" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'am' ? 'ፈቃድ ያለው' : 'Licensed' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2️⃣ WHO WE ARE (Brand Story Section) -->
<section class="py-20 bg-soft-white">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Story Content -->
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="inline-flex items-center space-x-2 bg-blue-light/50 rounded-full px-4 py-2 mb-6">
                    <svg class="w-4 h-4 text-neon-blue" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium text-neon-blue">
                        {{ app()->getLocale() === 'am' ? 'ስለ እኛ' : 'Our Story' }}
                    </span>
                </div>
                
                <h2 class="text-display text-slate-900 mb-6">
                    @if(app()->getLocale() === 'am')
                        በኢትዮጵያ የተሽከርካሪ <span class="text-light-orange">አገልግሎት</span> መሪ
                    @else
                        Pioneering Vehicle Services in <span class="text-light-orange">Ethiopia</span>
                    @endif
                </h2>
                
                <div class="space-y-6 text-body">
                    <p>
                        @if(app()->getLocale() === 'am')
                            በ2023 የተመሰረተው Addis Drive የኢትዮጵያ የመጀመሪያው ሙሉ በሙሉ ዲጂታል የተሽከርካሪ መድረክ ነው። ዘመናዊ ቴክኖሎጂን ከአካባቢያዊ ፍላጎቶች ጋር በማጣመር፣ የተሽከርካሪ ኪራይ እና ሽያጭ አገልግሎትን እንደገና እየቀየረ ነው።
                        @else
                            Founded in 2023, Addis Drive emerged as Ethiopia's first fully digital vehicle platform. We recognized the need for a modern, trustworthy solution that combines cutting-edge technology with deep understanding of local market needs.
                        @endif
                    </p>
                    <p>
                        @if(app()->getLocale() === 'am')
                            ከአዲስ አበባ ጀምሮ፣ አሁን በመላው ኢትዮጵያ ውስጥ አገልግሎት እንሰጣለን። የእኛ ተልእኮ ቀላል፣ ደህንነቱ የተጠበቀ እና ተደራሽ የተሽከርካሪ አገልግሎት ለሁሉም ኢትዮጵያውያን ማቅረብ ነው።
                        @else
                            Starting from Addis Ababa, we now serve customers across Ethiopia. Our mission is to make vehicle services simple, secure, and accessible for every Ethiopian, whether they need a car for a day or looking to purchase their dream vehicle.
                        @endif
                    </p>
                </div>
                
                <!-- Timeline -->
                <div class="mt-8 space-y-4">
                    <div class="timeline-item flex items-center space-x-4 p-4 bg-white rounded-xl shadow-sm border border-slate-200/50 hover:shadow-md transition-all duration-300">
                        <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                        <div>
                            <div class="font-semibold text-slate-900">2023 - {{ app()->getLocale() === 'am' ? 'መጀመሪያ' : 'Foundation' }}</div>
                            <div class="text-sm text-slate-600">{{ app()->getLocale() === 'am' ? 'በአዲስ አበባ የመጀመሪያ አገልግሎት' : 'Launched in Addis Ababa' }}</div>
                        </div>
                    </div>
                    <div class="timeline-item flex items-center space-x-4 p-4 bg-white rounded-xl shadow-sm border border-slate-200/50 hover:shadow-md transition-all duration-300">
                        <div class="w-3 h-3 bg-light-orange rounded-full"></div>
                        <div>
                            <div class="font-semibold text-slate-900">2024 - {{ app()->getLocale() === 'am' ? 'እድገት' : 'Growth' }}</div>
                            <div class="text-sm text-slate-600">{{ app()->getLocale() === 'am' ? '50+ ተሽከርካሪዎች እና 1000+ ደንበኞች' : '50+ vehicles, 1000+ customers' }}</div>
                        </div>
                    </div>
                    <div class="timeline-item flex items-center space-x-4 p-4 bg-white rounded-xl shadow-sm border border-slate-200/50 hover:shadow-md transition-all duration-300">
                        <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                        <div>
                            <div class="font-semibold text-slate-900">2025 - {{ app()->getLocale() === 'am' ? 'ዛሬ' : 'Today' }}</div>
                            <div class="text-sm text-slate-600">{{ app()->getLocale() === 'am' ? 'በመላው ኢትዮጵያ አገልግሎት' : 'Serving all of Ethiopia' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Abstract Visual -->
            <div class="animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="relative">
                    <div class="aspect-square bg-gradient-to-br from-neon-blue/20 to-light-orange/20 rounded-3xl p-8">
                        <div class="w-full h-full bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-24 h-24 bg-gradient-to-br from-neon-blue to-blue-glow rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-slate-900 mb-2">
                                    {{ app()->getLocale() === 'am' ? 'ፈጣን እና አስተማማኝ' : 'Fast & Reliable' }}
                                </h3>
                                <p class="text-slate-600">
                                    {{ app()->getLocale() === 'am' ? 'በቴክኖሎጂ የተደገፈ አገልግሎት' : 'Technology-powered service' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3️⃣ OUR MISSION & VISION (Core Values Section) -->
<section class="py-20 bg-gradient-professional">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-display text-slate-900 mb-4">
                {{ app()->getLocale() === 'am' ? 'የእኛ ተልእኮ እና ራዕይ' : 'Our Mission & Vision' }}
            </h2>
            <p class="text-body max-w-2xl mx-auto">
                {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ አገልግሎትን እንደገና በመቀየር የኢትዮጵያን ተንቀሳቃሽነት እንለውጣለን' : 'Transforming Ethiopia\'s mobility through innovative vehicle services' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Mission Card -->
            <div class="mission-card bg-dim-white/90 backdrop-blur-xl rounded-3xl p-8 border border-slate-250/60 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-neon-blue to-blue-glow rounded-2xl flex items-center justify-center shadow-lg mission-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ app()->getLocale() === 'am' ? 'የእኛ ተልእኮ' : 'Our Mission' }}
                    </h3>
                </div>
                <p class="text-body leading-relaxed">
                    @if(app()->getLocale() === 'am')
                        ለእያንዳንዱ ኢትዮጵያዊ ቀላል፣ ደህንነቱ የተጠበቀ እና ተደራሽ የተሽከርካሪ አገልግሎት ማቅረብ። ዘመናዊ ቴክኖሎጂን ከአካባቢያዊ ፍላጎቶች ጋር በማጣመር፣ የተሽከርካሪ ኪራይ እና ሽያጭ ልምድን እንለውጣለን።
                    @else
                        To provide simple, secure, and accessible vehicle services for every Ethiopian. We combine modern technology with local expertise to transform the car rental and sales experience, making it transparent, efficient, and trustworthy.
                    @endif
                </p>
            </div>
            
            <!-- Vision Card -->
            <div class="vision-card bg-dim-white/90 backdrop-blur-xl rounded-3xl p-8 border border-slate-250/60 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-light-orange to-peach-glow rounded-2xl flex items-center justify-center shadow-lg vision-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ app()->getLocale() === 'am' ? 'የእኛ ራዕይ' : 'Our Vision' }}
                    </h3>
                </div>
                <p class="text-body leading-relaxed">
                    @if(app()->getLocale() === 'am')
                        በ2030 በመላው አፍሪካ የተሽከርካሪ አገልግሎት መሪ መሆን። ኢትዮጵያን የተንቀሳቃሽነት ማዕከል በማድረግ፣ ለሁሉም ዜጎች ዘመናዊ፣ ደህንነቱ የተጠበቀ እና ተደራሽ የመጓጓዣ መፍትሄዎችን እናቀርባለን።
                    @else
                        To become Africa's leading vehicle services platform by 2030. We envision Ethiopia as a mobility hub, where every citizen has access to modern, secure, and affordable transportation solutions that connect communities and drive economic growth.
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 4️⃣ WHAT MAKES US DIFFERENT (Competitive Advantage) -->
<section class="py-20 bg-soft-white">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-display text-slate-900 mb-4">
                {{ app()->getLocale() === 'am' ? 'ልዩ የሚያደርገን ነገር' : 'What Makes Us Different' }}
            </h2>
            <p class="text-body max-w-2xl mx-auto">
                {{ app()->getLocale() === 'am' ? 'ለምን እኛን መምረጥ እንዳለብዎ የሚያሳዩ ልዩ ባህሪያቶች' : 'Unique features that set us apart in the Ethiopian market' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Security Feature -->
            <div class="feature-card card-premium card-glow-blue hover:scale-105 transition-all duration-300 animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-neon-blue to-blue-glow rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg feature-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div class="inline-flex items-center space-x-1 bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full mb-4">
                        <span>{{ app()->getLocale() === 'am' ? 'የተረጋገጠ' : 'Verified' }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'ደህንነት' : 'Security' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? 'የተረጋገጡ ተሽከርካሪዎች እና ደህንነቱ የተጠበቀ ክፍያ' : 'Verified vehicles and secure payment systems' }}
                    </p>
                </div>
            </div>
            
            <!-- Convenience Feature -->
            <div class="feature-card card-premium card-glow-blue hover:scale-105 transition-all duration-300 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-neon-blue to-blue-glow rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg feature-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="inline-flex items-center space-x-1 bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full mb-4">
                        <span>{{ app()->getLocale() === 'am' ? 'ፈጣን' : 'Fast' }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'ምቾት' : 'Convenience' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? '24/7 የመስመር ላይ ቦታ ማስያዝ እና ፈጣን አገልግሎት' : '24/7 online booking and instant service' }}
                    </p>
                </div>
            </div>
            
            <!-- Transparency Feature -->
            <div class="feature-card card-premium card-glow-orange hover:scale-105 transition-all duration-300 animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-light-orange to-peach-glow rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg feature-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div class="inline-flex items-center space-x-1 bg-orange-100 text-orange-800 text-xs font-medium px-2 py-1 rounded-full mb-4">
                        <span>{{ app()->getLocale() === 'am' ? 'ግልጽ' : 'Clear' }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'ግልጽነት' : 'Transparency' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? 'ምንም የተደበቀ ክፍያ የለም፣ ግልጽ የዋጋ አወጣጥ' : 'No hidden fees, transparent pricing' }}
                    </p>
                </div>
            </div>
            
            <!-- Local Payments Feature -->
            <div class="feature-card card-premium card-glow-orange hover:scale-105 transition-all duration-300 animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-light-orange to-peach-glow rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg feature-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="inline-flex items-center space-x-1 bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full mb-4">
                        <span>{{ app()->getLocale() === 'am' ? 'አካባቢያዊ' : 'Local' }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'የአካባቢ ክፍያዎች' : 'Local Payments' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? 'ቻፓ፣ ቴሌብር እና ሌሎች የአካባቢ ክፍያ ዘዴዎች' : 'Chapa, Telebirr, and other local payment methods' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5️⃣ HOW THE PLATFORM WORKS (User Journey) -->
<section class="py-20 bg-gradient-professional">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-display text-slate-900 mb-4">
                {{ app()->getLocale() === 'am' ? 'እንዴት እንሰራለን' : 'How It Works' }}
            </h2>
            <p class="text-body max-w-2xl mx-auto">
                {{ app()->getLocale() === 'am' ? 'ከፍለጋ እስከ ማጠናቀቅ ድረስ ያለው ቀላል ሂደት' : 'Simple process from discovery to completion' }}
            </p>
        </div>
        
        <div class="relative">
            <!-- Connecting Line -->
            <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-0.5 bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange transform -translate-y-1/2 connecting-line"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1: Discovery -->
                <div class="step-card text-center animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-neon-blue to-blue-glow rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg step-icon">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-light-orange rounded-full flex items-center justify-center text-white font-bold text-sm">1</div>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'ፈልግ' : 'Search' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? 'የሚፈልጉትን ተሽከርካሪ ይፈልጉ እና ያነጻጽሩ' : 'Browse and compare vehicles that match your needs' }}
                    </p>
                </div>
                
                <!-- Step 2: Booking -->
                <div class="step-card text-center animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-neon-blue to-blue-glow rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg step-icon">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 9l2 2 4-4m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-light-orange rounded-full flex items-center justify-center text-white font-bold text-sm">2</div>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'ይምረጡ' : 'Select' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? 'ቀን እና ሰዓት ይምረጡ፣ ዝርዝሮችን ያረጋግጡ' : 'Choose dates and times, confirm details' }}
                    </p>
                </div>
                
                <!-- Step 3: Payment -->
                <div class="step-card text-center animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-light-orange to-peach-glow rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg step-icon">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-neon-blue rounded-full flex items-center justify-center text-white font-bold text-sm">3</div>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'ይክፈሉ' : 'Pay' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ የአካባቢ ክፍያ ዘዴዎችን ይጠቀሙ' : 'Use secure local payment methods' }}
                    </p>
                </div>
                
                <!-- Step 4: Enjoy -->
                <div class="step-card text-center animate-on-scroll" style="animation-delay: 0.4s;">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-light-orange to-peach-glow rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg step-icon">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.01M15 10h1.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-neon-blue rounded-full flex items-center justify-center text-white font-bold text-sm">4</div>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">
                        {{ app()->getLocale() === 'am' ? 'ይደሰቱ' : 'Enjoy' }}
                    </h3>
                    <p class="text-body">
                        {{ app()->getLocale() === 'am' ? 'በተሽከርካሪዎ ጉዞ ይደሰቱ' : 'Enjoy your journey with confidence' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6️⃣ TRUST & SECURITY (Confidence Builder Section) -->
<section class="py-20 bg-soft-white">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-display text-slate-900 mb-4">
                {{ app()->getLocale() === 'am' ? 'እምነት እና ደህንነት' : 'Trust & Security' }}
            </h2>
            <p class="text-body max-w-2xl mx-auto">
                {{ app()->getLocale() === 'am' ? 'የእርስዎ ደህንነት እና እምነት የእኛ ቅድሚያ ነው' : 'Your safety and trust are our top priorities' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Secure Payments -->
            <div class="trust-card bg-dim-white/90 backdrop-blur-sm rounded-2xl p-8 text-center border border-slate-250/60 shadow-sm hover:shadow-lg transition-all duration-300 animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'ደህንነቱ የተጠበቀ ክፍያ' : 'Secure Payments' }}
                </h3>
                <p class="text-body">
                    {{ app()->getLocale() === 'am' ? 'ሁሉም ክፍያዎች በ256-ቢት SSL ምስጠራ የተጠበቁ ናቸው' : 'All payments protected with 256-bit SSL encryption' }}
                </p>
            </div>
            
            <!-- Verified Vehicles -->
            <div class="trust-card bg-dim-white/90 backdrop-blur-sm rounded-2xl p-8 text-center border border-slate-250/60 shadow-sm hover:shadow-lg transition-all duration-300 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-br from-neon-blue to-blue-glow rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-4">
                    {{ app()->getLocale() === 'am' ? 'የተረጋገጡ ተሽከርካሪዎች' : 'Verified Vehicles' }}
                </h3>
                <p class="text-body">
                    {{ app()->getLocale() === 'am' ? 'ሁሉም ተሽከርካሪዎች በባለሙያዎች የተፈተሹ እና የተረጋገጡ ናቸው' : 'Every vehicle inspected and verified by professionals' }}
                </p>
            </div>
            
            <!-- 24/7 Support -->
            <div class="trust-card bg-dim-white/90 backdrop-blur-sm rounded-2xl p-8 text-center border border-slate-250/60 shadow-sm hover:shadow-lg transition-all duration-300 animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-br from-light-orange to-peach-glow rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-4">
                    {{ app()->getLocale() === 'am' ? '24/7 ድጋፍ' : '24/7 Support' }}
                </h3>
                <p class="text-body">
                    {{ app()->getLocale() === 'am' ? 'በማንኛውም ጊዜ የሚያስፈልግዎት ድጋፍ እናቀርባለን' : 'Round-the-clock customer support when you need it' }}
                </p>
            </div>
        </div>
        
        <!-- Partner Logos -->
        <div class="text-center animate-on-scroll" style="animation-delay: 0.4s;">
            <p class="text-sm text-slate-600 mb-8">{{ app()->getLocale() === 'am' ? 'የተመረጡ አጋሮች' : 'Trusted Partners' }}</p>
            <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
                <div class="partner-logo bg-dim-white rounded-lg p-4 border border-slate-250/60">
                    <div class="text-2xl font-bold text-neon-blue">Chapa</div>
                </div>
                <div class="partner-logo bg-dim-white rounded-lg p-4 border border-slate-250/60">
                    <div class="text-2xl font-bold text-green-600">Telebirr</div>
                </div>
                <div class="partner-logo bg-dim-white rounded-lg p-4 border border-slate-250/60">
                    <div class="text-2xl font-bold text-blue-600">CBE</div>
                </div>
                <div class="partner-logo bg-dim-white rounded-lg p-4 border border-slate-250/60">
                    <div class="text-2xl font-bold text-orange-600">Awash</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7️⃣ COMMUNITY & IMPACT (Emotional Proof) -->
<section class="py-20 bg-gradient-professional">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-display text-slate-900 mb-4">
                {{ app()->getLocale() === 'am' ? 'የእኛ ተጽእኖ' : 'Our Impact' }}
            </h2>
            <p class="text-body max-w-2xl mx-auto">
                {{ app()->getLocale() === 'am' ? 'በኢትዮጵያ ውስጥ የተንቀሳቃሽነት ለውጥ እያመጣን ነው' : 'Making a difference in Ethiopia\'s mobility landscape' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <!-- Statistics -->
            <div class="stat-card text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-4xl lg:text-5xl font-bold text-neon-blue mb-2 counter" data-target="1000">0</div>
                <div class="text-slate-600">{{ app()->getLocale() === 'am' ? 'ደንበኞች' : 'Happy Customers' }}</div>
            </div>
            
            <div class="stat-card text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-4xl lg:text-5xl font-bold text-light-orange mb-2 counter" data-target="50">0</div>
                <div class="text-slate-600">{{ app()->getLocale() === 'am' ? 'ተሽከርካሪዎች' : 'Vehicles' }}</div>
            </div>
            
            <div class="stat-card text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-4xl lg:text-5xl font-bold text-neon-blue mb-2 counter" data-target="5">0</div>
                <div class="text-slate-600">{{ app()->getLocale() === 'am' ? 'ከተሞች' : 'Cities' }}</div>
            </div>
            
            <div class="stat-card text-center animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="text-4xl lg:text-5xl font-bold text-light-orange mb-2">99%</div>
                <div class="text-slate-600">{{ app()->getLocale() === 'am' ? 'እርካታ' : 'Satisfaction' }}</div>
            </div>
        </div>
        
        <!-- Testimonial -->
        <div class="max-w-4xl mx-auto text-center animate-on-scroll" style="animation-delay: 0.5s;">
            <div class="bg-dim-white/90 backdrop-blur-sm rounded-3xl p-8 border border-slate-250/60 shadow-lg">
                <div class="text-2xl text-slate-600 mb-6">"</div>
                <p class="text-xl text-slate-700 leading-relaxed mb-6">
                    @if(app()->getLocale() === 'am')
                        Addis Drive የኢትዮጵያ የተሽከርካሪ አገልግሎት ገበያን ሙሉ በሙሉ ለውጧል። ቀላል፣ ደህንነቱ የተጠበቀ እና አስተማማኝ አገልግሎት ነው።
                    @else
                        "Addis Drive has completely transformed the vehicle service market in Ethiopia. It's simple, secure, and reliable service that we can trust."
                    @endif
                </p>
                <div class="flex items-center justify-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-neon-blue to-blue-glow rounded-full flex items-center justify-center text-white font-bold">
                        A
                    </div>
                    <div class="text-left">
                        <div class="font-semibold text-slate-900">{{ app()->getLocale() === 'am' ? 'አበበ ተስፋዬ' : 'Abebe Tesfaye' }}</div>
                        <div class="text-sm text-slate-600">{{ app()->getLocale() === 'am' ? 'ደንበኛ' : 'Customer' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8️⃣ CALL-TO-ACTION (Brand Closure Section) -->
<section class="py-20 bg-slate-900 text-white relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-neon-blue/20 rounded-full blur-3xl animate-pulse-soft"></div>
        <div class="absolute bottom-1/3 right-1/4 w-80 h-80 bg-light-orange/15 rounded-full blur-3xl animate-float"></div>
    </div>
    
    <div class="relative z-10 max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-on-scroll">
            <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                @if(app()->getLocale() === 'am')
                    <span class="block">ዛሬ ጀምር</span>
                    <span class="block text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text">የእርስዎን ጉዞ</span>
                @else
                    <span class="block">Start Your Journey</span>
                    <span class="block text-transparent bg-gradient-to-r from-neon-blue via-blue-glow to-light-orange bg-clip-text">Today</span>
                @endif
            </h2>
            <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
                {{ app()->getLocale() === 'am' ? 'በሺዎች የሚቆጠሩ ደንበኞች ወደ እኛ ይቀላቀሉ እና የተሽከርካሪ አገልግሎትን በአዲስ መንገድ ይለማመዱ' : 'Join thousands of satisfied customers and experience vehicle services like never before' }}
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('vehicles.rentals') }}" class="btn-primary text-lg px-8 py-4 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'መኪና ይከራዩ' : 'Rent a Car' }}
                </a>
                <a href="{{ route('vehicles.sales') }}" class="btn-secondary text-lg px-8 py-4 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 bg-dim-white text-slate-900 border-dim-white hover:bg-white">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    {{ app()->getLocale() === 'am' ? 'መኪና ይግዙ' : 'Buy a Car' }}
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🌟 Premium About Page Loaded');
    
    // Parallax effect for hero background
    const heroSection = document.querySelector('section');
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = heroSection.querySelector('.absolute.inset-0 > div');
            if (parallax) {
                parallax.style.transform = `scale(1.1) translateY(${scrolled * 0.5}px)`;
            }
        });
    }
    
    // Step icons animation
    const stepIcons = document.querySelectorAll('.step-icon');
    stepIcons.forEach((icon, index) => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.15) translateY(-5px)';
            this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.2)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) translateY(0px)';
            this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.1)';
        });
    });
    
    // Connecting line animation
    const connectingLine = document.querySelector('.connecting-line');
    if (connectingLine) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    connectingLine.style.width = '100%';
                    connectingLine.style.opacity = '1';
                }
            });
        });
        observer.observe(connectingLine);
    }
    
    // Counter animation
    const counters = document.querySelectorAll('.counter');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'));
                let current = 0;
                const increment = target / 100;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
                counterObserver.unobserve(counter);
            }
        });
    });
    
    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
    
    // Trust cards hover effect
    const trustCards = document.querySelectorAll('.trust-card');
    trustCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0px)';
        });
    });
    
    // Partner logos hover effect
    const partnerLogos = document.querySelectorAll('.partner-logo');
    partnerLogos.forEach(logo => {
        logo.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.opacity = '1';
        });
        
        logo.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.opacity = '0.6';
        });
    });
});
</script>
@endpush

@push('styles')
<style>
/* About Page Specific Styles */
.hero-headline, .hero-description, .trust-badges {
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.mission-icon, .vision-icon, .feature-icon, .step-icon {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.timeline-item div:first-child {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.connecting-line {
    width: 0;
    opacity: 0;
    transition: all 2s ease-out;
}

.trust-card, .partner-logo {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Enhanced animations */
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

/* Light sweep effect for cards */
.mission-card::before,
.vision-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.mission-card:hover::before,
.vision-card:hover::before {
    left: 100%;
}

/* Feature card glow effects */
.feature-card:hover {
    box-shadow: 0 25px 50px rgba(37, 99, 235, 0.15);
}

.feature-card:nth-child(3):hover,
.feature-card:nth-child(4):hover {
    box-shadow: 0 25px 50px rgba(253, 186, 116, 0.15);
}

/* Step card sequential animation */
.step-card {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s ease-out forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@endsection
