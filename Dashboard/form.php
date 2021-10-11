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
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
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
                <h3 class="card-title">Edit Profile</h3>
              </div>
              <?php
              $data = $classAdmin->SingleRecord('*', 'users', ' WHERE user_id = "'.$_SESSION['user_id'].'"');
             // print_r($data);
              ?>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo api_url('edit_Detail')?>" method="POST" id="formLogin" enctype='multipart/form-data'>
                <div class="card-body">
                   
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter user id">
                 
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Id</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $data['user_id']; ?>" readonly="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text"  class="form-control" id="exampleInputEmail1" value="<?php echo $data['name']; ?>" placeholder="Enter Name" readonly="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="e_mail" class="form-control" id="exampleInputEmail1" value="<?php echo $data['email']; ?>" placeholder="Enter email">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Mobile</label>
                    <input type="number"  class="form-control" id="exampleInputEmail1" value="<?php echo $data['mob_no']; ?>" placeholder="Enter mobile" readonly="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">image</label>
                    <input type="file" name="file" class="form-control" id="file" required="">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Upload</button>
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
                console.log("error");
                console.log(data);
            }
        });
    }));


  </script>
