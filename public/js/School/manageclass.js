function classes() {
    $.ajax({
        type: 'get',
        url: "getstandard",
        dataType: 'JSON',
        beforeSend: function () {
            $("#classes").empty();
        },
        success: function (data) {
            $("#schoolid").val(data.school);
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

            $.each(shandard, function(index, standard) {
                // var optionID =standard.class_id;
                var optionValue = standard.name + ' - ' + standard.div;
                $("#classes").append("<div class='row d-flex justify-content-between'><div class='col-sm'><span>"+optionValue+"</span></div></div>");
                //div class='col-sm'><span class='fa fa-trash text-danger' id='"+optionID+"'></span></div>
            });
        }
    });
}
$(document).ready(function () {

    classes();
    $("#addclass").validate({
        rules: {
            schoolid: {
                required: true,
            },
            class: {
                required: true,
            },
            div: {
                required: true,
            }
        },
        errorClass: "text-danger",
        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: "addclass",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success(data.message);
                        classes();
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });
});
