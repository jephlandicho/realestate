<?php
session_start();
require_once 'query.php';
$admin = new Admin();

// Login
if(isset($_POST['action']) && $_POST['action'] == 'adminLogin'){
    // print_r($_POST);
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInAdmin = $admin->admin_login($username,$hpassword);

    $info = $admin->admin_info($username);

    if($loggedInAdmin != null){
        echo 'admin_login';
        $_SESSION['username'] = $username;
        $_SESSION['info'] = $info;
    }
    else{
        echo $admin->showMessage('Username or Password is Incorrect');
    }
}
//adding seller account 
if(isset($_POST['action']) && $_POST['action'] == 'registerSeller'){
    $name = $admin->test_input($_POST['name']);
    $username = $admin->test_input($_POST['username']);
    $email = $admin->test_input($_POST['email']);
    $pass = $admin->test_input($_POST['password']);
    $address = $admin->test_input($_POST['address']);
    $contact = $admin->test_input($_POST['contact']);
    $image = $_FILES['image'];
    $hpass = sha1($pass);

    if ($image['error'] !== UPLOAD_ERR_OK) {
        echo $admin->showMessage('Error uploading profile picture!');
    }
    else if($admin->seller_exist($username)){
        echo $admin->showMessage('This username is already exist!!!');
    }
    else if($admin->seller_email($email)){
        echo $admin->showMessage('This email is already exist');
    }
    else{
        $filename = uniqid() . '-' . basename($image['name']);
        $destination = '../../uploads/' . $filename;
        move_uploaded_file($image['tmp_name'], $destination);
        if($admin->registerSeller($name,$username,$email,$hpass,$address,$contact,$filename)){
            echo 'registerSeller';
        }
        else{
            echo $admin->showMessage('Something went wrong! Try again later');
        }
    }
    
}

//adding buyer account 
if(isset($_POST['action']) && $_POST['action'] == 'registerBuyer'){
    $name = $admin->test_input($_POST['name']);
    $username = $admin->test_input($_POST['username']);
    $email = $admin->test_input($_POST['email']);
    $pass = $admin->test_input($_POST['password']);
    $address = $admin->test_input($_POST['address']);
    $contact = $admin->test_input($_POST['contact']);
    $image = $_FILES['image'];
    $hpass = sha1($pass);

    if ($image['error'] !== UPLOAD_ERR_OK) {
        echo $admin->showMessage('Error uploading profile picture!');
    }
    else if($admin->buyer_exist($username)){
        echo $admin->showMessage('This username is already exist!!!');
    }
    else if($admin->buyer_email($email)){
        echo $admin->showMessage('This email is already exist');
    }
    else{
        $filename = uniqid() . '-' . basename($image['name']);
        $destination = '../../uploads/' . $filename;
        move_uploaded_file($image['tmp_name'], $destination);
        if($admin->registerBuyer($name,$username,$email,$hpass,$address,$contact,$filename)){
            echo 'registerBuyer';
        }
        else{
            echo $admin->showMessage('Something went wrong! Try again later');
        }
    }

}

?>