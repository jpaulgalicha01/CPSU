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

    // ------------------------- Artist side ------------------------- //


    // ------------------------- Fetching ------------------------- //

    protected function fetch_info_user($UserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=?  ");
        $stmt->execute([$UserID]);
        return $stmt;
    }


    protected function services_list()
    {
        $stmt = $this->PlsConnect()->prepare(
            "SELECT 
            a.ServicesName,
            a.Price,
            a.RowNum,
            a.UserID,
            (SELECT Description FROM tbldescription WHERE LOWER(ServicesName) =  a.ServicesName AND UserID = a.UserID) AS ServicesPolicy
            FROM tblservices a WHERE a.UserID = ?
            "
        );
        $stmt->execute([$_COOKIE['UserID']]);
        return $stmt;
    }

    protected function  Services_fetch_id($ServicesId)
    {
        $query = "SELECT 
            a.UserID,
            a.ServicesName,
            a.Price,
            (SELECT b.Description 
            FROM tbldescription b 
            WHERE b.ServicesName = a.ServicesName 
            AND b.UserID = a.UserID 
            LIMIT 1) AS ServicesPolicy
        FROM tblservices a 
        WHERE a.RowNum = ?
        AND a.UserID = ?  ";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$ServicesId, $_COOKIE['UserID']]);
        return $stmt;
    }
    protected function fetch_prof_img()
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tblprofimages` WHERE `UserID`=?  ");
        $stmt->execute([$_COOKIE['UserID']]);
        return $stmt;
    }

    protected function fetch_description()
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbldescription` WHERE `UserID`=?  ");
        $stmt->execute([$_COOKIE['UserID']]);
        return $stmt;
    }

    protected function description_fetch_id($DescriptionID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbldescription` WHERE `RowNum`=? AND `UserID`=?  ");
        $stmt->execute([$DescriptionID, $_COOKIE['UserID']]);
        return $stmt;
    }

    protected function fetchinng_pending_booking($BookingID, $Status)
    {
        if ($BookingID == "0") {

            $stmt = $this->PlsConnect()->prepare("SELECT * FROM `viewbooking` WHERE  `ArtistUserID`=? AND `Status`=? ");
            $stmt->execute([$_COOKIE['UserID'], $Status]);
            return $stmt;
        } else {
            $stmt = $this->PlsConnect()->prepare("SELECT * FROM `viewbooking` WHERE  `ArtistUserID`=? AND `RowNum`=? AND `Status`=?  ");
            $stmt->execute([$_COOKIE['UserID'], $BookingID, $Status]);
            return $stmt;
        }
    }

    protected function fetching_Prof_Img($value)
    {
        $query = "SELECT Images,RowNum FROM `tblprofimages` WHERE LOWER(ServicesName) =? and UserID = ?";
        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$value, $_COOKIE["UserID"]]);

        return $stmt;
    }

    protected function fetching_reserved_date($month, $year)
    {
        $query = "SELECT date FROM tblreservedate WHERE MONTH(date) = ? AND YEAR(date) = ? AND UserID = ?";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$month, $year, $_COOKIE['UserID']]);
        return  $stmt;
    }

    // ------------------------- Fetching ------------------------- //


    // ------------------------- Delete ------------------------- //
    // ------------------------- Delete ------------------------- //


    // ------------------------- Update ------------------------- //

    protected function update_booking($ClientUserID, $status)
    {
        $stmt = $this->PlsConnect()->prepare('UPDATE `tblbooking` SET `Status`=? WHERE `ArtistUserID`=? AND `UserID`=? ');
        $stmt->execute([$status, $_COOKIE['UserID'], $ClientUserID]);
        return 1;
    }

    protected function edit_services($servicesID, $prevServicesName, $editServicesName, $editServicePrice, $editServicesPolicy)
    {

        $queryServices =
            "UPDATE 
            `tblservices` SET 
            `ServicesName`=?,
            `Price`= ? WHERE RowNum = ? AND UserID = ?";
        $stmt = $this->PlsConnect()->prepare($queryServices);
        $stmt->execute([$editServicesName, $editServicePrice, $servicesID, $_COOKIE["UserID"]]);

        if ($stmt) {
            $queryDesc =
                "UPDATE 
            `tbldescription` SET 
            `Description`= ?, ServicesName = ?
            WHERE LOWER(ServicesName) = ? AND UserID = ?";

            $stmt1 = $this->PlsConnect()->prepare($queryDesc);
            $stmt1->execute([$editServicesPolicy, $editServicesName, $prevServicesName, $_COOKIE["UserID"]]);

            if ($stmt1) {
                $queryDesc =
                    "UPDATE `tblprofimages` SET 
                        `ServicesName`=?
                        WHERE (ServicesName) = ? AND UserID = ?";

                $stmt2 = $this->PlsConnect()->prepare($queryDesc);
                $stmt2->execute([$editServicesName, $prevServicesName, $_COOKIE["UserID"]]);
                if ($stmt2) {
                    return 1;
                }
                return "ERROR2!";
            }
            return "ERROR2!";
        }
        return "ERROR!";
    }

    // ------------------------- Update ------------------------- //


    // ------------------------- Inserting ------------------------- //
    protected function insert_services($ServicesName, $ServicePrice, $ServicesPolicy)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tblservices` WHERE `UserID`=? AND LOWER(ServicesName) =  ? ");
        $stmt->execute([$_COOKIE['UserID'], $ServicesName]);

        if ($stmt->rowCount() < 1) {
            // $file1_name = $_FILES['Images']['name'];
            // $file1_tmp_name = $_FILES['Images']['tmp_name'];
            // $file1_dest = "../uploads/" . $file1_name;

            // // Validate and upload files
            // $file1_uploaded = validateAndUploadImage('Images', $file1_tmp_name, $file1_dest);

            // if (!$file1_uploaded) {
            //     return "Invalid file type! Only JPG, JPEG, PNG, and GIF images are allowed.";
            // }


            foreach ($_FILES['ProfileImages']['name'] as $key => $value) {
                $image_name = $_FILES['ProfileImages']['name'][$key];
                $image_tmp = $_FILES['ProfileImages']['tmp_name'][$key];
                $target_dir = "../uploads/";
                $imageFileType = pathinfo($image_name, PATHINFO_EXTENSION);

                // Checking Image File Type
                if ($imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "jpg") {
                    $status_message = "Please select jpg, jpeg, png image file type";
                    return $status_message;
                } else {
                    $insert_img = $this->PlsConnect()->prepare("INSERT INTO `tblprofimages`(`UserID`, `Images`,`ServicesName`) VALUES (?,?,?)");
                    $insert_img->execute([$_COOKIE['UserID'], $image_name, $ServicesName]);
                    move_uploaded_file($image_tmp, $target_dir . $image_name);
                }
            }


            $InsertServices = $this->PlsConnect()->prepare("INSERT INTO `tblservices` (UserID,ServicesName,Price) VALUES (?,?,?)");
            $InsertServices->execute([$_COOKIE['UserID'], $ServicesName, $ServicePrice]);

            if ($InsertServices) {

                $insertData = $this->PlsConnect()->prepare("INSERT INTO `tbldescription` (`UserID`,`ServicesName`,`Description`) VALUES (?,?,?) ");
                $insertData->execute([$_COOKIE['UserID'], $ServicesName, $ServicesPolicy]);

                return 1;
            } else {
                return "There's something wrong to add data. Please try again";
            }
        } else {
            return "Already added services";
        }
    }

    protected function add_profile_images($servicesName)
    {
        foreach ($_FILES['ProfileImages']['name'] as $key => $value) {
            $image_name = $_FILES['ProfileImages']['name'][$key];
            $image_tmp = $_FILES['ProfileImages']['tmp_name'][$key];
            $target_dir = "../uploads/";
            $imageFileType = pathinfo($image_name, PATHINFO_EXTENSION);

            // Checking Image File Type
            if ($imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "jpg") {
                $status_message = "Please select jpg, jpeg, png image file type";
                return $status_message;
            } else {
                $insert_img = $this->PlsConnect()->prepare("INSERT INTO `tblprofimages`(`UserID`, `Images`,`ServicesName`) VALUES (?,?,?)");
                $insert_img->execute([$_COOKIE['UserID'], $image_name, $servicesName]);
                move_uploaded_file($image_tmp, $target_dir . $image_name);
            }
        }
        return 1;
    }

    // protected function add_description($description)
    // {
    //     //Checking if exist data
    //     $checking = $this->PlsConnect()->prepare("SELECT `UserID` FROM `tbldescription` WHERE `UserID`= ?");
    //     $checking->execute([$_COOKIE['UserID']]);

    //     if ($checking->rowCount() >= 1) {
    //         return "Already Exist Data";
    //     } else {
    //         $insertData = $this->PlsConnect()->prepare("INSERT INTO `tbldescription` (`UserID`,`Description`) VALUES (?,?) ");
    //         $insertData->execute([$_COOKIE['UserID'], $description]);

    //         if ($insertData) {
    //             return 1;
    //         } else {
    //             return "There's something wrong to add data. Please try again";
    //         }
    //     }
    // }

    protected function insert_date_sched($selectedDates)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $dateSave = $currentYear . '-' . $currentMonth . '-' . $selectedDates;

        $checking = $this->PlsConnect()->prepare("SELECT ID FROM tblreservedate WHERE UserID=? AND date=? ");
        $checking->execute([$_COOKIE["UserID"], $dateSave]);
        // Checking if my schedula na save
        if ($checking->rowCount() !== 0) {
            //delete ang date for booking

            $deleteBookingDate = $this->PlsConnect()->prepare("DELETE FROM `tblreservedate` WHERE UserID=? AND date=?");
            $deleteBookingDate->execute([$_COOKIE["UserID"], $dateSave]);

            return true;
        }

        //saving date for booking 
        $query = "INSERT INTO `tblreservedate`(`UserID`, `date`) VALUES (?,?)";
        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$_COOKIE["UserID"], $dateSave]);

        return true;
    }
    // ------------------------- Inserting ------------------------- //


    // ------------------------- Deleting ------------------------- //

    protected function delete_img($imgRowNum, $servicesName)
    {
        $query = "DELETE FROM `tblprofimages` WHERE RowNum=? AND ServicesName=? AND UserID=?";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$imgRowNum, $servicesName, $_COOKIE["UserID"]]);
        return 1;
    }


    // ------------------------- Deleting ------------------------- //

    // ------------------------- Artist side ------------------------- //



    // ------------------------- Client Side -------------------------//
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

    protected function client_booking($ArtistUserID, $UserID, $Address, $Services, $Date, $Time, $SampleOutcome)
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

                $insert = $this->PlsConnect()->prepare("INSERT INTO `tblbooking` (ArtistUserID,TDate,UserID,PinLocationAddress,Services,Date,Time,SampleOutcome,SampleOutcomeImg,Status) VALUES(?,?,?,?,?,?,?,?,?,?) ");
                $insert->execute([$ArtistUserID, $DateNowConvert, $UserID, $Address, $Services, $Date, $Time, ($SampleOutcome == "Yes" ? 1 : 0), $file1_name, "Pending"]);

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
        $stmt = $this->PlsConnect()->prepare("SELECT  UserID,FName,MName,LName,CompleteAddress,ProfImg  FROM `tbluser` WHERE `TypeUser`='Artist' AND `Status`='Accept' ORDER BY FName ASC ");
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
        $stmt = $this->PlsConnect()->prepare("SELECT ProfImg FROM `tbluser` WHERE `UserID`=? ");
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
        $query = "SELECT 
            a.UserID,
            a.ServicesName,
            a.Price,
            (SELECT Images FROM `tblprofimages` WHERE UserID = a.UserID) AS Images
        FROM 
            `tblservices` a 
        WHERE 
            a.UserID = ? ";
        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$UserID]);
        return $stmt;
    }

    protected function checking_bookmark($ArtistUserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM tblbooking WHERE `ArtistUserID`=? AND `UserID`=? AND `Status`!='Declined'  ");
        $stmt->execute([$ArtistUserID, $_COOKIE['UserID']]);
        return $stmt;
    }




    // ------------------------- Fetch Data -------------------------//
    // ------------------------- Client Side -------------------------//



    // ------------------------- Chat Side -------------------------//
    protected function people_list()
    {

        $query = "
                SELECT a.UserID, a.receiver_id, 
                CASE 
                    WHEN MIN(StatusRead) = 1 THEN 1 
                    ELSE 0 
                END AS StatusRead, 
                us.FName, 
                us.MName, 
                us.LName
                FROM tblmessages a
                JOIN tbluser us ON a.UserID = us.UserId
                WHERE a.receiver_id = ?
                GROUP BY a.UserID, a.receiver_id, us.FName, us.MName, us.LName;
            ";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$_COOKIE["UserID"]]);
        return $stmt;
    }

    protected function conversation1($SenderUserId)
    {

        $read = $this->PlsConnect()->prepare("UPDATE `tblmessages` SET `StatusRead` = ? WHERE  UserID = ? AND receiver_id= ? AND `StatusRead` = ?");
        $read->execute([1, $SenderUserId, $_COOKIE["UserID"], 0]);

        if ($read) {
            $query = " SELECT m.sent_at, m.UserID, m.receiver_id, m.message, us.FName, us.MName, us.LName 
                            from tblmessages m join tbluser us ON m.UserId = us.UserID 
                            WHERE m.UserId = ? and m.receiver_id = ? or m.UserId = ? and m.receiver_id = ?
                        ";

            $stmt = $this->PlsConnect()->prepare($query);
            $stmt->execute([$SenderUserId, $_COOKIE['UserID'], $_COOKIE['UserID'], $SenderUserId]);
            return $stmt;
        }
    }
    // ------------------------- Chat Side -------------------------//

}
