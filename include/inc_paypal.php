<?php

		$my_paypal = new paypal;             // initiate an instance of the class
		$my_paypal->paypal_url = PAYPAL_URL;   // paypal url
		
		// if there is not action variable, set the default action of 'process'
		if (empty($_REQUEST['action'])) $_REQUEST['action'] = 'process';  
		
		switch ($_REQUEST['action']) {
		
		case 'process':      // Process and order...
		
		
		$my_paypal->add_field('business', PAYPAL_BUSINESS_ACCOUNT);
 		$my_paypal->add_field('return', PAYPAL_RETURN_URL.'?action=success');
		$my_paypal->add_field('cancel_return', PAYPAL_RETURN_URL.'?action=cancel');       

		$my_paypal->add_field('notify_url', PAYPAL_RETURN_URL.'?action=ipn');

		$my_paypal->add_field('custom', $_POST['custom']);
		$my_paypal->add_field('item_name', $_POST['item_name']);
		$my_paypal->add_field('item_number', $_POST['item_number']);
		$my_paypal->add_field('quantity', $_POST['quantity']);
		$my_paypal->add_field('amount', $_POST['amount']);
		$my_paypal->add_field('tax', $_POST['tax']);
		$my_paypal->add_field('shipping', $_POST['shipping']);
		
		$my_paypal->add_field('no_shipping', $_POST['no_shipping']);
		$my_paypal->add_field('no_note', $_POST['no_note']);	
		$my_paypal->add_field('currency_code', $_POST['currency_code']);
		$my_paypal->add_field('lc', $_POST['lc']);


		$my_paypal->add_field('cmd', '_xclick');
	
		$my_paypal->submit_paypal_post(); // submit the fields to paypal
		//$my_paypal->dump_fields();      // for debugging, output a table of all the fields
		break;
		
		case 'success':      // Order was successful...
			$payment_date =$_POST['payment_date']; //contains Payment date
			$payer_status =$_POST['payer_status'];
			$custom =$_POST['custom']; //order id
			$id=$custom;
			$payment_status =$_POST['payment_status'];
			$txn_id =$_POST['txn_id'];
			$txn_type =$_POST['txn_type'];

			
			$paypal_data= $_POST;

			$notification = "PAYPAL_SUCCESS_DATA\n";
			foreach ($paypal_data as $key => $value) { $notification .= "\n$key: $value"; }
			$query = "INSERT INTO `tbpaypal` (  `date` , `userid` , `notification` , txn_type, txn_id, payment_status ) VALUES ( NOW() , '".$id."', '".$notification."', '".$txn_type."', '".$txn_id."', '".$payment_status."' )";
			mysql_query($query, $myconnection);
	
			if (trim($custom) == "" ) {
				$_SESSION[SESSION_TITLE.'flash'] ='Unable to Complete Payment :: Paypal redirect Failed.';
				header( "Location: flash.php");
				exit();
			}
				
            // 	Code Process Order		

		break;
		
		case 'cancel':       // Order was canceled...
		
			// The order was canceled before being completed.
			$_SESSION[SESSION_TITLE.'flash'] = "The Payment was canceled. <br/><br/>It appears that you cancelled the payment process at the Paypal website. However, if you would like to, you may continue buying coffee at kaffakarma.com.<br/><br/>
Thanks!";
			$_SESSION[SESSION_TITLE.'flash_refresh_page'] = 60; 
			$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
			header( "Location: flash.php");
			exit();
			

		break;
		
		case 'ipn':          // Paypal is calling page for IPN validation...
		

		
		if ($my_paypal->validate_ipn()) {
			$payment_date =$my_paypal->ipn_data['payment_date']; //contains Payment date
			$txn_id =$my_paypal->ipn_data['txn_id'];
			$custom =$my_paypal->ipn_data['custom']; //order id
			$payment_status =$my_paypal->ipn_data['payment_status'];
			$txn_type =$my_paypal->ipn_data['txn_type'];

			$mc_gross =$my_paypal->ipn_data['mc_gross'];
			$mc_amount3 =$my_paypal->ipn_data['mc_amount3'];

			$id=$custom; // order id
			$paypal_data= $my_paypal->ipn_data;
			$notification = "PAYPAL_IPN_DATA\n";
			
			foreach ($paypal_data as $key => $value) { $notification .= "\n$key: $value"; }
			$query = "INSERT INTO `tbpaypal` (  `date` , `userid` , `notification`, txn_type, txn_id, payment_status ) VALUES ( NOW() , '".$id."', '".$notification."', '".$txn_type."', '".$txn_id."', '".$payment_status."' )";
			mysql_query($query, $this->myconnection);
	
				
			if (trim($custom) != "" && is_numeric($custom) && $custom > 0 ) {

                // code update order
                // check  for sucess hit first

			}
			
		}
		break;
		}     
	?>
