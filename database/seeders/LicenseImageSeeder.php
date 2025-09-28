<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LicenseImage;
use App\Models\User;

class LicenseImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user =User::where('role','admin')->first();
        // $count = 81;
        // for($i=1;$i<=$count;$i++){
        //     $l = LicenseImage::create([
        //         "image" => $i.".png",
        //         "category" => "young",
        //         "user_id" => $user->id ,
        //     ]);
        // }

        // for($i=82;$i<=340;$i++){
        //     $l = LicenseImage::create([
        //         "image" => $i.".png",
        //         "category" => "middle",
        //         "user_id" => $user->id ,
        //     ]);
        // }

        // for($i=341;$i<=430;$i++){
        //     $l = LicenseImage::create([
        //         "image" => $i.".png",
        //         "category" => "old",
        //         "user_id" => $user->id ,
        //     ]);
        // }



        for($i=431;$i<=440;$i++){
            $l = LicenseImage::create([
                "image" => $i.".png",
                "category" => "young",
                "user_id" => $user->id ,
            ]);
        }


    }
}
