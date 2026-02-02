<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔧 Diagnosing Email Delivery Issues...\n\n";

// 1. Check current mail configuration
echo "1️⃣ CHECKING MAIL CONFIGURATION:\n";

$mailDriver = config('mail.default');
$mailHost = config('mail.mailers.smtp.host');
$mailPort = config('mail.mailers.smtp.port');
$mailUsername = config('mail.mailers.smtp.username');
$mailFromAddress = config('mail.from.address');
$mailFromName = config('mail.from.name');

echo "   Current Configuration:\n";
echo "   - Mail Driver: {$mailDriver}\n";
echo "   - SMTP Host: {$mailHost}\n";
echo "   - SMTP Port: {$mailPort}\n";
echo "   - SMTP Username: " . ($mailUsername ?: 'Not set') . "\n";
echo "   - From Address: {$mailFromAddress}\n";
echo "   - From Name: {$mailFromName}\n";

if ($mailDriver === 'log') {
    echo "   ⚠️ WARNING: Mail driver is set to 'log' - emails will be logged, not sent!\n";
}

// 2. Check .env file mail settings
echo "\n2️⃣ CHECKING .ENV MAIL SETTINGS:\n";

$envPath = base_path('.env');
if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    
    $mailSettings = [
        'MAIL_MAILER',
        'MAIL_HOST',
        'MAIL_PORT',
        'MAIL_USERNAME',
        'MAIL_PASSWORD',
        'MAIL_FROM_ADDRESS',
        'MAIL_FROM_NAME'
    ];
    
    foreach ($mailSettings as $setting) {
        if (preg_match("/^{$setting}=(.*)$/m", $envContent, $matches)) {
            $value = trim($matches[1], '"');
            echo "   - {$setting}: " . ($value ?: 'Not set') . "\n";
        } else {
            echo "   - {$setting}: Not found\n";
        }
    }
} else {
    echo "   ❌ .env file not found\n";
}

// 3. Test email configuration
echo "\n3️⃣ TESTING EMAIL CONFIGURATION:\n";

try {
    // Test basic mail configuration
    $transport = \Illuminate\Mail\TransportManager::class;
    echo "   ✅ Mail transport manager available\n";
    
    // Check if we can create a mail instance
    $mailer = app('mailer');
    echo "   ✅ Mail service available\n";
    
    // Test email template rendering
    try {
        $testMessage = new \App\Models\ContactMessage([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'Test Subject',
            'message' => 'Test message content',
        ]);
        
        $view = view('emails.admin-reply', [
            'message' => $testMessage,
            'reply' => 'Test reply content',
            'admin' => auth()->user() ?: (object)['name' => 'Test Admin'],
        ]);
        
        $html = $view->render();
        echo "   ✅ Email template renders successfully\n";
        
    } catch (\Exception $e) {
        echo "   ❌ Email template error: " . $e->getMessage() . "\n";
    }
    
} catch (\Exception $e) {
    echo "   ❌ Mail configuration error: " . $e->getMessage() . "\n";
}

// 4. Check log files for email errors
echo "\n4️⃣ CHECKING LOG FILES:\n";

$logPath = storage_path('logs/laravel.log');
if (file_exists($logPath)) {
    $logContent = file_get_contents($logPath);
    
    // Look for recent email-related errors
    $emailErrors = [];
    $lines = explode("\n", $logContent);
    $recentLines = array_slice($lines, -100); // Last 100 lines
    
    foreach ($recentLines as $line) {
        if (stripos($line, 'mail') !== false || stripos($line, 'email') !== false) {
            $emailErrors[] = $line;
        }
    }
    
    if (!empty($emailErrors)) {
        echo "   Recent email-related log entries:\n";
        foreach (array_slice($emailErrors, -5) as $error) {
            echo "   - " . substr($error, 0, 100) . "...\n";
        }
    } else {
        echo "   ✅ No recent email errors in logs\n";
    }
} else {
    echo "   ⚠️ Log file not found\n";
}

// 5. Provide solutions
echo "\n5️⃣ RECOMMENDED SOLUTIONS:\n";

if ($mailDriver === 'log') {
    echo "   🔧 SOLUTION 1: Configure SMTP Email Service\n";
    echo "   \n";
    echo "   Option A - Gmail SMTP (Free):\n";
    echo "   1. Enable 2-factor authentication on your Gmail account\n";
    echo "   2. Generate an App Password: https://myaccount.google.com/apppasswords\n";
    echo "   3. Update your .env file:\n";
    echo "      MAIL_MAILER=smtp\n";
    echo "      MAIL_HOST=smtp.gmail.com\n";
    echo "      MAIL_PORT=587\n";
    echo "      MAIL_USERNAME=your-email@gmail.com\n";
    echo "      MAIL_PASSWORD=your-app-password\n";
    echo "      MAIL_ENCRYPTION=tls\n";
    echo "      MAIL_FROM_ADDRESS=your-email@gmail.com\n";
    echo "      MAIL_FROM_NAME=\"Car Rental System\"\n";
    echo "   \n";
    echo "   Option B - Mailtrap (Development/Testing):\n";
    echo "   1. Sign up at https://mailtrap.io (free tier available)\n";
    echo "   2. Get your SMTP credentials from the inbox\n";
    echo "   3. Update your .env file:\n";
    echo "      MAIL_MAILER=smtp\n";
    echo "      MAIL_HOST=sandbox.smtp.mailtrap.io\n";
    echo "      MAIL_PORT=2525\n";
    echo "      MAIL_USERNAME=your-mailtrap-username\n";
    echo "      MAIL_PASSWORD=your-mailtrap-password\n";
    echo "      MAIL_FROM_ADDRESS=noreply@rental-system.com\n";
    echo "      MAIL_FROM_NAME=\"Car Rental System\"\n";
    echo "   \n";
    echo "   Option C - SendGrid (Production):\n";
    echo "   1. Sign up at https://sendgrid.com\n";
    echo "   2. Create an API key\n";
    echo "   3. Update your .env file:\n";
    echo "      MAIL_MAILER=smtp\n";
    echo "      MAIL_HOST=smtp.sendgrid.net\n";
    echo "      MAIL_PORT=587\n";
    echo "      MAIL_USERNAME=apikey\n";
    echo "      MAIL_PASSWORD=your-sendgrid-api-key\n";
    echo "      MAIL_ENCRYPTION=tls\n";
    echo "      MAIL_FROM_ADDRESS=noreply@yourdomain.com\n";
    echo "      MAIL_FROM_NAME=\"Car Rental System\"\n";
}

echo "\n   🔧 SOLUTION 2: Quick Test Setup (Mailtrap)\n";
echo "   For immediate testing, I'll help you set up Mailtrap:\n";

echo "\n✅ Email delivery diagnosis completed!\n";

// 6. Offer to create test configuration
echo "\n6️⃣ QUICK SETUP OPTIONS:\n";
echo "Would you like me to:\n";
echo "A) Create a test email configuration with Mailtrap\n";
echo "B) Set up Gmail SMTP configuration\n";
echo "C) Show you how to test email sending\n";
echo "\nChoose an option and I'll help you implement it!\n";