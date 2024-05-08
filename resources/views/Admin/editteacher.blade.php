@extends('Admin.layouts.main')
@section('badion')
    <style>
        form{
            margin: 10px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            display: none;
        }
    </style>
    {{-- <div class="d-grid justify-content-md-end">
  <a href="teachers"><button class="btn card me-md-2 fa fa-backward" type="button"> Teachers</button></a>
</div> --}}
    <div class="col-sm">
        <div class="card-text container card">
            <form id="editteacher">
                @csrf
                {{-- <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="name">User ID:</label> --}}
                <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User id"
                       value="{{ $teacher->user_id }}" readonly>
                {{-- <span class="text-danger">
                        @error('teacherid')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
        </div> --}}
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Teacher Name:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Sername YourName FatherName" value="{{ $teacher->name }}">
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
                                   placeholder="teacher@badion.com" value="{{ $teacher->email }}">
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
                                   placeholder="XXXXXXXXXX" value="{{ $teacher->phone }}">
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
                                   placeholder="Degree/Degrees" value="{{ $teacher->graduation }}">
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
                            <input type="number" class="form-control" name="salary" id="salary" placeholder="Salary"
                                   value="{{ $teacher->salary }}">
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
                            <input type="date" class="form-control" name="dob" id="dob"
                                   value="{{ \Carbon\Carbon::parse($teacher->dob)->format('Y-m-d') }}">
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
                            <input type="number" class="form-control" name="aadhaar" id="aadhaar" placeholder="Aadhaar"
                                   value="{{ $teacher->aadhaar }}">
                            <span class="text-danger">
                                @error('aadhaar')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <x-fileinput name="profilepic" label="Profile Picture:" labelid="profilepicid" accept="img/*"/>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="name">Profile Picture:</label>--}}
                        {{--                            <input type="file" class="form-control" name="profilepic" id="profilepic" accept="image/*"--}}
                        {{--                                value="{{ $teacher->profilepic }}">--}}
                        {{--                            <span class="text-danger">--}}
                        {{--                                @error('profilepic')--}}
                        {{--                                    {{ $message }}--}}
                        {{--                                @enderror--}}
                        {{--                            </span>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="name">Address:</label>
                            <textarea class="form-control" name="address" id="address"
                                      placeholder="Your Address Here">{{ $teacher->address }}</textarea>
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
                            <input class="form-check-input" type="radio" name="gender" id="gender"
                                   @if ($teacher->gender == 'M') checked @endif value="M">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender"
                                   @if ($teacher->gender == 'F') checked @endif value="F">
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
        $(document).ready(function () {
            $("#reset").click(function () {
                location.reload(true);
            });

            $("#editteacher").validate({
                rules: {
                    user_id: {
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
                beforeSend: function () {
                    $("#submit").attr("disabled", true);
                },
                submitHandler: function (form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "{{ route('avalidateeditteacher') }}",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function (data) {
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
