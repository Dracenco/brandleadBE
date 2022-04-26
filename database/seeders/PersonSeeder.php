<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table("people")->insert(
            [
                "name" => $faker->name(),
                "order" => $faker->unique()->numberBetween(1, 10)
            ]
        );
    }
}
