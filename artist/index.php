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

        <!-- Content Row -->
        <div class="row">
        
             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Booking</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

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
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Approved Booking</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                
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
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Pending Booking</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Declined Booking</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body py-5">
                        <div class="chart-area">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Accepting Booking</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            
                            <div class="calendar mb-4">
                                <div class="calendar-header">
                                    <span class="prev">&#10094;</span>
                                    <span id="monthYear"></span>
                                    <span class="next">&#10095;</span>
                                </div>
                                <div class="calendar-weekdays">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="calendar-days" id="calendarDays"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary d-none" id="btnSaveBookSched" onclick="savedReservedDates()">Save</button>
                        </div>
                    </div>

                </div>

                
            </div>

             <!-- Area Chart -->
            <div class="col-xl-7 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Booking Today</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable"  cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Time</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        for($x = 1; $x <= 20; $x++){
                                            ?>
                                                <tr>
                                                    <td>First Name</td>
                                                    <td>7:00 AM</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-success btn-sm" title="View" id="view_user" value="#>"><i class="fa fa-eye" style="color: #ffffff;"></i></button>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-5 col-lg-7">
            
            </div>

        </div>



    </div>
    <!-- /.container-fluid -->

<script>
    // Example dates and values
  var dates = [
    { x: new Date('2023-01-01').getTime(), y: 2500000 },
    { x: new Date('2023-02-01').getTime(), y: 3000000 },
    { x: new Date('2023-03-01').getTime(), y: 2800000 },
    { x: new Date('2023-04-01').getTime(), y: 3200000 },
    { x: new Date('2023-05-01').getTime(), y: 3100000 },
    { x: new Date('2023-06-01').getTime(), y: 3100000 },
    { x: new Date('2023-07-20').getTime(), y: 3100000 }
  ];

  var options = {
    series: [{
      name: 'XYZ MOTORS',
      data: dates
    }],
    chart: {
      type: 'area',
      stacked: false,
      height: 350,
      zoom: {
        type: 'x',
        enabled: true,
        autoScaleYaxis: true
      },
      toolbar: {
        autoSelected: 'zoom'
      }
    },
    dataLabels: {
      enabled: false
    },
    markers: {
      size: 0
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        inverseColors: false,
        opacityFrom: 0.5,
        opacityTo: 0,
        stops: [0, 90, 100]
      }
    },
    yaxis: {
      labels: {
        formatter: function (val) {
          return (val / 1000000).toFixed(0); // Convert large numbers to millions
        }
      },
      title: {
        text: 'Price'
      }
    },
    xaxis: {
      type: 'datetime',
    },
    tooltip: {
      shared: false,
      y: {
        formatter: function (val) {
          return (val / 1000000).toFixed(0); // Format tooltip values
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
</script>





<?php
include 'includes/footer.php';
?>