<header>
    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{ route('welcome') }}" class="logo">
                            <h3 style="font-size: 25px; font-weight: italic; line-height: 65px; color: white;">Gadget Hub
                            </h3>
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form action="{{ route('item.search') }}" method="POST">
                            @csrf
                            <input class="input" name="search" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                @if ($cart_items->count() > 0)
                                    <div class="qty">{{ $cart_items->count() }}</div>
                                @else
                                    <div class="qty">0</div>
                                @endif
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    @php
                                        $total_price = 0;
                                    @endphp
                                    @if ($cart_items->count() > 0)
                                        @foreach ($cart_items as $cart_item)
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="{{ url('uploads/item', $cart_item->item->image) }}"
                                                        alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a
                                                            href="{{ route('items.show', $cart_item->item->id) }}">{{ $cart_item->item->name }}</a>
                                                    </h3>
                                                    <h4 class="product-price">
                                                        @php
                                                            $price = $cart_item->price * $cart_item->quentity;
                                                        @endphp
                                                        <span class="qty">{{ $cart_item->quentity }}x</span>
                                                        {{ $price }} TK
                                                    </h4>
                                                </div>
                                                <a href="{{ route('cart.item.destroy', $cart_item->id) }}"
                                                    class="delete delete_item"><i class="fa fa-close"></i></a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="product-widget">
                                            <h4>Item Is Not Found</h4>
                                        </div>
                                    @endif
                                </div>
                                <div class="cart-summary">
                                    <small>{{ $cart_items->count() }} Item(s) selected</small>
                                    @php
                                        $user_id = Auth::check() ? Auth::user()->id : '';
                                        $data = App\Models\Cart::where('user_id', $user_id)->get();
                                        $total_price = 0;
                                        foreach ($data as $value) {
                                            $total_price += $value->price * $value->quentity;
                                        }
                                    @endphp
                                    <h5>SUBTOTAL:
                                        @if ($total_price > 0)
                                            {{ $total_price }}
                                        @else
                                            0
                                        @endif
                                        TK
                                    </h5>
                                </div>
                                <div class="cart-btns">
									@if(Auth::user())
                                    <a href="{{ route('checkout.index') }}" style="width: 100%;">Checkout <i
                                            class="fa fa-arrow-circle-right"></i></a>
											@else

                                    <a href="/" style="width: 100%;">Checkout <i
                                            class="fa fa-arrow-circle-right"></i></a>
											@endif
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->


                        <!-- Login -->
                        @guest
                            <div>
                                <a href="{{ route('login') }}">
                                    <span class="login">Login</span>
                                </a>
                            </div>
                        @else
                            <div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <span class="login">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                        <!-- /Login -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>


<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            @if (Route::is('all.item.show'))
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="margin: 1.5rem 0 0 0;">
                        All Categories
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        @if ($categories->count() > 0)
                            @foreach ($categories as $category)
                                <li><a href="{{ route('category.item', $category->id) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="#">It's Not Found</a></li>
                        @endif
                    </ul>
                </div>
            @endif
            @if(Route::is('category.item'))
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" style="margin: 1.5rem 0 0 0;">
                    All Categories
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            <li><a href="{{ route('category.item', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="#">It's Not Found</a></li>
                    @endif
                </ul>
            </div>
            @endif
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="{{ Route::is('welcome') ? 'active' : '' }}"><a href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="{{ Route::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About</a></li>
                <li class="{{ Route::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

@section('script')
    <script>
        // function categoryWithItem(id) {
        //     if (id) {
        //         alert(id);
        //         $.ajax({
        //             type: "POST",
        //             url: "/category-item/show/"+id,
        //             success: function(data) {
        //                 console.log(data);
        //                 $('item_row').html(data);
        //                 $('.item-load').load(location.href+' .item-load');
        //                 $('.item-load').text('dfgdfgfd');
        //             }
        //         });
        //     } else {
        //         alert('All Category Waise Items');
        //     }
        // }

        //     var value = document.getElementById('option').value;
        // alert(value);
        // function categoryWithItemsubmit() {
        //     alert('sdfsdf');
        // }
    </script>
@endsection
