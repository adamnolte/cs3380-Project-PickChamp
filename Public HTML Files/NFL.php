<!DOCTYPE html>
<?php
	session_start();
	if($_SESSION["logged_in"] != 1){
		header('Location: index.php');
	}else{
		$email = $_SESSION["email"];
		$sql = "SELECT nfl_wins FROM user WHERE email =" . "\"$email\"" . ";"; 
		$host = "";
		$user = "";
		$pass = "";
		$db = "";
		$con = mysqli_connect($host,$user,$pass,$db);		
		$result = mysqli_query($con,$sql);
	    $row = $result->fetch_assoc();
		$wins = $row['nfl_wins'];
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
			  <li role="presentation"><a href="home.php">Home</a></li>
			  <li role="presentation"><a href="MLB.php">MLB</a></li>
			  <li role="presentation"><a href="NBA.php">NBA</a></li>
			  <li role="presentation"><a href="NFL.php">NFL</a></li>
			  <li role="presentation"><a href="NHL.php">NHL</a></li>
			  <li role="presentation"><a href="index.php">Logout</a></li>
			</ul>
		</div>
		<div class="body">
		<h3>Current NFL Contests:</h3>
		<?php echo $email; echo "<br> Number of NFL wins: "; echo $wins;?>  
		</div>
		<br>
		<div class="body">
			<div class="SetWinner">
				<?php
				    $_SESSION['sport'] = 'nfl';
						$host = "us-cdbr-azure-central-a.cloudapp.net";
						$user = "b63801b04fcda1";
						$pass = "31bfef89";
						$db = "cs-PickChamp";
						$conn = mysqli_connect($host,$user,$pass,$db);
						
						date_default_timezone_set('America/Chicago');
						$currDate = date("Y-m-d");
						$sql = "SELECT * FROM contests WHERE sport = 'NFL' and end_date > '".$currDate."'";
						$result = $conn->query($sql);

						echo "<form class=" . "\"form-signin\"" . " method=" . "\"POST\"" . " action =" . "\"UpdateUserPicks.php\"" . ">";
							echo "<table class=" . "\"pickTable\"" . "align=" . "\"center\"" . "><tr> <td>AWAY TEAM</td><td>HOME TEAM</td></tr>";
								while($row = mysqli_fetch_array($result)) {
									$away_team = $row["away_team"];
									$home_team = $row["home_team"];
									
									//print out table and display buttons to select which team to pick
									echo "<tr><td>" . $away_team . " <input type=" . "\"radio\"" . "name=" . "\"status[" . $row['contest_id'] . "]\"" . "value=" . "\"$away_team\"" . "> </td>";
									//echo "<td></td>";
									echo "<td>" . $home_team . " <input type=" . "\"radio\"" . "name=" . "\"status[" . $row['contest_id'] . "]\"" . "value=" . "\"$home_team\"" . "> </td></tr>";
								}
							echo "</table><br>";
							echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Choose Picks!</button>";
						echo "</form>";
						$Round2 = $conn->query($sql);
						echo "<br>";
						$conn->close();
			?>
			<br>
			<br>
			</div>
		</div>
	</div>
</body>
</html>