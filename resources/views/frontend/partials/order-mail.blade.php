<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-5.3.min.css') }}">
</head>

<body>
    <h1 class="text-center">
        <center>Your Info Details & Item</center>
    </h1>
    <p>Your Name: {{ $order->name }}</p>
    <p>Your Email: {{ $order->email }}</p>
    <p>Your Number: {{ $order->number }}</p>
    <p>Your Address: {{ $order->address }}</p>
    <p>Your House No: {{ $order->house_no }}</p>


    <table border="1|0" style="width: 100%; text-align: right;">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartitems as $cartitem)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>
                    <img src="{{ url('http://localhost:8000/uploads/item', $cartitem->item->image) }}" style="width: 60px; height: 60px;"
                        alt="">
                </td>
                <td>{{ $cartitem->quentity }}</td>
                <td>{{ $cartitem->price * $cartitem->quentity }}</td>
                <td>
                    @if($cartitem->order_status == 0)
                    <span
                        style="color: #fff; background-color: #0a6ebd; padding: .3rem .5rem; border-radius: 5px;">Pendding</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfooter>
            <tr>
                @php
                $total_price = 0;
                $user_id = Auth::check() ? Auth::user()->id : '';
                $data = App\Models\Cart::where('user_id', $user_id)->get();
                foreach ($data as $value){
                $total_price += $value->price * $value->quentity;
                }
                @endphp
                <th colspan="5">Total Price: {{ $total_price }}</th>
            </tr>
        </tfooter>
    </table>
</body>

</html>
