<?php
require_once 'config.php';

class Admin extends Database{
        // verify customer login
        public function seller_login($username, $password){
            $sql = "SELECT username,password FROM buyer_login WHERE username = :username AND password = :password"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username, 'password' => $password]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        // get seller information
        public function seller_info($username){
            $sql = "SELECT name FROM buyer_login WHERE username = :username"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        public function seller_ID($username){
            $sql = "SELECT id FROM buyer_login WHERE username = :username"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }
        
        public function fetchProperties(){
            $ID = $_SESSION['ID'];
            $user_ID = implode($ID);
            $sql = "SELECT seller_property.title,seller_property.price,seller_property.type,seller_login.name,saved_property.date FROM `saved_property` INNER JOIN seller_property
            ON saved_property.property_id = seller_property.id
            INNER JOIN buyer_login
            ON saved_property.customer_id = buyer_login.id
            INNER JOIN seller_login
            ON seller_property.seller_id = seller_login.id WHERE saved_property.customer_id = '$user_ID' ORDER BY date DESC;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>