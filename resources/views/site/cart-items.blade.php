<div class="ps-cart-listing">
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <table class="table ps-cart__table">
        <thead>
            <tr>
                <th>All Products</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @forelse ($carts as $cart)
                @php
                    $total += $cart->product->final_price * $cart->quantity;
                @endphp
                <tr>
                    <td>
                        <a class="ps-product__preview" href="{{ route('site.product', $cart->product->slug) }}">
                            <img class="mr-15"
                                src="{{ asset('uploads/images/products/' . $cart->product->image) }}" alt=""
                                width="120">
                            {{ $cart->product->trans_name }}
                        </a>
                    </td>
                    <td>${{ $cart->product->final_price }}</td>
                    <td>
                        <div class="form-group--number">
                            <form action="{{ route('site.update_cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $cart->id }}">
                                <button class="minus"><span>-</span></button>
                                <input class="form-control" name="quantity" type="text"
                                    value="{{ $cart->quantity }}">
                                <button class="plus"><span>+</span></button>
                            </form>
                        </div>
                    </td>
                    <td>${{ $cart->quantity * $cart->product->final_price }}</td>
                    <td>
                        <a href="{{ route('site.delete_cart2', $cart->id) }}">
                            <div class="ps-remove"></div>
                        </a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center">There is no products in the cart yet</td>
                </tr>
            @endforelse


        </tbody>
    </table>
    <div class="ps-cart__actions">
        <div class="ps-cart__promotion">
            <div class="form-group">
                <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                    <input class="form-control" type="text" placeholder="Promo Code">
                </div>
            </div>
            <div class="form-group">
                <button class="ps-btn ps-btn--gray">Continue Shopping</button>
            </div>
        </div>
        <div class="ps-cart__total">
            <h3>Total Price: <span> {{ $total }} $</span></h3><a class="ps-btn"
                href="checkout.html">Process to
                checkout<i class="ps-icon-next"></i></a>
        </div>
    </div>
</div>
