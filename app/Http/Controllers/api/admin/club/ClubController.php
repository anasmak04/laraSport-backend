<?php

namespace App\Http\Controllers\api\admin\club;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClubRequest;
use App\Http\Resources\ClubRessource;
use App\Models\City;
use App\Models\Club;
use Exception;
use Illuminate\Support\Facades\Log;

class ClubController extends Controller
{
    public function findClubByCity($cityid)
    {
        try {
            $clubs = City::find($cityid)->clubs()->get();
            return response()->json([
                "message" => "Clubs retrieved by city successfully.",
                "clubs" => ClubRessource::collection($clubs)
            ]);
        } catch (Exception $e) {
            return response()->json(["message" => "Something went wrong.", "error" => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $clubs = Club::all();
            return response()->json([
                "message" => "Clubs retrieved successfully.",
                "clubs" => ClubRessource::collection($clubs)
            ]);
        } catch (Exception $e) {
            return response()->json(["message" => "Something went wrong.", "error" => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $club = Club::findOrFail($id);

            return response()->json([
                "message" => "Club retrieved with id.",
                "club" => new ClubRessource($club)
            ]);
        } catch (Exception $e) {
            return response()->json(["message" => "Something went wrong.", "error" => $e->getMessage()], 500);
        }
    }

    public function store(ClubRequest $request)
    {
        try {
            $club = Club::create($request->validated());

            if ($request->hasFile("image")) {
                $club->addMediaFromRequest("image")->toMediaCollection("clubs", "media_clubs");
            }

            if ($request->has('tags') && is_array($request->tags)) {
                $club->clubTags()->attach($request->tags);
            }

            return response()->json([
                "message" => "Club inserted successfully.",
                "club" => new ClubRessource($club)
            ], 201);
        } catch (Exception $e) {
            return response()->json(["message" => "Something went wrong.", "error" => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $club = Club::findOrFail($id);
            $club->delete();
            return response()->json(["message" => "Club deleted successfully."], 204); // Using HTTP 204 No Content status code
        } catch (Exception $e) {
            return response()->json(["message" => "Something went wrong.", "error" => $e->getMessage()], 500);
        }
    }

    public function update(ClubRequest $request, $id)
    {
        try {
            $club = Club::findOrFail($id);
            $club->update($request->validated());
            return response()->json(["message" => "Club updated successfully.", "club" => new ClubRessource($club)]);
        } catch (Exception $e) {
            return response()->json(["message" => "Something went wrong.", "error" => $e->getMessage()], 500);
        }
    }
}
