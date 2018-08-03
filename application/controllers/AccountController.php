<?php

namespace application\controllers;

use application\core\Validator;
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
    }

    public function registration(){

        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_again = $_POST['password_again'];

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_again' => $password_again
        ];

        $validation = Validator::validate($data,[
            'name' => 'required',
            'email' => 'email',
            'password' => 'required|min:6',
            'password_again' => 'equal:password'
        ]);

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