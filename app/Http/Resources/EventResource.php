<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [

            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "content" => $this->content,
            "event_date" =>  $this->event_date,
            "image" => $this->getFirstMediaUrl("events"),
            "sport_type" => $this->sporttype->name,
            "user" => $this->user->firstName . " " . $this->user->lastName,
            "tags" => $this->clubTags->map(function ($item) {
                return $item->name;
            })
        ];

        return $data;
    }
}
