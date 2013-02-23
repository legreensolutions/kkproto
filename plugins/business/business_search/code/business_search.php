<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>


<?php
        //for pagination
        $Mypagination = new Pagination(20);


        $Mybusiness = new Business($myconnection);
        $Mybusiness->connection = $myconnection;
        $chk = $Mybusiness->get_list_array();

        //for pagination
        $Mybusiness->total_records = $Mypagination->total_records;
        $data_bylimit = $Mybusiness->get_list_array_bylimit(-1, $_GET["txtname"], $_GET["txtphone"],$_GET["txtemail"], $_GET["txtdate"], $_GET["txtipaddress"], $Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $Mybusiness->total_records;
            $Mypagination->paginate();

        }

?>
