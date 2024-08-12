<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class SecurityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('securities')->insert([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'CIN' => $faker->numerify('##########'),
                'telephone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };
    }
}
