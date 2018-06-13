<!DOCTYPE html>
<?php
		$currentpage="Profile";
		include "pages.php";
		
?>
<html>
	<head>
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
	
	if(isset($_GET['FID'])){
		$fid = $_GET['FID'];
		
		//Makes sure it is numeric to prevent injection.
		if(!is_numeric($fid)){
			echo '<script type="text/javascript">',
			 'alert("FID provided is not of matching type (numeric), redirecting to home page...")',
			 '</script>';
			echo '<script type="text/javascript">',
			 'window.location = "homePage.php"',
			 '</script>';
		}
		
		$query = "SELECT facilityID, Ftype, otherID FROM ProjectFacilities WHERE facilityID='$fid' ";
		$result = mysqli_query($conn, $query);

		if (!result){
			die("Query failed");
		}
		//Test to see if anything returned. If not, give error, and reset.
		if(mysqli_num_rows($result) == 0){
			echo '<script type="text/javascript">',
			 'alert("FID provided is not in database, redirecting to home page...")',
			 '</script>';
			echo '<script type="text/javascript">',
			 'window.location = "homePage.php"',
			 '</script>';
		}

		//Debug print
		/* echo "<div><div id='bestHeader'>List of Matches</div>";
		echo "<table id='t01' border='1'><tr>";
		// get number of columns in table	
		$fields_num = mysqli_num_fields($result);
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
		echo "</table></div>"; */
		
		//Print Site Info
		while($row = mysqli_fetch_row($result)) {
			$Ftype = $row[1];
			$otherID = $row[2];
			//echo "FTYPE = $Ftype AND OTHERID = $otherID";
		}
		
		if($Ftype == 't'){
			$queryT = "SELECT htName AS Name, htDescription AS Description, htStartAddress AS Start, htEndAddress AS Finish, tAvgRating as Rating FROM `ProjectHikes&Trails` WHERE htID='$otherID' ";
			$resultT = mysqli_query($conn, $queryT);
			echo "<table id='t01' border='1'><tr>";
			// get number of columns in table	
			$fields_numT = mysqli_num_fields($resultT);
			// printing table headers
			for ($i=0; $i<$fields_numT; $i++){
				$field = mysqli_fetch_field($resultT);
				echo "<td><b>$field->name</b></td>";
			}
			while($row = mysqli_fetch_row($resultT)) {	
			echo "</tr>\n";
				echo "<tr>";
				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable	
			
				foreach($row as $cell)		
					echo "<td>$cell</td>";	
				echo "</tr>\n</div>";
			}
			echo "</table></div>";
			mysqli_free_result($resultT);
		}
		else if($Ftype == 'c'){
			$queryC = "SELECT cName AS Name, cDescription AS Description, cAddress AS Address, cAvgRating as Rating FROM ProjectCampsites WHERE campID='$otherID' ";
			$resultC = mysqli_query($conn, $queryC);
			echo "<table id='t01' border='1'><tr>";
			// get number of columns in table	
			$fields_numC = mysqli_num_fields($resultC);
			// printing table headers
			for ($i=0; $i<$fields_numC; $i++){
				$field = mysqli_fetch_field($resultC);
				echo "<td><b>$field->name</b></td>";
			}
			while($row = mysqli_fetch_row($resultC)) {	
			echo "</tr>\n";
				echo "<tr>";
				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable	
			
				foreach($row as $cell)		
					echo "<td>$cell</td>";	
				echo "</tr>\n</div>";
			}
			echo "</table></div>";
			mysqli_free_result($resultC);
		}
		else if($Ftype == 'p'){
			$queryP = "SELECT pName AS Name, pDescription AS Description, pAvgRating as Rating FROM ProjectPark WHERE parkID='$otherID' ";
			$resultP = mysqli_query($conn, $queryP);
			echo "<table id='t01' border='1'><tr>";
			// get number of columns in table	
			$fields_numP = mysqli_num_fields($resultP);
			// printing table headers
			for ($i=0; $i<$fields_numP; $i++){
				$field = mysqli_fetch_field($resultP);
				echo "<td><b>$field->name</b></td>";
			}
			while($row = mysqli_fetch_row($resultP)) {	
			echo "</tr>\n";
				echo "<tr>";
				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable	
			
				foreach($row as $cell)		
					echo "<td>$cell</td>";	
				echo "</tr>\n</div>";
			}
			echo "</table></div>";
			
			mysqli_free_result($resultP);
			
			//Get the park address
			$queryPA = "SELECT street, city, zip, state FROM ProjectParkAddress WHERE parkID='$otherID' ";
			$resultPA = mysqli_query($conn, $queryPA);
			
			echo "<div><div id='bestHeader'>Address</div>";
			echo "<table id='t01' border='1'><tr>";
			echo "<td><b>";
			while($row = mysqli_fetch_row($resultPA)) {	
				foreach($row as $cell)		
					echo "$cell ";
			}
			echo"</b></td>";
			echo "</tr>\n</table></div>";
		}
		else{
			echo '<script type="text/javascript">',
			 'alert("FID provided does not have a type, redirecting to home page...")',
			 '</script>';
			echo '<script type="text/javascript">',
			 'window.location = "homePage.php"',
			 '</script>';
		}
		
		//INSERT REVIEW CODE HERE
		
		
		
		//Print Reviews
		$queryR = "SELECT rDescription AS Review, username AS Author, score AS Score FROM ProjectRating WHERE facilityID='$fid' ";
		$reviewresult = mysqli_query($conn, $queryR);
		if (!reviewresult){
			die("Query failed");
		}
		if(mysqli_num_rows($reviewresult) == 0){
			echo "<div><div id='bestHeader'>Reviews</div>";
			echo "<table id='t01' border='1'><tr>";
			echo "<td><b>No Reviews Yet</b></td>";
			echo "</tr>\n</table></div>";
		}
		else{
			echo "<div><div id='bestHeader'>Reviews</div>";
			echo "<table id='t01' border='1'><tr>";
			for ($i=0; $i<$fields_num; $i++){
			   $field = mysqli_fetch_field($reviewresult);
			   echo "<td><b>$field->name</b></td>";
			}
			echo "</tr>\n";
			while($row = mysqli_fetch_row($reviewresult)) {	
				echo "<tr>";	
				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable	
				foreach($row as $cell)		
					echo "<td>$cell</td>";	
				echo "</tr>\n</div>";
			}
			echo "</table></div>";
		}
		mysqli_free_result($result);
		mysqli_free_result($reviewresult);
	}	

	else{
		echo '<script type="text/javascript">',
			 'alert("No valid FID is provided, redirecting to home page...")',
			 '</script>';
		echo '<script type="text/javascript">',
			 'window.location = "homePage.php"',
			 '</script>';
	}
	
	mysqli_close($conn);


	
?>

</html>
