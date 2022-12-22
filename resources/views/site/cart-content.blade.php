<a class="ps-cart__toggle" href="#"><span>
        <i class="cartCount">{{ Auth::user()->carts->count() }}</i></span><i class="ps-icon-shopping-cart"></i></a>
<div class="ps-cart__listing">
    @php
        $itemsNum = 0;
        $total = 0;
    @endphp
    <div class="div">
        <div class="ps-cart__content">
            @forelse (Auth::user()->carts as $cart)
                @php
                    $itemsNum += $cart->quantity;
                    $total += $cart->price * $cart->quantity;
                @endphp
                <div class="ps-cart-item">
                    <form action="{{ route('site.delete_cart', $cart->id) }}" method="get">
                        @csrf
                        <button class="ps-cart-item__close" href="#"></button>
                    </form>

                    <div class="ps-cart-item__thumbnail">
                        <a href="{{ route('site.product', $cart->product->slug) }}"></a>
                        <img src="{{ asset('uploads/images/products/' . $cart->product->image) }}" alt="">
                    </div>
                    <div class="ps-cart-item__content"><a class="ps-cart-item__title"
                            href="{{ route('site.product', $cart->product->slug) }}">{{ $cart->product->trans_name }}</a>
                        <p>
                            <span>Quantity:
                                <i class="cartQuantity">{{ $cart->quantity }}</i>
                            </span>
                            <span>Price:
                                <i class="cartPrice">{{ $cart->price }}</i>
                            </span>
                        </p>
                    </div>
                </div>
            @empty
                <p style="text-align: center">Ther Is No Products In The Cart Yet</p>
            @endforelse
        </div>
    </div>

    <div class="ps-cart__total">
        <p class="ItemNum">Number of items:<span>{{ $itemsNum }}</span></p>
        <p class="ItemTotal">Item Total:<span>{{ $total }}</span></p>
    </div>
    <div class="ps-cart__footer"><a class="ps-btn" href="{{ route('site.cart') }}">Check out<i
                class="ps-icon-arrow-left"></i></a>
    </div>


</div>
