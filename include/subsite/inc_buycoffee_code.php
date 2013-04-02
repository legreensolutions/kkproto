<?php 

    $mystate = new State($myconnection);
    $mystate->connection = $myconnection;
    $chk_state = $mystate->get_list_array_canada_and_us();

    $mycountry = new country($myconnection);
    $mycountry->connection = $myconnection;
    $chk_con = $mycountry->get_list_array();

    $myuseritem = new UserItem($myconnection);
    $myuseritem->connection = $myconnection;
    if(isset($_REQUEST['item_id']) && $_REQUEST['item_id'] > 0){

        $myuseritem->item_id = $_REQUEST['item_id'];
    }else{

        if(isset($_SESSION[SESSION_TITLE.'item_id']) && $_SESSION[SESSION_TITLE.'item_id'] > 0){
            $myuseritem->item_id = $_SESSION[SESSION_TITLE.'item_id'];
        }        
    }

    $myuseritem->user_id = $_SESSION[SESSION_TITLE.'charity_id'];

    $chk_user_item = $myuseritem->get_item_detail();


    if ( $chk_user_item == false ){
        $mesg = "No Item found";
            $_SESSION[SESSION_TITLE.'flash'] = $mesg;
            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "subsite/index.php";
            header( "Location: ../gfwflash.php");
            exit();
    }else{
        //do nothing
        $_SESSION[SESSION_TITLE.'item_id'] = $myuseritem->item_id;
    }            

    $mycustomer = new Customer($myconnection);
    $mycustomer->connection = $myconnection;

    if(isset($_SESSION[SESSION_TITLE.'customer_id']) && $_SESSION[SESSION_TITLE.'customer_id'] > 0){
        $mycustomer->id = $_SESSION[SESSION_TITLE.'customer_id'];
        $mycustomer->get_detail();
        $h_id = $mycustomer->id;
    }

    $error = "";
    if ($_POST['submit'] == $CAP_submit){

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
              $mycustomer->address = mysql_real_escape_string(trim($_POST['address']));

              $mycustomer->id = mysql_real_escape_string(trim($_POST['h_id']));
              $chk = $mycustomer->update();
                                    if ($chk == false){
                                    $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                                    $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "subsite/index.php";
                                    header( "Location: ../gfwflash.php");
                                    exit();
                                    }
                                    elseif ( $_POST['submit'] == $CAP_submit && $chk != false ) {
                                    $_SESSION[SESSION_TITLE.'customer_id'] = $mycustomer->id;
                                    $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
                                    $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "subsite/confirm.php";
                                    header( "Location: ../gfwflash.php");
                                    exit();
                                    }
        }


    }




?>
