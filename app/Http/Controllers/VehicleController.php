<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * 🔍 SMART SEARCH - Enhanced rentals with search intelligence
     */
    public function rentals(Request $request)
    {
        $query = Vehicle::availableForRent()->with('images');

        // Smart search processing
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query = $this->applySmartSearch($query, $searchTerm, 'rent');
        }

        // Apply traditional filters
        if ($request->filled('brand')) {
            $query->byMake($request->brand);
        }

        if ($request->filled('make')) {
            $query->byMake($request->make);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('max_price')) {
            $query->where('rental_price_per_day', '<=', $request->max_price);
        }

        if ($request->filled('budget')) {
            if ($request->budget === 'low') {
                $query->where('rental_price_per_day', '<=', 3000);
            } elseif ($request->budget === 'high') {
                $query->where('rental_price_per_day', '>=', 8000);
            }
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->priceRange($request->min_price, $request->max_price, 'rental');
        }

        if ($request->filled('pickup_date') && $request->filled('return_date')) {
            $pickupDate = $request->pickup_date;
            $returnDate = $request->return_date;
            
            $query->whereDoesntHave('bookings', function ($q) use ($pickupDate, $returnDate) {
                $q->where('status', '!=', 'cancelled')
                  ->where(function ($subQ) use ($pickupDate, $returnDate) {
                      $subQ->whereBetween('pickup_date', [$pickupDate, $returnDate])
                           ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                           ->orWhere(function ($dateQ) use ($pickupDate, $returnDate) {
                               $dateQ->where('pickup_date', '<=', $pickupDate)
                                     ->where('return_date', '>=', $returnDate);
                           });
                  });
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        if ($sortBy === 'price') {
            $query->orderBy('rental_price_per_day', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $vehicles = $query->paginate(12);

        // Get filter options
        $makes = Vehicle::availableForRent()->distinct()->pluck('make');
        $categories = Vehicle::availableForRent()->distinct()->pluck('category');

        return view('vehicles.rentals', compact('vehicles', 'makes', 'categories'));
    }

    /**
     * 🔍 SMART SEARCH - Enhanced sales with search intelligence
     */
    public function sales(Request $request)
    {
        $query = Vehicle::availableForSale()->with('images');

        // Smart search processing
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query = $this->applySmartSearch($query, $searchTerm, 'buy');
        }

        // Apply traditional filters
        if ($request->filled('brand')) {
            $query->byMake($request->brand);
        }

        if ($request->filled('make')) {
            $query->byMake($request->make);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('max_price')) {
            $query->where('sale_price', '<=', $request->max_price);
        }

        if ($request->filled('budget')) {
            if ($request->budget === 'low') {
                $query->where('sale_price', '<=', 500000);
            } elseif ($request->budget === 'high') {
                $query->where('sale_price', '>=', 2000000);
            }
        }

        // Handle year range filter
        if ($request->filled('year_range')) {
            $yearRange = explode('-', $request->year_range);
            if (count($yearRange) == 2) {
                $query->whereBetween('year', [(int)$yearRange[0], (int)$yearRange[1]]);
            }
        }

        // Handle individual year filters (for backward compatibility)
        if ($request->filled('year_from') && $request->filled('year_to')) {
            $query->whereBetween('year', [$request->year_from, $request->year_to]);
        }

        // Handle price range filter
        if ($request->filled('price_range')) {
            $priceRange = $request->price_range;
            if ($priceRange === '100000+') {
                $query->where('sale_price', '>=', 100000);
            } else {
                $rangeParts = explode('-', $priceRange);
                if (count($rangeParts) == 2) {
                    $query->whereBetween('sale_price', [(float)$rangeParts[0], (float)$rangeParts[1]]);
                }
            }
        }

        // Handle individual price filters (for backward compatibility)
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->priceRange($request->min_price, $request->max_price, 'sale');
        }

        // Handle condition filter
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        if ($sortBy === 'price') {
            $query->orderBy('sale_price', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $vehicles = $query->paginate(12);

        // Get filter options
        $makes = Vehicle::availableForSale()->distinct()->pluck('make');
        $categories = Vehicle::availableForSale()->distinct()->pluck('category');
        $years = range(date('Y'), date('Y') - 20);

        return view('vehicles.sales', compact('vehicles', 'makes', 'categories', 'years'));
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('images');
        
        // Check if vehicle is available
        if (!$vehicle->isAvailableForRent() && !$vehicle->isAvailableForSale()) {
            abort(404);
        }

        // Get similar vehicles
        $similarVehicles = Vehicle::where('id', '!=', $vehicle->id)
            ->where('make', $vehicle->make)
            ->where(function ($query) {
                $query->where('available_for_rent', true)
                      ->orWhere('available_for_sale', true);
            })
            ->with('images')
            ->take(4)
            ->get();

        return view('vehicles.show', compact('vehicle', 'similarVehicles'));
    }

    public function checkAvailability(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        $isAvailable = $vehicle->isAvailableForDates(
            $request->pickup_date,
            $request->return_date
        );

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Vehicle is available for selected dates' : 'Vehicle is not available for selected dates'
        ]);
    }

    /**
     * 🔍 SMART SEARCH - Get search suggestions
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->get('q', '');
        $mode = $request->get('mode', 'rent');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = [];
        
        // Brand suggestions
        $brands = Vehicle::where(function($q) use ($mode) {
                if ($mode === 'rent') {
                    $q->where('available_for_rent', true);
                } else {
                    $q->where('available_for_sale', true);
                }
            })
            ->where('make', 'LIKE', "%{$query}%")
            ->distinct()
            ->pluck('make')
            ->take(3);

        foreach ($brands as $brand) {
            $suggestions[] = [
                'type' => 'brand',
                'text' => $brand . ' ' . ($mode === 'rent' ? 'rentals' : 'for sale'),
                'query' => $brand . ' ' . $mode,
                'icon' => 'car',
                'category' => 'Brand'
            ];
        }

        // Category suggestions
        $categories = Vehicle::where(function($q) use ($mode) {
                if ($mode === 'rent') {
                    $q->where('available_for_rent', true);
                } else {
                    $q->where('available_for_sale', true);
                }
            })
            ->where('category', 'LIKE', "%{$query}%")
            ->distinct()
            ->pluck('category')
            ->take(3);

        foreach ($categories as $category) {
            $suggestions[] = [
                'type' => 'category',
                'text' => $category . ' ' . ($mode === 'rent' ? 'rentals' : 'for sale'),
                'query' => $category . ' ' . $mode,
                'icon' => 'category',
                'category' => 'Type'
            ];
        }

        // Model suggestions
        $models = Vehicle::where(function($q) use ($mode) {
                if ($mode === 'rent') {
                    $q->where('available_for_rent', true);
                } else {
                    $q->where('available_for_sale', true);
                }
            })
            ->where('model', 'LIKE', "%{$query}%")
            ->distinct()
            ->selectRaw('CONCAT(make, " ", model) as full_name, make, model')
            ->take(3)
            ->get();

        foreach ($models as $model) {
            $suggestions[] = [
                'type' => 'model',
                'text' => $model->full_name . ' ' . ($mode === 'rent' ? 'rentals' : 'for sale'),
                'query' => $model->full_name . ' ' . $mode,
                'icon' => 'car',
                'category' => 'Model'
            ];
        }

        // Budget suggestions
        if (stripos($query, 'cheap') !== false || stripos($query, 'budget') !== false || stripos($query, 'affordable') !== false) {
            $suggestions[] = [
                'type' => 'budget',
                'text' => 'Affordable ' . ($mode === 'rent' ? 'rentals' : 'cars for sale'),
                'query' => 'cheap ' . $mode,
                'icon' => 'dollar',
                'category' => 'Budget'
            ];
        }

        return response()->json(array_slice($suggestions, 0, 8));
    }

    /**
     * 🧠 SMART SEARCH - Apply intelligent search logic
     */
    private function applySmartSearch($query, $searchTerm, $mode)
    {
        $searchTerm = strtolower(trim($searchTerm));
        
        // Amharic to English translation map
        $translations = [
            'ኪራይ' => 'rent',
            'ግዢ' => 'buy',
            'ቶዮታ' => 'toyota',
            'መርሴዲስ' => 'mercedes',
            'ቢኤምደብሊው' => 'bmw',
            'ፎርድ' => 'ford',
            'ሆንዳ' => 'honda',
            'ኒሳን' => 'nissan',
            'ሃይንዳይ' => 'hyundai',
            'ኪያ' => 'kia',
            'ኤስዩቪ' => 'suv',
            'ሴዳን' => 'sedan',
            'ፒክአፕ' => 'pickup',
            'ኤሌክትሪክ' => 'electric',
            'ዲዘል' => 'diesel',
            'ቤንዚን' => 'gasoline',
            'አውቶማቲክ' => 'automatic',
            'ማኑዋል' => 'manual',
            'ርካሽ' => 'cheap',
            'ቡድጀት' => 'budget',
            'ብር' => 'birr'
        ];

        // Translate Amharic terms
        foreach ($translations as $amharic => $english) {
            $searchTerm = str_replace($amharic, $english, $searchTerm);
        }

        // Apply search logic
        $query->where(function($q) use ($searchTerm) {
            // Search in make, model, category
            $q->where('make', 'LIKE', "%{$searchTerm}%")
              ->orWhere('model', 'LIKE', "%{$searchTerm}%")
              ->orWhere('category', 'LIKE', "%{$searchTerm}%")
              ->orWhere('fuel_type', 'LIKE', "%{$searchTerm}%")
              ->orWhere('transmission', 'LIKE', "%{$searchTerm}%")
              ->orWhereRaw("CONCAT(make, ' ', model) LIKE ?", ["%{$searchTerm}%"]);
        });

        // Apply budget filters based on keywords
        if (strpos($searchTerm, 'cheap') !== false || strpos($searchTerm, 'budget') !== false || strpos($searchTerm, 'affordable') !== false) {
            if ($mode === 'rent') {
                $query->where('rental_price_per_day', '<=', 3000);
            } else {
                $query->where('sale_price', '<=', 500000);
            }
        }

        if (strpos($searchTerm, 'premium') !== false || strpos($searchTerm, 'luxury') !== false) {
            if ($mode === 'rent') {
                $query->where('rental_price_per_day', '>=', 8000);
            } else {
                $query->where('sale_price', '>=', 2000000);
            }
        }

        // Extract price from search term
        if (preg_match('/under\s+(\d+)|below\s+(\d+)|(\d+)\s*birr|(\d+)\s*etb/', $searchTerm, $matches)) {
            $maxPrice = intval($matches[1] ?: $matches[2] ?: $matches[3] ?: $matches[4]);
            if ($mode === 'rent') {
                $query->where('rental_price_per_day', '<=', $maxPrice);
            } else {
                $query->where('sale_price', '<=', $maxPrice);
            }
        }

        return $query;
    }
}