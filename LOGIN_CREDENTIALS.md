# 🔐 LOGIN CREDENTIALS - Car Rental & Sales System

## 👥 Test User Accounts

The system has **3 pre-configured test accounts** with different access levels:

---

## 🔴 SUPER ADMINISTRATOR
**Full system access with all permissions**

- **Email**: `superadmin@rental.com`
- **Password**: `password123`
- **Name**: Super Administrator
- **Phone**: +251911000000
- **Role**: Super Admin
- **Access Level**: Complete system control

### Super Admin Capabilities:
- ✅ Manage all users and roles
- ✅ Full vehicle management (add, edit, delete)
- ✅ View and manage all bookings
- ✅ Payment verification and management
- ✅ System reports and analytics
- ✅ Contact message management
- ✅ Audit log access
- ✅ System configuration

---

## 🟡 ADMINISTRATOR
**Administrative access with most permissions**

- **Email**: `admin@rental.com`
- **Password**: `password123`
- **Name**: Administrator
- **Phone**: +251911000001
- **Role**: Admin
- **Access Level**: Administrative functions

### Admin Capabilities:
- ✅ Manage vehicles (add, edit, delete)
- ✅ View and manage bookings
- ✅ Payment verification
- ✅ Basic reports
- ✅ Contact message management
- ❌ Cannot manage other admin users
- ❌ Limited system configuration access

---

## 🟢 TEST CUSTOMER
**Standard customer account**

- **Email**: `customer@test.com`
- **Password**: `password123`
- **Name**: Test Customer
- **Phone**: +251911000002
- **Role**: Customer
- **Access Level**: Customer functions only

### Customer Capabilities:
- ✅ Browse vehicles for rent and sale
- ✅ Make rental bookings
- ✅ Purchase vehicles
- ✅ View personal dashboard
- ✅ Manage personal profile
- ✅ View booking/purchase history
- ✅ Submit contact messages
- ❌ No administrative access

---

## 🚀 How to Login

### Step 1: Access Login Page
Navigate to: `http://localhost/rental-project/public/login`

### Step 2: Enter Credentials
Choose one of the accounts above and enter:
- Email address
- Password: `password123`

### Step 3: Access Dashboard
After login, you'll be redirected to the appropriate dashboard:
- **Super Admin/Admin**: Admin dashboard with management tools
- **Customer**: Customer dashboard with personal information

---

## 🔗 Quick Access Links

### Public Pages
- **Home**: `http://localhost/rental-project/public/`
- **Login**: `http://localhost/rental-project/public/login`
- **Register**: `http://localhost/rental-project/public/register`
- **Rent Cars**: `http://localhost/rental-project/public/rent`
- **Buy Cars**: `http://localhost/rental-project/public/buy`
- **Contact**: `http://localhost/rental-project/public/contact`

### After Login (Protected Pages)
- **Customer Dashboard**: `http://localhost/rental-project/public/dashboard`
- **Admin Dashboard**: `http://localhost/rental-project/public/admin`

---

## 🛡️ Security Notes

### Password Security
- All passwords are hashed using Laravel's secure bcrypt hashing
- Default password is `password123` for all test accounts
- **Recommendation**: Change passwords in production environment

### Account Status
- All test accounts are **active** and **email verified**
- No additional verification steps required
- Ready for immediate use

### Role Permissions
- Roles are enforced through middleware
- Unauthorized access attempts are blocked
- Audit logging tracks all user activities

---

## 🧪 Testing Scenarios

### Customer Testing
1. **Login as customer** (`customer@test.com`)
2. **Browse vehicles** on rent/buy pages
3. **Make a booking** for a rental vehicle
4. **View dashboard** to see booking history
5. **Update profile** information

### Admin Testing
1. **Login as admin** (`admin@rental.com`)
2. **Access admin dashboard**
3. **Manage vehicles** (add/edit/delete)
4. **View bookings** and payments
5. **Verify payments** from customers

### Super Admin Testing
1. **Login as super admin** (`superadmin@rental.com`)
2. **Access full admin panel**
3. **Manage users** and roles
4. **View system reports**
5. **Check audit logs**

---

## 🔄 Password Reset (If Needed)

If you need to reset any password, run this command in the project directory:

```bash
php artisan tinker
```

Then execute:
```php
$user = App\Models\User::where('email', 'superadmin@rental.com')->first();
$user->password = Hash::make('newpassword');
$user->save();
```

Replace `'superadmin@rental.com'` with the desired email and `'newpassword'` with your new password.

---

## ✅ Verification

To verify the accounts exist, you can check the verification page:
`http://localhost/rental-project/public/final-verification.php`

This page shows:
- ✅ Database connection status
- ✅ Number of users in system
- ✅ Application functionality test

---

**Created**: December 22, 2025  
**Status**: Ready for Use ✅  
**Security**: Properly Hashed Passwords 🔐