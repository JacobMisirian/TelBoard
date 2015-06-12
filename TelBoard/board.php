<html>
	<head>
		<title>Tel Message Board</title>
	</head>
<body>
<center><h2>Tel Message Board</h2>
<a href="index.php"><img src="TelBoard.png" height="150px" width="200px"></a></center>
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
	$query = "SELECT id, nickname, message, reply, replied, username FROM messages ORDER BY id DESC";
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $id, $nickname, $message, $reply, $replied, $user);
		while (mysqli_stmt_fetch($stmt)) {
			$counter = $counter + 1;
			echo "<table border=\"1\">";
			if ($counter < $max && $counter > $min)
			{
				$displayed = $displayed + 1;
				echo "<tr>";
		       		echo '<td><a href="do-user.php?user=' . $user . '">' . htmlspecialchars($nickname). '</a></td><br><td>' . htmlspecialchars($message). '</td></tr><br>';
				echo '<a href="reply.php?id=' . $id . '"><button>Reply</button></a>';
			}
			echo "</table>";
	      		if ($replied == "true") {
	                     	$rconn = new mysqli($servername, $username, $password, $dbname);
        	              	$rquery = 'SELECT nickname, message FROM replies WHERE id=' . $id;
                 	      	if ($rstmt = mysqli_prepare($rconn, $rquery)){
                        	    	mysqli_stmt_execute($rstmt);
                              		$rstmt->store_result();
	                              	mysqli_stmt_bind_result($rstmt, $rnick, $rmsg);
        	                       	while (mysqli_stmt_fetch($rstmt)) {
                	                    	echo '<table border="1">';
                        	            	echo '<tr><td>Replier: ' . $rnick . '</td><td>' . 'Reply: ' . $rmsg . '</td></tr>';
                                	    	echo '</table>';
                               		}
	                           	mysqli_stmt_close($rstmt);
        	                }
                	       	$rconn->close();
            		}
		}
	}
	mysqli_stmt_close($stmt);
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
