<?php

namespace App\Http\Controllers\api\admin\city;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Mockery\Exception;

class CityController extends Controller
{
    //

    public function index(){
      try{
          $cities =   City::all();
          return  response()->json([
              "message" => "cities retrieved successfully",
              "city" => CityResource::collection($cities)
          ]);
      }catch(\Exception $e){
          return response()->json(['error' => 'Failed to retrieve cities: ' . $e->getMessage()], 500);

      }
    }

    public function show($id)
    {
       try{
           $city = City::findOrFail($id);
           return  response()->json([
               "message" => "city retrieved successfully",
               "city" => new CityResource($city)
           ]);
       }catch(\Exception $e){
           return response()->json(["error" => "Failed to retrieve city", $e->getMessage()],500);
       }

    }



    public function destroy($id)
    {
        try{
            $city = City::findOrFail($id);
            $city->delete();
            return response()->json(["message" => "city deleted successfully"]);
        }catch(\Exception $e){
            return response()->json(["error" => "Failed to delete city", $e->getMessage()],500);
        }

    }


    public function store(StoreCityRequest $request ,City $city)
    {
        try{
            $validatedData = $request->validated();
            $city = City::create($validatedData);

            if($request->hasFile("image")){
                $city->addMediaFromRequest("image")->toMediaCollection("cities", "media_cities");
            }


            return response()->json([
                "message" => "city inserted successfully"
            ]);

        }catch(Exception $e){
            return response()->json(["error" => "Failed to store city", "message" => $e->getMessage()], 500);
        }
    }



    public function update(Request $request ,$id)
    {
        try{

            $city = City::findOrFail($id);

            $city->update($request->all());

            return response()->json([
                "message" => "city updated successfully",
                "city" => new CityResource($city)
            ]);

        }catch(Exception $e){
            return response()->json(["error" => "Failed to store city", $e->getMessage()],500);
        }
    }


}
