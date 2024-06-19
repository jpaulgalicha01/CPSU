<?php
ob_start();
session_start();


if(isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] =="Admin"){
	ob_end_flush(header("Location: admin/index.php"));
}

if(isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] =="Artist"){
	ob_end_flush(header("Location: artist/index.php"));
}