<?php
include 'config/security.php';
include '../dbConnection/ClsConnection.php';

spl_autoload_register("Autoload");

function Autoload($classname)
{
	$path = "config/";
	$extenstion = ".config.php";
	$full_path = $path . $classname . $extenstion;

	if (!file_exists($full_path)) {
		return false;
	}
	include_once $full_path;
}

$UserID = $_COOKIE['UserID'];
$UserName = "";
$user_uname = "";

$fetch_info_user = new fetch();
$res_fetch_info_user = $fetch_info_user->fetchInfoUser($UserID);
if ($res_fetch_info_user->rowCount()) {
	$res = $res_fetch_info_user->fetch();
	$UserName = $res['LName'] . ", " . $res['FName'];
}
