<?php

namespace App\Http\Controllers\api\admin\club;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClubRequest;
use App\Http\Resources\ClubRessource;
use App\Models\City;
use App\Models\Club;
use Mockery\Exception;

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


    public function index(){

        try{
            $clubs = Club::all();
            return response()->json([
                "message" => "clubs retrieved successfully",
                "clubs" => ClubRessource::collection($clubs)
            ]);
        }catch(Exception $e){
            return response()->json(["message => smegint went wrong", $e->getMessage()]);
        }
    }


    public function show($id){
        try{
            $club = Club::findOrFail($id);

            return response()->json([
               "message" => "club retrieved with id",
               "club" => new ClubRessource($club)
            ]);

        }catch(Exception $e){
            return response()->json(["message" => "something went wrong", $e->getMessage()]);
        }
    }


    public function store(ClubRequest $request){
            try{
               $club = Club::create($request->validated());

                if($request->hasFile("image")){
                    $club->addMediaFromRequest("image")->toMediaCollection("clubs", "media_clubs");
                }
               return response()->json([
                    "message" => "club inserted successfully",
                    "club" => new ClubRessource($club)
                ]);



            }catch(\Exception $e){
                return response()->json(["message" => "something went wrong", $e->getMessage()]);
            }
    }



    public function delete($id)
    {
        try{
            $club = Club::findOrFail($id);
            $club->delete();
        }catch(\Exception $e){
            return response()->json(["message" => "something went wrong", $e->getMessage()]);
        }

    }


    public function update(ClubRequest $request , $id)
    {
        try{
            $club = Club::findOrFail($id);
            $club->update($request->validated());
        }catch(\Exception $e){
            return response()->json(["message" => "something went wrong", $e->getMessage()]);
        }
    }




}
