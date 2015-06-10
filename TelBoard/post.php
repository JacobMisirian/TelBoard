<html>
<body>

	<?php
	require_once "auth.php";
	$invalid_characters = array("$", "%", "#", "<", ">", "|");
	$message = $_GET["message"];
	$name = $_GET["nickname"];
	$message = addslashes($message);
	$name = addslashes($name);
	$str = str_replace($invalid_characters, " ", $message);
	$str = str_replace($invalid_characters, " ", $name);
	$message = mysql_real_escape_string(htmlentities(htmlspecialchars(strip_tags($message))));
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

	$sql = "INSERT INTO messages (nickname, message)
	VALUES ('$name', '$message')";

	if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
	} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	?>
<br>
The message you submitted is: <?php echo $_GET["message"]; ?>

<script type="text/javascript">
    window.setTimeout(function(){

        window.location.href = "http://misiriansoft.com/tel/board.php";

    }, 5000000);
</script>
</body>
</html>
