@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="register mt-3 col-md-4 offset-md-4">
    <h1>Welcome to Profile</h1>
    <h4>your orders</h4>
    <?php 
        $allItems = []; 
    ?>
    @foreach($orders as $order)
    <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-body text-success">
            <ul>
                @foreach($order->cart->items as $item)
                <li>
                    <span>{{ $item['item']['title'] }}</span>
                    <span class="badge badge-success">{{ $item['price'] }}</span>
                    <span class="badge float-right">{{ $item['qty'] }}</span>
                </li>
                <?php 
                    $allItems[] = $item['item']['id'];
                ?>
                @endforeach
            </ul>
        </div>
        <div class="card-footer bg-transparent border-success">Total Price : ${{ $order->cart->totalPrice }}</div>
    </div>
    @endforeach
</div>
<?php 

    // $products = App\Product::whereIn('id', $allItems)->with('categories')->get();
    // $categories = [];
    // $start = microtime(true);        
    // foreach($products as $product) {
    //     foreach($product->categories as $category) {
    //         $categories[] = $category->id;
    //     }
    //  

    $productsRec = \App\Services\Services::recommendedProducts($allItems);
?>
<div class="row">
    @foreach($productsRec as $productRec)
    <div class=" col-lg-4">
        <div class="card mt-3">
            <img class="card-img-top" src="{{ asset('storage/product_images/' . $productRec->imagePath) }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $productRec->title }}</h5>
                <p class="card-text">{{ $productRec->description }}</p>
                <strong>{{ $productRec->price }}$</strong>
                <a href="/shopping-cart/{{ $productRec->id }}" class="btn btn-success float-right">Add to Cart</a>
                <div class="clearfix"></div>
                <div><i class="fas fa-tag"></i> {{ implode(", ", $productRec->categories->pluck('title')->toArray()) }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $productsRec->links() }}
@endsection