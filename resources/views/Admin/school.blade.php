@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="card-head d-flex justify-content-center">
                        <img class="card-img" src="{{ asset('img/school.png') }}" style="width: 18rem;height: 18rem"
                            alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td class="container dark light text-end" colspan="2">
                                        <a href="{{$url = route('editschool', ['id' => $school->user_id])}}">
                                            <button class="btn button fa fa-edit" type="button"> Edit School</button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="container dark light">School Name:</th>
                                    <td class="dark light">{{$school->name}}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Address:</th>
                                    <td class="dark light">{{$school->address}}</td>
                                </tr>
                                <tr>
                                    <th class="dark light">Phone:</th>
                                    <td class="dark light">{{$school->phone}}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Registration date:</th>
                                    <td class="dark light">{{date_format($school->created_at,"Y/m/d") }}</td>
                                </tr>
                                <tr>
                                    <th class="container dark light">Email:</th>
                                    <td class="dark light">{{$school->email}}</td>
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
                            aria-selected="true">Social</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"
                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">KYC</a>
                    </li>
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
                        <div class="card dark light">
                            <div class="table-responsive container">
                                <table class="table">
                                    <tr>
                                        <td class="container dark light">Location</td>
                                        <td class="container dark light">
                                            @isset($school->location)
                                                <a href="{{$school->location}}" target="_blank"><label class="fa fa-map-marker dark light"></label></a>
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Whatsapp
                                        </td>
                                        <td class="container dark light">
                                            @isset($school->whatsapp)
                                                <a href="{{$school->whatsapp}}" target="_blank"><label class="fab fa-whatsapp dark light"></label></a>
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Instagram</td>
                                        <td class="container dark light">
                                            @isset($school->instagram)
                                                <a href="{{$school->instagram}}" target="_blank"><label class="fab fa-instagram dark light"></label></a>
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Youtube</td>
                                        <td class="container dark light">
                                            @isset($school->youtube)
                                                <a href="{{$school->youtube}}" target="_blank"><label class="fab fa-youtube dark light"></label></a>
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Address</td>
                                        <td class="container dark light">{{$school->address}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-1" role="tabpanel" aria-labelledby="disabled-tab-1">
                        <div class="card dark light">
                            <div class="table-responsive container">
                                <table class="table">
                                    <tr>
                                        <td class="container dark light">Aadhaar</td>
                                        <td class="container dark light">{{$school->adhaar}}</td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Pan</td>
                                        <td class="container dark light">{{$school->pan}}</td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">Registered Number (Govt.)</td>
                                        <td class="container dark light">{{$school->registernumber}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <ul class="list-group  list-group-flush">
                        <li class="list-group-item  dark light">About {{$school->name}}</li>
                        <li class="list-group-item  dark light"><span
                                class="fa fa-chalkboard-teacher">&nbsp;Teachers</span><br>
                            {{$teacherscount}}
                        </li>
                        <li class="list-group-item  dark light"><span
                                class="fa fa-book-reader">&nbsp;Students</span><br>
                            {{$studentscount}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection