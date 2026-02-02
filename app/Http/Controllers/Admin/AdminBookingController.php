<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'vehicle.images', 'payment']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by vehicle
        if ($request->filled('vehicle')) {
            $query->where('vehicle_id', $request->vehicle);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('pickup_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('return_date', '<=', $request->end_date);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'vehicle.images', 'payment']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Request $request, Booking $booking)
    {
        if ($booking->status !== 'pending_approval') {
            return back()->with('error', 'Booking cannot be approved in its current status.');
        }

        $oldStatus = $booking->status;
        $booking->update([
            'status' => 'confirmed',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        AuditLog::log('booking_approved', $booking, ['status' => $oldStatus], ['status' => 'confirmed']);

        return back()->with('success', 'Booking approved successfully.');
    }

    public function reject(Request $request, Booking $booking)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        if (!in_array($booking->status, ['pending_approval', 'confirmed'])) {
            return back()->with('error', 'Booking cannot be rejected in its current status.');
        }

        $oldStatus = $booking->status;
        $booking->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'rejected_by' => auth()->id(),
            'rejected_at' => now(),
        ]);

        AuditLog::log('booking_rejected', $booking, ['status' => $oldStatus], ['status' => 'rejected']);

        return back()->with('success', 'Booking rejected successfully.');
    }
}
