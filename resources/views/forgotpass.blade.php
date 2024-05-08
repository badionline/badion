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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body oncontextmenu="return false">
    <div class="container">
        <div class="card text-light">
            <div class="form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="name" placeholder="Email">
                </div>
                <div class="form-group text-end">
                    <input type="submit" class="btn" value="Genrate OTP">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
