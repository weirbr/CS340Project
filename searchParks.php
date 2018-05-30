<!DOCTYPE html>
<html>
	<head>
	<title>Search Parks</title>
	<link rel = "stylesheet" href="index.css">
	</head>
<body>

<?php
	include "header.php";
	include "connectvars.php";
	
	//connect to database
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn){
	   die('Could not connect: ' . mysql_error());
	}
	
	//variables
	$location = mysqli_real_escape_string($conn, $_POST['location']);
	echo "<p> $location </p>";
	
	$query = "SELECT pName
			FROM `ProjectPark`
			WHERE pName = '$location'";
			
	$result = mysqli_query($conn, $query);
	if ($result){
		$msg = "<p>There is a park in $location</p>";
	}
	else{
		$msg = "<p>No Park was found</p>";
	}
	echo "$msg";	
	

	
	
	mysqli_free_result($result);
	mysqli_close($conn);

?>

<section id = "location"> Pick a Location
	<form method = "POST" id = "searchForm">
		<div>
			<input type="checkbox" name = "location" value = "Jefferson Park"> Jefferson Park
		</div>
		
		<div>
			<input type="checkbox" name = "location" value = "Sierra Park"> Sierra Park
		</div>
		
		<div>
			<input type="checkbox" name = "location" value = "Grant's Plateau"> Grant's Plateau
		</div>
		
		<div>
			<input type="checkbox" name = "location" value = "Arch Park"> Arch Park
		</div>
		
		<div>
			<input type="checkbox" name = "location" value = "Washington Park"> Washington Park
		<div>
		
		<p>
		<input type = "submit" value = "Search" />
		<input type = "reset" value = "Clear Search" />
		</p>
	</form>
</section>

</body>
</html>