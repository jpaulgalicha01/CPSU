


$(document).on("submit","#create_acc",function(e){
  e.preventDefault(e);
  var formData = new FormData(this);
  formData.append("create_acc", true);
  // alert(formData);
  $("#create_acc_btn").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'></span></div></div>");
  document.getElementById("create_acc_btn").disabled = true;
  $.ajax({
      method: "POST",
      url: "inputConfig.php",
      data: formData,
      processData: false,
      contentType:false,
      success:function(response){
          var res = jQuery.parseJSON(response);

          if(res.status == 200){
              document.getElementById("create_acc_btn").disabled = true;
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              });
              Toast.fire({
                icon: "success",
                title: "Creating account successfully",
                text: "Redirect to login page..",
              }).then(()=>{
                  window.location.href=res.redirect;
              });
          }
          else if(res.status == 302){
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: "error",
                title: res.message,
              });
                $("#create_acc_btn").text("Create Account");
              document.getElementById("create_acc_btn").disabled = false;
          }
      }
  })
});   



function showpass(){
  if(this.checked){
      // alert("check");
      document.getElementById('Password').setAttribute('type','text')
  }
  else{
          // alert("ubcheck");
          document.getElementById('Password').setAttribute('type','password')
      }
}
document.getElementById('showPass').addEventListener('click' , showpass);

$(document).on('submit','#login',function(e){
  e.preventDefault(e);
   var formData = new FormData(this);
  formData.append("acc_login", true);
  // alert(formData);
  $("#login_btn").html("<div class='text-center'><div class='spinner-border' role='status'><span class='visually-hidden'></span></div></div>");
  document.getElementById("login_btn").disabled = true;
  $.ajax({
      method: "POST",
      url: "inputConfig.php",
      data: formData,
      processData: false,
      contentType:false,
      success:function(response){
          var res = jQuery.parseJSON(response);

          if(res.status == 200){
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
            Toast.fire({
              icon: res.icon,
              title: "Log in Successfully",
            }).then(()=>{
                window.location.href=res.redirect;
            });
          }
          if(res.status == 404){
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: res.icon,
                title: res.message,
              })
              $("#login_btn").text("Login");
              document.getElementById("login_btn").disabled = false;
          }
          if(res.status == 302){
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              });
              Toast.fire({
                icon: res.icon,
                title: res.message,
              })
              $("#login_btn").text("Login");
              document.getElementById("login_btn").disabled = false;
          }
      }
  })
});