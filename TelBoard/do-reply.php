<html>
	<head>
		<title>Replying...</title>
	</head>

	<body>
		<?php
			require_once "auth.php";
	        	$message = htmlspecialchars($_GET["message"]);
	        	$name = htmlspecialchars($_GET["nickname"] . " as " . $_SESSION['user']);
        		if ($message == "" || $message == " " || $name == "" || $name == " ") {
                		die("You are not allowed to have empty messages or usernames!");
		        }
	
		        $servername = "localhost";
        		$username = "USERNAME";
		        $password = "PASSWORD";
		        $dbname = "db_Tel";

		        $conn = new mysqli($servername, $username, $password, $dbname);
	        	if ($conn->connect_error) {
        		        die("Connection failed: " . $conn->connect_error);
	        	}

		        $stmt = $conn->prepare("INSERT INTO replies (nickname, message, id) VALUES (?, ?, ?)");
        		$stmt->bind_param("sss", $name, $message, $id);
			$id = $_GET['id'];
		        $stmt->execute();
        		$stmt->close();

			$mstmt = $conn->prepare('UPDATE messages SET replied="true" WHERE id=' . $_GET['id']);
			$mstmt->execute();
			$mstmt->close();

 	       		$conn->close();
        	?>
		<script type="text/javascript">
                	window.setTimeout(function(){
                	window.location.href = "board.php";
	        }, 5);
        	</script>
	</body>
</html>
