</div>

</div>

<div class="modal fade" id="view_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View User Information</h5>
            </div>
            <form action="inputConfig.php" method="POST">
                <input type="hidden" name="function" value="delete_user_acc">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 text-center py-xl-0 py-lg-0 py-md-0 py-3">
                                <div id="user_profile"></div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <h5>Personal Information</h5>
                                <label for="FullName">Name: </label>
                                <p class="mb-1 view-user-modal" id="FullName"></p>
                                <label for="Age">Age: </label>
                                <p class="mb-1 view-user-modal" id="Age"></p>
                                <label for="Birthdate">Birth of Date: </label>
                                <p class="mb-1 view-user-modal" id="Birthdate"></p>
                                <label for="CivilStatus">Civil Status: </label>
                                <p class="mb-1 view-user-modal" id="CivilStatus"></p>
                                <label for="CompleteAddress">Complete Address: </label>
                                <p class="mb-1 view-user-modal" id="CompleteAddress"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete_user_acc">Delete User Account</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
if (isset($_SESSION['alert']) && $_SESSION['alert'] == "Show") {
?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
        Toast.fire({
            icon: "<?= $_SESSION['icon'] ?>",
            title: "<?= $_SESSION['title_alert'] ?>",
        });
    </script>
<?php
    unset($_SESSION['alert']);
    unset($_SESSION['icon']);
    unset($_SESSION['title_alert']);
}
?>

<script>
    let toggled = true;
    const toggledMenu = document.getElementById("wrapper");

    function handleToggled() {

        if (toggled) {
            toggledMenu.classList.add("toggled")
            toggled = false;
        } else {
            toggledMenu.classList.remove("toggled")
            toggled = true;
        }
    }
</script>

<script>
    $(document).on("click", "#view_user", function() {
        var value = $(this).val();
        // alert(value);
        $.ajax({
            type: "POST",
            url: "inputConfig.php",
            data: {
                value: value,
                function: "view_user"
            },
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    $("#view_user_modal").modal("show");
                    $("#user_id").val(res.data['UserID']);
                    $("#user_profile").html("<img src='../uploads/" + res.data['ProfImg'] + "' width='130px' height='150px' />");
                    $("#FullName").text(res.data['FName'] + " " + res.data['MName'] + " " + res.data['LName']);
                    $("#Age").text(res.data['Age']);

                    var accBirth = res.data['Birthdate'];
                    // Create a Date object from the date string
                    var dateObj = new Date(accBirth);
                    // Format the date as Mm dd yyyy
                    var options = {
                        month: 'longs',
                        day: '2-digit',
                        year: 'numeric'
                    };
                    var formattedDate = dateObj.toLocaleDateString('en-US', options);
                    // Update the text of #birthdate element with the formatted date
                    $("#Birthdate").text(formattedDate);

                    $("#CivilStatus").text(res.data['CivilStatus']);
                    $("#CompleteAddress").text(res.data['CompleteAddress']);
                }
            }
        })
    });
</script>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/ajax.js"></script>


</body>

</html>