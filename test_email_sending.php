<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "📧 Testing Email Configuration...\n\n";

// 1. Check current configuration
echo "1️⃣ CURRENT EMAIL CONFIGURATION:\n";

$mailDriver = config('mail.default');
$mailHost = config('mail.mailers.smtp.host');
$mailPort = config('mail.mailers.smtp.port');
$mailUsername = config('mail.mailers.smtp.username');
$mailFromAddress = config('mail.from.address');

echo "   - Driver: {$mailDriver}\n";
echo "   - Host: {$mailHost}\n";
echo "   - Port: {$mailPort}\n";
echo "   - Username: " . ($mailUsername ?: 'Not set') . "\n";
echo "   - From Address: {$mailFromAddress}\n";

// 2. Test email template rendering
echo "\n2️⃣ TESTING EMAIL TEMPLATE:\n";

try {
    $testMessage = \App\Models\ContactMessage::first();
    
    if (!$testMessage) {
        // Create a test message
        $testMessage = new \App\Models\ContactMessage([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
            'created_at' => now(),
        ]);
    }
    
    $testAdmin = (object)['name' => 'Test Admin'];
    
    $view = view('emails.admin-reply', [
        'message' => $testMessage,
        'reply' => 'This is a test reply message.',
        'admin' => $testAdmin,
    ]);
    
    $html = $view->render();
    
    echo "   ✅ Email template renders successfully\n";
    echo "   - Template size: " . strlen($html) . " characters\n";
    echo "   - Contains reply: " . (strpos($html, 'test reply') !== false ? 'Yes' : 'No') . "\n";
    
} catch (\Exception $e) {
    echo "   ❌ Template error: " . $e->getMessage() . "\n";
}

// 3. Test mail service availability
echo "\n3️⃣ TESTING MAIL SERVICE:\n";

try {
    $mailer = app('mailer');
    echo "   ✅ Mail service is available\n";
    
    // Test if we can create a mail message
    $message = new \Illuminate\Mail\Message(
        new \Swift_Message()
    );
    echo "   ✅ Can create mail messages\n";
    
} catch (\Exception $e) {
    echo "   ❌ Mail service error: " . $e->getMessage() . "\n";
}

// 4. Configuration recommendations
echo "\n4️⃣ CONFIGURATION STATUS:\n";

if ($mailDriver === 'log') {
    echo "   ⚠️ WARNING: Still using 'log' driver - emails won't be sent\n";
    echo "   🔧 Solution: Update MAIL_MAILER in .env to 'smtp'\n";
} elseif ($mailDriver === 'smtp') {
    echo "   ✅ Using SMTP driver\n";
    
    if ($mailUsername === 'your-mailtrap-username' || $mailUsername === 'your-email@gmail.com') {
        echo "   ⚠️ WARNING: Using placeholder credentials\n";
        echo "   🔧 Solution: Update MAIL_USERNAME and MAIL_PASSWORD in .env\n";
    } else {
        echo "   ✅ SMTP credentials configured\n";
    }
}

// 5. Provide next steps
echo "\n5️⃣ NEXT STEPS:\n";

if ($mailDriver === 'smtp' && $mailUsername && $mailUsername !== 'your-mailtrap-username') {
    echo "   ✅ Configuration looks good!\n";
    echo "   📧 Try sending an admin reply to test email delivery\n";
    echo "   📝 Check your email service dashboard for delivery status\n";
} else {
    echo "   🔧 Complete email setup:\n";
    
    if ($mailHost === 'sandbox.smtp.mailtrap.io') {
        echo "   \n   FOR MAILTRAP (Testing):\n";
        echo "   1. Sign up at https://mailtrap.io\n";
        echo "   2. Get your inbox credentials\n";
        echo "   3. Update .env file:\n";
        echo "      MAIL_USERNAME=your-actual-mailtrap-username\n";
        echo "      MAIL_PASSWORD=your-actual-mailtrap-password\n";
    } elseif ($mailHost === 'smtp.gmail.com') {
        echo "   \n   FOR GMAIL:\n";
        echo "   1. Enable 2-Factor Authentication\n";
        echo "   2. Generate App Password at: https://myaccount.google.com/apppasswords\n";
        echo "   3. Update .env file:\n";
        echo "      MAIL_USERNAME=your-email@gmail.com\n";
        echo "      MAIL_PASSWORD=your-16-char-app-password\n";
        echo "      MAIL_FROM_ADDRESS=your-email@gmail.com\n";
    } else {
        echo "   \n   GENERAL SETUP:\n";
        echo "   1. Choose an email service (Gmail, Mailtrap, SendGrid)\n";
        echo "   2. Get SMTP credentials\n";
        echo "   3. Update .env file with actual credentials\n";
    }
    
    echo "   4. Run: php artisan config:clear\n";
    echo "   5. Test admin reply functionality\n";
}

echo "\n✅ Email configuration test completed!\n";

// 6. Show current .env mail settings
echo "\n6️⃣ CURRENT .ENV MAIL SETTINGS:\n";

$envPath = base_path('.env');
if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    $mailLines = [];
    
    foreach (explode("\n", $envContent) as $line) {
        if (strpos($line, 'MAIL_') === 0) {
            // Hide password for security
            if (strpos($line, 'MAIL_PASSWORD=') === 0) {
                $mailLines[] = 'MAIL_PASSWORD=[hidden]';
            } else {
                $mailLines[] = $line;
            }
        }
    }
    
    foreach ($mailLines as $line) {
        echo "   {$line}\n";
    }
} else {
    echo "   ❌ .env file not found\n";
}

echo "\n📋 SUMMARY:\n";
echo "- Email template: " . (isset($html) && strlen($html) > 1000 ? "✅ Working" : "❌ Issues") . "\n";
echo "- Mail service: " . (isset($mailer) ? "✅ Available" : "❌ Issues") . "\n";
echo "- SMTP driver: " . ($mailDriver === 'smtp' ? "✅ Configured" : "❌ Not configured") . "\n";
echo "- Credentials: " . ($mailUsername && !in_array($mailUsername, ['your-mailtrap-username', 'your-email@gmail.com']) ? "✅ Set" : "❌ Placeholder") . "\n";

if ($mailDriver === 'smtp' && $mailUsername && !in_array($mailUsername, ['your-mailtrap-username', 'your-email@gmail.com'])) {
    echo "\n🎉 Email system is ready! Try sending an admin reply.\n";
} else {
    echo "\n⚠️ Email system needs configuration. Follow the steps above.\n";
}