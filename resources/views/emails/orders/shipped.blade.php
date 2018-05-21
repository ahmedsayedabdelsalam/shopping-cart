@component('mail::message')
# Items Purchased Successfully

Hello {{ $order->name}},<br>
thank you for purchasing our products.<br>
<br>
your prducts will be delivered at address: {{ $order->address }}

@component('mail::button', ['url' => 'http://shopping-cart.test/user/profile'])
Visit Your Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
