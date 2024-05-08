@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        {{-- <div class="row">
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
        </div> --}}
        <div class="row">
            <div class="col-sm text-end">
                {{-- <a href="{{ route('aaddteacher') }}">
                    <button class="btn card fa fa-plus" type="button"> Add Teacher</button>
                </a> --}}
                <a href="{{ route('apastteachers') }}">
                    <button class="btn card light fa fa-chalkboard-teacher" type="button"> Past
                        Teachers
                    </button>
                </a>
                <a href="{{ route('aexportteachers') }}">
                    <button class="btn card fa fa-file-excel" type="button"> Download Teachers</button>
                </a>
            </div>
        </div>

        <div class="col-sm container card dark light">
            <div class="table-responsive">
                <table class="table" id="teachers">
                    {{-- <tr>
                        <td class="dark light" colspan="7">
                            <form class="d-grid gap-2 d-md-flex justify-content-md-end" action="home.php">
                                <input type="search" placeholder="Search" class="searchinput" aria-label="Search">
                                <label class="btn my-2 my-sm-0 fa fa-search" type="submit"></label>
                            </form>
                        </td>
                    </tr> --}}
                    <thead>
                        <tr>
                            <th scope="col" class="dark light">User Id</th>
                            <th scope="col" class="dark light">Teacher Id</th>
                            <th scope="col" class="dark light">Full Name</th>
                            <th scope="col" class="dark light">Email</th>
                            <th scope="col" class="dark light">Contact</th>
                            <th scope="col" class="dark light">Address</th>
                            <th scope="col" class="dark light">Gender</th>
                            <th scope="col" class="dark light">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                    <td class="dark light">Null</td>
                    <td class="dark light">Null</td>
                    <td class="dark light">Null</td>
                    <td class="dark light">Null</td>
                    <td class="dark light">Null</td>
                    <td class="dark light">Null</td>
                    <td class="dark light">
                        <a href="editteacher" class="fa fa-edit"></a>
                        <a href="teacher" class="fa fa-eye"></a>
                        <a href="pastteachers" class="fa fa-user-slash light"></a>
                    </td>
                </tr> --}}
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Teacher -->
    <div class="modal fade" id="deleteteacher" tabindex="-1" role="dialog" aria-labelledby="deleteteacherLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteteacherLabel">Delete Teacher</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_err"> Are You Sure You want to remove <span id="deleteteachername"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="teacherdelete">
                        @csrf
                        <input type="hidden" id="deleteteacherid" name="deleteteacherid">
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
            $('#teachers').DataTable({
                ajax: {
                    url: '{{ route('agetteachers') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'user_id'
                    },
                    {
                        data: 'teacher_id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
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
                                "<a href='editteacher/" + data +
                                "'><i class='options fa fa-edit editteacherclick text-success' data-toggle='modal' data-bs-target='#editteacher'></i></a><a href='teacher/" +
                                data +
                                "'><i class='options fa fa-eye viewteacherclick dark' data-toggle='modal' data-target='#viewteacher'></i></a><i class='options fa fa-trash deleteteacherclick text-danger' " +
                                "data-toggle='modal' id=" + data +
                                " data-target='#deleteteacher'></i></div></td></tr>";
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
                    lengthMenu: " _MENU_ Teachers per Page",
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
            $('.dt-input').css({
                "background-color": "transparent",
                "padding-left": "10px",
                "border-color": "#DA8228",
                "border-radius": "10px",
                "border-style": "solid"
            });

            $(document).on('click', '.deleteteacherclick', function() {
                $("#deleteteacher").modal('show');
                event.preventDefault();
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('agetdeleteteacher') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'user_id': id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        $("#deleteteachername").text(data.name);
                        $("#deleteteacherid").val(data.teacher_id);
                    }
                });
            });

            $("#teacherdelete").validate({
                rules: {
                    deleteteacherid: {
                        required: true,
                    },
                },
                errorClass: "text-danger",

                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "{{ route('adeleteteacher') }}",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            toastr.success(data.message);
                            $('#teachers').DataTable().ajax.reload();
                            $("#deleteteacher .deleteclose").click();
                        }
                    });
                }
            });


            $(document).on('click', ".deleteclose", function() {
                $("#deleteteacher").modal('hide');
            });
        });
    </script>
@endsection
