<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\URL;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "imagePath" => URL::to('/') . '/storage/product_images/' . $this->imagePath,
            "title" => $this->title,
            "price" => $this->price,
            "categories" =>  CategoryResource::collection($this->categories)
        ];
    }
}
