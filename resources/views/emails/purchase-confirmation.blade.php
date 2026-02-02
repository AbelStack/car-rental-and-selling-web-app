<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() === 'am' ? 'የግዢ ማረጋገጫ' : 'Purchase Confirmation' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 30px;
        }
        .success-badge {
            background-color: #10b981;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .vehicle-info {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #2563eb;
        }
        .vehicle-image {
            width: 100%;
            max-width: 200px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }
        .info-item {
            padding: 10px;
            background-color: #f8fafc;
            border-radius: 6px;
        }
        .info-label {
            font-weight: bold;
            color: #374151;
            font-size: 14px;
        }
        .info-value {
            color: #1f2937;
            font-size: 16px;
            margin-top: 5px;
        }
        .price-summary {
            background-color: #ecfdf5;
            border: 1px solid #10b981;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .price-total {
            border-top: 2px solid #10b981;
            padding-top: 10px;
            font-weight: bold;
            font-size: 18px;
        }
        .next-steps {
            background-color: #eff6ff;
            border: 1px solid #2563eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .next-steps h3 {
            color: #1d4ed8;
            margin-top: 0;
        }
        .next-steps ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin-bottom: 8px;
        }
        .contact-info {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            background-color: #374151;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #60a5fa;
            text-decoration: none;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .price-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🚗 {{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ግዢ ማረጋገጫ' : 'Vehicle Purchase Confirmation' }}</h1>
            <p>{{ app()->getLocale() === 'am' ? 'እንኳን ደስ አለዎት! ግዢዎ በተሳካ ሁኔታ ተጠናቅቋል።' : 'Congratulations! Your purchase has been completed successfully.' }}</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Success Badge -->
            <div class="success-badge">
                ✅ {{ app()->getLocale() === 'am' ? 'ክፍያ ተሳክቷል' : 'Payment Successful' }}
            </div>

            <!-- Greeting -->
            <h2>{{ app()->getLocale() === 'am' ? 'ውድ' : 'Dear' }} {{ $purchase->user->name }},</h2>
            <p>
                {{ app()->getLocale() === 'am' ? 'የእርስዎ የተሽከርካሪ ግዢ በተሳካ ሁኔታ ተጠናቅቋል። ዝርዝሮቹ ከዚህ በታች ይገኛሉ:' : 'Your vehicle purchase has been completed successfully. Here are the details:' }}
            </p>

            <!-- Vehicle Information -->
            <div class="vehicle-info">
                <h3>{{ app()->getLocale() === 'am' ? 'የተገዛ ተሽከርካሪ' : 'Purchased Vehicle' }}</h3>
                @if($purchase->vehicle->primary_image)
                    <img src="{{ $purchase->vehicle->primary_image }}" alt="{{ $purchase->vehicle->full_name }}" class="vehicle-image">
                @endif
                <h4>{{ $purchase->vehicle->full_name }}</h4>
                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">{{ app()->getLocale() === 'am' ? 'አመት' : 'Year' }}</div>
                        <div class="info-value">{{ $purchase->vehicle->year }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">{{ app()->getLocale() === 'am' ? 'ሞዴል' : 'Model' }}</div>
                        <div class="info-value">{{ $purchase->vehicle->model }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">{{ app()->getLocale() === 'am' ? 'ማይሌጅ' : 'Mileage' }}</div>
                        <div class="info-value">{{ number_format($purchase->vehicle->mileage) }} km</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">{{ app()->getLocale() === 'am' ? 'ሁኔታ' : 'Condition' }}</div>
                        <div class="info-value">{{ ucfirst($purchase->vehicle->condition) }}</div>
                    </div>
                </div>
            </div>

            <!-- Purchase Details -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">{{ app()->getLocale() === 'am' ? 'የግዢ ማጣቀሻ' : 'Purchase Reference' }}</div>
                    <div class="info-value">{{ $purchase->purchase_reference }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">{{ app()->getLocale() === 'am' ? 'የግዢ ቀን' : 'Purchase Date' }}</div>
                    <div class="info-value">{{ $purchase->created_at->format('M d, Y') }}</div>
                </div>
            </div>

            <!-- Price Summary -->
            <div class="price-summary">
                <h3>{{ app()->getLocale() === 'am' ? 'የዋጋ ማጠቃለያ' : 'Price Summary' }}</h3>
                
                <div class="price-row">
                    <span>{{ app()->getLocale() === 'am' ? 'የተሽከርካሪ ዋጋ:' : 'Vehicle Price:' }}</span>
                    <span>${{ number_format($purchase->purchase_price, 2) }}</span>
                </div>
                
                @if($purchase->discount_amount > 0)
                <div class="price-row" style="color: #10b981;">
                    <span>{{ app()->getLocale() === 'am' ? 'ቅናሽ' : 'Discount' }} ({{ $purchase->discount_percentage }}%):</span>
                    <span>-${{ number_format($purchase->discount_amount, 2) }}</span>
                </div>
                @endif
                
                <div class="price-row">
                    <span>{{ app()->getLocale() === 'am' ? 'ታክስ (15%):' : 'Tax (15%):' }}</span>
                    <span>${{ number_format($purchase->tax_amount, 2) }}</span>
                </div>
                
                <div class="price-row price-total">
                    <span>{{ app()->getLocale() === 'am' ? 'ጠቅላላ መጠን:' : 'Total Amount:' }}</span>
                    <span>${{ number_format($purchase->total_amount, 2) }}</span>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>{{ app()->getLocale() === 'am' ? 'ቀጣይ እርምጃዎች' : 'Next Steps' }}</h3>
                <ul>
                    @if(app()->getLocale() === 'am')
                        <li>የእኛ ቡድን በ24 ሰዓት ውስጥ ያገኝዎታል</li>
                        <li>የተሽከርካሪ ሰነዶች ይዘጋጃሉ</li>
                        <li>የመረከቢያ ቀጠሮ ይይዛል</li>
                        <li>የመጨረሻ ፍተሻ እና ማረጋገጫ ይደረጋል</li>
                        <li>ሁሉም ሰነዶች በማረከቢያ ጊዜ ይሰጣሉ</li>
                    @else
                        <li>Our team will contact you within 24 hours</li>
                        <li>Vehicle documents will be prepared</li>
                        <li>Delivery appointment will be scheduled</li>
                        <li>Final inspection and verification will be conducted</li>
                        <li>All documents will be provided at pickup</li>
                    @endif
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h3>{{ app()->getLocale() === 'am' ? 'ያግኙን' : 'Contact Us' }}</h3>
                <p>
                    {{ app()->getLocale() === 'am' ? 'ጥያቄ ካለዎት ወይም እርዳታ ከፈለጉ:' : 'If you have any questions or need assistance:' }}
                </p>
                <p>
                    <strong>{{ app()->getLocale() === 'am' ? 'ኢሜይል:' : 'Email:' }}</strong> support@addisdrive.com<br>
                    <strong>{{ app()->getLocale() === 'am' ? 'ስልክ:' : 'Phone:' }}</strong> +251-911-123456<br>
                    <strong>{{ app()->getLocale() === 'am' ? 'ሰዓት:' : 'Hours:' }}</strong> {{ app()->getLocale() === 'am' ? 'ሰኞ - ቅዳሜ, 8:00 AM - 6:00 PM' : 'Monday - Saturday, 8:00 AM - 6:00 PM' }}
                </p>
            </div>

            <p>
                {{ app()->getLocale() === 'am' ? 'እንደገና እንኳን ደስ አለዎት! የእኛን አገልግሎት ስለመረጡ እናመሰግናለን።' : 'Congratulations again! Thank you for choosing our service.' }}
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                {{ app()->getLocale() === 'am' ? 'ይህ ኢሜይል በራስ-ሰር የተላከ ነው። እባክዎ ምላሽ አይስጡ።' : 'This email was sent automatically. Please do not reply.' }}<br>
                © {{ date('Y') }} Addis Drive Vehicle Services. {{ app()->getLocale() === 'am' ? 'ሁሉም መብቶች የተጠበቁ ናቸው።' : 'All rights reserved.' }}
            </p>
        </div>
    </div>
</body>
</html>