@extends('Admin.layouts.main')
@section('badion')
    <div class="col-sm container card dark light">
        <div class="table-responsive">
            <table id="schools" class="table dark light">
                <thead>
                    <th>User Id</th>
                    <th>School Id</th>
                    <th>School Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Whatsapp</th>
                    <th>Location</th>
                    <th>Instagram</th>
                    <th>Youtube</th>
                    <th>Pan</th>
                    <th>Panfile</th>
                    <th>Registernumber</th>
                    <th>Adhaar</th>
                    <th>Adhaar Front</th>
                    <th>Adhaar Back</th>
                    <th>Approve</th>
                </thead>
                <tbody>
            </table>
        </div>
    </div>
    <!-- Approve School -->
    <div class="modal fade" id="approveschool" tabindex="-1" role="dialog" aria-labelledby="approveschoolLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveschoolLabel">Approve School</h5>
                </div>
                <div class="modal-body">
                    <div> Are You Sure You have checked all Documents of User id <span id="approveschoolname"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="approval">
                        @csrf
                        <input type="hidden" id="approveschoolid" name="approveschoolid">
                        <button type="button" class="btn btn-secondary approve close" data-dismiss="modal">Cancel
                        </button>
                        <input type="submit" name="approve" value="Approve" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#schools').DataTable({
                ajax: {
                    url: '{{ route('getnonregistered') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'user_id'
                    }, {
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
                        data: 'address'
                    },
                    {
                        data: 'whatsapp',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return "<a href='" + data +
                                    "' target='_blank' class='btn button fab fa-whatsapp'></a>";
                            }
                            return null;
                        }
                    },
                    {
                        data: 'location',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return "<a href='" + data +
                                    "' target='_blank' class='btn button fa fa-map-marker-alt'></a>";
                            }
                            return null;
                        }
                    },
                    {
                        data: 'instagram',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return "<a href='" + data +
                                    "' target='_blank' class='btn button fab fa-instagram'></a>";
                            }
                            return null;
                        }
                    },
                    {
                        data: 'youtube',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return "<a href='" + data +
                                    "' target='_blank' class='btn button fab fa-youtube'></a>";
                            }
                            return null;
                        }
                    },
                    {
                        data: 'pan'
                    },
                    {
                        data: 'panfile',
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
                        data: 'registernumber'
                    },
                    {
                        data: 'adhaar'
                    },
                    {
                        data: 'adhaarfront',
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
                        data: 'adhaarback',
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
                        data: 'user_id',
                        render: function(data, type, row, meta) {
                            return "<i class='options fa fa-user-edit approveschoolclick text-success' data-toggle='modal' id=" +
                                data + " data-bs-target='#approveschool'></i>";
                        },
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
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

            $(".close").on("click", function() {
                $("#approveschool").modal('hide');
            });

            $(document).on("click", ".approveschoolclick", function() {
                $("#approveschool").modal('show');
                event.preventDefault();
                let id = $(this).attr('id');
                $("#approveschoolname").text(id);
                $("#approveschoolid").val(id);
            });

            $("#approval").validate({
                rules: {
                    approveschoolid: {
                        required: true
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('approveschool') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        beforeSend: function() {
                            $("#approveschool").modal('hide');
                            $(".loaderClass").css("display", "flex");
                        },
                        success: function(data) {
                            $(".loaderClass").css("display", "none");
                            $("#schools").DataTable().ajax.reload();
                            if (data.status == 1) {
                                toastr.success(data.message);
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
