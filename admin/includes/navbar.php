<div class='d-flex' id="wrapper">
  <div id="sidebar-wrapper">
    <div class="sidebar-heading text-center fs-6 fw-bold text-uppercase text-white">
      Mukha Web App (ADMIN)
    </div>

    <div class="list-group list-group-flush my-1">
      <a href="./index.php" class="list-group-item list-group-item-action  bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Dashboard") ? "primary-text active" : "second-text fw-bold" ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
    </div>

    <hr />
    <span
      class="sidebar-heading  fw-light text-uppercase fw-bold text-white"
      style="padding-bottom: 0px; margin-bottom: 0px;">
      List of Accounts
    </span>


    <div class="list-group list-group-flush my-1">
      <a href="artist-list.php" class="list-group-item list-group-item-action bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Pending Accounts - Artist") ? "primary-text active" : "second-text fw-bold" ?>">
        <i class="fa fa-user me-2"></i>Artist
      </a>
    </div>

    <div class="list-group list-group-flush my-1">
      <a href="client-list.php" class="list-group-item list-group-item-action bg-transparent <?= (isset($_SESSION['Active_Navigate']) && $_SESSION['Active_Navigate'] == "Pending Accounts - Clients") ? "primary-text active" : "second-text fw-bold" ?>">
        <i class="fa fa-users me-2"></i>Client
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
    <div class="text-decoration-none d-flex align-items-center mt-auto px-2 py-2 mt-2">
      <img src="../uploads/default.png" alt="User Profile" class="rounded-circle me-2 bg-white" style="width: 30px; height: 30px; object-fit: cover;">
      <span class="fw-bold text-white" style="font-size: 0.9rem; color: #333;"><?= $UserName ?></span>
    </div>


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
    </nav>