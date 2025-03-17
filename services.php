<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

</div>
</div>
<!-- Navbar End -->



<div class="container-fluid">
    <div class="row" style="min-height: 85vh;">
        <div class="col-2 border-end pt-3 d-md-block d-none">
            <ul class="nav nav-pills flex-column ">
                <h5>Services List</h5>
                <li class="nav-item"><a class="nav-link active" href="#serv_list=all">All</a></li>

                <?php
                $fetchingServiceCat = new fetch();
                $resfetchingServiceCat = $fetchingServiceCat->fetchingServiceCat();

                if ($resfetchingServiceCat->rowCount() != 0) {
                    while ($rowfetchingServiceCat = $resfetchingServiceCat->fetch()) {
                ?>

                        <li class="nav-item" id="link<?= $rowfetchingServiceCat["id"] ?>"><a class="nav-link " href="#serv_list=<?= $rowfetchingServiceCat["id"] ?>"><?= $rowfetchingServiceCat["ServiceName"] ?></a></li>

                <?php
                    }
                }
                ?>

            </ul>
        </div>
        <div class="col-md-10 col-12 py-4">

            <div class="row">
                <div class="d-md-none d-block ">
                    <label for="Categories">Services List</label>
                    <select id="Categories" class="form-select mb-3">
                        <option value="all">All</option>
                        <?php
                        $fetchingServiceCat = new fetch();
                        $resfetchingServiceCat = $fetchingServiceCat->fetchingServiceCat();

                        if ($resfetchingServiceCat->rowCount() != 0) {
                            while ($rowfetchingServiceCat = $resfetchingServiceCat->fetch()) {
                        ?>

                                <option value="<?= $rowfetchingServiceCat["id"] ?>"><?= $rowfetchingServiceCat["ServiceName"] ?></option>


                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row px-2" style="max-height: 120vh;height:1005; overflow-y: auto;" id="listServices">

            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="servicesModal" tabindex="-1" aria-labelledby="servicesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="serviceName">Service Name</h1>
                <p class="modal-title fs-5" id="servicePrice">(Price)</p>
            </div>
            <div class="modal-body">

                <div id="cauroselModalServiceIMG" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="uploads/default.png" class="d-block" alt="..." style="height: 350px; width:100%;">
                        </div>
                        <div class="carousel-item">
                            <img src="uploads/default.png" class="d-block" alt="..." style="height: 350px; width:100%;">
                        </div>
                        <div class="carousel-item">
                            <img src="uploads/default.png" class="d-block" alt="..." style="height: 350px; width:100%;">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#cauroselModalServiceIMG" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#cauroselModalServiceIMG" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <a href="#" class="btn btn-primary text-center form-control btn-rounded" id="previewArtist">Preview</a>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Close</button>
                <?php
                if (isset($_COOKIE["PHPSESSID"]) && isset($_COOKIE["UserID"]) && $_COOKIE["TypeUser"] == "Client") {
                ?>
                    <button type="button" class="btn btn-success" id="btnReserveBooking"><i class="fa fa-bookmark" aria-hidden="true"></i> Request Booking</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Request For Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="BookRequest">
                <input type="hidden" name="ArtistUserID" id="ArtistUserID" value="">
                <input type="hidden" name="function" value="book_request">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-lg-flex d-grid justify-content-lg-between form-group">
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
                                            <select type="text" name="Services" id="Services" class="form-control">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div id="otherNameGroup">
                                            <label for="OtherName">Other Name</label>
                                            <select type="text" name="OtherName" id="OtherName" class="form-control">

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

    $(document).ready(function() {
        getServiceFromHash();

        $(window).on("hashchange", function() {
            getServiceFromHash();
        });


        function getServiceFromHash() {
            let hash = window.location.hash;

            if (hash.includes("=")) {
                let value = hash.split("=")[1];
                loadServiceData(value);

                $("#Categories").val(value)
            }
        }

    });


    $("#Categories").change(function() {
        let value = $(this).val();
        loadServiceData(value);

        let newURL = `#serv_list=${value}`;
        history.pushState(null, "", newURL);
    });


    function loadServiceData(serviceId) {
        if (!serviceId) return;


        $("#listServices").html("<p>Loading.....</p>");

        $.get(`services-child.php?services_cat=${serviceId}`, function(response) {
            $("#listServices").html(response);
        });

        $(".nav-link").removeClass("active");
        $("a[href$='#serv_list=" + serviceId + "']").addClass("active");
    }

    $(document).on("click", "#servicesBtn", function() {
        var value = $(this).val();

        $.get(`inputConfig.php?servicesID=${value}`, function(data) {
            var res = jQuery.parseJSON(data);
            if (res.status == 200) {
                $("#servicesModal").modal("show");
                $("#btnReserveBooking").val(res.data["RowNum"])
                $("#serviceName").text(
                    res.data["ServiceCatNo"] !== "16" ?
                    res.data["ServiceCatName"] :
                    `${res.data["ServicesName"]} (${res.data["ServiceCatName"]})`
                );
                $("#servicePrice").text("₱ " + res.data["Price"]);

                $("#previewArtist").attr("href", `view-info.php?UserID=${res.data["UserID"]}`);

                var carouselInner = $("#cauroselModalServiceIMG .carousel-inner");
                carouselInner.empty();

                if (res.data2.length > 0) {
                    $.each(res.data2, function(index, item) {
                        var activeClass = index === 0 ? "active" : "";
                        var carouselItem = `
                        <div class="carousel-item ${activeClass}">
                            <img src="uploads/${item.Images}" class="d-block" alt="..." style="height: 350px; width:100%;">
                        </div>`;
                        carouselInner.append(carouselItem);
                    });
                } else {
                    carouselInner.append(`
                    <div class="carousel-item active">
                        <img src="uploads/default.png" class="d-block" alt="..." style="height: 350px; width:100%;">
                    </div>`);
                }

            } else {
                console.error(res.message);
            }
        });
    });

    $(document).on("click", "#btnReserveBooking", function() {
        var value = $(this).val();
        $("#servicesModal").modal("hide");

        $.get(`inputConfig.php?reservedBookingID=${value}`, function(data) {
            var res = jQuery.parseJSON(data);

            if (res.status == 200) {
                $("#bookingModal").modal("show");
                $("#ArtistUserID").val(res.data["UserID"])
                $("#Services").html(`<option value='${res.data["ServiceCatNo"]}' selected>${res.data["ServiceCatName"]}</option>`);
                $("#OtherName").html(`<option value='${(res.data["ServiceCatNo"] === "16") ? res.data["ServicesName"] : ""}' selected>${(res.data["ServiceCatNo"] === "16") ? res.data["ServicesName"] : ""}</option>`);

                var dateInner = $("#date");
                dateInner.empty();
                if (res.data2.length > 0) {
                    $.each(res.data2, function(index, item) {
                        dateInner.append(`<option value='${item.date}'>${convertDate(item.date)}</option>`);
                    });
                }
            } else {
                console.error("Fetching Error");
            }
        });
    });


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
                        $("#btnRequest").text("Booked");
                        document.getElementById("btnRequest").disabled = true;
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
</script>


<?php
include 'includes/footer.php';
?>