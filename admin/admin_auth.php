<?php
session_start();
$client_username = $_SESSION['admin_name'];
if(!isset($client_username)){
   header('location:../login.php');
};
?>