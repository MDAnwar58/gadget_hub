@extends('layouts.frontend')
@if (Route::is('all.item.show'))
    @section('title', 'All Items')
@endif
@if (Route::is('item.search'))
    @section('title', 'Search Items')
@endif
@if (Route::is('category.item'))
    @section('title', 'Category Items')
@endif


@section('content')


    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                @if (Route::is('category.item'))
                    <div class="col-md-12">
                        <a href="{{ route('all.item.show') }}" class="btn btn-default">Back All Items</a>
                    </div>
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title" style="">{{ $category->name }}</h3>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">Items</h3>
                        </div>
                    </div>
                @endif
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    @if ($searchItems->count() > 0)
                        <div class="row item_row">
                            @include('layouts.partial.allItemList')
                        </div>
                    @else
                        <!-- product -->
                        <div class="product">
                            <div class="product-body">
                                <h4>Items Is Not Found</h4>
                            </div>
                        </div>
                        <!-- /product -->
                    @endif

                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /container -->
        </div>
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <div class="row item_see_more">
                <div class="col-md-12">
                    {{ $searchItems->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->






@endsection
