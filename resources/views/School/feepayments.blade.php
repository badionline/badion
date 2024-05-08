@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm text-end">
                <a href="{{ route('exportfees') }}">
                    <button class="btn card light fa fa-file-excel" type="button"> Download Fee Status</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm container card">
        <div class="row">
            <div class="col-sm">
                {{-- <div class="card flex-row"> --}}
                <div class="table-response">
                    <table class="table" id="fees">
                        <thead>
                            <tr>
                                <th>Term</th>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Div</th>
                                <th>Collect Fee</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                {{-- </div> --}}
                {{-- <div class="card-body text-light">
                        <h4 class="card-title h5 h4-sm">Fee Status</h4>
                        <p class="card-text">
                        <form id="getfeedatils">
                            @csrf
                            <div class="form-group">
                                <label for="class">Select Class</label>
                                <select class="form-select" id="standard" name="standard">
                                    <option value=""></option>
                                </select>
                                <span id="standarderror" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="student">Select Student</label>
                                <select class="form-select" name="students" id="students"
                                    aria-label="Default select example"></select>
                                <span id="studenterror" class="text-danger"></span>
                            </div>
                            <button type="submit" class="btn button">Get</button>
                        </form>
                        </p>
                    </div>
                </div> --}}
                {{-- <div class="col-sm">
                <div class="card flex-row">
                    <div class="card-body text-light">
                        <h4 class="card-title h5 h4-sm">Fee Status</h4>
                        <p class="card-text">
                        <div class="container table-responsive">
                            <table class="table table-dark">
                                <tr>
                                    <th class="dark light">Month</th>
                                    <th class="dark light">Status</th>
                                    <th class="dark light">Options</th>
                                </tr>
                                <tr>
                                    <td class="dark light">Month Name</td>
                                    <td class="dark light">paid/pending</td>
                                    <td class="dark light">
                                        <button class="btn button fa fa-check"></button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </p>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="collectfees">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Collect Fee</h5>
                    <button type="button" class="close btn button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-dark">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Term</th>
                                <td id="feestuatusterm"></td>
                            </tr>
                            <tr>
                                <th>Student id</th>
                                <td id="feestuatusstudentid"></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td id="feestuatusname"></td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td id="feestuatusclass"></td>
                            </tr>
                            <tr>
                                <th>Div</th>
                                <td id="feestuatusdiv"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="updatefeestatus">
                        @csrf
                        <input type="hidden" name="feesstatus_id" id="feesstatus_id" readonly>
                        <input type="submit" class="btn button text-dark" value="Collected">
                    </form>
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#fees').DataTable({
                ajax: {
                    url: '{{ route('getfeedatils') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'term'
                    },
                    {
                        data: 'user_id'
                    },
                    {
                        data: 'student'
                    },
                    {
                        data: 'class'
                    },
                    {
                        data: 'div'
                    },
                    {
                        data: 'status',
                        render: function(data, type, row, meta) {
                            var addclass;
                            var label;
                            if (data == '0') {
                                addclass = "fa fa-money-check paynow";
                                label = "Collect";
                            } else {
                                addclass = "fa fa-check";
                                label = "Paid";
                            }
                            return "<button class='btn button " + addclass +
                                "' id='" + row
                                .feestatus_id + "'> " + label + "</button>";
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
                    lengthMenu: " _MENU_ Fees per Page",
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


            $(document).on("click", ".paynow", function() {
                var id = $(this).attr("id");
                $.ajax({
                    type: 'post',
                    url: "{{ route('getfeedetails') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    // dataType: 'JSON',
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    success: function(data) {
                        console.log(data);
                        $("#collectfees").modal("show");
                        $("#feestuatusterm").text(data.term);
                        $("#feestuatusname").text(data.student);
                        $("#feestuatusstudentid").text(data.user_id);
                        $("#feestuatusclass").text(data.class);
                        $("#feestuatusdiv").text(data.div);
                        $("#feesstatus_id").val(data.feestatus_id);
                    }
                });
            });

            $(document).on("click", ".close", function() {
                $("#collectfees").modal("hide");
            });


            //     $.ajax({
            //         type: 'GET',
            //         url: 'getstandard',
            //         dataType: 'JSON',
            //         contentType: false,
            //         processData: false,
            //         async: true,
            //         cache: false,
            //         beforeSend: function() {
            //             $('#standard').empty().append('<option selected disabled>Select Class</option>');
            //         },
            //         success: function(data) {
            //             $("#schoolid").val(data.school);
            //             var shandard = data.standard;
            //             var standardValues = {
            //                 "Playgroup": 0,
            //                 "Nursery": 1,
            //                 "LKG": 2,
            //                 "UKG": 3,
            //                 "1st": 4,
            //                 "2nd": 5,
            //                 "3rd": 6,
            //                 "4th": 7,
            //                 "5th": 8,
            //                 "6th": 9,
            //                 "7th": 10,
            //                 "8th": 11,
            //                 "9th": 12,
            //                 "10th": 13,
            //                 "11th": 14,
            //                 "12th": 15,
            //             };

            //             shandard.sort(function(a, b) {
            //                 if (standardValues[a.name] !== standardValues[b.name]) {
            //                     return standardValues[a.name] - standardValues[b.name];
            //                 } else {
            //                     return a.div.localeCompare(b.div);
            //                 }
            //             });

            //             var sortedshandard = [];
            //             $.each(shandard, function(index, standard) {
            //                 sortedshandard.push(standard.name + ' - ' + standard.div);
            //             });

            //             $.each(shandard, function(index, standard) {
            //                 var optionID = standard.class_id;
            //                 var optionValue = standard.name + ' - ' + standard.div;
            //                 $("#standard").append("<option value='" +
            //                     optionID + "'>" + optionValue + "</option>");
            //             });
            //         }
            //     });
            //     $.ajax({
            //         type: 'GET',
            //         url: 'getstudents',
            //         dataType: 'JSON',
            //         contentType: false,
            //         processData: false,
            //         async: true,
            //         cache: false,
            //         beforeSend: function() {
            //             $('#students').empty().append("<option></option>");
            //         },
            //         success: function(data) {
            //             data.forEach(function(data, index) {
            //                 var id = data.student_id;
            //                 var name = data.name;
            //                 $("#students").append("<option value='" + id + "' >" + name +
            //                     "</option>");
            //             });

            //             var my_select = new TomSelect('#students', {
            //                 placeholder: "Select Student",
            //             });
            //             var form = document.getElementById('getfeedatils');
            //             form.addEventListener('submit', function(event) {
            //                 form.classList.add('was-validated')
            //                 if (!form.checkValidity()) {
            //                     event.preventDefault()
            //                     event.stopPropagation()
            //                 }
            //             }, false);
            //             $(".ts-wrapper").css("padding", "0");
            //             $(".ts-control").addClass("dark");
            //             $(".ts-control").css({
            //                 "border": "0",
            //                 "border-radius": "7px"
            //             });
            //         }
            //     });


            $("#updatefeestatus").validate({
                rules: {
                    feesstatus_id: {
                        required: true
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: "{{ route('updatefeestatus') }}",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            $("#fees").DataTable().ajax.reload();
                            console.log(data);
                            if (data.status == 1) {
                                $("#collectfees").modal("hide");
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
