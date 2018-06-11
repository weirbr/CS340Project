<!DOCTYPE html>
<?php
		$currentpage="Camp List";
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
	
	//CAMPSITE
	$q3 = "SELECT cName AS Name, cDescription AS Description, cAvgRating AS Rating
	FROM `ProjectCampsites`
	ORDER BY cAvgRating DESC";
	
	$r3 = mysqli_query($conn, $q3);
	if (!r3){
	   die("Query failed");
	}
	// get number of columns in table	
	$fields_num = mysqli_num_fields($r3);
	echo "<div><div id='bestHeader'>List of Campsites</div>";
	echo "<table id='t01' border='1'><tr>";
	

	// printing table headers
	for ($i=0; $i<$fields_num; $i++){
	   $field = mysqli_fetch_field($r3);
	   echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($r3)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
		echo "</tr>\n</div>";
	}
	echo "</table></div>";
	
	mysqli_free_result($r3);
	mysqli_close($conn);


	
?>

</html>
