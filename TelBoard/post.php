<html>
	<head>
		<title>TelBoard Board</title>
	</head>
<body>

	<?php
	//Start the session
	session_start();
	//Make sure that the user is logged in
	require_once "auth.php";
	//Get the message and name from the $_GET array and strip them of haxx0r chars
	$message = htmlspecialchars($_GET["message"]);
	$name = htmlspecialchars($_GET["nickname"] . " as " . $_SESSION['user']);
	//Check if the message or nickname is empty and therefore dumb
	if ($message == "" || $message == " " || $name == "" || $name == " ") {
		die("You are not allowed to have empty messages or usernames!");
	}
	//Initialize the connection variables
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
	//Prepare to insert a new row into the messages table the nickname, message, IP, and proper username of the poster
	$stmt = $conn->prepare("INSERT INTO messages (nickname, message, ip, username) VALUES (?, ?, ?, ?)");
	//Bind the parameters
	$stmt->bind_param("ssss", $name, $message, $ip, $username);
	//Get the user's IP
	$ip = $_SERVER['REMOTE_ADDR'];
	//Since this is not a reply but an original post we can set the replied variable to false
	$replied = "false";
	//Get the current proper username
	$username = $_SESSION['user'];
	//Execute and insert
	$stmt->execute();
	//Close the stmt
	$stmt->close();
	//Close the connection
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
