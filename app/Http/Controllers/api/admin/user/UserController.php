<?php

namespace App\Http\Controllers\api\admin\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRessource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        try {
            $user = User::with("roles")->get();
            return response()->json([
                "message" => "successfully retrieved users",
                "user" => UserRessource::collection($user)
            ],200);

        }catch(\Exception $e){
            return response()->json(["error" => "failed to retrieve user", $e->getMessage()], 500);
        }
    }



    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                "message" => "user retrieved successfully",
                "user" => new UserRessource($user)
            ],200);
        }catch(\Exception $e){
            return response()->json(["error" => "failed to retrieve user", $e->getMessage()], 500);
        }
    }



    public function destroy($id)
    {
        try{

            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                "message" => "user deleted succssfully",
            ]);
        }catch(\Exception $e){
            return response()->json(["error" => "failed to retrieve user", $e->getMessage()], 500);
        }
    }



    public function update($id , Request $request)
    {
        try{

            $user = User::findOrFail($id);
            $validateData  = $request->validated();

            $user->update($validateData);

            return response()->json([
                "message" => "user updated successfully",
                "user" => new UserRessource($user)
            ]);

        }catch(\Exception $e){
            return response()->json(["error" => "failed to delete user", $e->getMessage()], 500);

        }
    }
}
