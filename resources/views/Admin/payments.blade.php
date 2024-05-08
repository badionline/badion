@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="col-sm text-end">
            <a href="{{ route('aexportfees') }}">
                <button class="btn card fa fa-file-excel" type="button"> Download Payments</button>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark container">
                    <div class="table-responsive-sm">
                        <table class="table" id="payments">
                            {{-- <tr>
                                <td class="dark light" colspan="9">
                                    <form class="d-grid gap-2 d-md-flex justify-content-md-end" action="home.php">
                                        <input type="search" class="searchinput" placeholder="Search" aria-label="Search">
                                        <lable class="btn my-2 my-sm-0 fa fa-search" type="submit"></lable>
                                    </form>
                                </td>
                            </tr> --}}
                            <thead>
                                <tr>
                                    <th class="dark light">Date Time</th>
                                    <th class="dark light">Payment id</th>
                                    <th class="dark light">Raazorpay Payment id</th>
                                    <th class="dark light">School id</th>
                                    <th class="dark light">User id</th>
                                    <th class="dark light">Amount</th>
                                    <th class="dark light">Payment Method</th>
                                    <th class="dark light">Payer name</th>
                                </tr>
                            </thead>
                            <tbody>
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
            $("#payments").DataTable({
                ajax: {
                    url: '{{ route('getpayments') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            var dateObject = new Date(data);

                            var options = {
                                year: 'numeric',
                                month: 'short',
                                day: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: false
                            };

                            var formattedDate = dateObject.toLocaleString('en-US', options);
                            return formattedDate;
                        },
                    }, {
                        data: 'payment_id'
                    },
                    {
                        data: 'raazorpay_payment_id'
                    },
                    {
                        data: 'school_id'
                    },
                    {
                        data: 'user_id'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'method'
                    },
                    {
                        data: 'payername'
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
                    lengthMenu: " _MENU_ Payments per Page",
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
