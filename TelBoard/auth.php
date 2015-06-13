<?php
	//Start the session
        session_start();
	
	//Detect is the logged in variable is set to false or the user variable is NULL
        if($_SESSION['logged_in'] != true || $_SESSION['user'] == "" || $_SESSION['user'] == " ") {
		//Kill the program and tell the user to go to the logon page
		die("You are not logged in! Log in at http://misiriansoft.com/tel/login.php");
        }
?>
