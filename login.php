<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';


// Checking if client is already login
if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Client") {
    ob_end_flush(header("Location: index.php"));
}


?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-10 border shadow-sm">
            <div class="card-body login-card-body">
                <h2 class="login-box-msg text-center pb-5">Login</h2>
                <form id="login">
                    <input type="hidden" name="function" value="acc_login">
                    <div class="input-group mb-3">
                        <input type="text" name="Uname" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="Password" class="form-control" placeholder="Password"
                            id="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="showPass">
                                <label for="remember">
                                    Show Password
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <button type="submit" id="login_btn" class="btn btn-block"
                                style="background-color: #b310f5; color: #fff; !important">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>