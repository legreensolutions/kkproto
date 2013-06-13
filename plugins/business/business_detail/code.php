<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<?php
$error = "";
if ($_POST['delete'] == $CAP_delete){
    $mybusiness = new Business();
    $mybusiness->connection = $myconnection;
    $mybusiness->id = $_POST['h_id'];
    $chk = $mybusiness->delete();
                            if ( $chk == false ){
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "business_search.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
                            else{
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_deleted;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "business_search.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
}
elseif (isset($_GET['id']) && $_GET['id'] > 0){
$h_id = $_GET['id'];
$mybusiness = new Business();
$mybusiness->connection = $myconnection;
$mybusiness->id = $_GET['id'];
$chk = $mybusiness->get_detail();
}else{
    $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
    $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "business_search.php";
    header( "Location: gfwflash.php");
    exit();

}
?>
