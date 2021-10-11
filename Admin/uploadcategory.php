 <?php
include_once 'header.php';
/// $classAdmin= new Admin($conn);
// include_once 'Admin/api/action.php';

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
          <div class="col-md-6">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Category</h3>
              </div>
             
             <!-- $data = $classAdmin->getSingleRecord('*', 'user', 'WHERE id = "'.$_GET['id'].'"'); -->
              <!-- //print_r($data['user_id']); -->
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo api_url('upload_category')?>" method="POST" class="formLogin">
                <div class="card-body">
                   
                    <input type="text" name="category" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter category" required="">
                 
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>


              </form>
              
            </div>
            <!-- /.card -->
            </div>


             <div class="col-md-6">
  <div class="card card-primary">
  <div class="card-header">
  <h3 class="card-title">Add Sub-Category</h3>
  </div>
  <form action="<?php echo api_url('upload_Scategory')?>" method="post" class="formLogin">
  <div class="card-body">
  <div class="form-group">
  <label for="category">Choose category:</label>
  <select id="cat-id" class="form-control" name="category_id" onchange="checkcategory()">
  <?php $get = $classAdmin->LoopRecord('*','category','');
  // print_r($get);
  foreach($get as $key => $value){
  extract($value);
  echo '<option value='.$id.'>'.$name.'</option>';

  }
  ?>
  </select>
  <!-- <input type="text" name="c-name" class="form-control" id="c-name" readonly="" placeholder="Category-Name"> -->
  <label for="exampleInputEmail1">SubCategory-Name</label>
  <!-- <select class="form-control" id="selectOption" name="sub_category">

  </select> -->
  <input type="text" name="sub_name" class="form-control" id="s-c-name" placeholder="SubCategory-Name" required="">

  </div>
  <div class="card-footer">
  <button type="submit" class="btn btn-primary">submit </button>
  </div>
  </div>
  </form>
  </div>
  </div>
      </div>
      <!-- /.container-fluid -->
    </section>   
    <section>
      <div class="row">
      <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <!-- //<th>Updated At</th> -->
                   
                  </tr>
                  </thead>
                  <tbody><h3>Category Table</h3>
                    <?php
                    // if(!empty($_GET['page'])){
                    //   $offset = $_GET['page'];
                    //   $limit = 10;
                    // }else{
                    //   $offset = 0;
                    //   $limit = 10;
                    // }
                    // $j=$offset+1;
                    $data = $classAdmin->LoopRecord('*','category','');
                    foreach ($data as $key => $value) {
                      extract($value);
                      echo '<tr>
                             
                              <td>'.$id.'</td>
                              <td>'.$name .'</td>
                              <td>'.$created_at.'</td>
                            
                      </tr>';
                     // $j++;
                    }

                    
                  ?>
                  </tbody>

 
                </table>
               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category Id</th>
                    <th>Name</th>
                    <th>Created At</th>
                   
                  </tr>
                  </thead>
                  <tbody><h3>Sub-Category Table</h3>
                    <?php
                    // if(!empty($_GET['page'])){
                    //   $offset = $_GET['page'];
                    //   $limit = 10;
                    // }else{
                    //   $offset = 0;
                    //   $limit = 10;
                    // }
                    // $j=$offset+1;
                    $data = $classAdmin->LoopRecord('*','sub_category','');
                    foreach ($data as $key => $value) {
                      extract($value);
                      echo '<tr>
                             
                              <td>'.$id.'</td>
                              <td>'.$category_id.'</td>
                              <td>'.$name.'</td>
                              <td>'.$created_at.'</td>
                            
                      </tr>';
                     // $j++;
                    }

                    
                  ?>
                  </tbody>

 
                </table>
               </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>

    </section>  

    <!-- /.content -->
  </div>

 <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function checkcategory(){
  $.post('<?php echo api_url('checkcategory');?>', {id: $('#cat-id').val()}, function (response) {
  if(response.success == 1){
    // $('#c-name').val(response.name)
      auxArr = [];
      $.each(response.data, function(i, option)
      { 
        // console.log(option.id);
          auxArr[i] = "<option value='" + option.id + "'>" + option.name + "</option>";
      });


 
</script>



  <?php
include_once 'footer.php';
  ?>
  <script>
    $(document).on('submit','.formLogin', function (event) {
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
    })
     .then(function() {
    window.location.reload();
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