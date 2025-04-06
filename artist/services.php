<?php
include 'includes/autoload.inc.php';
unset($_SESSION['title']);
unset($_SESSION['Active_Navigate']);
$_SESSION['title'] = "Services";
$_SESSION['Active_Navigate'] = "Services";
include_once("includes/header.php");
include_once("includes/navbar.php");
?>


<!-- Begin Page Content -->
<div class="container-fluid px-4 mt-5">
  <!-- Page Heading -->


  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">List of Services</h6>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServices">
        <i class="fa fa-plus" aria-hidden="true"></i> Add Services
      </button>

    </div>
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped" width="100%" cellspacing="0">
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
            $res = $fetch_services->ServicesList(1, "");

            if ($res->rowCount() != 0) {
              while ($row = $res->fetch()) {
            ?>
                <tr>
                  <td><?= ($row["ServicesNameCat"] !== "Others") ? $row["ServicesNameCat"] : $row["ServicesName"] . '(' . $row["ServicesNameCat"] . ')' ?></td>
                  <td>
                    <p style="cursor: pointer; text-decoration: underline;" id="imageLink" data-value="<?= ($row["ServiceCatNo"] !== '16') ? $row["ServiceCatNo"] : $row["ServiceCatNo"] . '&' . $row["ServicesName"] ?>">Click Here!</p>
                  </td>
                  <td><?= $row["Price"] ?></td>
                  <td><?= $row["ServicesPolicy"] ?></td>
                  <td> <button class="btn btn-success btn-sm rounded" title="Edit" id="view_services"
                      value="<?= $row['RowNum'] ?>"><i class="fa fa-edit"
                        style="color: #ffffff;"></i></button></td>
                </tr>
              <?php
              }
            } else {
              ?>
              <td colspan="5" class="text-center">No data found.</td>
            <?php
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
<div class="modal fade" id="addServices" tabindex="-1" aria-labelledby="addServicesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addServicesLabel">Add Services</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    accept=".png, .jpg, .jpeg, .svg" required>
                </div>
                <div class='d-md-flex d-sm-grid justify-content-between '>
                  <div class="py-2">
                    <label for="ServiceCatNo">Services Category</label>
                    <select class="form-control" name="ServiceCatNo" id="ServiceCatNo" required>
                      <option value="" selected disabled>-- Please Select --</option>

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
                <input type="text" class="form-control my-2 d-none" id="others" name="ServicesName"
                  placeholder="Others">

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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="creating_services" id="creating_services_btn">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Prof Images -->
<div class="modal fade" id="ProfImages" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ProfImages" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Services</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="function" value="editProfImg">
        <input type="hidden" name="servicesCatNo" id="servicesCatNo">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="editProfImg">Save & Exit</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- Edit Services Modal -->
<div class="modal fade" id="editServices" tabindex="-1" aria-labelledby="addServicesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editServicesLabel">Edit Services</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="function" value="edit_services">
        <input type="hidden" name="servicesID" id="servicesID">
        <input type="hidden" id="prevServicesCatInput" name="prevServicesCatInput">
        <input type="hidden" id="prevServicesName" name="prevServicesName">
        <div class="modal-body">
          <div class="contienr-fluid">
            <div class="row">
              <div class='col-12 py-2'>

                <div class='d-md-flex d-sm-grid justify-content-between '>
                  <div class="py-2">
                    <label for="prevServicesCat">Services Category</label>
                    <select class="form-control" name="prevServicesCat" id="prevServicesCat" onchange="prevServicesCat(this)" required>
                      <option value="" selected disabled>-- Please Select --</option>

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
                  <div class="py-2">
                    <label for="editServicePrice">Price</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">₱</span>
                      </div>
                      <input type="text" class="form-control" name="editServicePrice"
                        id="editServicePrice" value="0.00" required oninput="checkingletters(this)">
                    </div>
                  </div>
                </div>

                <input type="text" class="form-control my-2 d-none" id="editServicesName" name="editServicesName"
                  placeholder="Others">

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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="edit_services">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php
include_once("includes/footer.php");
?>

<script>
  // Handle image modal and load images
  $(document).on("click", "#imageLink", function() {
    let rawValue = $(this).attr("data-value");
    let [serviceCatNo, serviceName] = rawValue.split("&").map(v => v.trim());

    console.log("Parsed values:", serviceCatNo, serviceName);

    $("#ProfImages").modal("show");
    $("#servicesCatNo").val(serviceCatNo);
    $("#servicesName").val(serviceName);

    const imageContainer = $("#ImgName");
    imageContainer.empty();

    $.get(`inputConfig.php?profImageProfile=${serviceCatNo}&ServiceName=${serviceName}`, function(data) {
      try {
        let res = JSON.parse(data);

        if (res.status === 200) {
          res.data.forEach(item => {
            let imgElement = $("<img>")
              .attr("src", `../uploads/${item.Images}`)
              .attr({
                width: 50,
                height: 50
              });

            let deleteButton = $("<a>")
              .attr({
                href: `inputConfig.php?deleteServicesImg=${item.RowNum}&servicesName=${serviceName}&function=deleteServicesImg`,
                onclick: "return confirm('Are you sure to delete this?')",
                title: "Delete",
                value: item.RowNum,
                type: "button"
              })
              .addClass("btn btn-danger btn-sm edit-btn")
              .html('<i class="fa fa-trash" style="color: #ffffff;"></i>');

            let newRow = $("<tr>").append($("<td>").append(imgElement), $("<td>").append(deleteButton));
            imageContainer.append(newRow);
          });
        } else {
          console.warn("No images found!");
        }
      } catch (err) {
        console.error("JSON parse error:", err);
      }
    }).fail((xhr, status, error) => {
      console.error("Ajax request failed:", status, error);
    });
  });

  // Price validation
  function checkingletters() {
    const inputField = document.getElementById("ServicePrice");
    const value = inputField.value;
    const isValid = /^\d*\.?\d*$/.test(value);

    inputField.classList.toggle("border-danger", !isValid);
    document.getElementById("creating_services").disabled = !isValid;

    if (!isValid) {
      console.warn("Invalid input:", value);
    }
  }

  // Format input price on blur
  const priceInput = document.getElementById("ServicePrice");
  if (priceInput) {
    priceInput.addEventListener("blur", function() {
      const num = parseFloat(priceInput.value);
      if (!isNaN(num)) {
        priceInput.value = num.toFixed(2);
      }
    });
  }

  // View/edit service data
  $(document).on("click", "#view_services", function() {
    const serviceId = $(this).val();

    $.get(`inputConfig.php?ServicesId=${serviceId}`, function(data) {
      try {
        const res = JSON.parse(data);
        if (res.status === 200) {
          $("#editServices").modal("show");
          $("#servicesID").val(serviceId);
          $("#prevServicesCat").val(res.data.ServiceCatNo);
          $("#prevServicesCatInput").val(res.data.ServiceCatNo);

          if (res.data.ServiceCatNo === "16") {
            $("#editServicesName").removeClass("d-none"); // Show input
          } else {
            $("#editServicesName").addClass("d-none"); // Hide input
          }


          $("#prevServicesName").val(res.data.ServicesName);
          $("#editServicesName").val(res.data.ServicesName);
          $("#editServicePrice").val(res.data.Price);
          $("#editServicesPolicy").val(res.data.ServicesPolicy);
        } else if (res.status === "500") {
          console.error("Error:", res.message);
        }
      } catch (err) {
        console.error("Parse error:", err);
      }
    }).fail((xhr, status, error) => {
      console.error("Ajax failed:", status, error);
    });
  });

  // Toggle "Other" input field based on category
  function toggleOtherField(selector, otherInputSelector) {
    $(document).on("change", selector, function() {
      const value = $(this).val();
      const inputOther = document.querySelector(otherInputSelector);

      if (value === "16") {
        inputOther.classList.remove("d-none");
        inputOther.setAttribute("required", "true");
      } else {
        inputOther.classList.add("d-none");
        inputOther.removeAttribute("required");
        inputOther.value = "";
      }
    });
  }

  // Apply the toggle function to both selects
  toggleOtherField("#ServiceCatNo", "#others");
  toggleOtherField("#prevServicesCat", "#editServicesName");
</script>