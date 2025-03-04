<?php
include 'includes/autoload.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["status"])) {


        $fetchinngPendingBooking = new fetch();
        $resfetchinngPendingBooking = $fetchinngPendingBooking->fetchinngPendingBooking("0", $_GET["status"]);

        if ($resfetchinngPendingBooking->rowCount() != 0) {
            while ($rowfetchinngPendingBooking = $resfetchinngPendingBooking->fetch()) {
                $TDate = date('m/d/Y', strtotime(($rowfetchinngPendingBooking['TDate'])));
?>
                <tr>
                    <td><?= $TDate ?></td>
                    <td><?= $rowfetchinngPendingBooking['FName'] ?>
                        <?= $rowfetchinngPendingBooking['MName'] ?>
                        <?= $rowfetchinngPendingBooking['LName'] ?>
                    </td>
                    <td><?= $rowfetchinngPendingBooking['Age'] ?></td>
                    <td><?= date('F d,Y', strtotime(($rowfetchinngPendingBooking['Birthdate']))) ?></td>
                    <td><?= $rowfetchinngPendingBooking['CompleteAddress'] ?></td>
                    <td>+63<?= $rowfetchinngPendingBooking['ContactNumber'] ?></td>
                    <td>
                        <?php
                        if ($rowfetchinngPendingBooking['SampleOutcomeImg'] != "NA") {
                        ?>
                            <a href="../uploads/<?= $rowfetchinngPendingBooking['SampleOutcomeImg'] ?>"
                                target="_blank">View Here !</a>
                        <?php
                        } else {
                            echo "NA";
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-success btn-sm rounded"
                            value="<?= $rowfetchinngPendingBooking['RowNum'] ?>" id="showBookingInfo"><i
                                class="fa fa-eye"></i></button>
                    </td>
                </tr>
<?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>No Data Found</td></tr>";
        }
    }
} else {
    ob_end_flush(header("Location: index.php"));
}

?>