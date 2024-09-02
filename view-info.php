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

$fetchingArtistiInfo = new fetch();
$resfetchingArtistiInfo = $fetchingArtistiInfo->fetchingArtistiInfo(secured($_GET['UserID']),"Artist");
if ($resfetchingArtistiInfo->rowCount() != 0) {
    while ($rowfetchingArtistiInfo = $resfetchingArtistiInfo->fetch()) {
        $FName = $rowfetchingArtistiInfo['FName'];
        $MName = $rowfetchingArtistiInfo['MName'];
        $LName = $rowfetchingArtistiInfo['LName'];
        $Age = $rowfetchingArtistiInfo['Age'];
        $Birthdate = date('F d, Y', strtotime($rowfetchingArtistiInfo['Birthdate']));
        $CivilStatus = $rowfetchingArtistiInfo['CivilStatus'];
        $CompleteAddress = $rowfetchingArtistiInfo['CompleteAddress'];
    }
} else {
    ob_end_flush(header("Location: index.php"));
}


$count = 0;
if(isset($_COOKIE['UserID'])){
    $checkingBookmark = new fetch();
$rescheckingBookmark = $checkingBookmark->checkingBookmark($UserID);

$count =  $rescheckingBookmark->rowCount();
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
                            <div class="carousel-item active">
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



            <div class="d-flex align-items-center mb-4 pt-2">
                <button class="btn btn-primary px-3"  id="bookingbtn" value="" onclick="checkingLogin()"  <?= $count == 1 ? "disabled" : "" ?>>
                    <i class="fa fa-<?= $count == 1? "check":"bookmark"?>" aria-hidden="true"></i> <?= $count == 1? "Booked":"Request Bookmark"?></button>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Reviews (0)</a>
            </div>
            <div class="tab-content">

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
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

                
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
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
                            <form>
                            <input id="input-4" name="input-4" class="rating rating-loading" data-show-clear="false"
                            data-show-caption="true" style="font-size: 0px !important">
                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group mt-2">
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

<!-- <div class="container-fluid py-5">
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
                                <h6 class="text-truncate mb-3"><?=$rowfetchArtistServices['ServicesName']?></h6>
                                <div class="d-flex justify-content-center">
                                    <h6>₱<?=$rowfetchArtistServices['Price']?></h6>
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
</div> -->

<!-- Modal -->
<div class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request For Booking</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="BookRequest">
                <input type="hidden" name="ArtistUserID" value="<?=$UserID?>">
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
                                        <input type="text" name="FName" id="FName" class="form-control" value="<?=$Client_LName?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Address">Pin Location</label>
                                    <input type="text" name="Address" id="Address" class="form-control" value="<?=$Client_CompleteAddress?>" >
                                </div>

                                <div class="d-md-flex d-sm-grid form-group" style="gap:20px">
                                    <div>
                                        <label for="Services">Services</label>
                                        <select name="Services" id="Services" class=" form-control " required>
                                            <?php
                                            $fetchArtistServices = new fetch();
                                            $resfetchArtistServices = $fetchArtistServices->fetchArtistServices(secured($_GET['UserID']));

                                            if ($resfetchArtistServices->rowCount() != 0) {
                                                echo "<option value='' selected disabled>-- Please Select --</option>";
                                                while ($rowfetchArtistServices = $resfetchArtistServices->fetch()) {
                                                    ?>
                                                    <option><?= $rowfetchArtistServices['ServicesName'] ?></option>
                                                    <?php
                                                }
                                            } else {
                                                echo "<option selected disbaled> -- No Data Found--</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="">Date:</label>
                                        <input type="date" name="date" id="date" class="form-control" required>
                                    </div>
                                    <div>
                                        <label for="">Time:</label>
                                        <input type="time" name="time" id="time" class="form-control" required>
                                    </div>

                                </div>

                                <div class="form-group" >
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





<script>
    const SampleOutcome = document.getElementById("SampleOutcome");
    SampleOutcome.addEventListener('input', function () {
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
  for(let i = 0; i < ca.length; i++) {
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
function checkingLogin () {

    // checking if client is log in
    let clientUserID = getCookie("UserID");
    let clientTypeUser = getCookie("TypeUser");

    if(clientUserID != null && clientTypeUser != null){
        // alert(clientUserID + " "+ clientTypeUser);
        $("#bookingModal").modal("show")



    }else{
        window.location.href="login.php";
    }
}


//Add Booking
$(document).on('submit','#BookRequest',function (e) {
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
      contentType:false,
      success:function(response){
          var res = jQuery.parseJSON(response);

          if(res.status == 200){
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
            }).then(()=>{
                $("#bookingModal").modal('hide');
                document.getElementById("bookingbtn").disabled = true;
                $("#bookingbtn").html("<i class='fa fa-check' aria-hidden='true'></i> Reserved");
            });
          }
          else if(res.status == 302){
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
          }
          else{
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
</script>

<?php
include 'includes/footer.php';
?>