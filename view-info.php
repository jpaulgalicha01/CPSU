<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';

//Checking if client is not logging in
$UserID = secured($_GET['UserID']);

// if (!isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] != "Client") {
//     ob_end_flush(header("Location: login.php"));
//     return;
// }

$FName;
$MName;
$LName;
$Age;
$Birthdate;
$civilStatus;
$CompleteAddress;
$TotalReviews;
$TotalRevStars;

$fetchingArtistiInfo = new fetch();
$resfetchingArtistiInfo = $fetchingArtistiInfo->fetchingArtistiInfo(secured($_GET['UserID']), "Artist");
if ($resfetchingArtistiInfo->rowCount() != 0) {
    while ($rowfetchingArtistiInfo = $resfetchingArtistiInfo->fetch()) {
        $FName = $rowfetchingArtistiInfo['FName'];
        $MName = $rowfetchingArtistiInfo['MName'];
        $LName = $rowfetchingArtistiInfo['LName'];
        $Age = ($rowfetchingArtistiInfo['Age'] != "0") ? $rowfetchingArtistiInfo['Age'] : "";
        $Birthdate = ($rowfetchingArtistiInfo['Age'] != "0") ? date('F d, Y', strtotime($rowfetchingArtistiInfo['Birthdate'])) : "";
        $CivilStatus = $rowfetchingArtistiInfo['CivilStatus'];
        $CompleteAddress = $rowfetchingArtistiInfo['CompleteAddress'];
    }
} else {
    ob_end_flush(header("Location: index.php"));
}


$count = 0;
if (isset($_COOKIE['UserID'])) {
    $checkingBookmark = new fetch();
    $rescheckingBookmark = $checkingBookmark->checkingBookmark();

    while ($rowcheckingBookmark = $rescheckingBookmark->fetch()) {
        if ($rowcheckingBookmark['Status'] == "Done" || $rowcheckingBookmark['Status'] == "Cancelled" || $rowcheckingBookmark['Status'] == "Declined") {
            $count = 0;
        } else {
            $count = 1;
        }
    }
}


$CountStars = new fetch();
$rowCountStars = $CountStars->CountStars($UserID);
if ($rowCountStars->rowCount()) {
    $TotalReviews = $rowCountStars->rowCount();
    $Stars = 0;
    while ($resCountStars = $rowCountStars->fetch()) {
        $Stars += $resCountStars["RevStars"];
    }
    $TotalRevStars = $Stars / $TotalReviews;
}

?>
</div>
</div>
<!-- Navbar End -->

