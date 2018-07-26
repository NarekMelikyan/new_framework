<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 25/07/2018
 * Time: 09:04
 */

namespace application\controllers;

class BookController{

    public function get_book($param1,$param2,$param3){
        echo 'This method parameters are : '. $param1 . ' , ' . $param2 . ' , ' . $param3;
    }

    public function show_all_books(){
        echo 'This is all books list';
    }
}