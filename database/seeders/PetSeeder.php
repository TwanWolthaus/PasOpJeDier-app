<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

use App\Models\User;


class PetSeeder extends Seeder
{

    public function getRdmSpecies() {

        $species = [
            'Dog',
            'Cat',
            'Fish',
            'Rabbit',
            'Guinea Pig',
            'Hamster',
            'Ferret',
            'Mouse',
            'Rat',
            'Snake',
            'Turtle',
            'Lizard',
            'Duck',
            'Cockatiel',
        ];

        return collect($species)->random();
    }

    public function run(): void
    {
        $faker = Faker::create();
        $ownerIds = User::pluck('id')->toArray();

        $species = PetSeeder::getRdmSpecies();
        $imageName = $species.'.png';

        DB::table('pet')->insert([
            'owner_id' => $faker->randomElement($ownerIds),

            'name' => $faker->firstName,
            'profilepic' => $imageName,
            'breed' => rtrim($faker->text($maxNbChars = 6), '.')."ian ".$faker->firstName."us",
            'species' => $species,
            'behaviour' => "My pet does ".strtolower($faker->text($maxNbChars = 70)),
            'allergy' => $faker->firstName."tis, ".$faker->firstName."ia",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
