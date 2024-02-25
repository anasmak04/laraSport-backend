<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        City::create(["name" => "Rabat"]);
        City::create(["name" => "Casablance"]);
        City::create(["name" => "eljadida"]);
        City::create(["name" => "sale"]);
        City::create(["name" => "ouajda"]);
        City::create(["name" => "Tanger"]);
        City::create(["name" => "Tetouan"]);
        City::create(["name" => "Skhirate"]);
        City::create(["name" => "Temara"]);
        City::create(["name" => "Khemissat"]);
        City::create(["name" => "Kenitra"]);
        City::create(["name" => "Fes"]);
        City::create(["name" => "Meknes"]);

    }
}
