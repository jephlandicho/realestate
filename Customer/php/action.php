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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$mail = new PHPMailer(true);
// handle forgot password ajax requests
if(isset($_POST['action']) && $_POST['action'] == 'forgotpass'){

    $email = $admin->test_input($_POST['email']);

    $user_found = $admin->cust_email($email);

    if($user_found != null){
        $code = rand(999999, 111111);
        $code = str_shuffle($code);

        $admin->forgotPassword($code, $email);

        try{
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'landichojehosaphat@gmail.com';
            $mail->Password = 'vgilenumidpjorop';

            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('landichojehosaphat@gmail.com','Lupa Bahay');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body = '<h3> Enter the code below to reset your password <br> Code:&nbsp; '.$code.' <br> Regards <br> lupabahay.online </h3>';
            $mail->send();
            echo $admin->showMessage('We have send you the code to reset your password in your email, please check your email <a href="reset-code.php?email='.$email.'"> Enter Code here </a>');

        }
        catch(Exception $e){
            echo $admin->showMessage('Something went wrong, please try again');
        }
    }
    else{
        echo $admin->showMessage('This email is not registered');
    }
}
?>