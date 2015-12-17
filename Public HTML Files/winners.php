<!DOCTYPE html>

<head>
	<html lang="en">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" type="css" href="css/styles.css">
</head>
<?php
	include("chart/timechart.php");
	include("teams.php");
	session_start();
	if($_SESSION["logged_in"] != 1 || $_SESSION['Admin'] != 1){
		header('Location: home.php');
	}
?>
<body>
	<div class="container-fluid">
	  	  <!----
	      Header Image and Nav-Bar
	  ---->
	  <div class="row">
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
  			  <hr>
  			</ul>
  		</div>
  	</div>
  	<div class="row">
	  <?php
	    $contest_id = $_POST['contest_id'];
      $host = "us-cdbr-azure-central-a.cloudapp.net";
			$host = "";
			$user = "";
			$pass = "";
			$db = "";
			$conn = mysqli_connect($host,$user,$pass,$db);
			
			//Show Current Contests
			$sql = "SELECT email FROM user_picks WHERE pick = winner and contest_id = '" . $contest_id . "'";
			$result = $conn->query($sql);
			echo "<h2>Winners of Contest " . $contest_id . "</h2>";
			echo "<div class=" . "\"contestWrapper\"" . ">";
  				echo "<h3>Winners: </h3><br>";
  				echo "<table><tr> <td> Email </td></tr>";
  					while($row = $result->fetch_assoc()) {
  						echo "<tr><td>" .$row["email"]. "</td></tr>";
  					}
  				echo "</table>";
				echo "</div>";
	   ?>
	  </div>
	</div>
</body>
</html>