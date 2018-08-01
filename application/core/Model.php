<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:21
 */
namespace application\core;

use application\lib\Db;
use application\models\Users;

class Model{

    protected static $db;

    private $host='localhost';
    private $db_name='mvc';
    private $username='root';
    private $password='';

    public function __construct(){
        self::$db = new \PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
    }

    public static function table_name() {
        $users = new Users();
        return $users->table;
    }


    public static function all(){
        $sql = "SELECT * FROM ".self::table_name().' WHERE deleted_at="'.'NULL'.'"';
        $query = self::$db->query($sql);
        $result =$query->fetchAll();
        return $result;

    }

    public static function where($column,$value){
        $sql = "SELECT * FROM ".self::table_name().' WHERE '.$column.'="'.$value.'"';
        $query = self::$db->query($sql);
        $result =$query->fetchAll();
        return $result;
    }

    public static function create($data){
        $sql_first_part = 'INSERT INTO ';
        $sql_column_part = '';
        $sql_values_part = '';
        foreach ($data as $key => $value){
            $sql_column_part .= ','.$key;
            $sql_values_part .= ','.$value;
            $sql_column_part = trim($sql_column_part, ',');
            $sql_values_part = trim($sql_values_part, ',');
        }
        $sql_values_part = str_replace(',','","',$sql_values_part);
        $sql_values_part = '"'.$sql_values_part.'"';

        $sql = $sql_first_part.self::table_name().' ('.$sql_column_part.') VALUES('.$sql_values_part.')';

        // Creating user to table
        $query = self::$db->query($sql);

        $last_id = self::$db->lastInsertId();

        return $last_id;

    }

    /**
     * @return \PDO
     */
    public static function find($id){
        $sql = "SELECT * FROM ".self::table_name().' WHERE id="'.$id.'"';
        $query = self::$db->query($sql);
        $objects =$query->fetchAll();

        if(count($objects) == 1){
            return $objects[0];
        }else{
            return $objects;
        }
    }

    public function softDelete(){

    }

    /**
     * @return \PDO
     */
    public static function update($search_column, $value, $data){

        $sql_first_part = 'UPDATE '.self::table_name().' SET ';
        $sql_second_part = '';
        $sql_third_part = ' WHERE '.$search_column.'="'.$value.'"';

        foreach ($data as $key => $item){
            $sql_second_part = $sql_second_part.','.$key.'="'.$item.'"';
        }
        $sql_second_part = ltrim($sql_second_part, ',');
        $sql = $sql_first_part.$sql_second_part.$sql_third_part;
        $query = self::$db->query($sql);

    }

    public static function safeDelete($id){
        $sql = 'UPDATE '.self::table_name().' SET deleted_at="'.date('Y-m-d H:i:s').'" WHERE id="'.$id.'"';
        $query = self::$db->query($sql);
    }

    public static function getLastUserId(){
        echo self::$db->query('insert_id');
    }
}