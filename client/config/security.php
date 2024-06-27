<?php
session_start();
ob_start();

function secured($data)
{
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = trim($data);
	$data = str_replace("'", "\'", $data);
	return $data;
}

if (!isset($_COOKIE['UserID'])) {
	ob_end_flush(header("Location: ../login.php"));
}

if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Artist") {
	ob_end_flush(header("Location: ../artist/index.php"));
} else if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Admin") {
	ob_end_flush(header("Location: ../admin/index.php"));
}