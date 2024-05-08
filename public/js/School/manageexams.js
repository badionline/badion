$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: 'getstandard',
        dataType: 'JSON',
        contentType: false,
        processData: false,
        async: true,
        cache: false,
        beforeSend: function () {
            $('.standard').empty().append("<input class='form-check-input' name='standard[]' id='all' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='defaultCheck2'>Select All</label><br>");
        },
        success: function (data) {
            $("#schoolid").val(data.school);
            // $("#schoolid1").val(data.school);

            var shandard = data.standard;
            var standardValues = { "Playgroup": 0, "Nursery": 1, "LKG": 2, "UKG": 3, "1st": 4, "2nd": 5, "3rd": 6, "4th": 7, "5th": 8, "6th": 9, "7th": 10, "8th": 11, "9th": 12, "10th": 13, "11th": 14, "12th": 15, };

            shandard.sort(function (a, b) {
                if (standardValues[a.name] !== standardValues[b.name]) {
                    return standardValues[a.name] - standardValues[b.name];
                } else {
                    return a.div.localeCompare(b.div);
                }
            });

            // var sortedshandard = [];
            // $.each(shandard, function (index, standard) {
            //     sortedshandard.push(standard.name + ' - ' + standard.div);
            // });

            // $.each(shandard, function (index, standard) {
            //     var optionID = standard.class_id;
            //     var optionValue = standard.name + ' - ' + standard.div;
            //     $("#standard1").append("<option id='" + optionID + "' value='" + optionID + "'>" + optionValue + "</option>");
            // });
            var uniqueStandards = {};
            $.each(shandard, function (index, standard) {
                if (!uniqueStandards[standard.name]) {
                    uniqueStandards[standard.name] = true;
                    $('.standard').append("<input class='form-check-input classes' name='standard[]' id='standard' value='" + standard.name + "' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='" + standard.name + "'>" + standard.name + "</label><br>");
                }
            });
        }
    });
    $(document).on("click", "#all", function () {
        $('.classes').prop('checked', true);
    });

    $(document).on("click", ".classes", function () {
        $('#all').prop('checked', false);
    });

    $("#addexam").validate({
        rules: {
            name: {
                required: true
            },
            standard: {
                required: true
            },
            file: {
                required: true
            }
        },
        errorClass: "text-danger",
        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: 'addexam',
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function (data) {
                    $(data.warning).each(function (index, value) {
                        toastr.info(value);
                    });
                    $(data.success).each(function (index, value) {
                        toastr.success(value);
                    });
                }
            });
        }
    });


    $('#examslist').DataTable({
        ajax: {
            url: 'getexams',
            dataSrc: '',
        },
        columns: [
            {
                data: 'name'
            },
            {
                data: 'standard',
            },
            {
                data: 'div',
            },
            {
                data: 'timetable',
                render: function (data, type, row, meta) {
                    return "<a href='http://127.0.0.1:8000/" + data + "' download><label class='btn button fa fa-download'></label></a><a href='http://127.0.0.1:8000/" + data + "' target='_blank'><label class='btn button fa fa-eye'></label></a>";
                },
            },
            {
                data: 'exam_id',
                render: function (data, type, row, meta) {
                    return "<i id='" + data + "' class='btn button fa fa-edit editexamclick' data-toggle='modal' data-target='#editexams'></i>";
                },
            },
        ],
        order: false,
        sort: false,
        // borders:false,
        columnDefs: [
            {
                targets: [0, 1, 2, 3, 4],
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
            lengthMenu: " _MENU_ Exams per Page",
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

    $(document).on('click', '.editexamclick', function () {
        $('#editexams').modal('show');
        event.preventDefault();
        var id = $(this).prop('id');
        $.ajax({
            type: 'POST',
            url: 'editexam',
            data: { data: id },
            dataType: 'JSON',
            // contentType: false,
            // processData: false,
            // async: true,
            // cache: false,
            // beforeSend: function () {
            //     $('#editparentcategories').empty();
            // },
            success: function (data) {
                console.log(data);
                $("#editexamid").val(data.exam_id);
                $("#editexamname").val(data.name);
                $("#editexamclass").val(data.standard);
                $("#editexamdiv").val(data.div);
                // let category = data.category.flag;
                // let allcategories = data.allCategory;
                // allcategories.forEach(function(value, index) {
                //     var id = value.id;
                //     var name = value.name;
                //     if (id == category) {
                //         selected = "selected";
                //     } else {
                //         selected = "";
                //     }
                //     $("#editparentcategories").append("<option id=" + name +
                //         " value=" + id + " " + selected + ">" + name +
                //         "</option>");
                // });
                // $("#editcategoryid").val(data.category.id);
                // $("#editcategoryname").val(data.category.name);
            }
        });
    });

    $(document).on("click",".close",function(){
        $('#editexams').modal('hide');
    });


    $("#editexam").validate({
        rules: {
            editexamid:{
                required:true
            },
            editexamname: {
                required: true
            },
            editexamclass: {
                required: true
            },
            editexamdiv: {
                required: true
            },
            file: {
                required: true
            }
        },
        errorClass: "text-danger",
        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: 'updateexam',
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success(data.message);
                        $('#editexams').modal('hide');
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
});
