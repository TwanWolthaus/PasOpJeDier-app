<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder {

    public function run(): void {

        $faker = Faker::create();

        $usernames = [];
        for ($i = 0; $i <= 100; $i += 1) {
            $usernames[$i] = $faker->firstname;
        }
        $usernames = array_unique($usernames);
        $usernames = array_slice($usernames, 0, 51);


        for ($i = 0; $i <= 50; $i += 1) {

            $username = $usernames[$i];
            $lastname = $faker->lastname;

            DB::table('users')->insert([
                'name' => $username." ".$lastname,
                'email' => $username.'@gmail.com',
                'password' => Hash::make($username),
                'isAdmin' => (bool)rand(0, 1),
                'status' => 1,

                'bio' => "My bio: i hate ".strtolower($faker->text($maxNbChars = 200)),
                'home_info' => "My house is a ".strtolower($faker->text($maxNbChars = 100)),
                'country' => $faker->country,
                'city' => $faker->city,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
