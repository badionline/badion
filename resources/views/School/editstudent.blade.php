@extends('School.layouts.main')
@section('badion')
    {{-- <div class="d-grid justify-content-md-end">
  <a href="../students"><button class="btn card me-md-2 dark fa fa-backward light" type="button"> Students</button></a>
</div> --}}
    <div class="col-sm">
        <div class="card-text container card">
            <form id="editstudent" enctype="multipart/form-data"><!--action="validateaddstudent" method="post" -->
                @csrf
                {{-- <div class="row">
        <div class="col-sm">
          <label for="user_id">User Id:</label> --}}
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $student->user_id }}"
                    readonly>
                {{-- </div>
      </div> --}}
                <div class=row>
                    <x-input label="Fullname" type="text" name="name" value="{{ $student->name }}"
                        placeholder="Surname YourName FatherName" />
                    <x-input label="Parent Name" type="text" name="pname" value="{{ $student->pname }}"
                        placeholder="ParentName Sirname" />
                </div>
                <div class=row>
                    <x-input label="Email" type="text" name="email" value="{{ $student->email }}"
                        placeholder="student@badion.com" />
                    <x-input label="Parent Email" type="text" name="pemail" value="{{ $student->pemail }}"
                        placeholder="parent@badion.com" />
                </div>
                <div class=row>
                    <x-input label="Phone" type="number" name="phone" value="{{ $student->phone }}"
                        placeholder="XXXXXXXXXX" />
                    <x-input label="Parent Phone No" type="number" name="pphone" value="{{ $student->pphone }}"
                        placeholder="XXXXXXXXXX" />
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
                    <x-input label="Roll No" type="number" name="rollno" value="{{ $student->rollno }}"
                        placeholder="Roll Number" />
                </div>
                <div class=row>
                    <x-input label="Admission No" type="number" name="addmissionno" value="{{ $student->addmissionno }}"
                        placeholder="Admission Number" />
                    <x-input label="Date of birth" type="date" name="dob"
                        value="{{ \Carbon\Carbon::parse($student->dob)->format('Y-m-d') }}" placeholder="" />
                </div>
                <div class=row>
                    <x-input label="Aadhaar No" type="number" name="aadhaar" value="{{ $student->aadhaar }}"
                        placeholder="XXXXXXXXXXXX" />
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
                            <textarea class="form-control" name="address" id="address" placeholder="Student Address Here">{{ $student->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm">
                        <label for="gender">Gender:</label>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    @if ($student->gender == 'M') checked @endif value="M">
                                <label class="form-check-label" for="gender">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender"
                                    @if ($student->gender == 'F') checked @endif value="F">
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
                            <input type="button" class="form-control btn button" id="reset" value="Reset">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-control btn button"
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
            $("#reset").click(function() {
                location.reload(true);
            });
            $.ajax({
                type: 'GET',
                url: '../getstandard',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#standard').empty().append('<option selected disabled>Select Class</option>');
                },
                success: function(data) {
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


            $("#editstudent").validate({
                rules: {
                    user_id: {
                        required: true,
                    },
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
                beforeSend: function() {
                    $("#submit").attr("disabled", true);
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "../validateeditstudent",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            console.log(data);
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
