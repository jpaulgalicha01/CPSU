<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
unset($_SESSION['Active_Navigate']);
$_SESSION['title'] = "Dashboard";
$_SESSION['Active_Navigate'] = "Dashboard";

include_once("includes/header.php");
include_once("includes/navbar.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid px-4 pt-5">

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
                <?php
                $fetchinngPendingBookingTotal = new fetch();
                $resfetchinngPendingBookingTotal = $fetchinngPendingBookingTotal->fetchinngPendingBooking("0", "All");
                echo $resfetchinngPendingBookingTotal->rowCount();
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
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Approved Booking</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $fetchinngPendingBooking = new fetch();
                $resfetchinngPendingBooking = $fetchinngPendingBooking->fetchinngPendingBooking("0", "Approved");
                echo $resfetchinngPendingBooking->rowCount();
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
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                Pending Booking</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $fetchinngPendingBooking = new fetch();
                $resfetchinngPendingBooking = $fetchinngPendingBooking->fetchinngPendingBooking("0", "Pending");
                echo $resfetchinngPendingBooking->rowCount();
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

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                Declined Booking</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $fetchinngPendingBooking = new fetch();
                $resfetchinngPendingBooking = $fetchinngPendingBooking->fetchinngPendingBooking("0", "Declined");
                echo $resfetchinngPendingBooking->rowCount();
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
  </div>

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
          <!-- <div class="d-flex justify-content-center">
                            <button class="btn btn-primary d-none" id="btnSaveBookSched" onclick="savedReservedDates()">Save</button>
                        </div> -->
        </div>

      </div>


    </div>

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
            <table class="table table-striped" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Time</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $fetchinngPendingBookingToday = new fetch();
                $resfetchinngPendingBookingToday = $fetchinngPendingBookingToday->fetchinngPendingBooking("0", "Accept");

                $bookings = [];
                $todayDate = date('Y-m-d');

                if ($resfetchinngPendingBookingToday->rowCount() != 0) {
                  while ($rowfetchinngPendingBookingToday = $resfetchinngPendingBookingToday->fetch()) {
                    $bookingDate = date('Y-m-d', strtotime($rowfetchinngPendingBookingToday['Date']));

                    if ($bookingDate === $todayDate) {
                      $bookings[] = $rowfetchinngPendingBookingToday;
                    }
                  }


                  usort($bookings, function ($a, $b) {
                    return strtotime($a['Time']) - strtotime($b['Time']);
                  });

                  foreach ($bookings as $rowfetchinngPendingBookingToday) {
                ?>
                    <tr>
                      <td><?= $rowfetchinngPendingBookingToday['FName'] ?>
                        <?= $rowfetchinngPendingBookingToday['MName'] ?>
                        <?= $rowfetchinngPendingBookingToday['LName'] ?>
                      </td>
                      <td><?= date("g:i a", strtotime($rowfetchinngPendingBookingToday["Time"])) ?></td>
                      <td class="text-center">
                        <button class="btn btn-success btn-sm rounded"
                          value="<?= $rowfetchinngPendingBookingToday['RowNum'] ?>" id="showBookingInfo">
                          <i class="fa fa-eye"></i>
                        </button>
                      </td>
                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <td colspan="3" class="text-center">No Booking Today</td>
                <?php
                }
                ?>




              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
<!-- /.container-fluid -->


<script>
  var data = [];

  $.get(`inputConfig.php`, {
    function: "Earnings Overview"
  }, function(response) {
    var res = jQuery.parseJSON(response);

    if (res.status == 200) {
      if (res.data.length === 0) {
        // Default data if no database data is found
        data = [{
            x: new Date("2024-01-01").getTime(),
            y: 0
          },
          {
            x: new Date("2024-02-01").getTime(),
            y: 0
          },
          {
            x: new Date("2024-03-01").getTime(),
            y: 0
          },
        ];
      } else {
        // Build data from the database
        $.each(res.data, function(index, value) {
          data.push({
            x: new Date(value.Month + "-01").getTime(),
            y: parseFloat(value.TotalPrice)
          });
        });
      }

      var options = {
        series: [{
          name: 'Income ₱',
          data: data,
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
            formatter: function(val) {
              return val.toFixed(2);
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
            formatter: function(val) {
              return "₱" + val.toFixed(2);
            }
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
    } else {
      console.error(res.message);
    }
  });
</script>


<script src="./js/index.js"></script>

<?php
include_once("includes/footer.php");
?>