$(document).ready(function () {

    $("#clear").click(function(){
        location.reload(true);
    });

    $.ajax({
        type: 'GET',
        url: 'getstandard',
        dataType: 'JSON',
        contentType: false,
        processData: false,
        async: true,
        cache: false,
        success: function (data) {
            $("#schoolid").val(data.school);
        }
    });


    $("#addteacher").validate({
        rules: {
            schoolid:{
                required: true,
            },
            name: {
                required: true,
                minlength: 2,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
                minlength:10,
                maxlength:10,
            },
            graduation: {
                required: true,
            },
            salary: {
                required: true,
            },
            dob: {
                required: true,
            },
            division: {
                required: true,
            },
            addmissionno: {
                required: true,
            },
            dob: {
                required: true,
            },
            aadhaar: {
                required: true,
                minlength:12,
                maxlength:12,
            },
            profilepic: {
                required: true,
                // accept: "jpg|jpeg|png",
            },
            address: {
                required: true,
            },
            gender: {
                required: true,
            },
        },
        errorClass: "text-danger",

        submitHandler: function (form, event) {
            event.preventDefault();
            let data = new FormData(form);
            $.ajax({
                type: 'post',
                url: "validateaddteacher",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                async: true,
                cache: false,
                beforeSend:function(){
                    $("#submit").attr("disabled",true);
                },
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
