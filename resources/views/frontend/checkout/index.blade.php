@extends('layouts.frontend')

@section('title', 'Items Checkout')


@section('content')

<div class="checkout-bg-content">
    <div class="container">
        <div class="row" style="margin: 5rem 0 10rem 0;">
            <div class="col-lg-9 col-md-9 col-xs-12">
                <div class="row justify-content-lg-center">
                    <div class="col-lg-9 col-md-12 col-xs-12">
                        @if ($order)
                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <h4 class="text-center">Your Details</h4>
                                <hr>

                                <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                @if ($errors->has('user_id'))
                                <span style="color: crimson;">Please <a href="{{ route('login') }}"
                                        class="text-info">login</a> and then order place</span>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter last name" value="{{ $order->name }}">
                                    @if ($errors->has('name'))
                                    <span style="color: crimson;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                id="exampleInputEmail1" placeholder="example@gmail.com"
                                                value="{{ $order->email }}">
                                            @if ($errors->has('email'))
                                            <span style="color: crimson;">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number</label>
                                            <input type="number" name="number" class="form-control" id="number"
                                                placeholder="Enter Phone" value="{{ $order->number }}">
                                            @if ($errors->has('number'))
                                            <span style="color: crimson;">{{ $errors->first('number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" name="address" class="form-control" id="address1"
                                        placeholder="Enter your address ..........." value="{{ $order->address }}">
                                    @if ($errors->has('address'))
                                    <span style="color: crimson;">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">House no.</label>
                                            <input type="number" name="house_no" class="form-control" id="house_no"
                                                placeholder="Enter house no." value="{{ $order->house_no }}">
                                            @if ($errors->has('house_no'))
                                            <span style="color: crimson;">{{ $errors->first('house_no') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="delivery" value="Cash on dalivery"> Cash On
                                        Delivery
                                    </label>
                                </div>
                                @if ($errors->has('delivery'))
                                <span style="color: crimson;">{{ $errors->first('delivery') }}</span>
                                @endif
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Order Place</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="card">
                                <h4 class="text-center your_details">Your Details</h4>
                                <hr>

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                @if ($errors->has('user_id'))
                                <span style="color: crimson;">Please <a href="{{ route('login') }}"
                                        class="text-info">login</a> and then order place</span>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter last name" value="{{ Auth::user()->name }}">
                                    @if ($errors->has('name'))
                                    <span style="color: crimson;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                id="exampleInputEmail1" placeholder="example@gmail.com"
                                                value="{{ Auth::user()->email }}">
                                            @if ($errors->has('email'))
                                            <span style="color: crimson;">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number</label>
                                            <input type="number" name="number" class="form-control" id="number"
                                                placeholder="Enter Phone">
                                            @if ($errors->has('number'))
                                            <span style="color: crimson;">{{ $errors->first('number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" name="address" class="form-control" id="address1"
                                        placeholder="Enter your address ...........">
                                    @if ($errors->has('address'))
                                    <span style="color: crimson;">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">House no.</label>
                                            <input type="number" name="house_no" class="form-control" id="house_no"
                                                placeholder="Enter house no.">
                                            @if ($errors->has('house_no'))
                                            <span style="color: crimson;">{{ $errors->first('house_no') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="delivery" value="Cash on dalivery"> Cash On
                                        Delivery
                                    </label>
                                </div>
                                @if ($errors->has('delivery'))
                                <span style="color: crimson;">{{ $errors->first('delivery') }}</span>
                                @endif
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Order Place</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-md-3 order-details-col">
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-md-12">
                        <div class="card">
                            <h4 class="order_details">Order Details</h4>
                            <hr>
                            <div class="row">
                                @if ($carts->count() > 0)
                                @foreach ($carts as $cart)
                                <div class="col-md-12" style="margin: 0 0 1rem 0;">
                                    <img src="{{ url('uploads/item', $cart->item->image) }}"
                                        style="width: 70px; height: 70px; float: left;" alt="">
                                    <div class="checkout-item-flex" style="float: left; margin: .5rem 0 0 1rem;">
                                        <h6 class="checkout_name">{{ $cart->item->name }}</h6>
                                        <span class="checkout_quentity">Quentity:
                                            {{ $cart->quentity }}</span><br>
                                        <span class="checkout_price">Price:
                                            {{ $cart->price * $cart->quentity }}TK</span>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-md-12">
                                    <h4 class="text-center">Please Include Item</h4>
                                </div>
                                @endif
                                <hr>
                                <div class="col-md-12 text-right">
                                    @php
                                    $user_id = Auth::check() ? Auth::user()->id : '';
                                    $data = App\Models\Cart::where('user_id', $user_id)->get();
                                    $total_price = 0;
                                    foreach ($data as $value) {
                                    $total_price += $value->price * $value->quentity;
                                    }
                                    @endphp
                                    <span class="checkout-total-price">Total Price<span><span>:
                                                {{ $total_price }}TK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
