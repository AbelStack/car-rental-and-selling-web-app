@extends('layouts.app')

@section('title', 'Register - Car Rental & Sales System')

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
        min-height: 700px;
        position: relative;
        z-index: 20;
        opacity: 0;
        transform: translateY(30px) scale(0.95);
        animation: cardEntrance 1s ease-out 0.3s forwards;
    }
    
    .brand-section {
        flex: 0 0 60%;
        background: rgba(253, 186, 116, 0.05);
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
        background: radial-gradient(circle, rgba(253, 186, 116, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .brand-section::after {
        content: '';
        position: absolute;
        bottom: 15%;
        left: 15%;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
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
    
    .kyc-preview {
        background: rgba(253, 186, 116, 0.15);
        border: 1px solid rgba(253, 186, 116, 0.3);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-top: 2rem;
        text-align: left;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.6s ease-out 1.2s forwards;
        transition: all 0.3s ease;
        backdrop-filter: blur(8px);
    }
    
    .kyc-preview:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(253, 186, 116, 0.2);
    }
    
    .kyc-preview-title {
        font-size: 1rem;
        font-weight: 600;
        color: #EA580C;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .kyc-preview-text {
        font-size: 0.875rem;
        color: #F1F5F9;
        line-height: 1.5;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
    }
    
    .form-section {
        flex: 0 0 40%;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(25px);
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 2rem;
        overflow-y: auto;
        border-left: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }
    
    .form-container {
        width: 100%;
        max-width: 350px;
        padding: 1rem 0;
    }
    
    .progress-indicator {
        margin-bottom: 1.5rem;
        opacity: 0;
        animation: slideInDown 0.6s ease-out 0.8s forwards;
    }
    
    .progress-bar {
        width: 100%;
        height: 4px;
        background: #CBD5E1;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.75rem;
        position: relative;
    }
    
    .progress-bar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(253, 186, 116, 0.3), transparent);
        animation: shimmer 2s infinite;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #FDBA74, #FED7AA);
        border-radius: 2px;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        width: 33.33%;
        position: relative;
        overflow: hidden;
    }
    
    .progress-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        animation: progressShine 2s infinite;
    }
    
    .progress-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.625rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .progress-label {
        color: #F1F5F9;
        transition: all 0.3s ease;
        position: relative;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.8);
        font-weight: 500;
    }
    
    .progress-label.active {
        color: #FDBA74;
        transform: scale(1.05);
    }
    
    .progress-label.completed {
        color: #10B981;
    }
    
    .progress-label.completed::after {
        content: '✓';
        position: absolute;
        top: -0.5rem;
        right: -0.5rem;
        font-size: 0.75rem;
        color: #10B981;
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.6s ease-out 0.9s forwards;
    }
    
    .form-title {
        font-size: 1.75rem;
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
        background: linear-gradient(90deg, transparent, #FDBA74, transparent);
        animation: expandLine 0.8s ease-out 1.5s forwards;
    }
    
    .form-section-group {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        opacity: 0;
        transform: translateY(20px);
        animation: slideInUp 0.5s ease-out forwards;
    }
    
    .form-section-group:nth-child(1) { animation-delay: 1.1s; }
    .form-section-group:nth-child(2) { animation-delay: 1.3s; }
    .form-section-group:nth-child(3) { animation-delay: 1.5s; }
    
    .form-section-group:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .section-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #F1F5F9;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.3s ease;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.8);
    }
    
    .form-section-group:hover .section-title {
        color: #FDBA74;
    }
    
    .section-icon {
        width: 1rem;
        height: 1rem;
        color: #FDBA74;
        transition: transform 0.3s ease;
    }
    
    .form-section-group:hover .section-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .input-group {
        margin-bottom: 1.25rem;
        position: relative;
        opacity: 0;
        transform: translateY(15px);
        animation: slideInUp 0.4s ease-out forwards;
    }
    
    /* Ensure input groups with errors are immediately visible */
    .input-group:has(.error),
    .input-group.has-error {
        opacity: 1 !important;
        transform: translateY(0) !important;
        animation: none !important;
    }
    
    .input-group:nth-child(2) { animation-delay: 1.2s; }
    .input-group:nth-child(3) { animation-delay: 1.3s; }
    .input-group:nth-child(4) { animation-delay: 1.4s; }
    .input-group:nth-child(5) { animation-delay: 1.5s; }
    
    .form-input, .form-select {
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
    
    .form-input:focus, .form-select:focus {
        border-color: #60A5FA;
        border-bottom-color: #2563EB;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 4px 20px rgba(37, 99, 235, 0.4), 0 0 0 3px rgba(37, 99, 235, 0.1);
        transform: translateY(-1px);
    }
    
    .form-input::placeholder, .form-select::placeholder {
        color: rgba(248, 250, 252, 0.6);
        font-weight: 400;
    }
    
    .form-input.error, .form-select.error {
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
    .form-input:not(:placeholder-shown) + .form-label,
    .form-select:focus + .form-label,
    .form-select:not([value=""]) + .form-label {
        transform: translateY(-1.5rem) scale(0.875);
        color: #93C5FD;
        font-weight: 600;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.9), 0 0 10px rgba(147, 197, 253, 0.3);
    }
    
    .form-input.error + .form-label,
    .form-select.error + .form-label {
        color: #EF4444;
    }
    
    .error-message {
        color: #EF4444;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        opacity: 1;
        transform: translateY(0);
        animation: fadeInUp 0.3s ease-out forwards;
    }
    
    .btn-register {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #FDBA74 0%, #EA580C 100%);
        color: #0F172A;
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
        box-shadow: 0 8px 25px rgba(253, 186, 116, 0.4);
    }
    
    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-register:hover {
        background: linear-gradient(135deg, #EA580C 0%, #DC2626 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(253, 186, 116, 0.6);
    }
    
    .btn-register:hover::before {
        left: 100%;
    }
    
    .btn-register:active {
        transform: translateY(0);
    }
    
    .btn-register.loading {
        pointer-events: none;
    }
    
    .btn-register.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid rgba(15, 23, 42, 0.3);
        border-top-color: #0F172A;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    
    .auth-link {
        display: block;
        text-align: center;
        color: #93C5FD;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        opacity: 0;
        animation: fadeIn 0.4s ease-out 1.9s forwards;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8), 0 0 10px rgba(147, 197, 253, 0.2);
    }
    
    .auth-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 1px;
        background: #1E40AF;
        transition: width 0.3s ease;
    }
    
    .auth-link:hover {
        color: #60A5FA;
        transform: translateY(-1px);
        text-shadow: 0 2px 8px rgba(96, 165, 250, 0.6), 0 0 20px rgba(96, 165, 250, 0.3);
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
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    @keyframes progressShine {
        0% { left: -100%; }
        100% { left: 100%; }
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
            flex: 0 0 30%;
            min-height: 200px;
            padding: 2rem;
        }
        
        .brand-title {
            font-size: 2rem;
        }
        
        .kyc-preview {
            margin-top: 1rem;
            padding: 1rem;
        }
        
        .form-section {
            flex: 1;
            padding: 1.5rem;
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
             style="background-image: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); 
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
                
                <div class="kyc-preview">
                    <div class="kyc-preview-title">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        @if(app()->getLocale() === 'am')
                            የማንነት ማረጋገጫ
                        @else
                            Identity Verification
                        @endif
                    </div>
                    <p class="kyc-preview-text">
                        @if(app()->getLocale() === 'am')
                            የማንነት ማረጋገጫ የእኛን መድረክ ደህንነቱ የተጠበቀ ያደርገዋል። ከመለያ ፈጠራ በኋላ የመታወቂያ ሰነዶችዎን ማስገባት ይኖርብዎታል።
                        @else
                            Identity verification keeps our platform safe. You'll need to upload your ID documents after account creation.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Form Section -->
        <div class="form-section">
            <div class="form-container">
                <!-- Progress Indicator -->
                <div class="progress-indicator">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <div class="progress-labels">
                        <span class="progress-label active" id="step1">
                            @if(app()->getLocale() === 'am')
                                መለያ
                            @else
                                Account
                            @endif
                        </span>
                        <span class="progress-label" id="step2">
                            @if(app()->getLocale() === 'am')
                                ማግኛ
                            @else
                                Contact
                            @endif
                        </span>
                        <span class="progress-label" id="step3">
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
                            Create your account
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
                
                <!-- General Error Display -->
                <!-- @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg backdrop-blur-sm">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h4 class="text-red-400 font-medium text-sm">
                                @if(app()->getLocale() === 'am')
                                    እባክዎ የሚከተሉትን ስህተቶች ያርሙ፦
                                @else
                                    Please correct the following errors:
                                @endif
                            </h4>
                        </div>
                        <ul class="text-red-300 text-xs space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start gap-2">
                                    <span class="text-red-400 mt-0.5">•</span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif -->
                
                <!-- System Error Display -->
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg backdrop-blur-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-red-300 text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
                
                <!-- Registration Error Display -->
                @if (session('registration_error'))
                    <div class="mb-6 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-lg backdrop-blur-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <p class="text-yellow-300 text-sm">{{ session('registration_error') }}</p>
                        </div>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register.submit') }}" id="registerForm">
                    @csrf
                    
                    <!-- Personal Info Section -->
                    <div class="form-section-group">
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
                                id="name" 
                                name="name" 
                                class="form-input @error('name') error @enderror" 
                                placeholder=" "
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                            >
                            <label for="name" class="form-label">
                                @if(app()->getLocale() === 'am')
                                    ሙሉ ስም
                                @else
                                    Full Name
                                @endif
                            </label>
                            @error('name')
                                <div class="error-message">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Contact Info Section -->
                    <div class="form-section-group">
                        <div class="section-title">
                            <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            @if(app()->getLocale() === 'am')
                                የመገናኛ መረጃ
                            @else
                                Contact Info
                            @endif
                        </div>
                        
                        <div class="input-group">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-input @error('email') error @enderror" 
                                placeholder=" "
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                            >
                            <label for="email" class="form-label">
                                @if(app()->getLocale() === 'am')
                                    ኢሜይል አድራሻ
                                @else
                                    Email Address
                                @endif
                            </label>
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
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="form-input @error('phone') error @enderror" 
                                placeholder=" "
                                value="{{ old('phone') }}"
                                required
                                autocomplete="tel"
                            >
                            <label for="phone" class="form-label">
                                @if(app()->getLocale() === 'am')
                                    ስልክ ቁጥር
                                @else
                                    Phone Number
                                @endif
                            </label>
                            @error('phone')
                                <div class="error-message">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <select 
                                id="preferred_language" 
                                name="preferred_language" 
                                class="form-select @error('preferred_language') error @enderror"
                                required
                            >
                                <option value="en" {{ old('preferred_language') === 'en' ? 'selected' : '' }}>English</option>
                                <option value="am" {{ old('preferred_language') === 'am' ? 'selected' : '' }}>አማርኛ</option>
                            </select>
                            <label for="preferred_language" class="form-label" style="transform: translateY(-1.5rem) scale(0.875); color: #FDBA74; font-weight: 500;">
                                @if(app()->getLocale() === 'am')
                                    ተመራጭ ቋንቋ
                                @else
                                    Preferred Language
                                @endif
                            </label>
                            @error('preferred_language')
                                <div class="error-message">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Security Section -->
                    <div class="form-section-group">
                        <div class="section-title">
                            <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            @if(app()->getLocale() === 'am')
                                ደህንነት
                            @else
                                Security
                            @endif
                        </div>
                        
                        <div class="input-group">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-input @error('password') error @enderror" 
                                placeholder=" "
                                required
                                autocomplete="new-password"
                            >
                            <label for="password" class="form-label">
                                @if(app()->getLocale() === 'am')
                                    የይለፍ ቃል
                                @else
                                    Password
                                @endif
                            </label>
                            @error('password')
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
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="form-input" 
                                placeholder=" "
                                required
                                autocomplete="new-password"
                            >
                            <label for="password_confirmation" class="form-label">
                                @if(app()->getLocale() === 'am')
                                    የይለፍ ቃል ማረጋገጫ
                                @else
                                    Confirm Password
                                @endif
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-register" id="registerBtn">
                        @if(app()->getLocale() === 'am')
                            መለያ ፍጠር
                        @else
                            Create Account
                        @endif
                    </button>
                </form>
                
                <a href="{{ route('login') }}" class="auth-link">
                    @if(app()->getLocale() === 'am')
                        ወደ መለያዎ ይግቡ
                    @else
                        Sign in to your account
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
    const form = document.getElementById('registerForm');
    const registerBtn = document.getElementById('registerBtn');
    const progressFill = document.getElementById('progressFill');
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    const inputs = document.querySelectorAll('.form-input, .form-select');
    
    // Fix error input visibility immediately
    function ensureErrorInputsVisible() {
        const errorInputs = document.querySelectorAll('.form-input.error, .form-select.error');
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
        console.log('🚀 Form submission started');
        console.log('Form data:', new FormData(form));
        
        registerBtn.classList.add('loading');
        registerBtn.disabled = true;
        registerBtn.style.opacity = '0.8';
        
        // Complete progress bar with animation
        progressFill.style.width = '100%';
        step1.classList.add('completed');
        step2.classList.add('completed');
        step3.classList.add('completed');
        
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
        
        const rect = registerBtn.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (rect.width / 2 - size / 2) + 'px';
        ripple.style.top = (rect.height / 2 - size / 2) + 'px';
        
        registerBtn.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    });
    
    // Progress tracking with enhanced animations
    let filledInputs = 0;
    
    function updateProgress() {
        const totalInputs = inputs.length;
        const progress = (filledInputs / totalInputs) * 100;
        progressFill.style.width = `${Math.max(33.33, progress)}%`;
        
        // Update step labels with animations
        if (progress >= 33.33) {
            step1.classList.add('completed');
            step2.classList.add('active');
            step2.style.animation = 'pulse 0.5s ease-out';
        }
        if (progress >= 66.66) {
            step2.classList.add('completed');
            step3.classList.add('active');
            step3.style.animation = 'pulse 0.5s ease-out';
        }
        if (progress >= 100) {
            step3.classList.add('completed');
            step3.style.animation = 'pulse 0.5s ease-out';
        }
    }
    
    // Enhanced input interactions
    inputs.forEach((input, index) => {
        // Progress tracking
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
        
        // Focus animations
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
            this.parentElement.style.transition = 'transform 0.3s ease';
            this.style.boxShadow = '0 4px 12px rgba(253, 186, 116, 0.15)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
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
        
        // Initialize state
        if (input.value.trim() !== '') {
            filledInputs++;
            input.dataset.filled = 'true';
        }
    });
    
    // Parallax effect for hero background
    window.addEventListener('scroll', function() {
        const heroImage = document.querySelector('.auth-hero-image');
        if (heroImage) {
            const scrolled = window.pageYOffset;
            heroImage.style.transform = `scale(1.05) translateY(${scrolled * 0.3}px)`;
        }
    });
    
    // Section hover effects
    const sections = document.querySelectorAll('.form-section-group');
    sections.forEach(section => {
        section.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        section.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
    
    // Initial progress update
    updateProgress();
    
    // Add CSS for additional animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    `;
    document.head.appendChild(style);
    
    // Debug: Check for existing errors on page load
    const errorMessages = document.querySelectorAll('.error-message');
    if (errorMessages.length > 0) {
        console.log('🚨 Found ' + errorMessages.length + ' error messages on page load');
        errorMessages.forEach((error, index) => {
            console.log(`Error ${index + 1}:`, error.textContent.trim());
            // Ensure error is visible
            error.style.opacity = '1';
            error.style.transform = 'translateY(0)';
            error.style.display = 'flex';
        });
    }
    
    // Debug: Check for general error display
    const generalErrors = document.querySelector('.bg-red-500\\/10');
    if (generalErrors) {
        console.log('🚨 Found general error display');
        console.log('General errors content:', generalErrors.textContent.trim());
    }
    
    // Debug: Log form validation state
    console.log('📋 Form validation state:');
    inputs.forEach(input => {
        const hasError = input.classList.contains('error');
        console.log(`- ${input.name}: ${hasError ? 'HAS ERROR' : 'OK'} (value: "${input.value}")`);
    });
    
    console.log('🎨 Premium Animated Registration System Loaded');
});
</script>
@endpush
