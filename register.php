<?php
include_once 'Admin/api/action.php';
$classAdmin=new Admin($conn);


?>


<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Registration Page</title>
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
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/ Firefox /
input[type=number] {
  -moz-appearance: textfield;
}
  /*input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none !important;
  margin: 0;
}*/
</style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?php echo api_url('Register')?>" method="post" id='formLogin'>
        <div class="input-group mb-3">
          <input type="text" name="sponser_id" class="form-control" placeholder="sponser_id" id="sponser_id" onchange="checkSponser()" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
                <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Sponser_Name" value="" id="sponser_name" readonly="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Full name" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email"  name="email" class="form-control" placeholder="Email" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" id="phone" class="form-control"  name="mobile" placeholder="Enter mobile no" required="">
          <div class="input-group-append">
            <div class="input-group-text">
                <i class="fa fa-mobile" aria-hidden="true"></i>
            </div>
          </div>
        </div>
       <!--  <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!-- <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label> -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="name" class="btn btn-primary">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     <!--  <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>
 -->
      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
 
  function checkSponser(){
        $.post('<?php echo api_url('checkSponser');?>', {id: $('#sponser_id').val()}, function (response) {
            if(response.success == 1){
                $('#sponser_name').val(response.name)
            }else{
              $('#sponser_name').val('Invaild sponser id')
            }
        }, 'json');
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
<script>
  $('#phone').keyup(function(e){
    var ph = this.value.replace(/\D/g,'').substring(0,10);
    // Backspace and Delete keys
    var deleteKey = (e.keyCode == 8 || e.keyCode == 46);
    // var len = ph.length;
    // if(len==0){
    //     ph=ph;
    // }else if(len<3){
    //     ph='('+ph;
    // }else if(len==3){
    //     ph = '('+ph + (deleteKey ? '' : ') ');
    // }else if(len<6){
    //     ph='('+ph.substring(0,3)+') '+ph.substring(3,6);
    // }else if(len==6){
    //     ph='('+ph.substring(0,3)+') '+ph.substring(3,6)+ (deleteKey ? '' : '-');
    // }else{
    //     ph='('+ph.substring(0,3)+') '+ph.substring(3,6)+'-'+ph.substring(6,10);
    // }
    this.value = ph;
});
</script>
 </body>
</html>
