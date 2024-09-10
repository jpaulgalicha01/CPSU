<?php

include 'includes/autoload.inc.php';
include 'includes/header.php';
include 'includes/navbar.php';
if (!isset($_COOKIE['UserID']) && !$_COOKIE['TypeUser']) {
  ob_end_flush(header("Location: index.php"));
}
?>
<div class="container">
    <div class="row py-5">
        <div class="col-6">
            <div class="card p-lg-3 p-2">
                <div class="card-title">Profile Information</div>
                <div class="card-body">
                    asd
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary" onclick="history.back()">Back</button>
                    <button class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>