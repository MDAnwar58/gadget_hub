@extends('layouts.frontend')
@section('title', 'Category Items')

@section('content')


    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Category Items</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    @if ($category_items->count() > 0)
                        <div class="row">

                            @foreach ($category_items as $category_item)
                                <!-- product -->
                                <div class="col-md-3 col-md-4">
                                    <div class="product">
                                        <div class="product-img">
                                            @if ($category_item->quantity <= 0)
                                                <div style="" class="stock_out">
                                                    <span class="stock_out_text text-center" style="">
                                                        <h3>Stock out</h3>
                                                    </span>
                                                    <img class="stock_out_img" src="{{ url('uploads/item', $category_item->image) }}"
                                                    style="height: 40vh; width: 100%;" alt="">
                                                </div>
                                            @else
                                                <img src="{{ url('uploads/item', $category_item->image) }}"
                                                    style="height: 40vh;" alt="">
                                            @endif
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $category_item->category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('items.show', $category_item->id) }}">{{ $category_item->name }}</a>
                                            </h3>
                                            <h4 class="product-price">{{ $category_item->price }} TK</h4>
                                            {{-- <div class="product-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div> --}}
                                            <form action="{{ route('item.store.cart') }}" method="POST">
                                                @csrf
                                                @if (Auth::check())
                                                    <input type="hidden" name="user_id" id="user_id"
                                                        value="{{ Auth::user()->id }}">
                                                @else
                                                    <input type="hidden" name="user_id" value="">
                                                @endif
                                                <input type="hidden" name="item_id" id="item_id"
                                                    value="{{ $category_item->id }}">
                                                <input type="hidden" name="price" id="price"
                                                    value="{{ $category_item->price }}">
                                                <input type="hidden" name="quentity" id="quentity" value="1">
                                                @if (!$category_item->quantity <= 0)
                                                    <div class="add-to-cart">
                                                        <button type="submit" class="add-to-cart-btn"><i
                                                                class="fa fa-shopping-cart"></i> add to
                                                            cart</button>
                                                    </div>
                                                @endif
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
                                <h4>This item stock out</h4>
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
                    {{ $category_items->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /SECTION -->






@endsection
