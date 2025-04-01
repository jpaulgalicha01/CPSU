<?php
include 'security.php';
include '../dbConnection/ClsConnection.php';

spl_autoload_register("Autoload");

function Autoload($classname)
{
	$path = "../config/";
	$extenstion = ".config.php";
	$full_path = $path . $classname . $extenstion;

	if (!file_exists($full_path)) {
		return false;
	}
	include_once $full_path;
}


// Cient Information
$Client_FName;
$Client_MName;
$Client_LName;
$Client_Age;
$Client_Birthdate;
$Client_CivilStatus;
$Client_CompleteAddress;
$Client_ProfImg;
$Client_UserName = "";

$fetchingArtistiInfo = new fetch();
$resfetchingArtistiInfo = $fetchingArtistiInfo->fetchingArtistiInfo(secured($_COOKIE['UserID']), "Artist");
if ($resfetchingArtistiInfo->rowCount() != 0) {
	while ($rowfetchingArtistiInfo = $resfetchingArtistiInfo->fetch()) {
		$Client_FName = $rowfetchingArtistiInfo['FName'];
		$Client_MName = $rowfetchingArtistiInfo['MName'];
		$Client_LName = $rowfetchingArtistiInfo['LName'];
		$Client_Age = $rowfetchingArtistiInfo['Age'];
		$Client_Birthdate = date('F d, Y', strtotime($rowfetchingArtistiInfo['Birthdate']));
		$Client_CivilStatus = $rowfetchingArtistiInfo['CivilStatus'];
		$Client_CompleteAddress = $rowfetchingArtistiInfo['CompleteAddress'];
		$Client_ContactNumber = $rowfetchingArtistiInfo["ContactNumber"];
		$Client_ProfImg = $rowfetchingArtistiInfo['ProfImg'];
		$Client_UserName = $rowfetchingArtistiInfo["UserName"];
	}
}

$messege;
$messageCount = new fetch();
$messege = $messageCount->messageCount();
