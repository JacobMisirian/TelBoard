<html>
	<head>
		<title>Tel Message Board</title>
	</head>
<body>
<center><h2>Tel Message Board</h2>
<a href="index.php"><img src="TelBoard.png" height="150px" width="200px"></a></center>
<br><br>

<?php
	//If there was no values specified for how many entries then default to 0 through 10, otherwise use the predermined amount of entries
	if (!array_key_exists("min", $_GET) || !array_key_exists("max", $_GET)) {
		$min = 0;
		$max = 10;
	} else {
		$min = $_GET["min"];
		$max = $_GET["max"];
	}
	//Initialize the connection variables
	$servername = "localhost";
	$username = "USERNAME";
	$password = "PASSWORD";
	$dbname = "db_Tel";
	//Create new connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
	//Initialize the display variables
	$displayed = 0;
	$counter = 0;
	//Get the name, post, username, and replied variables from the messages db and sort them by their incrementing IDs
	$query = "SELECT id, nickname, message, reply, replied, username FROM messages ORDER BY id DESC";
	if ($stmt = mysqli_prepare($conn, $query)) {
		//Execute
		mysqli_stmt_execute($stmt);
		//Store the values from the execution
		mysqli_stmt_bind_result($stmt, $id, $nickname, $message, $reply, $replied, $user);
		//Loop through all the results
		while (mysqli_stmt_fetch($stmt)) {
			//Increment the counter
			$counter = $counter + 1;
			//Display the table
			echo "<table border=\"1\">";
			//Only display if it is within bounds
			if ($counter < $max && $counter > $min)
			{
				//Incremend the variable of those displayed
				$displayed = $displayed + 1;
				//Display the results
				echo "<tr>";
		       		echo '<td><a href="do-user.php?user=' . $user . '">' . htmlspecialchars($nickname). '</a></td><br><td>' . htmlspecialchars($message). '</td></tr><br>';
				echo '<a href="reply.php?id=' . $id . '"><button>Reply</button></a>';
			
				//End the table
				echo "</table>";
				//If the post has replies, fetch them and display them
	      			if ($replied == "true") {
					//Make a new connection
		                     	$rconn = new mysqli($servername, $username, $password, $dbname);
					//Fetch the name and message from the replies db where the id of the replier is equal to the id of replied
        	              		$rquery = 'SELECT nickname, message FROM replies WHERE id=' . $id;
                 		      	if ($rstmt = mysqli_prepare($rconn, $rquery)){
						//Execute
        	                	    	mysqli_stmt_execute($rstmt);
	                              		$rstmt->store_result();
						//Set the variables
	                        	      	mysqli_stmt_bind_result($rstmt, $rnick, $rmsg);
        	        	               	//Loop through results
						while (mysqli_stmt_fetch($rstmt)) {
							//Display a table with the reply
	                	                    	echo '<table border="1">';
                        	            		echo '<tr><td>Replier: ' . $rnick . '</td><td>' . 'Reply: ' . $rmsg . '</td></tr>';
                                		    	echo '</table>';
                               			}
						//Close the reply stmt
	        	                   	mysqli_stmt_close($rstmt);
        		                }
					//Close the reply connection
                	       		$rconn->close();
            			}
			}
		}
	}
	//Close the stmt
	mysqli_stmt_close($stmt);
	//Close the connection
	$conn->close();

	echo "<br><br>";
	//If we didn't display all of the results then we need to give the user the next button or tell them that they have reached the last entry
	if ($max > $displayed && $displayed != 0) {
		$newMax = $max + 10;
		echo "<a href=\"board.php?min=" . $max . "&max=" . $newMax . "\">Next Page</a>"; 
	} else {
		echo "End of results. Back to <a href=\"board.php\">beginnning</a>";
	}

?>
</body>
</html>
