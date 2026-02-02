@extends('layouts.app')

@section('title', 'Admin Dashboard - Premium Vehicle Management System')

@section('content')
<!-- 🎯 ULTRA-MODERN ADMIN DASHBOARD -->
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/20 relative overflow-hidden">
    <!-- Enhanced Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Floating Orbs -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/20 to-purple-600/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-indigo-400/20 to-cyan-600/20 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-purple-400/10 to-pink-600/10 rounded-full blur-2xl animate-pulse-slow"></div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        
        <!-- Animated Particles -->
        <div class="absolute top-20 left-20 w-2 h-2 bg-blue-400/30 rounded-full animate-ping" style="animation-delay: 1s;"></div>
        <div class="absolute top-40 right-32 w-1 h-1 bg-purple-400/40 rounded-full animate-ping" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-32 left-1/3 w-1.5 h-1.5 bg-indigo-400/35 rounded-full animate-ping" style="animation-delay: 3s;"></div>
    </div>

    <div class="relative z-10 max-w-8xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- 🎨 Ultra-Premium Page Header -->
        <div class="mb-12 transform animate-slide-down">
            <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-3xl p-8 shadow-2xl hover:shadow-3xl transition-all duration-500">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-6 mb-6">
                            <!-- Animated Admin Avatar -->
                            <div class="relative">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-xl animate-glow-admin">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <!-- Status Indicator -->
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-3 border-white animate-pulse-gentle">
                                    <div class="w-full h-full bg-green-400 rounded-full animate-ping"></div>
                                </div>
                            </div>
                            
                            <div>
                                <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent animate-gradient leading-tight">
                                    Admin Command Center
                                </h1>
                                <p class="text-xl text-gray-600 mt-2 animate-fade-in-up" style="animation-delay: 0.2s;">
                                    Advanced Vehicle Management & Analytics Hub
                                </p>
                                <div class="flex items-center space-x-4 mt-3">
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                        <span>System Online</span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Last updated: <span id="current-time" class="font-medium"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Enhanced Action Buttons -->
                    <div class="mt-6 lg:mt-0 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('admin.reports') }}" class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Analytics Report
                            <div class="absolute inset-0 bg-white/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        
                        <button onclick="refreshDashboard()" class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Refresh Data
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📊 Ultra-Premium Statistics Grid with Enhanced Animations -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Users Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.1s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <!-- Animated Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-blue">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['total_users'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Total Users</div>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['total_users'] / 100) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">Registered members</p>
                    </div>
                </div>
            </div>

            <!-- Total Vehicles Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.2s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-emerald-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-green">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['total_vehicles'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Fleet Vehicles</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['total_vehicles'] / 100) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">Available inventory</p>
                    </div>
                </div>
            </div>

            <!-- Total Bookings Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.3s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-purple">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['total_bookings'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Total Bookings</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['total_bookings'] / 50) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">All-time reservations</p>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.4s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-red-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-orange">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ intval($stats['monthly_revenue']) }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Monthly Revenue</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['monthly_revenue'] / 10000) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">This month's earnings</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🎯 Enhanced Status Cards with Modern Design -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Pending KYC Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.5s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/10 to-amber-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-yellow">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['pending_kyc'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Pending KYC</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['pending_kyc'] / 10) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">Awaiting verification</p>
                    </div>
                </div>
            </div>

            <!-- Active Rentals Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.6s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-emerald">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['verified_kyc'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Verified Users</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['verified_kyc'] / 20) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">KYC approved</p>
                    </div>
                </div>
            </div>

            <!-- Messages Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.7s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/10 to-pink-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-red">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['rejected_kyc'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Support Messages</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['rejected_kyc'] / 5) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">Customer inquiries</p>
                    </div>
                </div>
            </div>

            <!-- Active Bookings Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.8s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg animate-glow-indigo">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['active_bookings'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Active Bookings</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 h-2 rounded-full animate-progress-bar" style="width: {{ min(($stats['active_bookings'] / 10) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500">Currently rented</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 💰 Enhanced Discount Statistics with Modern Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
            <!-- Active Discounts Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 0.9s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg animate-glow-cyan">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-4xl font-bold text-gray-800 counter animate-count-up" data-target="{{ $stats['active_discounts'] }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Active Discounts</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-3">
                            <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 h-3 rounded-full animate-progress-bar" style="width: {{ min(($stats['active_discounts'] / 10) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-sm text-gray-500">Currently available promotions</p>
                    </div>
                </div>
            </div>

            <!-- Total Discount Given Card -->
            <div class="group transform animate-slide-up hover:scale-105 transition-all duration-500" style="animation-delay: 1.0s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-500/10 to-green-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg animate-glow-teal">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-4xl font-bold text-gray-800 counter animate-count-up" data-target="{{ intval($stats['total_discount_given']) }}">0</div>
                                <div class="text-sm text-gray-600 font-medium">Total Savings</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-3">
                            <div class="bg-gradient-to-r from-teal-500 to-teal-600 h-3 rounded-full animate-progress-bar" style="width: {{ min(($stats['total_discount_given'] / 5000) * 100, 100) }}%"></div>
                        </div>
                        <p class="text-sm text-gray-500">Customer discount benefits</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📊 Ultra-Modern Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Recent Bookings -->
            <div class="transform animate-slide-left" style="animation-delay: 1.1s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300">
                    <!-- Enhanced Header -->
                    <div class="bg-gradient-to-r from-blue-500/10 to-purple-600/10 px-6 py-4 border-b border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-3 animate-glow-blue">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                Recent Bookings
                            </h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full animate-pulse">{{ $recentBookings->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if($recentBookings->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentBookings as $index => $booking)
                                    <div class="group flex items-center justify-between p-4 bg-white/60 backdrop-blur-sm border border-white/40 rounded-xl hover:bg-white/80 transition-all duration-300 transform hover:scale-[1.02] animate-fade-in-up" style="animation-delay: {{ 1.2 + ($index * 0.1) }}s;">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative flex-shrink-0">
                                                @if($booking->vehicle->primary_image)
                                                    <img class="h-16 w-16 rounded-xl object-cover shadow-lg group-hover:shadow-xl transition-shadow duration-300" src="{{ $booking->vehicle->primary_image }}" alt="{{ $booking->vehicle->full_name }}">
                                                @else
                                                    <div class="h-16 w-16 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-lg">
                                                        <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">{{ $booking->vehicle->full_name }}</p>
                                                <p class="text-xs text-gray-600 font-medium">{{ $booking->user->name }} • {{ $booking->booking_reference }}</p>
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
                                            <p class="text-lg font-bold text-gray-900 mt-2">${{ number_format($booking->total_amount) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    View All Bookings
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">No recent bookings</p>
                                <p class="text-sm text-gray-400 mt-2">New bookings will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent KYC Verifications -->
            <div class="transform animate-slide-up" style="animation-delay: 1.2s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-purple-500/10 to-pink-600/10 px-6 py-4 border-b border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-3 animate-glow-purple">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                KYC Verifications
                            </h3>
                            <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full animate-pulse">{{ $recentKyc->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if($recentKyc->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentKyc as $index => $kyc)
                                    <div class="group flex items-center justify-between p-4 bg-white/60 backdrop-blur-sm border border-white/40 rounded-xl hover:bg-white/80 transition-all duration-300 transform hover:scale-[1.02] animate-fade-in-up" style="animation-delay: {{ 1.3 + ($index * 0.1) }}s;">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative flex-shrink-0">
                                                <div class="h-16 w-16 rounded-xl bg-gradient-to-br from-purple-200 to-purple-300 flex items-center justify-center shadow-lg">
                                                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-500 rounded-full border-2 border-white animate-pulse"></div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">{{ $kyc->user->name }}</p>
                                                <p class="text-xs text-gray-600 font-medium">{{ $kyc->getDocumentTypeLabel() }} • {{ $kyc->document_number }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $kyc->created_at->diffForHumans() }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $kyc->getStatusBadgeClass() }}">
                                                {{ ucfirst(str_replace('_', ' ', $kyc->status)) }}
                                            </span>
                                            @if($kyc->isPending())
                                                <p class="text-xs text-orange-600 mt-2 font-medium">Needs Review</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('admin.kyc.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    View All KYC
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">No recent KYC verifications</p>
                                <p class="text-sm text-gray-400 mt-2">New submissions will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="transform animate-slide-right" style="animation-delay: 1.3s;">
                <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-green-500/10 to-emerald-600/10 px-6 py-4 border-b border-white/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-3 animate-glow-green">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Pending Payments
                            </h3>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full animate-pulse">{{ $pendingPayments->count() }}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if($pendingPayments->count() > 0)
                            <div class="space-y-4">
                                @foreach($pendingPayments->take(5) as $index => $payment)
                                    <div class="group flex items-center justify-between p-4 bg-white/60 backdrop-blur-sm border border-white/40 rounded-xl hover:bg-white/80 transition-all duration-300 transform hover:scale-[1.02] animate-fade-in-up" style="animation-delay: {{ 1.4 + ($index * 0.1) }}s;">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative flex-shrink-0">
                                                <div class="h-16 w-16 rounded-xl bg-gradient-to-br from-green-200 to-green-300 flex items-center justify-center shadow-lg">
                                                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-orange-500 rounded-full border-2 border-white animate-pulse"></div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-300">{{ $payment->user->name }}</p>
                                                <p class="text-xs text-gray-600 font-medium">{{ $payment->payment_reference }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $payment->created_at->diffForHumans() }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                                @if($payment->status === 'submitted') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800
                                                @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                            <p class="text-lg font-bold text-gray-900 mt-2">${{ number_format($payment->amount) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    View All Payments
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">No pending payments</p>
                                <p class="text-sm text-gray-400 mt-2">Payment verifications will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- 🚀 Ultra-Modern Quick Actions Section -->
        <div class="transform animate-fade-in-up" style="animation-delay: 1.4s;">
            <div class="backdrop-blur-xl bg-white/40 border border-white/20 rounded-3xl p-8 shadow-2xl hover:shadow-3xl transition-all duration-500">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent">Quick Actions</h3>
                        <p class="text-gray-600 mt-1">Manage your system efficiently</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center animate-glow-indigo">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
                    <!-- Add Vehicle -->
                    <a href="{{ route('admin.vehicles.create') }}" class="group relative backdrop-blur-sm bg-white/60 border border-white/40 p-6 rounded-2xl text-center hover:bg-white/80 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg animate-glow-blue">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-blue-600 group-hover:text-blue-700">Add Vehicle</p>
                            <p class="text-xs text-gray-500 mt-1">New inventory</p>
                        </div>
                    </a>
                    
                    <!-- Manage Users -->
                    <a href="{{ route('admin.users.index') }}" class="group relative backdrop-blur-sm bg-white/60 border border-white/40 p-6 rounded-2xl text-center hover:bg-white/80 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-green-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg animate-glow-green">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-green-600 group-hover:text-green-700">Manage Users</p>
                            <p class="text-xs text-gray-500 mt-1">User accounts</p>
                        </div>
                    </a>
                    
                    <!-- Manage Discounts -->
                    <a href="{{ route('admin.discounts.index') }}" class="group relative backdrop-blur-sm bg-white/60 border border-white/40 p-6 rounded-2xl text-center hover:bg-white/80 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg animate-glow-indigo">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-indigo-600 group-hover:text-indigo-700">Discounts</p>
                            <p class="text-xs text-gray-500 mt-1">Promotions</p>
                        </div>
                    </a>
                    
                    <!-- KYC Verifications -->
                    <a href="{{ route('admin.kyc.index') }}" class="group relative backdrop-blur-sm bg-white/60 border border-white/40 p-6 rounded-2xl text-center hover:bg-white/80 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-orange-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg animate-glow-orange">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-orange-600 group-hover:text-orange-700">KYC Review</p>
                            <p class="text-xs text-gray-500 mt-1">Verifications</p>
                        </div>
                    </a>
                    
                    <!-- Verify Payments -->
                    <a href="{{ route('admin.payments.index') }}" class="group relative backdrop-blur-sm bg-white/60 border border-white/40 p-6 rounded-2xl text-center hover:bg-white/80 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/10 to-yellow-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg animate-glow-yellow">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-yellow-600 group-hover:text-yellow-700">Payments</p>
                            <p class="text-xs text-gray-500 mt-1">Verification</p>
                        </div>
                    </a>
                    
                    <!-- Messages -->
                    <a href="{{ route('admin.messages.index') }}" class="group relative backdrop-blur-sm bg-white/60 border border-white/40 p-6 rounded-2xl text-center hover:bg-white/80 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg animate-glow-purple">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-purple-600 group-hover:text-purple-700">Messages</p>
                            <p class="text-xs text-gray-500 mt-1">Support</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@vite(['resources/js/app.js'])
<script>
// Enhanced Admin Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize time display
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
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
    
    // Refresh dashboard function
    window.refreshDashboard = function() {
        // Add loading state
        const refreshBtn = event.target.closest('button');
        const originalText = refreshBtn.innerHTML;
        refreshBtn.innerHTML = `
            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Refreshing...
        `;
        refreshBtn.disabled = true;
        
        // Simulate refresh (in real app, this would reload data)
        setTimeout(() => {
            location.reload();
        }, 1000);
    };
    
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
});
</script>
@endpush

@push('styles')
<style>
/* Enhanced Admin Dashboard Styles */

/* Grid Pattern Background */
.bg-grid-pattern {
    background-image: 
        linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}

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
@keyframes glow-admin {
    0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5), 0 0 40px rgba(147, 51, 234, 0.3); }
    50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.8), 0 0 60px rgba(147, 51, 234, 0.5); }
}

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

