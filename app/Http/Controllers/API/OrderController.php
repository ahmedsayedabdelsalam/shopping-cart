<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderApi;
use Auth;
use App\Order;
use App\Cart;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Http\Resources\CartResource;

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

    public function cart() {
        $orders = OrderApi::where('user_id', auth()->user()->id)->get();
        return CartResource::collection($orders);
    }

    public function checkout(Request $request) {
        // validate request data
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'card_exp_month' => 'required',
            'card_exp_year' => 'required',
            'card_number' => 'required',
            'card_cvc' => 'required'
        ]);

        // create stripe api
        Stripe::setApiKey("sk_test_P21lV4cw4w0ShOpjQTq3wkF0");

        // get card data from user
        $result = Token::create(
            array(
                "card" => array(
                    "name" => $request['name'],
                    "number" => $request['card_number'],
                    "exp_month" => $request['card_exp_month'],
                    "exp_year" => $request['card_exp_year'],
                    "cvc" => $request['card_cvc']
                )
            )
        );

        // generate token if card data is valid
        $token = $result['id'];

        // get orders from orders-api table instead of session 
        $orders = OrderApi::where('user_id', auth()->user()->id)->with('product')->get();

        if($orders->count()) {
            // make new cart object
            $cart = new Cart(null);

            // get data from orders-api table and put it into cart object
            foreach($orders as $order) {
                $cart->items[$order->product->id]['item'] = $order->product;
                $cart->items[$order->product->id]['qty'] = $order->count;
                $cart->items[$order->product->id]['price'] = $order->product->price * $order->count;
                $cart->totalQty += $cart->items[$order->product->id]['qty'];
                $cart->totalPrice += $cart->items[$order->product->id]['price'];
            }

            // make the charge
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "card" => $token,
                "description" => "Charge for test@example.com" 
            ));


            // make order
            $order = new Order([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'payment_id' => $charge->id,
                'user_id' => auth()->user()->id,
                'cart' => serialize($cart)
            ]);
            $order->save();

            $orders->each->delete();

            return response()->json(['message' => 'items purchased successfully'], 200);
        } else {
            return response()->json(['message' => 'put items to cart first'], 200);
        }
        
    }
        
}
