<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> --}}
    <title>Something Unhappy</title>
</head>
<style>
    body {
        background-color: #4d4d4c;
        color: white;
    }

    .container {
        line-height: 600px;
        height: 600px;
        text-align: center;
    }

    a {
        text-decoration: none;
        color: white;
    }

    .card {
        line-height: 1.5;
        display: inline-block;
        vertical-align: middle;
        border: none;
        padding: 20px;
        border-radius: 25px;
        background: #4d4d4c;
        box-shadow: -7px -7px 14px #363635,
            7px 7px 14px #646463;
    }

    .btn,
    .btn:hover,
    .btn:focus {
        border-width: 2px;
        border-color: white;
        background-color: transparent;
        color: white;
        border-color: gray;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <img src="{{ asset('img/404.gif') }}" alt="Logo" height="100%" width="100%">
                    {{-- <label for="error">Something went wrong</label> --}}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
