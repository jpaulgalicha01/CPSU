<?php

class fetch extends controller
{
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
                if ($fetch['Status'] == "Pending") {
                    $data = [
                        'status' => 302,
                        'icon' => 'info',
                        'message' => "Please wait to accept your account. Thank you.",
                    ];
                    echo json_encode($data);
                    return false;
                }
                $data = [
                    'status' => 302,
                    'icon' => 'error',
                    'message' => "Sorry to inform to you that your account has declined by admin.",
                ];
                echo json_encode($data);
                return false;
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

    public function fetchingArtistiInfo($UserID)
    {
        $stmt = $this->fetch_artist_info($UserID);
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
}
