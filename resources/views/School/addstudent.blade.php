@extends('School.layouts.main')
@section('badion')
    <div class="col-sm">
        <div class="card-text container card">
            <form id="addstudent" enctype="multipart/form-data"><!--action="validateaddstudent" method="post" -->
                @csrf
                <div class=row>
                    <input type="hidden" id="schoolid" name="schoolid" value="">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Fullname</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Surname YourName FatherName">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Parent Name</label>
                            <input type="text" class="form-control" name="pname" id="pname"
                                placeholder="ParentName Sirname">
                            <span class="text-danger">
                                @error('pname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class=row>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" name="email" id="email"
                                placeholder="student@badion.com">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Parent Email</label>
                            <input type="text" class="form-control" name="pemail" id="pemail"
                                placeholder="parent@badion.com">
                            <span class="text-danger">
                                @error('pemail')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class=row>
                    <x-input label="Phone" type="number" name="phone" placeholder="XXXXXXXXXX" />
                    <x-input label="Parent Phone No" type="number" name="pphone" placeholder="XXXXXXXXXX" />
                </div>
                <div class=row>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Standard</label>
                            <select class="form-select" name="standard" id="standard">
                                <option selected disabled>Select Class</option>
                            </select>
                            <span class="text-danger">
                                @error('standard')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <x-input label="Roll No" type="number" name="rollno" placeholder="Roll Number" />
                </div>
                <div class=row>
                    <x-input label="Admission No" type="number" name="addmissionno" placeholder="Admission Number" />
                    <x-input label="Date of birth" type="date" name="dob" placeholder="" />
                </div>
                <div class=row>
                    <x-input label="Aadhaar No" type="number" name="aadhaar" placeholder="XXXXXXXXXXXX" />
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="profilepic">Add Profile Picture</label>
                            {{--                            <label for="profilepic" class="btn form-control" --}}
                            {{--                                id="profilepic">profilepic</label> --}}
                            <input type="file" id="profilepic" class="form-control" name="profilepic" accept="image/*">
                        </div>
                        <span class="text-danger">
                            @error('profilepic')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class=row>

                    <div class="col-sm">
                        <div class="form-group">
                            <label for="roll">Address:</label>
                            <textarea class="form-control" name="address" id="address" placeholder="Student Address Here"></textarea>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="gender">Gender:</label>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="M">
                                <label class="form-check-label" for="gender">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    value="F">
                                <label class="form-check-label" for="gender">
                                    Female
                                </label>
                            </div>
                        </div>
                        <div>
                            <label id="gender-error" class="text-danger" for="gender"></label>
                            <span class="text-danger">
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class=row>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="button" class="form-control btn button" id="clear" value="Clear">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="submit" id="submit" name="submit" class="form-control btn button"
                                value="Submit">
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
                beforeSend: function() {
                    $('#standard').empty().append('<option selected disabled>Select Class</option>');
                },
                success: function(data) {
                    $("#schoolid").val(data.school);
                    var shandard = data.standard;
                    var standardValues = {
                        "Playgroup": 0,
                        "Nursery": 1,
                        "LKG": 2,
                        "UKG": 3,
                        "1st": 4,
                        "2nd": 5,
                        "3rd": 6,
                        "4th": 7,
                        "5th": 8,
                        "6th": 9,
                        "7th": 10,
                        "8th": 11,
                        "9th": 12,
                        "10th": 13,
                        "11th": 14,
                        "12th": 15,
                    };

                    shandard.sort(function(a, b) {
                        if (standardValues[a.name] !== standardValues[b.name]) {
                            return standardValues[a.name] - standardValues[b.name];
                        } else {
                            return a.div.localeCompare(b.div);
                        }
                    });

                    var sortedshandard = [];
                    $.each(shandard, function(index, standard) {
                        sortedshandard.push(standard.name + ' - ' + standard.div);
                    });

                    $.each(shandard, function(index, standard) {
                        var optionID = standard.class_id;
                        var optionValue = standard.name + ' - ' + standard.div;
                        $("#standard").append("<option id='" + optionID + "' value='" +
                            optionID + "'>" + optionValue + "</option>");
                    });
                }
            });


            $("#addstudent").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                    },
                    pname: {
                        required: true,
                        minlength: 2,
                    },
                    email: {
                        required: true,
                    },
                    pemail: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    pphone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    standard: {
                        required: true,
                    },
                    rollno: {
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
                    division: {
                        required: true,
                    },
                },
                errorClass: "text-danger",

                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "validateaddstudent",
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
