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

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        protected function slugAndName ($name){
            $result = Str::slug($name, '-');
            $data=[
                'name' => $name,
                'slug'=>$result
            ] ;
            return $data;
          }
     
        
          protected function createTb (Array $data){
             DB::table('banks')->insert([
                 'name' => $data['name'],
                 'slug' => Str::slug($data['name'], '-'),
                 'logo' => Str::slug($data['name'], '-')."."."png",
             ]);
           }
     
     
     
         public function run(Faker $faker)
         {

             $data1 = $this->slugAndName("BBVA");
             $this->createTb($data1);
             $data2 = $this->slugAndName("Bank of America");
             $this->createTb($data2);
             $data3 = $this->slugAndName("BB&T");
             $this->createTb($data3);
             $data10 = $this->slugAndName("Capital one Bank");
             $this->createTb($data10);
             $data10 = $this->slugAndName("Chase Bank");
             $this->createTb($data10);
             $data4 = $this->slugAndName("Sun Trust Bank");
             $this->createTb($data4);
             $data5 = $this->slugAndName("TD BANK");
             $this->createTb($data5);
             $data6 = $this->slugAndName("Wells Fargo");
             $this->createTb($data6);
             $data7 = $this->slugAndName("Regions Bank");
             $this->createTb($data7);
             $data8 = $this->slugAndName("Navy Federal Credit Union");
             $this->createTb($data8);
             $data9 = $this->slugAndName("USbank");
             $this->createTb($data9);
             $data11 = $this->slugAndName("Customize (Any Bank)");
             $this->createTb($data11);
     

             
             DB::table('announcements')->insert([
              'id' =>1, 
              'title' => "Welcome",
              'message' => 'Welcome! We are offering 25% referral bonus to our customers for every new user they introduce to our marketplace. As long as the new user adds the required minimum amount. Check our FAQ section for more details. We get you verified!',
              ]);


            // every section must have a custom 
            DB::table('customs')->insert([
              'amount' => 5,
              'slug' => Str::slug('Edit Picture', '-'),
              'name' => 'Edit Picture',
              'description' => 'This service is to remove the background around pictures u need for ID.',
              ]);

            // every section must have a charge 
            DB::table('charges')->insert([
            'charge' => 10,
            'slug' => 'statement',
            ]);

            DB::table('charges')->insert([
            'charge' => 10,
            'slug' => 'dl_front',
            ]);

            DB::table('charges')->insert([
            'charge' => 10,
            'slug' => 'dl_back',
            ]);


            DB::table('charges')->insert([
            'charge' => 12,
            'slug' => 'dl_front_and_back',
            ]);


            DB::table('charges')->insert([
            'charge' => 10,
            'slug' => 'ssn_front',
            ]);

            DB::table('charges')->insert([
            'charge' => 10,
            'slug' => 'ssn_back',
            ]);

            DB::table('charges')->insert([
            'charge' => 12,
            'slug' => 'ssn_front_and_back',
            ]);

            DB::table('charges')->insert([
            'charge' => 10,
            'slug' => 'pp',
            ]);

            DB::table('charges')->insert([
              'charge' => 10,
              'slug' => '1040',
            ]);

            DB::table('charges')->insert([
              'charge' => 10,
              'slug' => '1099',
            ]);

            DB::table('charges')->insert([
              'charge' => 15,
              'slug' => 'w2',
            ]);

     
             $admin =  User::create([
               'name' => $faker->name,
               'username' => "adminxxx101",
               'email' => 'autoverifiedme@gmail.com',
               'role' => 'admin',
               'wallet' => $faker->numberBetween(10000,100000),
               'email_verified_at' => now(),
               'password' =>  Hash::make("KEUxS~82UK~t-eYg"), // password
               'remember_token' => Str::random(10),
             ]);
             $admin->markEmailAsVerified();


             $admin =  User::create([
              'name' => $faker->name,
              'username' => "testuser",
              'email' => 'ethancrane44@protonmail.com',
              'role' => 'user',
              'wallet' => $faker->numberBetween(10000,100000),
              'email_verified_at' => now(),
              'password' =>  Hash::make("Zkn+>64/k<uD$<h4"), // password
              'remember_token' => Str::random(10),
            ]);
            $admin->markEmailAsVerified();
     
     
             $Statement1=  Statement::create( [
                 'business_name' => $faker->company, 
                 'full_name' => $faker->firstNameFemale, 
                 'address' => $faker->streetAddress, 
                 'city' => 'tampa', 
                 'currency' => 'dollar', 
                  'state' => 'FL', 
                 'opening_balance' => '80000',
                 'zip' => '3242', 
                 'bank_id' => '1', 
                 'account_card_number' => '0998322222222', 
                 'routing_number' => '32322', 
                 'fromDate' => '2021-1-1', 
                 'toDate' => '2021-12-12', 
                 'user_id'=> 2
           ]);
     
           $Statement2=  Statement::create( [
             'business_name' => $faker->company, 
             'full_name' => $faker->firstNameFemale, 
             'address' => $faker->streetAddress, 
             'city' => 'tampa', 
             'currency' => 'dollar', 
              'state' => 'FL', 
             'opening_balance' => '80000',
             'zip' => '3242', 
             'bank_id' => '1', 
             'account_card_number' => '0998322222222', 
             'routing_number' => '32322', 
             'fromDate' => '2021-1-1', 
             'toDate' => '2021-12-12', 
             'user_id'=> 2
       ]);
     
     
     
       $Statement3=  Statement::create( [
         'business_name' => $faker->company, 
         'full_name' => $faker->firstNameFemale, 
         'address' => $faker->streetAddress, 
         'city' => 'tampa', 
         'currency' => 'dollar', 
          'state' => 'FL', 
         'opening_balance' => '80000',
         'zip' => '3242', 
         'bank_id' => '1', 
         'account_card_number' => '0998322222222', 
         'routing_number' => '32322', 
         'fromDate' => '2021-1-1', 
         'toDate' => '2021-12-12', 
         'user_id'=> 2
     ]);
     
     $Statement4=  Statement::create( [
       'business_name' => $faker->company, 
       'full_name' => $faker->firstNameFemale, 
       'address' => $faker->streetAddress, 
       'city' => 'tampa', 
       'currency' => 'dollar', 
        'state' => 'FL', 
       'opening_balance' => '80000',
       'zip' => '3242', 
       'bank_id' => '1', 
       'account_card_number' => '0998322222222', 
       'routing_number' => '32322', 
       'fromDate' => '2021-1-1', 
       'toDate' => '2021-12-12', 
       'user_id'=> 2
     ]);
     
     
         for($i=1; $i<6;$i++){
           $t = Transaction::create([
             'theDate' => "2021-05-".$i,
             'paidin' => $faker->randomNumber(2),
             'paidout' => 0,
             'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
             'Statement_id'  => 1
           ]);
         }
     
         for($i=1; $i<6;$i++){
           $t = Transaction::create([
             'theDate' => "2021-05-".$i,
             'paidin' => 0,
             'paidout' => $faker->randomNumber(2),
             'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
             'Statement_id'  => 1
           ]);
         }
     
     
     
             //========================================================
     
             for($i=1; $i<31;$i++){
               $t = Transaction::create([
                 'theDate' => "2021-05-".$i,
                 'paidin' => $faker->randomNumber(2),
                 'paidout' => 0,
                 'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                 'Statement_id'  => 2
               ]);
     
               $t = Transaction::create([
                 'theDate' => "2021-05-".$i,
                 'paidin' => $faker->randomNumber(2),
                 'paidout' => 0,
                 'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                 'Statement_id'  => 2
               ]);
     
             }
         
             for($i=1; $i<31;$i++){
               $t = Transaction::create([
                 'theDate' => "2021-05-".$i,
                 'paidin' => 0,
                 'paidout' => $faker->randomNumber(2),
                 'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                 'Statement_id'  => 2
               ]);
     
               $t = Transaction::create([
                 'theDate' => "2021-05-".$i,
                 'paidin' => 0,
                 'paidout' => $faker->randomNumber(2),
                 'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                 'Statement_id'  => 2
               ]);
             }


             for($i=1; $i<31;$i++){
              $t = Transaction::create([
                'theDate' => "2021-05-".$i,
                'paidin' => 0,
                'paidout' => $faker->randomNumber(2),
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'Statement_id'  => 2
              ]);
    
              $t = Transaction::create([
                'theDate' => "2021-05-".$i,
                'paidin' => 0,
                'paidout' => $faker->randomNumber(2),
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'Statement_id'  => 2
              ]);
            }
     
         //========================================================
     
         for($i=1; $i<6;$i++){
           $t = Transaction::create([
             'theDate' => "2021-05-".$i,
             'paidin' => $faker->randomNumber(2),
             'paidout' => 0,
             'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
             'Statement_id'  => 3
           ]);
         }
     
         for($i=1; $i<31;$i++){
           $t = Transaction::create([
             'theDate' => "2021-05-".$i,
             'paidin' => 0,
             'paidout' => $faker->randomNumber(2),
             'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
             'Statement_id'  => 3
           ]);
         }
     
     
         //========================================================
     
         for($i=1; $i<31;$i++){
           $t = Transaction::create([
             'theDate' => "2021-05-".$i,
             'paidin' => $faker->randomNumber(2),
             'paidout' => 0,
             'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
             'Statement_id'  => 4
           ]);
         }
     
         for($i=1; $i<6;$i++){
           $t = Transaction::create([
             'theDate' => "2021-05-".$i,
             'paidin' => 0,
             'paidout' => $faker->randomNumber(2),
             'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
             'Statement_id'  => 4
           ]);
         }

     
     
    }
}
