<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 03/08/2018
 * Time: 11:47
 */

namespace application\core;


class Validator
{
    public static $name;
    public static $email;
    public static $password;

    public function __construct(){
        $name = self::$name;
        $email = self::$email;
        $password = self::$password;
    }

    public static function validate(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_again = $_POST['password_again'];






        }
    }
}