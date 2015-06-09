<?php
        $enteredUsername = $_GET["name"];
        $enteredPassword = hash("sha512", $_GET["password"]);
	$enteredUsername = mysql_real_escape_string(htmlentities(htmlspecialchars(strip_tags($enteredUsername))));
        $servername = "localhost";
        $username = "USERNAME";
        $password = "PASSWORD";
        $dbname = "db_Tel";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO users (username, password)
        VALUES ('$enteredUsername', '$enteredPassword')";

        if ($conn->query($sql) === TRUE) {
                echo "Thank you " + $enteredUsername + " for signing up";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
?>



