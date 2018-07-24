<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:20
 */

return [
    '' => [
        'controller' => 'Home',
        'action' => 'index'
    ],
    '/' => [
        'method'=>'get',
        'controller' => 'Home',
        'action' => 'index'
    ],
    'account/login' => [
        'controller' => 'Account',
        'action' => 'login'
        ],
    'account/registration' => [
        'controller' => 'Account',
        'action' => 'registration'
    ],[
        'url'=> '/photos',

    ]
];

