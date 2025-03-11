<header class="navbar navbar-expand-lg sticky" id="sticky">
    <div class="container-fluid">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
            <img src="img/logo1.png" style="max-width:50px;" /></span>Mukha Web App</h5>
        </a>
        <div class="col-12 col-lg-auto me-lg-auto mb-2 mb-md-0 d-lg-block d-none">
            <ul class="d-flex nav ">
                <li><a href="services.php#serv_list=all" class="nav-link px-2 link-body-emphasis ms-5">Services</a></li>
            </ul>
        </div>
        <?php
        if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Client") {
        ?>
            <div class="dropdown">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="./uploads/<?= $Client_ProfImg ?>" alt="mdo" width="32" height="32" class="rounded-circle" style="z-index:2">
                    <span class="position-absolute top-0  translate-middle badge rounded-pill bg-danger">
                        <?= $messege ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small">
                    <li><a class="dropdown-item" href="#">Booked List</a></li>
                    <li><a class="dropdown-item d-lg-none d-block" href="services.php#serv_list=all">Services</a></li>
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="messages.php">Messages <span class="badge text-danger"><?= $messege ?></span></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-power-off"></i> Sign out</a></li>
                </ul>
            </div>
        <?php
        } else {
        ?>
            <div class="gap-2">
                <a href="login.php" class="btn btn-primary btn-md rounded p-1"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                <a href="register.php" class="btn  btn-md rounded p-1 btn-outline-secondary"><i class="fa-solid fa-id-card"></i> Create Account</a>
            </div>
        <?php
        }
        ?>

    </div>
</header>