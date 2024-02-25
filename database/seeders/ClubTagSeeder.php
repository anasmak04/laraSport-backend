<?php

namespace Database\Seeders;

use App\Models\ClubTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ClubTag::create(["name" => "Musculation"]);
        ClubTag::create(["name" => "Natation"]);
        ClubTag::create(["name" => "Fitnedd"]);
        ClubTag::create(["name" => "Boxe"]);
        ClubTag::create(["name" => "Karaté"]);
        ClubTag::create(["name" => "Danse"]);
        ClubTag::create(["name" => "Zumba"]);
        ClubTag::create(["name" => "Kick Boxing"]);
        ClubTag::create(["name" => "Aerobic"]);
        ClubTag::create(["name" => "CrossFit"]);
        ClubTag::create(["name" => "Teniss"]);
        ClubTag::create(["name" => "Basketball"]);
        ClubTag::create(["name" => "FootBall"]);
        ClubTag::create(["name" => "HandBall"]);
    }
}
