<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $cart_items = Cart::orderBy('created_at', 'DESC')->get();
        return view('frontend.about.index', compact('categories', 'cart_items'));
    }
}
