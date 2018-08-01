<?php

namespace application\controllers;

use application\models\Users;

class AccountController{
    public function login(){
        echo 'login page';
    }

    public function registration(){



        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $err_messages = [];

        if(empty($name)){ $err_messages['empty_username'] = 'Your name field is empty!<br>';}
        if(empty($email)) {$err_messages['empty_email'] = 'Your email field is empty!<br>';}
        if(empty($password)) {$err_messages['empty_password'] = 'Your password field is empty!<br>';}

        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $err_messages['name'] = "Only letters and white space allowed" ;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err_messages['email'] = "Invalid email format" ;
        }

        if($password !== $confirm_password){
            $err_messages['password_confirmation'] = 'Your password and confirm password are not match! <br>';
        }

        if($err_messages !== []){
            setcookie('errors',serialize($err_messages),time()+36000,'/');
//            var_dump($_COOKIE);die;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        die;
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => crypt($password,''),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        Users::create($data);

    }

}