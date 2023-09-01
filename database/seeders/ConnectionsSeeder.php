<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Connection;

class ConnectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Includi i dati socialGraph.php
        $socialData = include base_path('database/socialGraph.php');

        // Itera sui dati social
        foreach ($socialData as $personData) {
            // Itera sulle connessioni di una persona e crea le corrispondenti righe nella tabella 'connections'
            foreach ($personData['connections'] as $friendId) {
                Connection::create([
                    'person_id' => $personData['id'],
                    'friend_id' => $friendId,
                ]);
            }
        }
    }
}
