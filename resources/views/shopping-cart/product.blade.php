@extends('layouts.master')

@section('title', 'Shopping Cart')

@section('style')
  <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
@endsection

@section('content')
  @include('partials.message')

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

    <div class="card mt-3">
        <img class="card-img-top" src="{{ asset('storage/product_images/' . $product->imagePath) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><a href="/products/{{ $product->slug }}">{{ $productTilte }}</a></h5>
            <p class="card-text">{{ $productDescription }}</p>
            <strong>{{ $productPrice }}$</strong>
            <a href="/shopping-cart/{{ $product->id }}" class="btn btn-success float-right">{{ __('main.add_to_cart') }}</a>
            {{-- <ul class="list-unstyled">
                @foreach($product->categories as $category)
                <li>{{ $category->title }}</li>
                @endforeach
            </ul> --}}
            <div class="clearfix"></div>
            <div><i class="fas fa-tag"></i> {{ implode(", ", $product->categories->pluck('title')->toArray()) }}</div>
            <div><i class="fas fa-box-open"></i> <a href="/family/{{ $product->family->slug }}">{{ $product->family->title }}</a></div>
        </div>
    </div>

@endsection