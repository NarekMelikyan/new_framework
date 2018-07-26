<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:20
 */

return [
    [
        'url' => '',
        'method' => 'GET',
        'action' => "HomeController@index"
    ],
    [
        'url' => 'account/login',
        'method' => 'GET',
        'action' => "AccountController@login"
    ],
    [
        'url' => 'account/login',
        'method' => 'POST',
        'action' => "AccountController@login"
    ],
    [
        'url' => 'account/registration',
        'method' => 'GET',
        'action' => "AccountController@registration"
    ],
    [
        'url' => 'get_book/all',
        'method' => 'GET',
        'action' => "BookController@show_all_books"
    ],
    [
        'url' => 'get_book/{book_id}/{param2}/{param3}',
        'method' => 'GET',
        'action' => "BookController@get_book",
    ],

];



