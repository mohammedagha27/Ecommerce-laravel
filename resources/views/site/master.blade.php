<?php
use App\Models\Category;
use App\Models\Product;
?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]-->
<!--[if IE 8]><html class="ie ie8"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="favicon.png" rel="icon">
    <meta name="author" content="Nghia Minh Luong">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    <title>@yield('title', env('APP_NAME'))</title>
    <!-- Fonts-->
    <link
        href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/ps-icon/style.css') }}">
    <!-- CSS Library-->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet"
        href="{{ asset('siteassets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet"
        href="{{ asset('siteassets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/Magnific-Popup/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/jquery-ui/jquery-ui.min.css') }}">
    <!-- Custom-->
    <link rel="stylesheet" href="{{ asset('siteassets/css/style.css') }}">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->

    @yield('styles')
</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->

<body class="ps-loading">
    <div class="header--sidebar"></div>
    <header class="header">
        <div class="header__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                        <p>460 West 34th Street, 15th floor, New York - Hotline: 804-377-3580 - 804-399-3580</p>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                        <div class="header__actions"><a href="{{ route('login') }}">Login & Regiser</a>
                            <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USD<i
                                        class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><img src="{{ asset('siteassets/images/flag/usa.svg') }}" alt="">
                                            USD</a></li>
                                    <li><a href="#"><img src="{{ asset('siteassets/images/flag/singapore.svg') }}"
                                                alt=""> SGD</a></li>
                                    <li><a href="#"><img src="{{ asset('siteassets/images/flag/japan.svg') }}"
                                                alt=""> JPN</a></li>
                                </ul>
                            </div>
                            <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language<i
                                        class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Japanese</a></li>
                                    <li><a href="#">Chinese</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navigation">
            <div class="container-fluid">
                <div class="navigation__column left">
                    <div class="header__logo"><a class="ps-logo" href="{{ route('site.index') }}"><img
                                src="{{ asset('siteassets/images/logo.png') }}" alt=""></a></div>
                </div>
                <div class="navigation__column center">
                    <ul class="main-menu menu">
                        <li class="menu-item menu-item-has-children dropdown"><a
                                href="{{ route('site.index') }}">Home</a>
                        </li>
                        @foreach (Category::whereNull('parent_id')->whereHas('children')->take(5)->get()
    as $item)
                            <li class="menu-item menu-item-has-children dropdown"><a
                                    href="{{ route('site.category', $item->slug) }}">{{ $item->trans_name }}</a>
                                <ul class="sub-menu">
                                    @foreach ($item->children as $item2)
                                        <li class="menu-item"><a
                                                href="{{ route('site.category', $item2->slug) }}">{{ $item2->trans_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="navigation__column right">
                    <form class="ps-search--header" action="{{ route('serch') }}" method="post">
                        @csrf
                        <input class="form-control" type="text" name="q" placeholder="Search Product…">
                        <button><i class="ps-icon-search"></i></button>
                    </form>
                    @if (!request()->routeIs('site.cart'))
                        @auth
                            <div class="ps-cart">
                                @include('site.cart-content')
                            </div>
                        @endauth
                    @endif

                    <div class="menu-toggle"><span></span></div>
                </div>
            </div>
        </nav>
    </header>


    @yield('content')
    <div class="ps-subscribe">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">
                    <h3><i class="fa fa-envelope"></i>Sign up to Newsletter</h3>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 ">
                    <form class="ps-subscribe__form" action="do_action" method="post">
                        <input class="form-control" type="text" placeholder="">
                        <button>Sign up now</button>
                    </form>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                    <p>...and receive <span>$20</span> coupon for first shopping.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-footer bg--cover" data-background="images/background/parallax.jpg">
        <div class="ps-footer__content">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--info">
                            <header><a class="ps-logo" href="index.html"><img
                                        src="{{ asset('siteassets/images/logo-white.png') }}" alt=""></a>
                                <h3 class="ps-widget__title">Address Office 1</h3>
                            </header>
                            <footer>
                                <p><strong>460 West 34th Street, 15th floor, New York</strong></p>
                                <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                <p>Phone: +323 32434 5334</p>
                                <p>Fax: ++323 32434 5333</p>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--info second">
                            <header>
                                <h3 class="ps-widget__title">Address Office 2</h3>
                            </header>
                            <footer>
                                <p><strong>PO Box 16122 Collins Victoria 3000 Australia</strong></p>
                                <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                <p>Phone: +323 32434 5334</p>
                                <p>Fax: ++323 32434 5333</p>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--link">
                            <header>
                                <h3 class="ps-widget__title">Find Our store</h3>
                            </header>
                            <footer>
                                <ul class="ps-list--link">
                                    <li><a href="#">Coupon Code</a></li>
                                    <li><a href="#">SignUp For Email</a></li>
                                    <li><a href="#">Site Feedback</a></li>
                                    <li><a href="#">Careers</a></li>
                                </ul>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--link">
                            <header>
                                <h3 class="ps-widget__title">Get Help</h3>
                            </header>
                            <footer>
                                <ul class="ps-list--line">
                                    <li><a href="#">Order Status</a></li>
                                    <li><a href="#">Shipping and Delivery</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Payment Options</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--link">
                            <header>
                                <h3 class="ps-widget__title">Products</h3>
                            </header>
                            <footer>
                                <ul class="ps-list--line">
                                    <li><a href="#">Shoes</a></li>
                                    <li><a href="#">Clothing</a></li>
                                    <li><a href="#">Accessries</a></li>
                                    <li><a href="#">Football Boots</a></li>
                                </ul>
                            </footer>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-footer__copyright">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <p>&copy; <a href="#">SKYTHEMES</a>, Inc. All rights Resevered. Design by <a href="#"> Alena
                                Studio</a></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <ul class="ps-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <!-- JS Library-->
    <script type="text/javascript" src="{{ asset('siteassets/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('siteassets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/gmap3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/imagesloaded.pkgd.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/isotope.pkgd.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('siteassets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/jquery.matchHeight-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/slick/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/elevatezoom/jquery.elevatezoom.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('siteassets/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('siteassets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>

    <!-- Custom scripts-->
    <script type="text/javascript" src="{{ asset('siteassets/js/main.js') }}"></script>
    <script>
        $('body').on('click', '.ps-cart-item__close', function(e) {
            e.preventDefault();
            var url = $(this).parents('form').attr('action');
            $.ajax({
                type: "get",
                url: url,
                success: function(response) {
                    $('.ps-cart').html(response);
                }
            });
        });
        // $('.ps-cart-item__close').click(function(e) {
        //     e.preventDefault();
        //     var url = $(this).parents('form').attr('action');
        //     var cart = $(this).parents('.ps-cart-item');
        //     var cartContainer = $(this).parents('.ps-cart__content');
        //     var emptyCart = `<p style="text-align: center">Ther Is No Products In The Cart Yet</p>`;
        //     var DeletedItemNumber = $(this).parents('.ps-cart-item').find('.cartQuantity').text();
        //     var DeletedItemTotal = $(this).parents('.ps-cart-item').find('.cartPrice').text();
        //     let cc = $('.cartCount').text()
        //     console.log(DeletedItemNumber, DeletedItemTotal);
        //     $.ajax({
        //         type: "get",
        //         url: url,
        //         success: function(response) {
        //             cc = cc - 1;
        //             $('.cartCount').text(cc);
        //             if (cc == 0) {
        //                 cartContainer.append(emptyCart);
        //             }
        //             cart.remove();
        //             var cuurentNum = $('.ItemNum span').text() - DeletedItemNumber;
        //             var cuurentTotal = $('.ItemTotal span').text() - (DeletedItemTotal *
        //                 DeletedItemNumber);
        //             $('.ItemNum span').text(cuurentNum);
        //             $('.ItemTotal span').text(cuurentTotal);
        //         }
        //     });

        // });

        function bannerSwitcher() {
            next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
            if (next.length) next.prop('checked', true);
            else $('.sec-1-input').first().prop('checked', true);
        }

        var bannerTimer = setInterval(bannerSwitcher, 5000);

        $('nav .controls label').click(function() {
            clearInterval(bannerTimer);
            bannerTimer = setInterval(bannerSwitcher, 5000)
        });
    </script>

    @yield('scripts')
</body>

</html>
