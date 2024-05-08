@extends('Student.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close btn button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                        <strong>Payment Faild!</strong> {{ $message }}
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                        role="alert">
                        <button type="button" class="close btn button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                        <strong>Success!</strong> {{ $message }}
                    </div>
                @endif
                <div class="card flex-row dark">
                    <div class="card-body light">
                        <h4 class="card-title">Fees</h4>
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table" id="studentfee">
                                    <thead>
                                        <tr class="dark light">
                                            <th class="dark light">Term</th>
                                            <th class="dark light">Amount</th>
                                            <th class="dark light">Pay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $fees)
                                            <tr>
                                                <td class="dark light">{{ $fees->name }}</td>
                                                <td class="dark light">{{ $fees->amount }}</td>
                                                <td class="dark light">
                                                    @if ($fees->status == 1)
                                                        <div class='d-flex justify-content-start'><label
                                                                id='{{ $fees->feestatus_id }} '
                                                                class='btn button fa fa-check'></label></div>
                                                    @else
                                                        <form action="{{ route('payfee') }}" method="POST">
                                                            @csrf
                                                            <div class='d-flex justify-content-start'><a
                                                                    href='{{ url('Student/feesreview/' . $fees->feestatus_id) }}'><label
                                                                        class='btn
                                                                    button fab fa-amazon-pay'></label></a>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                </table>
                            </div>
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
            $(".close").on("click", function() {
                $(".alert").css("display", "none");
            });
            // $('#studentfee').DataTable({
            //     ajax: {
            //         url: 'studentfee',
            //         dataSrc: '',
            //     },
            //     columns: [{
            //             data: 'name'
            //         },
            //         {
            //             data: 'amount'
            //         },
            //         {
            //             data: 'feestatus_id',
            //             render: function(data, type, row, meta) {
            //                 var button;
            //                 if (row.status == 1) {
            //                     button = "<label id='" + data +
            //                         "' class='btn button fa fa-download'></label>";
            //                 } else {
            //                     button = "<label id='" + data + "' class='btn button'>Pay</label>";
            //                 }
            //                 return "<div class='d-flex justify-content-start'>" + button + "</div>";
            //             },
            //         },
            //     ],
            //     order: false,
            //     sort: false,
            //     // borders:false,
            //     columnDefs: [{
            //         targets: [0, 1, 2],
            //         className: 'dark light text-nowrap'
            //     }],
            //     // dom: 'lfBrtip',
            //     language: {
            //         searchPlaceholder: 'Search',
            //         search: '',
            //         info: "_START_ to _END_ of _TOTAL_",
            //         sEmptyTable: "<div class='dark light' style='height: 200px;margin:0px !important;width:100%'><img height='200px' src='{{ asset('img/no-data-found.gif') }}'></div>",
            //         infoEmpty: "0 to 0 of 0", // Customize this based on your requirement
            //         // infoFiltered: "(filtered from _MAX_ total entries)",
            //         lengthMenu: " _MENU_ Students per Page",
            //         // paginate: {
            //         //     first: "<button class='btn button dark light'><<</button>",
            //         //     last: "<button class='btn button dark light'>>></button>",
            //         //     next: "<button class='btn button dark light'>></button>",
            //         //     previous: "<button class='btn button dark light'><</button>",
            //         // }
            //         // buttons: [{
            //         //     extend: 'spacer',
            //         // }, {
            //         //     extend: 'collection',
            //         //     text: 'Export',
            //         //     buttons: ['copy', 'excel', 'csv']
            //         // buttons: [
            //         // {
            //         //     extend: 'copy',
            //         //     text: 'Copy',
            //         //     messageTop: null,
            //         //     messageBottom: null,
            //         //     title: null,
            //         //     customize: function(copy) {
            //         //         var lines = copy.trim().split('\n');
            //         //         var firstLine = lines[0];
            //         //         var characters = firstLine.trim().split('\t');
            //         //
            //         //         characters = characters.map(function(value) {
            //         //             var trimmedValue = value.trim();
            //         //             // console.log(trimmedValue);
            //         //             var index = trimmedValue.indexOf('  ');
            //         //             if (index !== -1) {
            //         //                 // console.log("trimmed value->", trimmedValue);
            //         //                 var splitValues = trimmedValue.split("  ");
            //         //                 return splitValues[0];
            //         //             }
            //         //             return value;
            //         //         });
            //         //
            //         //         lines[0] = characters.join('\t');
            //         //         // console.log("final copy:");
            //         //         // console.log(lines.join('\n'));
            //         //         return lines.join('\n');
            //         //     }
            //         // },
            //         // {
            //         //     extend: 'excel',
            //         //     text: 'Xlsx',
            //         //     filename: 'Export_' + deName,
            //         //     title: null,
            //         //     messageTop: null,
            //         //     messageBottom: null,
            //         //     customize: function(xlsx) {
            //         //         var sheet = xlsx.xl.worksheets['sheet1.xml'];
            //         //         var cElements = sheet.getElementsByTagName('c');
            //         //         for (var i = 0; i < cElements.length; i++) {
            //         //             var cElement = cElements[i];
            //         //             var rAttribute = cElement.getAttribute('r');
            //         //             let pattern = rAttribute.match(/^[A-Z]+1$/g);
            //         //             if (pattern) {
            //         //                 pattern.forEach(match => {
            //         //                     if(rAttribute)
            //         //                     {
            //         //                         var tElement = cElement.getElementsByTagName('t')[0];
            //         //                         if (tElement) {
            //         //                             var celltext = tElement.textContent;
            //         //                             celltext = celltext.trim();
            //         //                             var index = celltext.indexOf('  ');
            //         //                             if (index !== -1) {
            //         //                                 // console.log(cellText.split("  ")[0]+'"');
            //         //                                 celltext = celltext.split("  ")[0];
            //         //                                 tElement.textContent = celltext;
            //         //                             }
            //         //                         }
            //         //                     }
            //         //                 });
            //         //             }
            //         //         }
            //         //     }
            //         // },
            //         // {
            //         //     extend: 'csv',
            //         //     text: 'Csv',
            //         // }
            //         // ]
            //         // }],
            //     },

            //     initComplete: function(settings, json) {
            //         $('.dt-input').css({
            //             "background-color": "transparent",
            //             "padding-left": "10px",
            //             "border-color": "#DA8228",
            //             "border-radius": "10px",
            //             "border-style": "solid"
            //         });
            //         // $('.dt-empty').css({
            //         //     "padding":"0",
            //         // });
            //     },
            //     drawCallback: function(settings, json) {
            //         $('.dt-empty').css({
            //             "padding": "0",
            //         });
            //     }
            // });
        });
    </script>
@endsection
