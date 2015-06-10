<html>
	<head>
		<title>Tel Message Board</title>
	</head>
<body>
	<?php session_start (); ?>
	<center>Welcome to Tel, a way to publically tel the world whatever is on your mind!<br><br>
	<img src="TelBoard.png" height="150px" width="200px"></img></center>
	
	<?php if ($_SESSION['logged_in'] != true): ?>
		<a href="login.html"><button>Login or Register</button></a>
	<?php endif; ?>
	
	<form action="post.php" method="get">
	Nickname:<br><input type="text" name="nickname"></input><br>
	Message:<br><textarea name="message" cols="40" rows="5"></textarea><br>
	<input type="submit">
	</form>

	<b>You can view the current board <a href="board.php">here</a>.</b>
</body>
</html>
