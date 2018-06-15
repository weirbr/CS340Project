<!DOCTYPE html>
<?php
		$currentpage="Search Parks";
		include "pages.php";
		
?>
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
	$attribute = mysqli_real_escape_string($conn, $_POST['attribute']);
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if($attribute == "" && $location != ""){
				$query = "SELECT city, parkID
						FROM `ProjectParkAddress`
						WHERE city = '$location'
						LIMIT 1";
						
				$result = mysqli_query($conn, $query);
				if ($result){
						
					while($row = mysqli_fetch_row($result)) {
					$city = $row[0];
					$parkID = $row[1];
					}
					
					$query = "SELECT pName
						FROM `ProjectPark`
						WHERE parkID = '$parkID'
						LIMTI 1";
						
					$result = mysqli_query($conn, $query);
					
					while($row = mysqli_fetch_row($result)) {
						$pName = $row[0];
					}
					$msg = "<p>You might like this park we found! Try out <em>$pName</em> in <em>$city</em></p>";
				
				}
				else{
					$msg = "<p>Sorry, we couldn't find a park in <em>$location</em></p>";
				}	
			}
			
			else if($attribute != "" && $location == ""){
				$query = "SELECT pName, parkID
						FROM `ProjectPark` 
						WHERE pDescription LIKE '%{$attribute}%'
						LIMIT 1";
						
				$result = mysqli_query($conn, $query);
				if ($result){
					
					while($row = mysqli_fetch_row($result)) {
						$pName = $row[0];
						$parkID = $row[1];
					}
					
					$query = "SELECT city
						FROM `ProjectParkAddress`
						WHERE parkID = '$parkID'
						LIMIT 1";
					
					$result = mysqli_query($conn, $query);
						
					while($row = mysqli_fetch_row($result)) {
						$city = $row[0];
					}
					
					$msg = "<p>You might like this park we found! Try out <em>$pName</em> in <em>$city</em>, we hear that it is <em>$attribute</em> </p>";
					
				}
				else{
					$msg = "<p>Sorry, we couldn't find a park that was <em>$attribute</em></p>";
				}	
			}
			
			else if($attribute != "" && $location != ""){
				
				$query = "SELECT city, parkID
						FROM `ProjectParkAddress`
						WHERE city = '$location'
						LIMIT 1";
						
				$result = mysqli_query($conn, $query);
				
				while($row = mysqli_fetch_row($result)) {
						$city = $row[0];
						$parkID1 = $row[1];
					}
					
				if ($result){
					$query = "SELECT pName, parkID
						FROM `ProjectPark`
						WHERE pDescription LIKE '%{$attribute}%'
						LIMIT 1";
					
					$result = mysqli_query($conn, $query);
						
					while($row = mysqli_fetch_row($result)) {
						$pName = $row[0];
						$parkID2 = $row[1];
					}
					
					if($parkID1==$parkID2){
						
						$msg = "<p>There is a park in <em>$city</em> that has <em>$attribute</em> called <em>$pName</em> </p>";
					}
					else{
						$msg = "<p>Sorry, we couldn't find a park that has <em>$attribute</em> in <em>$city</em></p>";
					}
				}
				else{
					$msg = "<p>Sorry, we couldn't find a park that has <em>$attribute</em> in <em>$city</em></p>";
				}	
			}
		}
	mysqli_free_result($result);
	mysqli_close($conn);

?>
<h2> <?php echo $msg; ?> </h2>
<section id = "searchForm"> 
	<form method = "POST" id = "location">
	<p> Pick a Location </p>
		<div>
			<input type="checkbox" name = "location" value = "Grant City"> Grant City
		</div>
		
		<div>
			<input type="checkbox" name = "location" value = "Tri Cities"> Tri Cities
		</div>
		
		<div>
			<input type="checkbox" name = "location" value = "Laketon"> Laketon
		</div>
		
		<div>
			<input type="checkbox" name = "location" value = "Lakewoord"> Lakewood
		</div>
		
		
	<p> Pick an attribute </p>
		<div>
			<input type="checkbox" name = "attribute" value = "scenic"> scenic
		</div>
		
		<div>
			<input type="checkbox" name = "attribute" value = "campsites"> campsites
		</div>
		
		<div>
			<input type="checkbox" name = "attribute" value = "hikes"> hiking
		</div>
		<div>
			<input type="checkbox" name = "attribute" value = "waterfalls"> waterfalls
		
		<p>
		<input type = "submit" value = "Search" />
		<input type = "reset" value = "Clear Search" />
		</p>
	</form>
</section>

</body>
</html>
