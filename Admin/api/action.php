<?php
session_start();
include_once "connection.php";
class Admin{

	function __construct($conn){
		$this->mysqli=$conn;
	}

	function E_pin(){
		$rem = $_POST['amount'] % 100;
		if($rem == 0){
			$name=$_FILES['image']['name'];
			$tmpname=$_FILES['image']['tmp_name'];
			$folder='../../Dashboard/Image'.$name;
			if(move_uploaded_file($tmpname,$folder)){
		  	 $sql="insert into e_pin (user_id,amount_method,amount,image) values('".$_SESSION['user_id']."','".$_POST['method']."','".$_POST['amount']."','".$name."')";
		  	 $result=$this->mysqli->query($sql);
		  	 $data['success']='1';
		 	$data['message']='Enter the amount multiple of 100';
	    	}
		}else{
			 $data['success']='0';
		 	$data['message']='Enter the amount multiple of 100';
		}
		echo json_encode($data);
	}	
	function approved_epin(){

		$sql="select * from e_pin where status ='0' && user_id='".$_GET['user_id']."' && id='".$_GET['id']."'";
		$result=$this->mysqli->query($sql);
		if(mysqli_num_rows($result) > 0){
		$row=$result->fetch_assoc();
		$amount=$row['amount']; 
		$total=$amount/100;
		for($i=1;$i <= $total;$i++){

			$epin=uniqid();
			$sql2="insert into epin_wallet (user_id,epin,amount) values('".$_GET['user_id']."','".$epin."','100')";
			$result2=$this->mysqli->query($sql2);

			$sql1="update e_pin set status=1 where user_id='".$_GET['user_id']."' && id='".$_GET['id']."'";
			$result1=$this->mysqli->query($sql1);
		}
		echo '<script>
		 window.location.href="http://localhost/Site1/Admin/RequestE-pin.php";
		</script>';
		}
	} 
	 function rejected_epin(){
	 	$sql="select * from e_pin where status='0' && user_id='".$_GET['user_id']."' && id='".$_GET['id']."'";
	 	$result=$this->mysqli->query($sql);
	 	if(mysqli_num_rows($result) > 0){
	 		$sql1="update e_pin set stautus='2' where user_id='".$_GET['user_id']."' && id='".$_GET['id']."'";
	 		$result1=$this->mysqli->query($sql1);
	 		echo '<script>
	 		 window.location.href="http://localhost/Site1/Admin/RequestE-pin.php";
	 		</script>';
	 	}
	 }

	function total_direct(){
		    // $t_direct=array();
			$sql="select count(user_id) as ids from users where sponser_id='".$_SESSION['user_id']."'";
			$result = $this->mysqli->query($sql);
			$row = $result->fetch_assoc();
			return $row['ids'];
	}

	function total_income(){
		 $sql="select ifnull(sum(amount),0.00) as t_income from income where user_id='".$_SESSION['user_id']."'";
		$result=$this->mysqli->query($sql);
		$row=$result->fetch_assoc();
		return $row['t_income'];
	}


	function SingleRecord($select,$table,$where){
		// print_r($_POST);
		$data = array();
		$sql= "select $select from $table $where";
		$result = $this->mysqli->query($sql);
		$row = $result->fetch_assoc();
		return $row;
    }
    


	function LoopRecord($select,$table,$where=''){
		$data = array();
		 $sql="select $select from $table $where";
		$result=$this->mysqli->query($sql);
		while($row=$result->fetch_assoc()){
			$data[]=$row; 
		}
		return $data;


	}

