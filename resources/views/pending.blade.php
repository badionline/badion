<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<link rel="icon" href="{{ asset('img/badion.png') }}">
<title>BadiOn | {{ Auth::user()->name }}</title>
<style>
    body {
        font-family: "Rubik", sans-serif;
    }

    a {
        text-decoration: none;
    }

    a,
    a:active,
    a:visited {
        color: black;
    }

    .pending {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    label {
        font-size: 50px;
    }
</style>
<a href="logout"><label class="fa fa-home"></label></a>
<div class="pending">
    <img src="{{ asset('img/progress.png') }}">
</div>
<div class="pending">
    <b><label class="pending">Registration in progress</label></b>
</div>
<div class="pending">
    <b><label class="pending">We will notify you</label></b>
</div>
