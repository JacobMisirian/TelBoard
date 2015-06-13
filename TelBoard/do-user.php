<html>
	<head>
		<title>User <?php echo $_GET['user']; ?></title>
	</head>

	<body>
		<center><a href="index.php"><img src="TelBoard.png" height="150px" width="200px"></img></a></center><br><br>
		<h2>User Lookup</h2>
		<?php
			//Initialize the connection variables
			$servername = "localhost";
			$username = "USERNAME";
			$password = "PASSWORD";
			$dbname = "db_Tel";
			//Create a new connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			//Check connection
			if ($conn->connect_error) {
		    		die("Connection failed: " . $conn->connect_error);
			}
			//Get the username from the users table where the username is equal to the username.
			//Basically just a check that the user exists
			$query = 'SELECT username FROM users WHERE username="' . $_GET['user'] . '"';
			if ($stmt = mysqli_prepare($conn, $query)) {
				//Execute
				mysqli_stmt_execute($stmt);
				//Bind the results to the corrisponding variables
				mysqli_stmt_bind_result($stmt, $username);
				//Loop through the results
				while (mysqli_stmt_fetch($stmt)) {
					//Write the name of the user to the user
					echo "<b>Name of user: " . $username . "</b>";
				}
				//Close the stmt
				mysqli_stmt_close($stmt);
			}
			//Close the connection
			$conn->close();

			//Tell the user we will now echo all the messages the user has posted
			echo "<br><br><b>Messages this user has posted:</b><br>";
			//Create a new connection
			$conn = new mysqli("localhost", "USERNAME", "PASSWORD", "db_Tel");
			//Get name and message from the messages db that are from the user in question
			$query = 'SELECT nickname, message FROM messages WHERE username="' . $_GET['user'] . '"';
			if ($stmt = mysqli_prepare($conn, $query)) {
				//Execute
				mysqli_stmt_execute($stmt);
				//Bind results to corrisponding variables
				mysqli_stmt_bind_result($stmt, $nickname, $message);
				//Loop through the results
				while (mysqli_stmt_fetch($stmt)) {
					//Display the results to the user
					echo '<table border=1>';
					echo '<tr><td>' . $nickname . '</td><td>' . $message . '</td></tr></table><br>';
				}
				//Close the stmt
				mysqli_stmt_close($stmt);
			}
			//Close the connection
			$conn->close();
		?>
	</body>
</html>
