@extends('Admin.layouts.main')
@section('badion')
    <div class="container">
        <div class="row">
            <div class="col-sm text-end">
                <a href="{{ route('aexportpastteachers') }}"><button class="btn card fa fa-file-excel" type="button"> Download
                        Past Students</button></a>
            </div>
        </div>

        <div class="col-sm container card dark light">
            <div class="table-responsive">
                <table class="table" id="pastteachers">
                    {{-- <tr>
          <td class="dark light" colspan="7">
            <form class="d-grid gap-2 d-md-flex justify-content-md-end" action="home.php">
              <input type="search" placeholder="Search" class="searchinput" aria-label="Search">
              <label class="btn my-2 my-sm-0 fa fa-search" type="submit"></label>
            </form>
          </td>
        </tr> --}}
                    <thead>
                        <tr>
                            <th scope="col" class="dark light">Teacher Id</th>
                            <th scope="col" class="dark light">Full Name</th>
                            <th scope="col" class="dark light">Email</th>
                            <th scope="col" class="dark light">Contact</th>
                            <th scope="col" class="dark light">Address</th>
                            <th scope="col" class="dark light">Gender</th>
                            <th scope="col" class="dark light">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
          <td class="dark light">Null</td>
          <td class="dark light">Null</td>
          <td class="dark light">Null</td>
          <td class="dark light">Null</td>
          <td class="dark light">Null</td>
          <td class="dark light">Null</td>
          <td class="dark light">
            <a href="editteacher" class="fa fa-edit"></a>
            <a href="teacher" class="fa fa-eye"></a>
            <a href="" class="fa fa-trash-restore light"></a>
          </td>
        </tr> --}}
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#pastteachers').DataTable({
                ajax: {
                    url: '{{ route('agetpastteachers') }}',
                    dataSrc: '',
                },
                columns: [{
                        data: 'teacher_id'
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
                                "<a href='teacher/" + data +
                                "'><i class='options fa fa-eye'></i></a></div></td></tr>"; //<i class='options fa fa-trash-restore deletestudentclick text-danger' " + "data-toggle='modal' id=" + data + " data-target='#deletestudent'></i>
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
                language: {
                    searchPlaceholder: 'Search',
                    search: '',
                    info: "_START_ to _END_ of _TOTAL_",
                    sEmptyTable: "<div class='dark light' style='height: 200px;margin:0px !important;width:100%'><img height='200px' src='{{ asset('img/no-data-found.gif') }}'></div>",
                    infoEmpty: "0 to 0 of 0", // Customize this based on your requirement
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    lengthMenu: " _MENU_ Teachers per Page",
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
