<header class="p-3 mb-3 border-bottom sticky">
    <div class="container ">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-3">
            <img src="img/logo1.png" style="max-width:60px;" /></span>Mukha Web App</h5>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Inventory</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Customers</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li>
        </ul>

        <?php
            if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Client") {
                ?>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./uploads/<?=$Client_ProfImg?>" alt="mdo" width="32" height="32" class="rounded-circle">
                            <span class="position-absolute top-0  translate-middle badge rounded-pill bg-danger">
                                4
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="messages.php">Messages <span class="badge text-danger">4</span></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                <?php
            } else {
                ?>
                    <div class="gap-2">
                        <a href="login.php" class="btn btn-primary btn-md rounded p-1">Login</a>
                        <a href="register.php" class="btn  btn-md rounded p-1 btn-outline-secondary">Sign Up</a>
                    </div>
                <?php
            }

        ?>

      </div>
    </div>
</header>