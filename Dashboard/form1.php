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
</style>
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
             <!--  <li class="breadcrumb-item"><a href="index.php"></a></li>
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
                <h3 class="card-title">Account Detail</h3>
              </div>
              <?php
             $data = $classAdmin->SingleRecord(' * ', ' u_bank_detail', '  where user_id="'.$_SESSION['user_id'].'"');
             //print_r($data);
              ?>
              <!-- <!- /.card-header -->
              <!-- form start -->
              
              <?php
              if(empty($data['user_id'])){
              ?>
                <form action="<?php echo api_url('bankDetail')?>" method="POST" id="formLogin">
                <div class="card-body">
                   
                    <input type="hidden" name="id" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter user id">
                   <div class="mfor-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="bank_name"class="form-control" id="exampleInputEmail1" value="" placeholder="Enter bank Name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="number" name="account_no"class="form-control" id="exampleInputEmail1" value="" placeholder="Enter bank Account" >
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="ifsc_code" class="form-control" id="exampleInputEmail1" value=""  placeholder="IFSC Code" >
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="branch" class="form-control" id="exampleInputEmail1" value=""  placeholder=" Enter Branch">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="number" name="mobile" class="form-control" id="exampleInputEmail1" value=""placeholder="Enter mobile" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value=""  placeholder="Account Holder Name" >
                  </div>

                 <!--  <div class="form-group">
                    <label for="exampleInputEmail1">image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" value="<?php //echo $data['name']; ?>" placeholder="Enter Name">
                  </div> -->
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
              </form>
              <?php

            }else{
              ?>
            
              <form action="<?php echo api_url('bankDetail')?>" method="POST" id="formLogin">
                <div class="card-body">
                   
                    <input type="hidden" name="id" value="<?php echo $data['user_id']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter user id">
                   <div class="mfor-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="bank_name"class="form-control" id="exampleInputEmail1" value="<?php echo $data['bank_name']; ?>" placeholder="Enter bank Name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="number" name="account_no"class="form-control" id="exampleInputEmail1" value="<?php echo $data['account_no']; ?>" placeholder="Enter bank Account" >
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="ifsc_code" class="form-control" id="exampleInputEmail1" value="<?php echo $data['ifsc_code']; ?>"  placeholder="IFSC Code" >
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="branch" class="form-control" id="exampleInputEmail1" value="<?php echo $data['branch']; ?>"  placeholder=" Enter Branch">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="number" name="mobile" class="form-control" id="exampleInputEmail1" value="<?php echo $data['mobile']; ?>"placeholder="Enter mobile" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $data['name']; ?>"  placeholder="Account Holder Name" >
                  </div>

                 <!--  <div class="form-group">
                    <label for="exampleInputEmail1">image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" value="<?php //echo $data['name']; ?>" placeholder="Enter Name">
                  </div> -->
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
              </form>
             <?php
}
             ?>

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
 })//.then(function() {
//  window.location.href = response.url;
//  });
}else{
swal({
title: "Sorry!",
text: response.message,
icon: "error",
dangerMode: true,
});

}

}, 'json');

});

  </script>
