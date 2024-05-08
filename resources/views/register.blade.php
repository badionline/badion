<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <link rel="icon" href="{{ asset('img/badion.png') }}">
</head>
<style>
    body {
        background-image: url(images/icons/banner-bg-3.png);
        /* font-family: "Audiowide", sans-serif; */
        font-family: "Rubik", sans-serif;
        padding-bottom: 50px;
        user-select: none;
    }

    .form-control:not(.button),
    .form-control:focus:not(.button),
    .form-select,
    .ts-wrapper {
        background: #e0e0e0;
        color: #353535;
        border: none;
        /* border:1px solid #DA8228; */
        box-shadow: 1px 1px 2px #DA8228, -1px -1px 2px #DA8228;
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
        /* margin: 10px; */
        color: #FFFFFF;
    }

    #submit {
        border: 2px solid #FFFFFF;
    }

    .col-sm {
        margin-top: 20px;
        border-color: #353535;
    }

    .error:not(.form-control) {
        display: flex;
        position: absolute;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        display: none;
    }

    .loaderClass {
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 10;
        background-color: white;
        top: 0;
        display: none;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="loaderClass">
    <img src="{{ asset('img/loading.gif') }}">
</div>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="container">
                        <form id="register" enctype='multipart/form-data'>
                            @csrf
                            <div class="row">
                                <div class="col-sm text-end">
                                    <a href="home"><span class="fa fa-home"></span></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-sm pb-2">
                                            <input type="text" name="sname" class="form-control"
                                                placeholder="School Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" name="address" class="form-control"
                                                placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="number" id="phone" name="phone" class="form-control"
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" name="waurl" class="form-control"
                                                placeholder="Whatsapp Url">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" name="location" class="form-control"
                                                placeholder="Location Url">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" name="instagram" class="form-control"
                                                placeholder="Instagram Url">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" name="youtube" class="form-control"
                                                placeholder="Youtube Url">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" name="registernum" class="form-control"
                                        placeholder="Registered Number (Govt.)">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" name="pan" class="form-control" placeholder="Pan">
                                </div>
                                <div class="col-sm">
                                    <x-fileinput name="panfile" labelid="panfilelabel" label="Pan"
                                        accept="application/pdf" />
                                    <small id="panfile-error" class="error"></small>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="number" name="adhaar" class="form-control" placeholder="Adhaar">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <x-fileinput name="adhaarfront" labelid="adhaarfrontfile"
                                        label="Adhaar Front File" accept="application/pdf" />
                                    <small id="adhaarfront-error" class="error"></small>
                                </div>
                                <div class="col-sm">
                                    <x-fileinput name="adhaarback" labelid="adhaarbackfile" label="Adhaar Back File"
                                        accept="application/pdf" />
                                    <small id="adhaarback-error" class="error"></small>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="submit" id="submit" class="btn form-control button"
                                        value="Submit">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <a href="login">Already have an account? Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js"
    integrity="sha512-TiQST7x/0aMjgVTcep29gi+q5Lk5gVTUPE9XgN0g96rwtjEjLpod4mlBRKWHeBcvGBAEvJBmfDqh2hfMMmg+5A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    $(document).ready(function() {

        $.validator.addMethod("startsWith", function(value, element, param) {
            return this.optional(element) || value.indexOf(param) === 0;
        }, "Value must start with {0}.");

        $("#register").validate({
            rules: {
                sname: {
                    required: true,
                    minlength: 2,
                },
                address: {
                    required: true,
                    minlength: 10,
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                },
                email: {
                    required: true,
                },
                location: {
                    // required: true,
                    startsWith: "https://maps.app.goo.gl/"
                },
                waurl: {
                    // required: true,
                    startsWith: "https://w"
                },
                instagram: {
                    // required: true,
                    startsWith: "https://www.instagram.com/"
                },
                youtube: {
                    // required: true,
                    startsWith: "https://www.youtube.com/@"
                },
                registernum: {
                    required: true,
                },
                pan: {
                    required: true,
                },
                panfile: {
                    required: true,
                    accept: "application/pdf",
                },
                adhaar: {
                    required: true,
                    minlength: 12,
                    maxlength: 12,
                },
                adhaarfront: {
                    required: true,
                    accept: "application/pdf",
                },
                adhaarback: {
                    required: true,
                    accept: "application/pdf",
                },
            },
            messages: {
                location: {
                    startsWith: "Location url must start with https://maps.app.goo.gl/"
                },
                waurl: {
                    startsWith: "WhatsApp url must start with https://w"
                },
                instagram: {
                    startsWith: "Instagram url must start with https://www.instagram.com/"
                },
                youtube: {
                    startsWith: "Youtube url must start with https://www.youtube.com/@"
                },
                address: {
                    required: "Address is required",
                    minlength: "Minimim 10 letters are required for address"
                }
            },
            errorClass: "error",
            errorElement: "small",
            // errorPlacement: function(error, element) {
            //     // if (error[0].innerText) {
            //     //     $("#errors").append(`<li>${error[0].innerText}</li>`);
            //     //     console.log(error);
            //     // }
            // },

            submitHandler: function(form, event) {
                event.preventDefault();
                let data = new FormData(form);
                $.ajax({
                    type: 'post',
                    url: "{{ route('addschool') }}",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    async: true,
                    cache: false,
                    beforeSend: function() {
                        $(".loaderClass").css("display", "flex");
                    },
                    success: function(data) {
                        $(".loaderClass").css("display", "none");
                        if (data.status == 0) {
                            $.each(data.message, function(index, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.success(data.message);
                        }
                    }
                });
            }
        });
    });
</script>
