<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Question;
use App\Models\Rating;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users_profile.index', compact('users'));
    }
    public function destory($id)
    {
        $user = User::findOrFail(intval($id));
        $user_id = $user->id;
        $carts = Cart::where('user_id', $user_id)->get();
        $orders = Order::where('user_id', $user_id)->get();
        $orderitems = OrderItem::where('user_id', $user_id)->get();
        $ratings = Rating::where('user_id', $user_id)->get();
        $replies = Reply::where('user_id', $user_id)->get();
        $questions = Question::where('user_id', $user_id)->get();
        $answers = Answer::where('user_id', $user_id)->get();

        if($carts->count() > 0)
        {
            foreach($carts as $cart)
            {
                $cart->delete();
            }
            $user->delete();
        }

        if($orders->count() > 0)
        {
            foreach($orders as $order)
            {
                $order->delete();
            }
            $user->delete();
        }

        if($orderitems->count() > 0)
        {
            foreach($orderitems as $orderitem)
            {
                $orderitem->delete();
            }
            $user->delete();
        }

        if($ratings->count() > 0)
        {
            foreach($ratings as $rating)
            {
                $rating->delete();
            }
            $user->delete();
        }

        if($ratings->count() > 0)
        {
            foreach($ratings as $rating)
            {
                $rating->delete();
            }
            $user->delete();
        }

        if($replies->count() > 0)
        {
            foreach($replies as $replie)
            {
                $replie->delete();
            }
            $user->delete();
        }

        if($questions->count() > 0)
        {
            foreach($questions as $question)
            {
                $question->delete();
            }
            $user->delete();
        }

        if($answers->count() > 0)
        {
            foreach($answers as $answer)
            {
                $answer->delete();
            }
            $user->delete();
        }

        $user->delete();

        return redirect()->back()->with('successMsg', 'User Has Been Deleted Successfully!');
    }
}
