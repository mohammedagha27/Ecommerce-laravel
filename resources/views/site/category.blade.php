@extends('site.master')

@section('content')
    <main class="ps-main">
        <div class="ps-products-wrap pt-80 pb-80">
            <div class="ps-products" style="width: 100%; left: 0" data-mh="product-listing">
                <div class="ps-product__columns">
                    @foreach ($products as $item)
                        <div class="ps-product__column">
                            <div class="ps-shoe mb-30">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div>
                                    <div class="ps-badge ps-badge--sale ps-badge--2nd">
                                        <span>-{{ round((($item->price - $item->sale_price) / $item->price) * 100, 2) }}%</span>
                                    </div><a class="ps-shoe__favorite" href=""><i class="ps-icon-heart"></i>
                                    </a>
                                    <img src="{{ asset('uploads/images/products/' . $item->image) }}" alt=""><a
                                        class="ps-shoe__overlay" href="{{ route('site.product', $item->slug) }}"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__detail">
                                        <a class="ps-shoe__name"
                                            href="{{ route('site.product', $item->slug) }}">{{ $item->trans_name }}</a>
                                        <span class="ps-shoe__price">
                                            {{-- {!! $item->sale_price ? '<del>$' . $item->price . '</del>' : '' !!}
                                            ${{ $item->sale_price }} --}}
                                            {!! $item->sale_price ? '<del>$' . $item->price . '</del>' :'' !!}
                                            ${{ $item->final_price }}

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="ps-product-action">
                    <div class="ps-product__filter">
                        <select class="ps-select selectpicker">
                            <option value="1">Shortby</option>
                            <option value="2">Name</option>
                            <option value="3">Price (Low to High)</option>
                            <option value="3">Price (High to Low)</option>
                        </select>
                    </div>
                    <div class="ps-pagination">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>

        </div>
@stop
