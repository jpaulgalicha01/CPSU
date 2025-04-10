<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
unset($_SESSION['Active_Navigate']);
$_SESSION['title'] = "Status Booking";
$_SESSION['Active_Navigate'] = "Status Booking";

include_once("includes/header.php");
include_once("includes/navbar.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid px-4 pt-5">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Of Booking</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="d-grid align-items-center">
                    <div class="w-50 mb-2">
                        <label for="Status" class="mr-1">Status :</label>
                        <select id="Status" class="form-control mr-2">
                            <option>All</option>
                            <option>Done</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-success" id="filterBtn">Filter</button>
                    </div>

                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Birthdate</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Sample Outcome</th>
                            <th>Status</th>
                            <!-- <th class="text-center">Action</th> -->
                        </tr>
                    </thead>
                    <tbody id="result">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- view booking Modal-->
<div class="modal fade" id="viewBooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form action="inputConfig.php" method="POST">
                <input type="hidden" name="function" value="booking_action">
                <input type="hidden" name="ClientUserID" id="ClientUserID">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-lg-flex d-md-grid justify-content-around">
                                    <div id="user_profile" class="col-md-auto">

                                    </div>
                                    <div class="col py-lg-0 py-3">
                                        <h5>Client Information</h5>
                                        <label for="FullName">Services: </label>
                                        <p class="mb-1 view-user-modal font-weight-bold" id="Services"></p>
                                        <label for="FullName">Date & Time: </label>
                                        <p class="mb-1 view-user-modal font-weight-bold" id="DateTime"></p>
                                        <label for="FullName">Name: </label>
                                        <p class="mb-1 view-user-modal font-weight-bold" id="FullName"></p>
                                        <label for="Age">Age: </label>
                                        <p class="mb-1 view-user-modal font-weight-bold" id="Age"></p>
                                        <label for="Birthdate">Birth of Date: </label>
                                        <p class="mb-1 view-user-modal font-weight-bold" id="Birthdate"></p>
                                        <label for="CivilStatus">Civil Status: </label>
                                        <p class="mb-1 view-user-modal font-weight-bold" id="CivilStatus"></p>
                                        <label for="CompleteAddress">Complete Address: </label>
                                        <p class="mb-1 view-user-modal font-weight-bold" id="CompleteAddress"></p>
                                        <label for="CompleteAddress">Pin Location: </label>
                                        <a href="#" class="mb-1 view-user-modal">Click Here!</a>
                                        <select name="status" id="status" class="form-control">
                                            <option>Pending</option>
                                            <option>Accept</option>
                                            <option>Declined</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" name="booking_action">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //     $("#Status").change(function() {
    //         const value = $(this).val();


    //         $.get("list-booking-data.php", {
    //             status: value
    //         }, function(data) {
    //             $("#result").html(data);
    //         })

    //     })
    //     $("#Status").trigger("change")

    // })

    $(document).on("click", "#filterBtn", function() {
        var status = document.getElementById("Status").value
        $.get("list-booking-data.php", {
            status: status
        }, function(data) {
            $("#result").html(data);
        })
    })


    $(document).on("click", "#showBookingInfo", function() {
        var value = $(this).val();

        $.get(`inputConfig.php?viewBookingInfo=${value}&Status=Pending`, function(data) {
                var res = jQuery.parseJSON(data);

                if (res.status == 200) {
                    $("#viewBooking").modal("show");
                    $("#user_profile").html("<img src='../uploads/" + res.data['ProfImg'] + "' class='img-fluid' width='250px' height='250px' />");
                    $("#Services").text(res.data['Services']);
                    $("#DateTime").text(convertDate(res.data['Date']) + " - " + convertTime(res.data['Time']));
                    $("#FullName").text(res.data['FName'] + " " + res.data['MName'] + " " + res.data['LName']);
                    $("#Age").text(res.data['Age']);
                    $("#ClientUserID").val(res.data['ClientUserID']);
                    $("#Birthdate").text(convertDate(res.data['Birthdate']));

                    $("#CivilStatus").text(res.data['CivilStatus']);
                    $("#CompleteAddress").text(res.data['CompleteAddress']);
                    $("#status").val(res.data['Status']);
                } else {
                    alert(res.message)
                }
            })

            .fail(function(xhr, status, error) {
                console.log('Ajax request failed:', status, error);
            })



    })
</script>

<?php
include_once("includes/footer.php");
?>