<?php
require_once 'config.php';

class Admin extends Database{
        // verify seller login
        public function seller_login($username, $password){
            $sql = "SELECT username,password FROM seller_login WHERE username = :username AND password = :password"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username, 'password' => $password]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        // get seller information
        public function seller_info($username){
            $sql = "SELECT name FROM seller_login WHERE username = :username"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        public function seller_ID($username){
            $sql = "SELECT id FROM seller_login WHERE username = :username"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        public function addProperty($property_id,$photos){
            $sql = "INSERT INTO seller_property_photos (property_id, photos) VALUES (:property_id,:photos)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['property_id'=>$property_id, 'photos'=>$photos]);
            return true;
        }

        public function fetchProperties(){
            $ID = $_SESSION['ID'];
            $user_ID = implode($ID);
            $sql = "SELECT seller_property.id, `title`, `price`, `sqm`, `type`, `approved`, `status`
            FROM seller_property
            INNER JOIN seller_login as sl
            ON seller_property.seller_id = sl.id WHERE seller_id = '$user_ID' ORDER BY date DESC;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }
?>