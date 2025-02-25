<?php

class fetch extends controller
{


    // ------------------------- Artist Side -------------------------//

    public function fetchingProfImg($value)
    {
        $stmt = $this->fetching_Prof_Img($value);

        if ($stmt) {
            if ($stmt->rowCount()) {
                $fetch_info = $stmt->fetchAll();
                $data = [
                    'status' => 200,
                    'data' => $fetch_info,
                ];
                echo json_encode($data);
                return false;
            } else {
                return false;
            }
        } else {

            $data = [
                'status' => 500,
                'message' => "There's something wrong.",
            ];
            echo json_encode($data);
            return false;
        }
    }

    // ------------------------- Artist Side -------------------------//



    // ------------------------- Client Side -------------------------//
    public function fetchInfoUser($UserID)
    {
        $stmt = $this->fetch_info_user($UserID);
        return $stmt;
    }

    public function ServicesList()
    {
        $stmt = $this->services_list();
        return $stmt;
    }

    public function ServicesFetchId($ServicesId)
    {
        $stmt = $this->Services_fetch_id($ServicesId);

        if ($stmt) {
            if ($stmt->rowCount()) {
                $fetch_info = $stmt->fetch();

                $data = [
                    'status' => 200,
                    'data' => $fetch_info,
                ];
                echo json_encode($data);
                return false;
            } else {
                return false;
            }
        } else {

            $data = [
                'status' => 500,
                'message' => "There's something wrong.",
            ];
            echo json_encode($data);
            return false;
        }
    }


    public function fetchProfImg()
    {
        $stmt = $this->fetch_prof_img();
        return $stmt;
    }

    public function fetchDescription()
    {
        $stmt = $this->fetch_description();
        return $stmt;
    }

    public function DescriptionFetchID($DescriptionID)
    {
        $stmt = $this->description_fetch_id($DescriptionID);
        if ($stmt) {
            if ($stmt->rowCount()) {
                $fetch_info = $stmt->fetch();

                $data = [
                    'status' => 200,
                    'data' => $fetch_info,
                ];
                echo json_encode($data);
                return false;
            } else {
                return false;
            }
        } else {

            $data = [
                'status' => 500,
                'message' => "There's something wrong.",
            ];
            echo json_encode($data);
            return false;
        }
    }

    public function fetchinngPendingBooking($BookingID, $Status)
    {
        $stmt = $this->fetchinng_pending_booking($BookingID, $Status);
        return $stmt;
    }




    public function fetchingBooking($BookingID, $Status)
    {
        $stmt = $this->fetchinng_pending_booking($BookingID, $Status);
        if ($stmt) {
            if ($stmt->rowCount()) {
                $fetch_info = $stmt->fetch();

                $data = [
                    'status' => 200,
                    'data' => $fetch_info,
                ];
                echo json_encode($data);
                return false;
            } else {
                $data = [
                    'status' => 501,
                    'message' => "Failed To Fetch.",
                ];
                echo json_encode($data);
                return false;
            }
        } else {

            $data = [
                'status' => 500,
                'message' => "There's something wrong.",
            ];
            echo json_encode($data);
            return false;
        }
    }

    public function fetchingReservedDate($month, $year)
    {
        $stmt = $this->fetching_reserved_date($month, $year);
        $fetchingData = $stmt->fetchAll();

        echo json_encode($fetchingData);
        return false;
    }
    // ------------------------- Client Side -------------------------//


    // ------------------------- Client Side -------------------------//
    public function accLogin($Uname, $Password)
    {
        $stmt = $this->acc_login($Uname, $Password);
        if ($stmt->rowCount() == 1) {
            $fetch = $stmt->fetch();
            if ($fetch['TypeUser'] == "Admin") {
                setcookie("UserID", $fetch['UserID'], 2147483647);
                setcookie("TypeUser", $fetch['TypeUser'], 2147483647);
                $data = [
                    'status' => 200,
                    'icon' => "success",
                    'redirect' => "admin/index.php"
                ];
                echo json_encode($data);
                return false;
            } else {
                if ($fetch['Status'] == "Accept") {
                    setcookie("UserID", $fetch['UserID'], 2147483647);
                    setcookie("TypeUser", $fetch['TypeUser'], 2147483647);
                    if ($fetch['TypeUser'] == "Artist") {
                        $data = [
                            'status' => 200,
                            'icon' => "success",
                            'redirect' => "artist/index.php"
                        ];
                        echo json_encode($data);
                        return false;
                    } else {
                        setcookie("UserID", $fetch['UserID'], 2147483647);
                        setcookie("TypeUser", $fetch['TypeUser'], 2147483647);
                        $data = [
                            'status' => 200,
                            'icon' => "success",
                            'redirect' => "index.php"
                        ];
                        echo json_encode($data);
                        return false;
                    }
                }
                // if ($fetch['Status'] == "Pending") {
                //     $data = [
                //         'status' => 302,
                //         'icon' => 'info',
                //         'message' => "Please wait to accept your account. Thank you.",
                //     ];
                //     echo json_encode($data);
                //     return false;
                // }
                // $data = [
                //     'status' => 302,
                //     'icon' => 'error',
                //     'message' => "Sorry to inform to you that your account has declined by admin.",
                // ];
                // echo json_encode($data);
                // return false;
            }
        } else {
            // Not Valid Credentials
            $data = [
                'status' => 302,
                'icon' => 'error',
                'message' => "Username/Password is not valid",
            ];
            echo json_encode($data);
            return false;
        }
    }

    public function fetchArtist()
    {
        $stmt = $this->fetch_artist();
        return $stmt;
    }

    public function fetchingArtistiInfo($UserID, $TypeUser)
    {
        $stmt = $this->fetch_artist_info($UserID, $TypeUser);
        return $stmt;
    }

    public function fetchArtistProfile($UserID)
    {
        $stmt = $this->fetch_artist_profile($UserID);
        return $stmt;
    }

    public function fetchArtistDesc($UserID)
    {
        $stmt = $this->fetch_artist_desc($UserID);
        return $stmt;
    }

    public function fetchArtistServices($UserID)
    {
        $stmt = $this->fetch_artist_services($UserID);
        return $stmt;
    }

    public function checkingBookmark($ArtistUserID)
    {
        $stmt = $this->checking_bookmark($ArtistUserID);
        return $stmt;
    }


    public function PeopleList()
    {
        $stmt = $this->people_list();
        return $stmt;
    }

    public function Conversation($SenderUserId)
    {

        $stmt = $this->conversation1($SenderUserId);
        return $stmt;
    }
    // ------------------------- Client Side -------------------------//
}
