<?php
include 'includes/autoload.inc.php';
// Checking if client is already login

if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Client") {
    ob_end_flush(header("Location: index.php"));
}

include 'includes/header.php';
?>

<div id="loginWrapper" class="d-flex justify-content-center align-items-center py-lg-5"  
    style="
        margin: 0;
        background-size:cover;
        display: 'flex';
        height: 100vh;
        position: 'relative';
    "
>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-self-center">
            <div class="col-lg-8 col-11 card shadow-lg">
                <div class="row p-lg-5 p-4 d-flex align-items-center">
                    <div class="col-md-6">
                        <img src="./img/logo1.png" alt="logo" class="img-fluid">
                    </div>

                    <div class="col-md-6 col-12">
                         <p class="text-center fs-5 header-title">USER'S LOGIN</p>
                        <form class="pt-3" id="login">
                            <div class="vstack gap-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="Uname" class="form-control rounded" id="floatingInputUName" placeholder="Username" required>
                                    <label for="floatingInputUName"><i class="fa-solid fa-user"></i> Username</label>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <input type="password" name="Password" class="form-control rounded" id="floatingInputPass" placeholder="Password" required>
                                    <label for="floatingInputPass"><i class="fas fa-lock"></i> Password</label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="form-check pb-3">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="showCheckBoxPass"
                                            onclick="showPass()"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="showCheckBoxPass"
                                        >
                                            Show Password
                                        </label>
                                    </div>
                                   
                                </div>

                                <button type="submit" class="form-control btn btn-primary" id="login_btn"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                                <a href="register.php"class="text-center">Create Account</a>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
include 'includes/footer.php';
?>
