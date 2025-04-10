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

    protected function message_count()
    {
        $query = "SELECT * FROM tblmessages WHERE receiver_id = ? AND StatusRead = ?";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$_COOKIE["UserID"], "0"]);
        return $stmt;
    }

    protected function fetch_info_user($UserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=?  ");
        $stmt->execute([$UserID]);
        return $stmt;
    }


    protected function services_list($checking, $service_cat_no)
    {

        $stmt = "";

        if ($checking === 1 && $service_cat_no === "") {

            $stmt = $this->PlsConnect()->prepare(
                "SELECT 
                a.ServiceCatNo,
                (SELECT ServiceName FROM tblservicecategory WHERE id = a.ServiceCatNo LIMIT 1 ) as ServicesNameCat,
                a.ServicesName,
                a.Price,
                a.RowNum,
                a.UserID,
                (SELECT Description FROM tbldescription WHERE (a.ServicesName IS NULL OR LOWER(ServicesName) = LOWER(a.ServicesName)) AND ServiceCatNo = a.ServiceCatNo AND UserID = a.UserID LIMIT 1) AS ServicesPolicy
                FROM tblservices a WHERE a.UserID = ?
                "
            );
            $stmt->execute([$_COOKIE['UserID']]);
            return $stmt;
        } else {
            $query = "";
            if ($service_cat_no == "all") {
                $query =   "SELECT 
                a.ServiceCatNo,
                (SELECT ServiceName FROM tblservicecategory WHERE id = a.ServiceCatNo LIMIT 1 ) as ServicesNameCat,
                a.ServicesName,
                a.Price,
                a.RowNum,
                a.UserID,
                (SELECT ProfImg FROM `tbluser` WHERE UserID = a.UserID) AS ProfImg,
                (SELECT Description FROM tbldescription WHERE (a.ServicesName IS NULL OR LOWER(ServicesName) = LOWER(a.ServicesName)) AND UserID = a.UserID LIMIT 1) AS ServicesPolicy
                FROM tblservices a Where a.Active=1
                ";
                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute();
                return $stmt;
            } else {
                $query =   "SELECT 
                a.ServiceCatNo,
                (SELECT ServiceName FROM tblservicecategory WHERE id = a.ServiceCatNo LIMIT 1 ) as ServicesNameCat,
                a.ServicesName,
                a.Price,
                a.RowNum,
                a.UserID,
                (SELECT ProfImg FROM `tbluser` WHERE UserID = a.UserID) AS ProfImg,
                (SELECT Description FROM tbldescription WHERE (a.ServicesName IS NULL OR LOWER(ServicesName) = LOWER(a.ServicesName)) AND ServiceCatNo = a.ServiceCatNo AND UserID = a.UserID LIMIT 1) AS ServicesPolicy
                FROM tblservices a WHERE a.ServiceCatNo=? AND a.Active=1
                ";
                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute([$service_cat_no]);
                return $stmt;
            }
        }
    }

    protected function  Services_fetch_id($ServicesId)
    {
        $query = "SELECT 
            a.UserID,
            a.ServiceCatNo,
            a.ServicesName,
            a.Price,
            (SELECT Description
            FROM tbldescription b
            WHERE ServiceCatNo = a.ServiceCatNo 
            AND (a.ServicesName IS NULL OR LOWER(b.ServicesName) = LOWER(a.ServicesName))
            AND UserID = a.UserID 
            LIMIT 1) AS ServicesPolicy
        FROM tblservices a 
        WHERE a.RowNum = ?
        AND a.UserID = ? ;
        ";

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


    protected function fetching_earn_over()
    {
        $query = "SELECT 
            b.`ArtistUserID` AS `ArtistUserID`,
            b.`Services` AS `Services`,
            DATE_FORMAT(b.`Date`, '%Y-%m') AS `Month`, 
            b.`Status` AS `Status`,
            SUM(ser.`Price`) AS `TotalPrice`
        FROM `tblbooking` AS b
        INNER JOIN `tbluser` AS u ON u.`UserID` = b.`UserID`
        INNER JOIN `tblservicecategory` AS s ON s.`id` = b.`Services`
        INNER JOIN `tblservices` AS ser 
            ON ser.`UserID` = b.`ArtistUserID` 
            AND ser.`ServiceCatNo` = b.`Services`
        WHERE b.`ArtistUserID` = ? 
        AND b.`Status` = 'Done'
        GROUP BY `Month`;
        ";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$_COOKIE["UserID"]]);
        return $stmt;
    }


    protected function fetchinng_pending_booking($BookingID, $Status)
    {

        $query = "";
        $stmt = "";

        if ($BookingID == "0") {

            if ($Status === "All") {
                $query = "
                SELECT 
                   `tblbooking`.`RowNum` AS `RowNum`,
                   `tblbooking`.`ArtistUserID` AS `ArtistUserID`,
                   `tbluser`.`FName` AS `FName`,
                   `tbluser`.`MName` AS `MName`,
                   `tbluser`.`LName` AS `LName`,
                   `tbluser`.`Age` AS `Age`,
                   `tbluser`.`Birthdate` AS `Birthdate`,
                   `tbluser`.`CivilStatus` AS `CivilStatus`,
                   `tbluser`.`CompleteAddress` AS `CompleteAddress`,
                   `tbluser`.`ContactNumber` AS `ContactNumber`,
                   `tbluser`.`ProfImg` AS `ProfImg`,
                   `tblbooking`.`UserID` AS `ClientUserID`,
                   `tblbooking`.`TDate` AS `TDate`,
                   `tblbooking`.`Services` AS `Services`,
                   `tblbooking`.`Date` AS `Date`,
                   `tblbooking`.`Time` AS `Time`,
                   `tblbooking`.`PinLocationAddress` AS `PinLocationAddress`,
                   `tblbooking`.`SampleOutcome` AS `SampleOutcome`,
                   `tblbooking`.`SampleOutcomeImg` AS `SampleOutcomeImg`,
                   `tblbooking`.`Status` AS `Status`
               FROM
                   (`tbluser`
                   JOIN `tblbooking`)
               WHERE
                   `tbluser`.`UserID` = `tblbooking`.`UserID` AND `tblbooking`.`ArtistUserID` = ? AND `tblbooking`.`Status`  IN ('Done', 'Cancelled')
               ORDER BY `tbluser`.`RowNum`
               
               ";
                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute([$_COOKIE['UserID']]);
                return $stmt;
            } else {

                $query = "
            SELECT 
               `tblbooking`.`RowNum` AS `RowNum`,
               `tblbooking`.`ArtistUserID` AS `ArtistUserID`,
               `tbluser`.`FName` AS `FName`,
               `tbluser`.`MName` AS `MName`,
               `tbluser`.`LName` AS `LName`,
               `tbluser`.`Age` AS `Age`,
               `tbluser`.`Birthdate` AS `Birthdate`,
               `tbluser`.`CivilStatus` AS `CivilStatus`,
               `tbluser`.`CompleteAddress` AS `CompleteAddress`,
               `tbluser`.`ContactNumber` AS `ContactNumber`,
               `tbluser`.`ProfImg` AS `ProfImg`,
               `tblbooking`.`UserID` AS `ClientUserID`,
               `tblbooking`.`TDate` AS `TDate`,
               `tblbooking`.`Services` AS `Services`,
               `tblbooking`.`Date` AS `Date`,
               `tblbooking`.`Time` AS `Time`,
               `tblbooking`.`PinLocationAddress` AS `PinLocationAddress`,
               `tblbooking`.`SampleOutcome` AS `SampleOutcome`,
               `tblbooking`.`SampleOutcomeImg` AS `SampleOutcomeImg`,
               `tblbooking`.`Status` AS `Status`
           FROM
               (`tbluser`
               JOIN `tblbooking`)
           WHERE
               `tbluser`.`UserID` = `tblbooking`.`UserID` AND `tblbooking`.`ArtistUserID` = ? AND `tblbooking`.`Status`  = ?
           ORDER BY `tbluser`.`RowNum`
           
           ";

                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute([$_COOKIE['UserID'], $Status]);
                return $stmt;
            }
        } else {

            $query = "SELECT 
               `tblbooking`.`RowNum` AS `RowNum`,
               `tblbooking`.`ArtistUserID` AS `ArtistUserID`,
               `tbluser`.`FName` AS `FName`,
               `tbluser`.`MName` AS `MName`,
               `tbluser`.`LName` AS `LName`,
               `tbluser`.`Age` AS `Age`,
               `tbluser`.`Birthdate` AS `Birthdate`,  
               `tbluser`.`CivilStatus` AS `CivilStatus`,
               `tbluser`.`CompleteAddress` AS `CompleteAddress`,
               `tbluser`.`ContactNumber` AS `ContactNumber`,
               `tbluser`.`ProfImg` AS `ProfImg`,
               `tblbooking`.`UserID` AS `ClientUserID`,
               `tblbooking`.`TDate` AS `TDate`,
               `tblbooking`.`Services` AS `Services`,
               `tblbooking`.`OtherNameServices` AS `OtherNameServices`,
               (SELECT ServiceName FROM tblservicecategory WHERE id = Services) AS ServicesName,
               `tblbooking`.`Date` AS `Date`,
               `tblbooking`.`Time` AS `Time`,
               `tblbooking`.`PinLocationAddress` AS `PinLocationAddress`,
               `tblbooking`.`SampleOutcome` AS `SampleOutcome`,
               `tblbooking`.`SampleOutcomeImg` AS `SampleOutcomeImg`,
               `tblbooking`.`Status` AS `Status`
           FROM
               (`tbluser`
               JOIN `tblbooking`)
           WHERE
               `tbluser`.`UserID` = `tblbooking`.`UserID` AND     `tblbooking`.`ArtistUserID` = ? AND `tblbooking`.`RowNum` = ? AND  `tblbooking`.`Status`  = ?
           ORDER BY `tbluser`.`RowNum` 
           
           ";

            $stmt = $this->PlsConnect()->prepare($query);
            $stmt->execute([$_COOKIE['UserID'], $BookingID, $Status]);
            return $stmt;
        }
    }


    protected function fetching_info($BookingID, $Status)
    {

        $query = "";
        $stmt = "";

        if ($BookingID == "0") {

            if ($Status === "All") {
                $query = "SELECT 
                    b.`RowNum` AS `RowNum`,
                    b.`ArtistUserID` AS `ArtistUserID`,
                    u.`FName` AS `FName`,
                    u.`MName` AS `MName`,
                    u.`LName` AS `LName`,
                    u.`Age` AS `Age`,
                    u.`Birthdate` AS `Birthdate`,
                    u.`CivilStatus` AS `CivilStatus`,
                    u.`CompleteAddress` AS `CompleteAddress`,
                    u.`ContactNumber` AS `ContactNumber`,
                    u.`ProfImg` AS `ProfImg`,
                    b.`UserID` AS `ClientUserID`,
                    b.`TDate` AS `TDate`,
                    b.`Services` AS `Services`,
                    b.`Date` AS `Date`,
                    b.`Time` AS `Time`,
                    b.`PinLocationAddress` AS `PinLocationAddress`,
                    b.`SampleOutcome` AS `SampleOutcome`,
                    b.`SampleOutcomeImg` AS `SampleOutcomeImg`,
                    b.`Status` AS `Status`,
                    b.`OtherNameServices` AS `OtherNameServices`,
                    s.`id` AS `ServiceCategoryID`,
                    s.`ServiceName` AS `ServiceCategory`,
                    ser. `Price` AS `Price`
                FROM `tblbooking` AS b
                INNER JOIN `tbluser` AS u ON u.`UserID` = b.`UserID`
                INNER JOIN `tblservicecategory` AS s ON s.`id` = b.`Services`
                INNER JOIN `tblservices` AS ser ON ser.`UserID` = b.`ArtistUserID` AND ser.`ServiceCatNo` =  b.`Services`
                WHERE b.`UserID` = ?
                ORDER BY b.`RowNum` AND b.`Status` ;
               ";
                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute([$_COOKIE['UserID']]);

                return $stmt;
            } else {

                $query = " SELECT 
                    b.`RowNum` AS `RowNum`,
                    b.`ArtistUserID` AS `ArtistUserID`,
                    u.`FName` AS `FName`,
                    u.`MName` AS `MName`,
                    u.`LName` AS `LName`,
                    u.`Age` AS `Age`,
                    u.`Birthdate` AS `Birthdate`,
                    u.`CivilStatus` AS `CivilStatus`,
                    u.`CompleteAddress` AS `CompleteAddress`,
                    u.`ContactNumber` AS `ContactNumber`,
                    u.`ProfImg` AS `ProfImg`,
                    b.`UserID` AS `ClientUserID`,
                    b.`TDate` AS `TDate`,
                    b.`Services` AS `Services`,
                    b.`Date` AS `Date`,
                    b.`Time` AS `Time`,
                    b.`PinLocationAddress` AS `PinLocationAddress`,
                    b.`SampleOutcome` AS `SampleOutcome`,
                    b.`SampleOutcomeImg` AS `SampleOutcomeImg`,
                    b.`Status` AS `Status`,
                    b.`OtherNameServices` AS `OtherNameServices`,
                    s.`id` AS `ServiceCategoryID`,
                    s.`ServiceName` AS `ServiceCategory`,
                    ser. `Price` AS `Price`
                FROM `tblbooking` AS b
                INNER JOIN `tbluser` AS u ON u.`UserID` = b.`UserID`
                INNER JOIN `tblservicecategory` AS s ON s.`id` = b.`Services`
                INNER JOIN `tblservices` AS ser ON ser.`UserID` = b.`ArtistUserID` AND ser.`ServiceCatNo` =  b.`Services`
                WHERE b.`UserID` = ? AND  b.`Status` = ?
                ORDER BY b.`RowNum`
           
           ";

                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute([$_COOKIE['UserID'], $Status]);

                return $stmt;
            }
        } else {
            if ($Status === "All") {
                $query = "SELECT 
                    b.`RowNum` AS `RowNum`,
                    b.`ArtistUserID` AS `ArtistUserID`,
                    u.`FName` AS `FName`,
                    u.`MName` AS `MName`,
                    u.`LName` AS `LName`,
                    u.`Age` AS `Age`,
                    u.`Birthdate` AS `Birthdate`,
                    u.`CivilStatus` AS `CivilStatus`,
                    u.`CompleteAddress` AS `CompleteAddress`,
                    u.`ContactNumber` AS `ContactNumber`,
                    u.`ProfImg` AS `ProfImg`,
                    b.`UserID` AS `ClientUserID`,
                    b.`TDate` AS `TDate`,
                    b.`Services` AS `Services`,
                    b.`Date` AS `Date`,
                    b.`Time` AS `Time`,
                    b.`PinLocationAddress` AS `PinLocationAddress`,
                    b.`SampleOutcome` AS `SampleOutcome`,
                    b.`SampleOutcomeImg` AS `SampleOutcomeImg`,
                    b.`Status` AS `Status`,
                    b.`OtherNameServices` AS `OtherNameServices`,
                    s.`id` AS `ServiceCategoryID`,
                    s.`ServiceName` AS `ServiceCategory`,
                    ser. `Price` AS `Price`
                FROM `tblbooking` AS b
                INNER JOIN `tbluser` AS u ON u.`UserID` = b.`UserID`
                INNER JOIN `tblservicecategory` AS s ON s.`id` = b.`Services`
                INNER JOIN `tblservices` AS ser ON ser.`UserID` = b.`ArtistUserID` AND ser.`ServiceCatNo` =  b.`Services`
                WHERE b.`UserID` = ? AND b.`Services` = ?
                ORDER BY b.`RowNum`  ;
            ";
                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute([$_COOKIE['UserID'], $BookingID]);

                return $stmt;
            } else {
                $query = " SELECT 
                    b.`RowNum` AS `RowNum`,
                    b.`ArtistUserID` AS `ArtistUserID`,
                    u.`FName` AS `FName`,
                    u.`MName` AS `MName`,
                    u.`LName` AS `LName`,
                    u.`Age` AS `Age`,
                    u.`Birthdate` AS `Birthdate`,
                    u.`CivilStatus` AS `CivilStatus`,
                    u.`CompleteAddress` AS `CompleteAddress`,
                    u.`ContactNumber` AS `ContactNumber`,
                    u.`ProfImg` AS `ProfImg`,
                    b.`UserID` AS `ClientUserID`,
                    b.`TDate` AS `TDate`,
                    b.`Services` AS `Services`,
                    b.`Date` AS `Date`,
                    b.`Time` AS `Time`,
                    b.`PinLocationAddress` AS `PinLocationAddress`,
                    b.`SampleOutcome` AS `SampleOutcome`,
                    b.`SampleOutcomeImg` AS `SampleOutcomeImg`,
                    b.`Status` AS `Status`,
                    b.`OtherNameServices` AS `OtherNameServices`,
                    s.`id` AS `ServiceCategoryID`,
                    s.`ServiceName` AS `ServiceCategory`,
                    ser. `Price` AS `Price`
                FROM `tblbooking` AS b
                INNER JOIN `tbluser` AS u ON u.`UserID` = b.`UserID`
                INNER JOIN `tblservicecategory` AS s ON s.`id` = b.`Services`
                INNER JOIN `tblservices` AS ser ON ser.`UserID` = b.`ArtistUserID` AND ser.`ServiceCatNo` =  b.`Services`
                WHERE b.`UserID` = ? AND b.`Services` = ? AND  b.`Status` = ?
                ORDER BY b.`RowNum`
            ";

                $stmt = $this->PlsConnect()->prepare($query);
                $stmt->execute([$_COOKIE['UserID'], $BookingID, $Status]);
                return $stmt;
            }
        }
    }

    protected function fetching_Prof_Img($value, $ServiceName,)
    {
        $stmt = "";

        if ($value === "16") {
            $query = "SELECT Images,RowNum FROM `tblprofimages` WHERE ServiceCatNo = ? AND  LOWER(ServicesName) =? AND UserID = ?";
            $stmt = $this->PlsConnect()->prepare($query);
            $stmt->execute([$value, $ServiceName, $_COOKIE["UserID"]]);
        } else {
            $query = "SELECT Images,RowNum FROM `tblprofimages` WHERE ServiceCatNo = ? AND UserID = ?";
            $stmt = $this->PlsConnect()->prepare($query);
            $stmt->execute([$value, $_COOKIE["UserID"]]);
        }

        return $stmt;
    }

    protected function fetching_reserved_date($month, $year)
    {
        $query = "SELECT date FROM tblreservedate WHERE MONTH(date) = ? AND YEAR(date) = ? AND UserID = ?";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$month, $year, $_COOKIE['UserID']]);
        return  $stmt;
    }


    protected function fetching_service_cat()
    {
        $stmt = $this->PlsConnect()->prepare("SELECT id, ServiceName FROM `tblservicecategory` ");
        $stmt->execute();
        return $stmt;
    }



    protected function fetching_Prof_Img2($value, $ServiceName, $artistID)
    {
        $stmt = "";

        if ($value === "16") {
            $query = "SELECT Images,RowNum FROM `tblprofimages` WHERE ServiceCatNo = ? AND  LOWER(ServicesName) =? AND UserID = ?";
            $stmt = $this->PlsConnect()->prepare($query);
            $stmt->execute([$value, $ServiceName, $artistID]);
        } else {
            $query = "SELECT Images,RowNum FROM `tblprofimages` WHERE ServiceCatNo = ? AND UserID = ?";
            $stmt = $this->PlsConnect()->prepare($query);
            $stmt->execute([$value, $artistID]);
        }

        return $stmt;
    }

    protected function fetch_review($ArtistUserID)
    {
        $query = "SELECT  
            r.UserID, 
            r.RevStars, 
            r.RevMessage,
            r.Date, 
            (SELECT CONCAT(COALESCE(u.FName, ''), ' ', COALESCE(u.MName, ''), ' ', COALESCE(u.LName, '')) 
            FROM tbluser u 
            WHERE u.UserID = r.UserID) AS ClientName,
            (SELECT ProfImg  FROM tbluser u WHERE u.UserID = r.UserID) AS ProfImg
        FROM tblreview r 
        WHERE r.ArtistUserID = ?";
        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$ArtistUserID]);
        return $stmt;
    }

    // ------------------------- Fetching ------------------------- //


    // ------------------------- Delete ------------------------- //
    // ------------------------- Delete ------------------------- //


    // ------------------------- Update ------------------------- //

    protected function update_booking($ClientUserID, $status, $itemNo)
    {
        $stmt = $this->PlsConnect()->prepare('UPDATE `tblbooking` SET `Status`=? WHERE `ArtistUserID`=? AND `UserID`=? AND `RowNum` = ?');
        $stmt->execute([$status, $_COOKIE['UserID'], $ClientUserID, $itemNo]);
        return 1;
    }

    protected function edit_services($servicesID, $prevServicesName, $prevServicesCatInput, $editServiceCatNo, $editServicePrice, $editServicesName, $editServicesPolicy)
    {

        $queryServices =
            "UPDATE 
            `tblservices` SET 
            `ServicesName`=?,
            `ServiceCatNo` = ?,
            `Price`= ? WHERE RowNum = ? AND UserID = ? AND ServiceCatNo = ?";
        $stmt = $this->PlsConnect()->prepare($queryServices);
        $stmt->execute([$editServicesName, $editServiceCatNo, $editServicePrice, $servicesID, $_COOKIE["UserID"], $prevServicesCatInput]);

        if ($stmt) {
            $queryDesc =
                "UPDATE 
            `tbldescription` SET 
            `Description`= ?, 
            ServiceCatNo=?,
            ServicesName = ? 
            WHERE LOWER(ServicesName) = ? AND UserID = ? AND ServiceCatNo =? ";

            $stmt1 = $this->PlsConnect()->prepare($queryDesc);
            $stmt1->execute([$editServicesPolicy, $editServiceCatNo, $editServicesName, $prevServicesName, $_COOKIE["UserID"], $prevServicesCatInput]);

            if ($stmt1) {
                $queryDesc =
                    "UPDATE `tblprofimages` SET 
                        `ServicesName`=? , ServiceCatNo = ?
                        WHERE (ServicesName) = ? AND UserID = ? AND ServiceCatNo=?";

                $stmt2 = $this->PlsConnect()->prepare($queryDesc);
                $stmt2->execute([$editServicesName, $editServiceCatNo, $prevServicesName, $_COOKIE["UserID"], $prevServicesCatInput]);
                if ($stmt2) {
                    return 1;
                }
                return "ERROR3!";
            }
            return "ERROR2!";
        }
        return "ERROR1!";
    }


    protected function cancelled_booking($bookingID)
    {
        $query = "UPDATE `tblbooking` SET `Status`='Cancelled' WHERE RowNum = ?";
        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$bookingID]);
        return $stmt;
    }

    // ------------------------- Update ------------------------- //


    // ------------------------- Inserting ------------------------- //
    protected function insert_services($ServiceCatNo, $ServicesName, $ServicePrice, $ServicesPolicy)
    {


        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tblservices` WHERE `UserID`=? AND ServiceCatNo = ?");
        // $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tblservices` WHERE `UserID`=? AND LOWER(ServicesName) =  ? ");
        $stmt->execute([$_COOKIE['UserID'], $ServiceCatNo]);

        if ($stmt->rowCount() >= 1 && $ServiceCatNo != 16) {
            return "Already added services";
        } else {

            if ($ServiceCatNo == 16) {
                $stmt2 = $this->PlsConnect()->prepare("SELECT * FROM `tblservices` WHERE `UserID`=? AND (ServicesName IS NULL OR LOWER(ServicesName) = LOWER(?)) AND ServiceCatNo = ? ");
                $stmt2->execute([$_COOKIE['UserID'], $ServicesName, $ServiceCatNo]);

                if ($stmt->rowCount() >= 1) {
                    return "Already added services";
                }
            }

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
                    $insert_img = $this->PlsConnect()->prepare("INSERT INTO `tblprofimages`(`UserID`, `Images`,`ServiceCatNo`, `ServicesName`) VALUES (?,?,?,?)");
                    $insert_img->execute([$_COOKIE['UserID'], $image_name, $ServiceCatNo, $ServicesName]);
                    move_uploaded_file($image_tmp, $target_dir . $image_name);
                }
            }


            $InsertServices = $this->PlsConnect()->prepare("INSERT INTO `tblservices` (UserID,ServiceCatNo,ServicesName,Price) VALUES (?,?,?,?)");
            $InsertServices->execute([$_COOKIE['UserID'], $ServiceCatNo, $ServicesName, $ServicePrice]);

            if ($InsertServices) {

                $insertData = $this->PlsConnect()->prepare("INSERT INTO `tbldescription` (`UserID`,`ServiceCatNo`,`ServicesName`,`Description`) VALUES (?,?,?,?) ");
                $insertData->execute([$_COOKIE['UserID'], $ServiceCatNo, $ServicesName, $ServicesPolicy]);

                return 1;
            } else {
                return "There's something wrong to add data. Please try again";
            }
        }
    }

    protected function add_profile_images($servicesCatNo, $servicesName)
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
                $insert_img = $this->PlsConnect()->prepare("INSERT INTO `tblprofimages`(`UserID`, `Images`,`ServiceCatNo`,`ServicesName`) VALUES (?,?,?,?)");
                $insert_img->execute([$_COOKIE['UserID'], $image_name, $servicesCatNo, $servicesName]);
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


    protected function review_submit($ArtistID, $RevStars, $RevMessage)
    {
        //checking if already submit his/her review
        $query1 = "SELECT id FROM tblreview WHERE UserID = ? AND ArtistUserID=? ";
        $stmt = $this->PlsConnect()->prepare($query1);
        $stmt->execute([$_COOKIE["UserID"], $ArtistID]);

        if ($stmt->rowCount() >= 1) {
            return "Already submit on this artist";
        }

        $query2 = "INSERT INTO `tblreview`(`UserID`, `ArtistUserID`, `RevStars`, `RevMessage`,`Date`) 
                    VALUES (?,?,?,?,?)";
        $stmt2 = $this->PlsConnect()->prepare($query2);
        $stmt2->execute([$_COOKIE["UserID"], $ArtistID, $RevStars, $RevMessage, date('Y-m-d')]);

        if ($stmt2) {
            return 1;
        } else {
            return "There's something wrong. Please try again";
        }
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

    protected function client_booking($ArtistUserID, $UserID, $Address, $Services, $TypeServices, $OtherNameServices, $Date, $Time, $SampleOutcome)
    {
        try {

            $DateNow = new DateTime();
            $DateNowConvert = $DateNow->format('Y-m-d H:i:s');


            //Checking if already book
            $checking = $this->PlsConnect()->prepare("SELECT * FROM `tblbooking` WHERE `UserID` = ? AND  `Status` IN ('Pending', 'Accept') ");
            $checking->execute([$UserID]);

            if ($checking->rowCount() != 0) {
                return "Have pending booked. Please try again later";
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

                $insert = $this->PlsConnect()->prepare("INSERT INTO `tblbooking` (ArtistUserID,TDate,UserID,PinLocationAddress,Services,OtherNameServices,TypeService,Date,Time,SampleOutcome,SampleOutcomeImg,Status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?) ");
                $insert->execute([$ArtistUserID, $DateNowConvert, $UserID, $Address, $Services, $OtherNameServices, $TypeServices, $Date, $Time, ($SampleOutcome == "Yes" ? 1 : 0), $file1_name, "Pending"]);

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
        $query = "SELECT 
            UserID,
            FName,
            MName,
            LName,
            CompleteAddress,
            ProfImg
            FROM `tbluser` WHERE `TypeUser`='Artist' AND `Status`='Accept' ORDER BY FName ASC ";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    protected function fetch_artist_info($UserID, $TypeUser)
    {
        $query = "SELECT 
                FName,
                MName,
                LName,
                Age,
                Birthdate,
                CivilStatus,
                Brgy,
                City,
                CompleteAddress,
                ContactNumber,
                UserName,
                ProfImg 
                FROM `tbluser` 
                WHERE `UserID`=? AND `TypeUser`=? AND `Status`='Accept' ";
        $stmt = $this->PlsConnect()->prepare($query);
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

    protected function fetch_artist_services($UserID, $modal)
    {
        $query = "";

        if ($modal == "0") {
            $query = "SELECT 
                a.UserID,
                a.ServicesName, 
                a.Price,
                a.ServiceCatNo,
                b.ServiceName AS ServiceOtherName,  -- Uses JOIN instead of subquery
                c.Description  -- Uses LEFT JOIN to handle NULL cases
            FROM `tblservices` a
            LEFT JOIN `tblservicecategory` b ON b.id = a.ServiceCatNo
            LEFT JOIN `tbldescription` c 
                ON c.UserID = a.UserID 
                AND c.ServicesName = a.ServicesName
            WHERE a.UserID = ? GROUP BY  a.ServiceCatNo
            ";
        } else {

            $query = "SELECT 
                a.UserID,
                a.Price,
                a.ServiceCatNo,
                (SELECT ServiceName FROM tblservicecategory WHERE id = a.ServiceCatNo LIMIT 1) AS ServicesName
            FROM 
                `tblservices` a 
            WHERE 
                a.UserID = ?
            GROUP BY 
                a.UserID, a.ServiceCatNo;";
        }

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$UserID]);
        return $stmt;
    }

    protected function checking_bookmark()
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM tblbooking 
        WHERE `UserID` = ? 
        ORDER BY `RowNum` DESC 
        LIMIT 1;");
        $stmt->execute([$_COOKIE['UserID']]);
        return $stmt;
    }


    protected function fetch_services_image($servicesName, $servicesUserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT Images FROM tblprofimages WHERE ServicesName=? AND UserID=?");
        $stmt->execute([$servicesName, $servicesUserID]);
        return $stmt;
    }

    protected function avail_date_res($ArtistUserID)
    {
        $query = "SELECT date FROM `tblreservedate` WHERE CURDATE() <= `date` AND UserID = ?";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$ArtistUserID]);

        return $stmt;
    }

    protected function fetch_other_name_services($ArtistID, $ServicesCatNo)
    {
        $query = "SELECT 
                 ServicesName
            FROM 
                `tblservices`
            WHERE 
                UserID = ? AND ServiceCatNo = ?";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$ArtistID, $ServicesCatNo]);
        return $stmt;
    }

    protected function fetching_services_info($servicesID)
    {
        $query = "SELECT
            a.RowNum, 
            a.UserID,
            a.ServiceCatNo,
            a.ServicesName,
           (SELECT ServiceName FROM tblservicecategory WHERE id = a.ServiceCatNo LIMIT 1) AS ServiceCatName,
           a.Price
           FROM `tblservices` a WHERE RowNum = ?
        ";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$servicesID]);
        return $stmt;
    }

    protected function show_booking_info($reservedBookingID)
    {
        $query = "SELECT 
                  a.UserID, 
                  a. ServiceCatNo, 
                  a.ServicesName,
                  (SELECT ServiceName FROM tblservicecategory WHERE id = a.ServiceCatNo LIMIT 1) AS ServiceCatName
                  FROM tblservices a WHERE a.RowNum = ? ";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$reservedBookingID]);
        return $stmt;
    }

    protected function fetching_booking_client($bookingID)
    {
        $query = "SELECT 
                    b.`RowNum` AS `RowNum`,
                    b.`ArtistUserID` AS `ArtistUserID`,
                    u.`FName` AS `FName`,
                    u.`MName` AS `MName`,
                    u.`LName` AS `LName`,
                    u.`ProfImg` AS `ProfImg`,
                    b.`UserID` AS `ClientUserID`,
                    b.`Services` AS `Services`,
                    b.`Date` AS `Date`,
                    b.`Time` AS `Time`,
                    b.`PinLocationAddress` AS `PinLocationAddress`,
                    b.`Status` AS `Status`,
                    b.`OtherNameServices` AS `OtherNameServices`,
                    s.`ServiceName` AS `ServiceCategory`
                FROM `tblbooking` AS b
                INNER JOIN `tbluser` AS u ON u.`UserID` = b.`ArtistUserID`
                INNER JOIN `tblservicecategory` AS s ON s.`id` = b.`Services`
                INNER JOIN `tblservices` AS ser ON ser.`UserID` = b.`ArtistUserID` AND ser.`ServicesName` =  b.`OtherNameServices`
                WHERE b.`UserID` = ? AND  b.`RowNum` = ?
                ORDER BY b.`RowNum` AND b.`Status` ;";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$_COOKIE["UserID"], $bookingID]);
        return $stmt;
    }

    protected function count_stars($UserID)
    {
        $query = "SELECT * FROM tblreview WHERE ArtistUserID=?";
        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute([$UserID]);
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



    protected function checking_booking()
    {


        $query =  "SELECT RowNum FROM `tblbooking` WHERE Status ='Pending' AND  DATEDIFF(CURDATE(), Date) >= 3";

        $stmt = $this->PlsConnect()->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            $fetchingData = $stmt->fetch();

            $stmt2 = $this->PlsConnect()->prepare("UPDATE `tblbooking` SET `Status`='Cancelled' WHERE `Rownum` = ? ");
            $stmt2->execute([$fetchingData["RowNum"]]);

            return 1;
        }
        return 1;
    }


    protected function update_info($FName, $MName, $LName, $UserName, $OPass, $NPAss)
    {
        $change_info = 0;
        $check_uname = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=? AND `UserName`=? ");
        $check_uname->execute([$_COOKIE['UserID'], $UserName]);
        if ($check_uname->rowCount() == 1) {
            $change_info = 1;
        } else {
            $check_uname = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserName`=? ");
            $check_uname->execute([$UserName]);
            if ($check_uname->rowCount() == 1) {
                $status_message = "Username is already added.";
                return $status_message;
            }
            $change_info = 1;
        }

        // Checking Email
        // $check_email = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=? AND `EmailAddress`=? ");
        // $check_email->execute([$_COOKIE['UserID'], $acc_email]);
        // if ($check_email->rowCount() == 1) {
        //     $change_info = 1;
        // } else {
        //     $check_email = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `EmailAddress`=? ");
        //     $check_email->execute([$acc_email]);

        //     if ($check_email->rowCount() == 1) {
        //         $status_message = "Email Address is already added.";
        //         return $status_message;
        //     }
        //     $change_info = 1;
        // }

        // Insert Data
        if ($change_info == 1) {
            if ($OPass !== "") {
                // Checking Current Password
                $checking_curr_pass = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=? AND `Password`=? ");
                $checking_curr_pass->execute([$_COOKIE['UserID'], md5($OPass)]);

                if ($checking_curr_pass->rowCount() !== 1) {
                    $status_message = "Current Password is not matched on data. Please try again.";
                    return $status_message;
                }

                $update_info = $this->PlsConnect()->prepare("UPDATE `tbluser` SET `FName`=?, `MName`=?, `LName`=?, `UserName`=?,`Password`=? WHERE `UserID`=? ");
                $update_info->execute([$FName, $MName, $LName, $UserName, md5($NPAss), $_COOKIE['UserID']]);
                if ($update_info) {

                    //Insert Activity Logs 
                    // $this->PlsConnect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['UserID']."','Changed Password','".date('Y-m-d')."')");

                    $status = 1;
                    return $status;
                } else {
                    $status_message = "There's something wrong to add data. Please try again";
                    return $status_message;
                }
            }
            $update_info = $this->PlsConnect()->prepare("UPDATE `tbluser` SET `FName`=?, `MName`=?, `LName`=?, `UserName`=? WHERE `UserID`=? ");
            $update_info->execute([$FName, $MName, $LName, $UserName, $_COOKIE['UserID']]);
            if ($update_info) {
                //Insert Activity Logs 
                // $this->PlsConnect()->query("INSERT INTO `tbl_logs` (`logs_user_id`, `logs_activity`, `logs_date`) VALUES('".$_COOKIE['UserID']."','Update Personal Information','".date('Y-m-d')."')");
                $status = 1;
                return $status;
            } else {
                $status_message = "There's something wrong to add data. Please try again";
                return $status_message;
            }
        }
    }


    protected function change_prof_img()
    {

        $file1_name = $_FILES['change_img']['name'];
        $file1_tmp_name = $_FILES['change_img']['tmp_name'];
        $file1_dest = "./uploads/" . $file1_name;

        // Validate and upload files
        $file1_uploaded = validateAndUploadImage('change_img', $file1_tmp_name, $file1_dest);

        if (!$file1_uploaded) {
            return "Invalid file type! Only JPG, JPEG, PNG, and SVG images are allowed.";
        }

        $stmt = $this->PlsConnect()->prepare("UPDATE `tbluser` SET `ProfImg`=? WHERE `UserID`=? ");
        $stmt->execute([$file1_name, $_COOKIE['UserID']]);
        if ($stmt) {

            return 1;
        } else {

            $status_message = "There's something wrong to add data. Please try again";
            return $status_message;
        }
    }
}
