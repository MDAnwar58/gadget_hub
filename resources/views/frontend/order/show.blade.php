@extends('layouts.frontend')

@section('title', 'Order History Details')


@section('content')

    <div class="order-history-show-bg-content">
        <div class="container">
            <div class="row" style="margin: 5rem 0 0 0;">
                <div class="col-lg-5">
                    <img src="{{ url('uploads/item', $order->item->image) }}" style="height: 50vh; width: 100%;"
                        alt="">
                </div>
                <div class="col-lg-7">
                    <h3>{{ $order->item->name }}</h3>
                    <p>Quantity: {{ $order->quentity }}</p>
                    <p>Price: {{ $order->quentity * $order->price }}</p>
                    <p><span>Discription: </span><br>{{ $order->item->description }}</p>
                </div>
            </div>
            <div class="row" style="margin: 5rem 0 3rem 0;">
                <form action="{{ route('rating.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="thumbnail">
                                <div class="caption">
                                    <input type="hidden" name="user_id"
                                        @if (Auth::check()) value="{{ Auth::user()->id }}" @else value="" @endif">
                                    <input type="hidden" name="item_id" value="{{ $order->item->id }}">
                                    <div class="form-group d-flex rating_input">
                                        <label for="">Rating:</label>
                                        <div id="rateYo_rating"></div>
                                        <span class="rating_num"></span>
                                        <input type="hidden" name="rating" id="rating" value="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="des" id="des" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-form">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>

            <div class="row" style="margin: 0 0 10rem 0;">
                <div class="col-xs-12">
                    <div class="thumbnail">
                        <h4 class="text-center">Reviews</h4>
                        <hr>
                        <div class="row">
                            @if ($ratings->count() > 0)
                                @foreach ($ratings as $rating)
                                    <div class="col-xs-12">
                                        <div class="thumbnail">
                                            <div class="caption">
                                                <div class="media">
                                                    <div class="media-left">
                                                        {{-- <a href="#"> --}}
                                                        <img class="media-object"
                                                            src="{{ asset('frontend/img/user_img1.png') }}"
                                                            style="width: 70px; height: 70px;" alt="...">
                                                        {{-- </a> --}}
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">{{ $rating->user->name }}</h4>
                                                        <div class="show_rateyo"
                                                            data-rateyo-rating="{{ $rating->rating }}"></div>
                                                        {{ $rating->des }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-xs-12">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3 class="text-center">No Review Here</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <script>
        // for rating insert
        $(function() {

            $("#rateYo_rating").rateYo({
                ratedFill: "#8bc34a",
                starWidth: "20px",
                spacing: "3px"
            });
            $("#rateYo_rating").rateYo()
                .on("rateyo.change", function(e, data) {

                    var rating = data.rating;
                    $('.rating_num').text(rating);
                    $('#rating').val(rating);
                    $('.rating_num').css('background-color', 'black');
                    $('.rating_num').css('color', 'white');
                    $('.rating_num').css('padding', '0 1rem');
                });
        });


        $(function() {

            $(".show_rateyo").rateYo({
                readOnly: true,
                ratedFill: "#8bc34a",
                starWidth: "15px",
                spacing: "2px"
            });
        });
    </script>

@endsection
