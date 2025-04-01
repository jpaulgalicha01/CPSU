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
                <form action="inputConfig.php" method="POST">
                    <input type="hidden" name="function" value="update_info">
                    <div class="card-body p-0 m-0">
                        <div class="container-fluid p-0 m-0 pb-5">
                            <div class="row pt-4">
                                <div class="col-lg-4 col-12">
                                    <label class="form-label" for="">First Name</label>
                                    <input type="text" name="FName" id="FName" class="form-control" value="<?= $Client_FName ?>">
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="form-label" for="">Middle Name</label>
                                    <input type="text" name="MName" id="MName" class="form-control" value="<?= $Client_MName ?>">
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="form-label" for="">Last Name</label>
                                    <input type="text" name="LName" id="LName" class="form-control" value="<?= $Client_LName ?>">
                                </div>
                                <div class="col-12 pt-4">
                                    <div class="form-group pt-2">
                                        <label for="" class="form-label">Username</label>
                                        <input type="text" name="UserName" id="UserName" class="form-control" value="<?= $Client_UserName ?>">
                                    </div>
                                    <div class="form-group pt-2">
                                        <label for="" class="form-label">Old Password</label>
                                        <input type="text" name="OPass" id="OPass" class="form-control">
                                    </div>
                                    <div class="form-group pt-2">
                                        <label for="" class="form-label">New Password</label>
                                        <input type="text" name="NPAss" id="NPAss" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-2">
                        <button class="btn btn-secondary" onclick="history.back()">Back</button>
                        <button class="btn btn-success" type="submit" name="update_info">Update</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card  shadow-sm p-4">
                <div class="card-title">
                    <h1 class="h4 mb-0 text-gray-800">Profile Information</h1>
                </div>
                <div class="card-body p-0 m-0">
                    <div class="d-flex justify-content-center ">
                        <div class="profile-container ">
                            <img src="./uploads/<?= $Client_ProfImg ?>" alt="profile img" class="profile-img">
                        </div>



                    </div>

                    <div class="py-2">
                        <form action="inputConfig.php" method="POST" enctype="multipart/form-data" id="change_prof" class="d-none">
                            <input type="hidden" name="function" value="change_profile">
                            <div class="mb-3">
                                <input class="form-control" type="file" name="change_img" accept=".png, .jpg, .jpeg, .svg">
                            </div>
                            <button type="submit" class="btn btn-primary form-control btn-sm" name="change_profile">Update Profile</button>
                        </form>
                        <div>
                            <button class="btn btn-primary form-control btn-sm" id="change_prof_btn">Change Profile</button>
                        </div>
                    </div>

                    <div class="d-grid gap-1">
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Name:</h1>
                            <p><?= $Client_FName . " " . $Client_MName . " " . $Client_LName ?></p>
                        </div>
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Address:</h1>
                            <p><?= $Client_CompleteAddress ?></p>
                        </div>
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Phone Number:</h1>
                            <p>+63 <?= $Client_ContactNumber ?></p>
                        </div>
                        <div>
                            <h1 class="h5 mb-0 text-gray-900">Username :</h1>
                            <p><?= $Client_UserName ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#change_prof_btn', function() {
        $("#change_prof_btn").addClass("d-none");
        $("#change_prof").removeClass("d-none");
    });
</script>
<?php
include 'includes/footer.php';
?>