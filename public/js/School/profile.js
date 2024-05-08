$.validator.addMethod("startsWith", function(value, element, param) {
    return this.optional(element) || value.indexOf(param) === 0;
}, "Value must start with {0}.");

$.ajax({
    type: 'GET',
    url: 'getstandard',
    dataType: 'JSON',
    contentType: false,
    processData: false,
    async: true,
    cache: false,
    success: function (data) {
        $("#school_id").val(data.school);
    }
});

$("#updatesocial").validate({
    rules: {
        location: {
            // required: true,
            startsWith: "https://g.co/"
        },
        whatsapp: {
            // required: true,
            startsWith: "https://w"
        },
        facebook: {
            // required: true,
            startsWith: "https://www.facebook.com/"
        },
        instagram: {
            // required: true,
            startsWith: "https:/instagram.com/"
        },
        youtube: {
            // required: true,
            startsWith: "https://www.youtube.com/@"
        },
        address:{
            required:true,
            minlength:10,
        }
    },
    // Define error messages for each input field
    messages: {
        location: {
            startsWith: "Location url must start with https://g.co/"
        },
        whatsapp: {
            startsWith: "WhatsApp url must start with https://w"
        },
        facebook: {
            startsWith: "Facebook url must start with https://www.facebook.com/"
        },
        youtube: {
            startsWith: "Instagram url must start with https://www.youtube.com/@"
        },
        address: {
            required: "Address is required",
            minlength:"Minimim 10 letters are required for address"
        },
    },
    errorClass: "text-danger",

    submitHandler: function (form, event) {
        event.preventDefault();
        let data = new FormData(form);
        $.ajax({
            type: 'post',
            url: "updateschoolsocial",
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

$("#changepass").validate({
    rules:{
        user_id:{required:true},
        password:{
            required:true,
            minlength:8,
            maxlength:64,
            // regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,64}$/,
        },
        cpassword:{required:true,
        equalTo: "#password"},
    },
    errorClass:"text-danger",
    submitHandler: function (form, event) {
        event.preventDefault();
        let data = new FormData(form);
        let action = $(form).attr("action");
        console.log(action);
        $.ajax({
            type: 'post',
            url: action,
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function (data) {
                console.log(data);
                if(data.status==1){
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }
            }
        });
    }
});
