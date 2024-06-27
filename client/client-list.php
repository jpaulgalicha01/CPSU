<?php
include 'includes/autoload.inc.php';

unset($_SESSION['title']);
unset($_SESSION['Active_Navigate']);
$_SESSION['title'] = "Pending Accounts - Clients";
$_SESSION['Active_Navigate'] = "Pending Accounts - Clients";

include 'includes/header.php';
include 'includes/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Accounts</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Of Accounts - Clients</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Complete Address</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $fetch_user_acc = new fetch();
                            $res = $fetch_user_acc->fetchClientArtist("Client");
                            if($res->rowCount() !=0 ){
                                while ($row = $res->fetch()) {
                                    ?>
                                        <tr>
                                            <th><?=$row['FName']?></th>
                                            <th><?=$row['MName']?></th>
                                            <th><?=$row['LName']?></th>
                                            <th><?=$row['Age']?></th>
                                            <th><?=$row['CompleteAddress']?></th>
                                            <th><?=$row['Status']?></th>
                                            <?php
                                                switch ($row['Status']) {
                                                    case 'Declined':
                                                        ?>
                                                            <td class="text-center">
                                                                <a href="inputConfig.php?delete_user=<?=$row['UserID']?>" onclick=" return alert('Are you sure want delete this?')" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash" style="color: #ffffff;"></i></a>
                                                            </td>
                                                        <?php
                                                        break;

                                                    case 'Accept':
                                                        ?>
                                                            <td class="text-center">
                                                                <button class="btn btn-success btn-sm" title="View" id="view_user" value="<?=$row['UserID']?>"><i class="fa fa-eye" style="color: #ffffff;"></i></button>
                                                            </td>
                                                        <?php
                                                        break;
                                                    
                                                    default:
                                                        ?>
                                                            <td class="text-center">
                                                                <div class="d-flex py-1">
                                                                     <a href="inputConfig.php?declined_user=<?=$row['UserID']?>" class="btn btn-danger btn-sm mx-1" title="Declined"><i class="fa fa-times" style="color: #ffffff;"></i></a>
                                                                <a href="inputConfig.php?accept_user=<?=$row['UserID']?>" class="btn btn-success btn-sm mx-1" title="Accept"><i class="fa fa-check" style="color: #ffffff;"></i></a>
                                                                <button class="btn btn-success btn-sm mx-1" title="View" id="view_user" value="<?=$row['UserID']?>"><i class="fa fa-eye" style="color: #ffffff;"></i></button>
                                                                </div>
                                                            </td>
                                                        <?php
                                                        break;
                                                }
                                            ?>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo "<tr><td colspan='7' class='text-center'>No Data Found</td></tr>";
                            }
                            ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include 'includes/footer.php';
?>