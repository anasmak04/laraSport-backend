<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "id" => $this->id,
            "firstname" => $this->firstName,
            "lastname" => $this->lastName,
            "city" => $this->city,
            "email" => $this->email,
            "roles" => $this->whenLoaded('roles')->pluck('name'),

        ];

    }
}
