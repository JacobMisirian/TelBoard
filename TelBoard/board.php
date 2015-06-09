<html>
	<head>
		<title>Tel Message Board</title>
	</head>
<body>
<h2 style="text-align:center;">Tel Message Board</h2>
<br><br>
<?php
$contents = file("/var/www/html/tel/data.txt");
for ($x = 0; $x < count($contents); $x++) {
	$data = explode(":", $contents[$x], 2);
	echo "Name: " . $data[0] . "<br>";
	echo "Message: " . $data[1] . "<br>";
}
?>
</body>
</html>
