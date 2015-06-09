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
	$sql = "SELECT nickname, message FROM messages ORDER BY id DESC";
	$result = $conn->query($sql);

	$counter = 0;
	$displayed = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$counter = $counter + 1;
			echo "<table border=\"1\">";
			if ($counter < $max && $counter > $min)
			{
				$displayed = $displayed + 1;
				echo "<tr>";
        			echo "<td>" . $row["nickname"]. "</td><br><td>" . $row["message"]. "</td></tr><br>";
			}
			echo "</table>";
    		}
	} else {
    		echo "0 results";
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
