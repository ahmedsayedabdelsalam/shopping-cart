<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addItem($product) {
        $storedItem = ['item' => $product, 'qty' => 0, 'price'=> $product->price];
        if($this->items) {
            if(array_key_exists($product->id, $this->items)) {
                $storedItem = $this->items[$product->id];
            }
        }
        $storedItem['qty'] ++;
        $storedItem['price'] = $product->price * $storedItem['qty'];

        $this->items[$product->id] = $storedItem;
        $this->totalQty ++;
        $this->totalPrice += $product->price;
    }

    public function reduceByOne($id) {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        if($this->items[$id]['qty'] <=0) {
            unset($this->items[$id]);
        }
    }
    
    public function removeItem($id) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
