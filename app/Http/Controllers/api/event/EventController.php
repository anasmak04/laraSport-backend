<?php

namespace App\Http\Controllers\api\event;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    public function index()
    {
        $events = Event::all();

        return response()->json([
            "message" => "events retrieved successfully",
            "event" => EventResource::collection($events)
        ]);
    }


    public function show($id){

        try{

            $event = Event::find($id);
            return response()->json([
                "message" => "event retrieved successfully",
                "event" => $event
            ]);

        }

    catch (\Exception $e) {
            return response()->json(['error' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try{

            $event = Event::findOrFail($id);

            $event->delete();
            return response()->json([
                "message" => "event  deleted successfully",
            ]);
        }
        catch(Exception $e){
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);
        }
    }


    public function update(EventRequest $request, $id)
    {
        try {

            $event = Event::findOrFail($id);
            $event->update($request);

            return response()->json([
                "message" => "Category updated successfully",
                "category" => $event
            ],200);

        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update category: ' . $e->getMessage()], 500);
        }
    }




    public function store(EventRequest $request)
    {
        try {
            $event = Event::create($request->validated());

            if ($request->hasFile('image')) {
                $event->addMediaFromRequest('image')->toMediaCollection('events','media_events');
            }


            if ($request->has('TagsClubs')) {
                $event->clubTags()->attach($request->TagsClubs);
            }

            return response()->json([
                "message" => "Event stored successfully",
                "event" => new EventResource($event)
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Event creation failed: ' . $e->getMessage()], 500);
        }
    }




}
