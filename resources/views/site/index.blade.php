@extends('site.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('siteassets/css/slider.css') }}">
    <style>
        .ps-shoe__thumbnail img {
            height: 220px;
            object-fit: cover;
        }

        .slider {
            padding-top: 0;
        }

        .banner {
            padding-top: 0;
            width: 100% !important;
        }

        .banner-inner-wrapper {
            height: 100%;
            padding-top: 0 !important;
            width: 100% !important;
        }

        .banner-inner-wrapper img {
            height: 100%;
            width: 100% !important;
            object-fit: cover !important;
        }
    </style>
@stop
@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="header-services">
        <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0"
            data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1"
            data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard
                delivery on every order with Sky Store</p>
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard
                delivery on every order with Sky Store</p>
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free
                standard delivery on every order with Sky Store</p>
        </div>
    </div>
    <main class="ps-main">
        <div class="ps-banner">
            <section id="section-1">
                <div class="content-slider">
                    <input type="radio" id="banner1" class="sec-1-input" name="banner" checked>
                    <input type="radio" id="banner2" class="sec-1-input" name="banner">
                    <input type="radio" id="banner3" class="sec-1-input" name="banner">
                    <input type="radio" id="banner4" class="sec-1-input" name="banner">
                    <div class="slider">
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($products as $item)
                            @php
                                $count += 1;
                            @endphp
                            <div id="top-banner-{{ $count }}" class="banner">
                                <div class="banner-inner-wrapper">
                                    {{-- <h2>Creative Template</h2>
                                <h1>Welcome<br>to MoGo</h1>
                                <div class="line"></div>
                                <div class="learn-more-button"><a href="#section-2">Learn More</a></div> --}}
                                    <img src="{{ asset('uploads/images/products/' . $item->image) }}" alt="">
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <nav>
                        @php
                            $count2 = 0;
                        @endphp
                        <div class="controls">

                            @foreach ($products as $item2)
                                @php
                                    $count2 += 1;
                                    if ($count2 > 4) {
                                        break;
                                    }
                                @endphp
                                <label for="banner{{ $count2 }}"><span class="progressbar"><span
                                            class="progressbar-fill"></span></span><span>{{ $count2 }} </span>
                                    {{ $item2->trans_name }}</label>
                            @endforeach


                        </div>
                    </nav>
                </div>
            </section>
        </div>

        <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
            <div class="ps-container">
                <div class="ps-section__header mb-50">
                    <h3 class="ps-section__title" data-mask="features">- Features Products</h3>
                    <ul class="ps-masonry__filter">
                        <li class="current"><a href="#" data-filter="*">All <sup>8</sup></a></li>
                        <li><a href="#" data-filter=".nike">Nike <sup>1</sup></a></li>
                        <li><a href="#" data-filter=".adidas">Adidas <sup>1</sup></a></li>
                        <li><a href="#" data-filter=".men">Men <sup>1</sup></a></li>
                        <li><a href="#" data-filter=".women">Women <sup>1</sup></a></li>
                        <li><a href="#" data-filter=".kids">Kids <sup>4</sup></a></li>
                    </ul>
                </div>
                <div class="ps-section__content pb-50">
                    <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30"
                        data-radio="100%">
                        <div class="ps-masonry">
                            <div class="grid-sizer"></div>
                            @foreach ($products as $product)
                                <div class="grid-item kids">
                                    <div class="grid-item__content-wrapper">
                                        <div class="ps-shoe mb-30">
                                            <div class="ps-shoe__thumbnail">
                                                <div class="ps-badge"><span>New</span></div>
                                                <div class="ps-badge ps-badge--sale ps-badge--2nd">
                                                    <span>-{{ round((($product->price - $product->sale_price) / $product->price) * 100, 2) }}%</span>
                                                </div>
                                                <a class="ps-shoe__favorite"
                                                    href="{{ route('site.product', $product->slug) }}"><i
                                                        class="ps-icon-heart"></i></a><img
                                                    src="{{ asset('uploads/images/products/' . $product->image) }}"
                                                    alt=""><a class="ps-shoe__overlay"
                                                    href="{{ route('site.product', $product->slug) }}"></a>
                                            </div>
                                            <div class="ps-shoe__content">
                                                <div class="ps-shoe__detail"><a class="ps-shoe__name"
                                                        href="#">{{ $product->trans_name }}</a>
                                                    <p class="ps-shoe__categories"><a
                                                            href="#">{{ $product->category->trans_name }}</a></p>
                                                    <span class="ps-shoe__price">
                                                        {!! $product->sale_price ? '<del>' . $product->price . '$</del> ' : '' !!}{{ $product->final_price }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="grid-item nike">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                                    class="ps-icon-heart"></i></a><img
                                                src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><a
                                                class="ps-shoe__overlay" href="product-detail.html"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img
                                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt="">
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">Air Jordan
                                                    7 Retro</a>
                                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                        Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                                    120</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-item adidas">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                                    class="ps-icon-heart"></i></a><img
                                                src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><a
                                                class="ps-shoe__overlay" href="product-detail.html"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img
                                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt="">
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">Air Jordan
                                                    7 Retro</a>
                                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                        Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                                    120</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-item kids">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail">
                                            <div class="ps-badge ps-badge--sale"><span>-35%</span></div><a
                                                class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img
                                                src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><a
                                                class="ps-shoe__overlay" href="product-detail.html"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img
                                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt="">
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">Air Jordan
                                                    7 Retro</a>
                                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                        Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price">
                                                    <del>£220</del> £ 120</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-item men">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                                    class="ps-icon-heart"></i></a><img
                                                src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""><a
                                                class="ps-shoe__overlay" href="product-detail.html"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img
                                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt="">
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">Air Jordan
                                                    7 Retro</a>
                                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                        Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                                    120</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-item women">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                                    class="ps-icon-heart"></i></a><img
                                                src="{{ asset('siteassets/images/shoe/6.jpg') }}" alt=""><a
                                                class="ps-shoe__overlay" href="product-detail.html"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img
                                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt="">
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">Air Jordan
                                                    7 Retro</a>
                                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                        Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                                    120</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-item kids">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                                    class="ps-icon-heart"></i></a><img
                                                src="{{ asset('siteassets/images/shoe/7.jpg') }}" alt=""><a
                                                class="ps-shoe__overlay" href="product-detail.html"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img
                                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt="">
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">Air Jordan
                                                    7 Retro</a>
                                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                        Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                                    120</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-item kids">
                                <div class="grid-item__content-wrapper">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                                    class="ps-icon-heart"></i></a><img
                                                src="{{ asset('siteassets/images/shoe/8.jpg') }}" alt=""><a
                                                class="ps-shoe__overlay" href="product-detail.html"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                <div class="ps-shoe__variant normal"><img
                                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt="">
                                                </div>
                                                <select class="ps-rating ps-shoe__rating">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">Air Jordan
                                                    7 Retro</a>
                                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                        Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                                    120</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-section--offer">
            <div class="ps-column"><a class="ps-offer" href="product-listing.html"><img
                        src="{{ asset('siteassets/images/banner/home-banner-1.png') }}" alt=""></a></div>
            <div class="ps-column"><a class="ps-offer" href="product-listing.html"><img
                        src="{{ asset('siteassets/images/banner/home-banner-2.png') }}" alt=""></a></div>
        </div>

        <div class="ps-section ps-section--top-sales ps-owl-root pt-80 pb-80">
            <div class="ps-container">
                <div class="ps-section__header mb-50">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                            <h3 class="ps-section__title" data-mask="BEST SALE">- Top Sales</h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <div class="ps-owl-actions"><a class="ps-prev" href="#"><i
                                        class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i
                                        class="ps-icon-arrow-left"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="ps-section__content">
                    <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true"
                        data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false"
                        data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3"
                        data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite"
                                        href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('siteassets/images/shoe/1.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air
                                            Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div>
                                    <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-35%</span></div><a
                                        class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air
                                            Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price">
                                            <del>£220</del> £ 120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite"
                                        href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air
                                            Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                            class="ps-icon-heart"></i></a><img
                                        src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air
                                            Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail">
                                    <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite"
                                        href="#"><i class="ps-icon-heart"></i></a><img
                                        src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air
                                            Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-shoes--carousel">
                            <div class="ps-shoe">
                                <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="#"><i
                                            class="ps-icon-heart"></i></a><img
                                        src="{{ asset('siteassets/images/shoe/6.jpg') }}" alt=""><a
                                        class="ps-shoe__overlay" href="product-detail.html"></a>
                                </div>
                                <div class="ps-shoe__content">
                                    <div class="ps-shoe__variants">
                                        <div class="ps-shoe__variant normal"><img
                                                src="{{ asset('siteassets/images/shoe/2.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/3.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/4.jpg') }}" alt=""><img
                                                src="{{ asset('siteassets/images/shoe/5.jpg') }}" alt=""></div>
                                        <select class="ps-rating ps-shoe__rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select>
                                    </div>
                                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air
                                            Jordan 7 Retro</a>
                                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#">
                                                Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                            120</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-home-testimonial bg--parallax pb-80" data-background="images/background/parallax.jpg">
            <div class="container">
                <div class="owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000"
                    data-owl-gap="0" data-owl-nav="false" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1"
                    data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000"
                    data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
                    <div class="ps-testimonial">
                        <div class="ps-testimonial__thumbnail"><img
                                src="{{ asset('siteassets/images/testimonial/1.jpg') }}" alt=""><i
                                class="fa fa-quote-left"></i></div>
                        <header>
                            <select class="ps-rating">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="5">5</option>
                            </select>
                            <p>Logan May - CEO & Founder Invision</p>
                        </header>
                        <footer>
                            <p>“Dessert pudding dessert jelly beans cupcake sweet caramels gingerbread. Fruitcake
                                biscuit cheesecake. Cookie topping sweet muffin pudding tart bear claw sugar plum
                                croissant. “</p>
                        </footer>
                    </div>
                    <div class="ps-testimonial">
                        <div class="ps-testimonial__thumbnail"><img
                                src="{{ asset('siteassets/images/testimonial/2.jpg') }}" alt=""><i
                                class="fa fa-quote-left"></i></div>
                        <header>
                            <select class="ps-rating">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="5">5</option>
                            </select>
                            <p>Logan May - CEO & Founder Invision</p>
                        </header>
                        <footer>
                            <p>“Dessert pudding dessert jelly beans cupcake sweet caramels gingerbread. Fruitcake
                                biscuit cheesecake. Cookie topping sweet muffin pudding tart bear claw sugar plum
                                croissant. “</p>
                        </footer>
                    </div>
                    <div class="ps-testimonial">
                        <div class="ps-testimonial__thumbnail"><img
                                src="{{ asset('siteassets/images/testimonial/3.jpg') }}" alt=""><i
                                class="fa fa-quote-left"></i></div>
                        <header>
                            <select class="ps-rating">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="5">5</option>
                            </select>
                            <p>Logan May - CEO & Founder Invision</p>
                        </header>
                        <footer>
                            <p>“Dessert pudding dessert jelly beans cupcake sweet caramels gingerbread. Fruitcake
                                biscuit cheesecake. Cookie topping sweet muffin pudding tart bear claw sugar plum
                                croissant. “</p>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-section ps-home-blog pt-80 pb-80">
            <div class="ps-container">
                <div class="ps-section__header mb-50">
                    <h2 class="ps-section__title" data-mask="News">- Our Story</h2>
                    <div class="ps-section__action"><a class="ps-morelink text-uppercase" href="#">View all post<i
                                class="fa fa-long-arrow-right"></i></a></div>
                </div>
                <div class="ps-section__content">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <div class="ps-post">
                                <div class="ps-post__thumbnail"><a class="ps-post__overlay"
                                        href="blog-detail.html"></a><img
                                        src="{{ asset('siteassets/images/blog/1.jpg') }}" alt=""></div>
                                <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">An
                                        Inside Look at the Breaking2 Kit</a>
                                    <p class="ps-post__meta"><span>By:<a class="mr-5" href="blog.html">Alena
                                                Studio</a></span> -<span class="ml-5">Jun 10, 2017</span></p>
                                    <p>Leverage agile frameworks to provide a robust synopsis for high level overviews.
                                        Iterative approaches to corporate strategy foster collaborative thinking to
                                        further…</p><a class="ps-morelink" href="blog-detail.html">Read more<i
                                            class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <div class="ps-post">
                                <div class="ps-post__thumbnail"><a class="ps-post__overlay"
                                        href="blog-detail.html"></a><img
                                        src="{{ asset('siteassets/images/blog/2.jpg') }}" alt=""></div>
                                <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">Unpacking
                                        the Breaking2 Race Strategy</a>
                                    <p class="ps-post__meta"><span>By:<a class="mr-5" href="blog.html">Alena
                                                Studio</a></span> -<span class="ml-5">Jun 10, 2017</span></p>
                                    <p>Leverage agile frameworks to provide a robust synopsis for high level overviews.
                                        Iterative approaches to corporate strategy foster collaborative thinking to
                                        further…</p><a class="ps-morelink" href="blog-detail.html">Read more<i
                                            class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <div class="ps-post">
                                <div class="ps-post__thumbnail"><a class="ps-post__overlay"
                                        href="blog-detail.html"></a><img
                                        src="{{ asset('siteassets/images/blog/3.jpg') }}" alt=""></div>
                                <div class="ps-post__content"><a class="ps-post__title" href="blog-detail.html">Nike’s
                                        Latest Football Cleat Breaks the Mold</a>
                                    <p class="ps-post__meta"><span>By:<a class="mr-5" href="blog.html">Alena
                                                Studio</a></span> -<span class="ml-5">Jun 10, 2017</span></p>
                                    <p>Leverage agile frameworks to provide a robust synopsis for high level overviews.
                                        Iterative approaches to corporate strategy foster collaborative thinking to
                                        further…</p><a class="ps-morelink" href="blog-detail.html">Read more<i
                                            class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-home-contact">
            <div id="contact-map" data-address="New York, NY" data-title="BAKERY LOCATION!" data-zoom="17"></div>
            <div class="ps-home-contact__form">
                <header>
                    <h3>Contact Us</h3>
                    <p>Learn about our company profile, communityimpact, sustainable motivation, and more.</p>
                </header>
                <footer>
                    <form action="product-listing.html" method="post">
                        <div class="form-group">
                            <label>Name<span>*</span></label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label>Email<span>*</span></label>
                            <input class="form-control" type="email">
                        </div>
                        <div class="form-group">
                            <label>Your message<span>*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class="ps-btn">Send Message<i class="fa fa-angle-right"></i></button>
                        </div>
                    </form>
                </footer>
            </div>
        </div>

    @stop
