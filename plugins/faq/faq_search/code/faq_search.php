<?php
        //for pagination
        $Mypagination = new Pagination(20);


        $Myfaq = new faq($myconnection);
        $Myfaq->connection = $myconnection;
        $chk = $Myfaq->get_list_array();

        //for pagination
        $Myfaq->total_records = $Mypagination->total_records;

        $data_bylimit = $Myfaq->get_list_array_bylimit(-1, $_GET["txtquestion"], "", $Mypagination->start_record,$Mypagination->max_records);
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $Myfaq->total_records;
            $Mypagination->paginate();

        }

?>
