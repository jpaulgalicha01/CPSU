<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>
<!-- Banner -->
<div class="container-fluid" style="z-index: 1;">
    <div class="row">
        <div class="col-12">
            <div id="cauroselBannerTop" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#cauroselBannerTop" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#cauroselBannerTop" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner bg-dark">
                    <div class="carousel-item active" style="max-height:80vh; ">
                        <img src="img/carousel-1.jpg" class="img-fluid" style="opacity: .5" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <h5 class="text-uppercase text-white font-weight-semi-bold mb-md-4 mb-3">Mukha</h5>
                                <p class="text-light font-weight-lighter mb-md-4 mb-3">An enchance online web
                                    application for cosmetic services</p>
                                <a href="" class="btn btn-light py-2 px-3">Booked Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="max-height:80vh; ">
                        <img src="img/carousel-1.jpg" class="img-fluid" style="opacity: .5" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <h5 class="text-uppercase text-white font-weight-semi-bold mb-md-4 mb-3">Mukha</h5>
                                <p class="text-light font-weight-lighter mb-md-4 mb-3">An enchance online web
                                    application for cosmetic services</p>
                                <a href="" class="btn btn-light py-2 px-3">Booked Now</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#cauroselBannerTop" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#cauroselBannerTop" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner -->

<!-- Featured Start -->
<!-- <div class="container-fluid pt-5">
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
</div> -->
<!-- Featured Start -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">TOP 3 ARTIST</span></h2>
    </div>

    <div class="row px-xl-5 pb-3">
        <?php
        $fetch_artist = new fetch();
        $res = $fetch_artist->fetchArtist();

        if ($res->rowCount() != 0) {
            while ($row = $res->fetch()) {
        ?>
                <div class="col-xl-4 col-md-6 col-12 mb-2">
                    <div class="card rounded shadow-lg p-2">
                        <div class="card-body ">
                            <a href="view-info.php?UserID=<?= $row['UserID'] ?>"
                                class="d-flex justify-content-center mb-3 img-prof hover-box">
                                <img class="img-fluid" src="uploads/<?= $row['ProfImg'] ?>" alt="">
                                <p class="hover-text btn btn-primary">See more..</p>
                            </a>
                            <h5 class="font-weight-semi-bold m-0"><?= $row['FName'] ?> <?= $row['MName'] ?> <?= $row['LName'] ?></h5>
                            <p class="font-weight-semi-bold m-0"><?= $row['CompleteAddress'] ?></p>
                            <span>⭐5.0</span>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No Artist Available";
        }
        ?>
    </div>

    <!-- <div class="row px-xl-5 pb-3">

      
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <a href="view-info.php?UserID=<?= $row['UserID'] ?>"
                            class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="uploads/<?= $row['ProfImg'] ?>" alt="">
                        </a>
                       
                        
                        
                        <span>⭐5.0</span>
                        <br />
                    </div>
                </div>
                
    </div> -->
</div>


<div class="container-fluid py-5 mt-5 " style="background-color:#EFF4F7; border-radius: 50px 50px 0px 0px;">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">DID YOU KNOW ?</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <div class="col-12">
            <div id="cauroselDidYouKnow" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#cauroselDidYouKnow" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#cauroselDidYouKnow" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner bg-dark">
                    <div class="carousel-item active text-center" style="max-height:80vh; ">
                        <img src="img/did_you_know_1.jpg" class="img-fluid " style="opacity: .5" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <h5 class="text-uppercase text-white font-weight-semi-bold mb-4">Ancient Eyeline</h5>
                                <p>The ancient Egyptians used kohl (a mix of lead, copper, and ash) as eyeliner to protect their eyes from the sun and ward off evil spirits.
                                    Source: <a href="https://edition.cnn.com/2024/02/29/style/eyeliner-kohl-cultural-history/index.html" target="_blank">https://edition.cnn.com/2024/02/29/style/eyeliner-kohl-cultural-history/index.html</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item  text-center" style="max-height:80vh; ">
                        <img src="img/did_you_know_2.jpg" class="img-fluid " style="opacity: .5" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <h5 class="text-uppercase text-white font-weight-semi-bold mb-4">Lipstick’s Unusual Ingredients</h5>
                                <p>Early lipsticks contained crushed beetles for red pigment and fish scales for shimmer. Modern lipsticks often use synthetic alternatives.
                                    Sourse: <a href="https://en.m.wikipedia.org/wiki/Lipstick" target="_blank">https://en.m.wikipedia.org/wiki/Lipstick</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#cauroselDidYouKnow" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#cauroselDidYouKnow" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

    </div>
</div>


<div class="container-fluid mt-5 pt-5 bg-secondary">
    <div class="text-center mb-4">
        <h1 class="text-title-primary text-white pb-lg-3 pb-2 ">ABOUT US</h1>
    </div>
    <div class="row px-xl-5 pb-3">
        <div class="col-12">
            <p class="fs-4 text-white" style="text-align: justify;">Welcome to Mukha, your ultimate destination for beauty and self-care! Our enhanced online web application is designed to provide access to cosmetic services. </p>
            <p class="fs-4 text-white" style="text-align: justify;">At Mukha, we believe that everyone deserves to feel confident and radiant. Whether you're looking for skincare treatments, makeup services, or aesthetic enhancements.</p>
            <p class="fs-4 text-white" style="text-align: justify;">Experience beauty at your fingertips with Mukha!</p>
        </div>

    </div>
</div>



<!-- Categories End -->

<?php
include 'includes/footer.php';
?>