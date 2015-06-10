<html>
	<head>
		<title>TelBoard Board</title>
	</head>
<body>

	<?php
	session_start();
	require_once "auth.php";
	$message = htmlspecialchars($_GET["message"]);
	$name = $_GET["nickname"];
	if ($message == "" || $message == " " || $name == "" || $name == " ") {
		die("You are not allowed to have empty messages or usernames!");
	}

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

	$stmt = $conn->prepare("INSERT INTO messages (nickname, message, ip) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $name, $message, $ip);
	$ip = $_SERVER['REMOTE_ADDR'];
	$stmt->execute();
	$stmt->close();
	$conn->close();
	?>
	<br>
	The message you submitted is: <?php echo $_GET["message"]; ?>

	<script type="text/javascript">
    		window.setTimeout(function(){

        	window.location.href = "board.php";

	}, 5);
	</script>
</body>

</html>
