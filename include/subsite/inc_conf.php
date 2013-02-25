<?php 
    if(isset($_GET['charity']) && $_GET['charity'] !="" ) {
        $charity=$_GET['charity'];
    }else{
	    $server_host = explode('.', $_SERVER['HTTP_HOST']);
	    $title = strtolower($server_host[0]);
	    if (strtolower($title) == strtolower("www")) {
		    $charity = strtolower($server_host[1]);
	    }

	}

    $myuser = new user($myconnection);
    $myuser->connection = $myconnection;
    $myuser->user_name = $charity;
    if($myuser->get_charity_detail()!=false){
        $title = "Charity Page :: ".$charity;
    }else{
        $_SESSION[SESSION_TITLE.'flash'] = "No Charity Page";
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: ".WEB_URL."/gfwflash.php");
        exit();
    }
    
?>
