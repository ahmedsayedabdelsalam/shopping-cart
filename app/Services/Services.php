<?php

namespace App\Services;


class Services
{
    public static function RecommendedProducts($allItems) {
        $allItems = array_unique($allItems);
        $categories = \DB::table('category_product')->whereIn('product_id', $allItems)->pluck('category_id')->toArray();
        $categories = array_unique($categories);
        $productsRec = \App\Product::whereHas('categories', function($q) use($categories) {
            $q->whereIn('category_id', $categories);
        })->whereNotIn('id', $allItems)->with('categories')->paginate(6);
        return $productsRec;
    } 
}
