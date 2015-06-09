<html>
<body>

	<?php
	$invalid_characters = array("$", "%", "#", "<", ">", "|");
	$message = $_GET["message"];
	$name = $_GET["name"];
	$str = str_replace($invalid_characters, " ", $message);
	$str = str_replace($invalid_characters, " ", $name);
	$myFile = "/var/www/html/tel/data.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	$message = $name . ":" . $message . "\n";
	fwrite($fh, $message);
	fclose($fh);
	?>
<br>
The message you submitted is: <?php echo $_GET["message"]; ?>

<script type="text/javascript">
    window.setTimeout(function(){

        window.location.href = "http://misiriansoft.com/tel/board.php";

    }, 5);
</script>
</body>
</html>
