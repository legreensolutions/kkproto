<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<?php
    $myuser = new User($myconnection);
    $myuser->connection = $myconnection;
	$array_user = $myuser->get_array();

    $mycustomer = new Customer($myconnection);
    $mycustomer->connection = $myconnection;
	$array_customer = $mycustomer->get_array();


 //for pagination
        $Mypagination = new Pagination(20);
        $myorder = new Order($myconnection);
        $myorder->connection = $myconnection;
        //for pagination
        $myorder->total_records = $Mypagination->total_records;

        $data_bylimit = $myorder->get_list_array_bylimit("",$_GET["txtsearch"], "", "", "", "", "",$Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myorder->total_records;
            $Mypagination->paginate();

        }
?>
