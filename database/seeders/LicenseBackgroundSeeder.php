<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LicenseBackground;
use App\Models\User;

class LicenseBackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        $user =User::where('role','admin')->first();
        for($i=1;$i<=210;$i++){
            $l = LicenseBackground::create([
                "image" => $i.".png",
                "user_id" => $user->id ,
            ]);
        }

    }
}
