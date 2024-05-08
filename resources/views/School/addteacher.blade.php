@extends('School.layouts.main')
@section('badion')
    {{-- <div class="d-grid justify-content-md-end">
  <a href="teachers"><button class="btn card me-md-2 fa fa-backward" type="button"> Back</button></a>
</div> --}}
    <div class="col-sm">
        <div class="card-text container dark card">
            <form id="addteacher">
                @csrf
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="hidden" id="schoolid" name="schoolid" value="">
                            <label for="name">Teacher Name:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Sername YourName FatherName">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="text" class="form-control" name="email" id="email"
                                placeholder="teacher@badion.com">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Phone:</label>
                            <input type="number" class="form-control" name="phone" id="phone"
                                placeholder="XXXXXXXXXX">
                            <span class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Graduation:</label>
                            <input type="text" class="form-control" name="graduation" id="graduation"
                                placeholder="Degree/Degrees">
                            <span class="text-danger">
                                @error('graduation')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Salary:</label>
                            <input type="number" class="form-control" name="salary" id="salary" placeholder="Salary">
                            <span class="text-danger">
                                @error('salary')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Date of birth:</label>
                            <input type="date" class="form-control" name="dob" id="dob">
                            <span class="text-danger">
                                @error('dob')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Aadhaar No:</label>
                            <input type="number" class="form-control" name="aadhaar" id="aadhaar" placeholder="Aadhaar">
                            <span class="text-danger">
                                @error('aadhaar')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Profile Picture:</label>
                            <input type="file" class="form-control" name="profilepic" id="profilepic" accept="image/*">
                            <span class="text-danger">
                                @error('profilepic')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Address:</label>
                            <textarea class="form-control" name="address" id="address" placeholder="Your Address Here"></textarea>
                            <span class="text-danger">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="gender">Gender:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="M">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender"
                                value="F">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                        <label id="gender-error" class="text-danger" for="gender"></label>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <input type="button" name="reset" class="form-control btn button" id="reset"
                                    value="Reset">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-control btn button" id="submit"
                                    value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {

            $("#clear").click(function() {
                location.reload(true);
            });

            $.ajax({
                type: 'GET',
                url: 'getstandard',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function(data) {
                    $("#schoolid").val(data.school);
                }
            });


            $("#addteacher").validate({
                rules: {
                    schoolid: {
                        required: true,
                    },
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    graduation: {
                        required: true,
                    },
                    salary: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    division: {
                        required: true,
                    },
                    addmissionno: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    aadhaar: {
                        required: true,
                        minlength: 12,
                        maxlength: 12,
                    },
                    profilepic: {
                        required: true,
                        // accept: "jpg|jpeg|png",
                    },
                    address: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                },
                errorClass: "text-danger",

                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "validateaddteacher",
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
                            if (data.status == 1) {
                                toastr.success(data.message);
                            } else {
                                toastr.error(data.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
