<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $clients = [
            ['nom' => 'Doe', 'prenom' => 'John', 'telephone' => '1234567890', 'email' => 'john.doe@example.com', 'password' => Hash::make('password123'), 'adresse' => '123 Main St'],
            ['nom' => 'Smith', 'prenom' => 'Jane', 'telephone' => '0987654321', 'email' => 'jane.smith@example.com', 'password' => Hash::make('password123'), 'adresse' => '456 Elm St'],
            ['nom' => 'Brown', 'prenom' => 'Charlie', 'telephone' => '5555555555', 'email' => 'charlie.brown@example.com', 'password' => Hash::make('password123'), 'adresse' => '789 Oak St'],
            ['nom' => 'Taylor', 'prenom' => 'Emily', 'telephone' => '6666666666', 'email' => 'emily.taylor@example.com', 'password' => Hash::make('password123'), 'adresse' => '101 Pine St'],
            ['nom' => 'Johnson', 'prenom' => 'Michael', 'telephone' => '7777777777', 'email' => 'michael.johnson@example.com', 'password' => Hash::make('password123'), 'adresse' => '202 Maple St'],
            ['nom' => 'Williams', 'prenom' => 'Sarah', 'telephone' => '8888888888', 'email' => 'sarah.williams@example.com', 'password' => Hash::make('password123'), 'adresse' => '303 Birch St'],
            ['nom' => 'Jones', 'prenom' => 'Robert', 'telephone' => '9999999999', 'email' => 'robert.jones@example.com', 'password' => Hash::make('password123'), 'adresse' => '404 Cedar St'],
            ['nom' => 'Miller', 'prenom' => 'Linda', 'telephone' => '0000000000', 'email' => 'linda.miller@example.com', 'password' => Hash::make('password123'), 'adresse' => '505 Spruce St'],
            ['nom' => 'Davis', 'prenom' => 'James', 'telephone' => '1111111111', 'email' => 'james.davis@example.com', 'password' => Hash::make('password123'), 'adresse' => '606 Fir St'],
            ['nom' => 'Garcia', 'prenom' => 'Jessica', 'telephone' => '2222222222', 'email' => 'jessica.garcia@example.com', 'password' => Hash::make('password123'), 'adresse' => '707 Ash St'],
        ];

        foreach ($clients as $client) {
            DB::table('clients')->insert(array_merge($client, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
