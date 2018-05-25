<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Illuminate\Support\Facades\Session;
use App\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use League\Flysystem\Exception;
use App\Order;
use Auth;
use App\Category;
use App\Events\OrderPurchasedEvent;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::with('categories')->paginate(9);
        return view('shopping-cart.index', compact('products'));
    }

    public function category($id) {
        $products = Category::find($id)->products()->paginate(9);
        return view('shopping-cart.index', compact('products'));
    }

    public function shoppingCartView() {
        if(Session::has('cart')) {
            // $products = Session::get('cart')->items;
            // $totalQty = Session::get('cart')->totalQty;
            // $totalPrice = Session::get('cart')->totalPrice;
            // return view('shopping-cart.cart', compact('products', 'totalQty', 'totalPrice'));
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            return view('shopping-cart.cart', ['products' => $cart->items, 'totalQty' => $cart->totalQty, 'totalPrice' => $cart->totalPrice]);
        } else {
            return redirect()->route('home')->with(['alert-danger' => 'please select some items first']);
        }
    }
    
    public function shoppingCart(Request $request, $id) {
        $product = Product::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->addItem($product);

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function reduceItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function removeItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if($cart->totalQty > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function checkoutView() {
        if(Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $totalPrice = $cart->totalPrice;
            return view('shopping-cart.checkout', compact('totalPrice'));
        } else {
            return redirect()->route('home')->with(['alert-danger' => 'please select some items first']);
        }
    }

    public function checkout(Request $request) {
        if(Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            Stripe::setApiKey("sk_test_P21lV4cw4w0ShOpjQTq3wkF0");
            try {
                $charge = Charge::create(array(
                    "amount" => $cart->totalPrice * 100,
                    "currency" => "usd",
                    "source" => $request['stripeToken'], // obtained with Stripe.js
                    "description" => "Charge for " . $request['name']
                ));
                $order = new Order();
                $order->user_id = Auth::id();
                $order->name = $request['name'];
                $order->address = $request['address'];
                $order->payment_id = $charge->id;
                $order->cart = serialize(Session::get('cart'));
                $order->save();
                event(new OrderPurchasedEvent($order));
            } catch(Exception $e) {
                return redirect()->back()->with('error', $e->getMessage);
            }
            Session::forget('cart');
            return redirect()->route('home')->with('alert-success', 'items successfully purchased');
        } else {
            return redirect()->route('home')->with(['alert-danger' => 'please select some items first']);
        }
    }

}
