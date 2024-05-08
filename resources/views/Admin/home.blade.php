@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <x-card img="{{ asset('img/new.png') }}" title="New Registrations" value="newschoolscount" url="registrations" />
        </div>
        <div class="row">
            <x-card img="{{ asset('img/school.png') }}" title="Registered Schools" value="schoolscount" url="schools" />
            <x-card img="{{ asset('img/cost.png') }}" title="Payments" value="payments" url="payments" />
        </div>

        <div class="row">
            <x-card img="{{ asset('img/teacher.png') }}" title="Teachers" value="teachersscount" url="ateachers" />
            <x-card img="{{ asset('img/students.png') }}" title="Students" value="studentscount" url="astudents" />
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('adminhome') }}',
                // data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function(data) {
                    $("#schoolscount").text(data.schoolscount);
                    $("#newschoolscount").text(data.newcount);
                    $("#teachersscount").text(data.teacherscount);
                    $("#studentscount").text(data.studentscount);
                    // console.log(data.schoolscount);
                }
            });
        });
    </script>
@endsection