@keyframes glow-yellow {
    0%, 100% { box-shadow: 0 0 20px rgba(234, 179, 8, 0.5); }
    50% { box-shadow: 0 0 30px rgba(234, 179, 8, 0.8); }
}

@keyframes glow-emerald {
    0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.5); }
    50% { box-shadow: 0 0 30px rgba(16, 185, 129, 0.8); }
}

@keyframes glow-red {
    0%, 100% { box-shadow: 0 0 20px rgba(239, 68, 68, 0.5); }
    50% { box-shadow: 0 0 30px rgba(239, 68, 68, 0.8); }
}

@keyframes glow-indigo {
    0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.5); }
    50% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.8); }
}

@keyframes glow-cyan {
    0%, 100% { box-shadow: 0 0 20px rgba(6, 182, 212, 0.5); }
    50% { box-shadow: 0 0 30px rgba(6, 182, 212, 0.8); }
}

@keyframes glow-teal {
    0%, 100% { box-shadow: 0 0 20px rgba(20, 184, 166, 0.5); }
    50% { box-shadow: 0 0 30px rgba(20, 184, 166, 0.8); }
}

.animate-glow-admin { animation: glow-admin 2s ease-in-out infinite; }
.animate-glow-blue { animation: glow-blue 2s ease-in-out infinite; }
.animate-glow-green { animation: glow-green 2s ease-in-out infinite; }
.animate-glow-purple { animation: glow-purple 2s ease-in-out infinite; }
.animate-glow-orange { animation: glow-orange 2s ease-in-out infinite; }
.animate-glow-yellow { animation: glow-yellow 2s ease-in-out infinite; }
.animate-glow-emerald { animation: glow-emerald 2s ease-in-out infinite; }
.animate-glow-red { animation: glow-red 2s ease-in-out infinite; }
.animate-glow-indigo { animation: glow-indigo 2s ease-in-out infinite; }
.animate-glow-cyan { animation: glow-cyan 2s ease-in-out infinite; }
.animate-glow-teal { animation: glow-teal 2s ease-in-out infinite; }

