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

    // ------------------------- Fetching ------------------------- //

    protected function fetch_info_user($UserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=?  ");
        $stmt->execute([$UserID]);
        return $stmt;
    }


    protected function services_list()
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tblservices` WHERE `UserID`=?  ");
        $stmt->execute([$_COOKIE['UserID']]);
        return $stmt;
    }

    protected function Services_fetch_id($ServicesId)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tblservices` WHERE `RowNum`=? AND `UserID`=?  ");
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

    // ------------------------- Update ------------------------- //


    // ------------------------- Inserting ------------------------- //
    protected function insert_services($ServicesName, $ServicePrice)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tblservices` WHERE `UserID`=? AND `ServicesName`=? ");
        $stmt->execute([$_COOKIE['UserID'], $ServicesName]);

        if ($stmt->rowCount() < 1) {
            $file1_name = $_FILES['Images']['name'];
            $file1_tmp_name = $_FILES['Images']['tmp_name'];
            $file1_dest = "../uploads/" . $file1_name;

            // Validate and upload files
            $file1_uploaded = validateAndUploadImage('Images', $file1_tmp_name, $file1_dest);

            if (!$file1_uploaded) {
                return "Invalid file type! Only JPG, JPEG, PNG, and GIF images are allowed.";
            }

            $InsertServices = $this->PlsConnect()->prepare("INSERT INTO `tblservices` (UserID,Images,ServicesName,Price) VALUES (?,?,?,?)");
            $InsertServices->execute([$_COOKIE['UserID'], $file1_name, $ServicesName, $ServicePrice]);

            if ($InsertServices) {
                return 1;
            } else {
                return "There's something wrong to add data. Please try again";
            }
        } else {
            return "Already added services";
        }

    }

    protected function add_profile_images()
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
                $insert_img = $this->PlsConnect()->prepare("INSERT INTO `tblprofimages`(`UserID`, `Images`) VALUES (?,?)");
                $insert_img->execute([$_COOKIE['UserID'], $image_name]);
                move_uploaded_file($image_tmp, $target_dir . $image_name);
            }

        }
        return 1;
    }

    protected function add_description($description)
    {
        //Checking if exist data
        $checking = $this->PlsConnect()->prepare("SELECT `UserID` FROM `tbldescription` WHERE `UserID`= ?");
        $checking->execute([$_COOKIE['UserID']]);

        if ($checking->rowCount() >= 1) {
            return "Already Exist Data";
        } else {
            $insertData = $this->PlsConnect()->prepare("INSERT INTO `tbldescription` (`UserID`,`Description`) VALUES (?,?) ");
            $insertData->execute([$_COOKIE['UserID'], $description]);

            if ($insertData) {
                return 1;
            } else {
                return "There's something wrong to add data. Please try again";
            }
        }
    }
    // ------------------------- Inserting ------------------------- //
}
