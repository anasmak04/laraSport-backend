<?php

namespace App\Http\Controllers\api\admin\sportType;

use App\Http\Controllers\api\sportType\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\SportTypeRequest;
use App\Models\SportType;

class SportTypeController extends Controller
{
    //
    public function index()
    {
        $sport_type = SportType::all();

        return response()->json([
            "message" => "events retrieved successfully",
            "sport_type" => $sport_type
        ]);
    }


    public function show($id){

        try{

            $sport_type = SportType::find($id);
            return response()->json([
                "message" => "event retrieved successfully",
                "sport_type" => $sport_type
            ]);

        }

        catch (\Exception $e) {
            return response()->json(['error' => 'sport type creation failed: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try{

            $sport_type = Event::findOrFail($id);

            $sport_type->delete($id);
            return response()->json([
                "message" => "sport_type  deleted successfully",
            ]);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);
        }
    }


    public function update(SportTypeRequest $request, $id)
    {
        try {

            $sport_type = SportType::findOrFail($id);
            $sport_type->update($request);

            return response()->json([
                "message" => "Category updated successfully",
                "sport_type" => $sport_type
            ],200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update category: ' . $e->getMessage()], 500);
        }
    }





    public function store(SportTypeRequest $request , SportType $sportType)
    {
        try{
            $sportType->save($request->all());

            return response()->json([
                "message" => "sport_type stored successfully"
            ]);

        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }



}
