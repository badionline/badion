@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="row d-flex justify-content-center">
                        <img class="card-img-top" src="{{ asset($profile->profilepic) }}"
                            onerror="this.onerror=null;this.src='{{ asset('img/school.png') }}'" style="width: 18rem;"
                            alt="{{ $profile->name }}">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="container dark light">School Name:</th>
                                    <td class="dark light">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Address:</th>
                                    <td class="dark light">{{ $profile->address }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Phone:</th>
                                    <td class="dark light">{{ $profile->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Registration date:</th>
                                    <td class="dark light">
                                        {{ \Carbon\Carbon::parse($profile->created_at)->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Email:</th>
                                    <td class="dark light">{{ $profile->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm light">
                <ul class="nav nav-tabs" role="tablist" style="border: none">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link dark light active" id="disabled-tab-0" data-bs-toggle="tab"
                            href="#disabled-tabpanel-0" role="tab" aria-controls="disabled-tabpanel-0"
                            aria-selected="true">Social</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link dark light" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"
                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">KYC</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link dark light" id="disabled-tab-2" data-bs-toggle="tab" href="#disabled-tabpanel-2"
                            role="tab" aria-controls="disabled-tabpanel-2" aria-selected="false">Change Password</a>
                    </li>
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
                        <div class="container card">
                            <form id="updatesocial">
                                @csrf
                                <input type="hidden" name="school_id" id="school_id">
                                <div class="row">
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="location" name="location"
                                            placeholder="Location" value="{{ $profile->location }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                            placeholder="Whatsapp Channel" value="{{ $profile->whatsapp }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="instagram" name="instagram"
                                            placeholder="Instagram" value="{{ $profile->instagram }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="youtube" name="youtube"
                                            placeholder="Youtube" value="{{ $profile->youtube }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <textarea class="form-control" id="address" name="address" placeholder="Address">{{ $profile->address }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <input type="submit" name="updatesocial" class="btn button" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-1" role="tabpanel" aria-labelledby="disabled-tab-1">
                        <div class="card dark light">
                            <div class="table-responsive container">
                                <table class="table">
                                    <tr>
                                        <td class="container dark light">Aadhaar</td>
                                        <td class="container dark light">{{ $profile->adhaar }}</td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Pan</td>
                                        <td class="container dark light">{{ $profile->pan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Registered Number (Govt.)</td>
                                        <td class="container dark light">{{ $profile->registernumber }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-2" role="tabpane2" aria-labelledby="disabled-tab-2">
                        <div class="container card">
                            <form id="changepass" class="container" action='{{ route('schoolchangepass') }}'>
                                @csrf
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td class="container dark light">
                                                <div class="form-group">
                                                    <input type="hidden" name="user_id" id="user_id"
                                                        value={{ $user->user_id }}>
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
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $.validator.addMethod("startsWith", function(value, element, param) {
            return this.optional(element) || value.indexOf(param) === 0;
        }, "Value must start with {0}.");

        $.ajax({
            type: 'GET',
            url: 'getstandard',
            dataType: 'JSON',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                $("#school_id").val(data.school);
            }
        });

        $("#updatesocial").validate({
            rules: {
                location: {
                    // required: true,
                    startsWith: "https://g.co/"
                },
                whatsapp: {
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
                address: {
                    required: true,
                    minlength: 10,
                }
            },
            // Define error messages for each input field
            messages: {
                location: {
                    startsWith: "Location url must start with https://g.co/"
                },
                whatsapp: {
                    startsWith: "WhatsApp url must start with https://w"
                },
                youtube: {
                    startsWith: "Youtube url must start with https://www.youtube.com/@"
                },
                instagram: {
                    startsWith: "Instagram url must start with https://www.instagram.com/"
                },
                address: {
                    required: "Address is required",
                    minlength: "Minimim 10 letters are required for address"
                },
            },
            errorClass: "text-danger",

            submitHandler: function(form, event) {
                event.preventDefault();
                let data = new FormData(form);
                $.ajax({
                    type: 'post',
                    url: "{{ route('updateschoolsocial') }}",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    async: true,
                    cache: false,
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            }
        });

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
    </script>
@endsection
