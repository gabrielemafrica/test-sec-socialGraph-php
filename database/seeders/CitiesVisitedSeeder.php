<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\City;

class CitiesVisitedSeeder extends Seeder
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
            // Verifica se ci sono città visitate associate a una persona
            if (isset($personData['cities']) && is_array($personData['cities'])) {
                // Itera sulle città visitate e crea le corrispondenti righe nella tabella 'cities_visited'
                foreach ($personData['cities'] as $cityName => $rating) {
                    City::create([
                        'person_id' => $personData['id'],
                        'city_name' => $cityName,
                        'rating' => $rating
                    ]);
                }
            }
        }
    }
}
