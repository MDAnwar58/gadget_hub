<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $order_user_id = Auth::user()->id;
        $order = Order::where('user_id', $order_user_id)->first();
        $cart_items = Cart::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('frontend.checkout.index', compact('carts', 'order', 'cart_items', 'categories'));
    }
}
