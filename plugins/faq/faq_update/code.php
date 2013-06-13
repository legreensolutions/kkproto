<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
<?php
$error = "";
if ($_POST['insert'] == $CAP_insert || $_POST['update'] == $CAP_update){

if ( trim($_POST['txtquestion']) == "" ){
    $error .= $MSG_empty_faq;
}
$myfaq->error_description = $error;
if ( $error == "" ){
      $myfaq = new Faq();
      $myfaq->connection = $myconnection;
      $myfaq->question = trim($_POST['txtquestion']);
      $myfaq->answer = trim($_POST['txtanswer']);
      $myfaq->id = $_POST['h_id'];
      $chk = $myfaq->update();
                            if ($chk == false){
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
                            elseif ( $_POST['update'] == $CAP_update && $chk != false ) {
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_faq_updated;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "faq_search.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
                            elseif ($_POST['insert'] == $CAP_insert && $chk != false){
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_faq_added;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "faq_update.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
}
}
elseif ($_POST['delete'] == $CAP_delete){
    $myfaq = new Faq();
    $myfaq->connection = $myconnection;
    $myfaq->id = $_POST['h_id'];
    $chk = $myfaq->delete();
                            if ( $chk == false ){
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "faq_search.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
                            else{
                            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_faq_deleted;
                            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "faq_search.php";
                            header( "Location: gfwflash.php");
                            exit();
                            }
}
elseif (isset($_GET['id']) && $_GET['id'] > 0){
$h_id = $_GET['id'];
$myfaq = new Faq();
$myfaq->connection = $myconnection;
$myfaq->id = $_GET['id'];
$chk = $myfaq->get_detail();
}
?>
