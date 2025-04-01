<?php
include 'includes/autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {

  if (isset($_POST['creating_services']) && secured($_POST['function'] == "creating_services")) {
    $ServiceCatNo = secured($_POST['ServiceCatNo']);
    $ServicesName = secured($_POST['ServicesName']);
    $ServicePrice = secured($_POST['ServicePrice']);
    $ServicesPolicy = secured($_POST["ServicesPolicy"]);

    $AddServices = new insert();
    $AddServices->insertServices($ServiceCatNo, $ServicesName, $ServicePrice, $ServicesPolicy);
  } else if (isset($_REQUEST['ServicesId'])) {
    $ServicesId = secured($_REQUEST['ServicesId']);

    $Services_Fetch = new fetch();
    $Services_Fetch->ServicesFetchId($ServicesId);
  } else if (isset($_REQUEST['DescriptionID'])) {
    $DescriptionID = secured($_REQUEST['DescriptionID']);

    $Description_Fetch = new fetch();
    $Description_Fetch->DescriptionFetchID($DescriptionID);
  } else if (isset($_REQUEST['viewBookingInfo'])) {
    $BookingID = secured($_REQUEST['viewBookingInfo']);
    $Status = secured($_REQUEST['Status']);

    $fetchingBooking = new fetch();

    $resfetchingBooking = $fetchingBooking->fetchingBooking($BookingID, $Status);
  } else if (isset($_POST['booking_action']) && secured($_POST['function'] == "booking_action")) {
    $ClientUserID = secured($_POST['ClientUserID']);
    $status = secured($_POST['status']);
    $itemNo = secured($_POST["ItemNo"]);

    $update_booking = new update();
    $res_update_booking = $update_booking->updateBooking($ClientUserID, $status, $itemNo);
  } elseif (isset($_POST['change_profile']) && secured($_POST['function'] == "change_profile")) {
    $change_prof_img = new update();
    $change_prof_img->changeProfImg();
  }
  // else if (isset($_POST['add_profile_images']) && secured($_POST['function'] == "add_profile_images")) {

  //   $add_profile_images = new insert();
  //   $add_profile_images->addProfileImages();
  // }
  // else if (isset($_POST['addDescription']) && secured($_POST['function'] == "addDescription")) {
  //   $description = secured($_REQUEST['description']);

  //   $add_description = new insert();
  //   $add_description->addDescription($description);
  // } 
  elseif (isset($_POST['update_info']) && secured($_POST['function'] == "update_info")) {
    $FName = secured($_POST["FName"]);
    $MName = secured($_POST["MName"]);
    $LName = secured($_POST["LName"]);
    $UserName = secured($_POST["UserName"]);
    $OPass = secured($_POST["OPass"]);
    $NPAss = secured($_POST["NPAss"]);

    $updateInfo = new update();
    $updateInfo->updateInfo($FName, $MName, $LName, $UserName, $OPass, $NPAss);
  } else if (isset($_REQUEST['month']) && isset($_REQUEST['year'])) {
    $month = secured($_REQUEST['month']);
    $year = secured($_REQUEST['year']);

    $fetching_reserved_date = new fetch();
    $fetching_reserved_date->fetchingReservedDate($month, $year);
  } else if (isset($_GET["function"]) && $_GET["function"] == "saved_reserved_date") {
    $selectedDates = $_GET['data'];

    $insertDateSched = new insert();
    $insertDateSched->insertDateSched($selectedDates);
  } else if (isset($_GET["profImageProfile"])) {
    $value = secured($_GET["profImageProfile"]);
    $ServiceName = secured($_GET["ServiceName"]);

    $fetchingProfImg = new fetch();
    $resfetchingProfImg = $fetchingProfImg->fetchingProfImg($value, $ServiceName);
  } else if (isset($_POST["edit_services"]) && secured($_POST['function'] == "edit_services")) {
    $servicesID = secured($_POST["servicesID"]);
    $prevServicesName = secured($_POST["prevServicesName"]);
    $editServiceCatNo = secured($_POST["prevServicesCat"]);
    $editServicePrice = secured($_POST["editServicePrice"]);
    $editServicesName = secured($_POST["prevServicesName"]);
    $editServicesPolicy = secured($_POST["editServicesPolicy"]);

    $editservices = new update();
    $reseditservices = $editservices->editservices($servicesID, $prevServicesName, $editServiceCatNo, $editServicePrice, $editServicesName, $editServicesPolicy);
  } else if (isset($_GET["deleteServicesImg"]) && isset($_GET["servicesName"]) && $_GET["function"] == "deleteServicesImg") {
    $imgRowNum = secured($_GET["deleteServicesImg"]);
    $servicesName = secured($_GET["servicesName"]);

    $deleteImg = new delete();
    $resdeleteImg = $deleteImg->deleteImg($imgRowNum, $servicesName);
  } else if (isset($_POST["editProfImg"]) && $_POST["function"] === "editProfImg") {

    $servicesCatNo = secured($_POST["servicesCatNo"]);
    $servicesName = secured($_POST["servicesName"]);

    $add_profile_images = new insert();
    $add_profile_images->addProfileImages($servicesCatNo, $servicesName);
  } elseif ($_GET["function"] == "Earnings Overview") {

    $fetchingEarnOver = new fetch();
    $fetchingEarnOver-> fetchingEarnOver();

  } else {
    ob_end_flush(header("Location: index.php"));
  }
} else {
  return false;
}
