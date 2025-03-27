<?php
include 'includes/autoload.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (isset($_GET["Categories"]) && isset($_GET["Status"])) {

        $fetchingInfo = new fetch();
        $resfetchingInfo = $fetchingInfo->fetchingInfo($_GET["Categories"], $_GET["Status"]);

        if ($resfetchingInfo->rowCount() !== 0) {
            while ($rowresfetchingInfo = $resfetchingInfo->fetch()) {
?>
                <div class="card my-3">
                    <div class="card-body">
                        <div class="d-lg-flex d-grid justify-content-between w-100">
                            <div>
                                <h5 class="card-title"><?= ($rowresfetchingInfo["Services"] === "16") ? $rowresfetchingInfo["OtherNameServices"] . " (" . $rowresfetchingInfo["ServiceCategory"] . ")" : $rowresfetchingInfo["ServiceCategory"] ?></h5>

                                <div class="d-lg-none d-block">
                                    <h5 class="card-title text-primary">₱ <?= $rowresfetchingInfo["Price"] ?></h5>
                                </div>

                                <h6 class="card-subtitle my-2 text-body-secondary">
                                    <span class="bg-<?php
                                                    if ($rowresfetchingInfo["Status"] == "Accept" || $rowresfetchingInfo["Status"] == "Done") {
                                                        echo "success";
                                                    } elseif ($rowresfetchingInfo["Status"] == "Declined" || $rowresfetchingInfo["Status"] == "Cancelled") {
                                                        echo "danger";
                                                    } else {
                                                        echo "secondary";
                                                    }
                                                    ?> p-1 rounded text-white"><?= $rowresfetchingInfo["Status"] ?></span>
                                </h6>
                                <p class="card-text">Booking Date: <span><?= date('F d, Y', strtotime($rowresfetchingInfo["Date"])) . " " . date("h:i A", strtotime($rowresfetchingInfo["Time"])) ?></span></p>
                                <a class="card-link" style="cursor: pointer; text-decoration: underline;" id="viewBtn" data-value="<?= $rowresfetchingInfo["RowNum"] ?>">View</a>
                            </div>
                            <div class="d-lg-block d-none">
                                <h5 class="card-title text-primary">₱ <?= $rowresfetchingInfo["Price"] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>no data found..</p>";
        }
        ?>
<?php
    }
} else {
    ob_end_flush(header("Location: index.php"));
}
?>