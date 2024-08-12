<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class VoyageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('voyages')->insert([
            [
                'codeqr' => 'QR001',
                'date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'scan_sortie' => Carbon::now()->subDays(10)->format('Y-m-d H:i:s'),
                'scan_entree' => Carbon::now()->subDays(9)->format('Y-m-d H:i:s'),
                'scanS_date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'scanE_date' => Carbon::now()->subDays(9)->format('Y-m-d'),
                'chauffeur_id' => 1,
                'camion_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'codeqr' => 'QR002',
                'date' => Carbon::now()->subDays(8)->format('Y-m-d'),
                'scan_sortie' => Carbon::now()->subDays(8)->format('Y-m-d H:i:s'),
                'scan_entree' => Carbon::now()->subDays(7)->format('Y-m-d H:i:s'),
                'scanS_date' => Carbon::now()->subDays(8)->format('Y-m-d'),
                'scanE_date' => Carbon::now()->subDays(7)->format('Y-m-d'),
                'chauffeur_id' => 2,
                'camion_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'codeqr' => 'QR003',
                'date' => Carbon::now()->subDays(6)->format('Y-m-d'),
                'scan_sortie' => Carbon::now()->subDays(6)->format('Y-m-d H:i:s'),
                'scan_entree' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'),
                'scanS_date' => Carbon::now()->subDays(6)->format('Y-m-d'),
                'scanE_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'chauffeur_id' => 3,
                'camion_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'codeqr' => 'QR004',
                'date' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'scan_sortie' => Carbon::now()->subDays(4)->format('Y-m-d H:i:s'),
                'scan_entree' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                'scanS_date' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'scanE_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'chauffeur_id' => 4,
                'camion_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'codeqr' => 'QR005',
                'date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'scan_sortie' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
                'scan_entree' => Carbon::now()->subDays(1)->format('Y-m-d H:i:s'),
                'scanS_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'scanE_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'chauffeur_id' => 5,
                'camion_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more records as needed
        ]);
    }
}
