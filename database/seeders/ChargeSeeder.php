<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Statement;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Transaction;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class ChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


     
     
         public function run(Faker $faker)
         {

           
            // every section must have a charge 
            // DB::table('charges')->insert([
            // 'charge' => 10,
            // 'slug' => 'lawyer_license',
            // ]);

            // DB::table('charges')->insert([
            // 'charge' => 12,
            // 'slug' => 'rent',
            // ]);

            // DB::table('charges')->insert([
            // 'charge' => 15,
            // 'slug' => 'lease',
            // ]);


          
            // DB::table('charges')->insert([
            // 'charge' => 12,
            // 'slug' => 'energy',
            // ]);

            // DB::table('charges')->insert([
            //     'charge' => 12,
            //     'slug' => 'divorce',
            //     ]);
     

            // DB::table('charges')->insert([
            //     'charge' => 10,
            //     'slug' => 'paystub',
            //     ]);

            DB::table('charges')->insert([
                'charge' => 15,
                'slug' => 'will',
                ]);
     
    }
}