	function Register(){
		$sql="select user_id from users where user_id='".$_POST['sponser_id']."'";
		$result=$this->mysqli->query($sql);
		// $row=$result->fetch_assoc();
		if(mysqli_num_rows($result) <= 0){
			$data['success']='0';
			$data['message']='Invalid Sponser ID';
			echo json_encode($data);
			die();
		}

		$sql="select email from users where email='".$_POST['email']."'";
		$result=$this->mysqli->query($sql);

		if(mysqli_num_rows($result) > 0){
			$data['success']='0';
			$data['message']='Email Already Exists';
			echo json_encode($data);
			die();


		}
			if(!preg_match('/^[6-9][0-9]{9,9}$/', $_POST['mobile'])){
				$data['success']='0';
				$data['message']='Mobile No. Start With 6-9  and Max or Min length 10 Digits ';
				echo json_encode($data);
				die();
			}
				// if(strlen($_POST['mobile']) !=10 ){
				// 	$data['success']='0';
				// 	$data['message']='Please Check Mobile Lenght Min. OR Max. Lenght 10 Digits';
				// 	echo json_encode($data);
				// 	die();
				// }

	
		

		$user_id='LH'.rand(100000,999999);
		$password=rand(100000,999999);
		$txn_password=rand(100000,999999);

		 $sql="insert into users (sponser_id,name,mob_no,email,user_id,password,txn_password) values ('".$_POST['sponser_id']."','".$_POST['name']."','".$_POST['mobile']."','".$_POST['email']."','".$user_id."','".$password."','".$txn_password."')";
		$result=$this->mysqli->query($sql);
		if($result){
			$msg='<h2>User ID-'.$user_id.'<br>Password-'.$password.'<br>txn-Password-'.$txn_password.'</h2>';
			$data['success']='1';
			$data['massege']='Register successfully';
			$this->downline_count($user_id,$user_id,'1');
			$data['url']='http://localhost/Site1/Admin/api/success.php?info='.$msg;
		}else{
			$data['success']='0';
			$data['massege']='ERROR';

		}
		echo json_encode($data);

	}

	function checkSponser(){
		$sql="select name from users where user_id='".$_POST['id']."'";
		$result=$this->mysqli->query($sql);
		$row=$result->fetch_assoc();
		if(mysqli_num_rows($result)>0){
			$data['name']=$row['name'];
			$data['success']='1';
		}else{
			$data['success']='0';
		}
		echo json_encode($data);
	}

	function downline_count($user_id,$downline_id,$level){
		$sql="select sponser_id,user_id from users where user_id='".$user_id."'";
		$result=$this->mysqli->query($sql);
		$row=$result->fetch_assoc();
		if($row['sponser_id'] != 'none'){
			$sql1="insert into downline_count (user_id,downline_id,level) values('".$row['sponser_id']."','".$downline_id."','".$level."')";
			$result=$this->mysqli->query($sql1);
			$user_id=$row['sponser_id'];
			$this->downline_count($user_id,$downline_id,$level+1);
		}
	}
	
	function Login(){
		$sql="select * from users where user_id='".$_POST['user_id']."' And password='".$_POST['password']."'";
		$result=$this->mysqli->query($sql);
		$row=$result->fetch_assoc();
		    if($row>0){
		  	   if($row['role'] =='A'){
		  	   	 $_SESSION['is_admin'] = TRUE;
		  	   	 $_SESSION['admin_id'] = 'admin';
		  	  	  $data['success']='1';
		  	      $data['message']='';
		  	      $data['url']='http://localhost/Site1/Admin/index.php';
		  	    }
		  	    	if($row['role'] == 'U'){
		  	    		$_SESSION['is_user'] = TRUE;
		  	    		$_SESSION['user_id'] = $row['user_id']; 
		  	    		$data['success']='1';
		  	    		$data['message']='';
		  	    		$data['url']='http://localhost/Site1/Dashboard/index.php';
		  	    	}  
		    }else{
		    	$data['success']='0';
		    	$data['message']='Invalid User_id or Password';
		    }
		    echo json_encode($data);

	}

	function Logout(){
		session_unset();
		session_destroy();
		header('location:'.base_url('login.php').'');
	}

	function userLogin(){
		// print_r($_GET);
		if(!empty($_SESSION['is_admin'] == TRUE)){
			 $sql="select * from users where user_id='".$_GET['user_id']."'";
			$result=$this->mysqli->query($sql);
			$data=$result->fetch_assoc();
			if($data['user_id'] =  $_GET['user_id']){
			   $_SESSION['user_id'] = $data['user_id'];
			   header('location:http://localhost/Site1/Dashboard/index.php');

			}else{
				header('location:'.base_url('login.php').'');
			}

		}	
	}

	function Update(){
		$sql = "UPDATE users set name ='".$_POST['name']."', email ='".$_POST['e_mail']."',mob_no='".$_POST['mobile']."' where id = '".$_POST['id']."'";

		$result=$this->mysqli->query($sql);
		
		
			$data['success']='1';
			$data['message']='updated Detail';
			$data['url']='http://localhost/Site1/Admin/alluser.php';
		
		echo json_encode($data);
	}

