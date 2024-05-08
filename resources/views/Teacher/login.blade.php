<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="StudyHub.png">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="icon" href="{{ asset('img/badion.png') }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body oncontextmenu="return false">
    <div class="container">
        <div class="card text-light">
            <div class="form">
                <div class="form-group">
                    <label for="name">User Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="User Name">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group flex justify-content-between">
                    <a href="{{URL::to('googleLogin')}}">
                        <img src="{{asset('img/google.svg')}}" alt="">
                    </a>
                    <button onclick="valid()" class="btn">Login</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function valid() {
        var name = document.getElementById("name").value;
        var password = document.getElementById("password").value;
        if (name == "Admin" && password == "admin") {
            window.location = "Admin/home";
        } else if (name == "School" && password == "school") {
            window.location = "School/home";
        } else if (name == "Teacher" && password == "teacher") {
            window.location = "Teacher/home";
        } else if (name == "Student" && password == "student") {
            window.location = "Student/home";
        } else {
            alert("Invalid User");
        }
    }
</script>