<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadiOn</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css"
        integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css"
        integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ asset('img/badion.png') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/homestyle.css') }}"> --}}
</head>

<style>
    body {
        background-image: url(images/icons/banner-bg-3.png);
        font-family: "Rubik", sans-serif;
        padding-bottom: 50px;
        user-select: none;
    }

    .container {
        text-align: center;
        margin-top: 50px;
    }

    a {
        text-decoration: none;
        color: #F9ECE0;
    }

    .card {
        line-height: 1.5;
        display: inline-block;
        vertical-align: middle;
        background: #0781E2;
        padding: 20px;
        color: #FFFFFF;
        border: none;
        box-shadow: 6px 6px 12px #066ec0,
            -6px -6px 12px #0894ff;
    }

    .btn,
    .btn:hover,
    .btn:focus {
        border-width: 2px;
        background-color: transparent;
        color: #FFFFFF;
        border-color: #DA8228;
    }

    .form {
        text-align: start;
        padding: 20px;
        background: #0781E2;
        color: #FFFFFF;
        border: none;
    }

    input,
    label {
        margin: 10px;
        color: #FFFFFF;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        display: none;
    }
</style>

<body oncontextmenu="return false">
    {{-- <nav class="navbar d-flex justify-content-end">
        <a class="nav-link fa fa-home" href="home"></a>
        <a class="nav-link fa fa-sign-in-alt" href="register"></a>
        <a class="nav-link fa fa-user" href="login"></a>
    </nav> --}}

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('img/login.gif') }}" alt="login">
            </div>
            <div class="col-md-6">
                <div class="card text-light">
                    <form id="login" class="form" action="logincheck" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm text-end">
                                <a href="home"><span class="fa fa-home"></span></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">User id/Email:</label>
                            <input type="text" class="form-control" autocomplete="id" name="id" id="id"
                                placeholder="Enter Your Id" value="{{ old('id') }}">
                        </div>
                        <span class="text-dark">
                            @error('id')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password"
                                autocomplete="new-password" placeholder="Password">
                        </div>
                        <span class="text-dark">
                            @error('invalid')
                                {{ $message }}
                            @enderror
                        </span>
                        <span class="text-dark">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                        <span class="text-dark">

                            @if (session()->has('googleError'))
                                {{ session('googleError') }}
                            @endif
                        </span>
                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('googleLogin') }}">
                                <img src="{{ asset('img/google.svg') }}" alt="">
                            </a>
                            <input type="submit" class="btn" value="Login">
                        </div>
                        <div class="links">
                            <div class="row text-center">
                                <a href="{{ url('register') }}">Register School</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
