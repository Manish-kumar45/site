<?php
include_once 'Admin/api/action.php';
$classAdmin= new Admin($conn);



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Log in|Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="login.php"><b>Log</b>in Page</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
     <!--  <p class="login-box-msg">Sign in to start your session</p> -->

      <form action="<?php echo api_url('Login')?>" method="post" id ='formLogin'>
        <div class="input-group mb-3">
          <input type="text" name="user_id" class="form-control" placeholder="User Id" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password"  name="password"  id="show"class="form-control" placeholder="Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fas fa-eye-slash" onclick="myFunction()" id="eye"></i>
            </div>
          </div>
        </div>
        <!-- // <input type="checkbox" onclick="myFunction()">Show Password -->
        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div>

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->
<!-- 
      <p class="mb-1">
        <a href="">I forgot my password</a>
      </p> -->
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>



 


function myFunction() {
var x = document.getElementById("show");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}
}



$(document).on('submit', '#formLogin', function (event) {
event.preventDefault();
var html = '';

var url = $(this).attr('action');
var formData = $(this).serialize();
$.post(url, formData, function (response) {

if(response.success == 1){
swal({
title: "Success!",
text: response.message,
icon: "success",
}).then(function() {
window.location.href = response.url;
});
}else{
swal({
title: "Oops!",
text: response.message,
icon: "error",
dangerMode: true,
});

}

}, 'json');

});
</script>

<script >
$(function(){

$('#eye').click(function(){

if($(this).hasClass('fa-eye-slash')){

$(this).removeClass('fa-eye-slash');

$(this).addClass('fa-eye');

$('#password').attr('type','text');

}else{

$(this).removeClass('fa-eye');

$(this).addClass('fa-eye-slash');

$('#password').attr('type','password');
}
});
});

</script>

</body>
</html>
