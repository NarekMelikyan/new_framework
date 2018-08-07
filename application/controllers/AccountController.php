<?php

namespace application\controllers;

use application\core\Validator;
use application\models\Users;

class AccountController{

    public function login(){
        $err_messages = [];
        $email  = $_POST['email'];
        $password = $_POST['password'];

        setcookie('form_name','login',time()+1,'/');


        $data = [
            'email' => $email,
            'password' => $password
        ];

        $validator = Validator::validate($data,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = Users::where('email',$email);
        if($user){
            if(password_verify($password,$user[0]['password']) && $data['email'] == $user[0]['email']){
                session_start();
                $_SESSION['email'] = $email;
                setcookie('user',$email,time()+3600,'/');
                header("Location: users-page");
            }else{
                setcookie('user_does_not_exist','Please check email and password !',time()+1,'/');
                header("Location: /");
            }
        }else{
            setcookie('user_does_not_exist','Please check email and password !',time()+1,'/');
            setcookie('errors',serialize($err_messages),time()+1,'/');
            header("Location: /");
        }
    }

    public function registration(){

        setcookie('form_name','registration',time()+1,'/');

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

        $validation = Validator::validate($data, [
            'name' => 'required',
            'email' => 'email|unique',
            'password' => 'required|min:6',
            'password_again' => 'equal:password'
        ]);

        $last_id = Users::create($data);

        $user = Users::where('id', $last_id);

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