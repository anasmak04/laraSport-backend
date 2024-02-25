<?php

namespace App\Http\Controllers\api\club;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClubRessource;
use App\Models\City;

class ClubController extends Controller
{
    //

    public function findClubByCity($cityid){
       try{
           $clubs = City::find($cityid)->clubs()->get();

           return response()->json([
               "message" => "clubs retrieved by city successfully",
               "club" => ClubRessource::collection($clubs)
           ]);
       }catch(\Exception $e){
           return response()->json(["something went wrong here ", $e->getMessage()]);
       }
    }
}
