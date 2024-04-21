<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

use App\Models\Request;
use App\Models\User;


class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $requestsIds = Request::pluck('id')->toArray();
        shuffle($requestsIds);
        $requestsIds = array_slice($requestsIds, 0, count($requestsIds) / 2);

        $sitterIds = User::pluck('id')->toArray();

        while (count($requestsIds) > 0) {

            $requestsId = $faker->randomElement($requestsIds);
            unset($requestsIds[array_search($requestsId, $requestsIds)]);

            DB::table('transaction')->insert([

                'request_id' => $requestsId,
                'sitter_id' => $faker->randomElement($sitterIds),
                'review_owner' => 'He took good care of him and '.strtolower($faker->text($maxNbChars = 200)),
                'review_sitter' => 'The owner is '.strtolower($faker->text($maxNbChars = 150)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
