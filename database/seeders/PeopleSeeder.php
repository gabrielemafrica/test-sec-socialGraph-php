<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Person;
use App\Models\City;
use App\Models\Connection;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Include il file socialGraph.php dal percorso corretto
        $socialData = include base_path('database/socialGraph.php');

        foreach ($socialData as $personData) {
            // Crea una nuova istanza del modello Person con i dati forniti
            Person::create([
                'id' => $personData['id'],
                'firstName' => $personData['firstName'],
                'surname' => $personData['surname'],
                'age' => $personData['age'],
                'gender' => $personData['gender']
            ]);
        }
    }
}
