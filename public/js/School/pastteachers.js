$(document).ready(function () {
    $('#pastteachers').DataTable({
        ajax: {
            url: 'getpastteachers',
            dataSrc: '',
        },
        columns: [
            {
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
                render: function (data, type, row, meta) {
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
                render: function (data, type, row, meta) {
                    return "<div class='d-flex justify-content-between'>" +
                        "<a href='teacher/"+data+"'><i class='options fa fa-eye'></i></a></div></td></tr>";//<i class='options fa fa-trash-restore deletestudentclick text-danger' " + "data-toggle='modal' id=" + data + " data-target='#deletestudent'></i>
                },
            },
        ],
        order: false,
        sort: false,
        // borders:false,
        columnDefs: [
            {
                targets: [0, 1, 2, 3, 4, 5, 6],
                className: 'dark light text-nowrap'
            }
        ], language: {
            searchPlaceholder: 'Search',
            search: '',
            info: "_START_ to _END_ of _TOTAL_",
            infoEmpty: "0 to 0 of 0", // Customize this based on your requirement
            infoFiltered: "(filtered from _MAX_ total entries)",
            lengthMenu: " _MENU_ teachers per Page",
            ZeroEntries:"",
            // paginate: {
            //     first: "<button class='btn button dark light'><<</button>",
            //     last: "<button class='btn button dark light'>>></button>",
            //     next: "<button class='btn button dark light'>></button>",
            //     previous: "<button class='btn button dark light'><</button>",
            // }
        },
    });
    $('.dt-input').css({
        "background-color": "transparent",
        "padding-left": "10px",
        "border-color": "#DA8228",
        "border-radius": "10px",
        "border-style": "solid"
    });
});
