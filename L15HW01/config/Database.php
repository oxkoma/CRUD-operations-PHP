<?php

class Database {
    public $conn;

    // укажите свои учетные данные базы данных 
    private $host = "localhost";
    private $db_name = "l15hw01";
    private $username = "root";
    private $password = "root";

    // получаем соединение с БД 
    public function getConnection(){
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, 
                                    $this->username,
                                    $this->password    
                                );
            $this->conn->exec("set names utf8");                        
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}