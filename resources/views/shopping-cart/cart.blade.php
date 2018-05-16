@extends('layouts.master')

@section('title', 'Cart')

@section('content')
<div class="register mt-3 col-md-4 offset-md-4">
  <h1>Your Cart</h1>
  @if(Session::has('cart'))
    <ul class="list-group">
      @foreach($products as $product)
        <li class="list-group-item">
          <span>{{ $product['item']['title'] }}</span>
          <span class="badge badge-success">{{ $product['price'] }}</span>
          {{-- <span class="badge badge-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/reduce/{{ $product['item']['id'] }}">Reduce by 1</a>
              <a class="dropdown-item" href="/remove/{{ $product['item']['id'] }}">Reduce All</a>
            </div>
          </span> --}}
          <span class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Action</a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">            
              <li><a href="/reduce/{{ $product['item']['id'] }}">Reduce by 1</a></li>
              <li><a href="/remove/{{ $product['item']['id'] }}">Reduce All</a></li>
            </ul>
          </span>
          <span class="badge float-right">{{ $product['qty'] }}</span>
        </li>
      @endforeach
    </ul>
    <p>Total Quantity : <strong>{{ $totalQty }}</strong></p>
    <p>Total Price : <strong>{{ $totalPrice }}</strong></p>
    <a  href="/checkout" class="btn btn-success">checkout</a>
  @else
    <p>no items in the cart</p>
  @endif
</div>
@endsection