@extends('layouts.app')

@section('title', 'Users Rating')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title"> Ratings - {{ $rating->user->name }} </h4>
                        </div>
                        <div class="row px-md-3 px-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-left">
                                                {{-- <a href="#"> --}}
                                                <img class="media-object" src="{{ asset('frontend/img/user_img1.png') }}"
                                                    style="width: 70px; height: 70px;" alt="...">
                                                {{-- </a> --}}
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading ml-4">{{ $rating->user->name }}</h4>
                                                <div class="user_rating_show_rateyo ml-3"
                                                    data-rateyo-rating="{{ $rating->rating }}">
                                                </div>
                                                <div class="ml-4 mt-1">{{ $rating->des }}</div>
                                            </div>
                                        </div>
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


@section('script')

    <script>
        // for rating show
        $(function() {

            $(".user_rating_show_rateyo").rateYo({
                readOnly: true,
                ratedFill: "#8bc34a",
                starWidth: "15px",
                spacing: "2px",
            });
        });
    </script>

@endsection
