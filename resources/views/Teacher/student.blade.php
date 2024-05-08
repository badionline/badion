@extends('Teacher.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            {{--        <div class="col-sm text-end"> --}}
            {{--            <a href=""><button class="btn card fa fa-file-export" type="button"> Export File</button></a> --}}
            {{--        </div> --}}
            <div class="row">
                <div class="col-sm container card dark light">
                    <div class="table-responsive">
                        <table class="table" id="students">
                            {{--                        <tr> --}}
                            {{--                            <td class="dark light text-end" colspan="8"> --}}
                            {{--                                <form class="form-group" action="home"> --}}
                            {{--                                    <input type="search" placeholder="Search" class="searchinput" aria-label="Search"> --}}
                            {{--                                    <lable class="btn my-2 my-sm-0 fa fa-search" type="submit"></lable> --}}
                            {{--                                </form> --}}
                            {{--                            </td> --}}
                            {{--                        </tr> --}}
                            <thead>
                                <tr>
                                    <th scope="col" class="dark light">Full Name</th>
                                    <th scope="col" class="dark light">Email</th>
                                    <th scope="col" class="dark light">Roll</th>
                                    <th scope="col" class="dark light">Parent Name</th>
                                    <th scope="col" class="dark light">Parent Phone</th>
                                    <th scope="col" class="dark light">Address</th>
                                    <th scope="col" class="dark light">Options</th>
                                </tr>
                            </thead>
                            {{--                        <tr> --}}
                            {{--                            <td class="dark light">Null</td> --}}
                            {{--                            <td class="dark light">Null</td> --}}
                            {{--                            <td class="dark light">Null</td> --}}
                            {{--                            <td class="dark light">Null</td> --}}
                            {{--                            <td class="dark light">Null</td> --}}
                            {{--                            <td class="dark light"> --}}
                            {{--                                <a href="studentinfo" class="fa fa-eye"></a> --}}
                            {{--                            </td> --}}
                            {{--                        </tr> --}}
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
            $('#students').DataTable({
                ajax: {
                    url: '{{ route('tgetstudents') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'rollno'
                    },
                    {
                        data: 'pname'
                    },
                    {
                        data: 'pphone'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'user_id',
                        render: function(data, type, row, meta) {
                            return "<div class='d-flex justify-content-between'>" +
                                "<a href='studentinfo/" +
                                data +
                                "'><i class='options fa fa-eye viewstudentclick dark' data-toggle='modal' data-target='#viewstudent'></i></a></div></td></tr>";
                        },
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6],
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
        });
    </script>
@endsection
