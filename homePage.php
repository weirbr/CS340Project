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
</body>

<?php
	include "header.php";
	include "connectvars.php";
	
	//connect to database
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn){
	   die('Could not connect: ' . mysql_error());
	}
	
	//HIGHEST RATED PARKS
	$query = "SELECT pName AS Name, pDescription AS Description, , pAvgRating AS Rating
	FROM `ProjectPark`
	WHERE parkID IN 
    (SELECT P.parkID
    FROM ProjectPark P
    WHERE P.pAvgRating =
		(SELECT MAX(P2.pAvgRating)
		FROM ProjectPark P2))";
	
	$result = mysqli_query($conn, $query);
	if (!result){
	   die("Query failed");
	}
	// get number of columns in table	
	$fields_num = mysqli_num_fields($result);
	echo "<div><div id='bestHeader'>Highest Rated Parks</div>";
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
		echo "</tr>\n</div>";
	}
	echo "</table></div>";
	
	//HIGHEST RATED HIKES
	$q2 = "SELECT htName AS Name, htDescription AS Description, tAvgRating AS Rating
	FROM `ProjectHikes&Trails`
	WHERE htID = 
    (SELECT P.htID
    FROM `ProjectHikes&Trails` P
    WHERE P.tAvgRating IN
		(SELECT MAX(P2.tAvgRating)
		FROM `ProjectHikes&Trails` P2)LIMIT 1)";
	
	$r2 = mysqli_query($conn, $q2);
	if (!r2){
	   die("Query failed");
	}
	// get number of columns in table	
	$fields_num = mysqli_num_fields($r2);
	echo "<div><div id='bestHeader'>Highest Rated Hike</div>";
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
	
	
	//HIGHEST CAMPSITE
	$q3 = "SELECT cName AS Name, cDescription AS Description, cAvgRating AS Rating
	FROM `ProjectCampsites`
	WHERE campID = 
    (SELECT P.campID
    FROM `ProjectCampsites` P
    WHERE P.cAvgRating IN
		(SELECT MAX(P2.cAvgRating)
		FROM `ProjectCampsites` P2) LIMIT 1)";
	
	$r3 = mysqli_query($conn, $q3);
	if (!r3){
	   die("Query failed");
	}
	// get number of columns in table	
	$fields_num = mysqli_num_fields($r3);
	echo "<div><div id='bestHeader'>Highest Rated Campsite</div>";
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
	
	

	mysqli_free_result($result);
	mysqli_free_result($r2);
	mysqli_free_result($r3);
	mysqli_close($conn);


	
?>

</html>
