<?php
include 'includes/autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_REQUEST['create_acc']) && $_REQUEST['function'] == "create_acc") {
        $FName = secured($_POST['FName']);
        $MName = secured($_POST['MName']);
        $LName = secured($_POST['LName']);
        $Age = secured($_POST['Age']);
        $Birthdate = secured($_POST['Birthdate']);
        $CivilStatus = secured($_POST['CivilStatus']);
        $Brgy = secured($_POST['Brgy']);
        $City = secured($_POST['City']);
        $CompleteAddress = secured($_POST['CompleteAddress']);
        $ContactNumber = secured($_POST['ContactNumber']);
        $UserName = secured($_POST['UserName']);
        $Password = secured($_POST['Password']);
        $TypeUser = secured($_POST['TypeUser']);

        $create_acc = new insert();
        $create_acc->createAcc($FName, $MName, $LName, $Age, $Birthdate, $CivilStatus, $Brgy, $City, $CompleteAddress, $ContactNumber, $UserName, $Password, $TypeUser);
    } elseif (isset($_POST['acc_login']) && $_POST['function'] == "acc_login") {
        $Uname = secured($_POST['Uname']);
        $Password = secured($_POST['Password']);

        $acc_login = new fetch();
        $acc_login->accLogin($Uname, $Password);

    } elseif (isset($_POST['book_request']) && $_POST['function'] == "book_request") {
        $ArtistUserID = secured($_POST['ArtistUserID']);
        $UserID = secured($_COOKIE['UserID']);
        $Address = secured($_POST['Address']);
        $Services = secured($_POST['Services']);
        $Date = secured($_POST['date']);
        $Time = secured($_POST['time']);
        $SampleOutcome = secured($_POST['SampleOutcome']);


        $client_booking = new insert();
        $client_booking->clientBooking($ArtistUserID, $UserID, $Address, $Services, $Date, $Time, $SampleOutcome);
    } else {
        ob_end_flush(header("Location: login.php"));
    }
} else {
    return false;
}