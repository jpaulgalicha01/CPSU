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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Of Services</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-2" data-toggle="modal" data-target="#addServices"><i class="fa fa-plus" aria-hidden="true"></i> Add Services</button>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Services Name</th>
                            <th width="150px">Price</th>
                            <th class="text-center" width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $fetch_services = new fetch();
                            $res = $fetch_services->ServicesList();

                            if($res->rowCount() != 0 ){
                               while($row = $res->fetch())
                               {
                                    ?>
                                        <tr>
                                            <td> <img src="../uploads/<?=$row['Images']?>" width="50px"/> </td>
                                            <td class="align-middle"><?=$row["ServicesName"]?></td>
                                            <td class="align-middle"><?=$row["Price"]?></td>
                                            <td class="align-middle text-center">
                                                <button class="btn btn-success btn-sm rounded" title="Edit" id="view_services" value="<?=$row['RowNum']?>"><i class="fa fa-edit" style="color: #ffffff;"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                               }
                            }else{
                                echo "<tr><td colspan='4' class='text-center'>No Data Found</td></tr>";
                            }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profile Images</h6>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-2" data-toggle="modal" data-target="#addProfileImages"><i class="fa fa-plus" aria-hidden="true"></i> Add Images</button>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th class="text-center" width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $fetch_prof_img = new fetch();
                            $res = $fetch_prof_img->fetchProfImg();

                            if($res->rowCount() != 0){
                                while($row = $res->fetch()){
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="../uploads/<?=$row['Images']?>" width="90px"/>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-danger btn-sm rounded" title="Delete"  value="<?=$row['RowNum']?>"><i class="fa fa-trash" style="color: #ffffff;"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo "<tr><td colspan='2' class='text-center'>No Data Found</td></tr>";
                            }

                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Description</h6>
        </div>
        <div class="card-body">
            <?php
                $checking_description = new fetch();
                $res = $checking_description->fetchDescription();

                if($res->rowCount() == 0)
                {
                    ?>
                        <button class="btn btn-success mb-2"  data-toggle="modal" data-target="#addDescription"><i class="fa fa-plus" aria-hidden="true"></i> Add Description</button>
                    <?php
                }
            ?>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-center" width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $fetch_description = new fetch();
                            $res = $fetch_description->fetchDescription();

                            if($res->rowCount() != 0){
                                while($row = $res->fetch()){
                                    ?>
                                        <tr>
                                            <td style="text-align:justify;">
                                                <?=$row['Description']?>
                                            </td>
                                            <td class="text-center align-middle">
                                            <button class="btn btn-success btn-sm rounded" title="Edit" id="view_description" value="<?=$row['RowNum']?>"><i class="fa fa-edit" style="color: #ffffff;"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo "<tr><td colspan='2' class='text-center'>No Data Found</td></tr>";
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<!-- Add Services -->
<div class="modal fade" id="addServices" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Services</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="function" value="creating_services">
        <input type="hidden" id="checkingModal" value="addServices">
        <div class="modal-body">
            <div class="contienr-fluid">
                <div class="row">
                    <div class='col-12 py-2'>
                        <div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Profile Image: </label>
                                <input type="file" class="form-control" id="ProfImg" name="Images" accept=".jpg,.jpeg, .png, .gif">
                            </div>
                        </div>
                        <div class='d-md-flex d-sm-grid justify-content-around'>
                            <div class="py-2">
                                <label for="ServicesName">Services Name</label>
                                <input type="text" class="form-control" id="ServicesName" name="ServicesName" placeholder="ex. Parlor" required>
                            </div>
                            <div class="py-2">
                            <label for="ServicePrice">Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" name="ServicePrice" id="ServicePrice"value="0.00" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="creating_services" id="creating_services">Save</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- Profile Images -->
<div class="modal fade" id="addProfileImages" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Profile Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="function" value="add_profile_images">
        <div class="modal-body">
            <div class="form-group">
                <label >Images <small><i>(one or more images)</i></small></label>
                <input type="file" class="form-control" name="ProfileImages[]" multiple accept=".jpg,.jpeg, .png, .gif">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="add_profile_images">Save</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- Description Images -->
<div class="modal fade" id="addDescription" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="inputConfig.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="function" value="addDescription">
        <div class="modal-body">
            <div class="form-group">
                <label >Description</label>
                <textarea name="description" id="description" rows="10" class="form-control" placeholder="Describe your services...."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="addDescription">Save</button>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
const inputField = document.getElementById('ServicePrice');

    inputField.addEventListener('input', function() {
    let input = inputField.value.trim(); 
    if (/^\d*\.?\d*$/.test(input)) {
        let formattedValue = Number(inputField.value).toFixed(2);
        inputField.value = formattedValue;
        document.getElementById("creating_services").disabled = false;
        inputField.classList.remove("border-danger")
    } 
    else {
        console.log("Invalid input:", input);
        inputField.classList.add("border-danger")
        document.getElementById("creating_services").disabled = true;
    }

});


$(document).on("click","#view_services",function(){
    var value = $(this).val();

    $.get(`inputConfig.php?ServicesId=${value}`,function(data){
        var res = jQuery.parseJSON(data);

        if(res.status == "200"){
            $("#checkingModal").val("editServices");
            $("#addServices").modal("show");
            $("#ServicesName").val(res.data['ServicesName']);
            $("#ServicePrice").val(res.data['Price']);
        }
        else if(data.status == "500"){
            console.log(res.message)
        }
    })
    .fail(function (xhr, status, error){
        console.log('Ajax request failed:', status, error);
    })

});


$(document).on("click","#view_description",function(){
    var value = $(this).val();
    alert(value);
    $.get(`inputConfig.php?DescriptionID=${value}`,function(data){
        var res = jQuery.parseJSON(data);

        if(res.status == "200"){
            $("#addDescription").modal("show");
            $("#description").val(res.data['Description']);
        }
        else if(data.status == "500"){
            console.log(res.message)
        }
    })
    .fail(function (xhr, status, error){
        console.log('Ajax request failed:', status, error);
    })

});


</script>

<?php
include 'includes/footer.php';
?>