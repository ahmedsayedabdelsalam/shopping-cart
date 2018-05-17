@extends('adminlte::page')

@section('title', 'Products')

@section('content')
@foreach($products as $product)
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua" style="overflow:hidden;position:relative">
      {{-- <img src="{{ asset('storage/product_images/' . $product->imagePath) }}" alt="product pic" style="position:absolute;z-index:0"> --}}
      <div class="inner">
        <h3>${{ $product->price }}</h3>

        <p>{{ $product->title }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <a href="/admin/items/{{ $product->id }}" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
</div>
@endforeach

@endsection
