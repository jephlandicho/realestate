<?php
session_start();
require_once 'query.php';
$conn = mysqli_connect("localhost", "root", "", "realestate");
$admin = new Admin();

// Login
if(isset($_POST['action']) && $_POST['action'] == 'sellerLogin'){
    // print_r($_POST);
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInAdmin = $admin->seller_login($username,$hpassword);

    $info = $admin->seller_info($username);
    $ID = $admin->seller_ID($username);

    if($loggedInAdmin != null){
        echo 'sellerLogin';
        $_SESSION['seller_username'] = $username;
        $_SESSION['seller_info'] = $info;
        $_SESSION['ID'] = $ID;
    }
    else{
        echo $admin->showMessage('Username or Password is Incorrect');
    }
}
// displaying properties 
if(isset($_POST['action']) && $_POST['action'] == 'fetchProperties'){
    $output = '';
    $data = $admin->fetchProperties(0);
    if($data){
        $output.= '<table class="table table-striped text-center" id="propertiesTable">
        <thead class=" text-primary">
        <th class="text-center"> Title </th>
        <th class="text-center"> Price </th>
        <th class="text-center"> SQM </th>
        <th class="text-center"> Type </th>
        <th class="text-center"> Approved </th>
        <th class="text-center"> Status </th>
        </thead>
        <tbody>';
foreach ($data as $row){
    $output .= '<tr>
            <td> '.$row['title'].' </td>
            <td> '.$row['price'].' </td>
            <td> '.$row['sqm'].' </td>
            <td> '.$row['type'].' </td>
            <td> '.$row['approved'].' </td>
            <td> '.$row['status'].' </td>
        </tr>';
}
    $output .= '</tbody>
    </table>';

    echo $output;
}

else{
    echo '<h3 class="text-center text-secondary"> PROPERTY NOT FOUND !! </h3>';
}

}



?>