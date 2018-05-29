<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "imagePath" => asset('storage/product_images/'. $this->imagePath),
            "title" => $this->title,
            "description" => $this->description,
            "price" => $this->price,
            "categories" =>  CategoryResource::collection($this->categories),
            "family" =>  new FamilyResource($this->family)
        ];
    }
}
