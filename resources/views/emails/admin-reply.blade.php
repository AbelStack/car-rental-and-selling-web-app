<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Message</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2563EB 0%, #1E40AF 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .original-message {
            background-color: #f1f5f9;
            border-left: 4px solid #2563EB;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .original-message h3 {
            margin: 0 0 10px 0;
            color: #1e40af;
            font-size: 16px;
        }
        .reply-section {
            margin: 30px 0;
        }
        .reply-section h3 {
            color: #059669;
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .reply-content {
            background-color: #f0fdf4;
            border-left: 4px solid #059669;
            padding: 20px;
            border-radius: 0 8px 8px 0;
            white-space: pre-wrap;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px 30px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }
        .contact-info {
            margin: 20px 0;
            padding: 15px;
            background-color: #fef3c7;
            border-radius: 6px;
            border-left: 4px solid #f59e0b;
        }
        .contact-info h4 {
            margin: 0 0 10px 0;
            color: #92400e;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2563EB;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 10px 0;
        }
        .btn:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reply to Your Message</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Addis Drive Vehicle Services</p>
        </div>
        
        <div class="content">
            <p>Dear {{ $contactMessage->name }},</p>
            
            <p>Thank you for contacting us. We have reviewed your message and are pleased to provide you with the following response:</p>
            
            <div class="reply-section">
                <h3>Our Response:</h3>
                <div class="reply-content">{{ $reply }}</div>
            </div>
            
            <div class="original-message">
                <h3>Your Original Message:</h3>
                <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
                <p><strong>Sent:</strong> {{ $contactMessage->created_at ? $contactMessage->created_at->format('M d, Y \a\t g:i A') : 'Recently' }}</p>
                <div style="margin-top: 15px; white-space: pre-wrap;">{{ $contactMessage->message }}</div>
            </div>
            
            <div class="contact-info">
                <h4>Need Further Assistance?</h4>
                <p>If you have any additional questions or need further clarification, please don't hesitate to contact us:</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Email: {{ config('mail.from.address') }}</li>
                    <li>Website: {{ config('app.url') }}</li>
                </ul>
            </div>
            
            <p style="margin-top: 30px;">
                <a href="{{ config('app.url') }}" class="btn">Visit Our Website</a>
            </p>
            
            <p>Best regards,<br>
            <strong>{{ $admin->name ?? 'Customer Support Team' }}</strong><br>
            Addis Drive Vehicle Services</p>
        </div>
        
        <div class="footer">
            <p>This email was sent in response to your inquiry submitted on {{ $contactMessage->created_at ? $contactMessage->created_at->format('M d, Y') : 'recently' }}.</p>
            <p>© {{ date('Y') }} Addis Drive Vehicle Services. All rights reserved.</p>
        </div>
    </div>
</body>
</html>