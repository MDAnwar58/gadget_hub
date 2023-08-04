<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Cart;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\Question;
use App\Models\Rating;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status == 'admin')
        {
            $categories = Category::all();
            return view('admin.category.index',compact('categories'));
        }else
        {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->status == 'admin')
        {
            return view('admin.category.create');
        }else
        {
        return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required',
        ]);
        // dd($request->image);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-category-'.$extension;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect()->route('category.index')->with('successMsg', 'Category created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->status == 'admin')
        {
            $category = Category::find($id);
            return view('admin.category.edit',compact('category'));
        }else
        {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'nullable'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        if ($request->hasFile('image')) {

            if(file_exists('uploads/category/'.$category->image))
            {
                unlink('uploads/category/'.$category->image);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-category update-'.$extension;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect()->route('category.index')->with('successMsg', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category_id = $category->id;
        $items = Item::where('category_id', $category_id)->get();
        if($items->count()>0)
        {
            foreach($items as $item)
            {
                if(file_exists('uploads/item/'.$item->image))
                {
                    unlink('uploads/item/'.$item->image);
                }
                $item_id = $item->id;
                $carts = Cart::where('item_id', $item_id)->get();
                $order_items = OrderItem::where('item_id', $item_id)->get();
                $ratings = Rating::where('item_id', $item_id)->get();
                $questions = Question::where('item_id', $item_id)->get();
                $answers = Answer::where('item_id', $item_id)->get();
                if($carts->count()>0)
                {
                    foreach($carts as $cart)
                    {
                        $cart->delete();
                        // dd($order_item);
                    }

                    $item->delete();
                }else
                {
                    $item->delete();
                }

                if($order_items->count()>0)
                {
                    foreach($order_items as $order_item)
                    {
                        $order_item->delete();
                        // dd($order_item);
                    }

                    $item->delete();
                }else
                {
                    $item->delete();
                }

                if($ratings->count()>0)
                {
                    foreach($ratings as $rating)
                    {
                        $rating->delete();
                        // dd($order_item);
                    }

                    $item->delete();
                }else
                {
                    $item->delete();
                }

                if($questions->count()>0)
                {
                    foreach($questions as $question)
                    {
                        $question->delete();
                        // dd($order_item);
                    }

                    $item->delete();
                }else
                {
                    $item->delete();
                }

                if($questions->count()>0)
                {
                    foreach($questions as $question)
                    {
                        $question->delete();
                        // dd($order_item);
                    }

                    $item->delete();
                }else
                {
                    $item->delete();
                }

                if($answers->count()>0)
                {
                    foreach($answers as $answer)
                    {
                        $answer->delete();
                        // dd($order_item);
                    }

                    $item->delete();
                }else
                {
                    $item->delete();
                }
            }

            if(file_exists('uploads/category/'.$category->image))
            {
                unlink('uploads/category/'.$category->image);
            }

            $category->delete();
        }else
        {
            if(file_exists('uploads/category/'.$category->image))
            {
                unlink('uploads/category/'.$category->image);
            }

            $category->delete();
        }

         return redirect()->route('category.index')->with('successMsg', 'Category Deleted Successfully');
    }
}
