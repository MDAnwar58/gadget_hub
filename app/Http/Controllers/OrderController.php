<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $orders = OrderItem::where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(5);
        $cart_items = Cart::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('frontend.order.history', compact('orders', 'cart_items', 'categories'));
    }
    public function show($id)
    {
        $order = OrderItem::findOrFail(intval($id));
        $cart_items = Cart::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $item_id = $order->item->id;
        $ratings = Rating::where('item_id', $item_id)->get();
        return view('frontend.order.show', compact('order', 'cart_items', 'categories', 'ratings', ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'number' => 'required|min:10|max:11',
            'address' => 'required',
            'house_no' => 'required',
            'delivery' => 'required'
        ]);

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->number = $request->number;
        $order->address = $request->address;
        $order->house_no = $request->house_no;
        $order->delivery = $request->delivery;
        // return $order;
        $order->save();

        //        order item store
        $user_id = Auth::user()->id;
        $cartitems = Cart::where('user_id', $user_id)->get();
        foreach ($cartitems as $cart_item) {
            $item_id = $cart_item->item_id;
            $item_quentity = $cart_item->quentity;
            $item_price = $cart_item->price;
            $order_item = new OrderItem();
            $order_item->user_id = Auth::user()->id;
            $order_item->order_id = $order->id;
            $order_item->item_id = $item_id;
            $order_item->quentity = $item_quentity;
            $order_item->price = $item_price;
            $order_item->save();

            $total_quantity = $cart_item->item->quantity - $cart_item->quentity;
            $item = Item::find($item_id);
            if (!$item->quantity <= 0) {
                $item->quantity = $total_quantity;
                $item->save();
            }
        }


        $user_mail = $request->email;
        Mail::to($user_mail)->send(new OrderMail($order, $cartitems));


        $cart_user_id = Auth::check() ? Auth::user()->id : '';
        $carts = Cart::where('user_id', $cart_user_id)->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }

        return redirect()->route('orders.history')->with('success', 'Your item delivery process is start now');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'number' => 'required',
            'address' => 'required',
            'house_no' => 'required',
            'delivery' => 'required'
        ]);

        $order = Order::findOrFail(intval($id));
        $order->user_id = $request->user_id;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->number = $request->number;
        $order->address = $request->address;
        $order->house_no = $request->house_no;
        $order->delivery = $request->delivery;
        $order->update();

        $user_id = Auth::user()->id;
        $cartitems = Cart::where('user_id', $user_id)->get();
        if ($cartitems->count() > 0) {
            foreach ($cartitems as $cart_item) {
                $item_id = $cart_item->item_id;
                $item_quentity = $cart_item->quentity;
                $item_price = $cart_item->price;
                $order_item = new OrderItem();
                $order_item->user_id = Auth::user()->id;
                $order_item->order_id = $order->id;
                $order_item->item_id = $item_id;
                $order_item->quentity = $item_quentity;
                $order_item->price = $item_price;
                $order_item->save();

                $total_quantity = $cart_item->item->quantity - $cart_item->quentity;
                $item = Item::find($item_id);
                if (!$item->quantity <= 0) {
                    $item->quantity = $total_quantity;
                    $item->save();
                }
                // if ($item->quantity <= 0) {
                //     if (file_exists('uploads/item/' . $item->image)) {
                //         unlink('uploads/item/' . $item->image);
                //     }
                //     $item->delete();
                // }
            }

            $user_mail = $request->email;
            Mail::to($user_mail)->send(new OrderMail($order, $cartitems));

            $cart_user_id = Auth::check() ? Auth::user()->id : '';
            $carts = Cart::where('user_id', $cart_user_id)->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }
        } else {
            return redirect()->back()->with('error', 'Item not found in the cart please add item in the cart');
        }

        return redirect()->route('orders.history')->with('success', 'Your item delivery process is start now');
    }
}
