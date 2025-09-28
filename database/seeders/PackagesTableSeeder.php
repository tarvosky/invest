<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'name' => 'Bronze Package',
                'price' => 10000.00,
                'roi' => 20.00,
                'duration_days' => 30,
                'support_details' => 'Support Response within 2 days',
                'commission' => 4.00,
            ],
            [
                'name' => 'Silver Package',
                'price' => 25000.00,
                'roi' => 30.00,
                'duration_days' => 30,
                'support_details' => 'Support Response within 2 days',
                'commission' => 3.00,
            ],
            [
                'name' => 'Gold Package',
                'price' => 50000.00,
                'roi' => 50.00,
                'duration_days' => 30,
                'support_details' => 'Support Response within 2 days',
                'commission' => 2.00,
            ],
            [
                'name' => 'Platinum Package',
                'price' => 100000.00,
                'roi' => 100.00,
                'duration_days' => 30,
                'support_details' => 'Support Response within 2 days',
                'commission' => 0.00,
            ],
        ];

        foreach ($packages as $package) {
            DB::table('packages')->updateOrInsert(
                ['name' => $package['name']], // Check for an existing record by name
                array_merge($package, ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()])
            );
        }
    }
}
