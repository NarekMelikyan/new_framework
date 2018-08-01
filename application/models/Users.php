<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 27/07/2018
 * Time: 11:40
 */


namespace application\models;


use application\core\Model;

class Users extends Model {

    public $table = 'users';

    protected $fillable = ['name'];

}