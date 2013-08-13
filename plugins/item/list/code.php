<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>


<?php
        //for pagination
        $Mypagination = new Pagination(20);


        $MyItem = new Item($myconnection);
        $MyItem->connection = $myconnection;
        $chk = $MyItem->get_list_array();

        //for pagination
        $MyItem->total_records = $Mypagination->total_records;

        $data_bylimit = $MyItem->get_list_array_bylimit(-1, $_GET["txtname"], "","","","", $Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $MyItem->total_records;
            $Mypagination->paginate();

        }

?>
