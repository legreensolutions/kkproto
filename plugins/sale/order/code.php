<?php 
	if(!isset($_GET["id"])){
		$_SESSION[SESSION_TITLE.'flash'] = "Invalid Order";
		$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
		header( "Location: ../gfwflash.php");
	}

    $myorder = new Order($myconnection);
    $myorder->connection = $myconnection;
    $myorder->id = $_GET["id"];
	$chk_order = $myorder->get_detail();
	if($chk_order == false){
		$_SESSION[SESSION_TITLE.'flash'] = "Invalid Order";
		$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
		header( "Location: ../gfwflash.php");
	}

    $myorderitem = new OrderItem($myconnection);
    $myorderitem->connection = $myconnection;
	$myorderitem->order_id = $myorder->id;
	$array_orderitem = $myorderitem->get_order_detail();

    $mycustomer = new Customer($myconnection);
    $mycustomer->connection = $myconnection;
    $mycustomer->id = $myorder->customer_id;
	$chk_customer = $mycustomer->get_detail();

    $mystate = new State($myconnection);
    $mystate->connection = $myconnection;
    $array_state = $mystate->get_array();

    $mycountry = new country($myconnection);
    $mycountry->connection = $myconnection;
    $array_country = $mycountry->get_array();







  




?>
