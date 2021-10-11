 <?php
include_once 'header.php';
// include_once '../Admin/api/action.php';
$t_record= $classAdmin->totalRecord('count(id) as ids','add_cart','   where user_id="'.$_SESSION['user_id'].'"');
$data=$classAdmin->order();
// print_r($data);
 ?>
 <style>
   .card-body-img{
    max-width: 100%;
    height: 200px;
    padding: 5px;
    overflow: hidden;
   }
button.btn.btn-danger {
    width: 50%;
}
./*buy{
  margin-top:0px;

}*/

 </style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="row">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Our Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="cart1.php" ><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:30px;"><?php echo $t_record;?></i></a></li>
              <!-- <li class="breadcrumb-item active">Add Cart </li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

              <?php
              foreach ($data as $key => $value) {
              $data2=$classAdmin->LoopRecord( ' * ',' add_cart ',' where user_id="'.$_SESSION['user_id'].'" and product_id="'.$value['id'].'"');
                # code...
              
              ?>
              
          <div class="col-md-3">
                  <div class="card">
                    	<input type="hidden" name="name">
                      <h6 class="card-title bg-info text-white p2 text-uppercase"><?php echo $value['name'];?></h6>
                        <div class="card-body-img">
                          <img src="image/<?php echo $value['image'];?>" alt="image"  class="img-fluid mb-2">
                           </div>
                          <h6>&#8377;<?php echo $value['price'];?>
                        <span> (<?php echo $value['discount']; ?>% off)</span></h6>
                       
                        <?php
if(empty($data2)){
                        ?>
                  <form action="<?php echo api_url('Add_Cart')?>" method="POST">
                        <input type="hidden" name="product_id" value ="<?php echo $value['id'];?>">
                       
                       
                        <input type="hidden" name="image" value ="<?php echo $value['image'];?>">
                        <input type="hidden" name="price" value ="<?php echo $value['price'];?>">

                        <input type="hidden" name="discount" value ="<?php echo $value['discount'];?>">
                        
                       
                       <div class="add-button">

                        	
                          <button  type="submit" class="btn btn-block btn-success">ADD CART</button>
                           <a href="<?php echo base_url('Dashboard/placeorder.php?product_id='.$value['id'])?>" type="submit" class="btn btn-block btn-warning">BUY NOW</a>
                       </div>
                  </form>
                    

<?php
}else{

  echo "<a href='cart1.php' class='btn btn-danger'>Added to Cart</a>";
  // echo'<br>';
  echo '<a href="cart1.php" type="submit" class="btn  btn-block btn-warning buy">BUY NOW</a>';
}
?>
                    </div>

                </div>  
                <?php
					    }
                ?>  
        </div>
    </div>
</div>
     

  <?php
include_once 'footer.php';
 ?>
