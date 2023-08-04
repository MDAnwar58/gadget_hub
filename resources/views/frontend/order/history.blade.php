@extends('layouts.frontend')

@section('title', 'Order Histories')


@section('content')

    <div class="order-history-bg-content" style="margin: 5rem 0 7rem 0;">
        <div class="container">
            <div class="row" style="justify-content: center; display: flex;">
                <div class="col-lg-4">
                    <h3 class="text-center" style="padding: 0 0 2rem 0;">Item Orders History</h3>
                    <div class="row">
                        @if ($orders->count() > 0)
                            @foreach ($orders as $order)
                                @if ($order->order_status == 0)
                                    <div class="col-xs-12">
                                        <div class="thumbnail text-center">
                                            <img src="{{ url('uploads/item', $order->item->image) }}"
                                                style="width: 100px; height: 100px;" alt="$order->item->name">
                                            <div class="item-order-body" style="margin: 2rem 0 0 0;">
                                                <a
                                                    href="{{ route('order.history.show', $order->id) }}">{{ $order->item->name }}</a>
                                                <p>Quantity: {{ $order->quentity }}</p>
                                                <p>Price: {{ $order->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-xs-12">
                                        <div class="thumbnail order_complete text-center">
                                            <img src="{{ url('uploads/item', $order->item->image) }}"
                                                style="width: 100px; height: 100px;" alt="{{ $order->item->name }}">
                                            <div class="item-order-body">
                                                <a
                                                    href="{{ route('order.history.show', $order->id) }}">{{ $order->item->name }}</a>
                                                <p>Quantity: {{ $order->quentity }}</p>
                                                <p>Price: {{ $order->price }}</p>
                                                <h4>Your delivery is completed</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="order-history-pagination">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="col-xs-12 order-history-col">
                                <div class="card d-flex">
                                    <h3 class="text-center">Item Is Not Found</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
