<?php

        session_start();

        if($_SESSION['logged_in'] != true) {
		die("You are not logged in!");
        }
?>
