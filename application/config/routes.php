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
        'url' => '/users-page',
        'method' => 'GET',
        'action' => "HomeController@usersPage"
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
        'method' => 'POST',
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
    [
        'url' => 'create_new_user',
        'method' => 'POST',
        'action' => 'UsersController@createUser'
    ],
    [
        'url' => 'update_username',
        'method' => 'POST',
        'action' => 'UsersController@updateUser'
    ],
    [
        'url' => 'delete_user',
        'method' => 'POST',
        'action' => 'UsersController@deleteUser'
    ]
];



