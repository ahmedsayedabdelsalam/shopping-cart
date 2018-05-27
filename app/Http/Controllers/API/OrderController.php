<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Product;
use App\OrderApi;
use Auth;
use App\Order;
use App\Cart;

class OrderController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('auth:api', ['except' => []]);
    }

   
    public function addItem(Request $request, $id)
    {

        if($order = OrderApi::where('product_id', $id)->first()) {
            $order->count ++;
            $order->save();
        } else {
            $order = new OrderApi();
            $order->user_id = auth()->user()->id;
            $order->product_id = $id;
            $order->count = 1;
            $order->save();
        }
        
        return response()->json(["message" => "item added successfully"]);
    }

    public function removeItem($id) {
        $order = OrderApi::where('product_id', $id)->firstOrFail();
        if($order->count > 1) {
            $order->count --;
            $order->save();
        } else {
            $order->delete();
        }

        return response()->json(["message" => "item removed successfully"]);
    }

    public function removeAll() {
        $orders = OrderApi::where('user_id', auth()->user()->id)->get()->each->delete();

        return response()->json(["message" => "All items removed successfully"]);
    }

    public function checkout(Request $request) {

        $orders = OrderApi::where('user_id', auth()->user()->id)->with('product')->get();

        $cart = new Cart(null);

        foreach($orders as $order) {
            $cart->items[$order->product->id]['item'] = $order->product;
            $cart->items[$order->product->id]['qty'] = $order->count;
            $cart->items[$order->product->id]['price'] = $order->product->price * $order->count;
            $cart->totalQty += $cart->items[$order->product->id]['qty'];
            $cart->totalPrice += $cart->items[$order->product->id]['price'];
        }

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'payment_id' => 'required'
        ]);
        
        $order = new Order([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'payment_id' => $request->input('payment_id'),
            'user_id' => auth()->user()->id,
            'cart' => serialize($cart)
        ]);
        $order->save();

        return response()->json(['message' => 'items purchased successfully'], 200);
    }
        
}
