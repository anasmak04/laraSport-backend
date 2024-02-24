<?php

namespace App\Http\Controllers\api\city;

use App\Http\Controllers\Controller;
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
              "city" => $cities
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
               "city" => $city
           ]);

       }catch(\Exception $e){
           return response()->json(["error" => "Failed to retrieve city", $e->getMessage()],500);
       }

    }



    public function destroy($id)
    {
        try{
            $city = City::findOrFail($id);
            $city->delete($id);

            return response()->json(["message" => "city deleted successfully"]);
        }catch(\Exception $e){
            return response()->json(["error" => "Failed to delete city", $e->getMessage()],500);
        }

    }



    public function store(Request $request ,City $city)
    {
        try{

            $city->save($request->all());
            return response()->json([
                "message" => "city inserted successfully"
            ]);

        }catch(Exception $e){
            return response()->json(["error" => "Failed to store city", $e->getMessage()],500);
        }
    }



    public function update(Request $request ,$id)
    {
        try{

            $city = City::findOrFail($id);

            $city->update($request->all());

            return response()->json([
                "message" => "city updated successfully",
                "city" => $city
            ]);

        }catch(Exception $e){
            return response()->json(["error" => "Failed to store city", $e->getMessage()],500);
        }
    }


}
