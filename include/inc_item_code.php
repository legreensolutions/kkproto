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
if ($_POST['insert'] == $CAP_insert || $_POST['update'] == $CAP_update){
if ( trim($_POST['txtname']) == "" ){
    $error .= $MSG_empty_item;
}

if ( trim ( $_FILES['fleimage']['name'] ) != ""  && $error == "" ) {
    $imgfilename = basename($_FILES["fleimage"]["name"]);
    $imgfilesize = $_FILES["fleimage"]["size"];
    //move the uploaded file to the image directory and create the thumbnail
    $arrupload = $myimage->upload_image($_FILES['fleimage'], 48, 800, 48, 600, 1048576, ITEM_DIR);
    if ($arrupload["err_code"] < 0) {
     $error .= $arrupload["err_desc"];
    }

    //the first image uploaded is set as the default
    $int_default = 0;
}

$myItem->error_description = $error;
if ( $error == "" ){
    $myItem = new Item();
    $myItem->connection = $myconnection;
    $myItem->name = trim($_POST['txtname']);
    $myItem->description = trim($_POST['txtdescription']);
    $myItem->item_status_id= trim($_POST['lstitem_status_id']);
    $myItem->item_type_id= trim($_POST['lstitem_type_id']);
    $myItem->keywords= trim($_POST['txtkeywords']);
    $myItem->unit_price= trim($_POST['txtunit_price']);
    $myItem->tax_item= trim($_POST['txttax_item']);
    $myItem->tax_shipping= trim($_POST['txttax_shipping']);
    $myItem->id = $_POST['h_id'];
    $myItem->image = $_FILES['fleimage']['name'];
    $chk = $myItem->update();
    if ($chk == true){
            if ( trim ( $_FILES['fleimage']['name'] ) != "" && $myItem->id > 0 ) {
                //rename the uploaded Image file and the thumbnail
                if ( $myimage->rename_image ($myItem->id, $arrupload["imagefile"], ITEM_DIR)  /*&& rename_image ($imageid, $arrupload["thumbfile"], THUMBS_DIR)*/ ) {
                $strMSG = $MSG_image_uploaded;
                }else {
                //Error while renaming the uploaded files
                $strERR = $MSG_image_err_upload;
                }
            }


        if ( $_POST['update'] == $CAP_update ) {
            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item_search.php";
            header( "Location: gfwflash.php");
            exit();
        }
        elseif ($_POST['insert'] == $CAP_insert ){
            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_added;
            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item_search.php";
            header( "Location: gfwflash.php");
            exit();
        }


    }elseif ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item.php";
        header( "Location: gfwflash.php");
        exit();
    }
}
}elseif ($_POST['delete'] == $CAP_delete){
    $myItem = new Item();
    $myItem->connection = $myconnection;
    $myItem->id = $_POST['h_id'];
    $chk = $myItem->delete();
    if ( $chk == false ){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item.php";
        header( "Location: gfwflash.php");
        exit();
    }else{
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_deleted;
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item_search.php";
        header( "Location: gfwflash.php");
        exit();
    }
}elseif ( isset($_POST['delete_image']) && $_POST['delete_image'] == $CAP_delete_image ){
    $myItem = new Item();
    $myItem->connection = $myconnection;
        $myItem->id = $_POST['h_id'];
        $chk = $myItem->get_detail();
        if ( $myimage->delete_image($myItem->id, $myItem->image, ITEM_DIR) ) {
            $strMSG = $MSG_image_deleted;
            $image = "";
            $myItem->delete_image_fromDB();
        }else {
            //Error while renaming the uploaded files
            $strERR = $MSG_image_err_delete;
        }
}elseif (isset($_GET['id']) && $_GET['id'] > 0){
$h_id = $_GET['id'];
$myItem = new Item();
$myItem->connection = $myconnection;
$myItem->id = $_GET['id'];
$chk = $myItem->get_detail();
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
