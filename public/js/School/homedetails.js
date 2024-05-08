$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: 'homedetails',
        // data: data,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        async: true,
        cache: false,
        success: function (data) {
            // console.log(data);
            $("#studentscount").text(data.student.length);
            $("#teacherscount").text(data.teacher.length);
            $("#salarycount").text(data.salary);
        }
    });
});
