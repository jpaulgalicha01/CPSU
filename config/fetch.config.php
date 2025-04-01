<?php

class fetch extends controller
{


    // ------------------------- Artist Side -------------------------//

    public function messageCount()
    {
        $stmt = $this->message_count();

        if ($stmt) {
            $countMessage = $stmt->rowCount();
            return $countMessage;
        } else {
            return "Message Count Error";
        }
    }

    public function fetchingProfImg($value, $ServiceName)
    {
        $stmt = $this->fetching_Prof_Img($value, $ServiceName);

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

    public function fetchingServiceCat()
    {
        $stmt = $this->fetching_service_cat();
        return $stmt;
    }

    // ------------------------- Artist Side -------------------------//



    // ------------------------- Client Side -------------------------//
    public function fetchInfoUser($UserID)
    {
        $stmt = $this->fetch_info_user($UserID);
        return $stmt;
    }

    public function ServicesList($checking, $service_cat_no)
    {
        $stmt = $this->services_list($checking, $service_cat_no);
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


    public function fetchingEarnOver()
    {
        $stmt = $this->fetching_earn_over();
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
                $data = [
                    'message' => "Failed To Fetch.",
                ];
                echo json_encode($data);
                return false;
            }
        } else {

            $data = [
                'message' => "There's something wrong.",
            ];
            echo json_encode($data);
            return false;
        }
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


    public function fetchingInfo($BookingID, $Status)
    {
        $stmt = $this->fetching_info($BookingID, $Status);
        if ($stmt) {
            return $stmt;
        }
        echo "ERROR!";
    }

    public function fetchingReservedDate($month, $year)
    {
        $stmt = $this->fetching_reserved_date($month, $year);
        $fetchingData = $stmt->fetchAll();

        echo json_encode($fetchingData);
        return false;
    }


    public function fetchServicesImage($servicesName, $servicesUserID)
    {

        $stmt = $this->fetch_services_image($servicesName, $servicesUserID);
        return $stmt;
    }


    public function availDateRes($ArtistUserID)
    {
        $stmt = $this->avail_date_res($ArtistUserID);

        return $stmt;
    }

    public function fetchOtherNameServices($ArtistID, $ServicesCatNo)
    {
        $stmt = $this->fetch_other_name_services($ArtistID, $ServicesCatNo);
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


    public function fetchingServicesInfo($servicesID)
    {
        $stmt = $this->fetching_services_info($servicesID);
        if ($stmt) {
            if ($stmt->rowCount()) {
                $fetch_info = $stmt->fetch();

                $stmt2 = $this->fetching_Prof_Img2($fetch_info["ServiceCatNo"], $fetch_info["ServicesName"], $fetch_info["UserID"]);
                $fetch_info2 = $stmt2->fetchAll();

                $data = [
                    'status' => 200,
                    'data' => $fetch_info,
                    'data2' => $fetch_info2,
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

    public function ShowBookingInfo($reservedBookingID)
    {
        $stmt = $this->show_booking_info($reservedBookingID);
        if ($stmt->rowCount()) {
            $fetch_info = $stmt->fetch();
            $UserID = $fetch_info["UserID"];

            $stmt2 = $this->avail_date_res($UserID);
            $fetch_info2 = $stmt2->fetchAll();
            $data = [
                'status' => 200,
                'data' => $fetch_info,
                'data2' => $fetch_info2,
            ];
            echo json_encode($data);
            return false;
        } else {
            return false;
        }
    }

    public function fetchingBookingClient($bookingID)
    {

        $stmt = $this->fetching_booking_client($bookingID);
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
    }

    public function fetchReview($ArtistUserID)
    {
        $stmt = $this->fetch_review($ArtistUserID);

        return $stmt;
    }


    public function CountStars($UserID)
    {
        $stmt = $this->count_stars($UserID);
        return $stmt;
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

    public function fetchArtistServices($UserID, $modal)
    {
        $stmt = $this->fetch_artist_services($UserID, $modal);
        return $stmt;
    }

    public function checkingBookmark()
    {
        $stmt = $this->checking_bookmark();
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
