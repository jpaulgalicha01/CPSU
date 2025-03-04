<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <img src="../img/logo1.png" alt="logo" style="height: 60px; width: 60px;">
        <div class="sidebar-brand-text pl-2"> mukha web app</div>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li
        class="nav-item  <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Dashboard") ? "active" : "" ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Setup Services
    </div>

    <li
        class="nav-item <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Services") ? "active" : "" ?>">
        <a class="nav-link" href="services.php">
            <i class="fa fa-cogs"></i>
            <span>Services</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Booking
    </div>

    <li
        class="nav-item <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Pending List Booking") ? "active" : "" ?>">
        <a class="nav-link " href="pending-list-booking.php">
            <i class="fa fa-bookmark"></i>
            <span>Pending Booking</span></a>
    </li>
    <li
        class="nav-item <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Accept List Booking") ? "active" : "" ?>">
        <a class="nav-link" href="accept-list-booking.php">
            <i class="fa fa-check-circle"></i>
            <span>Accept Booking</span></a>
    </li>
    <li
        class="nav-item <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Declined List Booking") ? "active" : "" ?>">
        <a class="nav-link" href="declined-list-booking.php">
            <i class="fa fa-minus-circle"></i>
            <span>Declined Booking</span></a>
    </li>

    <li
        class="nav-item <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "List Booking") ? "active" : "" ?>">
        <a class="nav-link" href="list-booking.php">
            <i class="fas fa-calendar-check"></i>
            <span>List Booking</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">1</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="../uploads/default.png" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>

                        <a class="dropdown-item text-center small text-gray-500" href="messages.php">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow d-flex">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small text-center">
                            <div><?= $UserName ?></div>
                            <small style="font-size:11">Artist</small>
                        </span>
                        <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->