	function page_Record($select,$table,$offset,$limit,$where){
		$data= array();
		 $sql="select $select from". $table . $where. 'order by id ASC limit ' .$offset.','.$limit;
		$result=$this->mysqli->query($sql);
		while($row=$result->fetch_assoc()){
			$data[]=$row;
		}
	   return $data;
	}  

	function totalRecord($select,$table,$where){
		$sql="select $select from $table $where ";
		$result=$this->mysqli->query($sql);
		$row=$result->fetch_assoc();
		return $row['ids'];
	}

	function edit_Detail(){
	
	    $filename = $_FILES["file"]["name"];
        $name = rand(100000,999999).$filename;
        $tmpname = $_FILES["file"]["tmp_name"];
		
        $ext = explode('.', $name);
        $filetxt = strtolower($ext[1]);
        $array = array('jpg','jpeg','png');
        $folder = "../../Dashboard/Image/".$name;
        
        if(in_array($filetxt,$array)){
        	
        //echo $folder;
    		if( move_uploaded_file($tmpname,$folder)){

				 $sql="update users set email='".$_POST['e_mail']."',file='".$name."' where user_id= '".$_SESSION['user_id']."'";
				$result=$this->mysqli->query($sql);
				if($this->mysqli->query($sql)===TRUE){
       				 $data['success'] ='1';
					  $data['message']="File uploaded successfully";
      			 // header('location:http:localhost/deepak/Admin/index.php'); 

     			 } else {
       				 $data['message']="Sorry, there was an error uploading your file.";
       				 $data['success'] ='0';
     				}
			}		else{
    					  $data['message']="File is not an image.";
     					 $data['success'] ='0';
   		 			}
		}else{
     		 $data['success'] ='0';
			 $data['message']="only allowed jpeg,jpg,png image extension";
		}			 
		 echo json_encode($data);

    }
   
    function bankDetail(){
    	$sql3="select * from users where user_id='".$_SESSION['user_id']."' ";
    	$result3=$this->mysqli->query($sql3);
    	$row3=$result3->fetch_assoc();
    	$paid=$row3['paid_status'];
    	if($paid<1){

    		$sql1="select * from u_bank_detail where user_id='".$_SESSION['user_id']."' ";
    		$result1=$this->mysqli->query($sql1);
    		$row=$result1->fetch_assoc();
    		$user=$row['user_id'];
    	
    		if(empty($user)){
    			  $sql2="insert into u_bank_detail (user_id,bank_name,account_no,ifsc_code,branch,mobile,name) values('".$_SESSION['user_id']."','".$_POST['bank_name']."','".$_POST['account_no']."','".$_POST['ifsc_code']."','".$_POST['branch']."','".$_POST['mobile']."','".$_POST['name']."')";
    			$result2=$this->mysqli->query($sql2);
    			$data['success']='1';
    			$data['message']='';
    			

    		}else{
    				 $sql="update u_bank_detail set bank_name='".$_POST['bank_name']."',account_no='".$_POST['account_no']."',ifsc_code='".$_POST['ifsc_code']."',branch='".$_POST['branch']."',mobile='".$_POST['mobile']."',name='".$_POST['name']."' where user_id='".$_SESSION['user_id']."' And paid_status = 0";
    				$result=$this->mysqli->query($sql);
    				$data['success']='1';
    				$data['message']='';
    			}
   		}else{
   		 	$data['success']= '0';
   		 	$data['message']='Do not Change your Bank Detail';
   		 }
   		 	echo json_encode($data);

    			

    }

    function upload_category(){
    	 $sql="select count(id) as ids from category  where name='".$_POST['category']."'";
    	$result=$this->mysqli->query($sql);
    	$row=$result->fetch_assoc();
    	if($row['ids']>0){
    		$data['success']= '0';
    		$data['message']= 'Already Exists';
    		echo json_encode($data);

    		die();
    	}else{

    	 	$sql1="insert into category (name) values ('".$_POST['category']."')";
    		$result1=$this->mysqli->query($sql1);
    		$data['success']= '1';
    		$data['message']= '';
    		echo json_encode($data);

    	}


    }