<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-inner text-center">
                    <?php
                    $fetchArtistProfile = new fetch();
                    $resfetchArtistProfile = $fetchArtistProfile->fetchArtistProfile($UserID);

                    if ($resfetchArtistProfile->rowCount() != 0) {
                        $x = 1;
                        while ($rowfetchArtistProfile = $resfetchArtistProfile->fetch()) {
                            if ($x == 1) {
                    ?>
                                <div class="carousel-item  active">
                                    <img class="w-75 h-75" src="uploads/<?= $rowfetchArtistProfile['ProfImg'] ?>" alt="Image">
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="carousel-item ">
                                    <img class="w-75 h-75" src="uploads/<?= $rowfetchArtistProfile['ProfImg'] ?>" alt="Image">
                                </div>
                        <?php
                            }
                            $x++;
                        }
                    } else {
                        ?>
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="uploads/default.png" alt="Image">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">Artist </h3>
            <small class="pt-1">(<?= $TotalReviews ?> Reviews)</small>

            <input name="RevStars" class="rating rating-loading" data-show-clear="false"
                style="font-size: 0px !important; margin-bottom:0px !important" disabled value="<?= $TotalRevStars ?>">

            <div class="mb-2">
                <h5 class="font-weight-semi-bold">Name</h5>
                <p><?= $FName . " " . $MName . " " . $LName ?></p>
            </div>

            <div class="mb-2">
                <h5 class="font-weight-semi-bold">Age</h5>
                <p><?= $Age ?></p>
            </div>

            <div class="mb-2">
                <h5 class="font-weight-semi-bold">Birthdate</h5>
                <p><?= $Birthdate ?></p>
            </div>

            <div class="mb-2">
                <h5 class="font-weight-semi-bold">Civil Status</h5>
                <p><?= $CivilStatus ?></p>
            </div>

            <div class="mb-2">
                <h5 class="font-weight-semi-bold">Complete Address</h5>
                <p><?= $CompleteAddress ?></p>
            </div>


            <div class="d-flex align-items-center mb-4 pt-2 gap-2">
                <button class="btn btn-primary px-3" id="bookingbtn" value="" onclick="checkingLogin()" <?= $count == 1 ? "disabled" : "" ?>>
                    <i class="fa fa-<?= $count == 1 ? "check" : "bookmark" ?>" aria-hidden="true"></i> <?= $count == 1 ? "Booked" : "Request Bookmark" ?></button>
                <?php
                if (isset($_COOKIE["PHPSESSID"]) && isset($_COOKIE["UserID"]) && $_COOKIE["TypeUser"] == "Client") {
                ?>
                    <a href='messages.php?UserID=<?= $UserID ?>' class='btn btn-success'><i class='fa fa-message' aria-hidden='true'></i> Message Now</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-start border-secondary mb-4">
                <a class="nav-item nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Reviews</a>
            </div>
            <div class="tab-content">

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <div class="row">
                        <div class="col-md-6" style="max-height: 70vh;height:1005; overflow-y: auto;">

                            <?php

                            $fetchReview = new fetch();
                            $rowfetchReview = $fetchReview->fetchReview($_GET["UserID"]);

                            if ($rowfetchReview->rowCount() != 0) {
                            ?>
                                <h4 class="mb-4"><?= $rowfetchReview->rowCount() ?> review for "<?= $FName . " " . $MName . " " . $LName ?>"</h4>

                                <?php

                                while ($resfetchReview = $rowfetchReview->fetch()) {

                                ?>

                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6><?= $resfetchReview["ClientName"] ?> <?= ($resfetchReview["UserID"] === $_COOKIE["UserID"]) ? "(You)" : "" ?><small> - <i><?= date('d M, Y', strtotime($resfetchReview['Date'])) ?></i></small></h6>    
                                                <div class="text-primary mb-2">
                                                    <input name="RevStars" class="rating rating-loading" data-show-clear="false"
                                                        style="font-size: 0px !important; margin-bottom:0px !important" disabled value="<?= $resfetchReview["RevStars"] ?>">
                                                </div>
                                                <p><?= $resfetchReview["RevMessage"] ?></p>
                                            </div>
                                        </div>
                                    </div>


                            <?php
                                }
                            } else {
                                echo "no data found. ";
                            }

                            ?>




                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                            </div>
                            <form action="inputConfig.php" method="POST">
                                <input type="hidden" name="function" value="RevSubmit">
                                <input type="hidden" name="ArtistID" value="<?= $_GET["UserID"] ?>">
                                <input id="input-4" name="RevStars" class="rating rating-loading" data-show-clear="false"
                                    data-show-caption="true" style="font-size: 0px !important" required>
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" name="RevMessage" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="submit" name="RevSubmit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Services Available</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php
                $fetchArtistServices = new fetch();
                $resfetchArtistServices = $fetchArtistServices->fetchArtistServices(secured($_GET['UserID']), "0");

                if ($resfetchArtistServices->rowCount() != 0) {
                    $carouselIndex = 0;
                    while ($rowfetchArtistServices = $resfetchArtistServices->fetch()) {
                        $carouselID = "carouselExampleIndicators_" . $carouselIndex;
                ?>
                        <div class="card product-item border-0">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border py-2 d-flex justify-content-center">
                                <div id="<?= $carouselID ?>" class="carousel slide">
                                    <div class="carousel-inner text-center">
                                        <?php
                                        $fetchServicesImage = new fetch();
                                        $resfetchServicesImage = $fetchServicesImage->fetchServicesImage($rowfetchArtistServices['ServicesName'], $_GET['UserID']);

                                        if ($resfetchServicesImage->rowCount() != 0) {
                                            $isFirst = true;
                                            while ($rowfetchServicesImage = $resfetchServicesImage->fetch()) {
                                        ?>
                                                <div class="carousel-item <?= $isFirst ? 'active' : '' ?>">
                                                    <img width="300" height="300" src="uploads/<?= $rowfetchServicesImage['Images'] ?>" alt="Image" class="d-block w-100">
                                                </div>
                                            <?php
                                                $isFirst = false;
                                            }
                                        } else {
                                            ?>
                                            <div class="carousel-item active">
                                                <img class="w-100 h-100" src="uploads/default.png" alt="Image">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#<?= $carouselID ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#<?= $carouselID ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h3 class="text-truncate mb-3"><?= htmlspecialchars(($rowfetchArtistServices["ServiceOtherName"] == "Other") ? $rowfetchArtistServices['ServicesName'] . "(" . $rowfetchArtistServices["ServiceOtherName"] . ")" : $rowfetchArtistServices['ServiceOtherName']) ?></h3>
                                <div class="d-grid justify-content-center gap-3">
                                    <h6>₱<?= htmlspecialchars($rowfetchArtistServices['Price']) ?></h6>
                                    <div>
                                        <span>Policy</span>
                                        <h6><?= htmlspecialchars($rowfetchArtistServices['Description']) ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $carouselIndex++; // Increment the index for the next carousel
                    }
                } else {
                    echo "<p>No Services Found</p>";
                }
                ?>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Request For Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="BookRequest">
                <input type="hidden" name="ArtistUserID" value="<?= $UserID ?>">
                <input type="hidden" name="function" value="book_request">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-md-flex d-sm-grid justify-content-between form-group">
                                    <div>
                                        <label for="FName">First Name</label>
                                        <input type="text" name="FName" id="FName" class="form-control" value="<?= $Client_FName ?>" disabled>
                                    </div>
                                    <div>
                                        <label for="FName">Middle Name</label>
                                        <input type="text" name="FName" id="FName" class="form-control" value="<?= $Client_MName ?>"
                                            disabled>
                                    </div>
                                    <div>
                                        <label for="FName">Last Name</label>
                                        <input type="text" name="FName" id="FName" class="form-control" value="<?= $Client_LName ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Address">Pin Location</label>
                                    <input type="text" name="Address" id="Address" class="form-control" value="<?= $Client_CompleteAddress ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="Services">Services</label>
                                            <select name="Services" id="Services" class=" form-control " required>
                                                <?php
                                                $fetchArtistServices = new fetch();
                                                $resfetchArtistServices = $fetchArtistServices->fetchArtistServices(secured($_GET['UserID']), "1");

                                                if ($resfetchArtistServices->rowCount() != 0) {
                                                    echo "<option value='' selected disabled>-- Please Select --</option>";
                                                    while ($rowfetchArtistServices = $resfetchArtistServices->fetch()) {
                                                ?>
                                                        <option value="<?= secured($_GET['UserID']) . '&' . $rowfetchArtistServices["ServiceCatNo"] ?>"><?= htmlspecialchars($rowfetchArtistServices['ServicesName']) ?></option>

                                                <?php
                                                    }
                                                } else {
                                                    echo "<option selected disbaled> -- No Data Found--</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div id="otherNameGroup" class="d-none">
                                            <label for="OtherName">Other Name</label>
                                            <select name="OtherName" id="OtherName" class="form-control ">
                                                <option value="">---Please Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-12">

                                        <div class="mx-auto ">
                                            <label for="typeServices">Type of Service</label>
                                            <select name="typeServices" id="typeServices" class="form-control " required>
                                                <option value="" disabled selected>---- Please Select ----</option>
                                                <option>Home Service</option>
                                                <option>None</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">

                                        <div class="mx-auto ">

                                            <label for="date">Available Date</label>
                                            <select name="date" id="date" class=" form-control " required>
                                                <?php
                                                $availDateRes = new fetch();
                                                $res_availDateRes = $availDateRes->availDateRes(secured($_GET['UserID']));

                                                if ($res_availDateRes->rowCount() != 0) {
                                                    echo "<option value='' selected disabled>-- Please Select --</option>";
                                                    while ($row_availDateRes = $res_availDateRes->fetch()) {
                                                ?>
                                                        <option value="<?= $row_availDateRes['date'] ?>">
                                                            <?= FormatDate("F d, Y", $row_availDateRes['date']) ?>
                                                        </option>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<option value= '' selected disbaled> -- No Available Date Found--</option>";
                                                }


                                                ?>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-12">

                                        <div class="mx-auto ">
                                            <label for="">Time:</label>
                                            <input type="time" name="time" id="time" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div>
                                        <label for="SampleOutcome">Sample Outcome <small><i>(optional)</i></small></label>
                                        <select name="SampleOutcome" id="SampleOutcome" class="form-control">
                                            <option>No</option>
                                            <option>Yes</option>
                                        </select>
                                    </div>
                                    <div class="d-none" id="uploadSampleOutcome">
                                        <label for="">uploads file here.</label>
                                        <input type="file" class="form-control" name="uploadSampleOutcome">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnRequest">Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade " id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" ">
  <div class=" modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Login User</h1>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form class="pt-3" id="login">
                            <div class="vstack gap-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="Uname" class="form-control rounded" id="floatingInputUName" placeholder="Username" required>
                                    <label for="floatingInputUName"><i class="fa-solid fa-user"></i> Username</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" name="Password" class="form-control rounded" id="floatingInputPass" placeholder="Password" required>
                                    <label for="floatingInputPass"><i class="fas fa-lock"></i> Password</label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="form-check pb-3">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="showCheckBoxPass"
                                            onclick="showPass()" />
                                        <label
                                            class="form-check-label"
                                            for="showCheckBoxPass">
                                            Show Password
                                        </label>
                                    </div>

                                </div>

                                <button type="submit" class="form-control btn btn-primary" id="login_btn"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                                <a href="register.php" class="text-center">Create Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
    </div>
</div>
</div>

<script>
    const SampleOutcome = document.getElementById("SampleOutcome");
    SampleOutcome.addEventListener('input', function() {
        let value = SampleOutcome.value;

        if (value == "Yes") {
            $("#uploadSampleOutcome").addClass("d-block");
            $("#uploadSampleOutcome").removeClass("d-none");
        } else {
            $("#uploadSampleOutcome").removeClass("d-block");
            $("#uploadSampleOutcome").addClass("d-none");
        }
    })
    // alert(SampleOutcome)


    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return null;
    }

    function checkingLogin() {

        // checking if client is log in
        let clientUserID = getCookie("UserID");
        let clientTypeUser = getCookie("TypeUser");

        if (clientUserID != null && clientTypeUser != null) {
            // alert(clientUserID + " "+ clientTypeUser);
            $("#bookingModal").modal("show")



        } else {
            $("#loginModal").modal("show");
        }
    }


    //Add Booking
    $(document).on('submit', '#BookRequest', function(e) {
        e.preventDefault(e);
        var formData = new FormData(this);
        formData.append("book_request", true);

        $("#btnRequest").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'></span></div></div>");
        document.getElementById("btnRequest").disabled = true;
        $.ajax({
            method: "POST",
            url: "inputConfig.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 200) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                    });
                    Toast.fire({
                        icon: res.icon,
                        title: "Successfully Added",
                    }).then(() => {
                        $("#bookingModal").modal('hide');
                        document.getElementById("bookingbtn").disabled = true;
                        $("#bookingbtn").html("<i class='fa fa-check' aria-hidden='true'></i> Booked");
                    });
                } else if (res.status == 302) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    Toast.fire({
                        icon: res.icon,
                        title: res.message,
                    })
                    $("#btnRequest").text("Booked");
                    document.getElementById("btnRequest").disabled = false;
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    Toast.fire({
                        icon: res.icon,
                        title: res.message,
                    })
                    $("#btnRequest").text("Request");
                    document.getElementById("btnRequest").disabled = false;
                }

            }
        })
    });



    $(document).on("change", "#Services", function() {
        let otherNameGroup = $("#otherNameGroup");

        var value = $(this).val();
        let values = value.split("&").map(v => v.trim());

        let ArtistID = values[0];
        let ServicesCatNo = values[1];

        if (ServicesCatNo === "16") {
            otherNameGroup.removeClass("d-none");

            $.get(`inputConfig.php?ArtistID=${ArtistID}&ServicesCatNo=${ServicesCatNo}`, function(data) {
                var res = jQuery.parseJSON(data);

                if (res.status == 200) {
                    let output = '';

                    $.each(res.data, function(index, item) {
                        output += `<option>${item.ServicesName}</option>`;
                    });

                    $("#OtherName").html(output);

                } else {
                    console.error("Error fetching Data.");
                }
            });

        } else {
            otherNameGroup.addClass("d-none");
        }
    });
</script>

<?php
include 'includes/footer.php';
?>