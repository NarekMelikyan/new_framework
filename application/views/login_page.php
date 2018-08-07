<!DOCTYPE html>
<head>
    <title>My MVC</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="/public/css/main.css" type="text/css" rel="stylesheet">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

<!------ Include the above in your HEAD tag ---------->


<?php

if (isset($_COOKIE['form_name'])) {
    $form_name = $_COOKIE['form_name'];
    if ($form_name == 'login') {
        echo '<input type="hidden" value="1" id="form_name"">';
    } else {
        echo '<input type="hidden" value="2" id="form_name">';
    }
} else {
    $form_name = '';
    echo '<input type="hidden" value="0" id="form_name">';
}

if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}

if (isset($_SESSION['email']))
    header('Location: account/users-page')
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="/account/login" method="post" role="form"
                                  style="display: block;">
                                <div style="text-align: center;color: red;">
                                    <?php
                                    if (isset($_COOKIE['user_does_not_exist']) && $form_name == 'login') {
                                        $login_error = $_COOKIE['user_does_not_exist'];
                                        echo $login_error;
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email">
                                    <span style="color:red;">
                                                    <?php
                                                    if (isset($errors) && $form_name == 'login') {
                                                        foreach ($errors as $error) {
                                                            foreach ($error as $key => $item) {
                                                                if ($key == 'email') {
                                                                    echo $item;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </span><br>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                    <span style="color:red;">
                                        <?php
                                        if (isset($errors) && $form_name == 'login') {
                                            foreach ($errors as $error) {
                                                foreach ($error as $key => $item) {
                                                    if ($key == 'password') {
                                                        echo $item;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </span><br>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button type="button" id="submit" tabindex="4"
                                                    class="form-control btn btn-login login_submit" value="Log In">Log in
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="account/registration" method="post" role="form"
                                  style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username" value="">
                                    <span style="color:red;">
                                        <?php
                                        if (isset($errors) && $form_name == 'registration') {
                                            foreach ($errors as $error) {
                                                foreach ($error as $key => $item) {
                                                    if ($key == 'name') {
                                                        echo $item;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </span><br>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email Address">
                                    <span style="color:red;">
                                        <?php
                                        if (isset($errors) && $form_name == 'registration') {
                                            foreach ($errors as $error) {
                                                foreach ($error as $key => $item) {
                                                    if ($key == 'email') {
                                                        echo $item;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </span><br>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                    <span style="color:red;">
                                        <?php
                                        if (isset($errors) && $form_name == 'registration') {
                                            foreach ($errors as $error) {
                                                foreach ($error as $key => $item) {
                                                    if ($key == 'password') {
                                                        echo $item;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </span><br>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_again" id="password_again" tabindex="2"
                                           class="form-control" placeholder="Confirm Password">
                                    <span style="color:red;">
                                        <?php
                                        if (isset($errors) && $form_name == 'registration') {
                                            foreach ($errors as $error) {
                                                foreach ($error as $key => $item) {
                                                    if ($key == 'password_again') {
                                                        echo $item;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </span><br>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button type="button" name="submit" id="register-submit"
                                                    tabindex="4" class="form-control btn btn-register submit">
                                                Register Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    body {
        padding-top: 90px;
    }
</style>


<script src="/public/js/main.js"></script>
<script src="/public/js/validation.js"></script>

<script>
    $(document).ready(function () {
        var form_name = $('#form_name').val();
        if (form_name == 1) {
            setTimeout(function () {
                $('#login-form-link').click()
            })
        }

        if (form_name == 2) {
            setTimeout(function () {
                $('#register-form-link').click()
            })
        }
    })

    $('.submit').click(function () {
        rules = [
            ['username', 'required'],
            ['email', 'email'],
            ['password', 'required|min:6'],
            ['password_again', 'equal:password']
        ]

        validateForm($('#register-form'),rules);
    })


    $('.login_submit').click(function () {
        rules = [
            ['email','required'],
            ['password','required']
        ]

        validateForm($('#login-form'),rules);
    })


</script>




<script>

    $(function () {

        $('#login-form-link').click(function (e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function (e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });


</script>

</body>



