@extends('Student.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <x-card img="{{ asset('img/attendance.png') }}" title="Total Days" value="total" url="attendance" />
        </div>
        <div class="row">
            <x-card img="{{ asset('img/present.png') }}" title="Present" value="present" url="attendance" />
            <x-card img="{{ asset('img/absent.png') }}" title="Absent" value="absent" url="attendance" />
        </div>
        <div class="row">
            <x-card img="{{ asset('img/leave.png') }}" title="Leave" value="leave" url="attendance" />
            <x-card img="{{ asset('img/percent.png') }}" title="Attendence in percent" value="percent" url="attendance" />
        </div>
    </div>
    {{-- <div class="col-sm">
                <div class="card dark">
                    <div class="table-responsive"> --}}
    {{-- <table> --}}
    {{-- </table> --}}
    {{-- <table class="table dark text-center">
                            <thead>
                                <th class="dark light">Months</th>
                                <th class="dark light">Present</th>
                                <th class="dark light">Absent</th>
                                <th class="dark light">Suspend</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="dark light">January</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">February</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">March</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">April</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">May</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">June</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">July</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">August</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">September</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <tr>
                                    <td class="dark light">October</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                    <td class="dark light">Null</td>
                                </tr>
                                <td class="dark light">November</td>
                                <td class="dark light">Null</td>
                                <td class="dark light">Null</td>
                                <td class="dark light">Null</td>
                                </tr>
                                <td class="dark light">December</td>
                                <td class="dark light">Null</td>
                                <td class="dark light">Null</td>
                                <td class="dark light">Null</td>
                                </tr>
                            </tbody>
                        </table> --}}
    {{-- </div>
                </div> --}}
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $("#total").text({{ $total }});
            $("#present").text({{ $presentcount }});
            $("#absent").text({{ $absentcount }});
            $("#leave").text({{ $leavecount }});
            $("#percent").text({{ $attendence }});
        });
    </script>
@endsection
