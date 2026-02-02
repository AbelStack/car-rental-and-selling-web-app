<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminVehicleController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\ChapaPaymentController;
use App\Http\Controllers\ChatbotController;
use App\Models\Purchase;
use App\Models\Booking;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/language/{language}', [HomeController::class, 'setLanguage'])->name('language.set');

// Debug route
Route::get('/debug-routes', function () {
    return [
        'login_url' => route('login'),
        'register_url' => route('register'),
        'home_url' => route('home'),
        'current_url' => request()->url(),
        'app_url' => config('app.url'),
    ];
});

// Authentication routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Vehicle routes
Route::get('/vehicles/rentals', [VehicleController::class, 'rentals'])->name('vehicles.rentals');
Route::get('/vehicles/buying', [VehicleController::class, 'sales'])->name('vehicles.sales');
Route::get('/rent', [VehicleController::class, 'rentals'])->name('vehicles.rentals.legacy'); // Legacy support
Route::get('/buy', [VehicleController::class, 'sales'])->name('vehicles.sales.legacy'); // Legacy support
Route::get('/vehicle/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::post('/vehicle/{vehicle}/check-availability', [VehicleController::class, 'checkAvailability'])->name('vehicles.check-availability');

// Smart Search API routes
Route::get('/api/search/suggestions', [VehicleController::class, 'searchSuggestions'])->name('api.search.suggestions');
Route::get('/api/search/history', [VehicleController::class, 'searchHistory'])->name('api.search.history');

// Contact routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // KYC Verification routes
    Route::prefix('kyc')->name('kyc.')->group(function () {
        Route::get('/', [KycController::class, 'index'])->name('index');
        Route::get('/create', [KycController::class, 'create'])->name('create');
        Route::post('/', [KycController::class, 'store'])->name('store');
        Route::get('/{kyc}', [KycController::class, 'show'])->name('show');
        Route::get('/{kyc}/document/{type}', [KycController::class, 'downloadDocument'])->name('document.download');
    });

    // Chapa Payment routes
    Route::prefix('chapa')->name('chapa.')->group(function () {
        Route::post('/booking/{booking}/pay', [ChapaPaymentController::class, 'initializeBookingPayment'])->name('booking.pay');
        Route::post('/purchase/{purchase}/pay', [ChapaPaymentController::class, 'initializePurchasePayment'])->name('purchase.pay');
        
        // Handle accidental GET requests to payment routes (redirect to proper page)
        Route::get('/purchase/{purchase}/pay', function(Purchase $purchase) {
            return redirect()->route('purchases.show', $purchase)
                ->with('error', 'Please use the payment button to complete your purchase.');
        })->name('purchase.pay.redirect');
        
        Route::get('/booking/{booking}/pay', function(Booking $booking) {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'Please use the payment button to complete your booking.');
        })->name('booking.pay.redirect');
        
        Route::get('/return/{transaction}', [ChapaPaymentController::class, 'handleReturn'])->name('return');
        Route::get('/success/{transaction}', [ChapaPaymentController::class, 'success'])->name('success');
        Route::get('/failed/{transaction}', [ChapaPaymentController::class, 'failed'])->name('failed');
        Route::get('/status/{transaction}', [ChapaPaymentController::class, 'checkStatus'])->name('status');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/bookings', [DashboardController::class, 'bookings'])->name('dashboard.bookings');
    Route::get('/dashboard/purchases', [DashboardController::class, 'purchases'])->name('dashboard.purchases');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::put('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::put('/dashboard/password', [DashboardController::class, 'changePassword'])->name('dashboard.password.change');

    // Booking routes
    Route::get('/book/{vehicle}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/book/{vehicle}', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/booking/{booking}/payment', [BookingController::class, 'payment'])->name('bookings.payment');
    Route::delete('/booking/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Purchase routes
    Route::get('/purchase/{vehicle}', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/purchase/{vehicle}', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/purchase-details/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/purchase-details/{purchase}/payment', [PurchaseController::class, 'payment'])->name('purchases.payment');

    // Payment routes
    Route::post('/payment/{payment}/submit', [PaymentController::class, 'submit'])->name('payments.submit');
    Route::get('/payment/{payment}/status', [PaymentController::class, 'status'])->name('payments.status');
    Route::get('/api/payment/{payment}/status', [PaymentController::class, 'statusApi'])->name('payments.status.api');
});

// Chapa Webhook (no auth required)
Route::post('/chapa/callback', [ChapaPaymentController::class, 'callback'])->name('chapa.callback');

// Public Discount Preview (no auth required)
Route::post('/discount/preview', [\App\Http\Controllers\Admin\DiscountController::class, 'preview'])->name('discount.preview');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // KYC Management
    Route::prefix('kyc')->name('kyc.')->group(function () {
        Route::get('/', [AdminController::class, 'kycIndex'])->name('index');
        Route::get('/{kyc}', [AdminController::class, 'kycShow'])->name('show');
        Route::post('/{kyc}/approve', [AdminController::class, 'kycApprove'])->name('approve');
        Route::post('/{kyc}/reject', [AdminController::class, 'kycReject'])->name('reject');
        Route::get('/{kyc}/document/{type}', [AdminController::class, 'kycDownloadDocument'])->name('document.download');
    });
    
    // User management
    Route::resource('users', AdminUserController::class);
    Route::post('users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Vehicle management
    Route::resource('vehicles', AdminVehicleController::class);
    Route::post('vehicles/{vehicle}/toggle-status', [AdminVehicleController::class, 'toggleStatus'])->name('vehicles.toggle-status');
    Route::post('vehicles/{vehicle}/images', [AdminVehicleController::class, 'uploadImages'])->name('vehicles.upload-images');
    Route::delete('vehicles/images/{image}', [AdminVehicleController::class, 'deleteImage'])->name('vehicles.delete-image');
    
    // Booking management
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    
    // Payment verification
    Route::get('payments', [AdminController::class, 'payments'])->name('payments.index');
    Route::post('payments/{payment}/verify', [AdminController::class, 'verifyPayment'])->name('payments.verify');
    Route::post('payments/{payment}/reject', [AdminController::class, 'rejectPayment'])->name('payments.reject');
    
    // Reports
    Route::get('reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('reports/export/{type}', [AdminController::class, 'exportReport'])->name('reports.export');
    
    // Contact messages
    Route::get('messages', [AdminController::class, 'messages'])->name('messages.index');
    Route::get('messages/{message}', [AdminController::class, 'showMessage'])->name('messages.show');
    Route::post('messages/{message}/reply', [AdminController::class, 'replyMessage'])->name('messages.reply');
    
    // Discount Management
    Route::resource('discounts', \App\Http\Controllers\Admin\DiscountController::class);
    Route::patch('discounts/{discount}/toggle-status', [\App\Http\Controllers\Admin\DiscountController::class, 'toggleStatus'])->name('discounts.toggle-status');
    Route::post('discounts/preview', [\App\Http\Controllers\Admin\DiscountController::class, 'preview'])->name('discounts.preview');
    Route::get('discounts-analytics', [\App\Http\Controllers\Admin\DiscountController::class, 'analytics'])->name('discounts.analytics');
});

// Chatbot routes
Route::post('/chatbot/ai', [ChatbotController::class, 'askAI'])->name('chatbot.ai');
Route::get('/chatbot/predefined', [ChatbotController::class, 'getPredefinedAnswers'])->name('chatbot.predefined');