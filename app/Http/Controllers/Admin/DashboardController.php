<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->status == 'admin')
        {
            $categoryCount = Category::count();
            $itemCount = Item::count();
            $sliderCount = Slider::count();
            $contactCount = Contact::count();
            return view('admin.dashboard',compact('categoryCount','itemCount','sliderCount','contactCount'));

        }else
        {
            return redirect()->back();
        }
    }
}
