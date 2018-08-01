<?php

namespace application\controllers;

use application\core\View;
use application\lib\Db;
use application\models\Users;

class HomeController{

    public function index(){
        unset($_COOKIE['errors']);
        View::render('login_page',$variables = []);
    }

    public function loginCheck(){

    }

    public function usersPage(){

        $db = new DB();

        $users = $db->select('users');

        View::render('index',$variables = ['users'=>$users]);
    }
}