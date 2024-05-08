$(document).ready(function () {
    $('#students').DataTable({
        ajax: {
            url: 'getstudents',
            dataSrc: '',
        },
        columns: [
            {
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
                        "<a href='editstudent/"+data+"'><i class='options fa fa-edit editstudentclick text-success' data-toggle='modal' data-bs-target='#editstudent'></i></a><a href='student/"+data+"'><i class='options fa fa-eye viewstudentclick dark' data-toggle='modal' data-target='#viewstudent'></i></a><i class='options fa fa-trash deletestudentclick text-danger' " +
                        "data-toggle='modal' id=" + data + " data-target='#deletestudent'></i></div></td></tr>";
                },
            },
        ],
        order: false,
        sort: false,
        // borders:false,
        columnDefs: [
            {
                targets: [0, 1, 2, 3, 4, 5, 6, 7],
                className: 'dark light text-nowrap'
            }
        ],
        // dom: 'lfBrtip',
        language: {
            searchPlaceholder: 'Search',
            search: '',
            info: "_START_ to _END_ of _TOTAL_",
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
    });
    $('.dt-input').css({
        "background-color": "transparent",
        "padding-left": "10px",
        "border-color": "#DA8228",
        "border-radius": "10px",
        "border-style": "solid"
    });

    $(document).on('click', '.deletestudentclick', function() {
        $("#deletestudent").modal('show');
        event.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "getdeletestudent",
            data: {
                'user_id':id
            },
            dataType: 'JSON',
            success: function(data) {
                $("#deletestudentname").text(data.name);
                $("#deletestudentid").val(data.student_id);
            }
        });
    });

    $("#studentdelete").validate({
        rules: {
            deletestudentid: {
                required: true,
            },
        },
        errorClass: "text-danger",

        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: "deletestudent",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function (data) {
                    toastr.success(data.message);
                    $('#students').DataTable().ajax.reload();
                    $("#deletestudent .deleteclose").click();
                }
            });
        }
    });


    $(document).on('click',".deleteclose",function(){
        $("#deletestudent").modal('hide');
    });
});
