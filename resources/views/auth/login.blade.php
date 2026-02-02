@extends('layouts.app')

@section('title', 'Login - Addis Drive Vehicle Services')

@push('styles')
<style>
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        position: relative;
        overflow: hidden;
    }
    
    /* Cinematic Background Styles */
    .auth-hero-image {
        transition: transform 0.3s ease-out;
    }
    
    .auth-container:hover .auth-hero-image {
        transform: scale(1.08) !important;
    }
    
    .auth-card {
        width: 100%;
        max-width: 1000px;
        background: rgba(226, 232, 240, 0.15);
        backdrop-filter: blur(15px);
        border-radius: 24px;
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        overflow: hidden;
        display: flex;
        min-height: 600px;
        position: relative;
        z-index: 20;
        opacity: 0;
        transform: translateY(30px) scale(0.95);
        animation: cardEntrance 1s ease-out 0.3s forwards;
    }
    
    .brand-section {
        flex: 0 0 60%;
        background: rgba(226, 232, 240, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .brand-section::before {
        content: '';
        position: absolute;
        top: 20%;
        right: 20%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .brand-section::after {
        content: '';
        position: absolute;
        bottom: 10%;
        left: 10%;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite reverse;
    }
    
    .brand-content {
        text-align: center;
        position: relative;
        z-index: 2;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.8s ease-out 0.6s forwards;
    }
    
    .brand-title {
        font-size: 3rem;
        font-weight: 800;
        color: #F8FAFC;
        margin-bottom: 1rem;
        line-height: 1.1;
        letter-spacing: -0.02em;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6), 0 0 30px rgba(255, 255, 255, 0.1);
    }
    
    .brand-subtitle {
        font-size: 1.125rem;
        color: #F1F5F9;
        margin-bottom: 2rem;
        opacity: 0;
        animation: fadeIn 0.6s ease-out 1s forwards;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }
    
    .trust-features {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .trust-item {
        text-align: center;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.5s ease-out forwards;
    }
    
    .trust-item:nth-child(1) { animation-delay: 1.2s; }
    .trust-item:nth-child(2) { animation-delay: 1.4s; }
    .trust-item:nth-child(3) { animation-delay: 1.6s; }
    .trust-item:nth-child(4) { animation-delay: 1.8s; }
    
    .trust-icon {
        width: 3rem;
        height: 3rem;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        color: #2563EB;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: scale(1);
    }
    
    .trust-icon:hover {
        background: rgba(37, 99, 235, 0.15);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
    }
    
    .trust-text {
        font-size: 0.875rem;
        color: #F1F5F9;
        font-weight: 500;
        transition: color 0.3s ease;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
    }
    
    .trust-item:hover .trust-text {
        color: #93C5FD;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8), 0 0 10px rgba(147, 197, 253, 0.3);
    }
    
    .form-section {
        flex: 0 0 40%;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(25px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 2rem;
        border-left: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }
    
    .form-container {
        width: 100%;
        max-width: 350px;
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.6s ease-out 0.9s forwards;
    }
    
    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #F8FAFC;
        margin-bottom: 0.5rem;
        letter-spacing: -0.01em;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8), 0 0 20px rgba(255, 255, 255, 0.1);
    }
    
    .form-subtitle {
        color: #F1F5F9;
        font-size: 0.875rem;
        position: relative;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
        opacity: 0.9;
    }
    
    .form-subtitle::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #2563EB, transparent);
        animation: expandLine 0.8s ease-out 1.5s forwards;
    }
    
    .input-group {
        margin-bottom: 1.5rem;
        position: relative;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.4s ease-out forwards;
    }
    
    /* Ensure input groups with errors are immediately visible */
    .input-group:has(.error),
    .input-group.has-error {
        opacity: 1 !important;
        transform: translateY(0) !important;
        animation: none !important;
    }
    
    .input-group::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100%;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 8px;
        z-index: -1;
        transition: all 0.3s ease;
    }
    
    .input-group:hover::before {
        background: rgba(255, 255, 255, 0.05);
    }
    
    .input-group:nth-child(1) { animation-delay: 1.1s; }
    .input-group:nth-child(2) { animation-delay: 1.3s; }
    
    .form-input {
        width: 100%;
        padding: 1rem 1rem 0.5rem 0;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-bottom: 2px solid rgba(255, 255, 255, 0.4);
        border-radius: 8px;
        font-size: 1rem;
        color: #F8FAFC;
        outline: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    
    .form-input:focus {
        border-color: #60A5FA;
        border-bottom-color: #2563EB;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 4px 20px rgba(37, 99, 235, 0.4), 0 0 0 3px rgba(37, 99, 235, 0.1);
        transform: translateY(-1px);
    }
    
    .form-input::placeholder {
        color: rgba(248, 250, 252, 0.6);
        font-weight: 400;
    }
    
    .form-input.error {
        border-bottom-color: #EF4444;
        animation: shake 0.5s ease-in-out;
    }
    
    .form-label {
        position: absolute;
        left: 0;
        top: 1rem;
        color: #F1F5F9;
        font-size: 1rem;
        font-weight: 500;
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: left top;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
        opacity: 0.9;
    }
    
    .form-input:focus + .form-label,
    .form-input:not(:placeholder-shown) + .form-label {
        transform: translateY(-1.5rem) scale(0.875);
        color: #93C5FD;
        font-weight: 600;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.9), 0 0 10px rgba(147, 197, 253, 0.3);
    }
    
    .form-input.error + .form-label {
        color: #EF4444;
    }
    
    .error-message {
        color: #FECACA;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        opacity: 0;
        transform: translateY(-10px);
        animation: fadeInUp 0.3s ease-out forwards;
        background: rgba(239, 68, 68, 0.2);
        padding: 0.5rem;
        border-radius: 0.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(239, 68, 68, 0.4);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
    }
    
    .remember-section {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        opacity: 0;
        animation: fadeIn 0.4s ease-out 1.5s forwards;
    }
    
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .custom-checkbox {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 0.375rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        cursor: pointer;
        position: relative;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    
    .custom-checkbox:checked {
        background: #2563EB;
        border-color: #2563EB;
        transform: scale(1.1);
    }
    
    .custom-checkbox:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        color: white;
        font-size: 0.75rem;
        font-weight: bold;
        animation: checkmark 0.3s ease-out 0.1s forwards;
    }
    
    .checkbox-label {
        color: #F1F5F9;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: color 0.3s ease;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
        opacity: 0.9;
    }
    
    .custom-checkbox:checked + .checkbox-label {
        color: #93C5FD;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.9), 0 0 10px rgba(147, 197, 253, 0.3);
    }
    
    .btn-login {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #2563EB 0%, #1E40AF 100%);
        color: white;
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.4s ease-out 1.7s forwards;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }
    
    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-login:hover {
        background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(37, 99, 235, 0.6);
    }
    
    .btn-login:hover::before {
        left: 100%;
    }
    
    .btn-login:active {
        transform: translateY(0);
    }
    
    .btn-login.loading {
        pointer-events: none;
    }
    
    .btn-login.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    
    .auth-link {
        display: block;
        text-align: center;
        color: #FED7AA;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        opacity: 0;
        animation: fadeIn 0.4s ease-out 1.9s forwards;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8), 0 0 10px rgba(253, 215, 170, 0.2);
    }
    
    .auth-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 1px;
        background: #EA580C;
        transition: width 0.3s ease;
    }
    
    .auth-link:hover {
        color: #FBBF24;
        transform: translateY(-1px);
        text-shadow: 0 2px 8px rgba(251, 191, 36, 0.6), 0 0 20px rgba(251, 191, 36, 0.3);
    }
    
    .auth-link:hover::after {
        width: 100%;
    }
    
    /* Keyframe Animations */
    @keyframes cardEntrance {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes expandLine {
        from { width: 0; }
        to { width: 2rem; }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    @keyframes checkmark {
        from { transform: translate(-50%, -50%) scale(0); }
        to { transform: translate(-50%, -50%) scale(1); }
    }
    
    @keyframes spin {
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    @media (max-width: 768px) {
        .auth-card {
            flex-direction: column;
            min-height: auto;
            margin: 1rem;
        }
        
        .brand-section {
            flex: 0 0 40%;
            min-height: 250px;
            padding: 2rem;
        }
        
        .brand-title {
            font-size: 2rem;
        }
        
        .trust-features {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .form-section {
            flex: 1;
            padding: 2rem 1.5rem;
            border-left: none;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(0, 0, 0, 0.8);
        }
        
        .form-title {
            font-size: 1.5rem;
        }
        
        .floating-orb {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <!-- Background Image Only -->
    <div class="absolute inset-0">
        <!-- High-resolution luxury car image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat auth-hero-image" 
             style="background-image: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); 
                    background-position: center center; 
                    transform: scale(1.05);">
        </div>
    </div>
    
    <div class="auth-card">
        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-content">
                <h1 class="brand-title">
                    @if(app()->getLocale() === 'am')
                        ደህንነት።<br>
                        ፍጥነት።<br>
                        <span style="color: #2563EB;">እምነት።</span>
                    @else
                        Secure.<br>
                        Fast.<br>
                        <span style="color: #2563EB;">Trusted.</span>
                    @endif
                </h1>
                <p class="brand-subtitle">
                    @if(app()->getLocale() === 'am')
                        የተረጋገጠ የተሽከርካሪ አገልግሎት ለደህንነት የተገነባ።
                    @else
                        Secure access to verified mobility services.
                    @endif
                </p>
                
                <div class="trust-features">
                    <div class="trust-item">
                        <div class="trust-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div class="trust-text">
                            @if(app()->getLocale() === 'am')
                                የተጠበቀ
                            @else
                                Verified
                            @endif
                        </div>
                    </div>
                    
                    <div class="trust-item">
                        <div class="trust-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="trust-text">
                            @if(app()->getLocale() === 'am')
                                ፈጣን
                            @else
                                Instant
                            @endif
                        </div>
                    </div>
                    
                    <div class="trust-item">
                        <div class="trust-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div class="trust-text">
                            @if(app()->getLocale() === 'am')
                                ደህንነት
                            @else
                                Secure
                            @endif
                        </div>
                    </div>
                    
                    <div class="trust-item">
                        <div class="trust-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="trust-text">
                            @if(app()->getLocale() === 'am')
                                ክፍያ
                            @else
                                Payment
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Section -->
        <div class="form-section">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="form-title">
                        @if(app()->getLocale() === 'am')
                            እንኳን ደህና መጡ
                        @else
                            Welcome back
                        @endif
                    </h2>
                    <p class="form-subtitle">
                        @if(app()->getLocale() === 'am')
                            ወደ መለያዎ ይግቡ
                        @else
                            Sign in to continue your journey
                        @endif
                    </p>
                </div>
                
                <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
                    @csrf
                    
                    <div class="input-group">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input @error('email') error @enderror" 
                            placeholder=" "
                            required
                            autocomplete="email"
                        >
                        <!-- <label for="email" class="form-label">
                            @if(app()->getLocale() === 'am')
                                ኢሜይል አድራሻ
                            @else
                                Email address
                            @endif
                        </label> -->
                        @error('email')
                            <div class="error-message">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="input-group">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input @error('password') error @enderror" 
                            placeholder=" "
                            required
                            autocomplete="current-password"
                        >
                        <!-- <label for="password" class="form-label">
                            @if(app()->getLocale() === 'am')
                                የይለፍ ቃል
                            @else
                                Password
                            @endif
                        </label> -->
                        @error('password')
                            <div class="error-message">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="remember-section">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="remember" name="remember" class="custom-checkbox">
                            <label for="remember" class="checkbox-label">
                                @if(app()->getLocale() === 'am')
                                    አስታውሰኝ
                                @else
                                    Remember me
                                @endif
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-login" id="loginBtn">
                        @if(app()->getLocale() === 'am')
                            ግባ
                        @else
                            Sign in
                        @endif
                    </button>
                </form>
                
                <a href="{{ route('register') }}" class="auth-link">
                    @if(app()->getLocale() === 'am')
                        አዲስ መለያ ይፍጠሩ
                    @else
                        Create new account
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const inputs = document.querySelectorAll('.form-input');
    
    // Fix error input visibility immediately
    function ensureErrorInputsVisible() {
        const errorInputs = document.querySelectorAll('.form-input.error');
        errorInputs.forEach(input => {
            const inputGroup = input.closest('.input-group');
            if (inputGroup) {
                inputGroup.classList.add('has-error');
                inputGroup.style.opacity = '1';
                inputGroup.style.transform = 'translateY(0)';
                inputGroup.style.animation = 'none';
            }
        });
        
        // Also ensure all input groups are visible after a short delay
        setTimeout(() => {
            const allInputGroups = document.querySelectorAll('.input-group');
            allInputGroups.forEach(group => {
                if (group.style.opacity === '0' || window.getComputedStyle(group).opacity === '0') {
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }
            });
        }, 1000);
    }
    
    // Call immediately
    ensureErrorInputsVisible();
    
    // Form submission with enhanced loading state
    form.addEventListener('submit', function(e) {
        loginBtn.classList.add('loading');
        loginBtn.disabled = true;
        loginBtn.style.opacity = '0.8';
        
        // Add ripple effect
        const ripple = document.createElement('div');
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;
        
        const rect = loginBtn.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (rect.width / 2 - size / 2) + 'px';
        ripple.style.top = (rect.height / 2 - size / 2) + 'px';
        
        loginBtn.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    });
    
    // Enhanced input interactions
    inputs.forEach((input, index) => {
        // Focus animations
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
            this.parentElement.style.transition = 'transform 0.3s ease';
            this.style.boxShadow = '0 8px 25px rgba(37, 99, 235, 0.3)';
            this.style.background = 'rgba(255, 255, 255, 0.1)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
            if (!this.value) {
                this.style.background = 'rgba(255, 255, 255, 0.05)';
            }
        });
        
        // Typing animation
        input.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.style.borderBottomWidth = '3px';
            } else {
                this.style.borderBottomWidth = '2px';
            }
        });
        
        // Error shake animation
        if (input.classList.contains('error')) {
            setTimeout(() => {
                input.parentElement.style.animation = 'shake 0.5s ease-in-out';
            }, (index + 1) * 200);
        }
    });
    
    // Checkbox animation enhancement
    const checkbox = document.querySelector('.custom-checkbox');
    if (checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            }
        });
    }
    
    // Parallax effect for hero background
    window.addEventListener('scroll', function() {
        const heroImage = document.querySelector('.auth-hero-image');
        if (heroImage) {
            const scrolled = window.pageYOffset;
            heroImage.style.transform = `scale(1.05) translateY(${scrolled * 0.3}px)`;
        }
    });
    
    // Trust icons hover effects
    const trustIcons = document.querySelectorAll('.trust-icon');
    trustIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.animation = 'none';
            this.style.transform = 'translateY(-3px) scale(1.05) rotate(5deg)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1) rotate(0deg)';
        });
    });
    
    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    console.log('🔐 Premium Animated Login System Loaded');
});
</script>
@endpush
