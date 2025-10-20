<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Define the users you want to seed
        $usersToSeed = [
            [
                'name' => $faker->name,
                'username' => "adminxxx101",
                'email' => 'autoverifiedme@gmail.com',
                'role' => 'admin',
                'wallet' => $faker->numberBetween(10000, 100000),
                'password' => Hash::make("KEUxS~82UK~t-eYg"),
            ],
            [
                'name' => $faker->name,
                'username' => "testuser",
                'email' => 'ethancrane44@protonmail.com',
                'role' => 'user',
                'wallet' => 0,
                'password' => Hash::make("Zkn+>64/k<uD$<h4"),
            ],
            [
                'name' => $faker->name,
                'username' => "Derek18",
                'email' => 'DerekBenedit@aol.com',
                'role' => 'user',
                'wallet' => 0,
                'password' => Hash::make("DerekBenedit@@@1"),
            ],
        ];

        foreach ($usersToSeed as $userData) {
            // Create or update the user
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            // Mark the email as verified
            $user->markEmailAsVerified();

            // Check if profile exists — if not, create it
            Profile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'dob' => $faker->date(),
                    'address' => $faker->address,
                    'phone' => $faker->phoneNumber,
                    'id_type' => 'international_passport',
                    'id_front_path' => null,
                    'id_back_path' => null,
                ]
            );
        }
    }
}
