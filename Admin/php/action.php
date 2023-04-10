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

// displaying properties posted
if(isset($_POST['action']) && $_POST['action'] == 'fetchPosted'){
    $output = '';
    $data = $admin->fetchPosted(0);
    if($data){
        $output.= '<table class="table table-striped text-center" id="postedTable">
        <thead class=" text-primary">
        <th class="text-center"> Title </th>
        <th class="text-center"> Price </th>
        <th class="text-center"> SQM </th>
        <th class="text-center"> Type </th>
        <th class="text-center"> Location </th>
        <th class="text-center"> Status </th>
        </thead>
        <tbody>';
foreach ($data as $row){
    $output .= '<tr>
            <td> '.$row['title'].' </td>
            <td> '.$row['price'].' </td>
            <td> '.$row['sqm'].' </td>
            <td> '.$row['type'].' </td>
            <td> '.$row['location'].' </td>
            <td> '.$row['status'].' </td>
        </tr>';
}
    $output .= '</tbody>
    </table>';

    echo $output;
}

else{
    echo '<h3 class="text-center text-secondary"> POSTED PROPERTY NOT FOUND !! </h3>';
}

}

// displaying admin account
if(isset($_POST['action']) && $_POST['action'] == 'fetchAdmin'){
    $output = '';
    $data = $admin->fetchAdmin(0);
    if($data){
        $output.= '<table class="table table-striped text-center" id="adminTable">
        <thead class=" text-primary">
        <th class="text-center"> Name </th>
        <th class="text-center"> Email </th>
        <th class="text-center"> Username </th>
        <th class="text-center"> Address </th>
        <th class="text-center"> Contact Number </th>
        </thead>
        <tbody>';
foreach ($data as $row){
    $output .= '<tr>
            <td> '.$row['name'].' </td>
            <td> '.$row['email'].' </td>
            <td> '.$row['username'].' </td>
            <td> '.$row['address'].' </td>
            <td> '.$row['contact_num'].' </td>
        </tr>';
}
    $output .= '</tbody>
    </table>';

    echo $output;
}

else{
    echo '<h3 class="text-center text-secondary"> ADMIN ACCOUNTS NOT FOUND !! </h3>';
}

}

if(isset($_POST['action']) && $_POST['action'] == 'fetchSeller'){
    $output = '';
    $data = $admin->fetchSeller(0);
    if($data){
        $output.= '<table class="table table-striped text-center" id="sellerTable">
        <thead class=" text-primary">
        <th class="text-center"> Name </th>
        <th class="text-center"> Email </th>
        <th class="text-center"> Username </th>
        <th class="text-center"> Address </th>
        <th class="text-center"> Contact Number </th>
        </thead>
        <tbody>';
foreach ($data as $row){
    $output .= '<tr>
            <td> '.$row['name'].' </td>
            <td> '.$row['email'].' </td>
            <td> '.$row['username'].' </td>
            <td> '.$row['address'].' </td>
            <td> '.$row['contact_num'].' </td>
        </tr>';
}
    $output .= '</tbody>
    </table>';

    echo $output;
}

else{
    echo '<h3 class="text-center text-secondary"> SELLER ACCOUNTS NOT FOUND !! </h3>';
}

}

if(isset($_POST['action']) && $_POST['action'] == 'fetchCust'){
    $output = '';
    $data = $admin->fetchCust(0);
    if($data){
        $output.= '<table class="table table-striped text-center" id="custTable">
        <thead class=" text-primary">
        <th class="text-center"> Name </th>
        <th class="text-center"> Email </th>
        <th class="text-center"> Username </th>
        <th class="text-center"> Address </th>
        <th class="text-center"> Contact Number </th>
        </thead>
        <tbody>';
foreach ($data as $row){
    $output .= '<tr>
            <td> '.$row['name'].' </td>
            <td> '.$row['email'].' </td>
            <td> '.$row['username'].' </td>
            <td> '.$row['address'].' </td>
            <td> '.$row['contact_num'].' </td>
        </tr>';
}
    $output .= '</tbody>
    </table>';

    echo $output;
}

else{
    echo '<h3 class="text-center text-secondary"> CUSTOMER ACCOUNTS NOT FOUND !! </h3>';
}

}
?>