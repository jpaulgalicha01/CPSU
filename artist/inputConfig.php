<?php
include 'includes/autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
 
  if (isset($_POST['creating_services']) && secured($_POST['function'] == "creating_services")) {
    $ServicesName = secured($_POST['ServicesName']);
    $ServicePrice = secured($_POST['ServicePrice']);

    $AddServices = new insert();
    $AddServices->insertServices($ServicesName, $ServicePrice);
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

    $update_booking = new update();
    $res_update_booking = $update_booking->updateBooking($ClientUserID, $status);

  } else if (isset($_POST['change_profile']) && secured($_POST['function'] == "change_profile")) {
    $change_img = $_FILES['change_img']['name'];

    $change_prof_img = new update();
    $change_prof_img->changeProfImg($change_img);
  } else if (isset($_POST['add_profile_images']) && secured($_POST['function'] == "add_profile_images")) {

    $add_profile_images = new insert();
    $add_profile_images->addProfileImages();
  } else if (isset($_POST['addDescription']) && secured($_POST['function'] == "addDescription")) {
    $description = secured($_REQUEST['description']);

    $add_description = new insert();
    $add_description->addDescription($description);
  } else if (isset($_POST['update_info']) && secured($_POST['function'] == "update_info")) {
    $acc_fname = secured($_POST['acc_fname']);
    $acc_mname = secured($_POST['acc_mname']);
    $acc_lname = secured($_POST['acc_lname']);
    $acc_lname = secured($_POST['acc_lname']);
    $acc_address = secured($_POST['acc_address']);
    $acc_birth = secured($_POST['acc_birth']);
    $acc_phone = secured($_POST['acc_phone']);
    $acc_email = secured($_POST['acc_email']);
    $acc_uname = secured($_POST['acc_uname']);
    $curr_pass = secured($_POST['curr_pass']);
    $new_pass = secured($_POST['new_pass']);

    $update_info = new update();
    $update_info->updateInfo($acc_fname, $acc_mname, $acc_lname, $acc_address, $acc_birth, $acc_phone, $acc_email, $acc_uname, $curr_pass, $new_pass);
  }
  
  else if(isset($_REQUEST['month']) && isset($_REQUEST['year'])){
    $month = secured($_REQUEST['month']);
    $year= secured($_REQUEST['year']);

    $fetching_reserved_date = new fetch();
    $fetching_reserved_date->fetchingReservedDate($month,$year);
  } 

  else if(isset($_GET["function"]) && $_GET["function"] == "saved_reserved_date"){
    $selectedDates = $_GET['data']; 

    $insertDateSched = new insert();
    $insertDateSched->insertDateSched($selectedDates);
  }

  else {
    ob_end_flush(header("Location: index.php"));
  }


  
} else {
  return false;
}

?>