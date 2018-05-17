@extends('adminlte::page')

@section('title', 'Product Details')

@section('content')

    <!-- small box -->
    <div class="small-box bg-aqua" style="overflow:hidden;position:relative">
      {{-- <img src="{{ asset('storage/product_images/' . $product->imagePath) }}" alt="product pic" style="position:absolute;z-index:0"> --}}
      <div class="inner">
        <h3>${{ $product->price }}</h3>

        <p>{{ $product->title }}</p>
        <p>{{ $product->description }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <a href="/admin/items/{{ $product->id }}/edit" class="small-box-footer">
        Edit Item <i class="fa fa-arrow-circle-right"></i>
      </a>
      <form action="/admin/items/{{ $product->id }}" method="POST" class="small-box-footer">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-danger">Delete Product</button>
      </form>
    </div>


@endsection
