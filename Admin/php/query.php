<?php
require_once 'config.php';

class Admin extends Database{
        // verify admin login
        public function admin_login($username, $password){
            $sql = "SELECT username,password FROM admin_login WHERE username = :username AND password = :password"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username, 'password' => $password]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        // get admin information
        public function admin_info($username){
            $sql = "SELECT name FROM admin_login WHERE username = :username"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        public function fetchPosted(){
            $sql = "SELECT `title`, `price`, `sqm`, `type`, `location`,`status`,`date` FROM `seller_property` WHERE `approved` = 'Yes' ORDER BY date DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function fetchAdmin(){
            $sql = "SELECT * FROM `admin_login`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function fetchSeller(){
            $sql = "SELECT * FROM `seller_login`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function fetchCust(){
            $sql = "SELECT * FROM `buyer_login`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>