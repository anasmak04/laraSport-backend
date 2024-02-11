<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        try {
            $user = User::all();

            return response()->json([
                "message" => "user retrieved successfully",
                "user" => $user
            ]);
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
                "user" => $user
            ]);
        }catch(\Exception $e){
            return response()->json(["error" => "failed to retrieve user", $e->getMessage()], 500);
        }
    }



    public function destroy($id)
    {
        try{

            $user = User::findOrFail($id);
            $user->delete($id);

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

            $validateData  = $request->validate([
                "name" => "required",
                "email" => "required",
            ]);


            $user->update($validateData);

        }catch(\Exception $e){
            return response()->json(["error" => "failed to delete user", $e->getMessage()], 500);

        }
    }
}
