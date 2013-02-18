<?php
    $Myfaq = new Faq($myconnection);
    $Myfaq->connection = $myconnection;
    $data_faq = $Myfaq->get_list_array();

    if ( $data_faq == false ){
        $mesg = "No records found";
        $count_data_faq = 0;
    }else{
        $count_data_faq=count($data_faq);
    }

?>
