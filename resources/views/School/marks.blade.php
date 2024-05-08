@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm text-srart">
                <a href="{{ route('exportresults') }}">
                    <button class="btn card light fa fa-file-excel" type="button"> Download Results</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm container">
        <div class="row">
            <div class="col-sm">
                <div class="card flex-row dark">
                    <div class="card-body text-light">
                        <h4 class="card-title h5 h4-sm">Seach Results</h4>
                        <p class="card-text">
                        <form id="classdetails">
                            @csrf
                            <div class="form-group">
                                <label for="class">Select Class</label>
                                <select class="form-select" name="standard" id="standard">
                                </select>
                            </div>
                            <div class="form-group" id="selectexam"></div>
                            <div class="form-group" id="selectsubject"></div>
                            <button type="submit" id="submit" style="display: none" class="btn button">Submit</button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div id="marksheet" style="display: none" class="card flex-row dark">
                    <div class="card-body text-light">
                        <h4 class="card-title h5 h4-sm">Marksheet</h4>
                        <p class="card-text">
                        <div class="container table-responsive">
                            <table class="table table-dark" width="100%">
                                <thead>
                                    <tr>
                                        <th class="dark light">Student Name</th>
                                        <th class="dark light">Marks</th>
                                        <th class="dark light">Options</th>
                                    </tr>
                                </thead>
                                <tbody id="results">
                                </tbody>
                                {{-- <tr>
                                    <td class="dark light">null</td>
                                    <td class="dark light">null
                                        <form>
                                            <div id="edit" class="collapse form-group">
                                                <input type="number" class="form-control" placeholder="Enter Marks">
                                                <button class="btn button fa fa-check" type="submit"></button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="dark light">
                                        <button class="btn button fa fa-edit" data-bs-toggle="collapse"
                                            data-bs-target="#edit"></button>
                                        <button class="btn button fa fa-trash"></button>
                                    </td>
                                </tr> --}}
                            </table>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Edit Results -->
    <div class="modal fade" id="editresult" tabindex="-1" role="dialog" aria-labelledby="editresultLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editresultLabel">Edit Marks - <span id="editstudentname"></span></h5>
                </div>
                <form id="editresults">
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="editstudentname" id="editstudentname" readonly>
                        </div> --}}
                        <div class="form-group">
                            <label for="name">Marks:</label>
                            <input type="text" pattern="^(A|(100|[1-9][0-9]?))$" class="form-control" name="marks"
                                id="marks">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="editresultid" name="editresultid">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
                        <input type="submit" name="update" value="Update" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <!-- Edit Results -->
    <div class="modal" id="editresult" tabindex="-1" role="dialog" aria-labelledby="editresultLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editresultLabel">Edit Marks</h5>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" disabled class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="modal-footer">
                <form id="editresults">
                    @csrf
                    <input type="hidden" id="editresultid" name="editresultid">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('getexamclass') }}",
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#standard').empty().append('<option selected disabled>Select Class</option>');
                },
                success: function(data) {
                    // console.log(data);
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

            $(document).on("change", "#standard", function() {
                var id = $("#standard").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('getexam') }}',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "id": id,
                    },
                    dataType: 'JSON',
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    beforeSend: function() {
                        $("#selectexam").empty().append(
                            "<label for='exam'>Select Exam</label><select class='form-select' name='exams' id='exams'><option selected disabled>Select Exam</option></select>"
                        );

                        $("#selectsubject").empty().append(
                            "<label for='subject'>Select Subject</label><select class='form-select' name='subjects' id='subjects'><option selected disabled>Select Subject</option></select>"
                        );

                        $("#results").empty();

                        $('#exams').empty().append(
                            '<option selected disabled>Select Exam</option>');

                        $("#submit").show();
                    },
                    success: function(data) {
                        data.forEach(function(data, index) {
                            $('#exams').append('<option value="' + data.exam_id +
                                '" id="' + data.exam_id + '">' + data.name +
                                '</option>');
                        });
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('getsub') }}',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "id": id,
                    },
                    dataType: 'JSON',
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    success: function(data) {
                        data.forEach(function(data, index) {
                            $('#subjects').append('<option value="' + data.subject_id +
                                '" id="' + data.subject_id + '">' + data.name +
                                '</option>');
                        });
                    }
                });
            });

            $("#classdetails").validate({
                rules: {
                    standard: {
                        required: true
                    },
                    exams: {
                        required: true
                    },
                    subjects: {
                        required: true
                    }
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('getresults') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        beforeSend: function() {
                            $("#results").empty();
                            $("#marksheet").show();
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == 0) {
                                toastr.error(data.message)
                            } else {
                                data.forEach(function(data, index) {
                                    $("#results").append(
                                        "<tr> <td class='dark light'>" + data
                                        .student_name +
                                        "</td> <td class='dark light'>" + data
                                        .marks +
                                        "</td><td class='dark light'><button class='btn button fa fa-edit editresultclick' " +
                                        "data-toggle='modal' id=" + data
                                        .result_id +
                                        " data-target='#editresult'></button></td> </tr>"
                                    );
                                });
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.editresultclick', function() {
                $("#editresult").modal('show');
                event.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('geteditresult') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        // console.log(data.name);
                        $("#editstudentname").text(data.name);
                        $("#marks").val(data.marks)
                        $("#editresultid").val(id);
                    }
                });
            });
            $(".close").on("click", function() {
                $("#editresult").modal("hide");
            });
            $("#editresults").validate({
                rules: {
                    // editstudentname: {
                    //     required: true
                    // },
                    marks: {
                        required: true
                    },
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('updateresult') }}',
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
                                $("#submit").click();
                                $("#editresult").modal("hide");
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
