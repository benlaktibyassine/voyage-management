<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeliveryNoteSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('bon_livraisons')->insert([
                'scaned' => (bool) rand(0, 1),  // Random boolean value
                'voyage_id' => rand(1, 5),    // Random voyage_id between 1 and 100
                'cmd_id' => rand(1, 10),      // Random cmd_id between 1 and 1000
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
