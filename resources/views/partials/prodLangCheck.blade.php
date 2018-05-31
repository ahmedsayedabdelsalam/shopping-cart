@php
if($locale == 'ar' && !empty($product->title_ar) && !empty($product->description_ar) && !empty($product->price_ar)) {
  $productTilte = $product->title_ar;
  $productDescription = $product->description_ar;
  $productPrice = $product->price_ar;
} else {
  $productTilte = $product->title;
  $productDescription = $product->description;
  $productPrice = $product->price;
 }
@endphp