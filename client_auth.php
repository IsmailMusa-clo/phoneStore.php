<?php
session_start();
$client_username = $_SESSION['user_name'];
if(!isset($client_username)){
   header('location:login.php');
};
?>