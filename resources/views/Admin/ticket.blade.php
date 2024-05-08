@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        {{--        <div class="row"> --}}
        {{--            <div class="col-sm"> --}}
        {{--                <div class="light"> --}}
        {{--                    <div class="form-group"> --}}
        {{--                        <select class="form-select-sm card light"> --}}
        {{--                            <option value="" selected disabled>Select Status</option> --}}
        {{--                            <option value="all">All</option> --}}
        {{--                            <option value="unread">Unread</option> --}}
        {{--                            <option value="opened">Opened</option> --}}
        {{--                            <option value="resolved">Resolved</option> --}}
        {{--                        </select> --}}
        {{--                    </div> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--        </div> --}}
        <div class="row">
            <div class="col-sm">
                <div class="card container light">
                    <div class="table-responsive">
                        <table class="table" id="tickets">
                            <thead>
                                <tr>
                                    <td class="dark light">Date</td>
                                    <td class="dark light">Ticket Id</td>
                                    <td class="dark light">School Id</td>
                                    <td class="dark light">School Name</td>
                                    <td class="dark light">Email</td>
                                    <td class="dark light">Phone</td>
                                    <td class="dark light">Description</td>
                                    <td class="dark light">Attachments</td>
                                    <td class="dark light">Status</td>
                                </tr>
                            </thead>
                            {{--                            <tr> --}}
                            {{--                                <td class="dark light">Null</td> --}}
                            {{--                                <td class="dark light">Null</td> --}}
                            {{--                                <td class="dark light">Null</td> --}}
                            {{--                                <td class="dark light"> --}}
                            {{--                                    <label class="btn button light">Unread</label> --}}
                            {{--                                    <label class="btn button light">Opened</label> --}}
                            {{--                                    <label class="btn button light">Resolved</label> --}}
                            {{--                                </td> --}}
                            {{--                            </tr> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#tickets').DataTable({
                ajax: {
                    url: '{{ route('agettickets') }}',
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
                        data: 'ticket_id'
                    },
                    {
                        data: 'school_id'
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
                        data: 'description'
                    },
                    {
                        data: 'attachment',
                        render: function(data, type, row, meta) {
                            var notice;
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
                        data: 'status',
                        render: function(data, type, row, meta) {
                            var icon;
                            // var value;
                            console.log(data);
                            if (data == 1) {
                                icon = "fa-check text-success border-success";
                                value = "Resolved";
                            } else {
                                icon = "fa-clock";
                                value = "Pending";
                            }
                            var button =
                                "<div class='d-flex justify-content-start'><button id='" + row
                                .ticket_id + "' class='btn button updateticketstatus fa " +
                                icon + "' value='" + value + "'> " + value + "</button></div>";
                            return button;
                        },
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8],
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
                    lengthMenu: " _MENU_ Tickets per Page",
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

            $(document).on("click", ".updateticketstatus", function() {
                var id = $(this).attr("id");
                $.ajax({
                    type: 'POST',
                    url: '{{ route('updateticketstatus') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id,
                    },
                    dataType: 'JSON',
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    success: function(data) {
                        if (data.status == 1) {
                            $("#tickets").DataTable().ajax.reload();
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
