<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $cart_items = Cart::orderBy('created_at', 'DESC')->get();
        return view('frontend.contact.index', compact('categories', 'cart_items'));
    }
    public function sendMessage(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|regex:/(.*)@gmail.com/i',
            'subject' => 'required',
            'message' => 'required'

        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        Mail::to($request->email)->send(new ContactMail($contact));
        $contact->save();

        Toastr::success('Your message successfully send.','Success',["positionClass" =>"toast-top-right"]);
        return redirect()->back()->with('success', 'Your contact message send successfully!');
    }
}
