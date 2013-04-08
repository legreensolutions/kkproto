<?php
    $mystate = new State($myconnection);
    $mystate->connection = $myconnection;
    $chk_state = $mystate->get_list_array_canada_and_us();

    $mycountry = new country($myconnection);
    $mycountry->connection = $myconnection;
    $chk_con = $mycountry->get_list_array();


    $mycustomer = new Customer($myconnection);
    $mycustomer->connection = $myconnection;

    $myorder = new Order($myconnection);
    $myorder->connection = $myconnection;

    $myorderitem = new OrderItem($myconnection);
    $myorderitem->connection = $myconnection;

    if(isset($_SESSION[SESSION_TITLE.'order_id']) && $_SESSION[SESSION_TITLE.'order_id'] > 0){
        $myorder->id = $_SESSION[SESSION_TITLE.'order_id'];
        $myorder->get_detail();

        $mycustomer->id =  $myorder->customer_id;
        $mycustomer->get_detail();

        $myorderitem->order_id =  $myorder->id;
        $orderitem = $myorderitem->get_order_detail();

        if ( $orderitem != false ){
            $item_image = "../../images/items/item.gif";
            if ( $orderitem[0]["item_image"] != "" ) {
                $ext = explode('.', $orderitem[0]["item_image"]);
                $ext = $ext[count($ext)-1];
                $item_image = "../../".ITEM_DIR . $orderitem[0]["item_id"] . '.' . $ext;
            }
        } 



    }else{
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_no_order;
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "subsite/index.php";
        header( "Location: ../gfwflash.php");
        exit();
    }







 ?>
