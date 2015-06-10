<?php

        session_start();

	echo $_SESSION['logged_in'];
        if($_SESSION['logged_in'] != true) {
		die("You are not logged in! Log in at http://misiriansoft.com/login.html");
        }
?>
