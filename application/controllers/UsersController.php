<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 26/07/2018
 * Time: 17:08
 */

namespace application\controllers;

use application\lib\Db;
use application\models\Users;

class UsersController
{
    public function createUser(){
        $name = $_POST['name'];
        $data = [
            'name' => $name,
            'email' => null,
            'password' => null,
        ];
        Users::create($data);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function updateUser(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $table = 'users';
        $db = new Db();
        $db->update($table,'name',$name,'id',$id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deleteUser(){
        $id = $_POST['id'];
        Users::safeDelete($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}