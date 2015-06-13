<?php
        
	//Get the username and password hashed from the $_GET variable	
	$enteredUsername = $_GET["name"];
        $enteredPassword = hash("sha512", $_GET["password"]);
	//Initialize the connection variables
        $servername = "localhost";
        $username = "USERNAME";
        $password = "PASSWORD";
        $dbname = "db_Tel";

	//If the user is not already in the database then we can procede
        if (user_does_not_exist($enteredUsername)) {
		// Create connection
	        $conn = new mysqli($servername, $username, $password, $dbname);
        	// Check connection
	        if ($conn->connect_error) {
        	        die("Connection failed: " . $conn->connect_error);
	        }
		//Prepare to insert a new row into the users table containing the username, hashed password, and IP
		$stmt = $conn->prepare("INSERT INTO users (username, password, ip) VALUES (?, ?, ?)");
		//Bind the corrisponding variables into the stmt
		$stmt->bind_param("sss", $enteredUsername, $enteredPassword, $ip);
		//Get the IP from the user
		$ip = $_SERVER['REMOTE_ADDR'];
		//Execute the insert code
		$stmt->execute();
		//Close the stmt
		$stmt->close();

		//Display a success message then tell the user that they now need to log in
	        echo "Thank you " + $enteredUsername + " for signing up";
		echo "You should now log in " . "<a href='login.html'>here</a>";
		//Close the connection
	        $conn->close();
	//The user already exists in the database so we should tell the user that
	} else {
		echo "User already exists in database!";
	}

	//This function returns true if there is no user in the db and false if their already is
	function user_does_not_exist($name){
		//Initialize the connection variables
		$servername = "localhost";
	        $username = "USERNAME";
	        $password = "PASSWORD";
        	$dbname = "db_Tel";
		//Make new connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		//Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//Get the usernames from the users db
		$query = "SELECT username FROM users";
        	if ($stmt = mysqli_prepare($conn, $query)) {
			//Execute
	                mysqli_stmt_execute($stmt);
			//Bind the results to the corrisponding variables
        	        mysqli_stmt_bind_result($stmt, $curName);
			//Loop through the results
                	while (mysqli_stmt_fetch($stmt)) {
				//If the name from the result is equal to the name that is trying to regester then
				//return false as that user already exists
				if ($curName == $name) {
					return false;
				}
        	        }
			//We got through without finding a matching user, return true as this is a new user!
			return true;
			//Close the stmt
        	        mysqli_stmt_close($stmt);
        	}
	}
?>



