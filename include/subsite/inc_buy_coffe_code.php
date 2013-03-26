<?php 

    $mystate = new State($myconnection);
    $mystate->connection = $myconnection;
    $chk_state = $mystate->get_list_array_canada_and_us();

    $mycountry = new country($myconnection);
    $mycountry->connection = $myconnection;
    $chk_con = $mycountry->get_list_array();

    $myuseritem = new UserItem($myconnection);
    $myuseritem->connection = $myconnection;
    $myuseritem->item_id = $_GET['item_id'];
    $myuseritem->user_id = $_SESSION[SESSION_TITLE.'charity_id'];


    $chk_user_item = $myuseritem->get_item_detail();

    if ( $chk_user_item == false ){
        $mesg = "No Item found";
    }else{
        //do nothing
    }            

?>
