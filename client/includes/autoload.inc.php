<?php
include 'config/security.php';
include '../dbConnection/ClsConnection.php';

spl_autoload_register("Autoload");

function Autoload($classname){
	$path = "config/";
	$extenstion = ".config.php";
	$full_path = $path . $classname . $extenstion;

	if(!file_exists($full_path)){
		return false;
	}
	include_once $full_path;
}

$UserID = $_COOKIE['UserID'];
$UserName = "";
// $user_profile = "";
// $user_fname = "";
// $user_mname = "";
// $user_lname = "";
// $user_address = "";
// $user_birth = "";
// $user_phone = "";
// $user_email = "";
$user_uname = "";

$fetch_info_user = new fetch();
$res_fetch_info_user = $fetch_info_user->fetchInfoUser($UserID);
if($res_fetch_info_user->rowCount()){
	$res = $res_fetch_info_user->fetch();

	// $user_profile = $fetch_info_admin['acc_profile'];
	// $user_fname = $fetch_info_admin['acc_fname'];
	// $user_mname = $fetch_info_admin['acc_mname'];
	// $user_lname = $fetch_info_admin['acc_lname'];
	// $user_address = $fetch_info_admin['acc_address'];
	// $user_birth = $fetch_info_admin['acc_birth'];
	// $user_phone = $fetch_info_admin['acc_phone'];
	// $user_email = $fetch_info_admin['acc_email'];
	// $user_uname = $fetch_info_admin['acc_uname'];

	$UserName = $res['LName']. ", ".$res['FName'];
}
