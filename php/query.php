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

        
    // add seller account
    public function registerSeller($Name, $Username, $Email, $Password,$Address,$Contact,$Image){
        $sql = "INSERT INTO seller_login (name, username, email, password,address,contact_num,image) VALUES (:name,:username,:email,:pass,:address,:contact_num,:image)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name'=>$Name, 'username'=>$Username, 'email'=>$Email, 'pass'=>$Password,'address'=>$Address, 'contact_num'=>$Contact, 'image'=>$Image]);
        return true;
    }

        //check if the username is exist
        public function seller_exist($Username){
            $sql = "SELECT username FROM seller_login WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username'=>$Username]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result;
        }

                //check if the username is exist
        public function seller_email($email){
            $sql = "SELECT email FROM seller_login WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result;
        }

            // add buyer account
    public function registerBuyer($Name, $Username, $Email, $Password,$Address,$Contact,$Image){
        $sql = "INSERT INTO buyer_login (name, username, email, password,address,contact_num,image) VALUES (:name,:username,:email,:pass,:address,:contact_num,:image)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name'=>$Name, 'username'=>$Username, 'email'=>$Email, 'pass'=>$Password,'address'=>$Address, 'contact_num'=>$Contact, 'image'=>$Image]);
        return true;
    }

        //check if the username is exist
        public function buyer_exist($Username){
            $sql = "SELECT username FROM buyer_login WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username'=>$Username]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result;
        }

        public function buyer_email($email){
            $sql = "SELECT email FROM buyer_login WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result;
        }

    }
?>