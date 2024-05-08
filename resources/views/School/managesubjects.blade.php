@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card flex-row">
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Add Subject</h4>
                        <form id="addsubject">
                            @csrf
                            <input type="hidden" name="schoolid" id="schoolid">
                            <div class="form-group">
                                <label for="class">Class</label>
                                <div class="standard">
                                </div>
                                {{-- <select class="form-select" style="background: #e0e0e0;color: #353535;border: none;box-shadow: 1px 1px 2px #DA8228, -1px -1px 2px #DA8228;" name="standard[]" id="standard" multiple autocomplete="off" data-placeholder="Select Class" >
                                </select> --}}
                                <span class="text-danger">
                                    @error('standard')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="class">Subject Name</label>
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject Name">
                            </div>
                            <button type="submit" class="btn button">Add Subject</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card flex-row">
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Assign Teacher</h4>
                        <form id="assignteacher">
                            @csrf
                            <div class="form-group">
                                <label for="class">Class</label>
                                <select class="form-select" name="standard" id="standard1">
                                </select>
                                <span class="text-danger">
                                    @error('standard1')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group" id="assignteachersubjects">
                                {{-- <label for="class">Subject</label>
                                <select class="form-select" id="subjects">
                                </select> --}}
                            </div>
                            <div class="form-group" id="assignteacherid">
                                {{-- <label for="class">Teacher</label>
                                <select class="form-select" id="teacher">
                                </select> --}}
                            </div>
                            <button type="submit" style="display: none" id="assignteachersubmit" class="btn button">Assign
                                Teacher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="card flex-row dark">
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">List of Subjects</h4>
                        <div class="container table-responsive">
                            <table id="subjectslist" class="table table-dark">
                                <thead>
                                    <tr>
                                        <th class="dark">Class</th>
                                        <th class="dark">Div</th>
                                        <th class="dark">Subject</th>
                                        <th class="dark">Teacher</th>
                                    </tr>
                                </thead>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('getstandard') }}',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('.standard').empty().append(
                        "<input class='form-check-input' name='standard[]' id='all' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='defaultCheck2'>Select All</label><br>"
                    );
                    $('#standard1').empty().append('<option selected disabled>Select Class</option>');
                },
                success: function(data) {
                    $("#schoolid").val(data.school);
                    $("#schoolid1").val(data.school);

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
                        $("#standard1").append("<option id='" + optionID + "' value='" +
                            optionID + "'>" + optionValue + "</option>");
                    });
                    var uniqueStandards = {};
                    $.each(shandard, function(index, standard) {
                        if (!uniqueStandards[standard.name]) {
                            uniqueStandards[standard.name] = true;
                            $('.standard').append(
                                "<input class='form-check-input classes' name='standard[]' id='" +
                                standard.name + "' value='" + standard.name +
                                "' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='" +
                                standard.name + "'>" + standard.name + "</label><br>");
                        }
                    });

                    // var tomSelect = new TomSelect("#standard", {
                    //     allowEmptyOption: true,
                    //     create: true
                    // });
                }
            });
            $(document).on("click", "#all", function() {
                $('.classes').prop('checked', true);
            });

            $(document).on("click", ".classes", function() {
                $('#all').prop('checked', false);
            });

            $("#addsubject").validate({
                rules: {
                    schoolid: {
                        required: true
                    },
                    standard: {
                        required: true
                    },
                    subject: {
                        required: true
                    }
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: 'addsubject',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            $.each(data.errors, function(index, value) {
                                toastr.error(value);
                            });
                            $.each(data.success, function(index, value) {
                                toastr.success(value);
                            });
                        }
                    });
                }
            });



            $(document).on("change", "#standard1", function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('getsubject') }}',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "id": id
                    },
                    dataType: 'JSON',
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    beforeSend: function() {
                        $('#subjects').empty().append(
                            '<option selected disabled>Select Subject</option>');
                        $('#assignteachersubjects').empty().append(
                            "<label for='class'>Subject</label><select class='form-select' name='subjects' id='subjects'><option value='' selected disabled>Select Subject</option></select>"
                        );
                        $('#assignteacherid').empty().append(
                            "<label for='class'>Teacher</label><select class='form-select' id='teacher' name='teacher'><option value='' selected disabled>Select Teacher</option></select>"
                        );
                    },
                    success: function(data) {
                        var subjects = data.subjects;
                        if (data.status == 1) {
                            subjects.forEach(function(data, index) {
                                $('#subjects').append("<option id='" + data.subject_id +
                                    "' value='" + data.subject_id + "'>" + data
                                    .name +
                                    "</option>");
                            });
                        } else {
                            $("#assignteachersubmit").hide();
                            $('#assignteachersubjects').empty();
                            $('#assignteacherid').empty();
                            toastr.error(
                                "This class subjects, teachers are already assigned!"
                            );
                        }
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
                    success: function(data) {
                        data.forEach(function(data, index) {
                            $("#teacher").append("<option id='" + data.teacher_id +
                                "' value='" + data.teacher_id + "'>" + data.name +
                                "</option>");
                        });
                    }
                });
                $("#assignteachersubmit").show();
            });



            $("#assignteacher").validate({
                rules: {
                    standard: {
                        required: true,
                    },
                    subjects: {
                        required: true,
                    },
                    teacher: {
                        required: true,
                    }
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "assignteacher",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            $('#subjectslist').DataTable().ajax.reload();
                            if (data.status == 1) {
                                toastr.success(data.message);
                                $("#assignteachersubmit").hide();
                                $('#assignteachersubjects').empty();
                                $('#assignteacherid').empty();
                            } else {
                                toastr.error(data.message);
                            }
                        }
                    });
                }
            });







            $('#subjectslist').DataTable({
                ajax: {
                    url: 'subjectslist',
                    dataSrc: '',
                },
                columns: [{
                        data: 'classname'
                    },
                    {
                        data: 'section'
                    },
                    {
                        data: 'subject'
                    },
                    {
                        data: 'teacher'
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3],
                    className: 'dark light text-nowrap'
                }],
                // dom: 'lfBrtip',
                language: {
                    searchPlaceholder: 'Search',
                    search: '',
                    info: "_START_ to _END_ of _TOTAL_",
                    sEmptyTable: "<div class='dark light' style='height: 200px;margin:0px !important;width:100%'><img height='200px' src='{{ asset('img/no-data-found.gif') }}'></div>",
                    infoEmpty: "0 to 0 of 0", // Customize this based on your requirement
                    // infoFiltered: "(filtered from _MAX_ total entries)",
                    lengthMenu: " _MENU_ Subjects per Page",
                    // paginate: {
                    //     first: "<button class='btn button dark light'><<</button>",
                    //     last: "<button class='btn button dark light'>>></button>",
                    //     next: "<button class='btn button dark light'>></button>",
                    //     previous: "<button class='btn button dark light'><</button>",
                    // }
                    // buttons: [{
                    //     extend: 'spacer',
                    // }, {
                    //     extend: 'collection',
                    //     text: 'Export',
                    //     buttons: ['copy', 'excel', 'csv']
                    // buttons: [
                    // {
                    //     extend: 'copy',
                    //     text: 'Copy',
                    //     messageTop: null,
                    //     messageBottom: null,
                    //     title: null,
                    //     customize: function(copy) {
                    //         var lines = copy.trim().split('\n');
                    //         var firstLine = lines[0];
                    //         var characters = firstLine.trim().split('\t');
                    //
                    //         characters = characters.map(function(value) {
                    //             var trimmedValue = value.trim();
                    //             // console.log(trimmedValue);
                    //             var index = trimmedValue.indexOf('  ');
                    //             if (index !== -1) {
                    //                 // console.log("trimmed value->", trimmedValue);
                    //                 var splitValues = trimmedValue.split("  ");
                    //                 return splitValues[0];
                    //             }
                    //             return value;
                    //         });
                    //
                    //         lines[0] = characters.join('\t');
                    //         // console.log("final copy:");
                    //         // console.log(lines.join('\n'));
                    //         return lines.join('\n');
                    //     }
                    // },
                    // {
                    //     extend: 'excel',
                    //     text: 'Xlsx',
                    //     filename: 'Export_' + deName,
                    //     title: null,
                    //     messageTop: null,
                    //     messageBottom: null,
                    //     customize: function(xlsx) {
                    //         var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    //         var cElements = sheet.getElementsByTagName('c');
                    //         for (var i = 0; i < cElements.length; i++) {
                    //             var cElement = cElements[i];
                    //             var rAttribute = cElement.getAttribute('r');
                    //             let pattern = rAttribute.match(/^[A-Z]+1$/g);
                    //             if (pattern) {
                    //                 pattern.forEach(match => {
                    //                     if(rAttribute)
                    //                     {
                    //                         var tElement = cElement.getElementsByTagName('t')[0];
                    //                         if (tElement) {
                    //                             var celltext = tElement.textContent;
                    //                             celltext = celltext.trim();
                    //                             var index = celltext.indexOf('  ');
                    //                             if (index !== -1) {
                    //                                 // console.log(cellText.split("  ")[0]+'"');
                    //                                 celltext = celltext.split("  ")[0];
                    //                                 tElement.textContent = celltext;
                    //                             }
                    //                         }
                    //                     }
                    //                 });
                    //             }
                    //
                    //         }
                    //     }
                    //
                    // },
                    // {
                    //     extend: 'csv',
                    //     text: 'Csv',
                    //
                    // }
                    // ]
                    // }],
                },
                initComplete: function(settings, json) {
                    $('.dt-input').css({
                        "background-color": "transparent",
                        "padding-left": "10px",
                        "border-color": "#DA8228",
                        "border-radius": "10px",
                        "border-style": "solid"
                    });
                    // $('.dt-empty').css({
                    //     "padding":"0",
                    // });
                },
                drawCallback: function(settings, json) {
                    $('.dt-empty').css({
                        "padding": "0",
                    });
                }
            });
        });
    </script>
@endsection
