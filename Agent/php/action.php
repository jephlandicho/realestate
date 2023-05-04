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
        <th class="text-center"> Actions </th>
        </thead>
        <tbody>';
foreach ($data as $row){
    $buttonClass = 'btn-primary';
    $buttonDisabled = '';
    $cursorStyle = '';
    $btnDis = '';
    if ($row['status'] == 'Sold') {
        $buttonClass = 'btn-success';
        $buttonDisabled = 'disabled';
        $btnDis = 'disabled';
    }
    if ($row['approved'] == 'No'){
        $buttonDisabled = 'disabled';
    }

    $output .= '<tr>
            <td> '.$row['title'].' </td>
            <td> '.$row['price'].' </td>
            <td> '.$row['sqm'].' </td>
            <td> '.$row['type'].' </td>
            <td> '.$row['approved'].' </td>
            
            <td> <button onclick="location.href=\'status.php?id='.$row['id'].'\'" class="btn '.$buttonClass.'" '.$buttonDisabled.'> '.$row['status'].' </button> </td>
            <td> <button class="btn btn-info text-white" onclick="location.href=\'edit-property.php?id='.$row['id'].'\'" '.$btnDis.'> <i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" onclick="location.href=\'delete.php?id='.$row['id'].'\'" '.$btnDis.'> <i class="fas fa-trash-alt"></i> </button> </td>
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