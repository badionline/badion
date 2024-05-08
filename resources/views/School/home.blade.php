@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <x-card img="{{ asset('img/attendance.png') }}" title="Attendance" value="" url="aattendance" />
            <x-card img="{{ asset('img/students.png') }}" title="Students" value="studentscount" url="sstudents" />
            <x-card img="{{ asset('img/teacher.png') }}" title="Teachers" value="teacherscount" url="steachers" />
        </div>
        <div class="row">
            <x-card img="{{ asset('img/money.png') }}" title="Manage Fees" value="" url="managefees" />
            <x-card img="{{ asset('img/cost.png') }}" title="Fees Status" value="" url="feepayments" />
            <x-card img="{{ asset('img/board.png') }}" title="Notice Board" value="" url="notice" />
        </div>
    </div>
@endsection

@section('jquery')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('homedetails') }}',
                // data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function(data) {
                    // console.log(data);
                    $("#studentscount").text(data.student.length);
                    $("#teacherscount").text(data.teacher.length);
                }
            });
        });
    </script>
@endsection
