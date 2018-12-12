$(function() {
    $('#register').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                maxlength: 100,
            },
            last_name: {
                required: true,
                minlength: 3,
                maxlength: 100,
            },
            email: {
                required: true,
                email: true,
                maxlength: 150
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
        },
        messages: {
            first_name: {
                required: "First name is required"
            },
            last_name: {
                required: "Last name is required"
            },
            email: {
                required: "Email Address is required"
            },
            password: {
                required: "Password is required"
            },
            password_confirmation: {
                required: "Confirm password is required",
                equalTo: "Please re-enter your password"
            },
        }
    });

    $('#login').validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true
            }
        },
        messages: {
            email: "Your email address is required",
            password: "Your password is required"
        }
    });

    // Style checkboxes and radios
    $('.styled').uniform();
});
