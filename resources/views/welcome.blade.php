@extends('layouts.frontend')
@section('title', 'Home')

@section('content')


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                @if ($collaction_categories->count() > 0)
                    @foreach ($collaction_categories as $collaction_category)
                        <div class="col-md-1 col-xs-3">
                            <div class="thumbnail">
                                <a href="{{ route('category.item.show', $collaction_category->id) }}" class="shop">
                                    <div class="shop-img">
                                        <img src="{{ url('uploads/category', $collaction_category->image) }}" alt="">
                                    </div>
                                    <div class="shop-footer">
                                        <span>{{ $collaction_category->name }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <h3>Category Collection Is Not Found</h3>
                    </div>
                @endif
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="thumbnail">
                <div class="caption" style="padding: 2rem 2rem 3rem 2rem">
                    <div class="row">

                        <!-- section title -->
                        <div class="col-md-12">
                            <div class="section-title" style="text-align: center;">
                                <h3 class="title">New Arraivels</h3>
                            </div>
                        </div>
                        <!-- /section title -->

                        <!-- Products tab & slick -->
                        <div class="col-md-12">
                            @if ($items->count() > 0)
                                <div class="row">
                                    <div class="products-tabs">
                                        <!-- tab -->
                                        <div id="tab1" class="tab-pane active">
                                            <div class="products-slick" data-nav="#slick-nav-1">

                                                @foreach ($items as $item)
                                                    <!-- product -->
                                                    <div class="product">
                                                        <div class="product-img">
                                                            @if ($item->quantity <= 0)
                                                                <div style="" class="stock_out">
                                                                    <span class="stock_out_text text-center" style="">
                                                                        <h3>Stock out</h3>
                                                                    </span>
                                                                    <img class="stock_out_img"
                                                                        src="{{ url('uploads/item', $item->image) }}"
                                                                        style="height: 40vh; width: 100%;" alt="">
                                                                </div>
                                                            @else
                                                                <img src="{{ url('uploads/item', $item->image) }}"
                                                                    style="height: 40vh;" alt="">
                                                            @endif
                                                            {{-- <div class="product-label">
                                                                    <span class="new">NEW</span>
                                                                </div> --}}
                                                        </div>
                                                        <div class="product-body">
                                                            <p class="product-category">{{ $item->category->name }}</p>
                                                            <h3 class="product-name">
                                                                @if ($item->quantity <= 0)
                                                                    <a href="">{{ $item->name }}</a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('items.show', $item->id) }}">{{ $item->name }}</a>
                                                                @endif
                                                            </h3>
                                                            <h4 class="product-price" style="color: black;">
                                                                {{ $item->price }} TK</h4>
                                                            <form action="{{ route('item.store.cart') }}" method="POST">
                                                                @csrf
                                                                @if (Auth::check())
                                                                    <input type="hidden" name="user_id" id="user_id"
                                                                        value="{{ Auth::user()->id }}">
                                                                @else
                                                                    <input type="hidden" name="user_id" value="">
                                                                @endif
                                                                <input type="hidden" name="item_id" id="item_id"
                                                                    value="{{ $item->id }}">
                                                                <input type="hidden" name="price" id="price"
                                                                    value="{{ $item->price }}">
                                                                <input type="hidden" name="quentity" id="quentity"
                                                                    value="1">

                                                                @if (!$item->quantity <= 0)
                                                                    <div class="add-to-cart">
                                                                        <button type="submit" class="add-to-cart-btn">
                                                                            {{-- <i class="fa fa-shopping-cart"></i>  --}}
                                                                            add to cart
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /product -->
                                                @endforeach

                                            </div>
                                            <div id="slick-nav-1" class="products-slick-nav"></div>
                                        </div>
                                        <!-- /tab -->
                                    </div>
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
                </div>
            </div>
        </div>

        <!-- /container -->
    </div>
    <!-- /SECTION -->
    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="thumbnail">
                <div class="caption" style="padding: 2rem 2rem 3rem 2rem">
                    <div class="row">

                        <!-- section title -->
                        <div class="col-md-12">
                            <div class="section-title" style="text-align: center;">
                                <h3 class="title">Our Items</h3>
                            </div>
                        </div>
                        <!-- /section title -->

                        <!-- Products tab & slick -->
                        <div class="col-md-12">
                            @if ($our_items->count() > 0)
                                <div class="row">
                                    <div class="products-tabs">
                                        <!-- tab -->
                                        <div id="tab1" class="tab-pane active">
                                            <div class="products-slick" data-nav="#slick-nav-2">

                                                @foreach ($our_items as $our_item)
                                                    <!-- product -->
                                                    <div class="product">
                                                        <div class="product-img">
                                                            @if ($our_item->quantity <= 0)
                                                                <div style="" class="stock_out">
                                                                    <span class="stock_out_text text-center" style="">
                                                                        <h3>Stock out</h3>
                                                                    </span>
                                                                    <img class="stock_out_img"
                                                                        src="{{ url('uploads/item', $our_item->image) }}"
                                                                        style="height: 40vh; width: 100%;" alt="">
                                                                </div>
                                                            @else
                                                                <img src="{{ url('uploads/item', $our_item->image) }}"
                                                                    style="height: 40vh;" alt="">
                                                            @endif
                                                        </div>
                                                        <div class="product-body">
                                                            <p class="product-category">{{ $our_item->category->name }}
                                                            </p>
                                                            <h3 class="product-name">
                                                                @if ($our_item->quantity <= 0)
                                                                    <a href="">{{ $our_item->name }}</a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('items.show', $our_item->id) }}">{{ $our_item->name }}</a>
                                                                @endif
                                                            </h3>
                                                            <h4 class="product-price" style="color: black;">
                                                                {{ $our_item->price }} TK</h4>
                                                            <form action="{{ route('item.store.cart') }}" method="POST">
                                                                @csrf
                                                                @if (Auth::check())
                                                                    <input type="hidden" name="user_id" id="user_id"
                                                                        value="{{ Auth::user()->id }}">
                                                                @else
                                                                    <input type="hidden" name="user_id" value="">
                                                                @endif
                                                                <input type="hidden" name="item_id" id="item_id"
                                                                    value="{{ $our_item->id }}">
                                                                <input type="hidden" name="price" id="price"
                                                                    value="{{ $our_item->price }}">
                                                                <input type="hidden" name="quentity" id="quentity"
                                                                    value="1">
                                                                @if (!$our_item->quantity <= 0)
                                                                    <div class="add-to-cart">
                                                                        <button type="submit" class="add-to-cart-btn">
                                                                            {{-- <i class="fa fa-shopping-cart"></i>  --}}
                                                                            add to cart
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /product -->
                                                @endforeach

                                            </div>
                                            <div id="slick-nav-2" class="products-slick-nav"></div>
                                        </div>
                                        <!-- /tab -->
                                    </div>
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
                    @if (!$item->quantity <= 0)
                        @if ($items->count() > 0)
                            <div class="row item_see_more">
                                <div class="col-md-12">
                                    <a href="{{ route('all.item.show') }}" class="btn btn-primary">See More</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection</p>
                        <a class="primary-btn cta-btn" href="{{ route('all.item.show') }}">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="thumbnail">
                <div class="caption" style="padding: 2rem 2rem 3rem 2rem;">
                    <div class="row">

                        <!-- section title -->
                        <div class="col-md-12">
                            <div class="section-title" style="text-align: center;">
                                <h3 class="title">Top selling</h3>
                            </div>
                        </div>
                        <!-- /section title -->

                        <!-- Products tab & slick -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="products-tabs">
                                    <!-- tab -->
                                    <div id="tab2" class="tab-pane fade in active">
                                        <div class="products-slick" data-nav="#slick-nav-2">
                                            @if ($topItems->count() > 0)
                                                @foreach ($topItems as $topItem)
                                                    <!-- product -->
                                                    <div class="product">
                                                        <div class="product-img">
                                                            @if ($topItem->item->quantity <= 0)
                                                                <div style="" class="stock_out">
                                                                    <span class="stock_out_text text-center"
                                                                        style="">
                                                                        <h3>Stock out</h3>
                                                                    </span>
                                                                    <img class="stock_out_img"
                                                                        src="{{ url('uploads/item', $topItem->item->image) }}"
                                                                        style="height: 40vh; width: 100%;" alt="">
                                                                </div>
                                                            @else
                                                                <img src="{{ url('uploads/item', $topItem->item->image) }}"
                                                                    style="height: 40vh;" alt="">
                                                            @endif
                                                        </div>
                                                        <div class="product-body">
                                                            <p class="product-category">
                                                                {{ $topItem->item->category->name }}</p>
                                                            <h3 class="product-name">
                                                                @if ($topItem->item->quantity <= 0)
                                                                    <a href="">{{ $topItem->item->name }}</a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('items.show', $topItem->item->id) }}">{{ $topItem->item->name }}</a>
                                                                @endif
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
                                                                <input type="hidden" name="quentity" id="quentity"
                                                                    value="1">
                                                                @if (!$topItem->item->quantity <= 0)
                                                                    <div class="add-to-cart">
                                                                        <button type="submit" class="add-to-cart-btn">
                                                                            add to cart
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /product -->
                                                @endforeach
                                            @else
                                                <div class="product">
                                                    <div class="product-body">
                                                        <h4>Item Is Not Found</h4>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div id="slick-nav-2" class="products-slick-nav"></div>
                                    </div>
                                    <!-- /tab -->
                                </div>
                            </div>
                        </div>
                        <!-- /Products tab & slick -->
                    </div>
                    @if ($topItems->count() > 0)
                        <div class="row item_see_more">
                            <div class="col-md-12">
                                <a href="{{ route('top.selling.item') }}" class="btn btn-primary">See More</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

@endsection
