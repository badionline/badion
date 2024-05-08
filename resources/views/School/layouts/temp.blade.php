<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="StudyHub.png">
    <title>Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/tooltip.js') }}"></script>
    <link rel="icon" href="{{ asset('img/badion.png') }}">
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
</head>
<body oncontextmenu="return false">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fa fa-eye-slash" id="all" ></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fa fa-user" href="#" role="button" data-bs-toggle="dropdown" id="profile"></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile">Profile</a></li>
                            <li><a class="dropdown-item" href="login">Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-home" href="home" id="home" ></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-users" href="students" id="students"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-chalkboard-teacher" href="teachers" id="teachers"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fa fa-book" href="#" role="button"
                            data-bs-toggle="dropdown" id="classroom"></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="manageclass">Manage Class</a></li>
                            <li><a class="dropdown-item" href="managesubjects">Manage Subjects</a></li>
                            <li><a class="dropdown-item" href="managesyllabus">Manage Syllabus</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-calendar-alt" href="timetable" id="timetable"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fa fa-newspaper" href="#" role="button"
                            data-bs-toggle="dropdown" id="exams"></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="manageexams">Manage Exams</a></li>
                            <li><a class="dropdown-item" href="managemarks">Entry Marks</a></li>
                            <li><a class="dropdown-item" href="marks">View Results</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fa fa-money-bill" href="#" role="button"
                            data-bs-toggle="dropdown tooltiop" id="fees"></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="managefees">Manage Fees</a></li>
                            <li><a class="dropdown-item" href="feepayments">Fee Payments</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-money-bill-wave-alt" href="salary" id="salary"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-paperclip" href="notice" id="notice"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-tv" href="support" id="support"></a>
                    </li>
                    <li class="nav-item nav-link">
                        <div class="form-switch">
                            <form>
                                <input class="form-check-input" type="checkbox" role="switch" id="mode"
                                    name="mode">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>