<?php
include "includes/autoload.inc.php";
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (isset($_GET["services_cat"])) {


        $fetch_services = new fetch();
        $res = $fetch_services->ServicesList(0, $_GET["services_cat"]);

        if ($res->rowCount() != 0) {
            while ($row = $res->fetch()) {


?>
                <div class="col-lg-4 col-md-6 col-12 py-2">
                    <div class="card shadow-sm" style="height: 450px;">
                        <div class="card-body d-grid justify-content-center align-self-center">
                            <div><img loading="lazy" src="uploads/<?= $row["ProfImg"] ?>" alt="product images" width="300" class="img-fluid mb-2">
                                <p class="mb-0"><?= ($row["ServiceCatNo"] === "16") ? $row["ServicesName"] . " (" . $row["ServicesNameCat"] . ")" : $row["ServicesNameCat"] ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-primary fs-4 m-0">₱ <?= $row["Price"] ?></p>
                                <button class="btn btn-primary btn-rounded p-1" style="border-radius: 10px;" id="servicesBtn" value="<?= $row["RowNum"] ?>">
                                    <i class="fa fa-bookmark" aria-hidden="true"></i> Reserve Now</button>
                            </div>
                        </div>
                    </div>
                </div>

<?php
            }
        } else {
            echo "no data found...";
        }
    }
} else {
    ob_end_flush(header("Location: index.php"));
}


?>