{{-- <!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="StudyHub.png">
    <title>BadiOn</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css"
        integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ asset('img/badion.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body oncontextmenu="return false">
    <nav class="navbar d-flex justify-content-end">
        <a class="nav-link fa fa-home" href="home"></a>
        <a class="nav-link fa fa-sign-in-alt" href="register"></a>
        <a class="nav-link fa fa-user" href="login"></a>
    </nav>
    <div class="container">
        <div class="card text-light">
            <label for="signin">Sign In</label>
            <form action="registration" method="post">
                <input class="form-control" type="email" placeholder="Email Name">
                <input class="form-control" type="password" placeholder="Password">
                <input class="form-control" type="password" placeholder="Confirm Password">
                <input class="form-control" type="submit" class="btn" value="Sign-in"><br>
                <a href="login">Already have an account Login</a>
            </form>
        </div>
    </div> --}}
{{-- <!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadiOn</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css"
        integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ asset('img/badion.png') }}">
    <link rel="stylesheet" href="{{ asset('css/homestyle.css') }}">
</head>

<style>
    input.invalid {
        background-color: lightcoral;
        /* #ffdddd */
    }

    body {
        background-image: url(images/icons/banner-bg-3.png);
    }

    .tab {
        display: none;
    }

    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    .card{
        display: block !important;
    }
</style>

<body oncontextmenu="return false">
    <nav class="navbar d-flex justify-content-end">
        <a class="nav-link fa fa-home" href="home"></a>
        <a class="nav-link fa fa-sign-in-alt" href="register"></a>
        <a class="nav-link fa fa-user" href="login"></a>
    </nav>

        <div class="container">
            <div class="card text-light">
                <form id="regForm">
                    <h1>Register</h1>
                    <!-- One "tab" for each step in the form: -->
                    <label for="prosonal">Personal Details</label>
                    <div class="tab">
                        <div class="form-group">
                            <input type="text" class="form-control" name="schoolname" id="schoolname"
                                placeholder="School Name" oninput="this.className = 'form-control'">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone"
                                oninput="this.className = 'form-control'">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email"
                                placeholder="E-mail" oninput="this.className = 'form-control'">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="Address" oninput="this.className = 'form-control'">
                        </div>

                        <div class="tab"><label>Personal:</label>
                            <p><input class="form-control" placeholder="School name..." oninput="this.className = 'form-control'"
                                    name="Sname"></p>
                            <p><input class="form-control" placeholder="Phone..." oninput="this.className = 'form-control'"
                                    name="phone"></p>
                            <p><input class="form-control" placeholder="E-mail..." oninput="this.className = 'form-control'"
                                    name="email"></p>
                            <p><input class="form-control" placeholder="Address..." oninput="this.className = 'form-control'"
                                    name="Address"></p>
                        </div>
                    </div>
                    <div class="tab">
                        <label for="">Id Proofs:</label>
                        <div class="row">
                            <div class="col-sm">
                                <input class="form-control" type="number" oninput="this.className = 'form-control'"
                                    placeholder="Pan">
                            </div>
                            <div class="col-sm">
                                <input class="form-control" type="file" oninput="this.className = 'form-control'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <input class="form-control" type="number" oninput="this.className = 'form-control'"
                                    placeholder="Adhaar">
                            </div>
                            <div class="col-sm">
                                <input class="form-control" type="file" oninput="this.className = 'form-control'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <input class="form-control" type="number" placeholder="gst"
                                    oninput="this.className = 'form-control'">
                            </div>
                            <div class="col-sm">
                                <input class="form-control" type="file" oninput="this.className = 'form-control'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <input class="form-control" type="number" placeholder="Registration No"
                                    oninput="this.className = 'form-control'">
                            </div>
                            <div class="col-sm">
                                <input class="form-control" type="file" oninput="this.className = 'form-control'">
                            </div>
                        </div>
                    </div>
                    <div class="tab">Social:
                        <p><input class="form-control" type="text" placeholder="Whatsapp Url"
                                oninput="this.className = 'form-control'">
                        </p>
                        <p><input class="form-control" type="text" placeholder="Location Url"
                                oninput="this.className = 'form-control'">
                        </p>
                        <p><input class="form-control" type="text" placeholder="Instagram Url"
                                oninput="this.className = 'form-control'"></p>
                        <p><input class="form-control" type="text" placeholder="Facebook Url"
                                oninput="this.className = 'form-control'"></p>
                    </div>
                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button class="btn" type="button" id="prevBtn"
                                onclick="nextPrev(-1)">Previous</button>
                            <button class="btn" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                    </div>
                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </form>
            </div>
        </div>



        <script>
            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab

            function showTab(n) {
                // This function will display the specified tab of the form...
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                //... and fix the Previous/Next buttons:
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Submit";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Next";
                }
                //... and run a function that will display the correct step indicator:
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");
                // Exit the function if any field in the current tab is invalid:
                if (n == 1 && !validateForm()) return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form...
                if (currentTab >= x.length) {
                    // ... the form gets submitted:
                    document.getElementById("regForm").submit();
                    return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }

            function validateForm() {
                // This function deals with validation of the form fields
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                // A loop that checks every input field in the current tab:
                for (i = 0; i < y.length; i++) {
                    // If a field is empty...
                    if (y[i].value == "") {
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }
                // If the valid status is true, mark the step as finished and valid:
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                return valid; // return the valid status
            }

            function fixStepIndicator(n) {
                // This function removes the "active" class of all steps...
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                //... and adds the "active" class on the current step:
                x[n].className += " active";
            }
        </script>
    </body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Badion | Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="icon" href="img/badion.png">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
    <script src="js/jquery-multi-step-form.js" type="text/javascript"></script>
    <link href="css/jquery-multi-step-form.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    html {
        height: 100%;
        background-image: url(images/icons/banner-bg-3.png);
        /* background: linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), url(bg.png); */
    }

    body {
        font-family: arial, verdana;
    }

    a,
    a:active,
    a:visited {
        text-decoration: none;
        color: #000000;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<body>
    <div id="multistepform-example-container">
        <ul id="multistepform-progressbar">
            {{-- <li class="active">Personal Details</li> --}}
            <li class="active">School Details</li>
            <li>Id Proofs</li>
            <li>Social</li>
        </ul>
        <div class="form">
            <form action="">
                <h2 class="fs-title">School Details</h2>
                <h3 class="fs-subtitle">1/3</h3>
                <input type="text" class="form-control" name="sname" id="sname" placeholder="Your Name">
                <input class="form-control" placeholder="Address..." name="Address">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                <input type="text" class="form-control" name="email" id="email" placeholder="E-mail">
                {{-- <input type="text" name="email" placeholder="Email">
                <input type="password" name="pass" placeholder="Password">
                <input type="password" name="cpass" placeholder="Confirm Password"> --}}
                <input type="button" name="next" class="next button" value="Next"><br>
                <a href="login">Already have an acount</a><br>
                <a href="home">Back to <span class="fa fa-home"></span></a>
            </form>
        </div>
        {{-- <div class="form">
            <form action="">
                <h2 class="fs-title">School Details</h2>
                <h3 class="fs-subtitle">2/4</h3>
                <input class="form-control" placeholder="School name..." name="Sname">
                <input class="form-control" placeholder="E-mail..." name="email">
                <input class="form-control" placeholder="Address..." name="Address">
                <input type="button" name="previous" class="previous button" value="Previous">
                <input type="button" name="next" class="next button" value="Next"><br>
                <a href="login">Already have an acount</a><br>
                <a href="home">Back to <span class="fa fa-home"></span></a>
            </form>
        </div> --}}
        <div class="form">
            <form action="">
                <h2 class="fs-title">ID PROOFS</h2>
                <h3 class="fs-subtitle">2/3</h3>
                <input class="form-control" type="number" placeholder="Pan">
                <input class="form-control" type="file">
                <input class="form-control" type="number" placeholder="Adhaar">
                <input class="form-control" type="file">
                <input class="form-control" type="number" placeholder="Registration No">
                {{-- <input class="form-control" type="number" placeholder="Gst">
                <input class="form-control" type="file"> --}}
                <input class="form-control" type="file">
                <input type="button" name="previous" class="previous button" value="Previous">
                {{-- <input type="button" name="submit" class="next button" value="Finish"> --}}
                <input type="button" name="next" class="next button" value="Next"><br>
                <a href="login">Already have an acount</a><br>
                <a href="home">Back to <span class="fa fa-home"></span></a><br>
            </form>
        </div>
        <div class="form">
            <form action="">
                <h2 class="fs-title">Social</h2>
                <h3 class="fs-subtitle">3/3</h3>
                <input class="form-control" type="text" placeholder="Whatsapp Url">
                <input class="form-control" type="text" placeholder="Location Url">
                <input class="form-control" type="text" placeholder="Instagram Url">
                <input class="form-control" type="text" placeholder="Facebook Url">
                <input type="button" name="previous" class="previous button" value="Previous">
                <input type="button" name="submit" class="next button" value="Finish"><br>
                <a href="login">Already have an acount</a><br>
                <a href="home">Back to <span class="fa fa-home"></span></a><br>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.multistepform({
                container: 'multistepform-example-container',
                form_method: 'GET',
            })
        });
    </script>

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
                '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>

</html>
