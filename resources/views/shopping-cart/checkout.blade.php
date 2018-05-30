@extends('layouts.master')

@section('title', 'Check Out')

@section('content')
<div class="register mt-3 col-md-4 offset-md-4">
    <h1>Check Out</h1>
    <h3>Your Total : <strong>{{ $totalPrice ?? 0 }}</strong></h3>
    <form action="/{{App::getLocale()}}/checkout" method="POST" id="payment-form">
        <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'd-none' : '' }}">{{ Session::get('error') }}</div>
        {{ csrf_field() }}
       
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
        </div>
        
        <div class="form-group">
            <label for="address">Adderess</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Address" required>
        </div>

        <div class="form-group">
            <label for="cardName">Card Holder Name</label>
            <input type="text" name="cardName" class="form-control" id="cardName" placeholder="Card Holder Name" required>
        </div>

        <div class="form-group">
            <label for="cardNumber">Credit Card Number</label>
            <input type="text" name="cardNumber" class="form-control" id="cardNumber" placeholder="Credit Card Number" required>
        </div>

        <div class="form-group">
            <label for="exMonth">Expiration Month</label>
            <input type="text" name="exMonth" class="form-control" id="exMonth" placeholder="Expiration Month" required>
        </div>

        <div class="form-group">
            <label for="exYear">Expiration Year</label>
            <input type="text" name="exYear" class="form-control" id="exYear" placeholder="Expiration Year" required>
        </div>

        <div class="form-group">
            <label for="cvc">CVC</label>
            <input type="text" name="cvc" class="form-control" id="cvc" placeholder="CVC" required>
        </div>
        
        <input type="submit" class="btn btn-primary" value="check out">
    </form>
</div>
@endsection

@section('script')
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ URL::to('js/stripe.js') }}"></script>
@endsection