@extends('School.layouts.main')
@section('badion')
    {{-- <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card flex-row dark">
                    <img class="card-img-top example-card-img-responsive" src="{{ asset('img/badion-dark.png') }}"
                        style="height: 100px;width: 100px;" />
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Males</h4>
                        <p class="card-text">Count</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card flex-row dark">
                    <img class="card-img-top example-card-img-responsive" src="{{ asset('img/badion-dark.png') }}"
                        style="height: 100px;width: 100px;" />
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Females</h4>
                        <p class="card-text">Count</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-sm text-end">
                <a href="{{ route('saddstudent') }}">
                    <button class="btn card light fa fa-plus" type="button"> Add Student</button>
                </a>
                <a href="{{ route('paststudents') }}">
                    <button class="btn card light fa fa-user-graduate" type="button"> Past Students</button>
                </a>
                 <a href="{{route('exportstudents')}}">
                    <button class="btn card light fa fa-file-excel" type="button"> Download Students File</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm container card dark light">
        <div class="table-responsive">
            <table id="students" class="table dark light">
                <thead>
                    <tr>
                        <th scope="col" id="name" class="dark light">Full Name</th>
                        <th scope="col" id="email" class="dark light">Email</th>
                        <th scope="col" id="pname" class="dark light">Parent Name</th>
                        <th scope="col" id="pphone" class="dark light">Parent Phone</th>
                        <th scope="col" id="rollno" class="dark light">Roll</th>
                        <th scope="col" id="address" class="dark light">Address</th>
                        <th scope="col" id="gender" class="dark light">Gender</th>
                        <th scope="col" id="options" class="dark light">Options</th>
                    </tr>
                </thead>
                <tbody>
            </table>
        </div>
    </div>
    </div>

    <!-- Delete Student -->
    <div class="modal fade" id="deletestudent" tabindex="-1" role="dialog" aria-labelledby="deletestudentLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletestudentLabel">Delete Student</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_err"> Are You Sure You have given LC and TC to <span id="deletestudentname"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="studentdelete">
                        @csrf
                        <input type="hidden" id="deletestudentid" name="deletestudentid">
                        <button type="button" class="btn btn-secondary deleteclose" data-dismiss="modal">Cancel</button>
                        <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#students').DataTable({
                ajax: {
                    url: 'getstudents',
                    dataSrc: '',
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'pname'
                    },
                    {
                        data: 'pphone'
                    },
                    {
                        data: 'rollno'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'gender',
                        render: function(data, type, row, meta) {
                            var gender;
                            if (data == 'F') {
                                gender = 'Female';
                            } else {
                                gender = 'Male';
                            }
                            return gender;
                        },
                    },
                    {
                        data: 'user_id',
                        render: function(data, type, row, meta) {
                            return "<div class='d-flex justify-content-between'>" +
                                "<a href='editstudent/" + data +
                                "'><i class='options fa fa-edit editstudentclick text-success' data-toggle='modal' data-bs-target='#editstudent'></i></a><a href='student/" +
                                data +
                                "'><i class='options fa fa-eye viewstudentclick dark' data-toggle='modal' data-target='#viewstudent'></i></a><i class='options fa fa-trash deletestudentclick text-danger' " +
                                "data-toggle='modal' id=" + data +
                                " data-target='#deletestudent'></i></div></td></tr>";
                        },
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7],
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
                    lengthMenu: " _MENU_ Students per Page",
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
            // $('.dt-input').css({
            //     "background-color": "transparent",
            //     "padding-left": "10px",
            //     "border-color": "#DA8228",
            //     "border-radius": "10px",
            //     "border-style": "solid"
            // });

            $(document).on('click', '.deletestudentclick', function() {
                $("#deletestudent").modal('show');
                event.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('getdeletestudent') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'user_id': id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        $("#deletestudentname").text(data.name);
                        $("#deletestudentid").val(data.student_id);
                    }
                });
            });

            $("#studentdelete").validate({
                rules: {
                    deletestudentid: {
                        required: true,
                    },
                },
                errorClass: "text-danger",

                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "{{ route('deletestudent') }}",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 1) {
                                toastr.success(data.message);
                                $('#students').DataTable().ajax.reload();
                                $("#deletestudent .deleteclose").click();
                            } else {
                                toastr.error(data.message);
                            }
                        }
                    });
                }
            });


            $(document).on('click', ".deleteclose", function() {
                $("#deletestudent").modal('hide');
            });
        });
    </script>
@endsection
