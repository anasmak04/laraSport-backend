<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubRessource extends JsonResource
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
            "description" => $this->description,
            "city" => $this->city->name,
        ];

        return $data;

    }
}
