# KYC Verification Process - Complete Guide

## 🔄 **The 3-Attempt Verification System**

### **How It Works:**

1. **First Attempt (Attempt 1/3)**
   - User submits KYC documents for the first time
   - Status becomes "Pending"
   - Admin reviews the submission

2. **Second Attempt (Attempt 2/3)** 
   - If first attempt is rejected, user can resubmit
   - User sees "2 remaining verification attempts"
   - Must address the rejection reasons from admin feedback

3. **Third Attempt (Attempt 3/3)**
   - Final chance if second attempt is also rejected
   - User sees "1 remaining verification attempt"
   - Last opportunity before manual intervention required

4. **After 3 Failed Attempts**
   - User cannot submit more KYC verifications automatically
   - Must contact customer support for manual review
   - Support can reset attempts if needed

### **Code Logic:**
```php
// In User model
public function canSubmitKyc(): bool
{
    return in_array($this->kyc_status, ['unverified', 'rejected']) && $this->kyc_attempts < 3;
}
```

## 👨‍💼 **Who Gives Approval - Admin Process**

### **Admin Users Who Can Approve:**
- **Super Admin**: Full access to all KYC verifications
- **Admin**: Can approve/reject KYC submissions
- **Access**: Through `/admin/kyc` panel

### **Admin Approval Workflow:**

#### **Step 1: Admin Reviews Submission**
- Admin logs into admin panel (`/admin`)
- Goes to KYC Verifications section (`/admin/kyc`)
- Sees list of all pending KYC submissions

#### **Step 2: Document Review**
- Admin clicks "View" to see full KYC details
- Reviews uploaded documents:
  - **National ID/Passport** (front and back)
  - **Selfie photo** for identity matching
  - **Personal information** (name, DOB, address, etc.)

#### **Step 3: Decision Making**
Admin has two options:

**✅ APPROVE:**
- Clicks "Approve" button
- System automatically:
  - Sets KYC status to "verified"
  - Enables booking permissions (`can_book = true`)
  - Enables purchase permissions (`can_purchase = true`)
  - Sets verification level to 3 (KYC Verified)
  - Sets expiry date (1 year from approval)

**❌ REJECT:**
- Clicks "Reject" button
- Must provide rejection reason (required)
- Common rejection reasons:
  - "Document image is blurry or unclear"
  - "Selfie doesn't match ID photo"
  - "Document appears to be expired"
  - "Information doesn't match between documents"
  - "Document appears to be tampered with"

## 📊 **KYC Status Flow**

```
User Registration
       ↓
   Unverified (0 attempts)
       ↓
   Submits KYC (Attempt 1)
       ↓
    Pending Review
       ↓
   Admin Decision
       ↓
   ┌─────────────┬─────────────┐
   ↓             ↓             ↓
Approved      Rejected     Under Review
   ↓             ↓             ↓
Verified    Can Resubmit   More Info Needed
           (Attempt 2/3)
```

## 🔐 **Security & Permissions**

### **Before KYC Approval:**
- ❌ Cannot book vehicles
- ❌ Cannot purchase vehicles  
- ✅ Can browse vehicles
- ✅ Can view prices and details

### **After KYC Approval:**
- ✅ Can book vehicles for rent
- ✅ Can purchase vehicles
- ✅ Can make payments through Chapa
- ✅ Full access to all features

## 📋 **Admin Panel Features**

### **KYC Management Dashboard:**
1. **List View**: All KYC submissions with status
2. **Filter Options**: By status, document type, date
3. **Quick Actions**: Approve/Reject from list view
4. **Detailed View**: Full document review page
5. **Document Download**: Secure access to uploaded files
6. **Audit Trail**: Complete history of all actions

### **Admin Capabilities:**
- View all user KYC submissions
- Download and review documents securely
- Approve verifications with one click
- Reject with detailed feedback
- Track verification history
- Generate KYC reports

## 🚨 **What Happens After 3 Failed Attempts**

When a user exhausts all 3 attempts:

1. **System Behavior:**
   - `canSubmitKyc()` returns `false`
   - KYC submission form is disabled
   - User sees message: "KYC verification attempts exhausted"

2. **User Options:**
   - Contact customer support
   - Submit support ticket through system
   - Provide additional documentation

3. **Admin Resolution:**
   - Admin can manually reset attempt counter
   - Admin can approve KYC after manual review
   - Support team can assist with document quality

## 📞 **Support Process**

The system includes a built-in support ticket system:
- Users can create support tickets
- Admins receive notifications
- Ticket tracking and responses
- File attachments for additional documents

## 🎯 **Best Practices for Users**

### **To Avoid Rejection:**
1. **Clear Photos**: Ensure documents are well-lit and in focus
2. **Complete Documents**: Submit both front and back of ID
3. **Matching Selfie**: Take clear selfie that matches ID photo
4. **Accurate Information**: Double-check all entered details
5. **Valid Documents**: Ensure documents are not expired

### **If Rejected:**
1. **Read Feedback**: Carefully review admin's rejection reason
2. **Fix Issues**: Address specific problems mentioned
3. **Retake Photos**: Use better lighting/camera if needed
4. **Verify Information**: Ensure all details match documents
5. **Resubmit**: Use remaining attempts wisely

---

**The system is designed to be secure, user-friendly, and compliant with KYC regulations while providing multiple chances for users to successfully verify their identity.**