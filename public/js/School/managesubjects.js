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
            $('#standard1').empty().append('<option selected disabled>Select Class</option>');
        },
        success: function (data) {
            $("#schoolid").val(data.school);
            $("#schoolid1").val(data.school);

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
                $("#standard1").append("<option id='" + optionID + "' value='" + optionID + "'>" + optionValue + "</option>");
            });
            var uniqueStandards = {};
            $.each(shandard, function (index, standard) {
                if (!uniqueStandards[standard.name]) {
                    uniqueStandards[standard.name] = true;
                    $('.standard').append("<input class='form-check-input classes' name='standard[]' id='" + standard.name + "' value='" + standard.name + "' type='checkbox'><label style='margin-left:5px' class='form-check-label' for='" + standard.name + "'>" + standard.name + "</label><br>");
                }
            });

            // var tomSelect = new TomSelect("#standard", {
            //     allowEmptyOption: true,
            //     create: true
            // });
        }
    });
    $(document).on("click", "#all", function () {
        $('.classes').prop('checked', true);
    });

    $(document).on("click", ".classes", function () {
        $('#all').prop('checked', false);
    });

    $("#addsubject").validate({
        rules: {
            schoolid: {
                required: true
            },
            standard: {
                required: true
            },
            subject: {
                required: true
            }
        },
        errorClass: "text-danger",
        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: 'addsubject',
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function (data) {
                    $.each(data.errors, function (index, value) {
                        toastr.error(value);
                    });
                    $.each(data.success, function (index, value) {
                        toastr.success(value);
                    });
                }
            });
        }
    });



    $(document).on("change", "#standard1", function () {
        var id = $(this).val();
        // console.log(id);
        $.ajax({
            type: 'post',
            url: 'getsubject',
            data: {
                id: id
            },
            dataType: 'JSON',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            beforeSend: function () {
                $('#subjects').empty().append('<option selected disabled>Select Subject</option>');
            },
            success: function (data) {
                data.forEach(function (data, index) {
                    $('#subjects').append("<option id='" + data.subject_id + "' value='" + data.subject_id + "'>" + data.name + "</option>");
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: 'getunasignedteachers',
            dataType: 'JSON',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            beforeSend: function () {
                $('#assignteachersubjects').empty().append("<label for='class'>Subject</label><select class='form-select' id='subjects'><option value='' selected disabled>Select Subject</option></select>");
                $('#assignteacherid').empty().append("<label for='class'>Teacher</label><select class='form-select' id='teacher'><option value='' selected disabled>Select Teacher</option></select>");
            },
            success: function (data) {
                data.forEach(function (data, index) {
                    $("#teacher").append("<option id='" + data.teacher_id + "' value='" + data.teacher_id + "'>" + data.name + "</option>");
                });
            }
        });
    });
});
