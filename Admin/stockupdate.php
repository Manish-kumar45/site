 <?php
include_once 'header.php';
// $classAdmin= new Admin($conn);
// include_once 'Admin/api/action.php';
$Stock_update=$classAdmin->SingleRecord('*', 'product', ' where id="'.$_GET['id'].'"');
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
    <!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
    </section>
 -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Stock Update</h3>
              </div>
           <!--  -->
              <!-- /.card-header -->
              <!-- form start -->
               <form action="<?php echo api_url('Stock_update')?>" method="POST" id="formLogin" >
                <div class="card-body">
                   
                    <input type="hidden" name="id" value="<?php echo $Stock_update['id']?>" class="form-control" id="exampleInputEmail1" >
                 
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="<?php echo $Stock_update['name']?>" readonly="">
                  </div>
                   <div class="form-group">
                    <input type="number"  class="form-control" id="exampleInputEmail1"name="stock" value="<?php echo $Stock_update['stock']?>" placeholder="STOCK" required="">
                  </div>
                   <!-- <div class="form-group">
                    <input type="number"  class="form-control" id="exampleInputEmail1" value="" placeholder="Pincode" name="pincode" required="">
                  </div>
                   <div class="form-group">
                  <div class="form-group">
                    <input type="text" name="address" class="form-control" required="" placeholder=" Address (Area and Street)">
                  </div>
                   <div class="form-group">
                    <input type="text" name="city" class="form-control"  required="" placeholder="City/District/Town">
                  </div>
                   <div class="form-group">
                    <input type="text" name="state" class="form-control"  required="" placeholder="State">
                  </div>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="" placeholder="Enter email">
                  </div>
                  
                </d -->
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
<script >
  
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


  <?php
include_once 'footer.php';
  ?>



  <!--  <script>
    $('#formLogin').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,

            success:function(data){
              swal({
              title: "Success!",
              text: data.message,
              icon: "success",
              });
            },
            error: function(data){
                swal({
              title: "Oop!",
              text: data.message,
              icon: "error",
              dangerMode:true,
              });
            }
        });
    }));


  </script>
 -->