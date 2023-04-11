<?php
session_start();
require_once 'query.php';
$admin = new Admin();


// Login
if(isset($_POST['action']) && $_POST['action'] == 'customerLogin'){
    // print_r($_POST);
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInAdmin = $admin->seller_login($username,$hpassword);

    $info = $admin->seller_info($username);
    $ID = $admin->seller_ID($username);

    if($loggedInAdmin != null){
        echo 'customerLogin';
        $_SESSION['customer_username'] = $username;
        $_SESSION['cus_info'] = $info;
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
        <th class="text-center"> Type </th>
        <th class="text-center"> Agent </th>
        <th class="text-center"> Date </th>
        </thead>
        <tbody>';
foreach ($data as $row){
    $output .= '<tr>
            <td> '.$row['title'].' </td>
            <td> '.$row['price'].' </td>
            <td> '.$row['type'].' </td>
            <td> '.$row['name'].' </td>
            <td> '.$row['date'].' </td>
        </tr>';
}
    $output .= '</tbody>
    </table>';

    echo $output;
}

else{
    echo '<h3 class="text-center text-secondary"> NO SAVED PROPERTY !! </h3>';
}

}
?>