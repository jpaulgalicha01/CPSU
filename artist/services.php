<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
unset($_SESSION['Active_Navigate']);
$_SESSION['title'] = "Services";
$_SESSION['Active_Navigate'] = "Services";

include 'includes/header.php';
include 'includes/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Services</h1>


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List of Services</h6>
            <button class="btn btn-success " data-toggle="modal" data-target="#addServices"><i
                    class="fa fa-plus" aria-hidden="true"></i> Add Services
            </button>

        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 150px;">Name Of Services</th>
                            <th style="width: 150px;">Sample Photo</th>
                            <th style="width: 100px;">Price</th>
                            <th>Policy</th>
                            <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetch_services = new fetch();
                        $res = $fetch_services->ServicesList();

                        if ($res->rowCount() != 0) {
                            while ($row = $res->fetch()) {
                        ?>
                                <tr>
                                    <td class="align-middle"><?= $row["ServicesName"] ?></td>
                                    <td class="align-middle">
                                        <p style="cursor: pointer; text-decoration: underline;" id="imageLink" data-value="<?= $row["ServicesName"] ?>">Click Here!</p>
                                    </td>
                                    <td class="align-middle"><?= $row["Price"] ?></td>
                                    <td><?= $row["ServicesPolicy"] ?></td>
                                    <td> <button class="btn btn-success btn-sm rounded" title="Edit" id="view_services"
                                            value="<?= $row['RowNum'] ?>"><i class="fa fa-edit"
                                                style="color: #ffffff;"></i></button></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No Data Found</td></tr>";
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-labelledby="addServicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServicesLabel">Add Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="function" value="creating_services">

                <div class="modal-body">
                    <div class="contienr-fluid">
                        <div class="row">
                            <div class='col-12 py-2'>
                                <div class="mb-2" id="uploadImg">
                                    <label>Images <small><i>(one or more images)</i></small></label>
                                    <input type="file" class="form-control" name="ProfileImages[]" multiple
                                        accept=".jpg,.jpeg, .png, .gif" required>
                                </div>
                                <div class='d-md-flex d-sm-grid justify-content-around'>
                                    <div class="py-2">
                                        <label for="ServicesName">Services Name</label>
                                        <input type="text" class="form-control" id="ServicesName" name="ServicesName"
                                            placeholder="ex. Parlor" required>
                                    </div>
                                    <div class="py-2">
                                        <label for="ServicePrice">Price</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name="ServicePrice"
                                                id="ServicePrice" value="0.00" required oninput="checkingletters(this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Policy</label>
                                    <textarea name="ServicesPolicy" id="ServicesPolicy" rows="5" class="form-control"
                                        placeholder="Describe your policy....">Within 3 days ahead of the schedule of booking.</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="creating_services" id="creating_services_btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Prof Images -->
<div class="modal fade" id="ProfImages" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="function" value="editProfImg">
                <input type="hidden" name="servicesName" id="servicesName">
                <div class="modal-body">
                    <div class="contienr-fluid">
                        <div class="row">
                            <div class='col-12 py-2'>
                                <div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Profile Image: </label>
                                        <input type="file" class="form-control" name="ProfileImages[]" multiple
                                            accept=".jpg,.jpeg, .png, .gif" required>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th style="width: 100px;">Action</th>
                                        </thead>
                                        <!-- <tbody id="ImgName">
                                        </tbody> -->

                                        <tbody id="ImgName">
                                            <!-- Images and delete buttons will be inserted here -->
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="editProfImg">Save & Exit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Edit Services Modal -->
<div class="modal fade" id="editServices" tabindex="-1" role="dialog" aria-labelledby="editServicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServicesLabel">Edit Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="function" value="edit_services">
                <input type="hidden" name="servicesID" id="servicesID">

                <div class="modal-body">
                    <div class="contienr-fluid">
                        <div class="row">
                            <div class='col-12 py-2'>
                                <div class='d-md-flex d-sm-grid justify-content-around'>
                                    <div class="py-2">
                                        <label for="editServicesName">Services Name</label>
                                        <input type="text" class="form-control" id="editServicesName" name="editServicesName"
                                            placeholder="ex. Parlor" required>
                                    </div>
                                    <div class="py-2">
                                        <label for="ServicePrice">Price</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" class="form-control" name="editServicePrice"
                                                id="editServicePrice" value="0.00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-group">
                                    <label for="editServicesPolicy">Policy</label>
                                    <textarea name="editServicesPolicy" id="editServicesPolicy" rows="5" class="form-control"
                                        placeholder="Describe your policy....">Within 3 days ahead of the schedule of booking.</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="edit_services">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).on("click", "#imageLink", function() {
        let value = $(this).data("value");

        $("#ProfImages").modal("show");
        $("#servicesName").val(value)
        let imageContainer = $("#ImgName");
        imageContainer.empty();

        $.get(`inputConfig.php?profImageProfile=${value}`, function(data) {
            var res = $.parseJSON(data);

            if (res.status === 200) {


                $.each(res.data, function(index, item) {
                    let imgElement = $("<img>")
                        .attr("src", `../uploads/${item.Images}`)
                        .attr("width", "50")
                        .attr("height", "50")

                    let deleteButton = $("<a>")
                        .attr("href", `inputConfig.php?deleteServicesImg=${item.RowNum}&servicesName=${value}&function=deleteServicesImg`)
                        .attr("onclick", "return confirm('Are you sure to delete this?')")
                        .attr("title", "Delete")
                        .html('<i class="fa fa-trash" style="color: #ffffff;"></i>')
                        .addClass("btn btn-danger btn-sm edit-btn")
                        .attr("value", item.RowNum)
                        .attr("type", "button")

                    let imgTd = $("<td>").append(imgElement);
                    let actionTd = $("<td>").append(deleteButton);

                    let newRow = $("<tr>").append(imgTd, actionTd);
                    imageContainer.append(newRow);
                });


            } else {
                console.log("No images found!");
            }

        }).fail(function(xhr, status, error) {
            console.log("Ajax request failed:", status, error);

        });


    });


    function checkingletters(input) {
        var input = document.getElementById("ServicePrice").value;
        if (/^\d*\.?\d*$/.test(input)) {
            document.getElementById("creating_services").disabled = false;
            inputField.classList.remove("border-danger")
        } else {
            console.log("Invalid input:", input);
            inputField.classList.add("border-danger")
            document.getElementById("creating_services").disabled = true;
        }

    }

    const inputField = document.getElementById('ServicePrice');
    inputField.addEventListener('blur', function() {
        let formattedValue = Number(inputField.value).toFixed(2);
        inputField.value = formattedValue;
    });


    $(document).on("click", "#view_services", function() {
        var value = $(this).val();

        $.get(`inputConfig.php?ServicesId=${value}`, function(data) {
                var res = jQuery.parseJSON(data);

                if (res.status == "200") {
                    $("#editServices").modal("show");
                    $("#servicesID").val(value);
                    $("#prevServicesName").val(res.data['ServicesName']);
                    $("#editServicesName").val(res.data['ServicesName']);
                    $("#editServicePrice").val(res.data['Price']);
                    $("#editServicesPolicy").val(res.data['ServicesPolicy']);
                } else if (data.status == "500") {
                    console.log(res.message)
                }
            })
            .fail(function(xhr, status, error) {
                console.log('Ajax request failed:', status, error);
            })

    });
</script>

<?php
include 'includes/footer.php';
?>