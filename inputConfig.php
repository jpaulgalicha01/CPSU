<?php
include 'includes/autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_REQUEST['create_acc'])) {
        $TypeUser = secured($_POST['TypeUser']);
        $FName = "";
        $MName = "";
        $LName = "";
        $Age = "";
        $Birthdate = "";
        $CivilStatus = "";
        $Brgy = "";
        $City = "";
        $CompleteAddress = "";
        $ContactNumber = "";
        if ($TypeUser == "Artist" || $TypeUser == "Client") {
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
        } else {
            $FName = secured($_POST['CName']);
            $Brgy = secured($_POST['CNBrgy']);
            $City = secured($_POST['CNCity']);
            $CompleteAddress = secured($_POST['CNCompleteAddress']);
            $ContactNumber = secured($_POST['CNContactNumber']);
            $TypeUser = "Artist";
        }
        $UserName = secured($_POST['UserName']);
        $Password = secured($_POST['Password']);
        $create_acc = new insert();
        $create_acc->createAcc($FName, $MName, $LName, $Age, $Birthdate, $CivilStatus, $Brgy, $City, $CompleteAddress, $ContactNumber, $UserName, $Password, $TypeUser);
    } elseif (isset($_POST['acc_login'])) {
        $Uname = secured($_POST['Uname']);
        $Password = secured($_POST['Password']);

        $acc_login = new fetch();
        $acc_login->accLogin($Uname, $Password);
    } elseif (isset($_POST['book_request']) && $_POST['function'] == "book_request") {

        $Services1 = secured($_POST['Services']);


        $Services = html_entity_decode($Services1);

        // Split by "&" and get the last part
        $parts = explode('&', $Services);
        $Services = end($parts);

        $ArtistUserID = secured($_POST['ArtistUserID']);
        $UserID = secured($_COOKIE['UserID']);
        $Address = secured($_POST['Address']);
        $TypeServices = secured($_POST["typeServices"]);
        $OtherNameServices = secured($_POST["OtherName"]);
        $Date = secured($_POST['date']);
        $Time = secured($_POST['time']);
        $SampleOutcome = secured($_POST['SampleOutcome']);


        $client_booking = new insert();
        $client_booking->clientBooking($ArtistUserID, $UserID, $Address, $Services, $TypeServices, $OtherNameServices, $Date, $Time, $SampleOutcome);
    } else {
        ob_end_flush(header("Location: login.php"));
    }
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_REQUEST["ArtistID"]) && isset($_REQUEST["ServicesCatNo"])) {
        $ArtistID = secured($_GET["ArtistID"]);
        $ServicesCatNo = secured($_GET["ServicesCatNo"]);


        $fetchOtherNameServices = new fetch();
        $fetchOtherNameServices->fetchOtherNameServices($ArtistID, $ServicesCatNo);
    }
    
    else if(isset($_GET["servicesID"])){
        $servicesID = secured($_GET["servicesID"]);

        $fetchingServicesInfo = new fetch();
        $fetchingServicesInfo->fetchingServicesInfo($servicesID);
    }
    else {

        ob_end_flush(header("Location: login.php"));
    }
} else {
    return false;
}
