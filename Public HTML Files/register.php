<!DOCTYPE html>
<head>
	<html lang="en">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" type="css" href="css/styles.css">
</head>
<body>
	<div class="container-fluid">
		<?php
			if($_SERVER["HTTPS"] != "on"){
				header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
				exit();
			}
		?>
	<div class="header">
			<img src="images/PicChamp.jpg" alt="LOGO" width="100%">
	</div>
		<div class="RegisterError">
			<?php
				session_start();
				if($_SESSION["logged_in"] == 1){
					header('Location: home.php');
					exit();
				}
				if(isset($_SESSION['PasswordError'])){
					echo $_SESSION['PasswordError'];
				}
				else if(isset($_SESSION['EmailError'])){
					echo $_SESSION['EmailError'];
				}
				session_destroy();
			?>
		</div>
		<div class="login-form">
		
			<form class="form-signin" action="FillUserTable.php" method="POST">
				
			 <h2 class="form-signin-heading">Let's get started, Tell us about yourself!</h2><hr>
			 <input type="hidden" name="admin" value="0">
			 Email:
			 <input type="email" style="background-color: green; color: white;" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="yes" autofocus="yes">
			 
			 Confirm Email:
                         <input type="email" style="background-color: green; color: white;" style="background-color: green; color: white;"id="inputEmail2" name="inputEmail2" class="form-control" placeholder="Email address" required="yes" autofocus="yes">
			 
			 Password:
			 <input type="password" style="background-color: green; color: white;" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="yes" autofocus="yes">
			 
			 Confirm Password:
			 <input type="password" style="background-color: green; color: white;" id="inputPassword" name="inputPassword2" class="form-control" placeholder="Password" required="yes" autofocus="yes">
			 
			 First Name:
			 <input type="name" style="background-color: green; color: white;" id="FirstName" name="FirstName" class="form-control" placeholder="First Name" required="yes" autofocus="yes">
			 Last Name:
			 <input type="name" style="background-color: green; color: white;" id="LastName" name="LastName" class="form-control" placeholder="Last Name" required="yes">
			 <hr>Gender:<br>
			 <input type="radio" name="sex" value="male"> Male
			 <input type="radio" name="sex" value="female"> Female<hr>
			 Postal Code (Zip-Code):<br>
			 <input type="text" style="background-color: green; color: white;" name="zip" placeholder="123456" required="yes" maxlength="5">
			 <hr>
			 State:<br>
				 <select name="state" style="background-color: green; color: white;">
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
				 </select>
			 <hr>
			 <button class="btn btn-lg btn-success btn-block" type="submit">Sign up!</button>
			</form>
			<br>
		</div>
	</div>
</body>
</html>
