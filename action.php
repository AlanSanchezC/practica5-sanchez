<?php
if (isset($_POST['token'])){
	$token = $_POST['token'];

	$link = new mysqli('localhost', 'root', '', 'Info');
	if (!$link){
		die('Could not connect: '. mysql_error());
	}

	echo 'Connected successfully';
	
	$result = $link->query("INSERT INTO push(token, fecha) VALUES ('$token',  CURDATE())");
	
	if(!$result){
		echo('error: ' . mysql_error());
	} else {
		echo('Token guardado');
	}

	mysqli_close($link);
}
?>