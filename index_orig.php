<?php
include 'includes/autoload.inc.php';
include 'includes/headerClient.php';
include 'includes/navbar.php';
?>

<div class="col-lg-12">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item bg-dark active" style="height: 410px;">
                <img class="img-fluid" style="opacity: .5" src="img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h3 class="display-4 text-uppercase text-white font-weight-semi-bold mb-4">Mukha</h3>
                        <h4 class="text-light font-weight-lighter mb-3">An enchance online web
                            application for cosmetic services</h4>
                        <a href="" class="btn btn-light py-2 px-3">Booked Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item bg-dark" style="height: 410px;">
                <img class="img-fluid" style="opacity: .5" src="img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h3 class="display-4 text-uppercase text-white font-weight-semi-bold mb-4">Mukha</h3>
                        <h4 class="text-light font-weight-lighter mb-3">An enchance online web
                            application for cosmetic services</h4>
                        <a href="" class="btn btn-light py-2 px-3">Booked Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
</div>
</div>
<!-- Navbar End -->

<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center justify-content-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center justify-content-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center justify-content-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center justify-content-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->
<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">List of Artist</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">

        <?php
        $fetch_artist = new fetch();
        $res = $fetch_artist->fetchArtist();

        if ($res->rowCount() != 0) {
            while ($row = $res->fetch()) {
                ?>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <a href="view-info.php?UserID=<?= $row['UserID'] ?>"
                            class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="uploads/<?= $row['ProfImg'] ?>" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0"><?= $row['FName'] ?>         <?= $row['MName'] ?>         <?= $row['LName'] ?>
                        </h5>
                        <p class="font-weight-semi-bold m-0"><?= $row['CompleteAddress'] ?></p>
                        <span>⭐5.0</span>
                        <br />
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No Artist Available";
        }
        ?>
    </div>
</div>
<!-- Categories End -->

<?php
include 'includes/footer.php';
?>