<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
unset($_SESSION['Active_Navigate']);
$_SESSION['title'] = "Pending List Booking";
$_SESSION['Active_Navigate'] = "Pending List Booking";

include 'includes/header.php';
include 'includes/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pending List Booking</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pendung List Of Booking</h6>
        </div>
        <div class="card-body">
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
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $fetchinngPendingBooking = new fetch();
                        $resfetchinngPendingBooking = $fetchinngPendingBooking->fetchinngPendingBooking("0", "Pending");

                        if ($resfetchinngPendingBooking->rowCount() != 0) {
                            while ($rowfetchinngPendingBooking = $resfetchinngPendingBooking->fetch()) {
                                $TDate = date('m/d/Y', strtotime(($rowfetchinngPendingBooking['TDate'])));

                                ?>
                                <tr>
                                    <td><?= $TDate ?></td>
                                    <td><?= $rowfetchinngPendingBooking['FName'] ?>
                                        <?= $rowfetchinngPendingBooking['MName'] ?>
                                        <?= $rowfetchinngPendingBooking['LName'] ?>
                                    </td>
                                    <td><?= $rowfetchinngPendingBooking['Age'] ?></td>
                                    <td><?= date('F d,Y', strtotime(($rowfetchinngPendingBooking['Birthdate']))) ?></td>
                                    <td><?= $rowfetchinngPendingBooking['CompleteAddress'] ?></td>
                                    <td>+63<?= $rowfetchinngPendingBooking['ContactNumber'] ?></td>
                                    <td>
                                        <?php
                                        if ($rowfetchinngPendingBooking['SampleOutcomeImg'] != "NA") {
                                            ?>
                                            <a href="../uploads/<?= $rowfetchinngPendingBooking['SampleOutcomeImg'] ?>"
                                                target="_blank">View Here !</a>

                                            <?php
                                        } else {
                                            echo "NA";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm rounded"
                                            value="<?= $rowfetchinngPendingBooking['RowNum'] ?>" id="showBookingInfo"><i
                                                class="fa fa-eye"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>No Data Found</td></tr>";
                        }
                        ?>


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
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-lg-flex d-md-grid justify-content-around">
                                <div id="user_profile" class="col-md-auto">

                                </div>
                                <div class="col py-lg-0 py-3">
                                    <h5>Client Information</h5>
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
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#showBookingInfo", function () {
        var value = $(this).val();

        $.get(`inputConfig.php?viewBookingInfo=${value}&Status=Pending`, function (data) {
            var res = jQuery.parseJSON(data);

            if (res.status == 200) {
                $("#viewBooking").modal("show");
                $("#user_profile").html("<img src='../uploads/" + res.data['ProfImg'] + "' class='img-fluid' width='250px' height='250px' />");
                $("#FullName").text(res.data['FName'] + " " + res.data['MName'] + " " + res.data['LName']);
                $("#Age").text(res.data['Age']);

                const dateString = res.data['Birthdate'];

                const date = new Date(dateString);

                const formattedDate = new Intl.DateTimeFormat('en-US', {
                    month: 'long',
                    day: '2-digit',
                    year: 'numeric'
                }).format(date);

                $("#Birthdate").text(formattedDate);
                $("#CivilStatus").text(res.data['CivilStatus']);
                $("#CompleteAddress").text(res.data['CompleteAddress']);
                $("#status").val(res.data['Status']);
            } else {
                alert(res.message)
            }
        })
            .fail(function (xhr, status, error) {
                console.log('Ajax request failed:', status, error);
            })
    })
</script>

<?php
include 'includes/footer.php';
?>