 <?php
include_once 'header.php';
// $classAdmin= new Admin($conn);
// include_once 'Admin/api/action.php';

?>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"></li>
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
                <h3 class="card-title">Add Product</small></h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo api_url('upload_product')?>" method="POST" id="formLogin">
                <div class="card-body">
                   
                    <input type="hidden" name="id" value="" class="form-control" id="exampleInputEmail1" placeholder="Enter user id">

                     <label for="category">Choose category:</label>
                  <select id="cat-id" class="form-control" name="category_id" onchange="checkcategory()">
                  <?php $get = $classAdmin->LoopRecord('*','category','');
                  foreach($get as $key => $value){
                  extract($value);
                  echo '<option value='.$id.'>'.$name.'</option>';

                  }
                  ?>
                  </select>
                 
                  <div class="form-group">
                      <label for="exampleInputEmail1">SubCategory-Name</label>
                  <select class="form-control"  id="selectOption" name="sub_category_id">
                      
                 </select>

                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="" placeholder="Enter Name" required="">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" value="" placeholder="Enter email">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" name="price" class="form-control" id="exampleInputEmail1" value="" placeholder="Enter Price" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">GST</label>
                    <input type="text" name="gst" class="form-control" id="exampleInputEmail1" value="" placeholder="GST" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CGST</label>
                    <input type="text" name="cgst" class="form-control" id="exampleInputEmail1" value="" placeholder="CGST" required="">
                  </div>
              <div class="form-group">
                    <label for="exampleInputEmail1">Stock</label>
                    <input type="number" name="stock" class="form-control" id="exampleInputEmail1" value="" placeholder="Stock" required="">
                  </div>    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!-- <div class="col-md-6"> -->

          </div>
          <!--/.col (right) -->
           <div class="col-12">
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
                    <th>Sub Category Id</th>
                    <th>Product Name</th>
                    <th>File</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>GST</th>
                    <th>CGST</th>
                    <th>Stock</th>
                    <th>Created At</th>
                   
                  </tr>
                  </thead>
                  <tbody><h3>Product Table</h3>
                    <?php
                    // if(!empty($_GET['page'])){
                    //   $offset = $_GET['page'];
                    //   $limit = 10;
                    // }else{
                    //   $offset = 0;
                    //   $limit = 10;
                    // }
                     $j=1;
                    $data = $classAdmin->LoopRecord('*','product','');
                    if(!empty($data)){
                    foreach ($data as $key => $value) {
                      extract($value);
                      echo '<tr>
                             
                              <td>'.$j.'</td>
                              <td>'.$category_id.'</td>
                              <td>'.$sub_category_id.'</td>
                              <td>'.$name.'</td>
                              <td>'.$image.'</td>
                              <td><img src="'.base_url('Dashboard/Image/'.$image).'" style="height:100px;  width:100px;"></td>
                              <td>'.$price.'</td>
                              <td>'.$gst.'</td>
                              <td>'.$cgst.'</td>
                              <td>'.$stock.'</td>
                              <td>'.$created_at.'</td>
                              <td><a href="stockupdate.php?id='.$id.'" class="btn btn-success">Stock Update</a></td>
                            
                      </tr>';
                     $j++;
                    }
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/jquery/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>







<script>





checkcategory()
function checkcategory(){
  $.post('<?php echo api_url('checkcategory');?>', {id: $('#cat-id').val()}, function (response) {
  if(response.success == 1){
    // $('#c-name').val(response.name)
      auxArr = [];
        $('#selectOption').find('option').remove().end()
      $.each(response.data, function(i, option)
      { 
        // console.log(option.id);
          auxArr[i] = "<option value='" + option.id + "'>" + option.name + "</option>";
      });

  $('#selectOption').append(auxArr.join(''));
  }else{
  $('#c-name').val('Invaild Category')
  }
  }, 'json');
  }

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


// s

//   $(document).on('submit', '#formLogin', function (event) {
// event.preventDefault();
// var html = '';


// var url = $(this).attr('action');
// var formData = $(this).serialize();
// $.post(url, formData, function (response) {

// if(response.success == 1){
// swal({
// title: "Success!",
// text: response.message,
// icon: "success",
// });   
// // .then(function() {
// // window.location.href = response.url;
// // });
// }else{
// swal({
// title: "Oops!",
// text: response.message,
// icon: "error",
// dangerMode: true,
// });

// }

// }, 'json');

// });
</script>



  <?php
include_once 'footer.php';
  ?>