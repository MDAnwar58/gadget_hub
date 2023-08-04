<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderProcessController extends Controller
{
    public function index()
    {
        if (Auth::user()->status == 'admin')
        {
            $order_items = OrderItem::all();
            return view('admin.order_process.index', compact('order_items'));
        }else
        {
            return redirect()->back();
        }
    }
    public function statusChange($id)
    {
        $order_item = OrderItem::find($id);
        if ($order_item->order_status == 0)
        {
            $order_item->order_status = 1;
            $order_item->save();

            return redirect()->back()->with('success', 'Order is confirm successfully');
        }elseif ($order_item->order_status == 1) {
            $user_email = $order_item->user->email;
            Mail::to($user_email)->send(new OrderConfirmation($order_item));
            $order_item->order_status = 2;
            $order_item->save();

            return redirect()->back()->with('success', 'Order is confirm successfully');
        }
    }
    public function info($id)
    {
        $order_item = OrderItem::findOrFail(intval($id));
//        if ($order_item->is_read = 0)
//        {
            $order_item->is_read = 1;
            $order_item->save();
//        }

        return view('admin.item.show', compact('order_item'));
    }
    public function destroy($id)
    {
        $order_item = OrderItem::findOrFail(intval($id));
        $order_item->delete();

        return response()->json([
           'status' => 200,
           'success' => 'Order info has been deleted successfully!'
        ]);
    }
}
