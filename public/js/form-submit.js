$(document).ready(function() {
    $('#formsubmit').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Get the form data
        var formData = $(this).serialize();
        
        // Check if any required fields are empty
        var formValid = true;
        $(this).find('[required]').each(function(){
            if($(this).val() === ''){
                formValid = false;
                $(this).css('border-color', 'red');
            } else {
                $(this).css('border-color', ''); // Reset border color if valid
            }
        });

        // Check if the mobile number is valid (no starting 0, 10 digits)
        var mobileNumber = $(this).find('[name="phone"]').val();
        if (!/^[1-9]\d{9}$/.test(mobileNumber)) {
            formValid = false;
            $(this).find('[name="phone"]').css('border-color', 'red');
        } else {
            $(this).find('[name="phone"]').css('border-color', ''); // Reset border color if valid
        }

        if (formValid) {
            $.ajax({
                type: 'POST',
                url: 'sendnumber.php', // Specify the URL where you want to send the form data
                data: formData,
                success: function(response) {
                    // Handle the successful response from the server
                    console.log('Form submitted successfully');
                    // Redirect to PHP file
                    window.location.href = 'sendnumber.html';
                },
                error: function(error) {
                    // Handle any errors that occur during the AJAX request
                    console.error('Error:', error);
                }
            });
        }
    });
});
