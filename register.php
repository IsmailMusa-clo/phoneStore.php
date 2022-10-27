<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<style>
	.login__field {
    padding: 10px 0px;
}
.login__submit {
    margin-top: 10px;
    padding: 10px 20px;
    font-weight: 700;
}
</style>
</head>
<body>
<center>
<?php
   error_reporting(0);
// اكواد تسجيل الخروج   
session_start();
session_unset();

$re=$_GET['re'];

if ($re=='2') {
	  echo "<div class='alert alert-danger' role='alert'>
  معلومات الدخول خطأ
</div>";
}
?>
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<h2 style="color:#e1e1e1;background:#5C5696;padding:15px 0;margin-top:0;font-weight:bold">صفحة تسجيل الدخول <a href="index.php" style="margin-left:40px;"><i class="fa fa-sign-in"></i></a></h2>
			<form class="login" action="add_users.php" style="padding-top:5px;" method="post">
				<div class="login__field">
					<i class="fa fa-user"></i>
					<input type="text" class="login__input" id="fname" name="user_name" placeholder="اسم المستخدم" >
				</div>
				<div class="login__field">
					<i class="fa fa-phone"></i>
					<input type="text" class="login__input" id="phon" name="phon" placeholder="رقم الهاتف" >
				</div>
				<div class="login__field">
					<i class="fa fa-map-marker"></i>
					<input type="text" class="login__input" id="adrees" name="adrees" placeholder="العنوان" >
				</div>
				<div class="login__field">
					<i class="fa fa-envelope-o"></i>
					<input type="email" class="login__input" id="email" name="email" placeholder="البريد الكتروني" >
				</div>
				<div class="login__field">
					<i class="fa fas fa-lock"></i>
					<input type="password" class="login__input"id="lname" name="pass" placeholder="كلمة السر">
				</div>
				<div class="login__field">
					<i class="fa fas fa-lock"></i>
					<input type="password" class="login__input"id="lname" name="cpass" placeholder="تأكيد كلمة السر ">
				</div>
				<button name="register" class="button login__submit">
					<span class="button__text">تسجيل</span>
 				</button>				
			</form>
			<a href="login.php" class="reg" style=""><p> !لدى حساب بالفعل</p></a>
			<div class="social-login">
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>

</center>
</body>
</html>
