@extends('layouts.frontend')

@section('title', 'Item Details')

@include('frontend.partials.ReviewDetails')

@section('content')

<div class="item-bg-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="card-img">
                            <div class="card-body">
                                <img src="{{ url('uploads/item', $item->image) }}" style="width: 100%;"
                                alt="{{ $item->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 item-details">
                        <h3 style="margin: 4rem 0 1rem 0;">{{ $item->name }}</h3>
                        <div class="d-flex">
                            @if ($ratings->count() > 0)
                                    {{-- @php
                                        $value = $rating_num / $ratings->count();
                                    @endphp
                                    <div id="rateYo" data-rateyo-rating="{{ number_format($value, 1) }}"></div><span
                                        class="rating-number">{{ number_format($value, 1) }}/5</span>
                                        <br> --}}
                                        <!-- Button trigger modal -->
                                        <a class="customer" data-toggle="modal" style="cursor:pointer;"
                                        data-target=".bs-example-modal-lg">Reviews({{ $ratings->count() }}+)</a>
                                        @else
                                        <br>
                                        <!-- Button trigger modal -->
                                        <a class="customer" data-toggle="modal" style="cursor:pointer;"
                                        data-target=".bs-example-modal-lg">Reviews({{ $ratings->count() }}+)</a>
                                        @endif
                                    </div>

                                    <p class="item-price" style="font-size: 20px; font-weight: bolder;">{{ $item->price }} <span
                                        style="font-size: 15px;">TK</span></p>

                                        <p>Available item: {{ $item->quantity }}</p>
                                        <span class="validation_errors text-secondary" style="display: none;">Please <a
                                            href="{{ route('login') }}" class="text-info">Login</a> and then click here</span>
                                            <form action="{{ route('item.store.cart') }}" method="POST">
                                                @csrf
                                                @if (Auth::check())
                                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                                @else
                                                <input type="hidden" name="user_id" value="">
                                                @endif
                                                <input type="hidden" name="item_id" id="item_id" value="{{ $item->id }}">
                                                <input type="hidden" name="price" id="price" value="{{ $item->price }}">
                                                <input type="hidden" name="quentity" id="quentity" value="1">
                                                <button type="submit" class="btn btn-success add_to_card">ADD TO CARD</button>
                                            </form>
                                            <h4 style="margin: 3rem 0 0 0;"><b>Discription:</b></h4>
                                            <p class="des">{{ $item->description }}</p>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row" style="margin: 8rem 0 0 0;">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" style="font-size: 1em; font-weight:500;">
                                                        Questions About This Product
                                                    </div>
                                                    <div class="panel-body d-flex">
                                                        <div class="row">
                                                            @if (Auth::check())
                                                            <div class="col-xs-12" style="padding: 0 2rem 2rem 2rem;">
                                                                @if ($errors->any())
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                                @endif
                                                                <form action="{{ route('question.store') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="user_id"
                                                                    value="{{ Auth::check() ? Auth::user()->id : '' }}">
                                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                                    <div class="form-group">
                                                                        <textarea name="question" class="form-control" rows="2"></textarea>
                                                                        <button type="submit" class="btn btn-warning">ASK
                                                                        QUESTION</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            @endif

                                                            @if ($questions->count() > 0)
                                                            @foreach ($questions as $question)
                                                            @php
                                                            $question_id = $question->id;
                                                            $user_id = Auth::check() ? Auth::user()->id : '';
                                                            $item_id = $item->id;
                                                            $answers = \App\Models\Answer::where('user_id', $user_id)
                                                            ->where('item_id', $item_id)
                                                            ->where('question_id', $question_id)
                                                            ->get();
                                                            @endphp
                                                            @if ($answers->count() > 0)
                                                            <div class="col-xs-12" style="padding: 1rem 2rem 2rem 2rem;">
                                                                <span class="bg-primary"
                                                                style="padding: .5rem 1rem; border-radius: 5px;">Q</span>
                                                                <span style="padding: 0 0 0 1rem;">
                                                                    {{ $question->question }}
                                                                </span><br>
                                                                <span style="padding: 0 0 0 4.5rem;"
                                                                class="text-muted">{{ $question->user->name }} -
                                                                {{ date('d F, Y', strtotime($question->created_at)) }}</span>
                                                            </div>
                                                            @foreach ($answers as $answer)
                                                            <div class="col-xs-12" style="padding: 0 2rem 2rem 2rem;">
                                                                <span class="bg-danger"
                                                                style="padding: .5rem 1rem; border-radius: 5px;">A</span>
                                                                <span style="padding: 0 0 0 1rem;">
                                                                    {{ $answer->answer }}
                                                                </span><br>
                                                                <span style="padding: 0 0 0 4.5rem;"
                                                                class="text-muted">Admin -
                                                                {{ date('d F, Y', strtotime($answer->created_at)) }}</span>
                                                            </div>
                                                            @endforeach
                                                            @else
                                                            <div class="col-xs-12" style="padding: 1rem 2rem 2rem 2rem;">
                                                                <span class="bg-primary"
                                                                style="padding: .5rem 1rem; border-radius: 5px;">Q</span>
                                                                <span style="padding: 0 0 0 1rem;">
                                                                    {{ $question->question }}
                                                                </span><br>
                                                                <span style="padding: 0 0 0 4.5rem;"
                                                                class="text-muted">{{ $question->user->name }} -
                                                                {{ date('d F, Y', strtotime($question->created_at)) }}</span>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                            <div class="col-xs-12" style="padding: 1rem 2rem 2rem 2rem;">
                                                                <p>Questions not found</p>
                                                            </div>
                                                            @endif
                                                            @if (!Auth::check())
                                                            <div class="col-xs-12" style="padding: 0 2rem 2rem 2rem;">
                                                                <p>Please <a href="{{ route('login') }}">login</a> and then ask any
                                                                question.</p>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 5rem 0 0 0;">
                                        <div class="col-md-12">
                                            <h2 class="text-center">Related Item</h2>
                                            <div class="text-center item-span">
                                                <span class="first-span"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 0 0 5rem 0;">
                                        @if ($items->count() > 0)
                                        @foreach ($items as $c_item)
                                        @if ($c_item->id == $item->id)
                                        <div class="col-md-12">
                                            <h3 class="text-center">Item Is Not Found</h3>
                                        </div>
                                        @continue;
                                        @endif
                                        <div class="col-md-4 col-lg-3">
                                            <div class="product" style="border-radius: 0px;">
                                                <div class="product-body">
                                                    <a href="{{ route('items.show', $c_item->id) }}">
                                                        <img src="{{ asset('uploads/item/' . $c_item->image) }}"
                                                        class="img-responsive" alt="Food"
                                                        style="height:300px; border-radius: 0px;">
                                                        <div class="menu-desc text-center" style="margin: 2rem 0 0 0;">
                                                            <span>
                                                                <h3>{{ $c_item->name }}</h3>
                                                            </span>
                                                        </div>
                                                    </a>
                                                    <h2 class="white">Tk{{ $c_item->price }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endsection

                    @section('script')

                    <script>
        // for rating show

        $(function() {

            $(".user_rateyo_user").rateYo({
                readOnly: true,
                ratedFill: "#8bc34a",
                starWidth: "15px",
                spacing: "2px"
            });

            $("#rateYo_rating_user").rateYo({
                ratedFill: "#8bc34a",
                starWidth: "25px",
                spacing: "2px"
            })
            .on("rateyo.change", function(e, data) {

                var rating = data.rating;
                $('.rating_user').text(rating);
                $('#rating').val(rating);
                $('.rating_user').css('background-color', 'black');
                $('.rating_user').css('color', 'white');
                $('.rating_user').css('padding', '0 1rem');
            });
        });
    </script>

    @endsection