	 function upload_Scategory(){
    	 $sql="select count(id) as ids from sub_category  where name='".$_POST['sub_name']."' and category_id='".$_POST['category_id']."'";
    	$result=$this->mysqli->query($sql);
    	$row=$result->fetch_assoc();
    	if($row['ids']>0){
    		$data['success']= '0';
    		$data['message']= 'Already Exists';
    		echo json_encode($data);

    		die();
    	}else{

    	 	$sql1="insert into sub_category (category_id,name) values ('".$_POST['category_id']."','".$_POST['sub_name']."')";
    		$result1=$this->mysqli->query($sql1);
    		$data['success']= '1';
    		$data['message']= '';
    		echo json_encode($data);

    	}


    }

    function upload_product(){

    	$filename = $_FILES['image']['name'];
    	$name=rand(100000,999999).$filename;
    	$tmpname=$_FILES['image']['tmp_name'];
    	$folder='../../Dashboard/Image/'.$name;
    	$ext=explode('.',$name);
    	$filetxt=strtolower($ext[1]);
    	$array=array('jpg','jpeg','png');
    	if(in_array($filetxt, $array)){
    		if(move_uploaded_file($tmpname, $folder)){
    	
    			 $sql="insert into product (category_id,sub_category_id,name,image,price,discount,gst,cgst,stock) values('".$_POST['category_id']."','".$_POST['sub_category_id']."','".$_POST['name']."','".$name."','".$_POST['price']."','".$_POST['discount']."','".$_POST['gst']."','".$_POST['cgst']."','".$_POST['stock']."')";
    			$result=$this->mysqli->query($sql);
    			$data['success']='1';
    		}	$data['message']='';
    	}	
    	echo json_encode($data);
    }

    function Stock_update(){
    	$sql="update product set stock='".$_POST['stock']."' where id ='".$_POST['id']."'";
    	$result=$this->mysqli->query($sql);
    	$data['success']='1';
    	$data['message']='uploaded Stock';
    	$data['url']= base_url('Admin/uploadproduct.php');
    	echo json_encode($data);
    }
		
	function checkcategory(){
		$sql="select * from sub_category where category_id='".$_POST['id']."'";
		$result=$this->mysqli->query($sql);
		if(mysqli_num_rows($result)>0){
			while($row=$result->fetch_assoc()){
			$data1[]=$row;
			//print_r($data);
		   }
			$data['data']=$data1;
			$data['success']='1';
			echo json_encode($data);
		}
	}

	function order(){
         $sql="select id,name,image,discount,price from product order by id Asc";
          $result=$this->mysqli->query($sql);
          while($row= $result->fetch_assoc()){
           		 $data[] = $row;
          	}
      	 return $data;
      	
    }

    function Add_Cart(){
    	$sql="insert into add_cart (product_id,user_id,image,price,discount,total_price) values('".$_POST['product_id']."','".$_SESSION['user_id']."','".$_POST['image']."','".$_POST['price']."','".$_POST['discount']."','".$_POST['price']."')";
    	$result=$this->mysqli->query($sql);
    	 echo'<script>
      	 window.location.href="http://localhost/Site1/Dashboard/order.php";
      	 </script>';

    }

    function Remove_cart(){
    	$sql=" delete  from add_cart where id='".$_GET['id']."'";
    	$result=$this->mysqli->query($sql);
    	echo '<script>
    		window.location.href= "http://localhost/Site1/Dashboard/cart1.php";
    	</script>';
    }
     function All_Remove(){
    	$sql=" delete  from add_cart ";
    	$result=$this->mysqli->query($sql);
    	echo '<script>
    		window.location.href= "http://localhost/Site1/Dashboard/order.php";
    	</script>';
    }

    function Add_quantity(){
    	$sql="update add_cart set quantity='".$_POST['quantity']."',total_price='".$_POST['price']."'*'".$_POST['quantity']."' where id='".$_POST['id']."'";
    	$result=$this->mysqli->query($sql);
    	echo '<script>
    		window.location.href= "http://localhost/Site1/Dashboard/cart1.php";
    	</script>';

    }

