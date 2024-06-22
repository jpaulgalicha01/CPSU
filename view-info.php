<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';

$UserID = secured($_GET['UserID']);
$FName;
$Age;
$Birthdate;
$civilStatus;
$CompleteAddress;

$fetchingArtistiInfo = new fetch();
$resfetchingArtistiInfo = $fetchingArtistiInfo->fetchingArtistiInfo($UserID);
if ($resfetchingArtistiInfo->rowCount() != 0) {
    while ($rowfetchingArtistiInfo = $resfetchingArtistiInfo->fetch()) {
        $FName = $rowfetchingArtistiInfo['FName'] . " " . $rowfetchingArtistiInfo['MName'] . " " . $rowfetchingArtistiInfo['LName'];
        $Age = $rowfetchingArtistiInfo['Age'];
        $Birthdate = date('F d, Y', strtotime($rowfetchingArtistiInfo['Birthdate']));
        $CivilStatus = $rowfetchingArtistiInfo['CivilStatus'];
        $CompleteAddress = $rowfetchingArtistiInfo['CompleteAddress'];
    }
} else {
    ob_end_flush(header("Location: index.php"));
}


?>
</div>
</div>
<!-- Navbar End -->

<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">

                    <div style="max-width:479px; height:423px" class="d-flex">

                        <?php
                        $fetchArtistProfile = new fetch();
                        $resfetchArtistProfile = $fetchArtistProfile->fetchArtistProfile($UserID);

                        if ($resfetchArtistProfile->rowCount() != 0) {
                            $x = 1;
                            while ($rowfetchArtistProfile = $resfetchArtistProfile->fetch()) {
                                if ($x == 1) {
                        ?>
                                    <div class="carousel-item  active">
                                        <img class="w-100 h-100" src="uploads/<?= $rowfetchArtistProfile['Images'] ?>" alt="Image">
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="carousel-item ">
                                        <img class="w-100 h-100" src="uploads/<?= $rowfetchArtistProfile['Images'] ?>" alt="Image">
                                    </div>
                            <?php
                                }


                                $x++;
                            }
                        } else {
                            ?>
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="uploads/default.png" alt="Image">
                            </div>
                        <?php
                        }
                        ?>

                    </div>

                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">Artist</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(50 Reviews)</small>
            </div>

            <div class="mb-2">
                <h5 class="font-weight-semi-bold">Name</h5>
                <p><?= $FName ?></p>
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



            <div class="d-flex align-items-center mb-4 pt-2">
                <button class="btn btn-primary px-3"><i class="fa fa-bookmark" aria-hidden="true"></i> Reserve to
                    Book</button>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>

                    <?php
                    $fetchArtistDesc = new fetch();
                    $resfetchArtistDesc = $fetchArtistDesc->fetchArtistDesc(secured($_GET['UserID']));
                    if ($resfetchArtistDesc->rowCount() != 0) {
                        while ($rowfetchArtistDesc = $resfetchArtistDesc->fetch()) {
                    ?>
                            <p style="white-space: pre-wrap; text-align:justify;"><?= $rowfetchArtistDesc['Description'] ?></p>
                        <?php
                        }
                    } else {
                        ?>
                        <p>No Post Found..</p>
                    <?php
                    }
                    ?>

                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                            <div class="media mb-4">
                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no
                                        at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                            </div>
                            <input id="input-4" name="input-4" class="rating rating-loading" data-show-clear="false" data-show-caption="true" style="font-size: 0px !important">
                            <form>
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Services Available</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">

                <?php
                $fetchArtistServices = new fetch();
                $resfetchArtistServices = $fetchArtistServices->fetchArtistServices(secured($_GET['UserID']));

                if ($resfetchArtistServices->rowCount() != 0) {
                    while ($rowfetchArtistServices = $resfetchArtistServices->fetch()) {
                ?>
                        <div class="card product-item border-0">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="uploads/<?= $rowfetchArtistServices['Images'] ?>" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>$123.00</h6>
                                    <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No Services Found</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->



<?php
include 'includes/footer.php';
?>