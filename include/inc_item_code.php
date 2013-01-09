<?php 
  // prevent execution of this code by direct call from browser
  if (!defined('CHECK_INCLUDED')) {
    exit();
  }

  $error = "";
  $myItem = new Item();
  if ($_POST['insert'] == "INSERT" || $_POST['update'] == "UPDATE") {
    if (trim($_POST['txtname']) == "") {
      $error .= $MSG_empty_ItemName;
    }
    $myItem->error_description = $error;
    if ($error == "") {
      $myItem->connection = $myconnection;
      //$id = $myItem->get_id();
      $myItem->name = trim($_POST['txtname']);
      $myItem->publish = CONF_PUBLISH;
      $myItem->id = $_POST['h_id'];
      $chk = $myItem->update();
      if ($chk == false) {
        //if update failed
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: gfwflash.php");
        exit();
      }
      else {
        //if update is successful
        if ($_POST['update'] == "UPDATE") {
          $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_lan_updated;
          $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "language_search.php";
          header( "Location: gfwflash.php");
          exit();
        }
        elseif ($_POST['insert'] == "INSERT") {
          $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_lan_added;
          $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "language.php";
          header( "Location: gfwflash.php");
          exit();
        }
      }
    }
  }
  elseif ($_POST['delete'] == "DELETE") {
    $myItem = new Item();
    $myItem->connection = $myconnection;
    $myItem->id = $_POST['h_id'];
    $chk = $myItem->delete();
    if ($chk == false) {
      $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_on_fail;
      $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item_search.php";
      header( "Location: gfwflash.php");
      exit();
    }
    else {
      $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_item_deleted;
      $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "item_search.php";
      header( "Location: gfwflash.php");
      exit();
    }
  }
  elseif (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $h_id = $_GET['id'];
    $myItem = new Item();
    $myItem->connection = $myconnection;
    $myItem->id = $_GET['id'];
    $chk = $myItem->get_detail();
  }
  else {
    //TBD
    // this situation must be handled
  }
?>
