<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function store(PostRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $post = Post::create($validatedData);
            if ($request->hasFile('image')) {
                $post->addMediaFromRequest('image')->toMediaCollection('posts');
            }
            if (!empty($request->tags)) {
                $post->tags()->attach($request->tags);
            }

            return response()->json([
                "message" => "Post created successfully",
                "post" => new PostResource($post)
            ],200);

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
               "post" => PostResource::collection($post)
           ],200);
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
                "post" => new PostResource($post)
            ],200);

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


    public function update(PostRequest $request , $id)
    {
        try{

            $post = Post::findOrFail($id);

            $data = $request->validate($request->all());

            $post->update($data);

            return response()->json([
                "message" => "Category updated successfully",
                "post" => new PostResource($post)
            ],200);

        }catch(\Exception $e){
            return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }


}
