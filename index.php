<?php
use application\core\Router;
use application\core\Db;
use application\core\View;

include 'application/config/constants.php';

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


