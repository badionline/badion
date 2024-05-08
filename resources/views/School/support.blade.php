@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <form id="support">
                        @csrf
                        <div class="form-group" style="padding: 10px;">
                            <textarea name="issue" class="form-control dark light" cols="30" rows="10"
                                placeholder="Write your query here..."></textarea>
                        </div>
                        <div class="form-group light" style="padding: 10px;">
                            <x-fileinput label="Kindly add file if applicable" name="file" labelid="fileid"
                                accept="image/*,pdf" />
                        </div>
                        <div class="form-group light" style="padding: 10px;">
                            <input type="submit" class="btn button" value="Raise Ticket">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="table-responsive container">
                        <table id="tickets" class="table">
                            <thead>
                                <tr>
                                    <th class="dark light">Date</th>
                                    <th class="dark light">Discription</th>
                                    <th class="dark light">Attachments</th>
                                    <th class="dark light">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="updateticket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Close Ticket</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to close this ticket</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                    <form id="updateticketstatus">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <button type="submit" class="btn btn-primary">Yes Sure!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $("#support").validate({
                rules: {
                    issue: {
                        required: true,
                    },
                },
                messages: {
                    issue: {
                        required: "Write your issue to raise a ticket",
                    }
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('raiseticket') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 1) {
                                toastr.success(data.message);
                                $("#tickets").DataTable().ajax.reload();
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


            $('#tickets').DataTable({
                ajax: {
                    url: 'gettickets',
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
                            if (data == 0) {
                                icon = "fa-clock closeticket";
                                value = "Pending";
                            } else {
                                icon = "fa-check text-success border-success";
                                value = "Resolved";
                            }
                            var button =
                                "<div class='d-flex justify-content-start'><button id='" + row
                                .ticket_id + "' class='btn button fa " +
                                icon + "' value='" + value + "'> " + value + "</button></div>";
                            return button;
                        },
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3],
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

            $(document).on("click", ".closeticket", function() {
                $("#id").val($(this).attr("id"));
                $("#updateticket").modal("show");
            });
            $("#updateticketstatus").validate({
                rules: {
                    id: {
                        required: true
                    },
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('supdateticketstatus') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 1) {
                                toastr.success(data.message);
                                $("#updateticket").modal("hide");
                                $("#tickets").DataTable().ajax.reload();
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
