<?php

$host = "127.0.0.1";
$user = "lowdistrict_root";
$pass = "Admin123!";
$data = "lowdistrict";
$port = 3306;
$con = mysqli_connect($host, $user, $pass, $data, $port);

// DATE FUNCTIONS
function getRelativeDateFormat($time) {
	$now = time();
	$minutes = floor(($now - $time) / 60);
	$hours = floor(($now - $time) / 3600);
	$days = floor(($now - $time) / 86400);
	$months = intval(date('m', $now)) - intval(date('m', $time));
	$years = intval(date('Y', $now)) - intval(date('Y', $time));
	// Month Correction
	if (intval(date('j', $time)) > intval(date('j', $now))) {
		$months--;
	}
	if ($years > 0) {
		$months += 12;
	}
	// Years Correction
	if (intval(date('m', $time)) > intval(date('m', $now))) {
		$years--;
	}
	if ($years > 0) {
		switch ($years) {
			case 1:
				return "1 year ago";
			default:
				return $years." years ago";
		}
	}
	if ($months > 0) {
		switch ($months) {
			case 1:
				return "1 month ago";
			default:
				return $months." months ago";
		}
	}
	if ($days > 0) {
		switch ($days) {
			case 1:
				return "1 day ago";
			default:
				return $days." days ago";
		}
	}
	if ($hours > 0) {
		switch ($hours) {
			case 1:
				return "1 hour ago";
			default:
				return $hours." hours ago";
		}
	}
	if ($minutes > 0) {
		switch ($minutes) {
			case 1:
				return "1 minute ago";
			default:
				return $minutes." minutes ago";
		}
	}
	return "just now";
}
function parseDate($date) {
	if ($date == "0000-00-00") {
		return "?";
	}
	else {
		return date("F", strtotime($date))." ".date("Y", strtotime($date));
	}
}

// SQL FUNCTIONS
function sqlQueryArray($sql) {
	global $con;
	$q = mysqli_query($con, $sql);
	$output = [];
	while ($row = mysqli_fetch_array($q)) {
		array_push($output, $row);
	}
	return $output;
}
function sqlQueryNum($sql) {
	global $con;
	return mysqli_num_rows(mysqli_query($con, $sql));
}
?>
