<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:20
 */

return [
    [
        'url' => '/',
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
        'action' => "BooksController@get_book"
    ],
    [
        'url' => 'get_book/{book_id}/{aaa}',
        'method' => 'GET',
        'action' => "BooksController@get_book",
    ],

];



