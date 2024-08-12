<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChauffeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('chauffeurs')->insert([
            ['nom' => 'Doe', 'prenom' => 'John', 'telephone' => '1234567890', 'image' => 'image1.jpg'],
            ['nom' => 'Smith', 'prenom' => 'Jane', 'telephone' => '0987654321', 'image' => 'image2.jpg'],
            ['nom' => 'Johnson', 'prenom' => 'Emily', 'telephone' => '1112233445', 'image' => 'image3.jpg'],
            ['nom' => 'Williams', 'prenom' => 'Michael', 'telephone' => '2233445566', 'image' => 'image4.jpg'],
            ['nom' => 'Brown', 'prenom' => 'Linda', 'telephone' => '3344556677', 'image' => 'image5.jpg'],
            ['nom' => 'Jones', 'prenom' => 'Robert', 'telephone' => '4455667788', 'image' => 'image6.jpg'],
            ['nom' => 'Miller', 'prenom' => 'Jessica', 'telephone' => '5566778899', 'image' => 'image7.jpg'],
            ['nom' => 'Davis', 'prenom' => 'William', 'telephone' => '6677889900', 'image' => 'image8.jpg'],
            ['nom' => 'Garcia', 'prenom' => 'Sophia', 'telephone' => '7788990011', 'image' => 'image9.jpg'],
            ['nom' => 'Rodriguez', 'prenom' => 'James', 'telephone' => '8899001122', 'image' => 'image10.jpg'],
        ]);
    }
}
