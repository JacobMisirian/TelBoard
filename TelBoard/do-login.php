<?php

	session_start();
	$userEntered = $_GET["name"];
	$userPass = hash("sha512", $_GET["password"]);
	$servername = "localhost";
        $username = "USERNAME";
        $password = "PASSWORD";
        $dbname = "db_Tel";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT username, password FROM users";
        $result = $conn->query($sql);

        $counter = 0;
        $displayed = 0;
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
			if ($userEntered == $row["username"] && $userPass == $row["password"]) {
				$_SESSION["logged_in"] = true;
				echo "Logged in, redirecting to homepage";
				echo "<script type=\"text/javascript\"> window.location=\"http://misiriansoft.com/tel/\"</script>";
			}
		}
		echo "Log in was not successful";
		echo "<script type=\"text/javascript\"> window.location=\"http://misiriansoft.com/tel/login.html\"</script>";
	}
?>
