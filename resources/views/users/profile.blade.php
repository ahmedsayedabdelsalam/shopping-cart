@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="register mt-3 col-md-4 offset-md-4">
    <h1>Welcome to Profile</h1>
    <h4>your orders</h4>
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
                @endforeach
            </ul>
        </div>
        <div class="card-footer bg-transparent border-success">Total Price : ${{ $order->cart->totalPrice }}</div>
    </div>
    @endforeach
</div>
@endsection