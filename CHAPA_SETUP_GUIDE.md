# Chapa Payment Setup Guide

## Quick Setup Instructions

### 1. Get Chapa API Keys

1. **Visit Chapa Dashboard**: Go to https://dashboard.chapa.co/
2. **Create Account**: Sign up for a business account
3. **Complete Verification**: Provide required business documents
4. **Get API Keys**: Navigate to API Keys section and copy:
   - Test Public Key (starts with `CHASECK_TEST-`)
   - Test Secret Key (starts with `CHASECK_TEST-`)

### 2. Update Environment Variables

Replace the placeholder values in your `.env` file:

```env
# Replace these placeholder values with your real Chapa keys
CHAPA_PUBLIC_KEY=CHASECK_TEST-your-actual-public-key-from-dashboard
CHAPA_SECRET_KEY=CHASECK_TEST-your-actual-secret-key-from-dashboard
CHAPA_WEBHOOK_SECRET=create-a-random-secret-for-webhook-verification
```

### 3. Configure Webhooks

1. In Chapa dashboard, go to Webhooks section
2. Add webhook URL: `https://yourdomain.com/chapa/callback`
3. Set the webhook secret (same as CHAPA_WEBHOOK_SECRET in .env)

### 4. Test the Integration

Run the test script to verify everything works:

```bash
php test_chapa_payment.php
```

Expected output with real keys:
```
✓ Chapa API call successful
✓ Checkout URL: https://checkout.chapa.co/checkout/...
```

### 5. Test Payment Flow

1. Create a purchase by clicking "Buy Now" on any vehicle
2. Click "Pay with Chapa" button
3. Complete test payment on Chapa checkout page
4. Verify purchase status updates to "paid"

## Production Setup

For production environment:

1. Get production API keys from Chapa dashboard
2. Update `.env` with production keys (remove `_TEST` from key names)
3. Set `APP_ENV=production` in `.env`
4. Configure production webhook URL
5. Test thoroughly before going live

![alt text](image.png)## Troubleshooting

### Common Issues:

1. **"Invalid API Key" Error**
   - Verify keys are copied correctly from dashboard
   - Ensure no extra spaces or characters
   - Check if business account is verified

2. **Webhook Not Working**
   - Verify webhook URL is accessible publicly
   - Check webhook secret matches .env value
   - Ensure HTTPS is used for production

3. **Payment Stuck in Pending**
   - Check webhook delivery in Chapa dashboard
   - Verify callback endpoint is working
   - Use status check to manually verify payment

## Support

- Chapa Documentation: https://developer.chapa.co/
- Chapa Support: support@chapa.co
- Test Cards: Available in Chapa documentation

## Security Notes

- Never commit real API keys to version control
- Use different keys for development and production
- Regularly rotate webhook secrets
- Monitor payment logs for suspicious activity