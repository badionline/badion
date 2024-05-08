@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="card-head d-flex justify-content-center">
                        <img class="card-img" src="{{ asset('img/badion.png') }}" style="width: 18rem;height: 18rem"
                            alt="Profile">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="container dark light">Name:</th>
                                    <td class="dark light">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Email:</th>
                                    <td class="dark light">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Contact:</th>
                                    <td class="dark light">{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Address:</th>
                                    <td class="dark light">{{ $user->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm light">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark active" id="disabled-tab-0" data-bs-toggle="tab"
                            href="#disabled-tabpanel-0" role="tab" aria-controls="disabled-tabpanel-0"
                            aria-selected="true">Change Password</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"
                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">Change Password</a>
                    </li> --}}
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    {{-- <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
                        <div class="container card">
                            <form>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Contact">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="submit" class="btn button" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
                        <div class="container card">
                            <form id="changepass" class="container">
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
        $("#changepass").validate({
            rules: {
                user_id: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 64,
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
                $.ajax({
                    type: 'post',
                    url: "{{ route('adminchangepass') }}",
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
