<?php
	//Start the session
	session_start();

	//Get the username and password in hashed form from the $_GET array
	$userEntered = $_GET["name"];
	$userPass = hash("sha512", $_GET["password"]);
	//Initialize the connection variables
	$servername = "localhost";
        $username = "USERNAME";
        $password = "PASSWORD";
        $dbname = "db_Tel";
	//Make a new connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
	//Get all the usernames and password in the users database
	$query = "SELECT username, password FROM users";
        if ($stmt = mysqli_prepare($conn, $query)) {
		//Execute
                mysqli_stmt_execute($stmt);
		//Store the result variables
                mysqli_stmt_bind_result($stmt, $curUser, $curPass);
		//Loop through results
                while (mysqli_stmt_fetch($stmt)) {
			//If the username and hashed passwords match then we can log in!
                	if ($userEntered == $curUser && $userPass == $curPass) {
				//Change the user session variable
				$_SESSION['user'] = $userEntered;
				//Checke the logged in bool to true
                                $_SESSION["logged_in"] = true;
				//Display redirect notice then redirect to the homepage
                                echo "Logged in, redirecting to homepage";
			        echo "<script type=\"text/javascript\"> window.location=\"index.php\"</script>";
                        }
                }
		//If we got to this point then the page hasn't redirected, meaning the usernames and passwords entered
		//did not match those found in the database
		echo "Log in was not successful";
		//Redirect to the login page again
		echo "<script type=\"text/javascript\"> window.location=\"login.php\"</script>";
		//Close the stmt
		mysqli_stmt_close($stmt);
		//Close the connection
		mysqli_close($conn);
	}
?>
