@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card flex-row">
                    <div class="card-body light dark">
                        <h4 class="card-title h5 h4-sm">Manage Exam</h4>
                        <form id="addexam">
                            @csrf
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="class">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Exam Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="class">Select Class</label>
                                        <div class="standard"></div>
                                        {{-- <select class="form-control" id="standard" name="standard">
                                </select> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="timetable">Time-Table</label>
                                        <input type="file" name="file" id="file" class="form-control"
                                            accept="application/pdf">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <input type="submit" class="btn button" value="Add">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card flex-row">
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Exam List</h4>
                        <p class="card-text">
                        <div class="container table-responsive">
                            <table class="table table-dark" id="examslist">
                                <thead>
                                    <tr>
                                        <td class="dark">Name</td>
                                        <td class="dark">Class</td>
                                        <td class="dark">Div</td>
                                        <td class="dark">Time-Table</td>
                                        <td class="dark">Options</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                    <td class="dark">Exam Name</td>
                                    <td class="dark">null</td>
                                    <td class="dark">tt.pdf</td>
                                    <td class="dark">
                                        <button class="btn button fa fa-edit"></button>
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

        <!-- Edit Exam -->
        <div class="modal fade" id="editexams" tabindex="-1" role="dialog" aria-labelledby="editexams" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletecategoryLabel">Edit Exam</h5>
                        <button type="button" class="btn button close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editexam">
                        @csrf
                        <input type="hidden" name="editexamid" id="editexamid" readonly>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" name="editexamname" id="editexamname"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Class:</label>
                                        <input type="text" class="form-control" name="editexamclass" id="editexamclass"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Div:</label>
                                        <input type="text" class="form-control" name="editexamdiv" id="editexamdiv"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Timetable:</label>
                                        <input type="file" accept="application/pdf" class="form-control" name="file"
                                            id="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="update" value="Update" class="btn button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('jquery')
        <script>
            $(document).ready(function() {
                id = $(this).attr("id");
                qty = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: 'getstandard',
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    async: true,
                    cache: false,
                    beforeSend: function() {
                        $('.standard').empty().append(
                            "<input class='form-check-input' name='standard[]' id='all' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='defaultCheck2'>Select All</label><br>"
                        );
                    },
                    success: function(data) {
                        $("#schoolid").val(data.school);
                        // $("#schoolid1").val(data.school);

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

                        // var sortedshandard = [];
                        // $.each(shandard, function (index, standard) {
                        //     sortedshandard.push(standard.name + ' - ' + standard.div);
                        // });

                        // $.each(shandard, function (index, standard) {
                        //     var optionID = standard.class_id;
                        //     var optionValue = standard.name + ' - ' + standard.div;
                        //     $("#standard1").append("<option id='" + optionID + "' value='" + optionID + "'>" + optionValue + "</option>");
                        // });
                        var uniqueStandards = {};
                        $.each(shandard, function(index, standard) {
                            if (!uniqueStandards[standard.name]) {
                                uniqueStandards[standard.name] = true;
                                $('.standard').append(
                                    "<input class='form-check-input classes' name='standard[]' id='standard' value='" +
                                    standard.name +
                                    "' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='" +
                                    standard.name + "'>" + standard.name + "</label><br>");
                            }
                        });
                    }
                });
                $(document).on("click", "#all", function() {
                    $('.classes').prop('checked', true);
                });

                $(document).on("click", ".classes", function() {
                    $('#all').prop('checked', false);
                });

                $("#addexam").validate({
                    rules: {
                        name: {
                            required: true
                        },
                        standard: {
                            required: true
                        },
                        file: {
                            required: true
                        }
                    },
                    errorClass: "text-danger",
                    submitHandler: function(form, event) {
                        event.preventDefault();
                        let data = new FormData(form);
                        $.ajax({
                            type: 'post',
                            url: '{{ route('addexam') }}',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            async: true,
                            cache: false,
                            success: function(data) {
                                $(data.warning).each(function(index, value) {
                                    toastr.info(value);
                                });
                                $(data.success).each(function(index, value) {
                                    toastr.success(value);
                                });
                                $('#examslist').DataTable().ajax.reload();
                            }
                        });
                    }
                });


                $('#examslist').DataTable({
                    ajax: {
                        url: 'getexams',
                        dataSrc: '',
                    },
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: 'standard',
                        },
                        {
                            data: 'div',
                        },
                        {
                            data: 'timetable',
                            render: function(data, type, row, meta) {
                                return "<a href='{{ env('APP_URL_DOMAIN') }}/" + data +
                                    "' download><label class='btn button fa fa-download'></label></a><a href='{{ env('APP_URL_DOMAIN') }}/" +
                                    data +
                                    "' target='_blank'><label class='btn button fa fa-eye'></label></a>";
                            },
                        },
                        {
                            data: 'exam_id',
                            render: function(data, type, row, meta) {
                                return "<i id='" + data +
                                    "' class='btn button fa fa-edit editexamclick' data-toggle='modal' data-target='#editexams'></i>";
                            },
                        },
                    ],
                    order: false,
                    sort: false,
                    // borders:false,
                    columnDefs: [{
                        targets: [0, 1, 2, 3, 4],
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
                        lengthMenu: " _MENU_ Exams per Page",
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

                $(document).on('click', '.editexamclick', function() {
                    $('#editexams').modal('show');
                    event.preventDefault();
                    var id = $(this).prop('id');
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('editexam') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            data: id
                        },
                        dataType: 'JSON',
                        // contentType: false,
                        // processData: false,
                        // async: true,
                        // cache: false,
                        // beforeSend: function () {
                        //     $('#editparentcategories').empty();
                        // },
                        success: function(data) {
                            console.log(data);
                            $("#editexamid").val(data.exam_id);
                            $("#editexamname").val(data.name);
                            $("#editexamclass").val(data.standard);
                            $("#editexamdiv").val(data.div);
                            // let category = data.category.flag;
                            // let allcategories = data.allCategory;
                            // allcategories.forEach(function(value, index) {
                            //     var id = value.id;
                            //     var name = value.name;
                            //     if (id == category) {
                            //         selected = "selected";
                            //     } else {
                            //         selected = "";
                            //     }
                            //     $("#editparentcategories").append("<option id=" + name +
                            //         " value=" + id + " " + selected + ">" + name +
                            //         "</option>");
                            // });
                            // $("#editcategoryid").val(data.category.id);
                            // $("#editcategoryname").val(data.category.name);
                        }
                    });
                });

                $(document).on("click", ".close", function() {
                    $('#editexams').modal('hide');
                });


                $("#editexam").validate({
                    rules: {
                        editexamid: {
                            required: true
                        },
                        editexamname: {
                            required: true
                        },
                        editexamclass: {
                            required: true
                        },
                        editexamdiv: {
                            required: true
                        },
                        file: {
                            required: true
                        }
                    },
                    errorClass: "text-danger",
                    submitHandler: function(form, event) {
                        event.preventDefault();
                        let data = new FormData(form);
                        $.ajax({
                            type: 'post',
                            url: 'updateexam',
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            async: true,
                            cache: false,
                            success: function(data) {
                                if (data.status == 1) {
                                    toastr.success(data.message);
                                    $('#editexams').modal('hide');
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
