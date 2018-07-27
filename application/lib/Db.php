<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:21
 */

namespace application\lib;
use PDO;

class Db{
    private $host='localhost';
    private $db_name='mvc';
    private $username='root';
    private $password='';
    protected $db;

    public function __construct(){
        $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
    }

    public function query($sql){
        $query = $this->db->query($sql);
        $result =$query->fetchAll();

    }

    public function select($table){
        $sql = 'SELECT * FROM '.$table;
        $query = $this->db->query($sql);
        $result =$query->fetchAll();
        return $a =$result;
    }

    public function selectWhere($table,$column_name,$value){
        $sql = 'SELECT * FROM '.$table.' WHERE '.$column_name.'="'.$value.'"';
        $query = $this->db->query($sql);
        $result =$query->fetchAll();
        return $result;
    }

    public function insert($table,$data = []){
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

        $sql = $sql_first_part.$table.' ('.$sql_column_part.') VALUES('.$sql_values_part.')';
        $query = $this->db->query($sql);

        $this->select($table);

    }

    public function update($table, $updatable_colomn, $updatable_value, $find_column, $column_value){
        $sql = "UPDATE ".$table.' SET '.$updatable_colomn.'="'.$updatable_value.'" WHERE '.$find_column.'='.$column_value;
        $this->db->query($sql);
    }

    public function delete($table,$id){
        $sql = "DELETE FROM ".$table.' WHERE id='.$id;
        if($this->db->query($sql) == TRUE){
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->db->error;
        }
    }

    public function where($column_name,$eval_value){

    }


}