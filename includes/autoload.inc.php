<?php
date_default_timezone_set('Asia/Manila');

$date = date('Y-m-d');

include 'dbConnection/ClsConnection.php';
include "config/security.php";


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


function FormatDate($formatType, $CurrentDate)
{
    $data = date($formatType, strtotime($CurrentDate));
    return $data;
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

if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Client") {
    $fetchingArtistiInfo = new fetch();
    $resfetchingArtistiInfo = $fetchingArtistiInfo->fetchingArtistiInfo(secured($_COOKIE['UserID']), "Client");
    if ($resfetchingArtistiInfo->rowCount() != 0) {
        while ($rowfetchingArtistiInfo = $resfetchingArtistiInfo->fetch()) {
            $Client_FName = $rowfetchingArtistiInfo['FName'];
            $Client_MName = $rowfetchingArtistiInfo['MName'];
            $Client_LName = $rowfetchingArtistiInfo['LName'];
            $Client_Age = $rowfetchingArtistiInfo['Age'];
            $Client_Birthdate = date('F d, Y', strtotime($rowfetchingArtistiInfo['Birthdate']));
            $Client_CivilStatus = $rowfetchingArtistiInfo['CivilStatus'];
            $Client_CompleteAddress = $rowfetchingArtistiInfo['CompleteAddress'];
            $Client_ProfImg = $rowfetchingArtistiInfo['ProfImg'];
        }
    }
}


//--------------- Checking Booking Past 3 Days -------------//
$checkingBooking = new update();
$checkingBooking->checkingBooking();


if (isset($_COOKIE["UserID"])) {
    $messege;
    $messageCount = new fetch();
    $messege = $messageCount->messageCount();
}
