<?php 



$myuser_detail = new UserDetail();
$myuser_detail->id = $_SESSION[SESSION_TITLE.'charity_id'];
$myuser_detail->connection = $myconnection;
$chk_userdetails = $myuser_detail->get_detail();

        if ( $chk_userdetails == false ){
            $mesg = "No records found";
        }else{
            

        }            

?>
