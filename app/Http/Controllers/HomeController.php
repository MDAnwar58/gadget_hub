<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Item;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $collaction_categories = Category::orderBy('created_at', 'DESC')->get();
        $items = Item::orderBy('created_at', 'DESC')->take(10)->get();
        $our_items = Item::all();
        $user_id = Auth::check() ? Auth::user()->id : '';
        $cart_items = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $topItems = OrderItem::selectRaw('order_items.item_id, sum(order_items.quentity) as total')
            ->groupBy('order_items.item_id')
            ->orderBy('total', 'DESC')
            ->take(4)
            ->get();

        return view('welcome', compact('sliders', 'categories', 'collaction_categories', 'items', 'cart_items', 'topItems', 'our_items'));
    }

    public function show($id)
    {
        $item = Item::findOrFail(intval($id));
        $user_id = Auth::check() ? Auth::user()->id : '';
        $item_id = $item->id;
        $category_id = $item->category->id;
        $items = Item::where('category_id', $category_id)
            ->orderBy('created_at', 'DESC')
            ->get();
        $carts = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $ratings = Rating::where('item_id', $item_id)->get();
        $rating_num = Rating::where('item_id', $item_id)->sum('rating');
        $questions = Question::where('user_id', $user_id)->where('item_id', $item_id)->get();
        $cart_items = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('frontend.item.show', compact('rating_num', 'item', 'items',  'ratings', 'carts', 'cart_items', 'categories', 'questions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'rating' => 'required',
            'des' => 'required',
        ]);

        $rating = new Rating();
        $rating->user_id = $request->user_id;
        $rating->item_id = $request->item_id;
        $rating->rating = $request->rating;
        $rating->des = $request->des;
        $rating->save();

        return redirect()->back()->with('success', 'Your Review Is Added Successfully!');
    }

    public function search(Request $request)
    {
        $seach_name = $request->search;
        if ($seach_name == "") {
            $searchItems = Item::orderBy('created_at', 'DESC')->paginate(12);
        } else {
            $searchItems = Item::where("name", 'LIKE', '%' . $seach_name . '%')
                ->orderBy('created_at', 'DESC')->paginate(12);
        }

        $user_id = Auth::check() ? Auth::user()->id : '';
        $cart_items = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('frontend.item.search', compact('searchItems', 'cart_items', 'categories'));
    }

    public function allItemShow()
    {
        $searchItems = Item::orderBy('created_at', 'DESC')->paginate(12);
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $user_id = Auth::check() ? Auth::user()->id : '';
        $cart_items = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();

        return view('frontend.item.search', compact('searchItems', 'cart_items', 'categories'));
    }

    public function CategoryItemShow($id)
    {
        $category_items = Item::where('category_id', $id)->orderBy('created_at', 'DESC')->paginate(12);
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $user_id = Auth::check() ? Auth::user()->id : '';
        $cart_items = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('frontend.item.categoryItem', compact('category_items', 'categories', 'cart_items'));
    }

    public function CategoryItem($id)
    {
        $category = Category::findOrFail(intval($id));
        // echo "Item show";
        $searchItems = Item::where('category_id', $id)->orderBy('created_at', 'DESC')->paginate(12);
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $user_id = Auth::check() ? Auth::user()->id : '';
        $cart_items = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();

        return view('frontend.item.search', compact('categories', 'cart_items', 'searchItems', 'category'));
    }

    public function topItemSelling()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $user_id = Auth::check() ? Auth::user()->id : '';
        $cart_items = Cart::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        $topItems = OrderItem::selectRaw('order_items.item_id, sum(order_items.quentity) as total')
            ->groupBy('order_items.item_id')
            ->orderBy('total', 'DESC')
            ->paginate(10);

        return view('frontend.item.topSellItem', compact('topItems', 'categories', 'cart_items'));
    }
}
