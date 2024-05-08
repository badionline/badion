@extends('School.layouts.main')
@section('badion')
    <div class="container card">
        <div class="row">
            <div class="col-sm">
                <form id="notice" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                {{--                                <textarea name="notice" class="form-control dark light" cols="30" rows="10" --}}
                                {{--                                          placeholder="Start Typing Notice From Here..."></textarea> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <textarea name="notice" class="form-control dark light" cols="30" rows="10"
                                    placeholder="Start Typing Notice From Here..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <x-fileinput label="Notice File" name="file" labelid="document" accept="application/pdf" />
                            {{--                            <input type="file" name="file" id="file"> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group light">
                                <input class="form-check-input" type="checkbox" value="1" name="to[]">
                                To Students<br>
                                <input class="form-check-input" type="checkbox" value="2" name="to[]">
                                To Teachers<br>
                            </div>
                        </div>
                        <label id="to-error" class="text-danger" for="to"></label>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <input type="submit" class="btn button" value="Send">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5 card">
        {{--        <div class="row"> --}}
        {{--            <div class="col-sm d-flex justify-content-between" style="margin:10px 20px "> --}}
        {{--                <label class="fa fa-history"> History</label> --}}
        {{--                <div class="form-group"> --}}
        {{--                    <select class="form-select-sm filter"> --}}
        {{--                        <option value="all" selected>All</option> --}}
        {{--                        <option value="teacher">Teacher</option> --}}
        {{--                        <option value="student">Student</option> --}}
        {{--                    </select> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--        </div> --}}
        <div class="row">
            <div class="col-sm">
                <div class="table-responsive container">
                    <table id="notices" class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Attachment</th>
                                <th>To</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            // event.preventDefault();
            $("#notice").validate({
                rules: {
                    title: {
                        required: true
                    },
                    notice: {
                        required: true
                    },
                    to: {
                        required: true,
                    },
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('sendnotice') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 1) {
                                toastr.success(data.message);
                                $("#notices").DataTable().ajax.reload();
                            } else {
                                // toastr.error(data.message);
                                $.each(data.message, function(index, value) {
                                    toastr.error(value);
                                });
                            }
                        }
                    });
                }
            });

            $('#notices').DataTable({
                ajax: {
                    url: '{{ route('getnotices') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            const date = new Date(data);
                            return date.getDate() + '-' + date.getMonth() + '-' + date
                                .getFullYear();
                        }
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'file',
                        render: function(data, type, row, meta) {
                            var notice;
                            console.log(data)
                            if (data == null) {
                                notice = data;
                            } else {
                                notice = '<a href={{ asset('/') }}' + data +
                                    ' target="_blank"><img style="height:30px" src="{{ asset('img/pdf.svg') }}"></a>';
                            }
                            return notice;
                        }
                    },
                    {
                        data: 'to',
                        render: function(data, type, row, meta) {
                            var to;
                            if (data == '1') {
                                to = 'Students';
                            } else if (data == '2') {
                                to = 'Teachers';
                            } else {
                                to = 'All';
                            }
                            return to;
                        },
                    },
                    {
                        data: 'notice_id',
                        render: function(data, type, row, meta) {
                            return "<div class='d-flex justify-content-end'>" +
                                "<i class='options fa fa-trash deletenoticeclick text-danger' " +
                                " id=" + data + "></i></div>";
                        },
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5],
                    className: 'dark light text-nowrap'
                }],
                aoInitComplete: {

                },
                // dom: 'lfBrtip',
                language: {
                    searchPlaceholder: 'Search',
                    search: '',
                    info: "_START_ to _END_ of _TOTAL_",
                    sEmptyTable: "<div class='dark light' style='height: 200px;margin:0px !important;width:100%'><img height='200px' src='{{ asset('img/no-data-found.gif') }}'></div>",
                    infoEmpty: "0 to 0 of 0", // Customize this based on your requirement
                    // infoFiltered: "(filtered from _MAX_ total entries)",
                    lengthMenu: " _MENU_ Notice per Page",
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


            $(document).on("click", ".deletenoticeclick", function() {
                var notice_id = $(this).attr("id");
                $.ajax({
                    type: 'post',
                    url: '{{ route('deletenotice') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "notice_id": notice_id
                    },
                    dataType: 'JSON',
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success(data.message);
                            $("#notices").DataTable().ajax.reload();
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
