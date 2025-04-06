<?php

class controller extends db
{




    // ------------------------- Fetching ------------------------- //
    protected function fetch_client_artist($TypeUser)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `TypeUser`=? ORDER BY Status DESC");
        $stmt->execute([$TypeUser]);
        return $stmt;
    }


    protected function fetch_info_user($UserID)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=?  ");
        $stmt->execute([$UserID]);
        return $stmt;
    }

    protected function view_user($user_id)
    {
        $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `UserID`=? ");
        $stmt->execute([$user_id]);
        return $stmt;
    }

    protected function count_user($TypeUser, $Status)
    {
        if ($Status == "All") {
            $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `TypeUser`=? ");
            $stmt->execute([$TypeUser]);
            return $stmt;
        } else {
            $stmt = $this->PlsConnect()->prepare("SELECT * FROM `tbluser` WHERE `Status`=? AND `TypeUser`=? ");
            $stmt->execute([$Status, $TypeUser]);
            return $stmt;
        }
    }


    // ------------------------- Fetching ------------------------- //








    // ------------------------- Delete ------------------------- //
    protected function delete_user($user_id)
    {

        $stmt = $this->PlsConnect()->prepare("DELETE FROM `tbluser` WHERE `UserID`=?  ");
        $stmt->execute([$user_id]);


        if ($stmt) {
            $stmt2 = $this->PlsConnect()->prepare("UPDATE tblservices SET Active=0 WHERE UserID=?");
            $stmt2->execute([$user_id]);
            return $stmt2;
        }
        return "There's something error";
    }

    // ------------------------- Delete ------------------------- //









    // ------------------------- Update ------------------------- //

    protected function decline_user($user_id)
    {
        $stmt = $this->PlsConnect()->prepare("UPDATE `tbluser` SET `Status`=? WHERE `UserID`=? ");
        $stmt->execute(["Declined", $user_id]);
        return $stmt;
    }

    protected function accept_user($user_id)
    {
        $stmt = $this->PlsConnect()->prepare("UPDATE `tbluser` SET `Status`=? WHERE `UserID`=? ");
        $stmt->execute(["Accept", $user_id]);
        return $stmt;
    }

    // ------------------------- Update ------------------------- //
}
