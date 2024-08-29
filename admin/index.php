<?php

include 'includes/autoload.inc.php';

unset($_SESSION['title']);
unset($_SESSION['Active_Navigate']);
$_SESSION['title'] = "Dashboard";
$_SESSION['Active_Navigate'] = "Dashboard";

include 'includes/header.php';
include 'includes/navbar.php';
?>



    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>    
        </div>

        <p class="h4 mb-0 text-gray-800 mb-2">Artist</p>
        <!-- Content Row -->
        <div class="row">
        
             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        $count_user_total_artist = new fetch();
                                        $count_user_total_artist->countUser("Artist","All");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Approved Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                        $count_user_total_artist = new fetch();
                                        $count_user_total_artist->countUser("Artist","Accept");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Pending Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                        $count_user_total_artist = new fetch();
                                        $count_user_total_artist->countUser("Artist","Pending");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Pending Requests Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Declined Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                        $count_user_total_artist = new fetch();
                                        $count_user_total_artist->countUser("Artist","Declined");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


            
        </div>


        <p class="h4 mb-0 text-gray-800 mb-2">Client</p>
        <!-- Content Row -->
        <div class="row">

             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                        $count_user_total_client = new fetch();
                                        $count_user_total_client->countUser("Client","All");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Approved Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                        $count_user_total_client = new fetch();
                                        $count_user_total_client->countUser("Client","Accept");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Pending Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                        $count_user_total_client = new fetch();
                                        $count_user_total_client->countUser("Client","Pending");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Pending Requests Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Declined Accounts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                        $count_user_total_client = new fetch();
                                        $count_user_total_client->countUser("Artist","Declined");
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
    <!-- /.container-fluid -->


<?php
include 'includes/footer.php';
?>