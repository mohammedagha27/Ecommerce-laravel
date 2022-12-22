{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            font-family: 'Roboto', sans-serif;
            height: 100%;
        }

        body {
            background: linear-gradient(rgba(26, 26, 26, 0.2), rgba(26, 26, 26, 0.4)), url('https://images.unsplash.com/photo-1481437156560-3205f6a55735?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1195&q=80') no-repeat;
            background-position: center center;
            background-size: cover;
            font-size: 16px;
            margin: 0;
        }

        a {
            color: #939398;
        }

        p {
            margin: 0;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 2rem !important;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .w-100 {
            width: 100%;
        }

        /* Check Icon */
        span.check-icon {
            border: solid #48a64c;
            border-top: 0;
            border-left: 0;
            display: none;
            height: 15px;
            width: 7.5px;
            transform: rotate(45deg);
        }


        span.check-icon {
            position: absolute;
            bottom: 11px;
            right: 17px;
        }

        input.valid~span.check-icon {
            display: inline-block;
        }

        /* Menu */
        a.menu-toggle {
            cursor: pointer;
            position: absolute;
            top: 66px;
            right: 45px;
        }

        span.bar {
            background-color: #767676;
            display: block;
            height: 2px;
            margin-bottom: 2px;
            width: 15px;
        }

        span.bar:last-child {
            margin-bottom: 0;
        }


        .wrapper {
            display: flex;
            height: 100%;
            padding: 45px 25px;
            position: relative;
            margin: 0 auto;
            max-width: 1200px;

        }

        /* Quote Wrapper */
        .quote-wrapper {
            background: linear-gradient(rgba(26, 26, 26, 0.2), rgba(26, 26, 26, 0.2)), url('https://images.unsplash.com/photo-1472851294608-062f824d29cc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80') no-repeat center center;
            background-size: cover;
            border-radius: 10px 0 0 10px;
            /* background-position: top;    */
            flex-basis: 80%;
            height: 100%;
        }

        .quote-wrapper blockquote {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5)
        }

        .quote-wrapper blockquote p {
            color: #fff;
            font-size: 1.9rem;
            font-weight: 400;
            text-align: center;
        }

        .quote-wrapper blockquote p.author {
            font-size: 1rem;
            font-weight: 100;
            margin-top: 7px;
            text-align: right;
            width: 90%;
        }

        h1.form-title {
            color: #222;
            font-size: 1.9rem;
            margin-bottom: 50px;
        }

        /* Form */

        .form-wrapper {
            background: #fff;
            border-radius: 0 10px 10px 0;
            display: flex;
            flex-direction: column;
            flex-basis: 50%;
            height: 100%;
            justify-content: center;
            text-align: center;

        }

        .form-wrapper form .form-group {
            margin: 0 auto;
            margin-bottom: 45px;
            position: relative;
            width: 300px;

        }

        .form-group input {
            background-color: #efeff4;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            padding: 7px 0 5px 7px;
        }

        .form-group input:focus,
        .form-group input:active {
            outline: none;
        }

        .form-group label.terms {
            color: #939398;
            font-size: 0.8rem;
        }

        .form-group input[type="submit"] {
            background-color: #007AFF;
            border: none;
            color: #fff;
            transition: all 0.2s;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0047ab;
            cursor: pointer;
        }

        .form-group label:not(.terms) {
            color: #939398;
            font-size: 0.8rem;
            position: absolute;
            top: -25px;
        }

        .form-wrapper small {
            color: #939398;
            margin-top: 4px;
        }

        @media screen and (max-width: 687px) {
            .wrapper {
                max-width: 500px;
            }

            /* hide quote-wrapper */
            .quote-wrapper {
                display: none;
            }

            /* Form Wrapper */
            .form-wrapper {
                background: rgba(255, 255, 255, 0.7);
                border-radius: 10px;
                flex-basis: 500px;
                margin: 0 auto;
            }

            .form-wrapper h1.form-title {
                margin-top: 0;
            }

            .form-group input {
                background-color: #fff;
            }
        }


        @media screen and (max-width: 372px) {
            a.menu-toggle {
                right: 25px;
            }

            .wrapper {
                padding-left: 0;
                padding-right: 0;
            }

            .form-wrapper {
                border-radius: 0;
                flex-basis: 1;
            }
        }


        @media screen and (max-height: 500px) {
            a.menu-toggle {
                top: 15px;
            }

            .wrapper {
                padding-bottom: 0;
                padding-top: 0;
            }

            h1.form-title {
                margin-bottom: 30px;
                margin-top: 7px;
            }
        }

    </style>
</head>

<body>

    <div class="wrapper">

        <div class="quote-wrapper">
            <blockquote>
                <p>
                    "Paradise isn't a place. <br>
                    It's a feeling"
                </p>
                <p class="author">- L. Boyer</p>
            </blockquote>
        </div> <!-- end quote-wrapper -->

        <div class="form-wrapper">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="form-title">Reset Your Password</h1>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <div class="mt-3 text-start">
                        <label for="username">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-100 form-control @error('email') is-invalid @enderror" autofocus
                            value="{{ old('name') }}" autocomplete="email">
                        <span class="check-icon"></span>
                        @error('email')
                            <span class="invalid-feedback text-start" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group mb-1">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div> <!-- end form-wrapper -->
    </div> <!-- end wrapper -->
</body>

</html>
