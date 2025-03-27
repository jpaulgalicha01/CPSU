<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isset($_COOKIE['UserID']) && !$_COOKIE['TypeUser']) {
    ob_end_flush(header("Location: index.php"));
}
?>
</div>
</div>

<div class="container">
    <h5 class="display-4">Booked List</h5>
    <div class="row">
        <div class="col-12 px-lg-0">
            <div class="d-lg-flex d-grid justify-content-lg-between form-group gap-2 align-items-end" id="selection">
                <div class="w-100">
                    <label for="Categories">Categories</label>
                    <select class="form-select" id="Categories">
                        <option value="0">All</option>
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
                <div class="w-100">
                    <label for="Status">Status</label>
                    <select class="form-select" id="Status">
                        <option>All</option>
                        <option>Pending</option>
                        <option>Accept</option>
                        <option>Declined</option>
                        <option>Done</option>
                        <option>Cancelled</option>
                    </select>
                </div>
                <div class="text-end">
                    <button class="btn btn-success" id="btnFilter">Filter</button>

                </div>
            </div>


        </div>
        <div class="col-12 mt-3 border border-1 shadow-sm  mb-3 bg-body-tertiary rounded" style="min-height:65vh; max-height: 150vh;  overflow-y: auto;" id="content">

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewServices" tabindex="-1" aria-labelledby="viewServicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewServicesLabel">Title Name</h1>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row text-lg-start text-center">
                        <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center" id="ProfImg">

                        </div>
                        <div class="col-lg-6 col-12 pt-lg-0 pt-2">
                            <div class="form-group pb-1">
                                <label for="ArtistName" class="form-label">Artist Name:</label>
                                <input type="text" class="form-control text-lg-start text-center bg-primary text-white" disabled id="ArtistName" value="ArtistName">
                            </div>
                            <div class="form-group pb-1">
                                <label for="SerivcesSelect" class="form-label">Serivces Select:</label>
                                <input type="text" class="form-control text-lg-start text-center bg-primary text-white" disabled id="SerivcesSelect" value="SerivcesSelect">
                            </div>
                            <div class="form-group pb-1">
                                <label for="BookingDateTime" class="form-label">Booking Date & Time:</label>
                                <input type="text" class="form-control text-lg-start text-center bg-primary text-white" disabled id="BookingDateTime" value="BookingDateTime">
                            </div>
                            <div class="form-group pb-1">
                                <label for="BookingStatus" class="form-label">Booking Status:</label>
                                <input type="text" class="form-control text-lg-start text-center bg-primary text-white" disabled id="BookingStatus" value="BookingStatus">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="btnRowId">Cancelled</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on("click", "#btnFilter", function() {
        let Categories = "";
        let Status = "";
        $("#selection option:selected").each(function() {
            Categories = document.getElementById("Categories").value;
            Status = document.getElementById("Status").value;
        })
        $("#content").text("loading.........")
        $.get(`booked-list-child.php`, {
            Categories: Categories,
            Status: Status
        }, function(data) {
            $("#content").html(data)
        })
    })

    $(document).on("click", "#viewBtn", function() {
        let value = $(this).attr("data-value");
        $.get(`inputConfig.php`, {
            bookingID: value
        }, function(data) {
            var res = jQuery.parseJSON(data);
            if (res.status == 200) {
                $("#viewServices").modal("show");
                $("#ProfImg").html("<img src='./uploads/" + res.data['ProfImg'] + "' alt='' height='250' width='250' class='img-fluid' />");
                $("#viewServicesLabel").text((res.data["Services"] === "16") ? res.data["OtherNameServices"] + " (" + res.data["ServiceCategory"] + ")" : res.data["ServiceCategory"])
                $("#ArtistName").val(res.data["FName"] + " " + res.data["MName"] + " " + res.data["LName"])
                $("#SerivcesSelect").val((res.data["Services"] === "16") ? res.data["OtherNameServices"] + " (" + res.data["ServiceCategory"] + ")" : res.data["ServiceCategory"])
                $("#BookingDateTime").val(convertDate(res.data["Date"]) + " - " + convertTime(res.data["Time"]))
                if (res.data["Status"] == "Accept" || res.data["Status"] == "Done") {
                    $("#BookingStatus").removeClass("bg-secondary")
                    $("#BookingStatus").removeClass("bg-danger")
                    $("#BookingStatus").addClass("bg-success")
                    $("#BookingStatus").val(res.data["Status"])
                    $("#btnRowId").addClass("d-none");
                } else if (res.data["Status"] == "Declined" || res.data["Status"] == "Cancelled") {
                    $("#BookingStatus").removeClass("bg-secondary")
                    $("#BookingStatus").removeClass("bg-success")
                    $("#BookingStatus").addClass("bg-danger")
                    $("#BookingStatus").val(res.data["Status"])
                    $("#btnRowId").addClass("d-none");
                } else {
                    $("#BookingStatus").removeClass("bg-danger")
                    $("#BookingStatus").removeClass("bg-success")
                    $("#BookingStatus").addClass("bg-secondary")
                    $("#BookingStatus").val(res.data["Status"])

                    $("#btnRowId").attr("value", value)
                }
            } else {
                console.error("There's Something Wrong.")
            }
        })
    })


    $(document).on("click", "#btnRowId", function() {
        var val = $(this).val()


        var confirmDelete = confirm(`Are you sure you want to cancelled this transaction ?`);

        if (confirm) {
            $.get(`inputConfig.php`, {
                bookingIDCancelled: val,
                function: "Cancelled Booking"
            }, function(data) {
                var res = jQuery.parseJSON(data);

                if (res.status === 200) {
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
                        window.location.reload();
                    });
                }
            })
        }
    })
</script>

<?php
include 'includes/footer.php';
?>