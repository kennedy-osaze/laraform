$(function() {
    $('#password-recover').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Please enter your email address"
            }
        }
    });
});
