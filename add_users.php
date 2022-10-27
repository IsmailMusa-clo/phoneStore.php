<?php
include('connect.php');
session_start();
if (isset($_POST['register'])) {
   $name = $_POST['user_name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $adrees=$_POST['adrees'];
   $adrees = filter_var($adrees, FILTER_SANITIZE_STRING);
   $phon=$_POST['phon'];
   $phon = filter_var($phon, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND email = ?");
   $select_user->execute([$name, $email]);
   if ($select_user->rowCount() > 0) {
      setcookie('message', 'username or email already exists!', time() + 4);
   	}
   else {
      if ($pass != $cpass){
        setcookie('confirm password not matched!', time() + 4);
      }
      else {
         $insert_user = 
		 $conn->prepare("INSERT INTO `users`(username,pass,phon,adrees ,email,situs)
		  VALUES(?,?,?,?,?,?)");
         $insert_user->execute([$name,$pass,$phon,$adrees,$email,'عميل']);
		 $_SESSION['user_name'] =$name ;
		}
	}
	header('location:login.php');
}  
?>