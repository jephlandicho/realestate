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
            $sql = "SELECT *,
            CASE 
                WHEN verified = 1 THEN 'Verified'
                ELSE 'Not Verified'
            END as verification_status
            FROM seller_login;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function fetchCust(){
            $sql = "SELECT *,
            CASE 
                WHEN verified = 1 THEN 'Verified'
                ELSE 'Not Verified'
            END as verification_status
            FROM buyer_login;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function registerAdmin($Name, $Username, $Email, $Password,$Contact,$Image){
            $sql = "INSERT INTO admin_login (name, username, email, password,contact_num,image) VALUES (:name,:username,:email,:pass,:contact_num,:image)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name'=>$Name, 'username'=>$Username, 'email'=>$Email, 'pass'=>$Password,'contact_num'=>$Contact, 'image'=>$Image]);
            return true;
        }

        public function seller_exist($Username){
            $sql = "SELECT username FROM admin_login WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username'=>$Username]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result;
        }

                //check if the username is exist
        public function seller_email($email){
            $sql = "SELECT email FROM admin_login WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result;
        }
    }
?>