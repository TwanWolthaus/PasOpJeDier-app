<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

use App\Models\Pet;
use App\Models\User;


class RequestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $petIds = Pet::pluck('id')->toArray();
        shuffle($petIds);

        for ($i = 0; $i <= 30; $i += 1) {

            $petId = $faker->randomElement($petIds);
            unset($petIds[array_search($petId, $petIds)]);
            $ownerId = Pet::where('id', $petId)->value('owner_id');

            $startDate = Carbon::now()->subDays(rand(0, 900));
            $endDate = $startDate->copy()->addDays(rand(1, 60));

            DB::table('request')->insert([
                'pet_id' => $petId,
                'owner_id' => $ownerId,

                'start_date' => $startDate,
                'end_date' => $endDate,
                'daily_rate' => rand(1, 100) + (rand(0, 99) / 100),
                'description' => "I need someone to ".strtolower($faker->text($maxNbChars = 200)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
