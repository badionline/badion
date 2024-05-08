$(document).ready(function(){
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
});
