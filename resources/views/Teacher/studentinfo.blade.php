@extends('Teacher.layouts.main')
@section('badion')
    {{-- <div class="d-grid justify-content-md-end"> --}}
    {{--    <a href="student"><button class="btn card me-md-2 fa fa-backward" type="button"> Back</button></a> --}}
    {{-- </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="text-center">
                        <img class="card-img-top" src="{{ asset($student->profilepic) }}"
                            onerror="this.onerror=null;this.src='{{ asset('img/students.png') }}';" style="width: 18rem;"
                            alt="Card image cap">
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
                        <a class="nav-link text-dark active" id="disabled-tab-0" data-bs-toggle="tab"
                            href="#disabled-tabpanel-0" role="tab" aria-controls="disabled-tabpanel-0"
                            aria-selected="true"> Student Info</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"
                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">Parents Info</a>
                    </li>
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
                        <div class="table-responsive container card">
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
                                    <th class="container dark light">Address:</th>
                                    <td class="container dark light">{{ $student->address }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Gender:</th>
                                    <td class="container dark light">
                                        @if ($student->gender == 'M')
                                            Male
                                        @else
                                            Female
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-1" role="tabpanel" aria-labelledby="disabled-tab-1">
                        <div class="teble-responsive container card">
                            <table class="table">
                                <tr>
                                    <th class="container dark light">Parent Name:</th>
                                    <td class="container dark light">{{ $student->pname }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Parent Email:</th>
                                    <td class="container dark light">{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Parent Phone Number:</th>
                                    <td class="container dark light">{{ $student->pphone }}</td>
                                </tr>
                            </table>
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
                                        <td class="container dark light">{{ $class->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Division:</th>
                                        <td class="container dark light">{{ $class->div }}</td>
                                    </tr>
                                    <tr>
                                        <th class="container dark light">Roll No:</th>
                                        <td class="container dark light">{{ $student->rollno }}</td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                        <li class="list-group-item  dark light"><span class="fa fa-location-arrow"></span><br>
                            {{ $student->address }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
