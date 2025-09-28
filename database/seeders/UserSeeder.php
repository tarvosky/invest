<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
                'wallet' => $faker->numberBetween(10000, 100000),
                'password' => Hash::make("Zkn+>64/k<uD$<h4"),
            ],
        ];

        // Loop through the users and create or update them
        foreach ($usersToSeed as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            // Mark the email as verified
            $user->markEmailAsVerified();
        }
    }
}
