<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Hashing\HashManager;

class MyAccountController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail(intval($id));
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $cart_items = Cart::orderBy('created_at', 'DESC')->get();
        $user_id = Auth::user()->id;
        $user_orders = OrderItem::where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.myAccount.index', compact('user', 'categories', 'cart_items', 'user_orders'));
    }

    public function infoUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'f_name' => 'nullable',
            'l_name' => 'nullable',
            'name' => 'required',
            'location' => 'nullable',
            'position' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required',
            'address' => 'nullable',
            'current_password' => 'nullable',
            'password' => 'nullable',
        ]);

        $user = User::findOrFail(intval($id));
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->name = $request->name;
        $user->location = $request->location;
        $user->position = $request->position;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;

        // $auth = Auth::user();
        // if (!$request->current_password == $auth->password)
        // {
        //     return "sdfdf";
        // }else
        // {
        //     // $user->password = Hash::make($request->password);
        // }


        $user->update();

        return redirect()->back()->with('success', 'Your Information Has Been Updated Successfully!');
    }

    public function infoDestroy($id)
    {
        $user = User::findOrFail(intval($id));
        $user->delete();

        return redirect()->route('login');
    }
}
