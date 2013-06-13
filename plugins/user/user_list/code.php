<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<?php
 $mycountry = new country($myconnection);
 $mycountry->connection = $myconnection;
 $chk_country = $mycountry->get_list_array();

 $myusertype = new usertype($myconnection);
 $myusertype->connection = $myconnection;
 $chk_usertype = $myusertype->get_list_array();

 $myuserstatus = new userstatus($myconnection);
 $myuserstatus->connection = $myconnection;
 $chk_userstatus = $myuserstatus->get_list_array();

 //for pagination
        $Mypagination = new Pagination(20);
        $myuser = new user($myconnection);
        $myuser->connection = $myconnection;
        //for pagination
        $myuser->total_records = $Mypagination->total_records;

        $data_bylimit = $myuser->get_list_array_bylimit($_GET["txtusername"],$_GET["txtfirstname"],$_GET["txtlastname"],$_GET["txtaddress"],$_GET["txtcity"],$_GET["lstcountry"],$_GET["lstusertype"],$_GET["lstuserstatus"],$Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myuser->total_records;
            $Mypagination->paginate();

        }
?>
