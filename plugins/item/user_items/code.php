<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>


<?php
$mesg ="";

if (isset($_REQUEST['id']) && $_REQUEST['id'] > 0){

    $myuser = new User();
    $myuser->id = $_REQUEST['id'];
    $myuser->connection = $myconnection;
    $chk = $myuser->get_detail();

    $MyUserItem = new UserItem($myconnection);
    $MyUserItem->connection = $myconnection;

    if(isset($_POST)){
        if(isset($_POST["user_item"])){
            $MyUserItem->user_id = $_REQUEST['id'];
            $MyUserItem->delete_all();
            $user_items = $_POST["user_item"];
            foreach ($user_items as $key => $value){

                $MyUserItem->id = gINVALID;
                $MyUserItem->user_id = $_REQUEST['id'];
                $MyUserItem->item_id = $value;
                $MyUserItem->user_price =$_POST["unit_price"][$key];
                $MyUserItem->update();
            }     
            $mesg ="Item Updated";

        }

    }






        $user_item_array = $MyUserItem->get_array($_REQUEST['id']);


        $Mypagination = new Pagination(20);


        $MyItem = new Item($myconnection);
        $MyItem->connection = $myconnection;

        $data_bylimit = $MyItem->get_list_array_bylimit(-1, $_GET["txtname"], "","","","", $Mypagination->start_record,$Mypagination->max_records);

        
        
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
            $count_data_bylimit=count($data_bylimit);
            $Mypagination->total_records = $MyItem->total_records;
            $Mypagination->paginate();

        }
}else{
        $_SESSION[SESSION_TITLE.'flash'] = "Invalid User";
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "user_list.php";
        header( "Location: gfwflash.php");
        exit();

}
?>
