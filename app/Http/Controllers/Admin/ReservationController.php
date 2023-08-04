<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\ReservationConfirmed;
use App\Models\Reservation;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    public function index()
    {
        if (Auth::user()->status == 'admin')
        {
            $reservations = Reservation::all();
            return view('admin.reservation.index',compact('reservations'));
        }else
        {
            return redirect()->back();
        }
    }

    public function status($id)
    {
       $reservation = Reservation::find($id);
       $reservation->status = true;
       $reservation->save();

       Notification::route('mail', $reservation->email)
            ->notify(new ReservationConfirmed());

       Toastr::success('Reservation successfully confirmed.','Success',["positionClass" =>"toast-top-right"]);
        return redirect()->back()->with('successMsg','Reservation Confirmed Successfully');
    }

    public function destroy($id)
    {
       Reservation::find($id)->delete();
       Toastr::success('Reservation Deleted successfully.','Success',["positionClass" =>"toast-top-right"]);
       return redirect()->back()->with('successMsg','Reservation Deleted Successfully');
    }
}
