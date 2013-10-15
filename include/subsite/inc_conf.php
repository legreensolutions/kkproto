<?php 
// echo $_SERVER["SUBSITE"];
//print_r($_SERVER);	


    if(isset($_GET['charity']) && $_GET['charity'] !="" ) {
        $charity=$_GET['charity'];
    }elseif(isset($_SESSION[SESSION_TITLE.'charity']) && $_SESSION[SESSION_TITLE.'charity'] !="" ) {
        $charity=$_SESSION[SESSION_TITLE.'charity'];
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
        $_SESSION[SESSION_TITLE.'charity'] = $myuser->user_name;
        $_SESSION[SESSION_TITLE.'charity_id'] = $myuser->id;
        

 
    }else{
        $_SESSION[SESSION_TITLE.'charity'] = "";
        $_SESSION[SESSION_TITLE.'charity_id'] = "";
        $_SESSION[SESSION_TITLE.'flash'] = "No Charity Page found!";

        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: ../gfwflash.php");
        exit();
    }
    
?>
