<?php

namespace application\controllers;

use application\core\View;
use application\core\Db;
use application\models\Users;

class HomeController{

    public function index(){
        View::render('login_page',$variables = []);
    }

    public function usersPage(){
        $db = new DB();

        $users = Users::all();

        View::render('index',$variables = ['users'=>$users]);
    }
}