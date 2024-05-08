@extends('Teacher.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <form id="addhomework">
                        @csrf
                        <div class="table-responsive container">
                            <table class="table">
                                <tr>
                                    <td class="dark light">
                                        <select class="form-control" name="subject" id="subjects">
                                            <option value="">Select Class and Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->subject_id }}">
                                                    {{ $subject->subject . ' ' . '(' . $subject->class . '-' . $subject->div . ')' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dark light">
                                        <textarea name="homework" class="form-control dark light" cols="30" rows="10"
                                            placeholder="Enter Homework Here..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dark light">
                                        <x-fileinput name="file" label="Select File" labelid="fileid" accept=".pdf" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="dark light">
                                        <input type="submit" class="btn button" value="Submit">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="card dark">
                    <div class="table-responsive container">
                        <table class="table" id="homework">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Div</th>
                                    <th>Subject Name</th>
                                    <th>Title</th>
                                    <th>File</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
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
            // gethomework Pending
            $('#homework').DataTable({
                ajax: {
                    url: '{{ route('gethomework') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'class'
                    }, {
                        data: 'div'
                    }, {
                        data: 'subject'
                    },
                    {
                        data: 'content'
                    },
                    {
                        data: 'file',
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
                        data: 'homework_id',
                        render: function(data, type, row, meta) {
                            return "<div class='d-flex justify-content-end'>" +
                                "<i class='options fa fa-trash deletehomework text-danger' " +
                                "data-toggle='modal' id=" + data +
                                " data-target='#deletestudent'></i></div></td></tr>";
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

            $("#addhomework").validate({
                rules: {
                    subject: {
                        required: true,
                    },
                    homework: {
                        required: true,
                    },
                    file: {
                        required: true,
                    },
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('addhomework') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        beforeSend: function() {
                            $(".loaderClass").css("display", "flex");
                        },
                        success: function(data) {
                            $('#homework').DataTable().ajax.reload();
                            $(".loaderClass").css("display", "none");
                            if (data.status == 0) {
                                $.each(data.message, function(index, value) {
                                    toastr.error(value);
                                });
                            } else {
                                toastr.success(data.message);
                            }
                        }
                    });
                }
            });


            $(document).on("click", ".deletehomework", function() {
                var id = $(this).attr("id");
                $.ajax({
                    type: 'post',
                    url: '{{ route('deletehomework') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    // dataType: 'JSON',
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    beforeSend: function() {
                        $(".loaderClass").css("display", "flex");
                    },
                    success: function(data) {
                        $('#homework').DataTable().ajax.reload();
                        $(".loaderClass").css("display", "none");
                        if (data.status == 0) {
                            toastr.error(data.message);
                        } else {
                            toastr.success(data.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
