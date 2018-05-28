<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    protected function productsRec() {
        $allItems = [];
        foreach($this->orders as $order) {
            $order = unserialize($order->cart);
            foreach($order->items as $item) {
                $allItems[] = $item['item']['id'];
            }
        }
        $productsRec = \App\Services\Services::recommendedProducts($allItems);
        return $productsRec;
    }
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
            "email" => $this->email,
            "orders" => OrdersResource::collection($this->orders),
            "recommendedProducts" => ProductCollection::collection($this->productsRec()),
        ];
    }
}
