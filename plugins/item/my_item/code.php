<?php 
  // prevent execution of this code by direct call from browser
  if (!defined('CHECK_INCLUDED')) {
    exit();
  }
?>

<?php


 $myitem_status = new ItemStatus($myconnection);
 $myitem_status->connection = $myconnection;
 $data_item_status = $myitem_status->get_list_array();


 $myitem_type = new ItemType($myconnection);
 $myitem_type->connection = $myconnection;
 $data_item_type = $myitem_type->get_list_array();

 $myimage = new Image;

 $error = "";
if (isset($_GET['id']) && $_GET['id'] > 0){
$h_id = $_GET['id'];
$myItem = new Item();
$myItem->connection = $myconnection;
$myItem->id = $_GET['id'];
$chk = $myItem->get_detail();
if($chk==false){
    $_SESSION[SESSION_TITLE.'flash'] = "Invalid Item";
    $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "my_items.php";
    header( "Location: gfwflash.php");
    exit();
}
$image = $myItem->image;
if ( $myItem->image != "" ){
    $ext = explode('.', $myItem->image);
    $ext = $ext[count($ext)-1];
    $item_image = ITEM_DIR . $myItem->id . '.' . $ext;
}else{
    $item_image = ITEM_DIR . 'item.gif';
}



}
?>
