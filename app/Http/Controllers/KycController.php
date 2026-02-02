<?php

namespace App\Http\Controllers;

use App\Models\KycVerification;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KycController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $currentKyc = $user->kycVerifications()->latest()->first();
        
        return view('kyc.index', compact('user', 'currentKyc'));
    }

    public function create()
    {
        $user = auth()->user();
        
        if (!$user->canSubmitKyc()) {
            return redirect()->route('kyc.index')
                ->with('error', 'You cannot submit KYC verification at this time.');
        }

        return view('kyc.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        if (!$user->canSubmitKyc()) {
            return redirect()->route('kyc.index')
                ->with('error', 'You cannot submit KYC verification at this time.');
        }

        $request->validate([
            'document_type' => 'required|in:national_id,passport',
            'document_number' => 'required|string|max:50|unique:kyc_verifications,document_number',
            'document_front' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            'document_back' => 'required_if:document_type,national_id|image|mimes:jpeg,png,jpg|max:5120',
            'selfie' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'),
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:100',
            'document_expiry_date' => 'nullable|date|after:today',
            'place_of_birth' => 'nullable|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        // Store uploaded files
        $documentFrontPath = $request->file('document_front')->store('kyc/documents', 'private');
        $selfiePath = $request->file('selfie')->store('kyc/selfies', 'private');
        
        $documentBackPath = null;
        if ($request->hasFile('document_back')) {
            $documentBackPath = $request->file('document_back')->store('kyc/documents', 'private');
        }

        // Create KYC verification record
        $kyc = KycVerification::create([
            'user_id' => $user->id,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'document_front_path' => $documentFrontPath,
            'document_back_path' => $documentBackPath,
            'selfie_path' => $selfiePath,
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'document_expiry_date' => $request->document_expiry_date,
            'place_of_birth' => $request->place_of_birth,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'region' => $request->region,
            'postal_code' => $request->postal_code,
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'attempt_number' => $user->kyc_attempts + 1,
        ]);

        // Update user KYC status
        $user->update([
            'kyc_status' => 'pending',
            'kyc_attempts' => $user->kyc_attempts + 1,
        ]);

        // Log the action
        AuditLog::log('kyc_submitted', $kyc);

        return redirect()->route('kyc.index')
            ->with('success', 'KYC verification submitted successfully! We will review your documents within 24-48 hours.');
    }

    public function show(KycVerification $kyc)
    {
        if ($kyc->user_id !== auth()->id()) {
            abort(403);
        }

        return view('kyc.show', compact('kyc'));
    }

    public function downloadDocument(KycVerification $kyc, $type)
    {
        if ($kyc->user_id !== auth()->id()) {
            abort(403);
        }

        $path = match($type) {
            'front' => $kyc->document_front_path,
            'back' => $kyc->document_back_path,
            'selfie' => $kyc->selfie_path,
            default => null,
        };

        if (!$path || !Storage::disk('private')->exists($path)) {
            abort(404);
        }

        return Storage::disk('private')->download($path);
    }
}