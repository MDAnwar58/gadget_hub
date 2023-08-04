<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Brian2694\Toastr\Facades\Toastr; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        if (Auth::user()->status == 'admin')
        {
            $contacts = Contact::all();
            return view('admin.contact.index',compact('contacts'));
        }else
        {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        if (Auth::user()->status == 'admin')
        {
            $contact = Contact::find($id);
            return view('admin.contact.show',compact('contact'));
        }else
        {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        Toastr::success('Contact Message Successfully Deleted','Success',["positionClass" =>"toast-top-right"]);
        return redirect()->back()->with('successMsg','Contact Deleted Successfully');
    }
}
