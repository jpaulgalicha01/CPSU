<?php

include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';
if (!isset($_COOKIE['UserID']) && !$_COOKIE['TypeUser']) {
  ob_end_flush(header("Location: index.php"));
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-12 pb-lg-0 pb-5">
            <div class="card p-lg-3 p-2 shadow-sm">
                <div class="card-title">
                    <h1 class="h4 mb-0 text-gray-800">Update Information</h1>    
                </div>
                <div class="card-body p-0 m-0">
                    <div class="container-fluid p-0 m-0 pb-5">
                        <div class="row pt-4">
                            <div class="col-lg-4 col-12">
                                <label for="form-label">First Name</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="form-label">Middle Name</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="col-lg-4 col-12">
                                <label for="form-label">Last Name</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="col-12 pt-4">
                                <div class="form-group pt-2">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="" class="form-label">Old Password</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="form-group pt-2">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="Form-group">
                                    <label for="ProfImg" class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" id="ProfImg" name="ProfImg"
                                        accept=".jpg,.jpeg, .png, .gif">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary" onclick="history.back()">Back</button>
                    <button class="btn btn-success">Update</button>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card  shadow-sm p-4">
            <div class="card-title">
                <h1 class="h4 mb-0 text-gray-800">Profile Information</h1>    
            </div>
                <div class="card-body p-0 m-0">
                    <div class="d-flex justify-content-center mb-4">
                        <div class="profile-container">
                            <img src="./uploads/DSC_0350.JPG" alt="profile img"  class="profile-img">
                        </div>
                    </div>

                    <div class="d-grid gap-1">
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Name:</h1>    
                            <p>asd</p>
                        </div>
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Address:</h1>    
                            <p>asd</p>
                        </div>
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Phone Number:</h1>    
                            <p>asd</p>
                        </div>
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Username :</h1>    
                            <p>asd</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>