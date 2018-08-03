$(document).ready(function () {

    function validateForm(form_id) {
        $(form_id).validate({
            rules:{
                username: {
                    required: true,
                },
                email: {
                    required : true,
                    email : true
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                password_again: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                username: {
                    required: 'Username field is required ! '
                },
                email: {
                    required: 'Email field is required ! '
                },
                password: {
                    required: 'Password field is required !',
                    minlength: 'Minimum length of password is 6'
                },
                password_again: {
                    required: 'Confirm password field is required ! ',
                    equalTo: 'Please enter the same value again ! '
                }
            }
        })
    }

    // validateForm($('#login-form'))  // login form validation
    // validateForm($('#register-form'))  // registration form validation


})

