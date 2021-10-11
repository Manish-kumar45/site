 <?php
include_once 'header.php';
 if(!empty($_GET)){
$data2=$classAdmin->SingleRecord('* ',' product ', ' where id ="'.$_GET['product_id'].'" ' );
}
if(empty($data2)){
$data3=$classAdmin->LoopRecord(' sum(total_price) as total  ','  add_cart ', '  where user_id="'.$_SESSION['user_id'].'"' );
// print_r($data3) ;
}
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
                <h3 class="card-title">Delivery Address</h3>
              </div>
              <?php
              $data = $classAdmin->SingleRecord('*', 'u_address', ' WHERE user_id = "'.$_SESSION['user_id'].'"');
             // print_r($data);
              if(empty($data)){
              ?>
              <!-- /.card-header -->
              <!-- form start -->
               <form action="<?php echo api_url('Update_address')?>" method="POST" id="formLogin">
                <div class="card-body">
                   
                    <input type="hidden" name="user_id" value="" class="form-control" id="exampleInputEmail1" >
                 
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="" required="" placeholder="Name">
                  </div>
                   <div class="form-group">
                    <input type="number"  class="form-control" id="exampleInputEmail1"name="mobile" value="" placeholder="Mobile NO" required="">
                  </div>
                   <div class="form-group">
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
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="" required="" placeholder="Enter email">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            <?php if(!empty($data)){?>
                   <form action="<?php echo api_url('shopping')?>" method="post" id="proceed">
              <input type="hidden" name="price" value="<?php echo $data2['price'] ?>">
                  <button type="submit" class="btn btn-warning">Proceed</button>
              
                  
              </form>
            <?php
          }
             }
            else{
             ?>


              <form action="<?php echo api_url('Update_address')?>" method="POST" id="formLogin" >
                <div class="card-body">
                   
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" class="form-control" id="exampleInputEmail1" placeholder="Name">
                 
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="<?php echo $data['name']; ?>" placeorder="Name">
                  </div>
                   <div class="form-group">
                    <input type="number"  class="form-control" id="exampleInputEmail1"name="mobile" value="<?php echo $data['mobile']; ?>" placeholder="Mobile NO" required="">
                  </div>
                   <div class="form-group">
                    <input type="number"  class="form-control" id="exampleInputEmail1" value="<?php echo $data['pincode']; ?>" placeholder="Pincode" name="pincode" required="">
                  </div>
                   <div class="form-group">
                  <div class="form-group">
                    <input type="text" name="address" class="form-control" value="<?php echo $data['address']; ?>"required="" placeholder=" Address (Area and Street)">
                  </div>
                   <div class="form-group">
                    <input type="text" name="city" class="form-control" value="<?php echo $data['city']; ?>"  required="" placeholder="City/District/Town">
                  </div>
                   <div class="form-group">
                    <input type="text" name="state" class="form-control" value="<?php echo $data['state']; ?>" required="" placeholder="State">
                  </div>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $data['email']; ?>" placeholder="Enter email">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                  <button type="submit" class="btn btn-primary">Save</button>
                  
            </form>
<?php if(!empty($data)){?>
            <form action="<?php echo api_url('shopping')?>" method="post" id="proceed">
              <input type="hidden" name="price" value="<?php echo $data2['price'] ?>">
                  <button type="submit" class="btn btn-warning">Proceed</button>
              
              </form>
            <?php 
        }   
          } ?>
            </div>
            <!-- /.card -->
            </div>
            <?php 
            if(!empty($data2)){
             ?>
            
            <div class="col-md-3 card offset-md-1 price-box ">

          
          <h5 class="price">PRICE DETAILS</h5>
          <h6 class=" total-price2 span">Price <span><?php echo $data2['price'];?></span></h6>
          <h6 class="total-price2 price">Delivery Charges    <span> Free</span></h6>
          <h6 class="total-price2 price">Total Amount<span><?php echo $data2['price'];?></span></h6>
          
         </div>
         <?php 
       }

       if(!empty($data3)){
        // print_r($data3);
          ?>
            <div class="col-md-3 card offset-md-1 price-box ">

          
          <h5 class="price">PRICE DETAILS</h5>
          <h6 class=" total-price2 span">Price<span><?php echo $data3[0]['total'];?></span></h6>
          <h6 class="total-price2 price">Delivery Charges<span> Free</span></h6>
          <h6 class="total-price2 price">Total Amount<span><?php echo $data3[0]['total'];?></span></h6>
          
         </div>
       <?php } ?>
          <!--/.col (left) -->
          <!-- right column -->
         <!--  <div class="col-md-6">

          </div>
          --> <!--/.col (right) -->
        </div>
        <!-- /.row -->
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
window.location.reload();
});
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
 <script>
  $(document).on('submit', '#proceed', function (event) {
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
window.location.reload();
});
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


  <?php
include_once 'footer.php';
  ?>
<!--  <script>
    $('#formLogin').on('',(function(e) {
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
              text: data.s,
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
 -->