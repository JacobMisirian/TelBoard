<html>
	<head>
		<title>View Users</title>
	</head>

	<body>
		<center><a href="index.php"><img src="TelBoard.png" height="150px" width="200px"></a></center>
		<h2>Username:<br></h2>
		<?php
			$servername = "localhost";
	        	$username = "USERNAME";
	        	$password = "PASSWORD";
		        $dbname = "db_Tel";
		        $conn = new mysqli($servername, $username, $password, $dbname);

		        if ($conn->connect_error) {
        		        die("Connection failed: " . $conn->connect_error);
        		}

		        $query = "SELECT username FROM users";
        		if ($stmt = mysqli_prepare($conn, $query)) {
                		mysqli_stmt_execute($stmt);
	                	mysqli_stmt_bind_result($stmt, $user);
	        	        while (mysqli_stmt_fetch($stmt)) {
					echo '<br><br><b><a href="do-user.php?user="' . $user . '">' . $user . '</a></b>';
				}
				$stmt->close();
			}
			$conn->close();
		?>
	</body>
</html>
