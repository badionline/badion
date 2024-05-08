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
            $('#standard').empty().append('<option selected disabled>Select Class</option>');
        },
        success: function (data) {
            var shandard = data.standard;

            var standardValues = { "Playgroup": 0, "Nursery": 1, "LKG": 2, "UKG": 3, "1st": 4, "2nd": 5, "3rd": 6, "4th": 7, "5th": 8, "6th": 9, "7th": 10, "8th": 11, "9th": 12, "10th": 13, "11th": 14, "12th": 15, };

            shandard.sort(function (a, b) {
                if (standardValues[a.name] !== standardValues[b.name]) {
                    return standardValues[a.name] - standardValues[b.name];
                } else {
                    return a.div.localeCompare(b.div);
                }
            });

            var sortedshandard = [];
            $.each(shandard, function (index, standard) {
                sortedshandard.push(standard.name + ' - ' + standard.div);
            });

            $.each(shandard, function (index, standard) {
                var optionID = standard.class_id;
                var optionValue = standard.name + ' - ' + standard.div;
                $("#standard").append("<option id='" + optionID + "' value='" + optionID + "'>" + optionValue + "</option>");
            });
        }
    });

    $.ajax({
        type: 'GET',
        url: 'getteachers',
        dataType: 'JSON',
        contentType: false,
        processData: false,
        async: true,
        cache: false,
        beforeSend: function () {
            $('#teachers').empty().append('<option selected disabled>Select Teacher</option>');
        },
        success: function (data) {
            data.forEach(function (data, index) {
                $('#teachers').append("<option id='" + data.teacher_id + "' value='" + data.teacher_id + "'>" + data.name + "</option>");
            });
        }
    });


    $("#studenttimetable").validate({
        rules: {
            standard: {
                required: true,
            },
            file: {
                required: true,
            },
        },
        errorClass: "text-danger",

        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: "addtimetable",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $("#teachertimetable").validate({
        rules: {
            teachers: {
                required: true,
            },
            file: {
                required: true,
            },
        },
        errorClass: "text-danger",

        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: "addteachertimetable",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function (data) {
                    console.log(data);
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
