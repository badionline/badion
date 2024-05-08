@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link light active" id="disabled-tab-0" data-bs-toggle="tab" href="#disabled-tabpanel-0"
                            role="tab" aria-controls="disabled-tabpanel-0" aria-selected="true">Student</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link light" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"
                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">Teacher</a>
                    </li>
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane active" id="disabled-tabpanel-0" role="tabpanel" aria-labelledby="disabled-tab-0">
                        <div class="card container">
                            <form id="studenttimetable">
                                @csrf
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <select class="form-control" id="standard" name="standard">
                                                <option value="" selected disabled>Select Class</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="file" accept="application/pdf" id="file" name="file"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="submit" class="btn button" value="Upload">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- <div class="table-responsive container">
                                <table class="table">
                                    <form id="studenttimetable">
                                        @csrf
                                        <tr>
                                            <th class="container dark light">
                                                <select class="form-control" id="standard" name="standard">
                                                    <option value="" selected disabled>Select Class</option>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="container dark light">
                                                <input type="file" accept="application/pdf" id="file" name="file"
                                                    class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="container dark light">
                                                <input type="submit" class="btn button" value="Upload">
                                            </td>
                                        </tr>
                                    </form>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-1" role="tabpanel" aria-labelledby="disabled-tab-1">
                        <div class="card container">
                            <form id="teachertimetable">
                                @csrf
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <select class="form-control" id="teachers" name="teachers">
                                                <option value="" selected disabled>Select Teacher</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="file" accept="application/pdf" id="file" name="file"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <input type="submit" class="btn button" value="Upload">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- <div class="table-responsive container">
                                <table class="table">
                                    <tr>
                                        <th class="container dark light">
                                            <select class="form-control" id="teachers">
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">
                                            <input type="file" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="container dark light">
                                            <input type="submit" class="btn button" value="Upload">
                                        </td>
                                    </tr>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <form action="timetable" method="get">
                        <table class="table">
                            <tr>
                                <td class="dark light">Days:<br>
                                    <input type="number" name="days" class="form-control">
                                </td>
                                <td class="dark light">Lectures:<br>
                                    <input type="number" name="lectures" class="form-control">
                                </td>
                                <td class="dark light"><br>
                                    <input type="submit" class="btn button" name="submit" />
                                </td>
                            </tr>
                        </table>
                    </form>
                        @if (isset($_GET['submit']))
                            @php
                                $days = $_GET['days'];
                                $lectures = $_GET['lectures'];
                            @endphp
                            <table class="table">
                            @for ($i = 1; $i <= $days; $i++)
                                <tr class="dark light">
                                    @for ($j = 1; $j <= $lectures; $j++)
                                        <td class="dark light"><input type="text" class="form-control"></td>
                                    @endfor
                                </tr>
                            @endfor
                            </table>
                        @endif --}}
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: 'getstandard',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#standard').empty().append('<option selected disabled>Select Class</option>');
                },
                success: function(data) {
                    var shandard = data.standard;

                    var standardValues = {
                        "Playgroup": 0,
                        "Nursery": 1,
                        "LKG": 2,
                        "UKG": 3,
                        "1st": 4,
                        "2nd": 5,
                        "3rd": 6,
                        "4th": 7,
                        "5th": 8,
                        "6th": 9,
                        "7th": 10,
                        "8th": 11,
                        "9th": 12,
                        "10th": 13,
                        "11th": 14,
                        "12th": 15,
                    };

                    shandard.sort(function(a, b) {
                        if (standardValues[a.name] !== standardValues[b.name]) {
                            return standardValues[a.name] - standardValues[b.name];
                        } else {
                            return a.div.localeCompare(b.div);
                        }
                    });

                    var sortedshandard = [];
                    $.each(shandard, function(index, standard) {
                        sortedshandard.push(standard.name + ' - ' + standard.div);
                    });

                    $.each(shandard, function(index, standard) {
                        var optionID = standard.class_id;
                        var optionValue = standard.name + ' - ' + standard.div;
                        $("#standard").append("<option id='" + optionID + "' value='" +
                            optionID + "'>" + optionValue + "</option>");
                    });
                }
            });

            $.ajax({
                type: 'GET',
                url: 'getteachers',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#teachers').empty().append('<option selected disabled>Select Teacher</option>');
                },
                success: function(data) {
                    data.forEach(function(data, index) {
                        $('#teachers').append("<option id='" + data.teacher_id + "' value='" +
                            data.teacher_id + "'>" + data.name + "</option>");
                    });
                }
            });


            $("#studenttimetable").validate({
                rules: {
                    standard: {
                        required: true,
                    },
                    file: {
                        required: true,
                    },
                },
                errorClass: "text-danger",

                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "addtimetable",
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

            $("#teachertimetable").validate({
                rules: {
                    teachers: {
                        required: true,
                    },
                    file: {
                        required: true,
                    },
                },
                errorClass: "text-danger",

                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "addteachertimetable",
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
        });
    </script>
@endsection
