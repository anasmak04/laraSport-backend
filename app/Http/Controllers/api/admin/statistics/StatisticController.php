<?php

namespace App\Http\Controllers\api\admin\statistics;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Club;
use App\Models\Post;
use App\Models\User;

class StatisticController extends Controller
{
    //


    public function CountUsers(){
        try{
            $users = User::count();
            return response()->json([
                    "count" => $users
            ]);
        }catch(\Exception $e){
            return response()->json(["something went wrong in count users", $e->getMessage()]);
        }
    }

    public function CountCategories(){
        try{
            $categories = Category::count();

            return response()->json([
               "count" => $categories
            ]);
        }catch(\Exception $e){
            return response()->json(["something went wrong in count categories", $e->getMessage()]);
        }
    }


    public function CountPosts(){
        try{
            $posts = Post::count();

            return response()->json([
                "count" => $posts
            ]);
        }catch(\Exception $e){
            return response()->json(["something went wrong in count categories", $e->getMessage()]);
        }
    }



    public function CountCitites()
    {

        try{
            $citiees = City::count();

            return response()->json([
                "count" => $citiees
            ]);
        }catch(\Exception $e){
            return response()->json(["something went wrong in count cities", $e->getMessage()]);
        }
    }


    public function CountClubs()
    {
        try{
            $clubs = Club::count();
            return response()->json([
               "count" => $clubs
            ]);
        }catch(\Exception $e){
            return response()->json(["something went wrong in count clubs", $e->getMessage()]);
        }
    }
}
