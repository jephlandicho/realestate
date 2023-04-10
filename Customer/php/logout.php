<?php

session_start();
unset($_SESSION['customer_username']);
header('location:../index.php');

?>