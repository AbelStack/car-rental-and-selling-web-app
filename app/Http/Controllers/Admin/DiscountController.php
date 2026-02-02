<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountLog;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * Display discount management dashboard
     */
    public function index()
    {
        $discounts = Discount::with(['logs' => function($query) {
            $query->latest()->limit(5);
        }])->orderBy('type')->orderByDesc('created_at')->get();

        $statistics = $this->discountService->getDiscountStatistics();
        
        return view('admin.discounts.index', compact('discounts', 'statistics'));
    }

    /**
     * Show form for creating new discount
     */
    public function create()
    {
        return view('admin.discounts.create');
    }

    /**
     * Store new discount
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|in:holiday,duration',
            'percentage' => 'required|numeric|min:0.01|max:50',
            'applies_to' => 'required|in:rental,selling,both',
            'description' => 'nullable|string|max:500',
            'start_date' => 'required_if:type,holiday|date|after_or_equal:today',
            'end_date' => 'required_if:type,holiday|date|after:start_date',
            'conditions' => 'nullable|array',
            'conditions.*.min_days' => 'required_with:conditions|integer|min:1',
            'conditions.*.max_days' => 'nullable|integer|gt:conditions.*.min_days',
            'conditions.*.percentage' => 'required_with:conditions|numeric|min:0.01|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Additional business validation
        $validationErrors = $this->discountService->validateDiscount($request->all());
        if (!empty($validationErrors)) {
            return redirect()->back()
                ->withErrors($validationErrors)
                ->withInput();
        }

        $discount = Discount::create([
            'name' => $request->name,
            'type' => $request->type,
            'percentage' => $request->percentage,
            'applies_to' => $request->applies_to,
            'start_date' => $request->type === 'holiday' ? $request->start_date : null,
            'end_date' => $request->type === 'holiday' ? $request->end_date : null,
            'description' => $request->description,
            'is_active' => true,
            'conditions' => $request->type === 'duration' ? $request->conditions : null,
        ]);

        // Log the creation
        DiscountLog::logAction(
            $discount->id,
            'created',
            auth()->id(),
            $discount->toArray(),
            "Discount '{$discount->name}' created by " . auth()->user()->name
        );

        return redirect()->route('admin.discounts.index')
            ->with('success', 'Discount created successfully!');
    }

    /**
     * Show discount details
     */
    public function show(Discount $discount)
    {
        $discount->load(['logs.user', 'bookings', 'purchases']);
        
        $recentLogs = $discount->logs()->with('user')->latest()->paginate(10);
        
        $usage_stats = [
            'total_bookings' => $discount->bookings()->count(),
            'total_purchases' => $discount->purchases()->count(),
            'total_discount_given' => $discount->bookings()->sum('discount_amount') + 
                                   $discount->purchases()->sum('discount_amount'),
            'total_revenue_impact' => $discount->bookings()->sum('original_total') + 
                                    $discount->purchases()->sum('original_total'),
        ];

        return view('admin.discounts.show', compact('discount', 'recentLogs', 'usage_stats'));
    }

    /**
     * Show form for editing discount
     */
    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    /**
     * Update discount
     */
    public function update(Request $request, Discount $discount)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0.01|max:50',
            'description' => 'nullable|string|max:500',
            'start_date' => 'required_if:type,holiday|date',
            'end_date' => 'required_if:type,holiday|date|after:start_date',
            'conditions' => 'nullable|array',
            'conditions.*.min_days' => 'required_with:conditions|integer|min:1',
            'conditions.*.max_days' => 'nullable|integer|gt:conditions.*.min_days',
            'conditions.*.percentage' => 'required_with:conditions|numeric|min:0.01|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $oldData = $discount->toArray();

        $discount->update([
            'name' => $request->name,
            'percentage' => $request->percentage,
            'start_date' => $discount->type === 'holiday' ? $request->start_date : null,
            'end_date' => $discount->type === 'holiday' ? $request->end_date : null,
            'description' => $request->description,
            'conditions' => $discount->type === 'duration' ? $request->conditions : null,
        ]);

        // Log the update
        DiscountLog::logAction(
            $discount->id,
            'updated',
            auth()->id(),
            [
                'old' => $oldData,
                'new' => $discount->fresh()->toArray()
            ],
            "Discount '{$discount->name}' updated by " . auth()->user()->name
        );

        return redirect()->route('admin.discounts.show', $discount)
            ->with('success', 'Discount updated successfully!');
    }

    /**
     * Toggle discount active status
     */
    public function toggleStatus(Discount $discount)
    {
        $oldStatus = $discount->is_active;
        $discount->update(['is_active' => !$discount->is_active]);

        $action = $discount->is_active ? 'activated' : 'deactivated';
        
        DiscountLog::logAction(
            $discount->id,
            $action,
            auth()->id(),
            ['old_status' => $oldStatus, 'new_status' => $discount->is_active],
            "Discount '{$discount->name}' {$action} by " . auth()->user()->name
        );

        $message = $discount->is_active ? 'Discount activated successfully!' : 'Discount deactivated successfully!';
        
        return redirect()->back()->with('success', $message);
    }

    /**
     * Delete discount (soft delete)
     */
    public function destroy(Discount $discount)
    {
        // Check if discount has been used
        $hasUsage = $discount->bookings()->exists() || $discount->purchases()->exists();
        
        if ($hasUsage) {
            return redirect()->back()
                ->with('error', 'Cannot delete discount that has been used in bookings or purchases. Deactivate it instead.');
        }

        $discountName = $discount->name;
        
        // Log the deletion
        DiscountLog::logAction(
            $discount->id,
            'deleted',
            auth()->id(),
            $discount->toArray(),
            "Discount '{$discountName}' deleted by " . auth()->user()->name
        );

        $discount->delete();

        return redirect()->route('admin.discounts.index')
            ->with('success', "Discount '{$discountName}' deleted successfully!");
    }

    /**
     * Preview discount calculation (public access)
     */
    public function preview(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => 'required|in:rental,selling',
                'amount' => 'required|numeric|min:1',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after:start_date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Invalid input data',
                    'errors' => $validator->errors()
                ], 400);
            }

            $preview = $this->discountService->previewDiscount(
                $request->type,
                $request->amount,
                $request->start_date,
                $request->end_date
            );

            return response()->json($preview);
            
        } catch (\Exception $e) {
            \Log::error('Discount preview error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Failed to calculate discount',
                'message' => 'Please try again later'
            ], 500);
        }
    }

    /**
     * Get discount analytics
     */
    public function analytics(Request $request)
    {
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : now()->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : now()->endOfMonth();

        $statistics = $this->discountService->getDiscountStatistics($startDate, $endDate);
        
        // Additional analytics
        $topDiscounts = Discount::withCount(['bookings', 'purchases'])
            ->withSum(['bookings as bookings_discount_sum'], 'discount_amount')
            ->withSum(['purchases as purchases_discount_sum'], 'discount_amount')
            ->orderByDesc('bookings_count')
            ->orderByDesc('purchases_count')
            ->limit(5)
            ->get();

        $monthlyTrends = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthStats = $this->discountService->getDiscountStatistics(
                $month->startOfMonth()->copy(),
                $month->endOfMonth()->copy()
            );
            $monthlyTrends[] = [
                'month' => $month->format('M Y'),
                'total_discount_amount' => $monthStats['total_discount_amount'],
                'total_transactions' => $monthStats['total_discounted_transactions'],
            ];
        }

        return view('admin.discounts.analytics', compact(
            'statistics', 
            'topDiscounts', 
            'monthlyTrends', 
            'startDate', 
            'endDate'
        ));
    }
}