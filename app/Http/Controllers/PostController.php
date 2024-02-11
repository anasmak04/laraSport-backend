<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "title" => "required",
                "content" => "required",
                "publish_date" => "required|date",
                "category_id" => "required|exists:categories,id",
                "tags" => "sometimes|array",
            ]);

            $validatedData['user_id'] = 1;

            $post = Post::create($validatedData);


            if (!empty($request->tags)) {
                $post->tags()->attach($request->tags);
            }


            return response()->json([
                "message" => "Post created successfully",
                "post" => $post
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }



    public function index()
    {
       try{
           $post = Post::all();

           return response()->json([
               "message" => "post retrieved successfully",
               "post" => $post
           ]);
       }catch(\Exception $e){
           return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
       }
    }


    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);

            return response()->json([
                "message" => "post retrieved successfully",
                "post" => $post
            ]);
        }catch(\Exception $e){
            return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $post = Post::findOrFail($id);
            $post->delete($id);

            return response()->json([
                "message" => "post deleted successfully",
            ]);

        }catch(\Exception $e){
            return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }


    public function update(Request $request , $id)
    {
        try{

            $post = Post::findOrFail($id);

            $data = $request->validate([
                "title" => "required",
                "content" => "required",
                "publish_date" => "required",
                "category_id" => "required",
            ]);

            $post->update($data);

            return response()->json([
                "message" => "Category updated successfully",
                "post" => $post
            ]);

        }catch(\Exception $e){
            return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }


}
