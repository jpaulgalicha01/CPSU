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

                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
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
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>



                <a href="#" class="btn btn-primary text-center form-control mt-3 btn-rounded">Preview</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Close</button>
                <button type="button" class="btn btn-success"><i class="fa fa-bookmark" aria-hidden="true"></i> Reserve Booking</button>
            </div>
        </div>
    </div>
</div>

<script>
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
        // alert(value)

        // $.get(`inputConfig.php?servicesID=${value}`, function(data) {
        //     var res = jQuery.parseJSON(data);

        //     if (res.status == 200) {
        $("#servicesModal").modal("show");


        //     } else {
        //         console.error(res.message);
        //     }
        // })
    })
</script>


<?php
include 'includes/footer.php';
?>