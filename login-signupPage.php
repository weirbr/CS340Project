<!DOCTYPE html>
<?php
		$currentpage="Profile";
		include "pages.php";
		
?>
<html>
	<head>
	<title>Sign Up or Login</title>
	<link rel = "stylesheet" href="index.css">
	<script type="text/javascript" src = "validate.js" ></script> 
	</head>
<body>

<?php
	include "header.php";
	include "connectvars.php";
	$msg = "Login or Sign Up";

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn){
	   die('Could not connect: ' . mysql_error());
	}
	
	//check for signing up
	if(!empty($_POST['email'])){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Escape user inputs for security
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			
			$uNameLogin = mysqli_real_escape_string($conn, $_POST['username2']);
			$uPassLogin = mysqli_real_escape_string($conn, $_POST['password2']);
			//echo "test";
			
			$q = "SELECT * FROM ProjectUser where username = '$uNameLogin'";
			$r = mysqli_query($conn, $q);
			if(mysqli_num_rows($r)>0){
				$msg = "<h2>Within table</h2>";
			}
			
			
			
			// See if username is already in the table
			$queryIn = "SELECT * FROM ProjectUser where username='$username' ";
			$resultIn = mysqli_query($conn, $queryIn);
			if (mysqli_num_rows($resultIn)>0) {
					$msg ="<h2>Can't Add to Table</h2> There is already a user with that username $username<p>";
			} else {	
				// attempt insert query 
				//make some salt
				$salt = base64_encode(mcrypt_create_iv(12 , MCRYPT_DEV_URANDOM));
				$hash = MD5($password.$salt);
				$query = "INSERT INTO ProjectUser (username, email, password, salt) VALUES ('$username', '$email', '$hash', '$salt')";
				if(mysqli_query($conn, $query)){
					$msg =  "Record added successfully.<p>";
				} else{
					echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
				}
			}
		
		}
	}
	//login option
	else{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$uname = mysqli_real_escape_string($conn, $_POST['username2']);
			$pword = mysqli_real_escape_string($conn, $_POST['password2']);
			
			// See if username is already in the table
			$queryL = "SELECT salt FROM ProjectUser WHERE username='$uname' ";
			$resultL = mysqli_query($conn, $queryL);
			
			if ($row = mysqli_fetch_assoc($resultL)) {
				$salt2 = $row['salt'];
				$hash = MD5($pword.$salt2);
				$saltQuery = "SELECT username FROM ProjectUser WHERE username='$uname' AND password='$hash'";
				$finalResult = mysqli_query($conn,$saltQuery);
				if($row = mysqli_fetch_assoc($finalResult)){
					$msg ="You are logged in<p>";
				}
				else{
					$msg = "Incorrect <p>";
				}
			} 
			else {
				$msg = "Username or password is incorrect<p>";
			}	
		}
	}
	
	// close connection
	mysqli_close($conn);
	
?>
<section>
    <h2> <?php echo $msg; ?> </h2>
	<form method="post" id="addForm">
<fieldset>
	<legend>Sign Up:</legend>
    <p>
        <label for="username">Username:</label>
        <input type="text" class="required" name="username" id="username" title="username should be characters">
    </p>
   
	<p>
        <label for="password">Password:</label>
        <input type="text" class="required" name="password" id="password">
	</p>
	
	<p>
        <label for="email">Email:</label>
        <input type="text" class="required" name="email" id="email">
	</p>
		
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
<form method = "post" id="addForm" class = "login">
	<fieldset>
		<legend>Login:</legend>
		<p>
			<label for="username2">Username:</label>
			<input type="text" class="required" name="username2" id="username2" title="username should be characters">
		</p>
   
		<p>
			<label for="password2">Password:</label>
			<input type="text" class="required" name="password2" id="password2">
		</p>
	
	</fieldset>
	<p>
		<input type = "submit" value = "Submit" />
		<input type = "reset" value = "Clear Form" />
	</form>

</body>
</html>
