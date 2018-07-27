<?php

namespace application\controllers;

use application\core\View;
use application\lib\Db;

class HomeController{

    public function index(){
        $db = new DB();

        $users = $db->select('users');

        View::render('index',$variables = ['users'=>$users]);
    }
}