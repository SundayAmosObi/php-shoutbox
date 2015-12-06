<?php
    class Database {
        public function __construct(){
            $this->dbserver = 'localhost';
            $this->username = 'admin';
            $this->password = 'admin';
            $this->database = 'shoutboxdb';
            $this->db = new PDO("mysql:host=".$this->dbserver."; dbname=".$this->database, $this->username, $this->password);
        }
    }
 ?>
