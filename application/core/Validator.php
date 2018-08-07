<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 03/08/2018
 * Time: 11:47
 */

namespace application\core;


use application\models\Users;

class Validator
{
    public static $name;
    public static $email;
    public static $password;
    public static $password_again;
    public static $errors = [];


    public static $data;



    public static function validate($data, $roles){

        foreach ($data as $key => $value) {
            // $value == John , john@gmail.com          , 123456  , 123456
            // $key   == name  , email                  , password, password_again

            $role_row = $roles[$key];
            if (strpos($role_row, '|') == true) {
                $role_row = explode('|', $role_row);
                foreach ($role_row as $item) {
                    if ($item == 'required') {
                        if (self::requiredCheck($value) == false) {
                            self::$errors[] = [$key => 'The field ' . $key . ' is required !'];
                        }
                    }

                    if ($item == 'email') {
                        if(strlen($value) > 0){
                            if (self::emailCheck($value) == false) {
                                self::$errors[] = [$key => 'Your ' . $key . ' is not valid !'];
                            }
                        }else{
                            self::$errors[] = [$key => 'The field ' . $key . ' is required !'];
                        }
                    }

                    if (substr($item, 0, 3) == 'min' && self::requiredCheck($value) == true) {
                        $min_lenght_role = explode(':', $item);
                        if (self::checkMinLength($value, $min_lenght_role[1]) == false) {
                            self::$errors[] = [ $key => 'Your ' . $key . ' field length must be minimum ' . $min_lenght_role[1] .' !' ];
                        }
                    }

                    if (substr($item, 0, 5) == 'equal') {
                        $equal_condition = explode(':', $item);
                        if (self::equalCondition($value, $data[$equal_condition[1]]) == false) {
                            self::$errors[] = [ $key => 'Your ' . $equal_condition[1] . ' and ' . $key . ' fields are not match !'];
                        }
                    }

                    if($item == 'unique'){
                        $user = Users::where('email',$value);
                        if ($user) {
                            self::$errors[] = [ $key => 'User with email ' . $value . ' already exist ! '];
                        }
                    }


                }
            } else {
                if ($role_row == 'required') {
                    if (self::requiredCheck($value) == false) {
                        self::$errors[] = [ $key => 'The field ' . $key . ' is required !'];
                    }
                }

                if ($role_row == 'email') {
                    if(strlen($value) > 0){
                        if (self::emailCheck($value) == false) {
                            self::$errors[] = [ $key => 'Your ' . $key . ' is not valid !'];
                        }
                    }else{
                        self::$errors[] = [ $key => 'The field ' . $key . ' is required !'];
                    }
                }

                if (substr($role_row, 0, 3) == 'min' && self::requiredCheck($value) == true) {
                    $min_lenght_role = explode(':', $role_row);
                    if (self::checkMinLength($value, $min_lenght_role[1]) == true) {
                        self::$errors[] = [ $key => 'Your ' . $key . ' field length must be minimum ' . $min_lenght_role[1] .' !'];
                    }
                }

                if (substr($role_row, 0, 5) == 'equal') {
                    $equal_condition = explode(':', $role_row);
                    if (self::equalCondition($value, $data[$equal_condition[1]]) == false) {
                        self::$errors[] = [ $key => 'Your ' . $equal_condition[1] . ' and ' . $key . ' fields are not match !'];
                    }
                }

                if($role_row == 'unique'){
                    $user = Users::where('email',$value);
                    if ($user) {
                        self::$errors[] = [ $key => 'User with email ' . $value . ' already exist ! '];
                    }
                }

            }
        }


        if (self::$errors !== []) {
            setcookie('errors',serialize(self::$errors),time()+1,'/');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }else {
            return true ;
        }
    }

    private static function emailCheck($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    private static function requiredCheck($str)
    {
        if (strlen($str)) {
            return true;
        } else {
            return false;
        }
    }

    private static function checkMinLength($str, $min_length)
    {
        if (strlen($str) >= $min_length) {
            return true;
        } else {
            return false;
        }
    }

    private static function equalCondition($str, $value)
    {
        if(hash_equals($str,$value)) {
            return true;
        } else {
            return false;
        }
    }


}