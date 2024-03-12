<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            "name" => $this->name,
            "image" => $this->getFirstMediaUrl("cities"),
        ];

        return $data;
    }
}
