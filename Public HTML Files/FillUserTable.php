<?php

			$host = "";
			$user = "";
			$pass = "";
			$db = "";
        	$con = mysqli_connect($host,$user,$pass,$db) or die ("Connection Error " . mysqli_error($link));

			$EmailExists = FALSE;
			$admin = $_POST['admin'];
			
			//Verify That The user input their email address correctly
			$email = $_POST['inputEmail'];
			$email2 = $_POST['inputEmail2'];
			if($email != $email2){
				session_start();
					$_SESSION['EmailError'] = "Your emails do not match, Please Try again<br>";
					//echo $_SESSION['EmailError'];
					if($admin == 1){
						header("Location: registeradmin.php");
					}
					else{
						header('Location: register.php');
					}
            }
			else{//VERIFY THE EMAIL DOESNT EXIST IN OUR DB ALREADY
				
				$sql = "SELECT * FROM user WHERE email ='".$email."'";
				$query = mysqli_query($con,$sql);
				
				if(mysqli_num_rows($query) != 0){
    				session_start();

					$EmailExists = TRUE;

					$_SESSION['EmailError'] = "That Email Already Exists, Please use another Email<br>";
					if($admin == 1){
						header("Location: registeradmin.php");
					}
					else{
						header('Location: register.php');
					}
					exit();
				}
				else{
    					//echo "Email is valid and does not currently exist in our Databse";
				}
		
			}
			//end email verifcation




			$pass = $_POST['inputPassword'];
			$pass2 = $_POST['inputPassword2'];
			//validate that the password and verify password match
			if($pass != $pass2){
     				session_start();
						$_SESSION['PasswordError'] = "Your passwords do not match, Please Try again<br>";
						if($admin == 1){
							header("Location: registeradmin.php");
						}
						else{
							header('Location: register.php');
						}
						exit();
                        }else{
				$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
			}
			
			
			$Fname = $_POST['FirstName'];
			$Lname = $_POST['LastName'];
			$zip = $_POST['zip'];
			$state = $_POST['state'];
			$gender = $_POST['sex'];
			
			if($email == $email2 && $pass == $pass2 && $EmailExists == FALSE){
				$sql = "INSERT INTO user VALUES ('$email','$hashed_password','$Fname','$Lname','$gender','$zip','$state','$admin',0,0,0,0);";
                mysqli_query($con,$sql);
				if($admin == 1){
					header("Location: adminhome.php");
				}
				else{
					session_start();
					$_SESSION["logged_in"] = 1;
					$_SESSION["email"] = $email;
					$_SESSION["firstname"] = $Fname;
					header("Location: home.php");
					exit();
				}
			}
?>

