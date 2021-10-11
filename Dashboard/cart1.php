 <?php
include_once 'header.php';
$t_record= $classAdmin->totalRecord(' count(id) as ids ',' add_cart ','  where user_id="'.$_SESSION['user_id'].'"');
// print_r($t_record);

// include_once '../Admin/api/action.php';
// $classAdmin= new Admin($conn);
$data=$classAdmin->LoopRecord('id,product_id,user_id,price,quantity,total_price', ' add_cart ','  where user_id= "'.$_SESSION['user_id'].'"');
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

.order-btn{

  text-align: right;
  margin: 5px 0px;
 
}
.a-{

font-size:15px;
color: #000;
padding:0px 7px;
/* border-radius:50%;
*/}input.pl-ns-value {
height: 34px;
width: 60px;
text-align: center;
}
.number-spinner {
/* max-width: 120px;
*/ line-height: 40px;
padding: 0;
margin: 0;
border-radius: 4px;
overflow: hidden;
position: relative;
display: table;
input {
height: 40px;
max-height: 40px;
line-height: 40px;
font-size: 1em;
padding: 0;
margin: 0;
border: none;
position: relative;
float: left;
width: 0;
text-align: center;
&:focus {
outline: none;
}
}
.ns-btn {
position: relative;
font-size: 0;
white-space: nowrap;
vertical-align: middle;
display: table-cell;
cursor: pointer;
a {
height: 40px;
min-height: 40px;
width: 40px;
padding: 0;
max-width: 40px;
line-height: 40px;
border-radius: 0;
border: none;
text-align: center;
position: relative;
background: #e2e2e2;
color: #333;
display: inline-block;
vertical-align: middle;
text-decoration: none;
}
.icon-minus:after {
content: "\002212";
font-size: 35px;
line-height: 38px;
font-weight: bold;
}
.icon-plus:after {
content: "\00002B";
font-size: 38px;
line-height: 35px;
font-weight: bold;
}
}
}
.total-price{

font-size: 18px;
padding-top: 3px;
}
.total-price2{

font-size: 22px;
padding: 8px 0px;
}
.price-box {
position: absolute;
top: 114px;   
right: 70px;

}
.price{
border-bottom: 1px solid;

}
.item
{
  text-align: center;
}
.total-price2 span{
  
    float: right;
}
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="row">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Cart(<?php echo $t_record;?>)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo api_url('All_Remove')?>" class="btn btn-danger"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Empty Cart</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php
        $total='0';
        
         foreach ($data as $key => $value){
          // die('kjf');
         $data1=$classAdmin->SingleRecord('* ',' product ',' where id ='.$value['product_id'].'');
           // print_r($data1);

        
         ?>
              <!-- <li class="breadcrumb-item active">Add Cart </li> -->
          
        <div class="col-7 card ">
          <div class="row">
         <div class="col-md-5">
              <img src="image/<?php echo $data1['image'];?>" alt="image"  class="img-fluid mb-">

         </div>
          <div class="col-md-5">

            <h6 class="card-title" style="font-size:20px;"><?php echo $data1['name'];?></h6><br><br>
              <h6>&#8377;<?php echo $data1['price'];?>
            <span> (<?php echo $data1['discount']; ?>% off)</span></h6><br>
            total=<?php echo $value['total_price'];?>
             <form action="<?php echo api_url('Add_quantity')?>" method="post">
               <div class="form-group">
               
                <input type="hidden" name="price" value="<?php echo $value['price'];?>">
                <input type="hidden" name="id" value="<?php echo $value['id'];?>">
                  <select class=""  id="selectOption"   name="quantity">
                  <?php echo'    <option value='.$value['quantity'].'> Qty: '.$value['quantity'].'</option>';
                  $a=11;
                  for($i=1;$i<$a;$i++){
                    echo'<option value='.$i.' > '.$i.'</option>';

                  }
                  
                  $i++;
                  ?>
                 </select>
           
               <button type="submit">Update</button>
             
            </div>
             </form>

          </div>
          <div class="col-md-2">
            <div>
            <a   href="<?php echo api_url('Remove_cart&id='.$value['id'])?>" style="color:red; font-size:20px;">Remove</a>
           </div>
          </div>
<!-- <div class="col-10">
</div>
<div class="col-2">



  </div> -->

        </div>
        </div>
        <?php
  $total=$total+$value['total_price'];
      }
         
      ?>

      <div class="col-md-3 card offset-md-1 price-box ">

          
          <h5 class="price">PRICE DETAILS</h5>
          <h6 class=" total-price2 span">Price(<?php echo $t_record;?>)<span><?php echo $total;?></span></h6>
          <h6 class="total-price2 price">Delivery Charges<span> Free</span></h6>
          <h6 class="total-price2 price">Total Amount<span><?php echo $total;?></span></h6>
          
         </div>
           <div class="col-md-7 card">
               <div class="order-btn">          
                  <a href="placeorder.php" type="submit" class="btn btn-warning">Place Order</a>
             </div>
           </div><!-- /.container-fluid -->
        </div>   
     </div>
  </div>
</div>
                
 <!-- <script >
var numberSpinner = (function() {
$('.number-spinner>.ns-btn>a').click(function() {
var btn = $(this),
oldValue = btn.closest('.number-spinner').find('input').val().trim(),
newVal = 0;

if (btn.attr('data-dir') === 'up') {
newVal = parseInt(oldValue) + 1;
} else {
if (oldValue > 1) {
newVal = parseInt(oldValue) - 1;
} else {
newVal = 1;
}
}
btn.closest('.number-spinner').find('input').val(newVal);
});
$('.number-spinner>input').keypress(function(evt) {
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
return false;
}
return true;
});
})();
</script>
<script>
function add_quantity(i){
var qnty = document.getElementById("quantity"+i).value ;
var total= qnty;

}
</script>
 -->
  <?php
include_once 'footer.php';
 ?>




    
    
   
