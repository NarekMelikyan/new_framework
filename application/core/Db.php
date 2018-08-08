<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 24/07/2018
 * Time: 11:21
 */

namespace application\core;

class Db{

    public $db = '';

    public function __construct(){
        $conn = Connection::getInstance()->getConnection();
        $this->db = $conn;
    }

    public function query($sql){
        $query = $this->db->query($sql);
        $result =$query->fetchAll();
    }

    public function select($table){
        $sql = 'SELECT * FROM ' . $table . ' WHERE deleted_at="0"';
        $query = $this->db->query($sql);
        $result = $query->fetchAll();
        return $a = $result;
    }

    public function selectWhere($table,$column_name,$value){
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $column_name . '="' . $value . '"';
        $query = $this->db->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public function insert($table,$data = []){
        $sql_first_part = 'INSERT INTO ';
        $sql_column_part = '';
        $sql_values_part = '';

        foreach ($data as $key => $value){
            $sql_column_part .= ',' . $key;
            $sql_values_part .= ',' . $value;
            $sql_column_part = trim($sql_column_part, ',');
            $sql_values_part = trim($sql_values_part, ',');
        }
        $sql_values_part = str_replace(',','","',$sql_values_part);
        $sql_values_part = '"' . $sql_values_part . '"';

        $sql = $sql_first_part . $table . ' (' . $sql_column_part . ') VALUES(' . $sql_values_part . ')';
        $query = $this->db->query($sql);

        $this->select($table);
    }

    public function update($table, $updatable_colomn, $updatable_value, $find_column, $column_value){
        $sql = "UPDATE " . $table . ' SET ' . $updatable_colomn . '="'.$updatable_value . '" WHERE ' . $find_column . '=' . $column_value;
        $this->db->query($sql);
    }

    public function safeDelete($table,$id){
        $sql = 'UPDATE ' . $table . ' SET deleted_at="' . date('Y-m-d H:i:s') . '" WHERE id="' . $id . '"';
        $query = $this->db->query($sql);
    }



}