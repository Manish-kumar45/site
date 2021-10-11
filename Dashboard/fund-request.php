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
.clr{
  color: #3fb721;
  font-size: 20px; 
}
.rej{
  color:red;
  font-size: 20px;
}
.pend{
  color: yellow;
  font-size: 20px;
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
          <div class="col-md-7">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Fund Request</h3>
              </div>
           <!--  -->
              <!-- /.card-header -->
              <!-- form start -->
               <form action="<?php echo api_url('Fund_request')?>" method="POST" id="formLogin" enctype='multipart/form-data'>
                <div class="card-body">
                   
                    <!-- <input type="hidden" name="id" value="" class="form-control" id="exampleInputEmail1" >
                  -->
                  <div class="form-group">
                    <select name="method">
                      <option value="Paytm">Paytm</option>
                      <option value="Phone Pay">Phone Pay</option>
                      <option value="Google Pay">Google Pay</option>
                     
                    </select>
                    <!-- <input type="text" class="form-control" name="user_id" id="exampleInputEmail1" value="" placeholder="USER ID" required=""> -->
                  </div>
                   <div class="form-group">
                    <input type="number"  class="form-control" name="amount" value="" placeholder="AMOUNT" required="">
                  </div>
                   <div class="form-group">
                    <input type="file"  class="form-control"  value=""  name="image" required="">
                  </div>
                  <!--  <div class="form-group">
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
                  <button type="submit" class="btn btn-primary">Request</button>
                </div>
              </form>
           
            </div>
             </div>
        <!-- /.row -->
      </div>
    </section>
            <section>
      <div class="row">
      <div class="col-md-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered  table-responsiv">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>User Id</th>
                    <th>Amount Method</th>
                    <th>Amount </th>
                    <th>Image</th> 
                    <th>Action</th> 
                    <th>Created At</th> 


                   
                  </tr>
                  </thead>
                  <tbody><h3> Fund Request  </h3>
                    <?php
                    // if(!empty($_GET['page'])){
                    //   $offset = $_GET['page'];
                    //   $limit = 10;
                    // }else{
                    //   $offset = 0;
                    //   $limit = 10;
                    // }
                    // $j=$offset+1;
                    $data = $classAdmin->LoopRecord('*','fund_request',' where user_id="'.$_SESSION['user_id'].'"');
                    foreach ($data as $key => $value) {
                      extract($value);
                      echo '<tr>
                             
                              <td>'.$id.'</td>
                              <td>'.$user_id .'</td>
                              <td>'.$amount_method.'</td>
                              <td>'.$amount.'</td>
                              <td><img src="'.base_url('Dashboard/Image/'.$image).'" alt="image" class="img-fluid"></td>';
                               if($status == 0){
                                    echo' <td class="pend">PENDING</td>';
                                }
                             if($status == 1){
                                 echo' <td class="clr">APPROVED</td>';
                             }

                             if($status == 2){
                                echo' <td class="rej">REJECTED</td>';
                             }


                            echo   '<td>'.$created_at.'</td>
                              

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

            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
       
   <!--  </section>
  </div> -->
  <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script >
  
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
// window.location.href = response.url;
// });
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

</script> -->





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
              })
              .then(function() {
            window.location.reload();
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

  <?php
include_once 'footer.php';
  ?>