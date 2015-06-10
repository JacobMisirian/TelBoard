<?php
        
	
	$enteredUsername = $_GET["name"];
        $enteredPassword = hash("sha512", $_GET["password"]);
	$enteredUsername = mysql_real_escape_string(htmlentities(htmlspecialchars(strip_tags($enteredUsername))));
        $servername = "localhost";
        $username = "USERNAME";
        $password = "PASSWORD";
        $dbname = "db_Tel";

        if (user_does_not_exist($enteredUsername)) {
		// Create connection
	        $conn = new mysqli($servername, $username, $password, $dbname);
        	// Check connection
	        if ($conn->connect_error) {
        	        die("Connection failed: " . $conn->connect_error);
	        }
		$stmt = $conn->prepare("INSERT INTO users (username, password, ip) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $enteredUsername, $enteredPassword, $ip);
		$ip = $_SERVER['REMOTE_ADDR'];
		$stmt->execute();
		$stmt->close();

	        echo "Thank you " + $enteredUsername + " for signing up";
		echo "You should now log in " . "<a href='login.html'>here</a>";

	        $conn->close();
	} else {
		echo "User already exists in database!";
	}

	function user_does_not_exist($name){
		$servername = "localhost";
	        $username = "root";
	        $password = "";
        	$dbname = "db_Tel";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$query = "SELECT username FROM users";
        	if ($stmt = mysqli_prepare($conn, $query)) {
	                mysqli_stmt_execute($stmt);
        	        mysqli_stmt_bind_result($stmt, $curName);
                	while (mysqli_stmt_fetch($stmt)) {
				if ($curName == $name) {
					return false;
				}
        	        }
		return true;
                mysqli_stmt_close($stmt);
        	}
	}
?>



