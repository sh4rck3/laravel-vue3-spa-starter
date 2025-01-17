<?php

namespace App\Http\Resources;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //if no resize image
        try {
            $resized_image = $this->getMedia('*')[0]->getUrl('resized-image');
        } catch (Exception $e) {
            $resized_image="";
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'categories' => $this->categories,
            'content' => substr($this->content, 0, 50) . '...',
            'original_image' => $this->getMedia('*')[0]->getUrl(),
            'resized_image' => $resized_image,
            'created_at' => $this->created_at->toDateString()
        ];
    }
}
