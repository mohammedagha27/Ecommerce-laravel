@extends('site.master')
@section('content')
    <main class="ps-main">
        <div class="ps-content pt-80 pb-80">
            <div class="ps-container" id="all-carts">
                @include('site.cart-items')
            </div>
        </div>
    @stop
    @section('scripts')
        <script>
            // $('button.plus').click(function(e) {
            $('body').on('click', '.ps-remove', function(e) {
                e.preventDefault();
                let url = $(this).parents('a').attr('href');
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(response) {
                        $('#all-carts').html(response);
                    }
                });

            });
            $('body').on('click', 'button.plus', function(e) {
                e.preventDefault();
                let text = $(this).prev().val();
                $(this).prev().val(parseInt(text) + 1);
                let url = $(this).parents('form').attr('action');
                let data = $(this).parents('form').serialize();
                $.ajax({
                    type: "post",
                    url: url,
                    data: data,
                    success: function(response) {
                        $('#all-carts').html(response);
                    }
                });

            });
            $('body').on('click', 'button.minus', function(e) {
                e.preventDefault();
                let text = $(this).next().val();
                let url = $(this).parents('form').attr('action');
                if (text > 0) {
                    $(this).next().val(parseInt(text) - 1);
                    let data = $(this).parents('form').serialize();
                    $.ajax({
                        type: "post",
                        url: url,
                        data: data,
                        success: function(response) {
                            $('#all-carts').html(response);
                        }
                    });
                }

            });
        </script>
    @stop
