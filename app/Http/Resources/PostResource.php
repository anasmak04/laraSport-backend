<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "content" => $this->content,
            "publish_date" => $this->publish_date,
            "category" =>  $this->category->name,
            "user" => $this->user->name,
            'image' => $this->getMedia('posts')->map(function ($item) {
                return $item->getUrl();
            }),

            'tags' => $this->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                ];
            }),

        ];

        return $data;
    }
}
