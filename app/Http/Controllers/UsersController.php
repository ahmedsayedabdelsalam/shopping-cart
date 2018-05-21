<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\User;
use Auth;
use App\Events\UserCreatedEvent;


class UsersController extends Controller
{
    public function registerForm() {
        return view('users.signup');
    }

    public function register(Request $request) {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);
        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->save();
        Auth::login($user);
        event(new UserCreatedEvent($user));
        return redirect()->route('profile');
    }

    public function signinForm() {
        return view('users.signin');
    }

    public function signin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            
            // return redirect()->route('profile');
            return redirect()->intended('/user/profile');
        } else {
            return back();
        }
    }

    public function profile(){
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('users.profile', compact('orders'));
    }

    public function logout() {
        Auth::logout();
        Session::forget('cart');
        return redirect()->route('home');
    }
}
