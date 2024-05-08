@extends('School.layouts.main')
@section('badion')
    {{-- <div class="d-grid justify-content-md-end">
    <a href="teachers"><button class="btn card me-md-2 fa fa-backward" type="button"> Teachers</button></a>
</div> --}}
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="row d-flex justify-content-center">
                        <img class="card-img-top" src="{{ asset($teacher->profilepic) }}"
                             onerror="this.onerror=null;this.src='{{ asset('img/teacher.png') }}'" style="width: 18rem;"
                             alt="{{ $teacher->name }}">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="container dark light">Teacher ID:</th>
                                    <td class="dark light">{{ $teacher->teacher_id }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Name:</th>
                                    <td class="dark light">{{ $teacher->name }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Email:</th>
                                    <td class="dark light">{{ $teacher->email }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Contact:</th>
                                    <td class="dark light">{{ $teacher->phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm light">
                {{--                <ul class="nav nav-tabs" role="tablist">--}}
                {{--                    <li class="nav-item" role="presentation">--}}
                {{--                        <a class="nav-link active" id="disabled-tab-0" data-bs-toggle="tab" href="#disabled-tabpanel-0"--}}
                {{--                            role="tab" aria-controls="disabled-tabpanel-0" aria-selected="true">Information</a>--}}
                {{--                    </li>--}}
                {{--                    <li class="nav-item" role="presentation">--}}
                {{--                        <a class="nav-link" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"--}}
                {{--                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">Change Password</a>--}}
                {{--                    </li>--}}
                {{--                </ul>--}}
                {{--                <div class="tab-content pt-5" id="tab-content">--}}
                {{--                    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">--}}
                <div class="card">
                    <div class="table-responsive container">
                        <table class="table">
                            {{-- <tr>
                        <th class="container dark light">Class Teacher:</th>
                        <td class="container dark light">Null</td>
                    </tr> --}}
                            <tr>
                                <th class="container dark light">Date of Birth:</th>
                                <td class="container dark light">{{ $teacher->dob }}</td>
                            </tr>
                            <tr>
                                <th class="container dark light">Aadhaar:</th>
                                <td class="container dark light">{{ $teacher->aadhaar }}</td>
                            </tr>
                            <tr>
                                <th class="container dark light">Address:</th>
                                <td class="container dark light">{{ $teacher->address }}</td>
                            </tr>
                            <tr>
                                <th class="container dark light">Gender:</th>
                                <td class="container dark light">
                                    @if ($teacher->gender == 'M')
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="container dark light">Salary:</th>
                                <td class="container dark light">{{ $teacher->salary }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                {{--                    </div>--}}

                {{--                    <div class="tab-pane" id="disabled-tabpanel-1" role="tabpanel" aria-labelledby="disabled-tab-1">--}}
                {{--                        <div class="card">--}}
                {{--                            <form id="changepass" class="container" action='{{ route('teacherchangepass') }}'>--}}
                {{--                                @csrf--}}
                {{--                                <div class="table-responsive">--}}
                {{--                                    <table class="table">--}}
                {{--                                        <tr>--}}
                {{--                                            <td class="container dark light">--}}
                {{--                                                <div class="form-group">--}}
                {{--                                                    <input type="hidden" name="user_id" id="user_id"--}}
                {{--                                                        value={{ $teacher->user_id }}>--}}
                {{--                                                    <label for="password">Password:</label>--}}
                {{--                                                    <input type="password" class="form-control" id="password"--}}
                {{--                                                        name="password" placeholder="Password">--}}
                {{--                                                </div>--}}
                {{--                                            </td>--}}
                {{--                                        </tr>--}}
                {{--                                        <tr>--}}
                {{--                                            <td class="container dark light">--}}
                {{--                                                <div class="form-group">--}}
                {{--                                                    <label for="cpassword">Confirm Password:</label>--}}
                {{--                                                    <input type="password" class="form-control" id="cpassword"--}}
                {{--                                                        name="cpassword" placeholder="Confirm Password">--}}
                {{--                                                </div>--}}
                {{--                                            </td>--}}
                {{--                                        </tr>--}}
                {{--                                        <tr>--}}
                {{--                                            <td class="container dark light">--}}
                {{--                                                <div class="form-group">--}}
                {{--                                                    <input type="submit" id="submit" name="submit"--}}
                {{--                                                        class="form-control btn button btn-block" value="Submit">--}}
                {{--                                                </div>--}}
                {{--                                            </td>--}}
                {{--                                        </tr>--}}
                {{--                                    </table>--}}
                {{--                                </div>--}}
                {{--                            </form>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <ul class="list-group  list-group-flush">
                        <b><li class="list-group-item  dark light">About {{ $teacher->name }}</li></b>
                        <li class="list-group-item  dark light">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td class="container dark light"><span class="fa fa-book">&nbsp;Subjects</span></td>
                                        <td class="container dark light"><span class="fa fa-school">&nbsp;Class</span></td>
                                    </tr>
                                    @foreach($subject as $sub)
                                        <tr>
                                            <td class="container dark light">{{$sub->subject}}</td>
                                            <td class="container dark light">{{$sub->class}}({{$sub->div}})</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </li>
{{--                        <li class="list-group-item  dark light"><span class="fa fa-school">&nbsp;Class</span><br>--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table">--}}
{{--                                    <tr>--}}
{{--                                        <th class="container dark light">1 - A</th>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <th class="container dark light">2 - A</th>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <th class="container dark light">3 - A</th>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <li class="list-group-item  dark light"><span class="fa fa-location-arrow"></span><br>
                            {{ $teacher->address }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function () {
            $("#changepass").validate({
                rules: {
                    user_id: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 64,
                        // regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,64}$/,
                    },
                    cpassword: {
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages: {
                    cpassword: {
                        equalTo: "Password and confirm password does not match",
                    },
                },
                errorClass: "text-danger",
                submitHandler: function (form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    let action = $(form).attr("action");
                    console.log(action);
                    $.ajax({
                        type: 'post',
                        url: action,
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
