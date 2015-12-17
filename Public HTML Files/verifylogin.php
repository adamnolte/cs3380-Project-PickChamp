<?php
	// Start the session
		session_start();
	

	if($_SERVER["HTTPS"] != "on")
	{
		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
		exit();
	}
	$host = "";
	$user = "";
	$pass = "";
	$db = "";
    $link = mysqli_connect($host,$user,$pass,$db) or die ("Connection Error " . mysqli_error($link));
	$email = $_POST['inputEmail'];
	$password = $_POST['inputPassword'];
	session_unset();
	session_destroy();
	session_start();
	
	
	$query = "SELECT hashed_password, admin, firstname FROM user WHERE email = '".$email."'";
					
	$stmt = $link -> prepare($query);
	$stmt -> execute();
	$stmt -> store_result();
	//Check that user is registered
	if($stmt -> num_rows === 0){
		$_SESSION['login_error'] = 2;
		header("Location: index.php");
		exit();
	}
	else{
		//Interpret Result
		function bind_array($stmt, &$row) {
			$md = $stmt->result_metadata();
			$params = array();
			while($field = $md->fetch_field()) {
				$params[] = &$row[$field->name];
			}
			call_user_func_array(array($stmt, 'bind_result'), $params);
		}
		bind_array($stmt, $row);
		$stmt->fetch();
		$hashedPassword = $row["hashed_password"];
		$admin = $row["admin"];
		$_SESSION["firstName"] = $row["firstname"];

		//Verify Fetched Password && Check if user is an admin
		if(password_verify($password, $hashedPassword) && $admin == 0){
			$_SESSION["logged_in"] = 1;				
			$_SESSION["email"] = $email;
			record_time($link,$email);
			header("Location: home.php");
		}else if(password_verify($password, $hashedPassword)){
			$_SESSION["logged_in"] = 1;
			$_SESSION["email"] = $email;
			$_SESSION['Admin'] = 1;
			record_time($link,$email);
			header("Location: adminhome.php");
		}
		else{
			$_SESSION['login_error'] = 1;
			header("Location: index.php");
			exit();
		}
	}

	
	function record_time($link, $email){
		date_default_timezone_set('America/Chicago');
		$time = date('H:i:s');
		$time_query = "INSERT INTO login_timestamp VALUES(?,?)";
		$stmt = $link -> prepare($time_query);
		$stmt -> bind_param('ss',$email,$time);
		$stmt -> execute();
	}	
?>
