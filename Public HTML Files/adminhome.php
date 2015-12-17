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
  	
  	<!----
  	    Register Admin
  	 ---->
		<div class="row">
			<h3>Welcome to Pick-Champ <?php echo $_SESSION['firstName']; ?>, if you need to Register a new Admin Please click the Button Below!</h3>
			<br>
			<a class="btn btn-default" href="registeradmin.php">New Admin here!</a>
			<hr><br>
		</div>
		
		<!----
		    Create new Contest
		---->
		<div class="row">
  		<div class="form">
  			<div class="Contest-Check">
  				<?php
  				//Lastly I want to Populate our page with the Selections Our Admin has made and ensure they are correct
  				if(isset($_GET['Sport']) || $_SESSION['Sport']){
  					if(isset($_GET['Sport'])){
  						$Sport = $_GET['Sport'];
  						$_SESSION['Sport'] = $Sport; //Set Sport to be manipulated via session variable
  					}
  					echo "<form action=" . "\"unset_admin_contest_session.php\"" . ">";
  						echo "<button class=" . "\"btn btn-danger\"" . "type=" . "\"submit\"" . ">Start Over on Contest</button>";
  						echo "<br><hr><br>";
  					echo "</form>";
  					$Sport = $_SESSION['Sport'];
  					echo "Contest Will be conducted for: <br>" . $Sport . "<br><br>";
  				}
  				
  				if(isset($_GET['Team-A']) || $_SESSION['Team-A']){
  					if(isset($_GET['Team-A'])){
  						$Team_A = $_GET['Team-A'];
  						$_SESSION['Team-A'] = $Team_A; //Set Team_A to be manipulated via session variable
  					}
  					$Team_A = $_SESSION['Team-A'];
  					echo "VISITING Team will be: <br>" . $Team_A .  "<br><br>";
  				}
  				
  				if(isset($_GET['Team-B']) || $_SESSION['Team-B']){
  					if(isset($_GET['Team-B'])){
  						$Team_B = $_GET['Team-B'];
  						$_SESSION['Team-B'] = $Team_B; //Set Team_A to be manipulated via session variable
  					}
  					$Team_B = $_SESSION['Team-B'];
  					echo "HOME Team will be: <br>" . $Team_B . "<br><br>";
  					
  				}
  				if(isset($_GET['contest-date']) || (isset($_SESSION['contest-date']) && isset($_SESSION['Team-B']) && isset($_SESSION['Team-A']))){
  					if(isset($_GET['contest-date'])){
  						$_SESSION['contest-date'] = $_GET['contest-date'];
  					}
  					echo "End date is: ".$_SESSION['contest-date'];
  					echo "<br><hr><br>";
  					echo "<form action=" . "\"create_contest.php\"" . ">";
  						echo "<button class=" . "\"btn btn-success\"" . "type=" . "\"submit\"" . ">Confirm Create Contest</button>";
  					echo "</form>";
  				}
  				
  				?>
  			</div>
			
  			<?php
  			//First Step To setting up a contest is Deciding what Major Sport we want to create a contest for.
  				if(!isset($_SESSION['Sport'])){
  					echo "<h1>Select a Major Sport Contest to Make:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Sport\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								echo "<option value=" . "\"MLB\"" . ">MLB</option>";
  								echo "<option value=" . "\"NHL\"" . ">NHL</option>";
  								echo "<option value=" . "\"NBA\"" . ">NBA</option>";
  								echo "<option value=" . "\"NFL\"" . ">NFL</option>";
  							echo "</select><br><br>";
  								echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Contest Sport</button>";
  						echo "</form>";
  				}
  				else if(isset($_GET['Sport'])){
  					//MLB TEAM OUTPUT FOR TEAM A
  					if($Sport == MLB){
  						echo "<h1>Please Select Your Visiting MLB Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-A\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for mlb teams
  								echo "<optgroup label=" . "\"American League Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($MLBAmericanLeague); $i++){
  										echo "<option value=\"".$MLBAmericanLeague[$i]."\">".$MLBAmericanLeague[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"National League Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($MLBNationalLeague); $i++){
  										echo "<option value=\"".$MLBNationalLeague[$i]."\">".$MLBNationalLeague[$i]."</option>";
  									}
  							echo "</select><br><br>";
  								echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  					//NHL TEAM OUTPUT FOR TEAM A
  					else if($Sport == NHL){
  						echo "<h1>Please Select Your Visiting NHL Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-A\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for nhl teams
  								echo "<optgroup label=" . "\"NHL East Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NHLEast); $i++){
  										echo "<option value=\"".$NHLEast[$i]."\">".$NHLEast[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"NHL West Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NHLWest); $i++){
  										echo "<option value=\"".$NHLWest[$i]."\">".$NHLWest[$i]."</option>";
  									}
  							echo "</select><br><br>";
  								echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  					//NBA TEAM OUTPUT FOR TEAM A
  					else if($Sport == NBA){
  						echo "<h1>Please Select Your Visiting NBA Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-A\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for NBA teams
  								echo "<optgroup label=" . "\"NBA East Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NBAEast); $i++){
  										echo "<option value=\"".$NBAEast[$i]."\">".$NBAEast[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"NBA West Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NBAWest); $i++){
  										echo "<option value=\"".$NBAWest[$i]."\">".$NBAWest[$i]."</option>";
  									}
  							echo "</select><br><br>";
  							echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  					//NFL TEAMS OUTPUT FOR TEAM A
  					else{
  						echo "<h1>Please Select Your Visiting Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-A\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for nfl teams
  								echo "<optgroup label=" . "\"NFL AFC Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NFLAFC); $i++){
  										echo "<option value=\"".$NFLAFC[$i]."\">".$NFLAFC[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"NFL NFL Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NFLNFC); $i++){
  										echo "<option value=\"".$NFLNFC[$i]."\">".$NFLNFC[$i]."</option>";
  									}
  							echo "</select><br><br>";
  							echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  				}//END TEAM A
  				else if(isset($_GET['Team-A'])){
  					//MLB TEAM OUTPUT FOR TEAM B
  					if($Sport == MLB){
  						echo "<h1>Please Select Your Home Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-B\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for mlb teams
  								echo "<optgroup label=" . "\"American League Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($MLBAmericanLeague); $i++){
  										echo "<option value=\"".$MLBAmericanLeague[$i]."\">".$MLBAmericanLeague[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"National League Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($MLBNationalLeague); $i++){
  										echo "<option value=\"".$MLBNationalLeague[$i]."\">".$MLBNationalLeague[$i]."</option>";
  									}
  							echo "</select><br><br>";
  								echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  					//NHL TEAM OUTPUT FOR TEAM B
  					else if($Sport == NHL){
  						echo "<h1>Please Select Your Home Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-B\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for nhl teams
  								echo "<optgroup label=" . "\"NHL East Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NHLEast); $i++){
  										echo "<option value=\"".$NHLEast[$i]."\">".$NHLEast[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"NHL West Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NHLWest); $i++){
  										echo "<option value=\"".$NHLWest[$i]."\">".$NHLWest[$i]."</option>";
  									}
  							echo "</select><br><br>";
  								echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  					//NBA TEAM OUTPUT FOR TEAM B
  					else if($Sport == NBA){
  						echo "<h1>Please Select Your Home NBA Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-B\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for NBA teams
  								echo "<optgroup label=" . "\"NBA East Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NBAEast); $i++){
  										echo "<option value=\"".$NBAEast[$i]."\">".$NBAEast[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"NBA West Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NBAWest); $i++){
  										echo "<option value=\"".$NBAWest[$i]."\">".$NBAWest[$i]."</option>";
  									}
  							echo "</select><br><br>";
  							echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  					//NFL TEAM OUTPUT FOR TEAM B
  					else{
  						echo "<h1>Please Select Your Home Team for the Game:</h1>";
  						echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  							echo "<select name=" . "\"Team-B\"" . " style=" . "\"background-color: green; color: white;\"" . ">";
  								//output for nfl teams
  								echo "<optgroup label=" . "\"NFL AFC Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NFLAFC); $i++){
  										echo "<option value=\"".$NFLAFC[$i]."\">".$NFLAFC[$i]."</option>";
  									}
  								echo "<optgroup label=" . "\"NFL NFL Teams:\"" ."></optgroup>";
  									for($i = 0; $i < count($NFLNFC); $i++){
  										echo "<option value=\"".$NFLNFC[$i]."\">".$NFLNFC[$i]."</option>";
  									}
  							echo "</select><br><br>";
  							echo "<button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set Team</button>";
  						echo "</form>";
  					}
  				}
  				else if(isset($_GET['Team-B'])){
  					date_default_timezone_set('America/Chicago');
  					echo "<h1>Please Select The Contest End Date:</h1>";
  					echo "<form class=" . "\"form-signin\"" . " method=" . "\"GET\"" . ">";
  						echo "End Date: <input type=\"date\" name=\"contest-date\" min=".date("Y-m-d")." style=\"color: black;\">";
  						echo "<br><br><button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">Set End Date</button>";
  					echo "</form>";
  				}
  			?>
  		<br>
  		</div>
  	</div>
  	
    <!----
        Show Contests and Select Winner
    ---->
  	<div class="row">
  		
  		  <hr>
  			<?php
				$host = "";
				$user = "";
				$pass = "";
				$db = "";
  				$conn = mysqli_connect($host,$user,$pass,$db);
  				
  				//Show Current Contests
  				$sql = "SELECT * FROM contests";
  				$result = $conn->query($sql);
				echo "<div class=" . "\"contestWrapper\"" . ">";
  				echo "<h2>Current Contests Active:</h2><br>";
  				echo "<table><tr> <td> CONTEST ID </td> <td> AWAY TEAM </td> <td> HOME TEAM </td> <td> WINNER </td><td> END DATE </td> </tr>";
  					while($row = $result->fetch_assoc()) {
  						echo "<tr><td>" .$row["contest_id"]. "</td><td>" . $row["away_team"]. "</td><td>" . $row["home_team"] . "</td><td>" . $row["winner"]  ."</td><td>" . $row["end_date"] . "</td></tr>";
  					}
  				echo "</table><hr>";
				echo "</div>"; //End contest Wrapper Div
				
					/* Give Text Input for contest ID */
					
						if(!isset($_GET['UpDateWinnerID'])){
							echo "<div class=" . "\"UpdateWinner\"" . ">";
							echo "<br>";
							echo "Please type the Contest ID you'd wish to update the winner for AND tell us the winner:<br><br>";
							echo "<form method=" . "\"GET\"" . ">";
							echo "ID:<br>";
							echo "<input name=". "\"UpDateWinnerID\"" . "type=" . "\"text\"" . ">";
							echo "<br>Winning Team:<br>";
							echo "<input name=". "\"UpDateWinningTeam\"" . "type=" . "\"text\"" . ">";
							echo "<br><br><button class=" . "\"btn btn-default\"" . "type=" . "\"submit\"" . ">GO</button>";
							echo "</form>";
							echo "</div>";
						}else if(isset($_GET['UpDateWinnerID']) && isset($_GET['UpDateWinningTeam'])){
							
							$ID = $_GET['UpDateWinnerID'];
							$Winner = $_GET['UpDateWinningTeam'];
	
							$host = "";
							$user = "";
							$pass = "";
							$db = "";
							$conn = mysqli_connect($host,$user,$pass,$db);
							$sql = "UPDATE contests SET winner =" . "\"$Winner\"" . " WHERE contest_id = " . "\"$ID\"" . ";";
							$sql2 = "UPDATE user_picks SET winner =" . "\"$Winner\"" . " WHERE contest_id = " . "\"$ID\"" . ";";
							mysqli_query($conn,$sql);
							mysqli_query($conn,$sql2);
							
							//Add win to user if equal
							$sql = "SELECT email, sport FROM user_picks WHERE winner = pick AND contest_id = " . "\"$ID\";";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()) {
							  $sql = "UPDATE user SET " . $row['sport'] ."_wins = " . $row['sport'] ."_wins + 1 WHERE email = '" . $row['email'] . "';";
							  mysqli_query($conn, $sql);
							  echo 'got here';
							}
							  
							//Add contest to the Expired Contest Table
							$sql = "SELECT * FROM contests WHERE contest_id = " . "\"$ID\"" . ";";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							
							$ID = $row["contest_id"];
							$Sport = $row['sport'];
							$away = $row["away_team"];
							$home = $row["home_team"];
							$winner = $row["winner"];
							$date = $row["end_date"];
							
							echo "<br><br><br>" . $ID . $away . $home . $winner . $date . "<br>";
							$con = mysqli_connect($host,$user,$pass,$db);
							$sql = "INSERT INTO expired_contests VALUES ('$ID','$Sport','$away','$home','$date','$winner');";
							echo $sql;
							mysqli_query($con, $sql);
							
							//Delete Contest from Contests Table
							
							$sql = "DELETE FROM contests WHERE contest_id =" . "\"$ID\"" . ";";
							mysqli_query($con, $sql);
						
							
							
							
							echo "<script>location.href ='adminhome.php'</script>";
						}
				?>
				<br>
	</div>
		<!----
		    Display Login time chart
		---->
		<div class="row">
			<div id="time_chart"></div>
		</div>
		<br>
		<br>
		<?php
		
				$host = "";
				$user = "";
				$pass = "";
				$db = "";
  				$conn = mysqli_connect($host,$user,$pass,$db);
  				
  				//Show Exipred Contests
  				$sql = "SELECT * FROM expired_contests";
  				$result = $conn->query($sql);
				echo "<div class=" . "\"contestWrapper\"" . ">";
  				echo "<h2>Expired Contests:</h2><br>";
  				echo "<table><tr><td></td> <td> CONTEST ID </td> <td> AWAY TEAM </td> <td> HOME TEAM </td> <td> WINNER </td><td> END DATE </td> </tr>";
  					while($row = $result->fetch_assoc()) {
  						echo "<tr><td><form action=\"winners.php\" method=\"POST\"><button class=\"btn btn-default\"><input type=\"hidden\" name=\"contest_id\" value =\"" .$row['contest_id'] . "\">See Winners</button></input></form></td><td>" . $row['contest_id'] . "</td><td>" . $row["away_team"]. "</td><td>" . $row["home_team"] . "</td><td>" . $row["winner"]  ."</td><td>" . $row["end_date"] . "</td></tr>";
  					}
  				echo "</table><hr>";
				echo "</div>";
		
		?>
  </div>
</body>
</html>