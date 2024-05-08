@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card flex-row">
                    <div class="card-body text-light">
                        <h4 class="card-title h5 h4-sm">Insert Marks</h4>
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
            <div class="col-md-6">
                <form id='result'>@csrf
                    <div class="card flex-row dark" id="entrymarks"></div>
                </form>
            </div>
        </div>
        <div class="modal" id="information" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Info.</h5>
                        <button type="button" class="close btn button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>A - If student is absent leave blank</li>
                            <li>Enter Marks Out of 100</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('jquery')
        <script>
            var count;
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

                            $("#entrymarks").empty();

                            $('#exams').empty().append(
                                '<option selected disabled>Select Exam</option>');

                            $("#submit").show();
                        },
                        success: function(data) {
                            // console.log(data);
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
                            // console.log(data);
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
                            url: '{{ route('getentrymarks') }}',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            async: true,
                            cache: false,
                            beforeSend: function() {
                                $("#entrymarks").empty();
                                $("#studentslist").empty();
                            },
                            success: function(data) {
                                // console.log(data);
                                // console.log();
                                if (data.status == 0) {
                                    toastr.error(data.message)
                                } else {
                                    count = 0;
                                    $("#entrymarks").append(
                                        "<div class='card-body text-light'> <h4 class='card-title h5 h4-sm text-center'>" +
                                        data.exams.name + ":" + data.subject.name +
                                        "<input type='hidden' name='exam_id' value='" + data
                                        .exams.exam_id +
                                        "'><input type='hidden' name='subject_id' value='" +
                                        data.subject.subject_id +
                                        "'><input type='hidden' name='class_id' value='" +
                                        data.exams.class_id +
                                        "'><i class='btn button fa fa-info' id='info'></i></h4><div class='container table-responsive'><table class='table table-dark items-center'> <tr> <th class='dark light'>Student Name</th> <th class='dark light'>Marks</th> </tr> <tbody id='studentslist'> </tbody> <tr> <td class='dark light text-end' colspan='3'> <input type='submit' class='btn button' name='resultsubmit' id='resultsubmit' value='Submit'> </td> </tr> </table></div> </div>"
                                    );
                                    var students = data.students;
                                    students.forEach(function(data, index) {
                                        count++;
                                        $("#studentslist").append(
                                            `<tr> <td class='dark light'>${data.name}</td><td class='dark light'> <div class='form-group'><input class="marks form-control" pattern='^(A|(100|[1-9][0-9]?))$' name='marks[${data.student_id}]'> </div> </td> </tr>`
                                        );
                                    });
                                }
                                // builddynamicvalidation();
                            }
                        });
                    }
                });
                $("#result").validate({
                    errorClass: "text-danger",
                    submitHandler: function(form, event) {
                        event.preventDefault();
                        let data = new FormData(form);
                        // console.log(form);
                        $.ajax({
                            type: 'post',
                            url: '{{ route('insertresult') }}',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            async: true,
                            cache: false,
                            success: function(data) {
                                console.log(data);
                                if (data.status == 0) {
                                    toastr.error(data.message);
                                } else {
                                    toastr.success(data.message);
                                    $("#entrymarks").empty();
                                }
                            }
                        });
                    }
                });
            });

            $(document).on("click", "#info", function() {
                $("#information").modal("show");
            });

            $(document).on("click", ".close", function() {
                $("#information").modal("hide");
            });

            // $(document).on("submit","#result",function() {
            //     event.preventDefault();
            //     var valid = $("#result").valid();
            //     console.log(valid);
            // });

            // });
            //         function builddynamicvalidation()
            //         {
            //             $("#result").validate({
            //                 // rules:`eval(${rules})`,
            //                 errorClass: "text-danger",
            //                 // errorPlacement: function (error, element)
            //                 // {
            //                 //     if(element.attr("name") == "marks[]")
            //                 //     {
            //                 //         alert('NIGGA FLEX');
            //                 //     }
            //                 //     else
            //                 //     {
            //                 //         error.insertAfter(element);
            //                 //     }
            //                 // },
            //                 submitHandler: function(form, event) {
            //                     event.preventDefault();
            //                     let data = new FormData(form);
            //                     // console.log(form);
            //                     $.ajax({
            //                         type: 'post',
            //                         url: '{{ asset('insertresult') }}',
            //                         data: data,
            //                         dataType: 'JSON',
            //                         contentType: false,
            //                         processData: false,
            //                         async: true,
            //                         cache: false,
            //                         success: function(data) {
            //                             console.log(data);
            //                         }
            //                     });
            //                 }
            //             });
            //
            //             $('input[class="students"]').each(function() {
            // // alert('NIGGER');
            //                 $(this).rules('add', {
            //                     required: true,
            //                     messages: {
            //                         required: 'this is a must requried field'
            //                     }
            //                 });
            //             });
            //             $('input[class="marks form-control"]').each(function() {
            //                 // alert('CHUTTAD');
            //                 $(this).rules('add', {
            //                     required: true,
            //                     messages: {
            //                         required: 'this is a must requried field'
            //                     }
            //                 });
            //             });
            //             // var rules = "";
            //             // var requiredcode = ": {required: true}";
            //             // for(var i=0;i<count;i++){
            //             //     // rules += '{';
            //             //     rules += 'student_'+i + requiredcode;
            //             //     // rules += '},';
            //             //     rules += ', ';
            //             //     // rules += '{';
            //             //     rules += 'marks_'+i + requiredcode;
            //             //     // console.log(i);
            //             //     // rules += (count-1 == i) ? '}': '},';
            //             //     rules += (count-1 == i) ? '': ', ';
            //             // }
            //             // rules = '{'+rules+"}";
            //             // console.log(rules);
            //             // // rules = JSON.parse(rules);
            //             // // var rue = `{${JSON.parse(rules).toString()}}`;
            //             // // console.log(rue);
            //
            //
            //
            //         }
        </script>
    @endsection
