<?php

namespace application\controllers;

use application\core\View;

class HomeController{
    public function index(){
        View::render('index');
    }
}