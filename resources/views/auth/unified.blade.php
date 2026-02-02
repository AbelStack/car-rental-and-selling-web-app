@extends('layouts.app')

@section('title', 'Authentication - Car Rental & Sales System')

@push('styles')
<style>
    /* Unified Auth Container */
    .unified-auth-container {
        min-height: 100vh;
        background: #F8FAFC;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Animated Background Elements */
    .bg-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(40px);
        opacity: 0.6;
        animation: float 8s ease-in-out infinite;
    }
    
    .bg-orb-1 {
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
        top: 10%;
        right: 15%;
        animation-delay: 0s;
    }
    
    .bg-orb-2 {
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(253, 186, 116, 0.12) 0%, transparent 70%);
        bottom: 15%;
        left: 10%;
        animation-delay: 2s;
    }
    
    .bg-orb-3 {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
        top: 50%;
        left: 5%;
        animation-delay: 4s;
    }
    
    /* Floating particles */
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(37, 99, 235, 0.3);
        border-radius: 50%;
        animation: floatParticle 12s linear infinite;
    }
    
    .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
    .particle:nth-child(2) { left: 20%; animation-delay: 2s; }
    .particle:nth-child(3) { left: 30%; animation-delay: 4s; }
    .particle:nth-child(4) { left: 40%; animation-delay: 6s; }
    .particle:nth-child(5) { left: 50%; animation-delay: 8s; }
    .particle:nth-child(6) { left: 60%; animation-delay: 10s; }
    .particle:nth-child(7) { left: 70%; animation-delay: 1s; }
    .particle:nth-child(8) { left: 80%; animation-delay: 3s; }
    .particle:nth-child(9) { left: 90%; animation-delay: 5s; }
    .particle:nth-child(10) { left: 95%; animation-delay: 7s; }
    
    /* Main Auth Card */
    .auth-card {
        width: 100%;
        max-width: 1200px;
        height: 700px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.5);
        position: relative;
        overflow: hidden;
        margin: 2rem;
    }
    
    /* Sliding Panels Container */
    .panels-container {
        position: relative;
        width: 200%;
        height: 100%;
        display: flex;
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: transform;
    }
    
    .panels-container.show-register {
        transform: translateX(-50%);
    }
    
    /* Panel transition effects */
    .panels-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 2px;
        height: 100%;
        background: linear-gradient(to bottom, transparent, rgba(37, 99, 235, 0.2), transparent);
        z-index: 10;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .panels-container.transitioning::before {
        opacity: 1;
    }
    
    /* Individual Panels */
    .auth-panel {
        width: 50%;
        height: 100%;
        display: flex;
        position: relative;
    }
    
    /* Brand Zone (Left side of each panel) */
    .brand-zone {
        flex: 0 0 60%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #F8FAFC 0%, rgba(37, 99, 235, 0.02) 100%);
        overflow: hidden;
    }
    
    .brand-zone::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.05) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    .brand-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 400px;
        padding: 2rem;
        opacity: 0;
        transform: translateY(30px);
        animation: slideInUp 0.8s ease-out 0.3s forwards;
    }
    
    .brand-headline {
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 800;
        line-height: 1.1;
        color: #0F172A;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }
    
    .brand-subtitle {
        font-size: 1.125rem;
        color: #64748B;
        font-weight: 400;
        line-height: 1.6;
        margin-bottom: 2rem;
    }
    
    .trust-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .trust-item {
        text-align: center;
        opacity: 0;
        animation: fadeInScale 0.6s ease-out forwards;
    }
    
    .trust-item:nth-child(1) { animation-delay: 0.6s; }
    .trust-item:nth-child(2) { animation-delay: 0.8s; }
    .trust-item:nth-child(3) { animation-delay: 1.0s; }
    .trust-item:nth-child(4) { animation-delay: 1.2s; }
    
    .trust-icon {
        width: 3rem;
        height: 3rem;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        color: #2563EB;
        transition: all 0.3s ease;
    }
    
    .trust-icon:hover {
        background: rgba(37, 99, 235, 0.15);
        transform: translateY(-2px);
        animation: breathe 2s ease-in-out infinite;
    }
    
    .trust-text {
        font-size: 0.875rem;
        color: #64748B;
        font-weight: 500;
    }
    
    /* Form Zone (Right side of each panel) */
    .form-zone {
        flex: 0 0 40%;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-left: 1px solid rgba(226, 232, 240, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .form-container {
        width: 100%;
        max-width: 350px;
        padding: 2rem;
    }
    
    /* Form Headers */
    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.6s ease-out 0.5s forwards;
    }
    
    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 0.5rem;
        letter-spacing: -0.01em;
    }
    
    .form-subtitle {
        color: #64748B;
        font-size: 0.875rem;
        font-weight: 400;
        position: relative;
    }
    
    .form-subtitle::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 50%;
        transform: translateX(-50%);
        width: 2rem;
        height: 2px;
        background: linear-gradient(90deg, transparent, #2563EB, transparent);
        animation: slideIn 0.8s ease-out 0.8s both;
    }
    
    .register-panel .form-subtitle::after {
        background: linear-gradient(90deg, transparent, #FDBA74, transparent);
    }
    
    /* Progressive Step Indicator (Register Only) */
    .step-indicator {
        margin-bottom: 1.5rem;
        opacity: 0;
        animation: fadeIn 0.6s ease-out 0.7s forwards;
    }
    
    .step-progress {
        width: 100%;
        height: 3px;
        background: #E2E8F0;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }
    
    .step-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #FDBA74, #FED7AA);
        border-radius: 2px;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        width: 33.33%;
    }
    
    .step-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.625rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .step-label {
        color: #94A3B8;
        transition: color 0.3s ease;
    }
    
    .step-label.active {
        color: #FDBA74;
    }
    
    .step-label.completed {
        color: #10B981;
    }
    
    /* Floating Input System */
    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
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
    
    .input-group:nth-child(1) { animation-delay: 0.9s; }
    .input-group:nth-child(2) { animation-delay: 1.0s; }
    .input-group:nth-child(3) { animation-delay: 1.1s; }
    .input-group:nth-child(4) { animation-delay: 1.2s; }
    .input-group:nth-child(5) { animation-delay: 1.3s; }
    
    .floating-input, .floating-select {
        width: 100%;
        padding: 1rem 0 0.5rem 0;
        background: transparent;
        border: none;
        border-bottom: 2px solid #E2E8F0;
        font-size: 1rem;
        color: #0F172A;
        outline: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .floating-input:focus, .floating-select:focus {
        border-bottom-color: #2563EB;
        box-shadow: 0 2px 0 0 rgba(37, 99, 235, 0.1);
    }
    
    .register-panel .floating-input:focus,
    .register-panel .floating-select:focus {
        border-bottom-color: #FDBA74;
        box-shadow: 0 2px 0 0 rgba(253, 186, 116, 0.1);
    }
    
    .floating-input.error, .floating-select.error {
        border-bottom-color: #EF4444;
        box-shadow: 0 2px 0 0 rgba(239, 68, 68, 0.1);
    }
    
    .floating-label {
        position: absolute;
        left: 0;
        top: 1rem;
        color: #94A3B8;
        font-size: 1rem;
        font-weight: 400;
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: left top;
    }
    
    .floating-input:focus + .floating-label,
    .floating-input:not(:placeholder-shown) + .floating-label,
    .floating-select:focus + .floating-label,
    .floating-select:not([value=""]) + .floating-label {
        transform: translateY(-1.5rem) scale(0.875);
        color: #2563EB;
        font-weight: 500;
    }
    
    .register-panel .floating-input:focus + .floating-label,
    .register-panel .floating-input:not(:placeholder-shown) + .floating-label,
    .register-panel .floating-select:focus + .floating-label {
        color: #FDBA74;
    }
    
    .floating-input.error + .floating-label,
    .floating-select.error + .floating-label {
        color: #EF4444;
    }
    
    /* Input Errors */
    .input-error {
        color: #EF4444;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        opacity: 0;
        animation: fadeInUp 0.3s ease-out forwards;
    }
    
    /* Remember Me Checkbox */
    .remember-section {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        opacity: 0;
        animation: fadeIn 0.4s ease-out 1.4s forwards;
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .custom-checkbox {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid #E2E8F0;
        border-radius: 0.375rem;
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .custom-checkbox:checked {
        background: #2563EB;
        border-color: #2563EB;
    }
    
    .custom-checkbox:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 0.75rem;
        font-weight: bold;
    }
    
    .checkbox-label {
        color: #64748B;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
    }
    
    /* Action Buttons */
    .btn-primary {
        width: 100%;
        padding: 1rem 2rem;
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.4s ease-out 1.5s forwards;
    }
    
    .btn-login {
        background: #2563EB;
        color: white;
    }
    
    .btn-register {
        background: #FDBA74;
        color: #0F172A;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-primary::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.1),
            transparent
        );
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(37, 99, 235, 0.3);
    }
    
    .btn-register:hover {
        background: #EA580C;
        color: white;
        box-shadow: 0 15px 35px rgba(253, 186, 116, 0.4);
    }
    
    .btn-primary:hover::after {
        opacity: 1;
    }
    
    .btn-primary:hover::before {
        left: 100%;
 
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    /* Loading State */
    .btn-primary.loading {
        color: transparent;
    }
    
    .btn-primary.loading::after {
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
    
    /* Toggle Links */
    .toggle-section {
        text-align: center;
        opacity: 0;
        animation: fadeIn 0.4s ease-out 1.6s forwards;
    }
    
    .toggle-link {
        color: #64748B;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }
    
    .toggle-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: #2563EB;
        transition: width 0.3s ease;
    }
    
    .register-panel .toggle-link::after {
        background: #FDBA74;
    }
    
    .toggle-link:hover {
        color: #2563EB;
    }
    
    .register-panel .toggle-link:hover {
        color: #FDBA74;
    }
    
    .toggle-link:hover::after {
        width: 100%;
    }
    
    /* Form Sections (Register Only) */
    .form-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #F1F5F9;
    }
    
    .form-section:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .section-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748B;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0;
        animation: slideInLeft 0.4s ease-out forwards;
    }
    
    .section-icon {
        width: 1rem;
        height: 1rem;
        color: #FDBA74;
    }
    
    /* Mobile Responsive */
    @media (max-width: 1024px) {
        .auth-card {
            max-width: 900px;
            height: 600px;
        }
        
        .brand-zone {
            flex: 0 0 50%;
        }
        
        .form-zone {
            flex: 0 0 50%;
        }
    }
    
    @media (max-width: 768px) {
        .unified-auth-container {
            padding: 1rem;
        }
        
        .auth-card {
            height: auto;
            min-height: 600px;
            border-radius: 16px;
            margin: 1rem;
        }
        
        .auth-panel {
            flex-direction: column;
        }
        
        .brand-zone {
            flex: 0 0 40%;
            min-height: 250px;
        }
        
        .form-zone {
            flex: 1;
            border-left: none;
            border-top: 1px solid rgba(226, 232, 240, 0.5);
        }
        
        .brand-headline {
            font-size: 2rem;
        }
        
        .trust-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .form-container {
            padding: 1.5rem;
        }
        
        .form-title {
            font-size: 1.5rem;
        }
    }
    
    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeInScale {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    
    @keyframes slideIn {
        from { width: 0; opacity: 0; }
        to { width: 2rem; opacity: 1; }
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes spin {
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    @keyframes floatParticle {
        0% { 
            transform: translateY(100vh) translateX(0px) rotate(0deg);
            opacity: 0;
        }
        10% { 
            opacity: 1;
        }
        90% { 
            opacity: 1;
        }
        100% { 
            transform: translateY(-100px) translateX(100px) rotate(360deg);
            opacity: 0;
        }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    @keyframes breathe {
        0%, 100% { transform: scale(1); opacity: 0.7; }
        50% { transform: scale(1.1); opacity: 1; }
    }
</style>
@endpush

@section('content')
<div class="unified-auth-container">
    <!-- Animated Background Orbs -->
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>
    
    <!-- Floating Particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    
    <!-- Main Auth Card -->
    <div class="auth-card">
        <div class="panels-container" id="panelsContainer">
            <!-- LOGIN PANEL -->
            <div class="auth-panel login-panel">
                <!-- Brand Zone -->
                <div class="brand-zone">
                    <div class="brand-content">
                        <h1 class="brand-headline">
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
                        
                        <div class="trust-grid">
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
                
                <!-- Form Zone -->
                <div class="form-zone">
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
                        
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf
                            
                            <div class="input-group">
                                <input 
                                    type="email" 
                                    id="login_email" 
                                    name="email" 
                                    class="floating-input @error('email') error @enderror" 
                                    placeholder=" "
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                >
                                <label for="login_email" class="floating-label">
                                    @if(app()->getLocale() === 'am')
                                        ኢሜይል አድራሻ
                                    @else
                                        Email address
                                    @endif
                                </label>
                                @error('email')
                                    <div class="input-error">
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
                                    id="login_password" 
                                    name="password" 
                                    class="floating-input @error('password') error @enderror" 
                                    placeholder=" "
                                    required
                                    autocomplete="current-password"
                                >
                                <label for="login_password" class="floating-label">
                                    @if(app()->getLocale() === 'am')
                                        የይለፍ ቃል
                                    @else
                                        Password
                                    @endif
                                </label>
                                @error('password')
                                    <div class="input-error">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="remember-section">
                                <div class="checkbox-group">
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
                            
                            <button type="submit" class="btn-primary btn-login" id="loginBtn">
                                @if(app()->getLocale() === 'am')
                                    ግባ
                                @else
                                    Sign in
                                @endif
                            </button>
                        </form>
                        
                        <div class="toggle-section">
                            <span class="toggle-link" onclick="showRegister()">
                                @if(app()->getLocale() === 'am')
                                    አዲስ መለያ ይፍጠሩ
                                @else
                                    Create new account
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- REGISTER PANEL -->
            <div class="auth-panel register-panel">
                <!-- Brand Zone -->
                <div class="brand-zone">
                    <div class="brand-content">
                        <h1 class="brand-headline">
                            @if(app()->getLocale() === 'am')
                                ይቀላቀሉን።<br>
                                <span style="color: #2563EB;">ይጀምሩ።</span><br>
                                <span style="color: #FDBA74;">ይንቀሳቀሱ።</span>
                            @else
                                Join us.<br>
                                <span style="color: #2563EB;">Start.</span><br>
                                <span style="color: #FDBA74;">Move.</span>
                            @endif
                        </h1>
                        <p class="brand-subtitle">
                            @if(app()->getLocale() === 'am')
                                የተረጋገጠ የተሽከርካሪ አገልግሎት ለደህንነት የተገነባ።
                            @else
                                Create your account for verified mobility services.
                            @endif
                        </p>
                        
                        <div class="trust-grid">
                            <div class="trust-item">
                                <div class="trust-icon">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="trust-text">
                                    @if(app()->getLocale() === 'am')
                                        መለያ
                                    @else
                                        Account
                                    @endif
                                </div>
                            </div>
                            
                            <div class="trust-item">
                                <div class="trust-icon">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div class="trust-text">
                                    @if(app()->getLocale() === 'am')
                                        ማረጋገጫ
                                    @else
                                        Verify
                                    @endif
                                </div>
                            </div>
                            
                            <div class="trust-item">
                                <div class="trust-icon">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="trust-text">
                                    @if(app()->getLocale() === 'am')
                                        ማግኛ
                                    @else
                                        Contact
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
                                        Security
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Zone -->
                <div class="form-zone">
                    <div class="form-container">
                        <div class="step-indicator">
                            <div class="step-progress">
                                <div class="step-progress-bar" id="progressBar"></div>
                            </div>
                            <div class="step-labels">
                                <span class="step-label active" id="step1">
                                    @if(app()->getLocale() === 'am')
                                        መለያ
                                    @else
                                        Account
                                    @endif
                                </span>
                                <span class="step-label" id="step2">
                                    @if(app()->getLocale() === 'am')
                                        ማግኛ
                                    @else
                                        Contact
                                    @endif
                                </span>
                                <span class="step-label" id="step3">
                                    @if(app()->getLocale() === 'am')
                                        ማረጋገጫ
                                    @else
                                        Verify
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-header">
                            <h2 class="form-title">
                                @if(app()->getLocale() === 'am')
                                    መለያ ይፍጠሩ
                                @else
                                    Create account
                                @endif
                            </h2>
                            <p class="form-subtitle">
                                @if(app()->getLocale() === 'am')
                                    የተረጋገጠ የተሽከርካሪ አገልግሎት ይጀምሩ
                                @else
                                    Start your verified mobility journey
                                @endif
                            </p>
                        </div>
                        
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf
                            
                            <div class="form-section">
                                <div class="section-title">
                                    <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    @if(app()->getLocale() === 'am')
                                        የግል መረጃ
                                    @else
                                        Personal Info
                                    @endif
                                </div>
                                
                                <div class="input-group">
                                    <input 
                                        type="text" 
                                        id="register_name" 
                                        name="name" 
                                        class="floating-input @error('name') error @enderror" 
                                        placeholder=" "
                                        value="{{ old('name') }}"
                                        required
                                        autocomplete="name"
                                    >
                                    <label for="register_name" class="floating-label">
                                        @if(app()->getLocale() === 'am')
                                            ሙሉ ስም
                                        @else
                                            Full Name
                                        @endif
                                    </label>
                                    @error('name')
                                        <div class="input-error">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="input-group">
                                    <input 
                                        type="email" 
                                        id="register_email" 
                                        name="email" 
                                        class="floating-input @error('email') error @enderror" 
                                        placeholder=" "
                                        value="{{ old('email') }}"
                                        required
                                        autocomplete="email"
                                    >
                                    <label for="register_email" class="floating-label">
                                        @if(app()->getLocale() === 'am')
                                            ኢሜይል አድራሻ
                                        @else
                                            Email Address
                                        @endif
                                    </label>
                                    @error('email')
                                        <div class="input-error">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="input-group">
                                    <input 
                                        type="tel" 
                                        id="register_phone" 
                                        name="phone" 
                                        class="floating-input @error('phone') error @enderror" 
                                        placeholder=" "
                                        value="{{ old('phone') }}"
                                        required
                                        autocomplete="tel"
                                    >
                                    <label for="register_phone" class="floating-label">
                                        @if(app()->getLocale() === 'am')
                                            ስልክ ቁጥር
                                        @else
                                            Phone Number
                                        @endif
                                    </label>
                                    @error('phone')
                                        <div class="input-error">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="input-group">
                                    <select 
                                        id="register_language" 
                                        name="preferred_language" 
                                        class="floating-select @error('preferred_language') error @enderror"
                                        required
                                    >
                                        <option value="en" {{ old('preferred_language') === 'en' ? 'selected' : '' }}>English</option>
                                        <option value="am" {{ old('preferred_language') === 'am' ? 'selected' : '' }}>አማርኛ</option>
                                    </select>
                                    <label for="register_language" class="floating-label" style="transform: translateY(-1.5rem) scale(0.875); color: #FDBA74; font-weight: 500;">
                                        @if(app()->getLocale() === 'am')
                                            ተመራጭ ቋንቋ
                                        @else
                                            Preferred Language
                                        @endif
                                    </label>
                                    @error('preferred_language')
                                        <div class="input-error">
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
                                        id="register_password" 
                                        name="password" 
                                        class="floating-input @error('password') error @enderror" 
                                        placeholder=" "
                                        required
                                        autocomplete="new-password"
                                    >
                                    <label for="register_password" class="floating-label">
                                        @if(app()->getLocale() === 'am')
                                            የይለፍ ቃል
                                        @else
                                            Password
                                        @endif
                                    </label>
                                    @error('password')
                                        <div class="input-error">
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
                                        id="register_password_confirmation" 
                                        name="password_confirmation" 
                                        class="floating-input" 
                                        placeholder=" "
                                        required
                                        autocomplete="new-password"
                                    >
                                    <label for="register_password_confirmation" class="floating-label">
                                        @if(app()->getLocale() === 'am')
                                            የይለፍ ቃል ማረጋገጫ
                                        @else
                                            Confirm Password
                                        @endif
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-primary btn-register" id="registerBtn">
                                @if(app()->getLocale() === 'am')
                                    መለያ ፍጠር
                                @else
                                    Create Account
                                @endif
                            </button>
                        </form>
                        
                        <div class="toggle-section">
                            <span class="toggle-link" onclick="showLogin()">
                                @if(app()->getLocale() === 'am')
                                    ወደ መለያዎ ይግቡ
                                @else
                                    Sign in to your account
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const panelsContainer = document.getElementById('panelsContainer');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const progressBar = document.getElementById('progressBar');
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    
    let isRegisterView = false;
    
    // Fix error input visibility immediately
    function ensureErrorInputsVisible() {
        const errorInputs = document.querySelectorAll('.floating-input.error, .floating-select.error');
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
    
    // Call immediately and after any form interactions
    ensureErrorInputsVisible();
    
    // Panel transition functions with premium effects
    window.showRegister = function() {
        if (!isRegisterView) {
            // Add transition class for effects
            panelsContainer.classList.add('transitioning');
            
            // Trigger the slide
            setTimeout(() => {
                panelsContainer.classList.add('show-register');
            }, 50);
            
            isRegisterView = true;
            
            // Remove transition class and reset animations
            setTimeout(() => {
                panelsContainer.classList.remove('transitioning');
                resetAnimations('.register-panel');
                ensureErrorInputsVisible(); // Ensure visibility after panel switch
                
                // Add subtle shake effect to register button
                const registerBtn = document.getElementById('registerBtn');
                registerBtn.style.animation = 'pulse 0.6s ease-out';
                setTimeout(() => {
                    registerBtn.style.animation = '';
                }, 600);
            }, 800);
        }
    };
    
    window.showLogin = function() {
        if (isRegisterView) {
            // Add transition class for effects
            panelsContainer.classList.add('transitioning');
            
            // Trigger the slide
            setTimeout(() => {
                panelsContainer.classList.remove('show-register');
            }, 50);
            
            isRegisterView = false;
            
            // Remove transition class and reset animations
            setTimeout(() => {
                panelsContainer.classList.remove('transitioning');
                resetAnimations('.login-panel');
                ensureErrorInputsVisible(); // Ensure visibility after panel switch
                
                // Add subtle glow effect to login button
                const loginBtn = document.getElementById('loginBtn');
                loginBtn.style.boxShadow = '0 0 20px rgba(37, 99, 235, 0.4)';
                setTimeout(() => {
                    loginBtn.style.boxShadow = '';
                }, 1000);
            }, 800);
        }
    };
    
    function resetAnimations(panelSelector) {
        const panel = document.querySelector(panelSelector);
        const animatedElements = panel.querySelectorAll('.brand-content, .form-header, .input-group, .btn-primary, .toggle-section, .remember-section, .step-indicator');
        
        animatedElements.forEach(el => {
            el.style.animation = 'none';
            el.offsetHeight; // Trigger reflow
            el.style.animation = null;
        });
        
        // Ensure error inputs remain visible after animation reset
        setTimeout(ensureErrorInputsVisible, 100);
    }
    
    // Form submission handlers
    loginForm.addEventListener('submit', function() {
        loginBtn.classList.add('loading');
        loginBtn.disabled = true;
    });
    
    registerForm.addEventListener('submit', function() {
        registerBtn.classList.add('loading');
        registerBtn.disabled = true;
        
        // Complete progress bar
        progressBar.style.width = '100%';
        step1.classList.add('completed');
        step2.classList.add('completed');
        step3.classList.add('completed');
    });
    
    // Progress tracking for register form
    const registerInputs = document.querySelectorAll('#registerForm .floating-input, #registerForm .floating-select');
    let filledInputs = 0;
    
    function updateProgress() {
        const totalInputs = registerInputs.length;
        const progress = (filledInputs / totalInputs) * 100;
        progressBar.style.width = `${Math.max(33.33, progress)}%`;
        
        // Update step labels
        if (progress >= 33.33) {
            step1.classList.add('completed');
            step2.classList.add('active');
        }
        if (progress >= 66.66) {
            step2.classList.add('completed');
            step3.classList.add('active');
        }
        if (progress >= 100) {
            step3.classList.add('completed');
        }
    }
    
    registerInputs.forEach(input => {
        input.addEventListener('input', function() {
            const wasFilled = this.dataset.filled === 'true';
            const isFilled = this.value.trim() !== '';
            
            if (isFilled && !wasFilled) {
                filledInputs++;
                this.dataset.filled = 'true';
            } else if (!isFilled && wasFilled) {
                filledInputs--;
                this.dataset.filled = 'false';
            }
            
            updateProgress();
        });
        
        // Initialize state
        if (input.value.trim() !== '') {
            filledInputs++;
            input.dataset.filled = 'true';
        }
    });
    
    // Initial progress update
    updateProgress();
    
    // Input focus animations
    const allInputs = document.querySelectorAll('.floating-input, .floating-select');
    allInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
    
    // Check URL parameters to show correct panel
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('view') === 'register' || '{{ $view ?? '' }}' === 'register') {
        showRegister();
    }
    
    // Check if there are validation errors and show appropriate panel
    const hasLoginErrors = document.querySelector('#loginForm .error');
    const hasRegisterErrors = document.querySelector('#registerForm .error');
    
    if (hasRegisterErrors && !hasLoginErrors) {
        showRegister();
    }
    
    console.log('🎨 Stunning Animated Auth System Loaded');
});
</script>
@endpush
