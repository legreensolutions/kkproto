<?php 
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

    $mystate = new State($myconnection);
    $mystate->connection = $myconnection;
    $chk_state = $mystate->get_list_array();

    $mycountry = new country($myconnection);
    $mycountry->connection = $myconnection;
    $chk_con = $mycountry->get_list_array();

    $myitem = new Item($myconnection);
    $myitem->connection = $myconnection;
	$chk_item = $myitem->get_list_array();

    $mycustomer = new Customer($myconnection);
    $mycustomer->connection = $myconnection;

    $myorder = new Order($myconnection);
    $myorder->connection = $myconnection;

    $myorderitem = new OrderItem($myconnection);
    $myorderitem->connection = $myconnection;





    $error = "";
    if (isset($_POST['submit']) && $_POST['submit'] == $CAP_submit){



        if ( trim($_POST['txtemail']) == "" ){
            $error .= $MSG_empty_email;
        }

        if ( trim($_POST['txtfirstname']) == "" ){
            $error .= $MSG_empty_firstname;
        }

        if ( trim($_POST['txtlastname']) == "" ){
            $error .= $MSG_empty_lastname;
        }

        if ( trim($_POST['txtaddress']) == "" ){
            $error .= $MSG_empty_address;
        }

        if ( trim($_POST['txtstreet']) == "" ){
            $error .= $MSG_empty_street;
        }

        if ( trim($_POST['txtcity']) == "" ){
            $error .= $MSG_empty_city;
        }

        if ( trim($_POST['lststate']) <= 0 ){
            $error .= $MSG_empty_state;
        }

        if ( trim($_POST['lstcountry']) <= 0 ){
            $error .= $MSG_empty_country;
        }



        if ( trim($_POST['txtpostal_code']) == "" ){
            $error .= $MSG_empty_postal_code;
        }

        if ( trim($_POST['txtphone']) == "" ){
            $error .= $MSG_empty_phone;
        }




        $mycustomer->error_description = $error;
        if ( $error == "" ){

              $mycustomer = new Customer();
              $mycustomer->connection = $myconnection;
              $mycustomer->emailid = mysql_real_escape_string(trim($_POST['txtemail']));
              $mycustomer->first_name = mysql_real_escape_string(trim($_POST['txtfirstname']));
              $mycustomer->last_name = mysql_real_escape_string(trim($_POST['txtlastname']));
              $mycustomer->address = mysql_real_escape_string(trim($_POST['txtaddress']));
              $mycustomer->street = mysql_real_escape_string(trim($_POST['txtstreet']));
              $mycustomer->city = mysql_real_escape_string(trim($_POST['txtcity']));
              $mycustomer->state_id = mysql_real_escape_string(trim($_POST['lststate']));
              $mycustomer->country_id = mysql_real_escape_string(trim($_POST['lstcountry']));
              $mycustomer->postal_code = mysql_real_escape_string(trim($_POST['txtpostal_code']));

              $mycustomer->phone = mysql_real_escape_string(trim($_POST['txtphone']));

              $mycustomer->shipping_address = mysql_real_escape_string(trim($_POST['txtaddress_shipping']));
              $mycustomer->shipping_street = mysql_real_escape_string(trim($_POST['txtstreet_shipping']));
              $mycustomer->shipping_city = mysql_real_escape_string(trim($_POST['txtcity_shipping']));
              $mycustomer->shipping_state_id = mysql_real_escape_string(trim($_POST['lststate_shipping']));
              $mycustomer->shipping_country_id = mysql_real_escape_string(trim($_POST['lstcountry_shipping']));
              $mycustomer->shipping_postal_code = mysql_real_escape_string(trim($_POST['txtpostal_code_shipping']));
              $mycustomer->id = mysql_real_escape_string(trim($_POST['h_id']));

              $chk = $mycustomer->update();

                    if ($chk == false){
                        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "cash_sale.php";
                        header( "Location: ../gfwflash.php");
                        exit();
                    }else{
                        $_SESSION[SESSION_TITLE.'customer_id'] = $mycustomer->id;
                        $myorder = new Order($myconnection);
                        $myorder->connection = $myconnection;
                        $myorder->id = mysql_real_escape_string(trim($_POST['ho_id']));
                        $myorder->customer_id = $mycustomer->id;
                        $myorder->user_id = $_SESSION[SESSION_TITLE.'user_id'];
                        $myorder->order_date = date("Y-m-d");

                        if(isset($_POST['chkshipping']) && $_POST['chkshipping'] > 0){
                            $shipping =  SHIPPING;
                        }else{
                            $shipping =  NO_SHIPPING;
                        }

                        $myorder->shipping =  $shipping ;
                        $myorder->paymentoption_id = CASH_PAYMENT;
                        $chk_order = $myorder->update();
                            if ($chk_order == false){
                                $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                                $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "cash_sale.php";
                                header( "Location: ../gfwflash.php");
                                exit();
                            }else{
                                $_SESSION[SESSION_TITLE.'order_id'] = $myorder->id;
                                $myorderitem = new OrderItem($myconnection);
                                $myorderitem->connection = $myconnection;
                                $myorderitem->order_id = $myorder->id;
                                $myorderitem->delete_orderitmes();
                                $myorderitem->id = gINVALID;
                                $myorderitem->order_id = $myorder->id;

								$myitem = new Item($myconnection);
								$myitem->connection = $myconnection;
								$myitem->id = $_POST['lstitem'];
								$myitem->get_detail();

                                $myorderitem->item_id = $myitem->id;
                                $myorderitem->quantity = mysql_real_escape_string(trim($_POST['txtquantity']));
                                $myorderitem->unit_price = $myitem->unit_price;
							    $amount = intval($myitem->unit_price) * intval($_POST['txtquantity']);
                                $myorderitem->amount = $amount;

                                // calculate shipping amount, order_amount, commission_amount tax...
                                if($myorder->shipping == SHIPPING){

                                    $myorderitem->shipping_amount = $myitem->shipping_rate;
                                }else{
                                    $myorderitem->shipping_amount = 0;
                                }



                                if ($myitem->tax_item>0){
                                    $tax =  $amount*($myitem->tax_item/100);
                                }else{
                                    $tax = 0;
                                }
                                
                                
                                if ($myorder->shipping == SHIPPING && $myitem->tax_shipping > 0){
                                    $gst =  $amount*($myitem->tax_shipping/100);
                                }else{
                                    $gst = 0;
                                }

//                                $myorderitem->tax_shipping = $gst;
//                                $myorderitem->tax_item = $tax;

                                 $myorderitem->tax = $tax + $gst;
                                // modify class useritem for commission
                                $myorderitem->commission = $myitem->commission;
                                $myorderitem->commission_amount = intval($myitem->commission) * intval($_POST['txtquantity']);
                                $chk_orderitem = $myorderitem->update();
                                    if ($chk_orderitem == false){
                                        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                                        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "cash_sale.php";
                                        header( "Location: ../gfwflash.php");
                                        exit();
                                    }else{
                                         // calculate shipping amount, order_amount, commission_amount tax...
                                        $myorder->order_number = $myorder->id;
                                        $myorder->order_amount = $myorderitem->amount;
                                        if($myorder->shipping == SHIPPING){
                                            $myorder->shipping_amount = $myorderitem->shipping_amount;
                                            $myorder->tax = $tax + $gst;            
                                        }else{
                                            $myorder->shipping_amount = 0;
                                            $myorder->tax = $tax ;  
                                        }

                                        $myorder->commission_amount = $myorderitem->commission_amount;
                                        $myorder->payment_status_id = PAID;
                                        $myorder->paymentdate = date("Y-m-d");

                                        $chk_order = $myorder->update();

                                        //$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
                                        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "order.php";
                                        header( "Location: order.php?id=".$myorder->id);
                                        exit();
                                    }

                            }
                    }
        }


    }




?>
