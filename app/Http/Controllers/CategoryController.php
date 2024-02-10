<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;

class CategoryController extends Controller
{
    public function save(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required",
                "description" => "required",
            ]);

            $category = Category::create($validatedData);

            return response()->json([
                "message" => "Category created successfully",
                "category" => $category
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Category creation failed: ' . $e->getMessage()], 500);
        }
    }


    public function findById($id)
    {
        try{
            $category = Category::findOrFail($id);

            return response()->json([
                "message" => "category retrieved successfullt",
                "category"=> $category
            ]);
        }

        catch (Exception $e){
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);

        }

    }
    public function findAll()
    {
        try {
            $categories = Category::all();

            return response()->json([
                "message" => "Categories retrieved successfully",
                "categories" => $categories
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);
        }
    }


    public function delete($id)
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


    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $validatedData = $request->validate([
                "name" => "required",
                "description" => "required",
            ]);

            $category->update($validatedData);

            return response()->json([
                "message" => "Category updated successfully",
                "category" => $category
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update category: ' . $e->getMessage()], 500);
        }
    }


}
