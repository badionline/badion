@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm text-end">
                <a href="{{ route('aaddschool') }}">
                    <button class="btn card fa fa-plus" type="button"> Add School</button>
                </a>
                <a href="{{ route('exportschools') }}">
                    <button class="btn card fa fa-file-excel" type="button"> Download Schools</button>
                </a>
            </div>
        </div>
        <div class="col-sm container card dark light">
            <div class="table-responsive">
                <table id="schools" class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="dark light">School Id</th>
                            <th scope="col" class="dark light">School Name</th>
                            <th scope="col" class="dark light">Contact</th>
                            <th scope="col" class="dark light">Email</th>
                            <th scope="col" class="dark light">Status</th>
                            <th scope="col" class="dark light">Options</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#schools').DataTable({
                ajax: {
                    url: '{{ route('schoolusers') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'school_id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'status',
                        render: function(data, type, row, meta) {
                            var status;
                            if (data == 0) {
                                status =
                                    "<button id='" + row.school_id +
                                    "' class='btn button status fa fa-times text-danger  border-danger'> Disabled</button>";
                            } else {
                                status = "<button id='" + row.school_id +
                                    "' class='btn button status fa fa-play text-success border-success'> Enabled</button>";
                            }
                            return status;
                        },
                    },
                    {
                        data: 'user_id',
                        render: function(data, type, row, meta) {
                            return "<a href='editschool/" + data +
                                "'><button  class='fa fa-edit btn button'></button></a> <a href='school/" +
                                data + "'><button  class='fa fa-eye btn button'></button></a>";
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
                // dom: 'lfBrtip',
                language: {
                    searchPlaceholder: 'Search',
                    search: '',
                    info: "_START_ to _END_ of _TOTAL_",
                    sEmptyTable: "<div class='dark light' style='height: 200px;margin:0px !important;width:100%'><img height='200px' src='{{ asset('img/no-data-found.gif') }}'></div>",
                    infoEmpty: "0 to 0 of 0", // Customize this based on your requirement
                    // infoFiltered: "(filtered from _MAX_ total entries)",
                    lengthMenu: " _MENU_ Schools per Page",
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

            $(document).on("click", ".status", function() {
                var id = $(this).attr("id");
                $.ajax({
                    type: 'POST',
                    url: '{{ route('updatestatus') }}',
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
                            $("#schools").DataTable().ajax.reload();
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
