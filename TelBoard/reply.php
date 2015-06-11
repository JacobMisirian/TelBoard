<html>
	<head>
		<title>Reply to post</title>
	</head>

	<body>

		<form action="do-reply.php" method="get">
	        Id:<input type="text" name="id" value="<?php echo $_GET['id']; ?>"></input><br>
		Name:<br><input type="text" name="nickname"></input><br>
        	Message:<br><textarea name="message" cols="40" rows="5"></textarea><br>
	        <input type="submit">
        	</form>	
	</body>
</html>
