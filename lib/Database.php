<?php
/**
 * Created by  jibon Bikash Roy.
 * User: jibon
 * Date: 8/29/20
 * Time: 9:43 PM
 * Copyright jibon <jibon.bikash@gmail.com>
 */

    class Database {
        private $host = "127.0.0.1";
        private $database_name = "ForeignCurrency";
        private $username = "admin";
        private $password = "123456";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>