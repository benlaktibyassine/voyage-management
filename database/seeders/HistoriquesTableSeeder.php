<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HistoriquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('historiques')->insert([
                'voyage_mat' => $faker->randomElement([1,2,3,4,5]),
                'security_badge' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
                'status' => $faker->randomElement(['accept', 'refus']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
