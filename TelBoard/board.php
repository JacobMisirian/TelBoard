<html>
	<head>
		<title>Tel Message Board</title>
	</head>
<body>
<h2 style="text-align:center;">Tel Message Board</h2>
<br><br>
<?php
	if (!array_key_exists("min", $_GET) || !array_key_exists("max", $_GET)) {
		$min = 0;
		$max = 10;
	} else {
		$min = $_GET["min"];
		$max = $_GET["max"];
	}

	$servername = "localhost";
	$username = "USERNAME";
	$password = "PASSWORD";
	$dbname = "db_Tel";
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
	$displayed = 0;
	$counter = 0;
	$query = "SELECT nickname, message FROM messages ORDER BY id DESC";
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $nickname, $message);
		while (mysqli_stmt_fetch($stmt)) {
			$counter = $counter + 1;
			echo "<table border=\"1\">";
			if ($counter < $max && $counter > $min)
			{
				$displayed = $displayed + 1;
				echo "<tr>";
        			echo "<td>" . $nickname. "</td><br><td>" . $message. "</td></tr><br>";
			}
			echo "</table>";
		}
		mysqli_stmt_close($stmt);
	}
	$conn->close();

	echo "<br><br>";
	if ($max > $displayed && $displayed != 0) {
		$newMax = $max + 10;
		echo "<a href=\"board.php?min=" . $max . "&max=" . $newMax . "\">Next Page</a>"; 
	} else {
		echo "End of results. Back to <a href=\"board.php\">beginnning</a>";
	}

?>
</body>
</html>
