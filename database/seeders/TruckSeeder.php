<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trucks = [
            ['nom' => 'Truck A', 'model' => 'Model X', 'year' => 2015],
            ['nom' => 'Truck B', 'model' => 'Model Y', 'year' => 2016],
            ['nom' => 'Truck C', 'model' => 'Model Z', 'year' => 2017],
            ['nom' => 'Truck D', 'model' => 'Model W', 'year' => 2018],
            ['nom' => 'Truck E', 'model' => 'Model V', 'year' => 2019],
            ['nom' => 'Truck F', 'model' => 'Model U', 'year' => 2020],
            ['nom' => 'Truck G', 'model' => 'Model T', 'year' => 2021],
            ['nom' => 'Truck H', 'model' => 'Model S', 'year' => 2022],
            ['nom' => 'Truck I', 'model' => 'Model R', 'year' => 2023],
            ['nom' => 'Truck J', 'model' => 'Model Q', 'year' => 2024],
        ];

        DB::table('camions')->insert($trucks);
    }
}
