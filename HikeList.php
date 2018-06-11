<!DOCTYPE html>
<?php
		$currentpage="Hike/Trail List";
		include "pages.php";
		
?>
<html>
	<head>
	<title>Campsite List</title>
	<link rel = "stylesheet" href="index.css">
	</head>
<body>
</body>

<?php
	include "header.php";
	include "connectvars.php";
	
	//connect to database
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn){
	   die('Could not connect: ' . mysql_error());
	}

	//HIGHEST RATED HIKES
	$q2 = "SELECT htName AS Name, htDescription AS Description, tAvgRating AS Rating
	FROM `ProjectHikes&Trails`
	ORDER BY tAvgRating DESC";
	
	$r2 = mysqli_query($conn, $q2);
	if (!r2){
	   die("Query failed");
	}
	// get number of columns in table	
	$fields_num = mysqli_num_fields($r2);
	echo "<div><div id='bestHeader'>List of Hike</div>";
	echo "<table id='t01' border='1'><tr>";
	

	// printing table headers
	for ($i=0; $i<$fields_num; $i++){
	   $field = mysqli_fetch_field($r2);
	   echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($r2)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
		echo "</tr>\n</div>";
	}
	echo "</table></div>";
	
	mysqli_free_result($r2);
	mysqli_close($conn);


	
?>

</html>
