<?php

namespace App\Http\Controllers\api\admin\tagsclubs;

use App\Http\Controllers\Controller;
use App\Models\ClubTag;
use Mockery\Exception;

class TagsClubController extends Controller
{
    //

    public function index(){
        try{
            $clubtags = ClubTag::all();

            return response()->json([
                "message" => "clubtags retrieved successfullt",
                "clubtag" => $clubtags
            ]);
        }catch(Exception $e){
            return response()->json(["something went wrong"]);
        }
    }
}
