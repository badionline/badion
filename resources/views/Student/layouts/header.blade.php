<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css"
        integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadiOn | {{ Auth::user()->name }}</title>
    <link rel="icon" href="{{ asset('img/badion.png') }}">
    @if (session()->get('theme') == 'dark')
        @php $theme = 'dark' @endphp
    @else
        @php $theme = 'light' @endphp
    @endif
    <link rel="stylesheet" href="{{ asset('css/' . $theme . '.css') }}">
    <script src="{{ asset('js/tooltip.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.3"></script>
    {{-- <script src="
    https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js
    "></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.3.1/css/tom-select.bootstrap5.min.css" integrity="sha512-w7Qns0H5VYP5I+I0F7sZId5lsVxTH217LlLUPujdU+nLMWXtyzsRPOP3RCRWTC8HLi77L4rZpJ4agDW3QnF7cw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
</head>

<body oncontextmenu="return false">
    <nav class="navbar navbar-expand-lg dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="studymaterials">Study Materials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teachers">Teachers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="homework">HomeWork</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="timetable">Time-Table</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fees">Fees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="result">Result</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="noticeboard">Notice Board</a>
                    </li>
                    <li class="nav-item nav-link">
                        <a href="theme">
                            <label for="mode"
                                class="fa  @if (session()->get('theme') == 'dark') fa-toggle-off @else fa-toggle-on @endif;  "></label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout"><i class="fa fa-sign-out-alt"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><i class="fa fa-expand" id="toggleButton"></i></a>
                    </li>
                </ul>
            </div>
            <nav style="padding: 0px 50px;">
                <a class="nav-link fa fa-user" href="profile"></a>
            </nav>
        </div>
    </nav>


    <div class="loaderClass">
        <img src="{{ asset('img/loading.gif') }}">
    </div>
