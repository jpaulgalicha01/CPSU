<?php
include_once ("includes/header.php");
?>
<div id="loginWrapper" class="d-flex justify-content-center align-items-center py-lg-5"  
    style="
        margin: 0;
        backgroundSize:cover;
        display: 'flex';
        justifyContent: 'center';
        alignItems: 'center';
        position: 'relative';
    "
>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-self-center">
            <div class="col-lg-8 col-11 card shadow-lg">
                <div class="row p-lg-5 p-4 d-flex align-items-center">
                    <div class=" col-12">
                         <p class="text-center fs-5 header-title">Register Account</p>
                        <form class="pt-3" id="createAcc" enctype="multipart/form-data">
                            <div class="vstack gap-3">
                            <div class="col-12 pb-4">
                                <label for="TypeUser" class="form-label">Type Of User</label>
                                <select class="form-control" id="TypeUser"  name="TypeUser" onchange="typeUser()">
                                    <option>Artist</option>
                                    <option>Client</option>
                                    <option>Company</option>
                                    <option>Organization</option>
                                </select>
                            </div>
                            <h5 id="titleUser">Personal Information</h5>
                            <!-- USER -->
                             <div id="artistClient">
                                <div class="row py-3 mb-3" style="row-gap:20px" id="">
                                    <div class="col-lg-4 col-12">
                                        <label for="FName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="FName"  name="FName"
                                            placeholder="ex. (Juan)">
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="MName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="MName"  name="MName"
                                            placeholder="ex. (Dela)">
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="LName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="LName"  name="LName"
                                            placeholder="ex. (Cruz)">
                                    </div>

                                    <div class="col-lg-4 col-12">
                                        <label for="Age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="Age"  name="Age">
                                    </div>

                                    <div class="col-lg-4 col-12">
                                        <label for="Birthdate" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control" id="Birthdate"  name="Birthdate">
                                    </div>

                                    <div class="col-lg-4 col-12">
                                        <label for="CivilStatus" class="form-label">Civil Status</label>
                                        <select class="form-control"  name="CivilStatus" id="CivilStatus">
                                            <option selected disabled>-- Please Select --</option>
                                            <option>Single</option>
                                            <option>Married</option>
                                            <option>Divorce</option>
                                            <option>Widowed</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label for="Brgy" class="form-label">Barangay</label>
                                        <input type="text" class="form-control" id="Brgy" placeholder="ex. (Barangay 1)" 
                                            name="Brgy">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="City" class="form-label">City</label>
                                        <input type="text" class="form-control" id="City" placeholder="ex. (Kabankalan City)"
                                             name="City">
                                    </div>
                                    <div class="col-12">
                                        <label for="CompleteAddress" class="form-label">Complete Address</label>
                                        <input type="text" class="form-control" id="CompleteAddress"
                                            placeholder="ex. (Prk/Street, Barangay, City, Province)" 
                                            name="CompleteAddress">
                                    </div>

                                    <div class="col-12">
                                        <label for="ContactNumber" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="ContactNumber" placeholder="ex. (09xxxxxxxxx)"
                                             name="ContactNumber">
                                    </div>

                                </div>
                             </div>
                            <!-- USER -->

                            <!-- Company Organiztion -->
                             <div id="companyOrg">
                                <div class="row py-3 mb-3" style="row-gap:20px" id="">
                                    <div class=" col-12">
                                        <label for="CName" class="form-label" id="nameLabel">Company Name</label>
                                        <input type="text" class="form-control" id="CName"  name="CName"
                                            placeholder="ex. (Juan)">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="CNBrgy" class="form-label">Barangay</label>
                                        <input type="text" class="form-control" id="CNBrgy" placeholder="ex. (Barangay 1)" 
                                            name="CNBrgy">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="CNCity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="CNCity" placeholder="ex. (Kabankalan City)"
                                             name="CNCity">
                                    </div>
                                    <div class="col-12">
                                        <label for="CNCompleteAddress" class="form-label">Complete Address</label>
                                        <input type="text" class="form-control" id="CNCompleteAddress"
                                            placeholder="ex. (Prk/Street, Barangay, City, Province)" 
                                            name="CNCompleteAddress">
                                    </div>

                                    <div class="col-12">
                                        <label for="CNContactNumber" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="CNContactNumber" placeholder="ex. (09xxxxxxxxx)"
                                             name="CNContactNumber" defa>
                                    </div>

                                </div>
                             </div>
                            <!-- Company Organiztion -->
                             

                            <h5>User Credentials</h5>
                            <div class="row py-2" style="row-gap:20px">
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
                                
                            </div>
                                <button type="submit" class="form-control btn btn-primary" id="create_acc_btn" >Login</button>
                                <a href="login.php"class="text-center">I'll Already Account </a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

   function typeUser(){
    const typeOfUser = document.getElementById("TypeUser").value;

    const titleUser = document.getElementById("titleUser");
    const nameLabel = document.getElementById("nameLabel");


    const artistClient = document.getElementById("artistClient");
    const companyOrg = document.getElementById("companyOrg");


    if(typeOfUser === "Artist" || typeOfUser === "Client" ){

        $("#CName").attr("required",false);
        $("#CNBrgy").attr("required",false);
        $("#CNCity").attr("required",false);
        $("#CNCompleteAddress").attr("required",false);
        $("#CNContactNumber").attr("required",false);



        $("#FName").attr("required",true);
        $("#MName").attr("required",true);
        $("#LName").attr("required",true);
        $("#Age").attr("required",true);
        $("#Birthdate").attr("required",true);
        $("#CivilStatus").attr("required",true);
        $("#Brgy").attr("required",true);
        $("#City").attr("required",true);
        $("#CompleteAddress").attr("required",true);
        $("#ContactNumber").attr("required",true);

        artistClient.setAttribute('style', 'display: block;');
        companyOrg.setAttribute('style', 'display: none;');
        titleUser.innerHTML  = "Personal Information";
    }else if(typeOfUser === "Company")
        {
            artistClient.setAttribute('style', 'display: none;');
            companyOrg.setAttribute('style', 'display: block;');
            titleUser.innerHTML  = "Company Information";
            nameLabel.innerHTML  = "Company Name";

            $("#CName").attr("required",true);
            $("#CNBrgy").attr("required",true);
            $("#CNCity").attr("required",true);
            $("#CNCompleteAddress").attr("required",true);
            $("#CNContactNumber").attr("required",true);
            $("#FName").attr("required",false);
            $("#MName").attr("required",false);
            $("#LName").attr("required",false);
            $("#Age").attr("required",false);
            $("#Birthdate").attr("required",false);
            $("#CivilStatus").attr("required",false);
            $("#Brgy").attr("required",false);
            $("#City").attr("required",false);
            $("#CompleteAddress").attr("required",false);
            $("#ContactNumber").attr("required",false);
            
    }else{
            
        artistClient.setAttribute('style', 'display: none;');
        companyOrg.setAttribute('style', 'display: block;');
        titleUser.innerHTML  = "Organization Information";
        nameLabel.innerHTML  = "Organization Name";

    }
}
$("#TypeUser").trigger("change");


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

    // Remove any non-numeric characters
    const nonNumericRegex = /[^0-9]/g;
    input = input.replace(nonNumericRegex, '');

    // Limit the length to 11 characters
    if (input.length > 11) {
        input = input.slice(0, 11);
    }

    // Update the input field value
    inputField.value = input;

    // Check for specific length
    if (input.length === 10) {
        inputField.classList.remove("border-danger");
    } else {
        inputField.classList.add("border-danger");
    }
});

const inputField1 = document.getElementById('CNContactNumber');
inputField1.addEventListener('input', function () {
    let input = inputField1.value;

    // Remove any non-numeric characters
    const nonNumericRegex = /[^0-9]/g;
    input = input.replace(nonNumericRegex, '');

    // Limit the length to 11 characters
    if (input.length > 11) {
        input = input.slice(0, 11);
    }

    // Update the input field value
    inputField1.value = input;

    // Check for specific length
    if (input.length === 10) {
        inputField1.classList.remove("border-danger");
    } else {
        inputField1.classList.add("border-danger");
    }
});

</script>

<?php
include_once ("includes/footer.php");
?>