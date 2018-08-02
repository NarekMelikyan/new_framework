<?php

namespace application\controllers;

use application\models\Users;

class AccountController{

    public function login(){

        $err_messages = [];


        $email  = $_POST['email'];
        $password = $_POST['password'];

        $user = Users::where('email',$email);

        if(empty($email)){ $err_messages['login_empty_email'] = 'Your email field is empty!<br>';}
        if(empty($password)) {$err_messages['login_empty_password'] = 'Your password field is empty!<br>';}


        if($user){
            if(password_verify($password,$user[0]['password'])){
                session_start();
                $_SESSION['email'] = $email;
                setcookie('user',$email,time()+3600,'/');
                header("Location: users-page");
            }else{
                $err_messages['login_error'] = 'Email or password are wrong !';
                setcookie('errors',serialize($err_messages),time()+1,'/');
                header("Location: /");
            }
        }else{
            setcookie('errors',serialize($err_messages),time()+1,'/');
            header("Location: /");
        }
$a = 1;
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
            setcookie('errors',serialize($err_messages),time()+1,'/');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => crypt($password,''),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $last_id = Users::create($data);

        $user = Users::where('id',$last_id);


        session_start();
        $_SESSION['email'] = $data['email'];
        setcookie('user',$data['email'],time()+3600,'/');
        header("Location: users-page");

    }


    public function logout(){
        session_destroy();
        header("Location: users-page");
    }

}