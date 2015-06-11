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
	$query = "SELECT username, password FROM users";
        if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $curUser, $curPass);
                while (mysqli_stmt_fetch($stmt)) {
                	if ($userEntered == $curUser && $userPass == $curPass) {
				$_SESSION['user'] = $userEntered;
                                $_SESSION["logged_in"] = true;
                                echo "Logged in, redirecting to homepage";
			        echo "<script type=\"text/javascript\"> window.location=\"http://misiriansoft.com/tel/\"</script>";
                        }
                }

		echo "Log in was not successful";
		echo "<script type=\"text/javascript\"> window.location=\"http://misiriansoft.com/tel/login.html\"</script>";
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
?>
