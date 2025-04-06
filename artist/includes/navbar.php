<div class='d-flex' id="wrapper">
  <div id="sidebar-wrapper">
    <div class="sidebar-heading text-center fs-4 fw-bold text-uppercase text-white">
      <img src="../img/logo1.png" alt="logo" style="height: 65px; width: 65px;">Mukha Web App
    </div>

    <div class="list-group list-group-flush my-1">
      <a href="./index.php" class="list-group-item list-group-item-action  bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Dashboard") ? "primary-text active" : "second-text fw-bold" ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    </div>

    <hr />
    <span
      class="sidebar-heading  fw-light text-uppercase fw-bold text-white"
      style="padding-bottom: 0px; margin-bottom: 0px;">
      Setup Services
    </span>

    <div class="list-group list-group-flush my-1">
      <a href="./services.php" class="list-group-item list-group-item-action  bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Services") ? "primary-text active" : "second-text fw-bold" ?>">
        <i class="fa-solid fa-gear me-2"></i>Services
      </a>
    </div>

    <hr />
    <span
      class="sidebar-heading  fw-light text-uppercase fw-bold text-white"
      style="padding-bottom: 0px; margin-bottom: 0px;">
      Booking
    </span>


    <div class="list-group list-group-flush my-1">
      <a href="pending-list-booking.php" class="list-group-item list-group-item-action bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Pending List Booking") ? "primary-text active" : "second-text fw-bold" ?>">
        <i class="fa fa-bookmark me-2"></i>Pending Booking
      </a>
    </div>

    <div class="list-group list-group-flush my-1">
      <a href="accept-list-booking.php" class="list-group-item list-group-item-action bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Accept List Booking") ? "primary-text active" : "second-text fw-bold" ?>">
        <i class="fa fa-check-circle me-2"></i>Accept Booking
      </a>
    </div>


    <div class="list-group list-group-flush my-1">
      <a href="declined-list-booking.php" class="list-group-item list-group-item-action bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Declined List Booking") ? "primary-text active" : "second-text fw-bold" ?>">
        <i class="fa fa-minus-circle me-2"></i>Declined Booking
      </a>
    </div>

    <div class="list-group list-group-flush my-1">
      <a href="list-booking.php" class="list-group-item list-group-item-action bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Status Booking") ? "primary-text active" : "second-text fw-bold" ?>">
        <i class="fas fa-calendar-check me-2"></i>Status Booking
      </a>
    </div>

    <hr />

    <div class="list-group list-group-flush my-1">
      <a href="logout.php"
        class='list-group-item list-group-item-action bg-transparent danger-text fw-bold'>
        <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
      </a>
    </div>

    <!-- Footer Section -->
    <hr>
    <a href="profile.php" class="text-decoration-none d-flex align-items-center mt-auto px-2 py-2 mt-2">
      <img src="../uploads/<?= $Client_ProfImg ?>" alt="User Profile" class="rounded-circle me-2 bg-white" style="width: 30px; height: 30px; object-fit: cover;">
      <span class="fw-bold text-white" style="font-size: 0.9rem; color: #333;"><?= $Client_UserName ?></span>
    </a>


  </div>

  <div id="page-content-wrapper" style="background-color: #FFFFFF;">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <i
          class="fas fa-align-left primary-text fs-4 me-3"
          id="menu-toggle"
          onclick="handleToggled()"></i>
        <h2 class="fs-2 m-0"><?= $_SESSION["title"] ?></h2>
      </div>
      <a class="nav-link -toggle" href="messages.php">
        <i class="fas fa-envelope fa-fw"></i>
        <span class="badge badge-danger badge-counter text-danger"><?= $messege ?></span>
      </a>


    </nav>