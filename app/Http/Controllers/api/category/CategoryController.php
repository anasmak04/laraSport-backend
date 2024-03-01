<?php

namespace App\Http\Controllers\api\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{


    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->validated());

            return response()->json([
                "message" => "Category created successfully",
                "category" => new CategoryResource($category)
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Category creation failed: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try{
            $category = Category::findOrFail($id);

            return response()->json([
                "message" => "category retrieved successfullt",
                "category"=> CategoryResource::collection($category)
            ],200);
        }
        catch (Exception $e){
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);

        }

    }
    public function index()
    {
        try {
            $categories = Category::all();

            return response()->json([
                "message" => "Categories retrieved successfully",
                "categories" => CategoryResource::collection($categories)
            ],200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try{

            $category = Category::findOrFail($id);

            $category->delete($id);
            return response()->json([
                "message" => "category  deleted successfully",
            ]);

        }
        catch(Exception $e){
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);
        }
    }


    public function update(CategoryRequest $request, $id)
    {
        try {

            $category = Category::findOrFail($id);
            $category->update($request->validated());

            return response()->json([
                "message" => "Category updated successfully",
                "category" => CategoryResource::collection($category)
            ],200);

        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update category: ' . $e->getMessage()], 500);
        }
    }


}
