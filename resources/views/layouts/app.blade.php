<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Addis Drive - Premium Vehicle Services')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // 🎨 Professional White System
                        'soft-white': '#F1F5F9',
                        'dim-white': '#E2E8F0',
                        'pure-white': '#FFFFFF',
                        'warm-gray': '#F8FAFC',
                        
                        // ⚡ Electric Blue System
                        'neon-blue': '#2563EB',
                        'blue-glow': '#60A5FA',
                        'blue-light': '#DBEAFE',
                        'blue-dark': '#1E40AF',
                        'blue-steel': '#334155',
                        
                        // 🍊 Accent Orange System
                        'light-orange': '#FDBA74',
                        'peach-glow': '#FED7AA',
                        'orange-light': '#FEF3C7',
                        'orange-dark': '#EA580C',
                        
                        // 🏢 Professional Neutral System
                        'slate-50': '#F8FAFC',
                        'slate-100': '#F1F5F9',
                        'slate-150': '#E8EDF4',
                        'slate-200': '#E2E8F0',
                        'slate-250': '#D1D9E2',
                        'slate-300': '#CBD5E1',
                        'slate-400': '#94A3B8',
                        'slate-500': '#64748B',
                        'slate-600': '#475569',
                        'slate-700': '#334155',
                        'slate-750': '#2A3441',
                        'slate-800': '#1E293B',
                        'slate-850': '#172032',
                        'slate-900': '#0F172A',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px rgba(37, 99, 235, 0.5)' },
                            '100%': { boxShadow: '0 0 20px rgba(37, 99, 235, 0.8)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.8' },
                        },
                    },
                    backdropBlur: {
                        'xs': '2px',
                    },
                    maxWidth: {
                        '8xl': '1440px',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Global Design System Styles */
        body { 
            font-family: 'Poppins', system-ui, sans-serif; 
            background-color: #F1F5F9;
            margin: 0; 
            padding: 0;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* 🚗 CLEAN NAVIGATION STYLES */
        #main-nav {
            transition: all 0.3s ease;
        }
        
        #main-nav.nav-scrolled {
            @apply bg-dim-white/90 backdrop-blur-3xl shadow-lg;
        }
        
        /* Navigation Links */
        .nav-link {
            @apply inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 hover:text-neon-blue rounded-xl transition-all duration-200;
            @apply hover:bg-neon-blue/10 hover:shadow-sm;
        }
        
        .nav-link.active {
            @apply bg-gradient-to-r from-neon-blue to-blue-glow text-white shadow-lg;
        }
        
        /* Mobile Navigation Links */
        .mobile-nav-link {
            @apply flex items-center space-x-3 px-4 py-3 text-slate-700 hover:text-neon-blue hover:bg-neon-blue/10 rounded-xl transition-all duration-200 font-medium;
        }
        
        .mobile-nav-link.active {
            @apply bg-gradient-to-r from-neon-blue to-blue-glow text-white shadow-sm;
        }
        
        /* Mobile Auth Links */
        .mobile-auth-link {
            @apply flex items-center space-x-3 px-4 py-3 text-slate-600 hover:text-neon-blue hover:bg-neon-blue/10 rounded-xl transition-all duration-200 font-medium;
        }
        
        .mobile-auth-btn {
            @apply flex items-center space-x-3 px-4 py-3 bg-gradient-to-r from-neon-blue to-blue-glow text-white font-semibold rounded-xl hover:from-blue-dark hover:to-neon-blue transition-all duration-200 shadow-sm;
        }
        
        /* Dropdown Items */
        .dropdown-item {
            @apply flex items-center space-x-3 px-4 py-3 text-sm text-slate-700 hover:bg-neon-blue/10 hover:text-neon-blue transition-all duration-200 rounded-lg mx-2;
        }
        
        /* Menu Line Animation */
        .menu-line {
            @apply transition-all duration-300;
            transform-origin: center;
        }
        
        /* Elite Button System */
        .btn-primary {
            @apply bg-neon-blue text-white px-6 py-3 rounded-lg font-medium;
            @apply hover:bg-blue-dark hover:shadow-lg hover:shadow-blue-glow/25;
            @apply active:scale-95 transition-all duration-200;
            @apply focus:outline-none focus:ring-2 focus:ring-blue-glow focus:ring-offset-2;
        }
        
        .btn-secondary {
            @apply bg-dim-white text-neon-blue border-2 border-neon-blue px-6 py-3 rounded-lg font-medium;
            @apply hover:bg-blue-light hover:border-blue-dark;
            @apply active:scale-95 transition-all duration-200;
            @apply focus:outline-none focus:ring-2 focus:ring-blue-glow focus:ring-offset-2;
        }
        
        .btn-cta {
            @apply bg-light-orange text-slate-800 px-6 py-3 rounded-lg font-semibold;
            @apply hover:bg-orange-dark hover:text-white hover:shadow-lg hover:shadow-light-orange/30;
            @apply active:scale-95 transition-all duration-200;
            @apply focus:outline-none focus:ring-2 focus:ring-light-orange focus:ring-offset-2;
        }
        
        /* Premium Card System */
        .card-premium {
            @apply bg-dim-white/90 backdrop-blur-sm rounded-xl shadow-sm border border-slate-250/60;
            @apply hover:shadow-xl hover:shadow-slate-300/30 hover:-translate-y-1;
            @apply transition-all duration-300 ease-out;
        }
        
        .card-glow-blue {
            @apply hover:ring-2 hover:ring-blue-glow/20 hover:border-blue-glow/40;
        }
        
        .card-glow-orange {
            @apply hover:ring-2 hover:ring-light-orange/20 hover:border-light-orange/40;
        }
        
        /* Typography System */
        .text-hero {
            @apply text-5xl md:text-6xl lg:text-7xl font-bold leading-tight tracking-tight;
        }
        
        .text-display {
            @apply text-3xl md:text-4xl lg:text-5xl font-bold leading-tight;
        }
        
        .text-heading {
            @apply text-2xl md:text-3xl font-semibold leading-tight;
        }
        
        .text-subheading {
            @apply text-lg md:text-xl font-medium leading-relaxed;
        }
        
        .text-body {
            @apply text-base leading-relaxed text-slate-600;
        }
        
        /* Animation Classes */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Gradient Backgrounds */
        .gradient-hero {
            background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 30%, #DBEAFE 70%, #FEF3C7 100%);
        }
        
        .gradient-blue {
            background: linear-gradient(135deg, #2563EB 0%, #60A5FA 100%);
        }
        
        .gradient-orange {
            background: linear-gradient(135deg, #FDBA74 0%, #FED7AA 100%);
        }
        
        .gradient-professional {
            background: linear-gradient(135deg, #F1F5F9 0%, #E8EDF4 50%, #E2E8F0 100%);
        }
        
        /* Scroll Animations */
        @media (prefers-reduced-motion: no-preference) {
            .smooth-scroll {
                scroll-behavior: smooth;
            }
        }
        
        /* Loading States */
        .skeleton {
            @apply animate-pulse bg-slate-200 rounded;
        }
        
        /* Focus States */
        .focus-ring {
            @apply focus:outline-none focus:ring-2 focus:ring-neon-blue focus:ring-offset-2;
        }
        
        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .text-hero {
                @apply text-4xl;
            }
            .text-display {
                @apply text-3xl;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-soft-white smooth-scroll">
    <!-- 🚗 PREMIUM NAVIGATION BAR -->
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 w-full bg-dim-white/85 backdrop-blur-xl border-b border-slate-250/60 shadow-sm transition-all duration-300">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- 🎯 Premium Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-neon-blue to-blue-dark rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 6h3l2 7H6l2-7h3"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17h14v-2a1 1 0 00-1-1H6a1 1 0 00-1 1v2z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:block">
                            <div class="text-xl lg:text-2xl font-bold text-slate-900 group-hover:text-neon-blue transition-colors duration-300">Addis Drive</div>
                            <div class="text-xs text-slate-500 -mt-1">{{ app()->getLocale() === 'am' ? 'ፕሪሚየም አገልግሎት' : 'Premium Service' }}</div>
                        </div>
                    </a>
                </div>
                
                <!-- 🎯 Desktop Navigation Menu
                <div class="hidden lg:flex items-center space-x-10">
                    <div class="flex items-center space-x-10 bg-dim-white/80 backdrop-blur-xl rounded-2xl p-2 border border-slate-250/60 shadow-sm">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ቤት' : 'Home' }}
                        </a>
                        
                        <a href="{{ route('vehicles.rentals') }}" class="nav-link {{ request()->routeIs('vehicles.rentals') ? 'active' : '' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ኪራይ' : 'Rent' }}
                        </a>
                        
                        <a href="{{ route('vehicles.sales') }}" class="nav-link {{ request()->routeIs('vehicles.sales') ? 'active' : '' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ግዢ' : 'Buy' }}
                        </a>
                        
                        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ስለ እኛ' : 'About' }}
                        </a>
                        
                        <a href="{{ route('contact.show') }}" class="nav-link {{ request()->routeIs('contact.show') ? 'active' : '' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact' }}
                        </a>
                    </div>
                </div> -->

                <!-- 🎯 Desktop Navigation Menu -->
<div class="hidden lg:flex items-center space-x-10">
    <div
        class="flex items-center space-x-10
               bg-white/80 backdrop-blur-xl
               rounded-2xl p-2
               border border-slate-200/60
               shadow-[0_20px_50px_rgba(15,23,42,0.08)]">

        <!-- Home -->
        <a href="{{ route('home') }}"
           class="group relative flex items-center gap-2 px-4 py-2 rounded-xl
                  text-slate-500 font-medium
                  transition-all duration-500 ease-out
                  hover:text-slate-900
                  hover:-translate-y-[1px]
                  hover:shadow-[0_10px_30px_rgba(0,212,255,0.25)]
                  {{ request()->routeIs('home') ? 'text-slate-900 bg-gradient-to-br from-cyan-400/25 to-orange-300/25 shadow-[0_8px_25px_rgba(0,212,255,0.3)]' : '' }}">

            <svg class="w-4 h-4 transition-all duration-500 group-hover:-translate-y-1 group-hover:scale-110 group-hover:text-cyan-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>

            {{ app()->getLocale() === 'am' ? 'ቤት' : 'Home' }}

            <!-- animated underline -->
            <span
                class="pointer-events-none absolute left-1/2 -translate-x-1/2 bottom-1 h-[2px] w-0
                       bg-gradient-to-r from-cyan-400 to-orange-300
                       rounded-full transition-all duration-500
                       group-hover:w-3/4
                       {{ request()->routeIs('home') ? 'w-3/4' : '' }}">
            </span>
        </a>

        <!-- Rent -->
        <a href="{{ route('vehicles.rentals') }}"
           class="group relative flex items-center gap-2 px-4 py-2 rounded-xl
                  text-slate-500 font-medium
                  transition-all duration-500 ease-out
                  hover:text-slate-900
                  hover:-translate-y-[1px]
                  hover:shadow-[0_10px_30px_rgba(0,212,255,0.25)]
                  {{ request()->routeIs('vehicles.rentals') ? 'text-slate-900 bg-gradient-to-br from-cyan-400/25 to-orange-300/25 shadow-[0_8px_25px_rgba(0,212,255,0.3)]' : '' }}">

            <svg class="w-4 h-4 transition-all duration-500 group-hover:-translate-y-1 group-hover:scale-110 group-hover:text-cyan-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            {{ app()->getLocale() === 'am' ? 'ኪራይ' : 'Rent' }}

            <span
                class="pointer-events-none absolute left-1/2 -translate-x-1/2 bottom-1 h-[2px] w-0
                       bg-gradient-to-r from-cyan-400 to-orange-300
                       rounded-full transition-all duration-500
                       group-hover:w-3/4
                       {{ request()->routeIs('vehicles.rentals') ? 'w-3/4' : '' }}">
            </span>
        </a>

        <!-- Buy -->
        <a href="{{ route('vehicles.sales') }}"
           class="group relative flex items-center gap-2 px-4 py-2 rounded-xl
                  text-slate-500 font-medium
                  transition-all duration-500 ease-out
                  hover:text-slate-900
                  hover:-translate-y-[1px]
                  hover:shadow-[0_10px_30px_rgba(0,212,255,0.25)]
                  {{ request()->routeIs('vehicles.sales') ? 'text-slate-900 bg-gradient-to-br from-cyan-400/25 to-orange-300/25 shadow-[0_8px_25px_rgba(0,212,255,0.3)]' : '' }}">

            <svg class="w-4 h-4 transition-all duration-500 group-hover:-translate-y-1 group-hover:scale-110 group-hover:text-cyan-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>

            {{ app()->getLocale() === 'am' ? 'ግዢ' : 'Buy' }}

            <span
                class="pointer-events-none absolute left-1/2 -translate-x-1/2 bottom-1 h-[2px] w-0
                       bg-gradient-to-r from-cyan-400 to-orange-300
                       rounded-full transition-all duration-500
                       group-hover:w-3/4
                       {{ request()->routeIs('vehicles.sales') ? 'w-3/4' : '' }}">
            </span>
        </a>

        <!-- About -->
        <a href="{{ route('about') }}"
           class="group relative flex items-center gap-2 px-4 py-2 rounded-xl
                  text-slate-500 font-medium
                  transition-all duration-500 ease-out
                  hover:text-slate-900
                  hover:-translate-y-[1px]
                  hover:shadow-[0_10px_30px_rgba(0,212,255,0.25)]
                  {{ request()->routeIs('about') ? 'text-slate-900 bg-gradient-to-br from-cyan-400/25 to-orange-300/25 shadow-[0_8px_25px_rgba(0,212,255,0.3)]' : '' }}">

            <svg class="w-4 h-4 transition-all duration-500 group-hover:-translate-y-1 group-hover:scale-110 group-hover:text-cyan-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>

            {{ app()->getLocale() === 'am' ? 'ስለ እኛ' : 'About' }}

            <span
                class="pointer-events-none absolute left-1/2 -translate-x-1/2 bottom-1 h-[2px] w-0
                       bg-gradient-to-r from-cyan-400 to-orange-300
                       rounded-full transition-all duration-500
                       group-hover:w-3/4
                       {{ request()->routeIs('about') ? 'w-3/4' : '' }}">
            </span>
        </a>

        <!-- Contact -->
        <a href="{{ route('contact.show') }}"
           class="group relative flex items-center gap-2 px-4 py-2 rounded-xl
                  text-slate-500 font-medium
                  transition-all duration-500 ease-out
                  hover:text-slate-900
                  hover:-translate-y-[1px]
                  hover:shadow-[0_10px_30px_rgba(0,212,255,0.25)]
                  {{ request()->routeIs('contact.show') ? 'text-slate-900 bg-gradient-to-br from-cyan-400/25 to-orange-300/25 shadow-[0_8px_25px_rgba(0,212,255,0.3)]' : '' }}">

            <svg class="w-4 h-4 transition-all duration-500 group-hover:-translate-y-1 group-hover:scale-110 group-hover:text-cyan-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>

            {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact' }}

            <span
                class="pointer-events-none absolute left-1/2 -translate-x-1/2 bottom-1 h-[2px] w-0
                       bg-gradient-to-r from-cyan-400 to-orange-300
                       rounded-full transition-all duration-500
                       group-hover:w-3/4
                       {{ request()->routeIs('contact.show') ? 'w-3/4' : '' }}">
            </span>
        </a>

    </div>
</div>

                
                <!-- 🎯 User Actions & Controls -->
                <div class="flex items-center space-x-3">
                    <!-- Language Switcher -->
                    <div class="hidden sm:flex items-center space-x-1 bg-dim-white/80 backdrop-blur-xl rounded-xl p-1 border border-slate-250/60 shadow-sm">
                        <a href="{{ route('language.set', 'en') }}" 
                           class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ app()->getLocale() === 'en' ? 'bg-gradient-to-r from-neon-blue to-blue-glow text-white shadow-sm' : 'text-slate-600 hover:text-neon-blue hover:bg-neon-blue/10' }}">
                            EN
                        </a>
                        <a href="{{ route('language.set', 'am') }}" 
                           class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ app()->getLocale() === 'am' ? 'bg-gradient-to-r from-neon-blue to-blue-glow text-white shadow-sm' : 'text-slate-600 hover:text-neon-blue hover:bg-neon-blue/10' }}">
                            አማ
                        </a>
                    </div>
                    
                    @auth
                        <!-- User Menu -->
                        <div class="relative">
                            <button onclick="toggleUserMenu()" class="flex items-center space-x-2 bg-dim-white/80 backdrop-blur-xl hover:bg-dim-white rounded-xl px-3 py-2 transition-all duration-200 group border border-slate-250/60 shadow-sm">
                                <div class="w-8 h-8 bg-gradient-to-br from-neon-blue to-blue-glow rounded-full flex items-center justify-center text-white text-sm font-semibold shadow-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-slate-500">{{ auth()->user()->isAdmin() ? (app()->getLocale() === 'am' ? 'አስተዳዳሪ' : 'Admin') : (app()->getLocale() === 'am' ? 'ተጠቃሚ' : 'User') }}</div>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-neon-blue transition-all duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div id="user-menu"
     class="hidden absolute right-0 mt-3 w-72
            bg-dim-white/90 backdrop-blur-xl
            rounded-3xl shadow-2xl
            border border-slate-250/70
            overflow-hidden
            z-50">

    <!-- Header / Identity -->
    <div class="px-5 py-4
                bg-gradient-to-br from-slate-100 to-slate-150
                border-b border-slate-250/60">

        <div class="flex items-center gap-4">

            <!-- Avatar -->
            <div class="relative">
                <div
                    class="w-11 h-11 rounded-full
                           bg-gradient-to-br from-blue-500 to-blue-700
                           flex items-center justify-center
                           text-white font-semibold text-lg shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <!-- Verified / Online Dot -->
                <span
                    class="absolute -bottom-1 -right-1
                           w-3.5 h-3.5 rounded-full
                           bg-emerald-500
                           border-2 border-white">
                </span>
            </div>

            <!-- User Info -->
            <div class="min-w-0">
                <div class="font-semibold text-slate-900 truncate">
                    {{ auth()->user()->name }}
                </div>
                <div class="text-sm text-slate-500 truncate">
                    {{ auth()->user()->email }}
                </div>
            </div>
        </div>
    </div>

                                
                                <a href="{{ route('dashboard') }}"
   class="group flex items-center justify-center gap-3 
          px-4 py-3 rounded-xl
          text-slate-700 font-medium
          transition-all duration-300
          hover:bg-gradient-to-r hover:from-blue-50 hover:to-orange-50
          hover:text-slate-900
          relative overflow-hidden">

    <!-- Soft hover glow -->
    <span
      class="absolute inset-0 
             bg-gradient-to-r from-blue-500/0 to-orange-400/0
             group-hover:from-blue-500/10 group-hover:to-orange-400/10
             transition-opacity duration-300">
    </span>

    <!-- Icon wrapper -->
    <span
      class="relative z-10 flex items-center justify-center
             w-9 h-9 rounded-full
             bg-dim-white shadow-sm
             group-hover:bg-blue-600
             transition-all duration-300">

        <svg class="w-4 h-4 text-blue-600 group-hover:text-white"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
        </svg>
    </span>

    <!-- Text -->
    <span class="relative z-10 text-sm tracking-wide">
        {{ app()->getLocale() === 'am' ? 'ዳሽቦርድ' : 'Dashboard' }}
    </span>
</a>

                  
                 @if(auth()->user()->isAdmin())
<a href="{{ route('admin.dashboard') }}"
   class="group relative flex items-center justify-center gap-3
          px-4 py-3 rounded-xl
          text-slate-800 font-medium
          transition-all duration-300
          hover:bg-gradient-to-r hover:from-blue-100 hover:to-slate-50
          overflow-hidden">

    <!-- Authority glow -->
    <span
      class="absolute inset-0
             bg-gradient-to-r from-blue-600/0 to-blue-400/0
             group-hover:from-blue-600/15 group-hover:to-blue-400/10
             transition-opacity duration-300">
    </span>

    <!-- Icon wrapper -->
    <span
      class="relative z-10 flex items-center justify-center
             w-9 h-9 rounded-full
             bg-slate-100
             group-hover:bg-blue-600
             transition-all duration-300">

        <svg class="w-4 h-4 text-blue-700 group-hover:text-white"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </span>

    <!-- Text -->
    <span class="relative z-10 text-sm tracking-wide">
        {{ app()->getLocale() === 'am' ? 'አስተዳዳሪ ፓነል' : 'Admin Panel' }}
    </span>
</a>
@endif

                                
<!-- Logout Form -->
<form method="POST" action="{{ route('logout') }}" class="w-full">
    @csrf

    <button type="submit"
        class="group relative w-full
               flex items-center justify-center gap-3
               px-4 py-3 rounded-xl
               text-red-600 font-medium
               transition-all duration-300
               hover:bg-gradient-to-r hover:from-red-50 hover:to-orange-50
               hover:text-red-700
               overflow-hidden">

        <!-- Soft danger glow -->
        <span
          class="absolute inset-0
                 bg-gradient-to-r from-red-500/0 to-orange-400/0
                 group-hover:from-red-500/10 group-hover:to-orange-400/10
                 transition-opacity duration-300">
        </span>

        <!-- Icon wrapper -->
        <span
          class="relative z-10 flex items-center justify-center
                 w-9 h-9 rounded-full
                 bg-dim-white shadow-sm
                 group-hover:bg-red-600
                 transition-all duration-300">

            <svg class="w-4 h-4 text-red-600 group-hover:text-white"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </span>

        <!-- Text -->
        <span class="relative z-10 text-sm tracking-wide">
            {{ app()->getLocale() === 'am' ? 'ውጣ' : 'Logout' }}
        </span>
    </button>
</form>

                            </div>
                        </div>
                    @else
                        <!-- Auth Buttons -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-slate-600 hover:text-neon-blue font-medium rounded-xl hover:bg-slate-50 transition-all duration-200" title="Login URL: {{ route('login') }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ግባ' : 'Login' }}
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-neon-blue text-white font-semibold rounded-xl hover:bg-blue-dark transition-all duration-200 shadow-sm hover:shadow-md" title="Register URL: {{ route('register') }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                {{ app()->getLocale() === 'am' ? 'ተመዝገብ' : 'Register' }}
                            </a>
                        </div>
                    @endauth
                    
                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-xl bg-dim-white/80 backdrop-blur-xl hover:bg-dim-white border border-slate-250/60 transition-all duration-200 shadow-sm">
                        <div class="w-6 h-6 flex flex-col justify-center space-y-1">
                            <span class="menu-line w-full h-0.5 bg-slate-700 rounded-full transition-all duration-300"></span>
                            <span class="menu-line w-full h-0.5 bg-slate-700 rounded-full transition-all duration-300"></span>
                            <span class="menu-line w-full h-0.5 bg-slate-700 rounded-full transition-all duration-300"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-dim-white/85 backdrop-blur-xl border-t border-slate-250/60 shadow-xl">
            <div class="px-4 py-6 space-y-4">
                <!-- Mobile Logo -->
                <div class="flex items-center space-x-3 pb-4 border-b border-slate-250/60">
                    <div class="w-10 h-10 bg-gradient-to-br from-neon-blue to-blue-dark rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 6h3l2 7H6l2-7h3"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17h14v-2a1 1 0 00-1-1H6a1 1 0 00-1 1v2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-slate-900">Addis Drive</span>
                </div>
                
                <!-- Mobile Navigation Links -->
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ቤት' : 'Home' }}
                    </a>
                    
                    <a href="{{ route('vehicles.rentals') }}" class="mobile-nav-link {{ request()->routeIs('vehicles.rentals') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ኪራይ' : 'Rent' }}
                    </a>
                    
                    <a href="{{ route('vehicles.sales') }}" class="mobile-nav-link {{ request()->routeIs('vehicles.sales') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ግዢ' : 'Buy' }}
                    </a>
                    
                    <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ስለ እኛ' : 'About' }}
                    </a>
                    
                    <a href="{{ route('contact.show') }}" class="mobile-nav-link {{ request()->routeIs('contact.show') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        {{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact' }}
                    </a>
                </div>
                
                @guest
                    <!-- Mobile Auth Section -->
                    <div class="pt-4 border-t border-slate-250/60 space-y-2">
                        <a href="{{ route('login') }}" class="mobile-auth-link" title="Login URL: {{ route('login') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ግባ' : 'Login' }}
                        </a>
                        <a href="{{ route('register') }}" class="mobile-auth-btn" title="Register URL: {{ route('register') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            {{ app()->getLocale() === 'am' ? 'ተመዝገብ' : 'Register' }}
                        </a>
                    </div>
                @endguest
                
                <!-- Mobile Language Switcher -->
                <div class="pt-4 border-t border-slate-250/60">
                    <div class="text-sm font-medium text-slate-700 mb-3">{{ app()->getLocale() === 'am' ? 'ቋንቋ' : 'Language' }}</div>
                    <div class="flex space-x-2">
                        <a href="{{ route('language.set', 'en') }}" class="flex-1 px-4 py-2 text-center text-sm font-medium rounded-lg transition-all duration-200 {{ app()->getLocale() === 'en' ? 'bg-gradient-to-r from-neon-blue to-blue-glow text-white shadow-sm' : 'bg-slate-150 text-slate-600 hover:bg-neon-blue/10 hover:text-neon-blue' }}">
                            English
                        </a>
                        <a href="{{ route('language.set', 'am') }}" class="flex-1 px-4 py-2 text-center text-sm font-medium rounded-lg transition-all duration-200 {{ app()->getLocale() === 'am' ? 'bg-gradient-to-r from-neon-blue to-blue-glow text-white shadow-sm' : 'bg-slate-150 text-slate-600 hover:bg-neon-blue/10 hover:text-neon-blue' }}">
                            አማርኛ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="flash-success" class="fixed top-20 right-4 z-50 bg-dim-white border-l-4 border-green-500 rounded-lg shadow-lg p-4 max-w-md animate-slide-down">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
                <button onclick="closeFlash('flash-success')" class="ml-auto text-green-500 hover:text-green-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="flash-error" class="fixed top-20 right-4 z-50 bg-dim-white border-l-4 border-red-500 rounded-lg shadow-lg p-4 max-w-md animate-slide-down">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
                <button onclick="closeFlash('flash-error')" class="ml-auto text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="pt-16 lg:pt-20">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-slate-900 text-white mt-20">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Brand -->
                <div class="lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-blue rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Addis Drive</span>
                    </div>
                    <p class="text-slate-400 leading-relaxed mb-6">
                        {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ኪራይ እና ሽያጭ አገልግሎት' : 'Premium vehicle rental and sales platform with secure payments and verified vehicles.' }}
                    </p>
                    <div class="flex space-x-4">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-neon-blue transition-colors duration-200 cursor-pointer">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </div>
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-neon-blue transition-colors duration-200 cursor-pointer">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">{{ app()->getLocale() === 'am' ? 'አገልግሎቶች' : 'Services' }}</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('vehicles.rentals') }}" class="footer-link">{{ app()->getLocale() === 'am' ? 'የመኪና ኪራይ' : 'Car Rental' }}</a></li>
                        <li><a href="{{ route('vehicles.sales') }}" class="footer-link">{{ app()->getLocale() === 'am' ? 'የመኪና ሽያጭ' : 'Car Sales' }}</a></li>
                        <li><a href="#" class="footer-link">{{ app()->getLocale() === 'am' ? 'የረጅም ጊዜ ኪራይ' : 'Long-term Rental' }}</a></li>
                        <li><a href="#" class="footer-link">{{ app()->getLocale() === 'am' ? 'የድርጅት አገልግሎት' : 'Corporate Services' }}</a></li>
                    </ul>
                </div>
                
                <!-- Company -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">{{ app()->getLocale() === 'am' ? 'ድርጅት' : 'Company' }}</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}" class="footer-link">{{ app()->getLocale() === 'am' ? 'ስለ እኛ' : 'About Us' }}</a></li>
                        <li><a href="{{ route('contact.show') }}" class="footer-link">{{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Us' }}</a></li>
                        <li><a href="#" class="footer-link">{{ app()->getLocale() === 'am' ? 'ስራዎች' : 'Careers' }}</a></li>
                        <li><a href="#" class="footer-link">{{ app()->getLocale() === 'am' ? 'ዜና' : 'News' }}</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">{{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Info' }}</h4>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span class="text-slate-400">+251-911-000-000</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-slate-400">info@addisdrive.com</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="text-slate-400">Addis Ababa, Ethiopia</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-slate-400 text-sm">
                    &copy; {{ date('Y') }} Addis Drive. {{ app()->getLocale() === 'am' ? 'ሁሉም መብቶች የተጠበቁ ናቸው።' : 'All rights reserved.' }}
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors duration-200">Privacy Policy</a>
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors duration-200">Terms of Service</a>
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors duration-200">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Navigation scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('main-nav');
            if (nav) {
                if (window.scrollY > 50) {
                    nav.classList.add('shadow-lg', 'nav-scrolled');
                } else {
                    nav.classList.remove('shadow-lg', 'nav-scrolled');
                }
            }
        });

        // User menu toggle
        function toggleUserMenu() {
            const menu = document.getElementById('user-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const lines = document.querySelectorAll('.menu-line');
            
            if (menu) {
                menu.classList.toggle('hidden');
                
                // Animate hamburger lines
                if (!menu.classList.contains('hidden')) {
                    // Menu is open - transform to X
                    lines[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
                    lines[1].style.opacity = '0';
                    lines[2].style.transform = 'rotate(-45deg) translate(6px, -6px)';
                } else {
                    // Menu is closed - back to hamburger
                    lines[0].style.transform = 'none';
                    lines[1].style.opacity = '1';
                    lines[2].style.transform = 'none';
                }
            }
        }

        // Close flash messages
        function closeFlash(id) {
            const element = document.getElementById(id);
            if (element) {
                element.style.opacity = '0';
                element.style.transform = 'translateX(100%)';
                setTimeout(() => element.remove(), 300);
            }
        }

        // Auto-hide flash messages
        setTimeout(() => {
            document.querySelectorAll('[id^="flash-"]').forEach(notification => {
                if (notification) {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 300);
                }
            });
        }, 5000);

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('user-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            const userButton = event.target.closest('button[onclick*="toggleUserMenu"]');
            const mobileButton = event.target.closest('button[onclick*="toggleMobileMenu"]');
            
            // Close user menu if clicking outside
            if (!userButton && userMenu && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
            
            // Close mobile menu if clicking outside
            if (!mobileButton && mobileMenu && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                // Reset hamburger animation
                const lines = document.querySelectorAll('.menu-line');
                lines[0].style.transform = 'none';
                lines[1].style.opacity = '1';
                lines[2].style.transform = 'none';
            }
        });

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize scroll animations
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
            
            // Add keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    // Close all menus on Escape
                    const userMenu = document.getElementById('user-menu');
                    const mobileMenu = document.getElementById('mobile-menu');
                    
                    if (userMenu && !userMenu.classList.contains('hidden')) {
                        userMenu.classList.add('hidden');
                    }
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        // Reset hamburger animation
                        const lines = document.querySelectorAll('.menu-line');
                        lines[0].style.transform = 'none';
                        lines[1].style.opacity = '1';
                        lines[2].style.transform = 'none';
                    }
                }
            });
            
            console.log('✅ Navigation initialized successfully');
        });

        console.log('🎨 Premium Addis Drive UI System Loaded');
    </script>
    
    <style>
        /* 🚗 PREMIUM NAVIGATION STYLES */
        
        /* Navigation Base Styles */
        #main-nav {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 9999 !important;
            width: 100% !important;
            height: auto !important;
        }
        
        /* Legacy Support */
        .nav-link {
            @apply text-slate-600 hover:text-neon-blue font-medium px-4 py-2 rounded-lg transition-all duration-200;
            @apply hover:bg-blue-light/50;
        }
        
        .nav-link.active {
            @apply text-neon-blue bg-blue-light font-semibold;
        }
        
        .mobile-nav-link {
            @apply block text-slate-600 hover:text-neon-blue font-medium py-3 px-4 rounded-lg transition-all duration-200;
            @apply hover:bg-blue-light;
        }
        
        .dropdown-item {
            @apply flex items-center space-x-3 px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 transition-colors duration-200;
        }
        
        .footer-link {
            @apply text-slate-400 hover:text-white transition-colors duration-200;
        }
    </style>
    
    <!-- 🤖 Smart Contact Chatbot (Global Feature) -->
    <div id="smart-chatbot" class="fixed bottom-6 right-6 z-50">
        <!-- Chatbot Toggle Button -->
        <button id="chatbot-toggle" 
                class="group relative w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 
                       hover:from-blue-600 hover:to-blue-700 
                       rounded-full shadow-lg hover:shadow-xl 
                       flex items-center justify-center 
                       transition-all duration-300 ease-out
                       hover:scale-110 active:scale-95
                       animate-float">
            
            <!-- Chat Icon -->
            <svg id="chat-icon" class="w-8 h-8 text-white transition-all duration-300" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            
            <!-- Close Icon (Hidden by default) -->
            <svg id="close-icon" class="w-8 h-8 text-white transition-all duration-300 hidden" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
            
            <!-- Notification Badge -->
            <div id="notification-badge" 
                 class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full 
                        flex items-center justify-center text-white text-xs font-bold
                        animate-pulse hidden">
                !
            </div>
            
            <!-- Pulse Animation -->
            <div class="absolute inset-0 rounded-full bg-blue-500 opacity-30 animate-ping"></div>
        </button>
        
        <!-- Chatbot Window -->
        <div id="chatbot-window" 
             class="absolute bottom-20 right-0 w-96 h-[500px] 
                    bg-white rounded-2xl shadow-2xl border border-gray-200
                    transform scale-0 opacity-0 origin-bottom-right
                    transition-all duration-300 ease-out hidden">
            
            <!-- Header -->
            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-500 to-blue-600 
                        text-white rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold">Smart Assist</h3>
                        <p class="text-sm opacity-90">{{ app()->getLocale() === 'am' ? 'እንዴት ልረዳዎት?' : 'How can I help you?' }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <!-- Online Status -->
                    <div class="flex items-center space-x-1">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-xs opacity-90">{{ app()->getLocale() === 'am' ? 'ኦንላይን' : 'Online' }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div id="chat-messages" 
                 class="flex-1 p-4 space-y-4 overflow-y-auto h-80 bg-gray-50">
                
                <!-- Welcome Message -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm max-w-xs">
                        <p class="text-sm text-gray-800">
                            {{ app()->getLocale() === 'am' ? 'ሰላም! እኔ የእርስዎ ስማርት አሲስታንት ነኝ። ስለ ተሽከርካሪ ኪራይ፣ ሽያጭ፣ ወይም ማንኛውም ጥያቄ ልረዳዎት እችላለሁ።' : 'Hello! I\'m your Smart Assistant. I can help you with vehicle rentals, sales, or any questions you have.' }}
                        </p>
                    </div>
                </div>
                
                <!-- Quick Action Buttons -->
                <div class="flex flex-wrap gap-2 px-2">
                    <button class="quick-action-btn" data-message="show me available cars">
                        {{ app()->getLocale() === 'am' ? 'መኪናዎች አሳይ' : 'Show Cars' }}
                    </button>
                    <button class="quick-action-btn" data-message="How do I rent a car?">
                        {{ app()->getLocale() === 'am' ? 'እንዴት እከራያለሁ?' : 'How to rent?' }}
                    </button>
                    <button class="quick-action-btn" data-message="What are your prices?">
                        {{ app()->getLocale() === 'am' ? 'ዋጋዎች' : 'Pricing' }}
                    </button>
                    <button class="quick-action-btn" data-message="How does KYC work?">
                        {{ app()->getLocale() === 'am' ? 'KYC' : 'KYC Process' }}
                    </button>
                    <button class="quick-action-btn" data-message="Contact support">
                        {{ app()->getLocale() === 'am' ? 'ድጋፍ' : 'Support' }}
                    </button>
                </div>
            </div>
            
            <!-- Typing Indicator -->
            <div id="typing-indicator" class="hidden px-4 py-2">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Input Area -->
            <div class="p-4 border-t border-gray-200 bg-white rounded-b-2xl">
                <div class="flex items-center space-x-2">
                    <input type="text" 
                           id="chat-input" 
                           placeholder="{{ app()->getLocale() === 'am' ? 'መልእክት ይጻፉ...' : 'Type your message...' }}"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-full 
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                  text-sm"
                           maxlength="500">
                    <button id="send-button" 
                            class="w-10 h-10 bg-blue-500 hover:bg-blue-600 rounded-full 
                                   flex items-center justify-center text-white
                                   transition-all duration-200 hover:scale-105 active:scale-95
                                   disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-2 text-center">
                    {{ app()->getLocale() === 'am' ? 'AI የተደገፈ - ፈጣን እና ትክክለኛ መልሶች' : 'AI-powered - Fast & accurate responses' }}
                </p>
            </div>
        </div>
    </div>
    
    <!-- Chatbot Styles -->
    <style>
        .quick-action-btn {
            @apply px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium;
            @apply hover:bg-blue-200 transition-all duration-200 cursor-pointer;
        }
        
        .user-message {
            @apply bg-blue-500 text-white rounded-lg p-3 max-w-xs ml-auto;
        }
        
        .bot-message {
            @apply bg-white text-gray-800 rounded-lg p-3 shadow-sm max-w-xs;
        }
        
        .message-container {
            @apply flex items-start space-x-3 animate-fade-in;
        }
        
        .user-message-container {
            @apply flex items-start space-x-3 justify-end animate-fade-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Custom scrollbar */
        #chat-messages::-webkit-scrollbar {
            width: 4px;
        }
        
        #chat-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }
        
        #chat-messages::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
        
        #chat-messages::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
    
    <!-- Chatbot JavaScript -->
    <script>
        // Chatbot Configuration
        const chatbotConfig = {
            isOpen: false,
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
            language: '{{ app()->getLocale() }}',
            predefinedAnswers: []
        };
        
        // DOM Elements
        const chatbotToggle = document.getElementById('chatbot-toggle');
        const chatbotWindow = document.getElementById('chatbot-window');
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');
        const sendButton = document.getElementById('send-button');
        const typingIndicator = document.getElementById('typing-indicator');
        const chatIcon = document.getElementById('chat-icon');
        const closeIcon = document.getElementById('close-icon');
        
        // Initialize Chatbot
        document.addEventListener('DOMContentLoaded', function() {
            initializeChatbot();
            loadPredefinedAnswers();
            setupEventListeners();
        });
        
        function initializeChatbot() {
            // Add welcome animation delay
            setTimeout(() => {
                const notificationBadge = document.getElementById('notification-badge');
                if (notificationBadge) {
                    notificationBadge.classList.remove('hidden');
                    setTimeout(() => {
                        notificationBadge.classList.add('hidden');
                    }, 5000);
                }
            }, 3000);
        }
        
        async function loadPredefinedAnswers() {
            try {
                const response = await fetch('/chatbot/predefined');
                if (response.ok) {
                    const data = await response.json();
                    chatbotConfig.predefinedAnswers = data.answers || [];
                }
            } catch (error) {
                console.log('Could not load predefined answers:', error);
            }
        }
        
        function setupEventListeners() {
            // Toggle chatbot
            chatbotToggle.addEventListener('click', toggleChatbot);
            
            // Send message on button click
            sendButton.addEventListener('click', sendMessage);
            
            // Send message on Enter key
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
            
            // Quick action buttons
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('quick-action-btn')) {
                    const message = e.target.getAttribute('data-message');
                    if (message) {
                        chatInput.value = message;
                        sendMessage();
                    }
                }
            });
            
            // Close chatbot when clicking outside
            document.addEventListener('click', function(e) {
                if (chatbotConfig.isOpen && 
                    !chatbotToggle.contains(e.target) && 
                    !chatbotWindow.contains(e.target)) {
                    closeChatbot();
                }
            });
            
            // Escape key to close
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && chatbotConfig.isOpen) {
                    closeChatbot();
                }
            });
        }
        
        function toggleChatbot() {
            if (chatbotConfig.isOpen) {
                closeChatbot();
            } else {
                openChatbot();
            }
        }
        
        function openChatbot() {
            chatbotConfig.isOpen = true;
            chatbotWindow.classList.remove('hidden');
            
            // Animation
            setTimeout(() => {
                chatbotWindow.style.transform = 'scale(1)';
                chatbotWindow.style.opacity = '1';
            }, 10);
            
            // Update button icon
            chatIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            
            // Focus input
            setTimeout(() => {
                chatInput.focus();
            }, 300);
            
            // Scroll to bottom
            scrollToBottom();
        }
        
        function closeChatbot() {
            chatbotConfig.isOpen = false;
            
            // Animation
            chatbotWindow.style.transform = 'scale(0)';
            chatbotWindow.style.opacity = '0';
            
            setTimeout(() => {
                chatbotWindow.classList.add('hidden');
            }, 300);
            
            // Update button icon
            closeIcon.classList.add('hidden');
            chatIcon.classList.remove('hidden');
        }
        
        async function sendMessage() {
            const message = chatInput.value.trim();
            if (!message) return;
            
            // Disable input
            chatInput.disabled = true;
            sendButton.disabled = true;
            
            // Add user message
            addUserMessage(message);
            
            // Clear input
            chatInput.value = '';
            
            // Show typing indicator
            showTypingIndicator();
            
            try {
                // Check for predefined answer first
                const predefinedAnswer = getPredefinedAnswer(message);
                
                if (predefinedAnswer) {
                    // Check if this is a car listings request
                    if (predefinedAnswer === 'car_listings_request') {
                        // Make API call to get car listings
                        const response = await fetch('/chatbot/ai', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': chatbotConfig.csrfToken
                            },
                            body: JSON.stringify({ message: message })
                        });
                        
                        const data = await response.json();
                        
                        hideTypingIndicator();
                        
                        if (response.ok) {
                            addBotMessage(data.reply);
                            
                            // Add quick action to visit rentals page
                            addQuickActions('rent');
                        } else {
                            addBotMessage(
                                chatbotConfig.language === 'am' 
                                    ? 'ይቅርታ፣ የመኪና ዝርዝር ማምጣት አልቻልኩም። እባክዎ የኪራይ ገጻችንን ይጎብኙ።'
                                    : 'I apologize, but I couldn\'t fetch the car listings right now. Please visit our Rentals page directly.'
                            );
                        }
                        
                        enableInput();
                    } else {
                        // Use regular predefined answer
                        setTimeout(() => {
                            hideTypingIndicator();
                            addBotMessage(predefinedAnswer);
                            enableInput();
                        }, 800); // Simulate thinking time
                    }
                } else {
                    // Use AI
                    const response = await fetch('/chatbot/ai', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': chatbotConfig.csrfToken
                        },
                        body: JSON.stringify({ message: message })
                    });
                    
                    const data = await response.json();
                    
                    hideTypingIndicator();
                    
                    if (response.ok) {
                        addBotMessage(data.reply);
                        
                        // Add quick actions based on response
                        addQuickActions(data.reply);
                    } else {
                        addBotMessage(
                            chatbotConfig.language === 'am' 
                                ? 'ይቅርታ፣ አሁን ችግር አለ። እባክዎ ድጋፍ ቡድናችንን ያግኙ።'
                                : 'I apologize, but I\'m having some technical difficulties. Please contact our support team for assistance.'
                        );
                    }
                    
                    enableInput();
                }
            } catch (error) {
                hideTypingIndicator();
                addBotMessage(
                    chatbotConfig.language === 'am' 
                        ? 'ይቅርታ፣ አሁን ችግር አለ። እባክዎ ድጋፍ ቡድናችንን ያግኙ።'
                        : 'I\'m sorry, I\'m experiencing some technical difficulties. Please contact our support team.'
                );
                enableInput();
            }
        }
        
        function getPredefinedAnswer(message) {
            const lowerMessage = message.toLowerCase();
            
            for (const item of chatbotConfig.predefinedAnswers) {
                for (const keyword of item.keywords) {
                    if (lowerMessage.includes(keyword.toLowerCase())) {
                        return item.reply;
                    }
                }
            }
            
            return null;
        }
        
        function addUserMessage(message) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'user-message-container';
            messageDiv.innerHTML = `
                <div class="user-message">
                    <p class="text-sm">${escapeHtml(message)}</p>
                </div>
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            `;
            
            chatMessages.appendChild(messageDiv);
            scrollToBottom();
        }
        
        function addBotMessage(message) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message-container';
            
            // Convert line breaks to HTML breaks for better formatting
            const formattedMessage = escapeHtml(message).replace(/\n/g, '<br>');
            
            messageDiv.innerHTML = `
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="bot-message">
                    <div class="text-sm" style="white-space: pre-line;">${formattedMessage}</div>
                </div>
            `;
            
            chatMessages.appendChild(messageDiv);
            scrollToBottom();
        }
        
        function addQuickActions(response) {
            const actions = [];
            
            if (response.toLowerCase().includes('rent')) {
                actions.push({ text: chatbotConfig.language === 'am' ? 'ኪራይ ገጽ' : 'Go to Rentals', url: '/rent' });
            }
            
            if (response.toLowerCase().includes('buy') || response.toLowerCase().includes('sale')) {
                actions.push({ text: chatbotConfig.language === 'am' ? 'ሽያጭ ገጽ' : 'View Sales', url: '/buy' });
            }
            
            if (response.toLowerCase().includes('contact') || response.toLowerCase().includes('support')) {
                actions.push({ text: chatbotConfig.language === 'am' ? 'ያግኙን' : 'Contact Us', url: '/contact' });
            }
            
            if (actions.length > 0) {
                const actionsDiv = document.createElement('div');
                actionsDiv.className = 'flex flex-wrap gap-2 px-2 mt-2';
                
                actions.forEach(action => {
                    const button = document.createElement('a');
                    button.href = action.url;
                    button.className = 'px-3 py-1 bg-blue-500 text-white rounded-full text-xs font-medium hover:bg-blue-600 transition-all duration-200';
                    button.textContent = action.text;
                    actionsDiv.appendChild(button);
                });
                
                chatMessages.appendChild(actionsDiv);
                scrollToBottom();
            }
        }
        
        function showTypingIndicator() {
            typingIndicator.classList.remove('hidden');
            scrollToBottom();
        }
        
        function hideTypingIndicator() {
            typingIndicator.classList.add('hidden');
        }
        
        function enableInput() {
            chatInput.disabled = false;
            sendButton.disabled = false;
            chatInput.focus();
        }
        
        function scrollToBottom() {
            setTimeout(() => {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 100);
        }
        
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>
    
    @stack('scripts')
</body>
</html>
