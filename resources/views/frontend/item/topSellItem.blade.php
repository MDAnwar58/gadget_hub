@extends('layouts.frontend')
@section('title', 'Top Selling Items')

@section('content')


    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">All Top Selling Items</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    @if ($topItems->count() > 0)
                        <div class="row">

                            @foreach ($topItems as $topItem)
                                <!-- product -->
                                <div class="col-md-3 col-md-4">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{ url('uploads/item', $topItem->item->image) }}"
                                                style="height: 40vh;" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $topItem->item->category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('items.show', $topItem->item->id) }}">{{ $topItem->item->name }}</a>
                                            </h3>
                                            <h4 class="product-price">{{ $topItem->item->price }} TK</h4>
                                            <form action="{{ route('item.store.cart') }}" method="POST">
                                                @csrf
                                                @if (Auth::check())
                                                    <input type="hidden" name="user_id" id="user_id"
                                                        value="{{ Auth::user()->id }}">
                                                @else
                                                    <input type="hidden" name="user_id" value="">
                                                @endif
                                                <input type="hidden" name="item_id" id="item_id"
                                                    value="{{ $topItem->item->id }}">
                                                <input type="hidden" name="price" id="price"
                                                    value="{{ $topItem->item->price }}">
                                                <input type="hidden" name="quentity" id="quentity" value="1">
                                                <div class="add-to-cart">
                                                    <button type="submit" class="add-to-cart-btn">
                                                        add to cart
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /product -->
                            @endforeach
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
                    {{ $topItems->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->






@endsection
