<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:21
 */

namespace application\core;

class View{

    static $view_base_path= '';

    public static function render($file, $variables = []) {

        self::$view_base_path = 'application/views/';
        require_once self::$view_base_path.$file.'.php';
        return $variables;

    }
}