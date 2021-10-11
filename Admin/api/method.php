<?php
include_once 'connection.php';
include_once 'action.php';
$classAdmin= new Admin($conn);

$action=$_REQUEST['action'];

 switch($action){

 	case 'Register':
 		$classAdmin->Register();
 		break;
 	case 'checkSponser':
 		$classAdmin->checkSponser();
 		break;
    case 'Login':
 		$classAdmin->Login();
 		break;
 	case 'Logout':
 		$classAdmin->Logout();
 		break;
	case 'userLogin':
 		$classAdmin->userLogin();
 		break;
	case 'Update':
 		$classAdmin->Update();
 		break;
	case 'edit_Detail':
 		$classAdmin->edit_Detail();
 		break; 		
	case 'bankDetail':
 		$classAdmin->bankDetail();
 		break;
	case 'upload_category':
 		$classAdmin->upload_category();
 		break; 		
	case 'upload_Scategory':
 		$classAdmin->upload_Scategory();
 		break; 		
	case 'checkcategory':
 		$classAdmin->checkcategory();
 		break; 		
	case 'upload_product':
 		$classAdmin->upload_product();
 		break; 		
	case 'Add_Cart':
 		$classAdmin->Add_Cart();
 		break; 		
	case 'Remove_cart':
 		$classAdmin->Remove_cart();
 		break; 		
	case 'Add_quantity':
 		$classAdmin->Add_quantity();
 		break; 		

	case 'All_Remove':
 		$classAdmin->All_Remove();
 		break; 		
	case 'Update_address':
	// die('okkkkkkk');
 		$classAdmin->Update_address();
 		break; 
	case 'Add_fund':
 		$classAdmin->Add_fund();
 		break;		
	case 'shopping':
 		$classAdmin->shopping();
 		break;		
	case 'Fund_request':
 		$classAdmin->Fund_request();
 		break;		
	case 'Approved_request':
 		$classAdmin->Approved_request();
 		break;		
	case 'Rejected_request':
 		$classAdmin->Rejected_request();
 		break;		
	case 'Stock_update':
 		$classAdmin->Stock_update();
 		break;		
	case 'Activation_id':
	// die('okkkkkkk');
 		$classAdmin->Activation_id();
 		break;
	case 'E_pin':
 		$classAdmin->E_pin();
 		break;		
	case 'approved_epin':
 		$classAdmin->approved_epin();
 		break;		
	case 'rejected_epin':
	// die('okkkkk,');
 		$classAdmin->rejected_epin();
 		break;		

 }





?>