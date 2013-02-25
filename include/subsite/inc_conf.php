<?php 
    if(isset($_GET['charity']) && $_GET['charity'] !="" ) {
        $charity=$_GET['charity'];
    }else{
	    $server_host = explode('.', $_SERVER['HTTP_HOST']);
	    $charity = strtolower($server_host[0]);
	    if (strtolower($charity) == strtolower("www")) {
		    $charity = strtolower($server_host[1]);
	    }
	}

    $myuser = new user($myconnection);
    $myuser->connection = $myconnection;
    $myuser->user_name = $charity;
    if($myuser->get_charity_detail()!=false){
        $title = "Charity Page :: ".$charity;
        $user_image = "../../images/user/user.gif";
      if ( $myuser->image != "" ) {
            $ext = explode('.', $myuser->image);
            $ext = $ext[count($ext)-1];
            $user_image = "../../".USER_DIR . $myuser->id . '.' . $ext;
      }


        $myuseritem = new UserItem($myconnection);
        $myuseritem->connection = $myconnection;
        //for pagination

        $Mypagination = new Pagination(100);
        $myuseritem->total_records = $Mypagination->total_records;
        $data_bylimit = $myuseritem->get_list_array_bylimit(gINVALID, "","", ITEMSTATUS_IN_STOCK, ITEMTYPE_KAFFAKARMA, $myuser->id, gINVALID, "", $Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myuseritem->total_records;
            $Mypagination->paginate();

        }            





    }else{
        $_SESSION[SESSION_TITLE.'flash'] = "No Charity Page found!";
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: ".WEB_URL."/gfwflash.php");
        exit();
    }
    
?>
