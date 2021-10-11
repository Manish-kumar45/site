 <?php
include_once 'header.php';
// $classAdmin= new Admin($conn);
// include_once 'Admin/api/action.php';

?>
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
</style>>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!--  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"></li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Detail Update</h3>
              </div>
              <?php
              $data = $classAdmin->SingleRecord('*', 'users', ' WHERE id = "'.$_GET['id'].'"');
             // print_r($data);
              ?>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo api_url('Update')?>" method="POST" id="formLogin">
                <div class="card-body">
                   
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter user id">
                 
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Id</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $data['user_id']; ?>" readonly="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $data['name']; ?>" placeholder="Enter Name">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="e_mail" class="form-control" id="exampleInputEmail1" value="<?php echo $data['email']; ?>" placeholder="Enter email">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Mobile</label>
                    <input type="number" name="mobile" class="form-control" id="exampleInputEmail1" value="<?php echo $data['mob_no']; ?>" placeholder="Enter mobile">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <?php
include_once 'footer.php';
  ?>
   <script>
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
