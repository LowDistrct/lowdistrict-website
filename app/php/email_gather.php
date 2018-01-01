<?php

include "core.php";

// METHODS

function exists($email) {
	global $con;
	$result = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `emails` WHERE `email` = '$email'"));
	if ($result == 1) {
		return true;
	}
	return false;
}

// MAIN API

if (exists($_POST['email'])) {
	echo "You've already subscribed!";
	http_response_code(201);
	return;
}

if (strpos($_POST['email'], "@") == false) {
	echo "E-Mail invalid!";
	http_response_code(201);
	return;
}

if (strpos(explode("@", $_POST['email'])[1], ".") == false) {
	echo "E-Mail invalid!";
	http_response_code(201);
	return;
}

mysqli_query($con, "INSERT INTO `emails`(`email`) VALUES ('$_POST[email]')");
http_response_code(200);

?>
