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
                $pattern = $item['regex'];
                if(preg_match("~$pattern~", $this->url, $matches)){
                    $this->params = $item;
                    $massive = [];
                    foreach ($this->params['params'] as $key => $val){
                        $massive[$val] = $matches[$val];
                    }
                    $this->params['params'] = $massive;
                }
            }else{

                if(trim($_SERVER["REQUEST_URI"],'/') == $item['url']){
                    $this->params = $item;
                }
            }
        }
    }

    public function run(){
        $param_existing_status = 0;

        $action = $this->params['action'];
        $action_exploded = explode('@', $action);
        $controller = $action_exploded[0];
        $action = $action_exploded[1];
        $path = 'application\controllers\\'.ucfirst($controller);

        if(isset($this->params['params'])){
            $parameters = $this->params['params'];
            $param_existing_status = 1;
        }

        if(class_exists($path)){
            if(method_exists($path, $action)){
                $controller = new $path;
                if($param_existing_status == 1){
                    call_user_func_array([$controller, $action], $parameters);
                }else{
                    $controller->$action();
                }

            }else{
                echo 'Method ' .$action. ' does not exist !!! ';
            }
        }else{
            echo 'Controller ' .$controller. ' does not exist !!! ';
        }
        
    }
    
}
