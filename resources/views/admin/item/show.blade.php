@extends('layouts.app')

@section('title','User Order Process')

@push('css')



@endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">{{ $order_item->order->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <p>User Email: {{ $order_item->order->email }}</p>
                                    <p>User Number: {{ $order_item->order->number }}</p>
                                    <p>User Addrass: {{ $order_item->order->address }}</p>
                                    <p>User House No: {{ $order_item->order->house_no }}</p>
                                    <p>Delivery: <span class="bg-primary text-light p-1" style="border-radius: 5px; font-weight: 600; font-size: 13px;">{{ $order_item->order->delivery }}</span></p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <img src="{{ url('uploads/item', $order_item->item->image) }}" style="width: 100%; height: 40vh;" alt="{{ $order_item->item->name }}">
                                    <div class="pt-2"></div>
                                    <span class="pl-2">{{ $order_item->item->name }}</span><br>
                                    <span class="pl-2">Quatity: {{ $order_item->quentity }}</span><br>
                                    <span class="pl-2">Price: {{ $order_item->price * $order_item->quentity }} TK</span><br>
                                    <span class="pl-2">Order Status:
                                        @if($order_item->order_status == 1)
                                        <span class="badge badge-success">complete</span>
                                        @else
                                        <span class="badge badge-warning">pendding</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pb-3 pr-3" style="text-align: right;">
                            {{ date('d F, Y', strtotime($order_item->created_at)) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')

    <script src="{{ asset('backend/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script>


@endpush
