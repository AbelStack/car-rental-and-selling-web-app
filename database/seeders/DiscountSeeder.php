<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;
use Carbon\Carbon;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. System Duration Discounts (Always Active)
        $durationDiscounts = [
            [
                'name' => '7-13 Days Rental Discount',
                'type' => 'duration',
                'percentage' => 3.00,
                'applies_to' => 'rental',
                'description' => 'Automatic 3% discount for rentals between 7-13 days',
                'is_active' => true,
                'conditions' => [
                    ['min_days' => 7, 'max_days' => 13, 'percentage' => 3.00]
                ]
            ],
            [
                'name' => '14+ Days Rental Discount',
                'type' => 'duration',
                'percentage' => 6.00,
                'applies_to' => 'rental',
                'description' => 'Automatic 6% discount for rentals 14 days or longer',
                'is_active' => true,
                'conditions' => [
                    ['min_days' => 14, 'max_days' => null, 'percentage' => 6.00]
                ]
            ]
        ];

        foreach ($durationDiscounts as $discount) {
            Discount::create($discount);
        }

        // 2. Default Holiday Discounts (Admin can modify these)
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;

        $holidayDiscounts = [
            [
                'name' => 'Christmas Special',
                'type' => 'holiday',
                'percentage' => 8.00,
                'applies_to' => 'both',
                'start_date' => Carbon::create($currentYear, 12, 24),
                'end_date' => Carbon::create($currentYear, 12, 26),
                'description' => 'Christmas holiday discount for rentals and purchases',
                'is_active' => true
            ],
            [
                'name' => 'New Year Celebration',
                'type' => 'holiday',
                'percentage' => 7.00,
                'applies_to' => 'both',
                'start_date' => Carbon::create($currentYear, 12, 30),
                'end_date' => Carbon::create($nextYear, 1, 2),
                'description' => 'New Year holiday discount for rentals and purchases',
                'is_active' => true
            ],
            [
                'name' => 'Ethiopian New Year',
                'type' => 'holiday',
                'percentage' => 6.00,
                'applies_to' => 'both',
                'start_date' => Carbon::create($nextYear, 9, 11),
                'end_date' => Carbon::create($nextYear, 9, 12),
                'description' => 'Ethiopian New Year (Enkutatash) celebration discount',
                'is_active' => true
            ],
            [
                'name' => 'Timkat Festival',
                'type' => 'holiday',
                'percentage' => 5.00,
                'applies_to' => 'both',
                'start_date' => Carbon::create($nextYear, 1, 19),
                'end_date' => Carbon::create($nextYear, 1, 20),
                'description' => 'Ethiopian Orthodox Epiphany celebration discount',
                'is_active' => true
            ],
            [
                'name' => 'Meskel Festival',
                'type' => 'holiday',
                'percentage' => 5.00,
                'applies_to' => 'both',
                'start_date' => Carbon::create($nextYear, 9, 27),
                'end_date' => Carbon::create($nextYear, 9, 28),
                'description' => 'Finding of the True Cross celebration discount',
                'is_active' => true
            ]
        ];

        foreach ($holidayDiscounts as $discount) {
            Discount::create($discount);
        }

        $this->command->info('✅ Successfully seeded discount system with:');
        $this->command->info('   - 2 Duration discounts (system-controlled)');
        $this->command->info('   - 5 Holiday discounts (admin-controlled)');
        $this->command->info('   - All discounts are active and ready to use');
    }
}
