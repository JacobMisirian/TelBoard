<html>
	<head>
		<title>View Users</title>
	</head>

	<body>
		<center><a href="index.php"><img src="TelBoard.png" height="150px" width="200px"></a></center>
		<h2>Username:<br></h2>
		<?php
			//Initialize connection variables
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
			//Get the username collumn from the users table
		        $query = "SELECT username FROM users";
        		if ($stmt = mysqli_prepare($conn, $query)) {
				//Execute
                		mysqli_stmt_execute($stmt);
				//Bind the result variables
	                	mysqli_stmt_bind_result($stmt, $user);
				//Loop through the data
	        	        while (mysqli_stmt_fetch($stmt)) {
					//Display the users with a link to their profile on the screen
					echo '<br><br><b><a href="do-user.php?user=' . $user . '">' . $user . '</a></b>';
				}
				//Close the stmt
				$stmt->close();
			}
			//Close the connection
			$conn->close();
		?>
	</body>
</html>
