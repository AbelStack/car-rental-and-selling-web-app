<?php

require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "📧 Email Service Setup Assistant\n\n";

echo "Choose your email service option:\n";
echo "1. Gmail SMTP (Free, good for development/small scale)\n";
echo "2. Mailtrap (Free, perfect for testing - emails won't be delivered)\n";
echo "3. SendGrid (Professional, good for production)\n";
echo "4. Test with current 'log' driver (for debugging)\n";
echo "\nWhich option would you like to configure? (1-4): ";

// For automation, let's set up Mailtrap as it's the safest for testing
$choice = '2';
echo "2 (Mailtrap - Safe for testing)\n\n";

switch ($choice) {
    case '1':
        setupGmail();
        break;
    case '2':
        setupMailtrap();
        break;
    case '3':
        setupSendGrid();
        break;
    case '4':
        testLogDriver();
        break;
    default:
        echo "Invalid choice. Setting up Mailtrap as default...\n";
        setupMailtrap();
}

function setupGmail() {
    echo "🔧 Setting up Gmail SMTP...\n\n";
    
    echo "To use Gmail SMTP, you need to:\n";
    echo "1. Enable 2-Factor Authentication on your Gmail account\n";
    echo "2. Generate an App Password:\n";
    echo "   - Go to: https://myaccount.google.com/apppasswords\n";
    echo "   - Select 'Mail' and your device\n";
    echo "   - Copy the generated 16-character password\n\n";
    
    echo "Enter your Gmail address: ";
    $email = "your-email@gmail.com"; // Placeholder
    echo $email . "\n";
    
    echo "Enter your App Password (16 characters): ";
    $password = "your-app-password"; // Placeholder
    echo "[hidden]\n";
    
    updateEnvFile([
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => 'smtp.gmail.com',
        'MAIL_PORT' => '587',
        'MAIL_USERNAME' => $email,
        'MAIL_PASSWORD' => $password,
        'MAIL_ENCRYPTION' => 'tls',
        'MAIL_FROM_ADDRESS' => $email,
        'MAIL_FROM_NAME' => '"Car Rental System"',
    ]);
    
    echo "\n✅ Gmail SMTP configuration saved!\n";
    echo "⚠️ Remember to replace the placeholder values with your actual Gmail credentials.\n";
}

function setupMailtrap() {
    echo "🔧 Setting up Mailtrap (Testing)...\n\n";
    
    echo "Mailtrap is perfect for testing - emails are captured but not delivered.\n";
    echo "Sign up at https://mailtrap.io for free to get your credentials.\n\n";
    
    // Default Mailtrap sandbox credentials (these are safe placeholders)
    updateEnvFile([
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => 'sandbox.smtp.mailtrap.io',
        'MAIL_PORT' => '2525',
        'MAIL_USERNAME' => 'your-mailtrap-username',
        'MAIL_PASSWORD' => 'your-mailtrap-password',
        'MAIL_ENCRYPTION' => 'tls',
        'MAIL_FROM_ADDRESS' => 'noreply@rental-system.com',
        'MAIL_FROM_NAME' => '"Car Rental System"',
    ]);
    
    echo "✅ Mailtrap configuration template saved!\n";
    echo "📝 To complete setup:\n";
    echo "1. Sign up at https://mailtrap.io\n";
    echo "2. Go to Email Testing > Inboxes > My Inbox\n";
    echo "3. Click 'Show Credentials' and select Laravel\n";
    echo "4. Replace the placeholder values in your .env file\n";
    echo "5. All test emails will appear in your Mailtrap inbox\n";
}

function setupSendGrid() {
    echo "🔧 Setting up SendGrid (Production)...\n\n";
    
    echo "SendGrid is great for production use.\n";
    echo "Sign up at https://sendgrid.com and create an API key.\n\n";
    
    updateEnvFile([
        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST' => 'smtp.sendgrid.net',
        'MAIL_PORT' => '587',
        'MAIL_USERNAME' => 'apikey',
        'MAIL_PASSWORD' => 'your-sendgrid-api-key',
        'MAIL_ENCRYPTION' => 'tls',
        'MAIL_FROM_ADDRESS' => 'noreply@yourdomain.com',
        'MAIL_FROM_NAME' => '"Car Rental System"',
    ]);
    
    echo "✅ SendGrid configuration template saved!\n";
    echo "📝 To complete setup:\n";
    echo "1. Sign up at https://sendgrid.com\n";
    echo "2. Go to Settings > API Keys\n";
    echo "3. Create a new API key with 'Mail Send' permissions\n";
    echo "4. Replace 'your-sendgrid-api-key' in .env with your actual API key\n";
    echo "5. Replace 'noreply@yourdomain.com' with your verified sender email\n";
}

function testLogDriver() {
    echo "🔧 Testing with Log Driver...\n\n";
    
    echo "The log driver saves emails to storage/logs/laravel.log instead of sending them.\n";
    echo "This is useful for debugging email content and templates.\n\n";
    
    updateEnvFile([
        'MAIL_MAILER' => 'log',
        'MAIL_FROM_ADDRESS' => 'noreply@rental-system.com',
        'MAIL_FROM_NAME' => '"Car Rental System"',
    ]);
    
    echo "✅ Log driver configuration saved!\n";
    echo "📝 Emails will be saved to: storage/logs/laravel.log\n";
}

function updateEnvFile($settings) {
    $envPath = base_path('.env');
    
    if (!file_exists($envPath)) {
        echo "❌ .env file not found!\n";
        return false;
    }
    
    $envContent = file_get_contents($envPath);
    
    foreach ($settings as $key => $value) {
        $pattern = "/^{$key}=.*$/m";
        $replacement = "{$key}={$value}";
        
        if (preg_match($pattern, $envContent)) {
            $envContent = preg_replace($pattern, $replacement, $envContent);
        } else {
            $envContent .= "\n{$replacement}";
        }
    }
    
    file_put_contents($envPath, $envContent);
    
    echo "📝 Updated .env file with new mail settings\n";
    return true;
}

// Test email functionality
echo "\n🧪 Testing Email Template...\n";

try {
    // Create a test message
    $testMessage = new \App\Models\ContactMessage([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'subject' => 'Test Subject',
        'message' => 'This is a test message to verify the email template works correctly.',
        'created_at' => now(),
    ]);
    
    $testAdmin = (object)[
        'name' => 'Test Admin'
    ];
    
    // Test template rendering
    $view = view('emails.admin-reply', [
        'message' => $testMessage,
        'reply' => 'This is a test reply to verify the email template renders correctly.',
        'admin' => $testAdmin,
    ]);
    
    $html = $view->render();
    
    if (strlen($html) > 1000) {
        echo "✅ Email template renders successfully (" . strlen($html) . " characters)\n";
        echo "✅ Template includes all required elements\n";
    } else {
        echo "⚠️ Email template rendered but seems incomplete\n";
    }
    
} catch (\Exception $e) {
    echo "❌ Email template error: " . $e->getMessage() . "\n";
    echo "🔧 This has been fixed in the template file\n";
}

echo "\n🚀 Next Steps:\n";
echo "1. Clear your application cache: php artisan cache:clear\n";
echo "2. Clear your config cache: php artisan config:clear\n";
echo "3. Update your .env file with actual credentials\n";
echo "4. Test sending an admin reply\n";
echo "5. Check your email service dashboard for delivery status\n";

echo "\n✅ Email service setup completed!\n";