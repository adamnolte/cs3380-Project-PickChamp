<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
	/*if($_SESSION["logged_in"] === 1){
		if($_SESSION["Admin"] === 1){
			header("Location: adminhome.php");
			exit();
		}
		else{
			header("Location: home.php");
			exit();
		}
	}*/
}
session_start();
?>
<!DOCTYPE html>
<head>
	<html lang="en">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" type="css" href="css/styles.css">
</head>
<body>
	<div class="container-fluid">
		<div class="header">
			<img src="images/PicChamp.jpg" alt="LOGO" width="100%">
		</div>
		<div class="RegisterError">
			<?php
				if($_SESSION['login_error'] === 2){
					$message = "User not found! Please check email or register.";
					echo $message;
					session_unset();
				}
				else if($_SESSION['login_error'] === 1){
					$message = "Incorrect Password!";
					echo $message;
					session_unset();
				}
				session_unset();
			?>
		</div>
		<div class="login-form" >
			<form class="form-signin" action="verifylogin.php" method="POST">
				<h2 class="form-signin-heading">Sign In</h2>
				<input style="background-color: green; color: white;" type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="yes" autofocus="yes" maxlength="30">
				<input style="background-color: green; color: white;" type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="yes">
				<hr>
				<button class="btn btn-lg btn-success btn-block" type="submit" name="loginSubmit">Sign in</button>
			</form>
			<br>
			<hr>
			<h3 class="form-signin-heading">Register Now to get Started with Pick Champ!</h3>
			<div align="center">
			<hr>
			<form method="GET" action="register.php">
				<button class="btn btn-lg btn-success btn-block" >Register</button>
			</form>
			</div>
		</div>
	</div>
	<br>
</body>
</html>
