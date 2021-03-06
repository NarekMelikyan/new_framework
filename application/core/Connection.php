<?php
/**
 * Created by PhpStorm.
 * User: Tigranakert
 * Date: 07/08/2018
 * Time: 14:26
 */

namespace application\core;


class Connection
{
    private $connection;
    private static $instance; //The single instance

    private function __construct() {
        $this->connection = new \PDO('mysql:host=' . constant('DB_HOST') . ';dbname=' . constant('DB_DATABASE'), constant('DB_USERNAME'), constant('DB_PASSWORD'));
    }

    /*
	Get an instance of the Database
	@return Instance
	*/
    public static function getInstance() {
        if(!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }

    public function getConnection() {
        return $this->connection;
    }


}