<?php
use application\core\Router;
use application\lib\Db;
use application\core\View;

spl_autoload_register(function($class){
    $path = str_replace('\\','/',$class.'.php');
    if(file_exists($path)){
        require $path;
    }
});


session_start();
$router = new Router();
$db = new Db();
$router->run();


