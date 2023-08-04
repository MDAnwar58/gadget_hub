<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Category;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
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
            $items = Item::all();
            return view('admin.item.index',compact('items'));
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
            $categories = Category::all();
            return view('admin.item.create',compact('categories'));
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
        $this->validate($request,[
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
        $imagename = $slug. '-'.$currentDate. '-'. '.' .$image->getClientOriginalExtension();
        if(!file_exists('uploads/item')){
            mkdir('uploads/item',077,true);
        }

        $image->move('uploads/item',$imagename);

        }else{
            $imagename = 'default.png';
        }

        $item = new Item();
        $item ->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->image = $imagename;
        $item->save();
        return redirect()->route('item.index')->with('successMsg','Item Created Successfully');
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
            $item = Item::find($id);
            $categories = Category::all();
            return view('admin.item.edit',compact('item','categories'));
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
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);


        $item = Item::find($id);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
        $imagename = $slug. '-'.$currentDate. '-'. '.' .$image->getClientOriginalExtension();
        if(!file_exists('uploads/item')){
            mkdir('uploads/item',077,true);
        }

        $image->move('uploads/item',$imagename);

        }else{
            $imagename = $item->image;
        }

        $item ->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->image = $imagename;
        $item->save();
        return redirect()->route('item.index')->with('successMsg','Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item_id = $item->id;
        
        $order_items = OrderItem::where('item_id', $item_id)->get();
        if($order_items->count()>0)
        {
            foreach($order_items as $order_item)
            {
                // dd($order_item);
                $order_item->delete();
            }
            if(file_exists('uploads/item/'.$item->image))
            {
                unlink('uploads/item/'.$item->image);
            }
            $item->delete();
        }else
        {
            if(file_exists('uploads/item/'.$item->image))
            {
                unlink('uploads/item/'.$item->image);
            }
            $item->delete();
        }
       return redirect()->route('item.index')->with('successMsg','Item Deleted Successfully');
    }
}
