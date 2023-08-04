@foreach ($searchItems as $searchItem)
    <!-- product -->
    <div class="col-md-3 col-md-4">
        <div class="product">
            <div class="product-img">
                <img src="{{ url('uploads/item', $searchItem->image) }}" style="height: 40vh;" alt="">
            </div>
            <div class="product-body">
                <p class="product-category">{{ $searchItem->category->name }}</p>
                <h3 class="product-name"><a href="{{ route('items.show', $searchItem->id) }}">{{ $searchItem->name }}</a>
                </h3>
                <h4 class="product-price">{{ $searchItem->price }} TK</h4>
                <form action="{{ route('item.store.cart') }}" method="POST">
                    @csrf
                    @if (Auth::check())
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    @else
                        <input type="hidden" name="user_id" value="">
                    @endif
                    <input type="hidden" name="item_id" id="item_id" value="{{ $searchItem->id }}">
                    <input type="hidden" name="price" id="price" value="{{ $searchItem->price }}">
                    <input type="hidden" name="quentity" id="quentity" value="1">
                    <div class="add-to-cart">
                        <button type="submit" class="add-to-cart-btn">add to cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /product -->
@endforeach
