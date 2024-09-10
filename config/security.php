<?php
ob_start();
session_start();


function secured($data)
{
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripcslashes($data);
    $data = str_replace("'", "\'", $data);
    return $data;
}


if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Admin") {
	ob_end_flush(header("Location: admin/index.php"));
}

if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Artist") {
	ob_end_flush(header("Location: artist/index.php"));
}