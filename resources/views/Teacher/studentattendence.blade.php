@extends('Teacher.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                @if ($students)
                    @if ($students->isNotEmpty())
                        <div class="card">
                            <div class="table-responsive">
                                <form id='attendance'>
                                    @csrf
                                    <table class="table">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="dark light">Student Roll no:</th>
                                                <th class="dark light">Student Name</th>
                                                <th class="dark light">Present</th>
                                                <th class="dark light">Absent</th>
                                                <th class="dark light">Leave</th>
                                            </tr>
                                        </thead>
                                        <tbody id="stattendance">
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td class='dark light text-center'>{{ $student->rollno }}</td>
                                                    <td class='dark light text-center'>{{ $student->name }}</td>
                                                    <td class="dark light text-center">
                                                        <input type='radio' class="form-check-input text-center"
                                                            id="attendance[{{ $student->student_id }}]"
                                                            name="attendance[{{ $student->student_id }}]" value='P'>
                                                    </td>
                                                    <td class="dark light text-center">
                                                        <input type='radio' class="form-check-input"
                                                            id="attendance[{{ $student->student_id }}]"
                                                            name="attendance[{{ $student->student_id }}]" value='A'>
                                                    </td>
                                                    <td class="dark light text-center">
                                                        <input type='radio' class="form-check-input"
                                                            id="attendance[{{ $student->student_id }}]"
                                                            name="attendance[{{ $student->student_id }}]" value='L'>
                                                        <input type='radio' class="form-check-input"
                                                            id="attendance[{{ $student->student_id }}]"
                                                            name="attendance[{{ $student->student_id }}]"
                                                            style="display: none" value='' checked>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan='5' class='dark light text-end'>
                                                    <input type='submit' id="insert" class='btn button'>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="card-head d-flex justify-content-center">
                                        <img class="card-img" src="{{ asset('img/class_not_assigned.gif') }}"
                                            style="width: 18rem;height: 18rem" alt="Card image cap">
                                    </div>
                                    <div class="card-head d-flex justify-content-center dark light">Class Not Assigned or In
                                        your class Students are not added</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <div class="card-head d-flex justify-content-center">
                                    <img class="card-img" src="{{ asset('img/attendance.gif') }}"
                                        style="width: 18rem;height: 18rem" alt="Card image cap">
                                </div>
                                <div class="card-head d-flex justify-content-center dark light">Attendance Done, Visit
                                    Tomorrow</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $("#attendance").validate({
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('insertattendance') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        beforeSend: function() {
                            $(".loaderClass").css("display", "flex");
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == 0) {
                                $(".loaderClass").css("display", "none");
                                toastr.error(data.message);
                            } else {
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
