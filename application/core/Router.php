<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:21
 */

namespace application\core;

class Router{

    protected $routes = [];
    protected $params = [];

    public function __construct(){
        $array = require 'application/config/routes.php';
        foreach ($array as $key => $item) {
            $this->add($key, $item);
        }

    }

    public function add($route, $params){
        $this->routes[$route] = $params;
    }

    public function match(){
        $url = trim($_SERVER['REQUEST_URI'],'/');

        $arr = [];
        foreach ($this->routes as $key => $item){
            $arr [$item['method']][$key] = $item;
        }
        foreach ($arr as $key => $item){
            if($_SERVER['REQUEST_METHOD'] == $key){
                foreach ($item as $url_info){
                    $route = $url_info['url'];
                    if($url == $route){
                        $this->params = $url_info;
                        return true;
                    }
                }
                return false;
            }
        }
    }

    public function run(){
        if($this->match()){
            $action = $this->params['action'];
            $action_exploded = explode('@',$action);
            $controller = $action_exploded[0];
            $action = $action_exploded[1];
            $path = 'application\controllers\\'.ucfirst($controller);
            if(class_exists($path)){
                if(method_exists($path,$action)){
                    $controller = new $path;
                    $controller->$action();
                }else{
                    echo 'Action '. $action . 'does not exist !! ';
                }
            }else{
                echo 'Class '.$path.' not exist';
            }
        }
    }


//    public function makeRegex(){
//        $str_explode = explode('/', $_SERVER['REQUEST_URI']);
//        $regUrl = '~';
//        foreach ($str_explode as $item) {
//            $pattern = '~\{(\w+)\}~';
//            if (preg_match($pattern, $item)) {
//                $regUrl .=  "\/(?P<$item>[^\/]+)";
//            } else {
//                $regUrl .= '\/' . $item;
//            }
//        }
//
//        $regUrl . '~';
//        $this->regex = $regUrl;
//    }
}