/* Enhanced Slide Animations */
@keyframes slide-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-down {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-left {
    from { opacity: 0; transform: translateX(-30px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slide-right {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-slide-up { animation: slide-up 0.6s ease-out forwards; }
.animate-slide-down { animation: slide-down 0.5s ease-out forwards; }
.animate-slide-left { animation: slide-left 0.6s ease-out forwards; }
.animate-slide-right { animation: slide-right 0.6s ease-out forwards; }
.animate-fade-in-up { animation: fade-in-up 0.5s ease-out forwards; }

/* Floating Animation */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-delayed { animation: float-delayed 8s ease-in-out infinite; animation-delay: 2s; }

/* Pulse Animation */
@keyframes pulse-slow {
    0%, 100% { opacity: 0.8; }
    50% { opacity: 0.4; }
}

@keyframes pulse-gentle {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.animate-pulse-slow { animation: pulse-slow 4s ease-in-out infinite; }
.animate-pulse-gentle { animation: pulse-gentle 2s ease-in-out infinite; }

/* Gradient Animation */
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

/* Count Up Animation */
@keyframes count-up {
    from { opacity: 0; transform: scale(0.5); }
    to { opacity: 1; transform: scale(1); }
}

.animate-count-up { animation: count-up 0.5s ease-out; }

/* Progress Bar Animation */
.animate-progress-bar {
    transition: width 1.5s ease-out;
    transform-origin: left;
}

/* Enhanced Card Hover Effects */
.group:hover .animate-glow-blue,
.group:hover .animate-glow-green,
.group:hover .animate-glow-purple,
.group:hover .animate-glow-orange,
.group:hover .animate-glow-yellow,
.group:hover .animate-glow-emerald,
.group:hover .animate-glow-red,
.group:hover .animate-glow-indigo,
.group:hover .animate-glow-cyan,
.group:hover .animate-glow-teal {
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

/* Enhanced Shadow Effects */
.shadow-3xl {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}
</style>
@endpush
@endsection
