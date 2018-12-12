$(function() {
    $('#password-reset').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            'password': {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
        },
        messages: {
            email: {
                required: "Please enter your email address"
            },
            password: {
                required: 'Password is required'
            },
            password_confirmation: {
                required: "Confirm password is required"
            },
        }
    });
});
