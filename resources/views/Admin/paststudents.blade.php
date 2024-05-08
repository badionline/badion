@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm text-end">
                <a href="{{ route('aexportpaststudents') }}"><button class="btn card light fa fa-file-excel" type="button">
                        Download Past
                        Students</button></a>
            </div>
        </div>
    </div>
    <div class="col-sm container card dark light">
        <div class="table-responsive">
            <table id="paststudents" class="table dark light">
                <thead>
                    <tr>
                        <th scope="col" id="name" class="dark light">Full Name</th>
                        <th scope="col" id="email" class="dark light">Email</th>
                        <th scope="col" id="pname" class="dark light">Parent Name</th>
                        <th scope="col" id="pphone" class="dark light">Parent Phone</th>
                        <th scope="col" id="rollno" class="dark light">Roll</th>
                        <th scope="col" id="address" class="dark light">Address</th>
                        <th scope="col" id="gender" class="dark light">Gender</th>
                        <th scope="col" id="options" class="dark light">Options</th>
                    </tr>
                </thead>
                <tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#paststudents').DataTable({
                ajax: {
                    url: '{{ route('agetpaststudents') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'pname'
                    },
                    {
                        data: 'pphone'
                    },
                    {
                        data: 'rollno'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'gender',
                        render: function(data, type, row, meta) {
                            var gender;
                            if (data == 'F') {
                                gender = 'Female';
                            } else {
                                gender = 'Male';
                            }
                            return gender;
                        },
                    },
                    {
                        data: 'user_id',
                        render: function(data, type, row, meta) {
                            return "<div class='d-flex justify-content-between'>" +
                                "<a href='student/" + data +
                                "'><i class='options fa fa-eye'></i></a></div></td></tr>"; //<i class='options fa fa-trash-restore deletestudentclick text-danger' " + "data-toggle='modal' id=" + data + " data-target='#deletestudent'></i>
                        },
                    },
                ],
                order: false,
                sort: false,
                // borders:false,
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7],
                    className: 'dark light text-nowrap'
                }],
                language: {
                    searchPlaceholder: 'Search',
                    search: '',
                    info: "_START_ to _END_ of _TOTAL_",
                    sEmptyTable: "<div class='dark light' style='height: 200px;margin:0px !important;width:100%'><img height='200px' src='{{ asset('img/no-data-found.gif') }}'></div>",
                    infoEmpty: "0 to 0 of 0", // Customize this based on your requirement
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    lengthMenu: " _MENU_ Students per Page",
                    ZeroEntries: "",
                    // paginate: {
                    //     first: "<button class='btn button dark light'><<</button>",
                    //     last: "<button class='btn button dark light'>>></button>",
                    //     next: "<button class='btn button dark light'>></button>",
                    //     previous: "<button class='btn button dark light'><</button>",
                    // }
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
