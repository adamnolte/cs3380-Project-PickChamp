<?php

	session_start();
	
	$email = $_SESSION['email'];
	$sport = $_SESSION['sport'];
	
	$host = "";
	$user = "";
	$pass = "";
	$db = "";
    $con = mysqli_connect($host,$user,$pass,$db) or die ("Connection Error " . mysqli_error($link));
	
	
	foreach($_POST['status'] as $contest_id => $team){
		
		//Run query that checks if the contest ID and email coexist in user_picks table, don't allow a second pick if found
		$sql = "SELECT COUNT(*)	FROM user_picks WHERE email =". "\"$email\"" . "AND contest_id =" . "\"$contest_id\"" . ";";
		echo $sql . "<br>";
		$QueryResult = mysqli_query($con,$sql);
		$result = mysqli_fetch_array($QueryResult);
		echo $result['COUNT(*)'] . "<br>";
		
		if($result['COUNT(*)'] != 0){
			//Do nothing
		}else{

			$sql = "INSERT INTO user_picks VALUES ('$email','$contest_id','$team','0','$sport');";
			echo $sql . "<br>";
			mysqli_query($con,$sql);
		
		}
	}

	mysqli_close($con);
	header('Location: SuccessPicks.php');
	exit();
?>