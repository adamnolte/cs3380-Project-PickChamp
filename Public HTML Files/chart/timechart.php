<?php

/* Include the `fusioncharts.php` file that contains functions  to embed the charts. 
	Also include the fusioncharts.js file that holds the 2d column chart */

include("fusioncharts.php");
echo '<script type="text/javascript" src="chart/fusioncharts/fusioncharts.js"></script>';

// Establish a connection to the database
$host = "";
$user = "";
$pass = "";
$db = "";
$dbhandle = new mysqli($host,$user,$pass, $db);

if ($dbhandle->connect_error) {
	exit("There was an error with your connection: ".$dbhandle->connect_error);
}

$strQuery = "SELECT HOUR(login_time) as hour, COUNT(*) as count FROM login_timestamp GROUP BY hour";

// Execute the query, or else return the error message.

$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

// If the query returns a valid response, prepare the JSON strin

if ($result) {
	
	// The `$arrData` array holds the chart attributes and data
	$arrData = array(
	  "chart" => array
	  (
		"caption" => "Login Times by Popularity",
		"xAxisName" => "Hour",
		"yAxisName" => "Amount of Logins",
		"paletteColors" => "#0075c2",
		"bgColor" => "#ffffff",
		"borderAlpha"=> "20",
		"canvasBorderAlpha"=> "0",
		"usePlotGradientColor"=> "0",
		"plotBorderAlpha"=> "10",
		"showXAxisLine"=> "1",
		"xAxisLineColor" => "#999999",
		"showValues" => "0",
		"divlineColor" => "#999999",
		"divLineIsDashed" => "1",
		"showAlternateHGridColor" => "0"
	  )
	);

	$arrData["data"] = array();

	// Push the data into the array
	while($row = mysqli_fetch_array($result)) {
		array_push($arrData["data"], array(
		  "label" => formatHour($row["hour"]),
		  "value" => $row["count"]
		  )
		);
	}

	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

	$jsonEncodedData = json_encode($arrData);

	/*
	 Create an object for the column chart using the FusionCharts PHP class constructor. 
	 Syntax for the constructor is 
	 `FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. 
	 Because we are using JSON data to render the chart, the data format will be `json`. 
	 The variable `$jsonEncodeData` holds all the JSON data for the chart, 
	 and will be passed as the value for the data source parameter of the constructor.
	*/

	$columnChart = new FusionCharts("column2D", "chart_logins" , 600, 300, "time_chart", "json", $jsonEncodedData);

	// Render the chart

	$columnChart->render();
}

// Close the database connection

$dbhandle->close();


function formatHour($hour){
	if((int)$hour === 12){
		return "12 PM";
	}
	else if((int)$hour === 0){
		return "12 AM";
	}
	else if((int)$hour > 12){
		return ((int)$hour - 12)." PM";
	}
	else{
		return $hour." AM";
	}
}
?>
