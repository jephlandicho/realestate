<?php

session_start();
unset($_SESSION['seller_username']);
header('location:../index.php');

?>