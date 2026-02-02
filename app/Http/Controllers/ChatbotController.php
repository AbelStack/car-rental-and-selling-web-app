<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Vehicle;

class ChatbotController extends Controller
{
    public function askAI(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $userMessage = $request->message;

        try {
            // Check if user is asking for car listings
            if ($this->isAskingForCarListings($userMessage)) {
                $carListings = $this->getCarListings();
                return response()->json([
                    'reply' => $carListings
                ]);
            }

            // Check if OpenAI API key is configured
            $apiKey = env('OPENAI_API_KEY');
            if (!$apiKey) {
                return response()->json([
                    'reply' => 'I apologize, but the AI service is currently unavailable. Please contact our support team for assistance.',
                    'error' => 'API key not configured'
                ], 500);
            }

            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are a customer support assistant for Addis Drive, a vehicle rental and sales company in Ethiopia. 
                        
                        Company Information:
                        - We offer vehicle rentals and sales
                        - We operate in Ethiopia with locations in major cities
                        - We accept payments via Chapa (Ethiopian payment system)
                        - KYC verification is required for bookings
                        - We have both self-drive and with-driver options
                        - Business hours: 8 AM - 6 PM (Ethiopian Time)
                        
                        IMPORTANT: When users ask for car recommendations, specific cars, or want to see available vehicles, 
                        you should suggest they ask for 'car listings' or 'available cars' to get real-time vehicle information.
                        
                        Only answer questions related to:
                        - Vehicle rentals (booking process, pricing, requirements)
                        - Vehicle sales (available cars, purchase process)
                        - KYC verification process
                        - Payment methods (Chapa integration)
                        - Business hours and contact information
                        - General company policies
                        
                        Guidelines:
                        - Keep responses concise and helpful
                        - Be friendly and professional
                        - If asked about specific cars, suggest asking for 'car listings'
                        - If asked about technical issues, suggest contacting support
                        - If the question is outside this scope, politely redirect to human support
                        - Always end with asking if they need help with anything else
                        
                        If you're unsure about specific details, suggest contacting our support team."
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'temperature' => 0.3,
                'max_tokens' => 200
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'reply' => $data['choices'][0]['message']['content'] ?? 'I apologize, but I couldn\'t process your request. Please try again or contact our support team.'
                ]);
            } else {
                Log::error('OpenAI API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                return response()->json([
                    'reply' => 'I\'m experiencing some technical difficulties. Please contact our support team for immediate assistance.',
                    'error' => 'API request failed'
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Chatbot Error', [
                'message' => $e->getMessage(),
                'user_message' => $userMessage
            ]);

            return response()->json([
                'reply' => 'I apologize for the inconvenience. Our support team is available to help you directly. Please contact us via phone or email.',
                'error' => 'Service temporarily unavailable'
            ], 500);
        }
    }

    public function getPredefinedAnswers()
    {
        return response()->json([
            'answers' => [
                [
                    'keywords' => ['rent', 'rental', 'book', 'booking'],
                    'reply' => 'You can rent a vehicle by browsing our Rentals page, selecting your preferred car, choosing dates, and completing the booking with payment via Chapa. KYC verification is required.'
                ],
                [
                    'keywords' => ['cars', 'vehicles', 'available cars', 'car listings', 'show me cars', 'list cars', 'what cars', 'which cars', 'recommend cars', 'car recommendations'],
                    'reply' => 'car_listings_request' // Special flag for car listings
                ],
                [
                    'keywords' => ['price', 'cost', 'pricing', 'rate', 'fee'],
                    'reply' => 'Our rental prices vary by vehicle type and duration. You can see exact pricing on each vehicle\'s detail page. We offer competitive daily rates with optional driver services.'
                ],
                [
                    'keywords' => ['chapa', 'payment', 'pay', 'money'],
                    'reply' => 'We accept secure payments through Chapa, which supports all major Ethiopian banks. You can pay using mobile banking, bank transfers, or other Chapa-supported methods.'
                ],
                [
                    'keywords' => ['kyc', 'verification', 'verify', 'document'],
                    'reply' => 'KYC verification requires uploading a valid ID document. The process usually takes less than 24 hours. You must complete KYC before making any bookings.'
                ],
                [
                    'keywords' => ['contact', 'support', 'help', 'phone', 'email'],
                    'reply' => 'You can contact our support team via phone, email, or visit our office. Our business hours are 8 AM - 6 PM Ethiopian Time. Check the Contact page for details.'
                ],
                [
                    'keywords' => ['driver', 'self drive', 'with driver'],
                    'reply' => 'We offer both self-drive and with-driver options. Self-drive requires a valid driver\'s license, while our with-driver service includes a professional driver for your journey.'
                ],
                [
                    'keywords' => ['location', 'pickup', 'delivery', 'where'],
                    'reply' => 'We operate in major Ethiopian cities including Addis Ababa, Bahir Dar, Gondar, and more. You can choose pickup locations from airports, hotels, or city centers during booking.'
                ],
                [
                    'keywords' => ['buy', 'purchase', 'sale', 'sell'],
                    'reply' => 'We also sell vehicles! Browse our Sales section to see available cars for purchase. Each listing includes detailed specifications, pricing, and contact information.'
                ],
                [
                    'keywords' => ['hours', 'time', 'open', 'closed'],
                    'reply' => 'Our business hours are 8:00 AM to 6:00 PM, Ethiopian Time, Monday through Sunday. You can book online 24/7, but support is available during business hours.'
                ],
                [
                    'keywords' => ['cancel', 'cancellation', 'refund'],
                    'reply' => 'Cancellation policies vary by booking type and timing. Please check your booking details or contact support for specific cancellation terms and refund information.'
                ]
            ]
        ]);
    }

    /**
     * Check if user is asking for car listings
     */
    private function isAskingForCarListings(string $message): bool
    {
        $carListingKeywords = [
            'cars', 'vehicles', 'available cars', 'car listings', 'show me cars', 
            'list cars', 'what cars', 'which cars', 'recommend cars', 'car recommendations',
            'tell me cars', 'available vehicles', 'rental cars', 'cars for rent',
            'show cars', 'car options', 'vehicle options', 'at least', 'least cars'
        ];

        $lowerMessage = strtolower($message);
        
        foreach ($carListingKeywords as $keyword) {
            if (strpos($lowerMessage, strtolower($keyword)) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get formatted car listings for chatbot response
     */
    private function getCarListings(): string
    {
        try {
            // Get available rental vehicles with images
            $vehicles = Vehicle::with('images')
                ->availableForRent()
                ->orderBy('rental_price_per_day', 'asc')
                ->take(4)
                ->get();

            if ($vehicles->isEmpty()) {
                return 'I apologize, but we currently don\'t have any vehicles available for rent. Please check back later or contact our support team for more information.';
            }

            $response = "Here are " . $vehicles->count() . " available rental cars:\n\n";

            foreach ($vehicles as $index => $vehicle) {
                $response .= "🚗 " . ($index + 1) . ". " . $vehicle->full_name . "\n";
                $response .= "   💰 ETB " . number_format($vehicle->rental_price_per_day, 0) . "/day\n";
                $response .= "   👥 " . $vehicle->seating_capacity . " seats\n";
                $response .= "   ⛽ " . ucfirst($vehicle->fuel_type) . "\n";
                $response .= "   🔧 " . ucfirst($vehicle->transmission) . "\n";
                
                // Add driving options
                $drivingOptions = [];
                if ($vehicle->self_drive_available) {
                    $drivingOptions[] = 'Self-drive';
                }
                if ($vehicle->with_driver_available) {
                    $drivingOptions[] = 'With driver (+ETB ' . number_format($vehicle->driver_cost_per_day ?? 0, 0) . '/day)';
                }
                if (!empty($drivingOptions)) {
                    $response .= "   🚙 " . implode(', ', $drivingOptions) . "\n";
                }
                
                $response .= "\n";
            }

            $response .= "To book any of these vehicles:\n";
            $response .= "1. Visit our Rentals page\n";
            $response .= "2. Select your preferred car\n";
            $response .= "3. Choose your dates and location\n";
            $response .= "4. Complete KYC verification\n";
            $response .= "5. Pay securely via Chapa\n\n";
            $response .= "Would you like more details about any specific vehicle or need help with booking?";

            return $response;

        } catch (\Exception $e) {
            Log::error('Error fetching car listings for chatbot', [
                'error' => $e->getMessage()
            ]);

            return 'I\'m having trouble fetching our current vehicle listings. Please visit our Rentals page directly or contact our support team for the most up-to-date availability.';
        }
    }
}