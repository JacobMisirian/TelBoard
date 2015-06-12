<html>
	<head>
		<title>User <?php echo $_GET['user']; ?></title>
	</head>

	<body>
		<center><a href="index.php"><img src="TelBoard.png" height="150px" width="200px"></img></a></center><br><br>
		<h2>User Lookup</h2>
		<?php
			$servername = "localhost";
			$username = "USERNAME";
			$password = "PASSWORD";
			$dbname = "db_Tel";
			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
		    		die("Connection failed: " . $conn->connect_error);
			}

			$query = 'SELECT username FROM users WHERE username="' . $_GET['user'] . '"';
			if ($stmt = mysqli_prepare($conn, $query)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $username);
				while (mysqli_stmt_fetch($stmt)) {
					echo "<b>Name of user: " . $username . "</b>";
				}
				mysqli_stmt_close($stmt);
			}
			echo "<br><br><b>Messages this user has posted:</b><br>";
			$conn->close();
			$conn = new mysqli("localhost", "USERNAME", "PASSWORD", "db_Tel");
			$query = 'SELECT nickname, message FROM messages WHERE username="' . $_GET['user'] . '"';
			if ($stmt = mysqli_prepare($conn, $query)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $nickname, $message);
				while (mysqli_stmt_fetch($stmt)) {
					echo '<table border=1>';
					echo '<tr><td>' . $nickname . '</td><td>' . $message . '</td></tr></table>';
				}
				mysqli_stmt_close($stmt);
			}
			$conn->close();
		?>
	</body>
</html>
