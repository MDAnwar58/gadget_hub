<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function storeCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'price' => 'required|max:255',
            'quentity' => 'required',
        ]);
        $item = Item::find($request->item_id);
        if ($item->quantity <= 0) {
            return redirect()->back()->with("error", "This item quantity is not available... please don't click add to cart button! warning....");
        }
        else
        {
            $cart = Cart::where('item_id', $request->item_id)->where('user_id', $request->user_id)->first();
            if ($cart) {
                $cart->quentity = $cart->quentity + 1;
                $cart->update();

                return redirect()->back()->with('success', 'item has been updated Successfully in your cart!');
            } else {
                $cart = new Cart();
                $cart->user_id = $request->user_id;
                $cart->item_id = $request->item_id;
                $cart->price = $request->price;
                $cart->quentity = $request->quentity;
                $cart->save();

                return redirect()->back()->with('success', 'Item is added Successfully!');
            }
        }
    }


    public function increment($id)
    {
        $cart = Cart::findOrFail(intval($id));
        $cart->quentity = $cart->quentity + 1;
        $cart->save();

        return response()->json($cart);
    }
    public function decrement($id)
    {
        $cart = Cart::findOrFail(intval($id));
        $cart_quetity = $cart->quentity;
        if ($cart_quetity > 1) {
            $cart->quentity = $cart->quentity - 1;
            $cart->save();
        }

        return response()->json($cart);
    }
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Item has been deleted successfully!');
        // return response()->json([
        //     'status' => 200,
        //     'success' => 'Your cart item has been deleted successfully!'
        // ]);
    }
}
