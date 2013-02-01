<?php 
  // prevent execution of this code by direct call from browser
  if (!defined('CHECK_INCLUDED')) {
    exit();
  }
?>

<?php
$error = "";
if ($_POST['insert'] == $CAP_insert || $_POST['update'] == $CAP_update){
if ( trim($_POST['txtname']) == "" ){
    $error .= $MSG_empty_item;
}
$myItem->error_description = $error;
if ( $error == "" ){
      $myItem = new Item();
      $myItem->connection = $myconnection;
      $myItem->name = trim($_POST['txtname']);
      $myItem->description = trim($_POST['txtdescription']);
      $myItem->id = $_POST['h_id'];
      $chk = $myItem->update();
                            if ($chk == false){
                           // $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                            //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
                            //header( "Location: gfwflash.php");
                            //exit();
                            }
                            elseif ( $_POST['update'] == $CAP_update && $chk != false ) {
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "items.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
                            elseif ($_POST['insert'] == $CAP_insert && $chk != false){
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_added;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
}
}
elseif ($_POST['delete'] == $CAP_delete){
    $myItem = new Item();
    $myItem->connection = $myconnection;
    $myItem->id = $_POST['h_id'];
    $chk = $myItem->delete();
                            if ( $chk == false ){
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "items.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
                            else{
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_deleted;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "items.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
}
elseif (isset($_GET['id']) && $_GET['id'] > 0){
$h_id = $_GET['id'];
$myItem = new Item();
$myItem->connection = $myconnection;
$myItem->id = $_GET['id'];
$chk = $myItem->get_detail();
}
?>
