<?php

namespace App\Services;

use App\Product;



class Services
{
    public static function RecommendedProducts($taxonomy, $allItems) {
        $allItems = array_unique($allItems);
        if($taxonomy == 'category') {
            $categories = \DB::table('category_product')->whereIn('product_id', $allItems)->pluck('category_id')->toArray();
            $categories = array_unique($categories);
            $productsRec = Product::whereHas('categories', function($q) use($categories) {
                $q->whereIn('category_id', $categories);
            })->whereNotIn('id', $allItems)->with('categories', 'family')->paginate(6);
            return $productsRec;

        } elseif($taxonomy == 'family') {
            $families = Product::whereIn('id', $allItems)->pluck('family_id')->toArray();;
            $productsRec = Product::whereHas('family', function($q) use($families) {
                $q->whereIn('family_id', $families);
            })->whereNotIn('id', $allItems)->with('categories', 'family')->paginate(6);
            return $productsRec;
        }
    } 
}
