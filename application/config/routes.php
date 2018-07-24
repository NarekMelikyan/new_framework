<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:20
 */

//return [
//    '' => [
//        'controller' => 'Home',
//        'action' => 'index'
//    ],
//    '/' => [
//        'controller' => 'Home',
//        'action' => 'index'
//    ],
//    'account/login' => [
//        'controller' => 'Account',
//        'action' => 'login'
//        ],
//    'account/registration' => [
//        'controller' => 'Account',
//        'action' => 'registration'
//    ],
//];





return [
    [
        'url'=>'/',
        'method'=>'GET',
        'action'=>"HomeController@index"
    ],
    [
        'url'=>'account/login',
        'method'=>'GET',
        'action'=>"AccountController@login"
    ],
    [
        'url'=>'account/login',
        'method'=>'POST',
        'action'=>"AccountController@login"
    ],
    [
        'url'=>'account/registration',
        'method'=>'GET',
        'action'=>"AccountController@registration"
    ],
];



