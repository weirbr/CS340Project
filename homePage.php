<!DOCTYPE html>
<?php
		$currentpage="Home";
		include "pages.php";
		
?>
<html>
	<head>
	<title>Home Page</title>
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
	$query = "SELECT htID, htName, htDescription
	FROM `ProjectHikes&Trails`
	WHERE htID = 12310"; 
		//(SELECT P2.htID
		//FROM `ProjectHikes&Trails` P2
		//GROUP BY P2.htAvgRating)";
		//LIMIT 1);";
	//$query = "SELECT * FROM `ProjectHikes&Trails`";

	$result = mysqli_query($conn, $query);
	if (!result){
	   die("Query failed");
	}
	// get number of columns in table	
	$fields_num = mysqli_num_fields($result);
	echo "<h1>Highest Rated Hike</h1>";
	echo "<table id='t01' border='1'><tr>";
	

	// printing table headers
	for ($i=0; $i<$fields_num; $i++){
	   $field = mysqli_fetch_field($result);
	   echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {	
		echo "<tr>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
		echo "</tr>\n";
	}
	
	

	mysqli_free_result($result);
	mysqli_close($conn);


	
?>

</body>
</html>
