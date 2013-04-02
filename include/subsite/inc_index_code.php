<?php 

        $myuseritem = new UserItem($myconnection);
        $myuseritem->connection = $myconnection;
        //for pagination

        $Mypagination = new Pagination(100);
        $myuseritem->total_records = $Mypagination->total_records;
        $data_bylimit = $myuseritem->get_list_array_bylimit(gINVALID, "","", ITEMSTATUS_IN_STOCK, ITEMTYPE_KAFFAKARMA, $_SESSION[SESSION_TITLE.'charity_id'], gINVALID, "", USER_ITEM_ACTIVE, $Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $myuseritem->total_records;
            $Mypagination->paginate();

        }            

?>
