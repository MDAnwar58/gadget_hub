@extends('layouts.frontend')
@section('title', 'My Account')

@section('content')
    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="row myaccount-row">
                <div class="col-xs-12 col-sm-9">
                    <form class="form-horizontal" action="{{ route('user.info.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                    class="img-circle profile-avatar" alt="User avatar">
                            </div>
                            <div style="text-align: right;">
                                <a href="{{ route('user.info.destroy', Auth::user()->id) }}" class="btn btn-danger">Delete
                                    Your Profile</a>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Your Account info</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Your Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('orders.history') }}"><h4 class="panel-title">Your Order Histroies</h4></a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @if ($user_orders->count() > 0)
                                    @foreach ($user_orders as $user_order)
                                        <div class="col-xs-12">
                                            <img src="{{ url('uploads/item', $user_order->item->image) }}" style="width: 100px; float:left;" alt="{{ $user_order->item->name }}">
                                            <div class="content-box" style=" float:left;">
                                                <a href="{{ route('order.history.show', $user_order->id) }}"><h5 style="margin: 2.5rem 0 0 .5rem; font-size: 20px; font-weight: 600;">{{ $user_order->item->name }}</h5></a>
                                                <p style="margin: .5rem 0 0 .5rem;">{{ $user_order->item->price }} Tk</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="user_order_history_pagination" style="text-align:center;">
                                        {{ $user_orders->links() }}
                                    </div>
                                @else
                                <div class="col-xs-12">
                                        <p style="margin: .5rem 0 0 .5rem;">Orders Not Fonud</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /container -->
        </div>
    </div>
    <!-- /SECTION -->
@endsection