    function Update_address(){
    	 $sql="select * FROM u_address where user_id='".$_SESSION['user_id']."'";
    	$result=$this->mysqli->query($sql);
    	 if(mysqli_num_rows($result) > 0){

    	 	$row=$result->fetch_assoc();
    	 		
    	 	
    	
     $sql="update u_address set name='".$_POST['name']."',mobile='".$_POST['mobile']."',email='".$_POST['email']."',pincode='".$_POST['pincode']."',address='".$_POST['address']."',city='".$_POST['city']."',state='".$_POST['state']."' where user_id='".$_SESSION['user_id']."'";
    	$result=$this->mysqli->query($sql);
    	$data['success']='1';
    	$data['message']='';
    	echo json_encode($data);
    
    	 }else{
    	 	$sql="insert into u_address (user_id,name,mobile,email,pincode,address,city,state) values('".$_SESSION['user_id']."','".$_POST['name']."','".$_POST['mobile']."','".$_POST['email']."','".$_POST['pincode']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."')";
    	 	$result=$this->mysqli->query($sql);
    	 	$data['success']='1';
    	 	$data['message']='';
    	 	echo json_encode($data);
    	 }
	}

	function Add_fund(){
	 	$sql="select * from users where user_id= '".$_POST['user_id']."'";
		$result=$this->mysqli->query($sql);
		if(mysqli_num_rows($result) > 0){
			$row=$result->fetch_assoc();

			$sql="insert into user_wallet (user_id,amount,type) values('".$_POST['user_id']."','".$_POST['amount']."','fund')";
			$result=$this->mysqli->query($sql);
			
			$data['success']='1';
			$data['message']='Pay successfully';

			echo json_encode($data);
			
		}else{
			$data['success']='0';
			$data['message']=' Invalid User Id';
			echo json_encode($data);

		}	
	} 

	function shopping(){
		$sql="select sum(amount) as total from user_wallet where user_id='".$_SESSION['user_id']."'";
		$result=$this->mysqli->query($sql);
		if(mysqli_num_rows($result) > 0){
			$row = $result->fetch_assoc();
			if($row['total'] >= $_POST['price']){
				$sql="insert into user_wallet (user_id,amount,type) values('".$_SESSION['user_id']."','".-$_POST['price']."','shopping')";
				$result=$this->mysqli->query($sql);	
				$data['success']='1';
				$data['message']='Proceed Successfully';
			}else{
				$data['success']='0';
				$data['message']='Insufficient Wallet Balance.  ₹'.$row['total'].'.00';
			}
			echo json_encode($data);				
		}

	}

	function Fund_request(){
		// print_r($_FILES);
		$name=$_FILES["image"]["name"];
		$tmpname=$_FILES["image"]["tmp_name"];
		$folder="../../Dashboard/Image/".$name;
		// echo $folder.$name;
		if(move_uploaded_file($tmpname,$folder)){
			$sql="insert into fund_request (user_id,amount_method,amount,image) values('".$_SESSION['user_id']."','".$_POST['method']."','".$_POST['amount']."','".$name."')";
			$result=$this->mysqli->query($sql);
			$data['success']='1';
			$data['message']='Request Successfully';

 			echo json_encode($data);
		}
	}

	function Approved_request(){
		$sql="select * from fund_request where status='0' && user_id='".$_GET['user_id']."' && id='".$_GET['id']."'";
		$result=$this->mysqli->query($sql);
		if(mysqli_num_rows($result) > 0){
			$row=$result->fetch_assoc();
			$amount=$row['amount'];
			$sql="insert into user_wallet (user_id,amount,type) values('".$_GET['user_id']."','".$amount."','admin-fund')";
			$result=$this->mysqli->query($sql);
			$sql1="update fund_request set status='1' where user_id='".$_GET['user_id']."'";
			$result1=$this->mysqli->query($sql1);
			echo'<script>
			window.location.href="http://localhost/Site1/Admin/request.php";
			</script>';


		}
	}

	function Rejected_request(){
		$sql="select * from fund_request where status='0' && user_id='".$_GET['user_id']."' && id='".$_GET['id']."'";
		$result=$this->mysqli->query($sql);
		if(mysqli_num_rows($result) > 0){
			$row=$result->fetch_assoc();
			$sql="update fund_request set status='2' where user_id='".$_GET['user_id']."' && id='".$_GET['id']."'";
			$result=$this->mysqli->query($sql);
			echo'<script>
			window.location.href="http://localhost/Site1/Admin/request.php";
			</script>';
		}
	}

