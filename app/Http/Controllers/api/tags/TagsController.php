<?php

namespace App\Http\Controllers\api\tags;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagsResource;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    //

    public function store(Request $request)
    {
        try{
            $tags = Tags::create($request->all());

            return response()->json([
                "message" => "tags inserted successfully",
                "tags" => new TagsResource($tags)
            ],200);
        }catch (\Exception $e){
            return response()->json(["error" => "failed to insert tag", $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try{

            $tags = Tags::findOrFail($id);
            return response()->json([
                "message " => "tags retrieved successfully",
                "tags" => new TagsResource($tags)
            ],200);
        }catch(\Exception $e){
            return response()->json(["error" => "failed to retrieve tag", $e->getMessage()], 500);
        }
    }


    public function index()
    {
        try{
            $tags = Tags::all();
            return response()->json([
                "message" => "tags retrieved successfully",
                "tags" => TagsResource::collection($tags)
            ],200);
        }catch(\Exception $e){
            return response()->json(["error" => "failed to retrieve tag", $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {

            $tags = Tags::findOrFail($id);
            $tags->delete($id);

            return response()->json([
                "message" => "tags deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json(["error" => "failed to delete tag", $e->getMessage()], 500);
        }

    }



        public function update($id, Request $request)
        {
            try {

                $tags = Tags::findOrFail($id);

                $data = $request->validate(["name" => "required"]);
                $tags->update($data);

                return response()->json([
                    "message" => "tags deleted successfully",
                    "tags" => new TagsResource($tags)
                ],200);
            } catch (\Exception $e) {
                return response()->json(["error" => "failed to update tag", $e->getMessage()], 500);
            }

        }





}
