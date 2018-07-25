<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:21
 */

namespace application\core;

class Router{


    protected $url ='';
    protected $routes = [];
    protected $params = [];
    protected $param  = [];
    protected $method = '';

    public function __construct(){
        $this->method = isset($_REQUEST['_method']) ? $_REQUEST['_method'] : $_SERVER['REQUEST_METHOD'];
        $this->url = trim($_SERVER['REQUEST_URI'],'/');
        $array = require 'application/config/routes.php';
        foreach ($array as $key => $item) {
            $this->collect($item, $item['method']);
        }
        $this->match();
    }

    public function collect($item, $method)
    {
        preg_match_all('/{[\w]+}/', $item['url'], $matches);

        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }

        if (count(current($matches))) {
            list($regex, $params) = $this->generate(current($matches), $item['url']);
            $item['regex'] = $regex;
            $item['params'] = $params;
        }

        $this->routes[$method][] = $item;
    }

    public function generate($matches, $url)
    {
        $params = [];
        foreach ($matches as $match) {
            $params[] = trim($match, '{}');
            $url = str_replace($match, sprintf('(?P<%s>[\w]+)', preg_replace('/\{|\}/', '', $match)), $url);
        }
        $url = preg_replace('~/~','\/',$url);
        return ["^$url$", $params];
    }

    public function add($route, $params){
        $this->routes[$route] = $params;
    }

    public function match(){

        if(!isset($this->routes[$this->method])){
            echo 'Method not allowed';
            die;
        }

        foreach ($this->routes[$this->method] as $item) {
            if(isset($item['regex'])){
                $pattern = $item['regex'].'';     /////////////////////////////////////////////////////
                if(preg_match("~$pattern~", $this->url)){
//                    var_dump($item['regex']);die;
//                    if(preg_match($item['regex'],$i)){
//                        var_dump($this->url);die;
//                    }else{
//                        var_dump(0);die;
//                    }
                }
            }else{

            }
        }

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


    public function makeRegex(){
        $str_explode = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

        $regUrl = '~';
        foreach ($str_explode as $item) {
            $pattern = '~\{(\w+)\}~';
            if (preg_match($pattern, $item)) {
                $regUrl .=  "\/(?P<$item>[^\/]+)";
            } else {
                $regUrl .= '\/' . $item;
            }
        }

        $regUrl . '~';
        $url = $regUrl;

        $this->url = $url;
        echo $this->url;
    }
}