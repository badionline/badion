@extends('Student.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="row d-flex justify-content-center">
                        <img class="card-img-top" src="{{ asset($student->profilepic) }}"
                            onerror="this.onerror=null;this.src='{{ asset('img/students.png') }}'" style="width: 18rem;"
                            alt="{{ $student->name }}">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="container dark light">Addmission Number:</th>
                                    <td class="dark light">{{ $student->addmissionno }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Name:</th>
                                    <td class="dark light">{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Email:</th>
                                    <td class="dark light">{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Contact:</th>
                                    <td class="dark light">{{ $student->phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm light">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link dark light active" id="disabled-tab-0" data-bs-toggle="tab"
                            href="#disabled-tabpanel-0" role="tab" aria-controls="disabled-tabpanel-0"
                            aria-selected="true">Student</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link dark light" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"
                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">Parent</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link dark light" id="disabled-tab-2" data-bs-toggle="tab" href="#disabled-tabpanel-2"
                            role="tab" aria-controls="disabled-tabpanel-2" aria-selected="false">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
                        <div class="card">
                            <div class="table-responsive container">
                                <table class="table">
                                    <tr>
                                        <th class="container dark light">Student Name:</th>
                                        <td class="container dark light">{{ $student->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Student Email:</th>
                                        <td class="container dark light">{{ $student->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Phone Number:</th>
                                        <td class="container dark light">{{ $student->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Date of Birth:</th>
                                        <td class="container dark light">{{ $student->dob }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Aadhaar:</th>
                                        <td class="container dark light">{{ $student->aadhaar }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Address:</th>
                                        <td class="container dark light">{{ $student->address }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Gender:</th>
                                        <td class="container dark light">
                                            @if ($student->gender == 'M')
                                                {{ 'Male' }}
                                            @else
                                                {{ 'Female' }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-1" role="tabpanel" aria-labelledby="disabled-tab-1">
                        <div class="card">
                            <div class="table-responsive container">
                                <table class="table">
                                    <tr>
                                        <th class="container dark light text-start">Parent Name:</th>
                                        <td class="container dark light text-start">{{ $student->pname }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light text-start">Parent Email:</th>
                                        <td class="container dark light text-start">{{ $student->pemail }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light text-start">Parent Phone Number:</th>
                                        <td class="container dark light text-start">{{ $student->pphone }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-2" role="tabpane2" aria-labelledby="disabled-tab-2">
                        <div class="container card">
                            <form id="changepass" class="container">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td class="container dark light">
                                                <div class="form-group">
                                                    <input type="hidden" name="user_id" id="user_id"
                                                        value={{ $student->user_id }}>
                                                    <label for="password">Password:</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" placeholder="Password">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="container dark light">
                                                <div class="form-group">
                                                    <label for="cpassword">Confirm Password:</label>
                                                    <input type="password" class="form-control" id="cpassword"
                                                        name="cpassword" placeholder="Confirm Password">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="container dark light">
                                                <div class="form-group">
                                                    <input type="submit" class="form-control btn button btn-block"
                                                        value="Submit">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <ul class="list-group  list-group-flush">
                        <li class="list-group-item  dark light">About {{ $student->name }}</li>
                        <li class="list-group-item  dark light"><span class="fa fa-book">&nbsp;Education</span><br>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="container dark light">Class:</th>
                                        <td class="container dark light">{{ $student->class }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Division:</th>
                                        <td class="container dark light">{{ $student->div }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Roll No:</th>
                                        <td class="container dark light">{{ $student->rollno }}</td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                        <li class="list-group-item  dark light"><span class="fa fa-location-arrow"></span><br>
                            Address
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
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
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    // let action = $(form).attr("action");
                    $.ajax({
                        type: 'post',
                        url: '{{ route('studentchangepass') }}',
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
