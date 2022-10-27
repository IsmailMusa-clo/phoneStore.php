<?php 
include ('connect.php');
session_start();
if(isset($_POST['login'])){
   $user_name = $_POST['user_name'];
   $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND pass = ?");
   $select_user->execute([$user_name, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   if($select_user->rowCount() > 0){
	if($row['situs']=='الادارة'){
		$_SESSION['admin_name'] = $row['username'];
		$_SESSION['id'] = $row['id'];
		header('location:admin/dashboard.php');
	}else{
		$_SESSION['user_name'] = $row['username'];
		$_SESSION['id'] = $row['id'];
		header('location:index_log.php');
	}
   }else{
      header('location:login.php');
   }

}

 ?>