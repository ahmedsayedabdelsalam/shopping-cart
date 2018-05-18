@extends('layouts.master')

@section('title', 'Shopping Cart')

@section('style')
  <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
@endsection

@section('content')
  @include('partials.message')
  @foreach($products->chunk(3) as $productChunk)
    <div class="row">
      @foreach($productChunk as $product)
        <div class=" col-lg-4">
          <div class="card mt-3">
              <img class="card-img-top" src="{{ asset('storage/product_images/' . $product->imagePath) }}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{ $product->title }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <strong>{{ $product->price }}$</strong>
                <a href="/shopping-cart/{{ $product->id }}" class="btn btn-success float-right">Add to Cart</a>
                {{-- <ul class="list-unstyled">
                  @foreach($product->categories as $category)
                    <li>{{ $category->title }}</li>
                  @endforeach
                </ul> --}}
                <div class="clearfix"></div>
                <div><i class="fas fa-tag"></i> {{ implode(", ", $product->categories->pluck('title')->toArray()) }}</div>
              </div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach
@endsection