	function Activation_id(){
		
	    $sql="select * from users where user_id='".$_POST['user_id']."'";
		$result=$this->mysqli->query($sql);
		 	// $row=$result->fetch_assoc();
		 if(mysqli_num_rows($result) <= 0){
		 	$data['success']='0';
		 	$data['message']='Invalid User Id.';
		 	echo json_encode($data);
		 	die();
		 }
		 $sql1="select * from users  where user_id='".$_SESSION['user_id']."' && txn_password='".$_POST['txn_pass']."'";
		 $result1=$this->mysqli->query($sql1);
		 if(mysqli_num_rows($result1) <=  0){
		 	$data['success']='0';
		 	$data['message']='Invalid txn Password';
		 	echo json_encode($data);
		 	die();
		 }
		 $sql2="select sum(amount) as total from user_wallet where user_id='".$_SESSION['user_id']."'";
		 $result2=$this->mysqli->query($sql2);
		 if(mysqli_num_rows($result2) > 0){
		 	$row2=$result2->fetch_assoc();
		 	if($row2['total'] >= $_POST['price']){
		 		$sql11="insert into user_wallet (user_id,amount,type)  values('".$_SESSION['user_id']."','".-$_POST['price']."','Activation id')";
		 		$result11=$this->mysqli->query($sql11);
		 	}else{
		 		$data['success']='0';
		 		$data['message']='Insufficient Wallet Balance.  ₹'.$row2['total'].'.00';	
		 		echo json_encode($data);
		 		die();

		 	}

		 }

		 $sql5="select paid_status from users where user_id='".$_POST['user_id']."'";
		 $result5=$this->mysqli->query($sql5);
		 if(mysqli_num_rows($result5) > 0){
		 	$row5=$result5->fetch_assoc();
		 	// $sponser_id['sponser_id']=$_POST['user_id'];
		 	if($row5['paid_status'] == 1){
		 		$data['success']='0';
		 		$data['message']='Already Paid';
		 		echo json_encode($data);
		 		die();
		 	}
		 }


		 $sql10="select sponser_id from users where user_id='".$_POST['user_id']."'";
		 $result10=$this->mysqli->query($sql10);
		 $row10=$result10->fetch_assoc();

		 $sql4="select * from package where price= '".$_POST['price']."'" ;
		 $result4=$this->mysqli->query($sql4);
		 $row4=$result4->fetch_assoc();

	 	 $sql3="update users set package_id='".$row4['id']."',package_price='".$_POST['price']."',paid_status='1', topup_date='".date('Y-m-d H:i:s')."' where user_id='".$_POST['user_id']."'";
		 $result3=$this->mysqli->query($sql3);


		 $sql7="insert into income (amount,user_id,type,remark) values('".$row4['direct_income']."','".$row10['sponser_id']."','direct-income','Activation_id ".$_POST['user_id']."')";
		 $result7=$this->mysqli->query($sql7);
		 // $sql15="insert into user_wallet (user_id,amount,type) values('".$row10['sponser_id']."','".$row4['direct_income']."','direct-income')";
		 // $result15=$this->mysqli->query($sql15);		
		 $data['success']='1';
		 $data['message']='Activation successfully';
		 $sponser_id=$row10['sponser_id'];
		 $user_id=$_POST['user_id'];
		 $this->level_income($sponser_id,$user_id);

		 echo json_encode($data);
	}

	function level_income($sponser_id,$user_id){
		// print_r($_POST);
		$income= array('9','8','7','6','5','4','3','2','1');
		foreach ($income as $key => $value) {
			 $sql="select * from users where user_id='".$sponser_id."'";
			$result=$this->mysqli->query($sql);
			$row=$result->fetch_assoc();
				 $sql3="select paid_status from users where sponser_id='".$row['sponser_id']."'";
				$result3=$this->mysqli->query($sql3);
				$row3=$result3->fetch_assoc();
			if($row['sponser_id']!= 'none'){
				if(($row3['paid_status']) > 0){
					
				
				$sql1="insert into income (amount,user_id,type,remark) values('".$value."','".$row['sponser_id']."','level-income','Activation id ".$user_id."')";
				$result1 = $this->mysqli->query($sql1);
				 
				 // $sql2="insert into user_wallet (amount,user_id,type) values('".$value."','".$row['sponser_id']."','level-income')";
				 // $result2=$this->mysqli->query($sql2);
				}
				$sponser_id = $row['sponser_id'];
			}
		}
	}
		

}	
 //outside the class function//
 	function base_url($path=''){
 	  return 'http://localhost/Site1/'.$path;
    }	

    function api_url($path=''){
      return 'http://localhost/Site1/Admin/api/method.php?action='.$path; 
    }

?>



 