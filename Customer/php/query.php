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
            $sql = "SELECT seller_property.id, seller_property.title,seller_property.price,seller_property.type,seller_login.name,saved_property.date FROM `saved_property` INNER JOIN seller_property
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

        public function cust_email($email){
            $sql = "SELECT email FROM buyer_login WHERE email = :email"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }

        public function forgotPassword($code,$email){
            $sql = "UPDATE `buyer_login` SET code = :code WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':code' => $code,':email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return true;
        }

            // update new password
    public function update_password($pass,$email){
        $sql = "UPDATE `buyer_login` SET code = '', password=:password WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':password' => $pass,':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return true;
    }
    }
?>