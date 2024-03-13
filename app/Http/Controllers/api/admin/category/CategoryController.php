<?php

namespace App\Http\Controllers\api\admin\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{




    /**
     * @OA\Get(
     *     path="/api/category",
     *     operationId="getCategories",
     *     tags={"Categories"},
     *     summary="Get list of categories",
     *     description="Returns all categories",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Category")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
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




    /**
     * @OA\Post(
     *     path="/api/category",
     *     tags={"Categories"},
     *     summary="Create a new category",
     *     description="Stores a new category",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Sample Category"),
     *             @OA\Property(property="description", type="string", example="Sample Category Description"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error creating the category"
     *     )
     * )
     */


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


    /**
     * @OA\Get(
     *     path="/api/category/{id}",
     *     tags={"Categories"},
     *     summary="Get a single category",
     *     description="Returns a single category by ID",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of the category to return",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     )
     * )
     */


    public function show($id)
    {
        try{
            $category = Category::findOrFail($id);

            return response()->json([
                "message" => "category retrieved successfullt",
                "category"=> new CategoryResource($category)
            ],200);
        }
        catch (Exception $e){
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);

        }

    }






    /**
     * @OA\Delete(
     *     path="/api/category/{id}",
     *     tags={"Categories"},
     *     summary="Delete a category",
     *     description="Deletes a category by ID",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of the category to delete",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error deleting the category"
     *     )
     * )
     */

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


    /**
     * @OA\Put(
     *     path="/api/category/{id}",
     *     tags={"Categories"},
     *     summary="Update an existing category",
     *     description="Updates data of an existing category",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of the category to update",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Updated Category Name"),
     *             @OA\Property(property="description", type="string", example="Updated Category Description"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error updating the category"
     *     )
     * )
     */

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
