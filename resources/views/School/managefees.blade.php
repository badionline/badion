@extends('School.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm light">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link light active" id="disabled-tab-0" data-bs-toggle="tab" href="#disabled-tabpanel-0"
                            role="tab" aria-controls="disabled-tabpanel-0" aria-selected="true">Fees Type</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link light" id="disabled-tab-1" data-bs-toggle="tab" href="#disabled-tabpanel-1"
                            role="tab" aria-controls="disabled-tabpanel-1" aria-selected="false">Manage Fees</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link light" id="disabled-tab-2" data-bs-toggle="tab" href="#disabled-tabpanel-2"
                            role="tab" aria-controls="disabled-tabpanel-2" aria-selected="false">Fees</a>
                    </li> --}}
                </ul>
                <div class="tab-content pt-5" id="tab-content">
                    <div class="tab-pane card dark active" id="disabled-tabpanel-0" role="tabpanel"
                        aria-labelledby="disabled-tab-0">
                        <div class="card dark">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="card-body light">
                                        <h4 class="card-title h5 h4-sm">Add Fee Type</h4>
                                        <form id="addfee">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <input type="text" name="category" class="form-control"
                                                            placeholder="Fee Category Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn button" value="Add">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-responsive container">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th class="dark light" colspan="2">Fee Categories</th>
                                                </tr>
                                            </thead>
                                            <tbody id="categorieslist">
                                                {{-- <tr>
                                                <td class="dark light">Addmision</td>
                                                <td class="dark light"><label
                                                        class="container dark text-danger fa fa-trash text-center"></label>
                                                </td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="disabled-tabpanel-1" role="tabpanel" aria-labelledby="disabled-tab-1">
                        <div class="card flex-row dark">
                            <div class="card-body light">
                                <h4 class="card-title h5 h4-sm">Manage Fees</h4>
                                <form id="managefees">
                                    @csrf
                                    <div class="standard"></div>
                                    <div class="form-group">
                                        <label for="fee">Fee Category</label>
                                        <select class="form-select" name="category" id="feecategories"
                                            aria-label="Default select example">

                                            {{-- <option value="1">null</option>
                                            <option value="2">null</option>
                                            <option value="3">null</option> --}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" name="amount" id="amount" class="form-control">
                                    </div>
                                    <button type="submit" class="btn button">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="tab-pane" id="disabled-tabpanel-2" role="tabpanel" aria-labelledby="disabled-tab-2">
                        <div class="card flex-row dark">
                            <div class="card-body light">
                                <h4 class="card-title h5 h4-sm">Manage Fees</h4>
                                <form id="getfeescategory">
                                    @csrf
                                    <div class="standard"></div>
                                    <div class="form-group">
                                        <label for="fee">Fee Category</label>
                                        <select class="form-select" name="category" id="feecategories"
                                            aria-label="Default select example">

                                            <option value="1">null</option>
                                            <option value="2">null</option>
                                            <option value="3">null</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" name="amount" id="amount" class="form-control">
                                    </div>
                                    <button type="submit" class="btn button">Add</button>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-sm">
                <div class="card flex-row dark">
                    <div class="card-body light">
                        <h4 class="card-title h5 h4-sm">Fees List</h4>
                        <p class="card-text">
                        <div class="container table-responsive">
                            <table id="feeslist" class="table table-dark" width="100%">
                                <thead>
                                    <tr>
                                        <th class="dark light">Class</th>
                                        <th class="dark light">Div</th>
                                        <th class="dark light">Category</th>
                                        <th class="dark light">Amount</th>
                                        <th class="dark light">Options</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                {{-- <tr>
                                    <td class="dark light">null</td>
                                    <td class="dark light">null</td>
                                    <td class="dark light">null
                                        <form>
                                            <div id="edit" class="collapse form-group">
                                                <input type="number" placeholder="Enter Marks">
                                                <button class="btn button fa fa-check" type="submit"></button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="dark light">
                                        <button class="btn button fa fa-edit" data-bs-toggle="collapse"
                                            data-bs-target="#edit"></button>
                                        <button class="btn button fa fa-trash"></button>
                                    </td>
                                </tr> --}}
                            </table>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Fee -->
    <div class="modal fade" id="editfees" tabindex="-1" role="dialog" aria-labelledby="editfees" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletecategoryLabel">Edit fee</h5>
                    <button type="button" class="btn button close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editfee">
                    @csrf
                    <input type="hidden" name="editfeeid" id="editfeeid" readonly>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label><span id='editfeeclass'></span> - <span id="editfeecategory"></span></label>
                                    {{-- Class: <input type="text" class="form-control-plaintext" name="editfeeclass" id="editfeeclass"
                                        plaintext readonly> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Category: <span id="editfeecategory"></span></label>
                                    <input type="text" class="form-control-plaintext" name="editfeecategory"
                                        id="editfeecategory" readonly>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Amount:</label>
                                    <input type="number" class="form-control" name="editfeeamount" id="editfeeamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
                        <input type="submit" name="update" value="Update" class="btn button">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            function categories() {
                $.ajax({
                    type: 'get',
                    url: '{{ route('getfeecategory') }}',
                    // data: data,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    async: true,
                    cache: false,
                    beforeSend: function() {
                        $("#feecategories").empty().append("<option selected disabled>Select</option>");
                        $("#categorieslist").empty();
                    },
                    success: function(data) {
                        data.forEach(function(data, index) {
                            var id = data.feescategory_id;
                            var name = data.name;
                            $("#feecategories").append("<option value='" + id + "'>" + name +
                                "</option>");
                            $("#categorieslist").append(
                                "<tr> <td class='dark light'>" + name +
                                "</td> </tr>"
                            );
                            // <td class='dark light'><button id='" + id + "' class='deletecategoryclick btn button text-danger fa fa-trash text-center'></button> </td> 
                        });
                    }
                });
            }
            categories();

            $("#addfee").validate({
                rules: {
                    category: {
                        required: true
                    }
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('addfeecategory') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 0) {
                                toastr.error(data.message);
                            } else {
                                toastr.success(data.message);
                                categories();
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.deletecategoryclick', function() {
                var id = $(this).attr("id");
                $.ajax({
                    type: 'post',
                    url: '{{ route('deletefeecategory') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == 0) {
                            toastr.error(data.message);
                        } else {
                            toastr.success(data.message);
                            categories();
                        }
                    }
                });
            });

            $.ajax({
                type: 'GET',
                url: '{{ route('getstandard') }}',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('.standard').empty().append(
                        "<input class='form-check-input' name='standard[]' id='all' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='defaultCheck2'>Select All</label><br>"
                    );
                },
                success: function(data) {
                    $("#schoolid").val(data.school);

                    var shandard = data.standard;
                    var standardValues = {
                        "Playgroup": 0,
                        "Nursery": 1,
                        "LKG": 2,
                        "UKG": 3,
                        "1st": 4,
                        "2nd": 5,
                        "3rd": 6,
                        "4th": 7,
                        "5th": 8,
                        "6th": 9,
                        "7th": 10,
                        "8th": 11,
                        "9th": 12,
                        "10th": 13,
                        "11th": 14,
                        "12th": 15,
                    };

                    shandard.sort(function(a, b) {
                        if (standardValues[a.name] !== standardValues[b.name]) {
                            return standardValues[a.name] - standardValues[b.name];
                        } else {
                            return a.div.localeCompare(b.div);
                        }
                    });

                    var sortedshandard = [];
                    $.each(shandard, function(index, standard) {
                        sortedshandard.push(standard.name + ' - ' + standard.div);
                    });
                    var uniqueStandards = {};
                    $.each(shandard, function(index, standard) {
                        if (!uniqueStandards[standard.name]) {
                            uniqueStandards[standard.name] = true;
                            $('.standard').append(
                                "<input class='form-check-input classes' name='standard[]' id='" +
                                standard.name + "' value='" + standard.name +
                                "' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='" +
                                standard.name + "'>" + standard.name + "</label><br>");
                        }
                    });

                    // var tomSelect = new TomSelect("#standard", {
                    //     allowEmptyOption: true,
                    //     create: true
                    // });
                }
            });
            $(document).on("click", "#all", function() {
                $('.classes').prop('checked', true);
            });

            $(document).on("click", ".classes", function() {
                $('#all').prop('checked', false);
            });
            $("#managefees").validate({
                rules: {
                    standard: {
                        required: true
                    },
                    category: {
                        required: true
                    },
                    amount: {
                        required: true
                    }
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('managefeeamount') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 0) {
                                toastr.error(data.message);
                            }
                            $.each(data.errors, function(index, value) {
                                toastr.info(value);
                                $("#feeslist").DataTable().ajax.reload();
                            });
                            $.each(data.success, function(index, value) {
                                $("#feeslist").DataTable().ajax.reload();
                                toastr.success(value);
                            });
                        }
                    });
                }
            });

            $('#feeslist').DataTable({
                ajax: {
                    url: '{{ route('feeslist') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'class'
                    },
                    {
                        data: 'div'
                    },
                    {
                        data: 'category'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'fee_id',
                        render: function(data, type, row, meta) {
                            return "<div class='d-flex justify-content-center'>" +
                                "<i id='" + data +
                                "' class='options fa fa-edit editfeesclick text-success' data-toggle='modal' data-bs-target='#editfees'></i></div></td></tr>";
                        },
                    },
                ],
                // order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4],
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

            $(document).on("click", ".editfeesclick", function() {
                $("#editfees").modal("show");
                var fee_id = $(this).attr("id");
                $.ajax({
                    type: 'POST',
                    url: '{{ route('geteditfee') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "fee_id": fee_id
                    },
                    // dataType:"JSON",
                    // contentType: false,
                    // processData: false,
                    // async: true,
                    // cache: false,
                    success: function(data) {
                        $("#editfeeclass").text(data.class);
                        $("#editfeecategory").text(data.name);
                        $("#editfeeamount").val(data.amount);
                        $("#editfeeid").val(data.fee_id);
                    }
                });
            });

            $("#editfee").validate({
                rules: {
                    editfeeid: {
                        required: true
                    },
                    editfeeamount: {
                        required: true
                    },
                },
                errorClass: "text-danger",
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let data = new FormData(form);
                    $.ajax({
                        type: 'post',
                        url: '{{ route('editfee') }}',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        async: true,
                        cache: false,
                        success: function(data) {
                            if (data.status == 1) {
                                toastr.success(data.message);
                                $("#editfees").modal("hide");
                                $("#feeslist").DataTable().ajax.reload();
                            } else {
                                toastr.error(data.message);
                            }
                        }
                    });
                }
            });
            $(document).on("click", ".close", function() {
                $("#editfees").modal("hide");
            });
        });
    </script>
@endsection
