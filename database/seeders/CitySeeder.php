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

        City::create(["name" => "Rabat", "image" => "http://127.0.0.1:8000/media/cities/1/rabat.jpg"]);
        City::create(["name" => "Agadir", "image" => "http://127.0.0.1:8000/media/cities/2/agadir.jpg"]);
        City::create(["name" => "Casablanca" , "image" => "http://127.0.0.1:8000/media/cities/3/casablanca.jpg"]);
        City::create(["name" => "Tanger", "image" => "http://127.0.0.1:8000/media/cities/4/Tanger.jpg"]);
        City::create(["name" => "Marrakech", "image" => "http://127.0.0.1:8000/media/cities/5/Marrakech.jpg"]);
        City::create(["name" => "kenitra", "image" => "http://127.0.0.1:8000/media/cities/6/Kenitra.jpg"]);
        City::create(["name" => "Tetouan", "image" => "http://127.0.0.1:8000/media/cities/7/Tetouan.jpg"]);

    }
}
