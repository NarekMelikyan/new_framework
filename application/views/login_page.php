<!DOCTYPE html>
<head>
    <title>My MVC</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="/public/css/main.css" type="text/css" rel="stylesheet">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/public/js/validate.min.js"></script>
</head>
<body>

<!------ Include the above in your HEAD tag ---------->


<?php

if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}

if (isset($_SESSION['email']))
    header('Location: account/users-page')
?>
<div class="container">
    <?php
        if(isset($errors)){
            echo '<div class="alert alert-danger">';
            foreach ($errors as $error){
                echo ' '. $error .'<br>';
            }
            echo '</div>';
        }

    ?>
</div>
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
                                <!--                                <span style="color: red" id="login_email_error">-->
                                <!--                                    --><?php
                                //                                    if (isset($errors) && !isset($errors['login_empty_email'])) {
                                //                                        if (isset($errors['login_error'])) {
                                //                                            echo $errors['login_error'];
                                //                                        }
                                //                                    }
                                //
                                //                                    ?>
                                <!--                                </span>-->
                                <div class="form-group">
                                    <input type="text" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email" value="">
                                    <!--                                    <span style="color:red;">-->
                                    <!--                                        --><?php
                                    //                                        if (isset($errors)) {
                                    //                                            if (isset($errors['login_empty_email'])) {
                                    //                                                echo $errors['login_empty_email'];
                                    //                                            }
                                    //                                        }
                                    //                                        ?>
                                    <!--                                    </span><br>-->
                                    <span id="login_password_error" style="color: red"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                    <!--                                    <span style="color:red;">-->
                                    <!--                                        --><?php
                                    //                                        if (isset($errors)) {
                                    //                                            if (isset($errors['login_empty_password'])) {
                                    //                                                echo $errors['login_empty_password'];
                                    //                                            }
                                    //                                        }
                                    //                                        ?>
                                    <!--                                    </span>-->
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="account/registration" method="post" role="form"
                                  style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username" value="">
                                    <!--                                    <span style="color: red">-->
                                    <!--                                        --><?php
                                    //                                        if (isset($errors)) {
                                    //                                            if (isset($errors['empty_username'])) {
                                    //                                                echo $errors['empty_username'];
                                    //                                            } elseif (isset($errors['name'])) {
                                    //                                                echo $errors['name'];
                                    //                                            }
                                    //                                        }
                                    //                                        ?><!--</span>-->
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email Address" value="">
                                    <!--                                    <span style="color: red">-->
                                    <!--                                        --><?php
                                    //                                        if (isset($errors)) {
                                    //                                            if (isset($errors['empty_email'])) {
                                    //                                                echo $errors['empty_email'];
                                    //                                            } elseif (isset($errors['email'])) {
                                    //                                                echo $errors['email'];
                                    //                                            }
                                    //                                        }
                                    //                                        ?>
                                    <!--                                    </span>-->
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                    <!--                                    <span style="color: red">-->
                                    <!--                                    --><?php
                                    //                                    if (isset($errors)) {
                                    //                                        if (isset($errors['empty_password'])) {
                                    //                                            echo $errors['empty_password'];
                                    //                                        } elseif (isset($errors['password_confirmation'])) {
                                    //                                            echo $errors['password_confirmation'];
                                    //                                        }
                                    //                                    }
                                    //                                    ?>
                                    <!--                                    </span>-->
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_again" id="password_again" tabindex="2"
                                           class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit"
                                                   tabindex="4" class="form-control btn btn-register"
                                                   value="Register Now">
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

<script>

    $(function () {

        $('#login-form-link').click(function (e) {
            $('#login-form #pass').attr('id', 'password');
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function (e) {
            $('#login-form #password').attr('id', 'pass');
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });


</script>

</body>



