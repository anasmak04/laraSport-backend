<?php

namespace App\Http\Controllers\api\admin\event;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Exception;



class EventController extends Controller
{
    //

    /**
    *   @OA\Get(
    *   path="/api/event",
    *   tags={"events"},
    *   summary="Get all events",
    *   description="Retrieve a list of all events",
    *   @OA\Response(response="200", description="List of events"),
    *   @OA\Response(response="404", description="No event found"),
    * )
     */
    public function index()
    {
        $events = Event::all();

        return response()->json([
            "message" => "events retrieved successfully",
            "event" => EventResource::collection($events)
        ]);
    }


    /**
     * @OA\Get(
     * path="/api/event/{id}",
     * tags={"events"},
     * summary="Get a event by ID",
     * description="Retrieve a event by its ID",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID of the student to retrieve",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(response="200", description="Event found"),
     * @OA\Response(response="404", description="Event not found")
     * )
     *
     */

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

    /**
     * @OA\Delete(
     * path="/api/event/{id}",
     * tags={"events"},
     * summary="Delete a event",
     * description="Delete a event by its ID",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID of the event to delete",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(response="204", description="Event deleted"),
     * @OA\Response(response="404", description="Event not found")
     * )
     */

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

    /**
     * @OA\Put(
     * path="/api/event/{id}",
     * tags={"events"},
     * summary="Update a event",
     * description="Update the details of a event",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID of the event to update",
     * @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"title", "description", "content", "event_date", "sport_type_id", "city_id", "image"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="description", type="string"),
     * @OA\Property(property="content", type="string"),
     * @OA\Property(property="event_date", type="string"),
     * @OA\Property(property="sport_type_id", type="integer"),
     * @OA\Property(property="city_id", type="integer"),
     * @OA\Property(property="image", type="string"),
     * )
     * ),
     * @OA\Response(response="200", description="event updated"),
     * @OA\Response(response="400", description="Bad request"),
     * @OA\Response(response="404", description="event not found")
     * )
     */
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



/**
 *  @OA\Post(
 *  path="/api/event",
 *  tags={"Events"},
 *  summary="Create a new event",
 *  description="Create a new event with provided name and age",
 *  @OA\RequestBody(
 *  required=true,
 *  @OA\JsonContent(
    required={"title", "description", "content", "event_date", "sport_type_id", "city_id", "image"},
 *  @OA\Property(property="title", type="string"),
 *  @OA\Property(property="description", type="string"),
 *  @OA\Property(property="content", type="string"),
 *  @OA\Property(property="event_date", type="string"),
 *  @OA\Property(property="sport_type_id", type="integer"),
 *  @OA\Property(property="city_id", type="integer"),
 *  @OA\Property(property="image", type="string"),
 * )
 * ),
 *  @OA\Response(response="201", description="Student created"),
 *  @OA\Response(response="400", description="Bad request")
 * )
 * /
 */
    public function store(EventRequest $request)
    {
        try {

            $validatedata = $request->validated();

            $validatedata["user_id"] = $request->user()->id;

            $event = Event::create($validatedata);

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
