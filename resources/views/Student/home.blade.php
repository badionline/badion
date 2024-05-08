@extends('Student.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <x-card img="{{ asset('img/studymaterials.png') }}" title="Study materials" value="" url="sstudymaterials" />
            <x-card img="{{ asset('img/teacher.png') }}" title="Teachers" value="" url="stteachers" />
            <x-card img="{{ asset('img/attendance.png') }}" title="Attendance" value="attendence" url="attendance" />
        </div>
        <div class="row">
            <x-card img="{{ asset('img/cost.png') }}" title="Fees" value="" url="fees" />
            <x-card img="{{ asset('img/results.png') }}" title="Result" value="" url="result" />
            @isset($timetable)
                <x-card img="{{ asset('img/timetable.png') }}" title="Time-Table" value="" url="sttimetable" />
            @endisset
        </div>
        <div class="row">
            <x-card img="{{ asset('img/board.png') }}" title="Notice Board" value="" url="stnoticeboard" />
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $("#attendence").text({{ $attendence }} + "%");
        });
    </script>
@endsection
