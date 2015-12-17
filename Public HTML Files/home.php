<!DOCTYPE html>
<?php
	session_start();
	if($_SESSION["logged_in"] != 1){
		header('Location: index.php');
	}else{ //Grab the First Name of the user so we can address them by their name at home
		session_start();
		echo $_SESSION['firstname'];
	}
?>
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
		<div class ="nav-bar">
			<ul class="nav nav-pills nav-justified">
			  <?php
					session_start();
					if($_SESSION['Admin'] == 1){
						echo "<li role=" . "\"presentation\"" . "><a href=" . "\"adminhome.php\"" . ">AdminHome</a></li>";
					}
			  ?>
			  <li class="nav" role="presentation"><a href="home.php">Home</a></li>
			  <li role="presentation"><a href="MLB.php">MLB</a></li>
			  <li role="presentation"><a href="NBA.php">NBA</a></li>
			  <li role="presentation"><a href="NFL.php">NFL</a></li>
			  <li role="presentation"><a href="NHL.php">NHL</a></li>
			  <li role="presentation"><a href="index.php">Logout</a></li>
			</ul>
		</div>
		<div class="body">
			<div class="body-content">
        <?php
			$host = "";
			$user = "";
			$pass = "";
			$db = "";
  			$conn = mysqli_connect($host,$user,$pass,$db);
          $sql = "SELECT firstname, (mlb_wins + nba_wins + nhl_wins + nfl_wins) as wins FROM user ORDER BY wins desc LIMIT 10";
          
          $result = $conn->query($sql);
				  echo "<div class=" . "\"contestWrapper\"" . ">";
  				echo "<h2>Leaderboard</h2><br>";
  				echo "<table><tr><td> Rank </td> <td> Name </td> <td> Wins </td></tr>";
  				$i = 1;
					while($row = $result->fetch_assoc()) {
						echo "<tr><td>" . $i . "</td><td>" .$row["firstname"]. "</td><td>" . $row["wins"]. "</td></tr>";
						$i++;
					}
  				echo "</table>";
  				$email = $_SESSION['email'];
  				$sql = "SELECT (mlb_wins + nba_wins + nhl_wins + nfl_wins) as wins FROM user WHERE email = '" . $email . "';";
  				$result = $conn->query($sql);
  				$row = $result->fetch_assoc();
  				echo "Your Total Wins: " . $row['wins'];
				  echo "<hr></div>"; //End contest Wrapper Div
        ?>
				<div class="body-content-text">
					We are excited to have you aboard, who wouldn't wanna play daily fantasy sports FOR FREE and EARN BIG while doing so!  To begin,
					select your favorite professional sport, whether it be the <a href="MLB.php" style="color: black">MLB</a>, <a href="NBA.php" style="color: black">NBA</a>, <a href="NHL.php" style="color: black">NHL</a>, or even the <a href="NFL.php" style="color: black">NFL</a>
					from the menubar above or simply click on one of the links to begin! We will notify you via email if you pick the correct team and what your prize is!
					<br><br><br><br><br><br><br><br><b>
					We offer daily fantasy sports contests with free entry.
					Enter and win prizes all season long with Pick Champ!
					We are currently holding fantasy baseball, fantasy football, fantasy hockey and fantasy
					college football contests.  Soon we'll have fantasy MMA, fantasy basketball and fantasy
					college basketball.  Click on your game above and get in the game with Pick Champ!</b>
				</div>
			</div>
		</div>
	</div>
</body>
</html>