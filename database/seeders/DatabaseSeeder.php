<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed 50 times
        $this->call([UserSeeder::class,]);

        // Seed 40 times
        for ($i = 0; $i <= 40; $i += 1) {
            $this->call([PetSeeder::class]);
        }

        // Seed 30 times
        $this->call([RequestSeeder::class]);

        // Seed 20 times
        $this->call([TransactionSeeder::class]);

    }
}
