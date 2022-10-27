
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
	<center>
		<?php
		error_reporting(0);
		// اكواد تسجيل الخروج   
		session_start();
		session_unset();
		?>
		<div class="container">
			<div class="screen">
				<div class="screen__content">
					<h2 style="color:#e1e1e1;background:#5C5696;padding:15px 0;margin-top:0;font-weight:bold"> صفحة تسجيل الدخول <a href="index.php" style="margin-left:40px;"><i class="fa fa-sign-in"></i></a></h2>
					<form class="login" action="check_login.php" method="post">
						<div class="login__field">
							<i class="fa fa-user"></i>
							<input type="text" class="login__input" id="fname" name="user_name" placeholder="اسم المستخدم">
						</div>
						<div class="login__field">
							<i class="fa fas fa-lock"></i>
							<input type="password" class="login__input" id="lname" name="pass" placeholder="كلمة السر">
						</div>
						<button name="login" class="button login__submit">
							<span class="button__text">دخول</span>
						</button>
					</form>
					<a href="register.php" class="reg" style="">
						<p>ليس لدى حساب</p>
					</a>
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