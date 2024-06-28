<?php
function validateImageType($file_type)
{
    $allowed_types = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
    return in_array($file_type, $allowed_types);
}

function validateAndUploadImage($file_name, $file_tmp_name, $file_dest)
{
    $file_type = $_FILES[$file_name]['type'];
    if (validateImageType($file_type)) {
        move_uploaded_file($file_tmp_name, $file_dest);
        return true; // File uploaded successfully
    } else {
        return false; // Invalid file type
    }
}

class controller extends db
{

    // ------------------------- Insert Data -------------------------//

    protected function create_acc($FName, $MName, $LName, $Age, $Birthdate, $CivilStatus, $Brgy, $City, $CompleteAddress, $ContactNumber, $UserName, $Password, $TypeUser)
    {
        try {
            $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserName`=? ");
            $stmt->execute([$UserName]);

            if ($stmt->rowCount() !== 1) {
                $file1_name = $_FILES['ProfImg']['name'];
                $file1_tmp_name = $_FILES['ProfImg']['tmp_name'];
                $file1_dest = "uploads/" . $file1_name;


                //Checking if null image
                if ($file1_name == null) {
                    $file1_name = "default.png";
                } else {
                    // Validate and upload files
                    $file1_uploaded = validateAndUploadImage('ProfImg', $file1_tmp_name, $file1_dest);

                    if (!$file1_uploaded) {
                        return "Invalid file type! Only JPG, JPEG, PNG, and GIF images are allowed.";
                    }

                }

                $insert_data = $this->PlsConnect()->prepare("INSERT INTO `tbluser`(UserID, FName, MName, LName, Age, Birthdate, CivilStatus, Brgy, City, CompleteAddress,ContactNumber, UserName, Password, ProfImg, TypeUser, Status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert_data->execute([rand(), $FName, $MName, $LName, $Age, $Birthdate, $CivilStatus, $Brgy, $City, $CompleteAddress, $ContactNumber, $UserName, md5($Password), $file1_name, $TypeUser, "Accept"]);

                if ($insert_data) {
                    return 1;
                } else {
                    return "There's something wrong to add data. Please try again";
                }
            }
            return false;
        } catch (Exception $err) {
            return $err->getMessage();
        }
    }

    protected function client_booking($ArtistUserID, $UserID, $Address, $Services, $SampleOutcome)
    {
        try {

            $DateNow = new DateTime();
            $DateNowConvert = $DateNow->format('Y-m-d H:i:s');


            //Checking if already book
            $checking = $this->PlsConnect()->prepare("SELECT * FROM `tblbooking` WHERE `ArtistUserID`=? AND `UserID` = ? AND `Services`=?  ");
            $checking->execute([$ArtistUserID, $UserID, $Services]);

            if ($checking->rowCount() != 0) {
                return "Already Book";
            } else {

                //Checking if null image
                if ($SampleOutcome == "No") {
                    $file1_name = "NA";
                } else {
                    //Checking Image Type
                    $file1_name = $_FILES['uploadSampleOutcome']['name'];
                    $file1_tmp_name = $_FILES['uploadSampleOutcome']['tmp_name'];
                    $file1_dest = "uploads/" . $file1_name;

                    // Validate and upload files
                    $file1_uploaded = validateAndUploadImage('uploadSampleOutcome', $file1_tmp_name, $file1_dest);

                    if (!$file1_uploaded) {
                        return "Invalid file type! Only JPG, JPEG, PNG, and GIF images are allowed.";
                    }
                }

                $insert = $this->PlsConnect()->prepare("INSERT INTO `tblbooking` (ArtistUserID,TDate,UserID,PinLocationAddress,Services,SampleOutcome,SampleOutcomeImg,Status) VALUES(?,?,?,?,?,?,?,?) ");
                $insert->execute([$ArtistUserID, $DateNowConvert, $UserID, $Address, $Services, ($SampleOutcome == "Yes" ? 1 : 0), $file1_name, "Pending"]);

                if ($insert) {
                    return 1;
                } else {
                    return "There's something wrong to add data. Please try again";
                }
            }


        } catch (Exception $err) {
            return $err->getMessage();
        }
    }


    // ------------------------- Insert Data -------------------------//


    // ------------------------- Fetch Data -------------------------//

    protected function acc_login($Uname, $Password)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserName`=? AND `Password`=? ");
        $stmt->execute([$Uname, md5($Password)]);
        return $stmt;
    }

    protected function fetch_artist()
    {
        $stmt = $this->PlsConnect()->prepare("SELECT UserID,FName,MName,LName,CompleteAddress,ProfImg FROM `tbluser` WHERE `TypeUser`='Artist' AND `Status`='Accept' ORDER BY FName ASC ");
        $stmt->execute();
        return $stmt;
    }

    protected function fetch_artist_info($UserID, $TypeUser)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT FName,MName,LName,Age,Birthdate,CivilStatus,Brgy,City,CompleteAddress,ProfImg FROM `tbluser` WHERE `UserID`=? AND `TypeUser`=? AND `Status`='Accept' ");
        $stmt->execute([$UserID, $TypeUser]);
        return $stmt;
    }

    protected function fetch_artist_profile($UserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT Images FROM `tblprofimages` WHERE `UserID`=? ");
        $stmt->execute([$UserID]);
        return $stmt;
    }

    protected function fetch_artist_desc($UserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT Description FROM `tbldescription` WHERE `UserID`=? ");
        $stmt->execute([$UserID]);
        return $stmt;
    }

    protected function fetch_artist_services($UserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT Images,ServicesName,Price FROM `tblservices` WHERE `UserID`=? ");
        $stmt->execute([$UserID]);
        return $stmt;
    }

    protected function checking_bookmark($ArtistUserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT COUNT(*) FROM tblbooking WHERE `ArtistUserID`=? AND `UserID`=? AND `Status`='Accept'  ");
        $stmt->execute([$ArtistUserID, $_COOKIE['UserID']]);
        return $stmt;
    }

    // ------------------------- Fetch Data -------------------------//


}