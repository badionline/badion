@extends('Teacher.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <x-card img="{{ asset('img/studymaterials.png') }}" title="Study materials" value="" url="tstudymaterials" />
            <x-card img="{{ asset('img/homework.png') }}" title="Homework" value="" url="thomework" />
            <x-card img="{{ asset('img/board.png') }}" title="Notice Board" value="" url="tnoticeboard" />
        </div>
        <div class="row">
            @isset($timetable)
                <x-card img="{{ asset('img/timetable.png') }}" title="Time-Table" value="" url="ttimetable" />
            @endisset
            @if ($studentscount > 0)
                <x-card img="{{ asset('img/students.png') }}" title="Students" value="studentscount" url="tstudent" />
            @endif
            <x-card img="{{ asset('img/attendance.png') }}" title="Attendance" value="" url="studentattendence" />
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $("#studentscount").text({{ $studentscount }})
        });
    </script>
@endsection
