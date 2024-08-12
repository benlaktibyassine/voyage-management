<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommandeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $commandes = [
            ['description' => 'Commande de produit A', 'etat' => 'en cours', 'devis' => 150.00, 'client_id' => 1],
            ['description' => 'Commande de produit B', 'etat' => 'livré', 'devis' => 200.00, 'client_id' => 2],
            ['description' => 'Commande de produit C', 'etat' => 'annulé', 'devis' => 300.00, 'client_id' => 3],
            ['description' => 'Commande de produit D', 'etat' => 'en cours', 'devis' => 250.00, 'client_id' => 4],
            ['description' => 'Commande de produit E', 'etat' => 'en attente', 'devis' => 180.00, 'client_id' => 5],
            ['description' => 'Commande de produit F', 'etat' => 'livré', 'devis' => 220.00, 'client_id' => 6],
            ['description' => 'Commande de produit G', 'etat' => 'en cours', 'devis' => 320.00, 'client_id' => 7],
            ['description' => 'Commande de produit H', 'etat' => 'annulé', 'devis' => 270.00, 'client_id' => 8],
            ['description' => 'Commande de produit I', 'etat' => 'en attente', 'devis' => 150.00, 'client_id' => 9],
            ['description' => 'Commande de produit J', 'etat' => 'livré', 'devis' => 310.00, 'client_id' => 10],
        ];

        foreach ($commandes as $commande) {
            DB::table('commandes')->insert(array_merge($commande, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}

