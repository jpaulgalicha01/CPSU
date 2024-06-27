<?php
include 'includes/autoload.inc.php';
include 'includes/header.php';

// Checking if client is already login
if (isset($_COOKIE['UserID']) && $_COOKIE['TypeUser'] == "Client") {
    ob_end_flush(header("Location: index.php"));
}
?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-11 border shadow-sm">
            <div class="card-body login-card-body">
                <h2 class="login-box-msg text-center">Register Account</h2>
                <form id="create_acc" enctype="multipart/form-data" class="py-5">
                    <input type="hidden" name="function" value="create_acc">
                    <h5>Personal Information</h5>
                    <div class="row py-3 mb-5" style="row-gap:20px">
                        <div class="col-lg-4 col-12">
                            <label for="FName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="FName" required name="FName"
                                placeholder="ex. (Juan)">
                        </div>
                        <div class="col-lg-4 col-12">
                            <label for="MName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="MName" required name="MName"
                                placeholder="ex. (Dela)">
                        </div>
                        <div class="col-lg-4 col-12">
                            <label for="LName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="LName" required name="LName"
                                placeholder="ex. (Cruz)">
                        </div>

                        <div class="col-lg-4 col-12">
                            <label for="Age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="Age" required name="Age">
                        </div>

                        <div class="col-lg-4 col-12">
                            <label for="Birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control" id="Birthdate" required name="Birthdate">
                        </div>

                        <div class="col-lg-4 col-12">
                            <label for="CivilStatus" class="form-label">Civil Status</label>
                            <select class="form-control" required name="CivilStatus">
                                <option selected disabled>-- Please Select --</option>
                                <option>Single</option>
                                <option>Married</option>
                                <option>Divorce</option>
                                <option>Widowed</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="Brgy" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="Brgy" placeholder="ex. (Barangay 1)" required
                                name="Brgy">
                        </div>
                        <div class="col-lg-6 col-12">
                            <label for="City" class="form-label">City</label>
                            <input type="text" class="form-control" id="City" placeholder="ex. (Kabankalan City)"
                                required name="City">
                        </div>
                        <div class="col-12">
                            <label for="CompleteAddress" class="form-label">Complete Address</label>
                            <input type="text" class="form-control" id="CompleteAddress"
                                placeholder="ex. (Prk/Street, Barangay, City, Province)" required
                                name="CompleteAddress">
                        </div>

                        <div class="col-12">
                            <label for="ContactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="ContactNumber" placeholder="ex. (09xxxxxxxxx)"
                                required name="ContactNumber">
                        </div>

                    </div>

                    <h5>User Credentials</h5>
                    <div class="row py-3" style="row-gap:20px">
                        <div class="col-12">
                            <label for="UserName" class="form-label">Username</label>
                            <input type="text" class="form-control" id="UserName" placeholder="ex. (abc123)" required
                                name="UserName">
                        </div>
                        <div class="col-12">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" required name="Password">
                        </div>
                        <div class="col-12">
                            <label for="CPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="CPassword">
                            <span id="message"></span>
                        </div>
                        <div class="col-12">
                            <label for="ProfImg" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="ProfImg" name="ProfImg"
                                accept=".jpg,.jpeg, .png, .gif">
                        </div>
                        <div class="col-12">
                            <label for="TypeUser" class="form-label">Type Of User</label>
                            <select class="form-control" id="TypeUser" required name="TypeUser">
                                <option selected disabled>-- Please Select --</option>
                                <option>Artist</option>
                                <option>Client</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <button type="submit" id="create_acc_btn" class="btn btn-block"
                        style="background-color: #b310f5; color: #fff; !important">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#Password, #CPassword").on('keyup', function () {
        if ($("#Password").val() == "" && $("#CPassword").val() == "") {
            $("#message").html("").css('color', 'green');
        } else if ($("#Password").val() === $("#CPassword").val()) {
            $("#message").html("");
            document.getElementById('create_acc_btn').disabled = false;
        } else {
            $("#message").html("Password Not Match").css('color', 'red');
            document.getElementById('create_acc_btn').disabled = true;
        }
    });


    const inputField = document.getElementById('ContactNumber');
    inputField.addEventListener('input', function () {
        let input = inputField.value;
        input = input.slice(0, 11);
        if (input.length == 10) {
            if (/^\d*\.?\d*$/.test(input)) {
                let formattedValue = Number(inputField.value).toFixed(0);
                inputField.value = formattedValue;
                inputField.classList.remove("border-danger")
            }
        } else {
            console.log("Invalid input:", input);
            inputField.classList.add("border-danger")
        }

    });
</script>


<?php
include 'includes/footer.php';
?>