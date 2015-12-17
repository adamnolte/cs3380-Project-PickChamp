<?php

	session_start();
	$email = $_SESSION["email"];
	if($_SESSION["logged_in"] != 1 || $_SESSION['Admin'] != 1){
		header('Location: home.php');
	}
	
	//Set Variables to use in SQL Query
	$Sport = $_SESSION['Sport'];
	$Team_A = $_SESSION['Team-A'];
	$Team_B = $_SESSION['Team-B'];
	$Contest_Date = $_SESSION['contest-date'];

	
	//Establish Connection 
	$host = "";
	$user = "";
	$pass = "";
	$db = "";
	$con = mysqli_connect($host,$user,$pass,$db) or die ("Connection Error " . mysqli_error($link));
	
	//Run Query on database
	
	$sql = "INSERT INTO contests (sport,away_team,home_team,winner,end_date) VALUES ('$Sport','$Team_A','$Team_B','0','$Contest_Date');";
	echo $sql;
	mysqli_query($con,$sql);
	
	session_unset($_SESSION['Sport']);
	session_unset($_SESSION['Team-A']);
	session_unset($_SESSION['Team-B']);
	$_SESSION["logged_in"] = 1;
	$_SESSION['Admin'] = 1;
	$_SESSION["email"] = $email;
	header('Location: adminhome.php');
?>