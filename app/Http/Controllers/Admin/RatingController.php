<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function userRating()
    {
        $ratings = Rating::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.rating.index', compact('ratings'));
    }

    public function show($id)
    {
        $rating = Rating::findOrFail(intval($id));
        if ($rating->is_read == 0) {
            $rating->is_read = 1;
            $rating->save();
        }
        $user_id = $rating->user_id;
        $userRatings = Rating::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $item_id = $rating->item_id;
        $rating_num = Rating::where('item_id', $item_id)->sum('rating');
        return view('admin.rating.show', compact('rating', 'userRatings', 'rating_num'));
    }


    public function destroy($id)
    {
        $rating = Rating::findOrFail(intval($id));
        $rating->delete();

        return redirect()->back()->with('successMsg', 'User Rating Delete Successfully!');
    }
}
