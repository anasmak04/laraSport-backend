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
     *   @OA\Get(
     *   path="/api/category",
     *   tags={"categories"},
     *   summary="Get all categories",
     *   description="Retrieve a list of all categories",
     *   @OA\Response(response="200", description="List of categories"),
     *   @OA\Response(response="404", description="No category found"),
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
     *  @OA\Post(
     *  path="/api/category",
     *  tags={"Categories"},
     *  summary="Create a new category",
     *  description="Create a new category with provided name and age",
     *  @OA\RequestBody(
     *  required=true,
     *  @OA\JsonContent(
        required={"name", "description"},
     *  @OA\Property(property="name", type="string"),
     *  @OA\Property(property="description", type="string"),
     * )
     * ),
     *  @OA\Response(response="201", description="Category created"),
     *  @OA\Response(response="400", description="Bad request")
     * )
     * /
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
     * path="/api/category/{id}",
     * tags={"categories"},
     * summary="Get a category by ID",
     * description="Retrieve a category by its ID",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID of the category to retrieve",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(response="200", description="Category found"),
     * @OA\Response(response="404", description="Category not found")
     * )
     *
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
     * path="/api/category/{id}",
     * tags={"categories"},
     * summary="Delete a category",
     * description="Delete a category by its ID",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID of the category to delete",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(response="204", description="Category deleted"),
     * @OA\Response(response="404", description="Category not found")
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
     * path="/api/category/{id}",
     * tags={"categories"},
     * summary="Update a category",
     * description="Update the details of a category",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID of the category to update",
     * @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "description"},
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="description", type="string"),
     * )
     * ),
     * @OA\Response(response="200", description="category updated"),
     * @OA\Response(response="400", description="Bad request"),
     * @OA\Response(response="404", description="category not found")
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
