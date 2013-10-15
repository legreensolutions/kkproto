<?php
  session_start();
  define('CHECK_INCLUDED', true);
  define('ROOT_PATH', './');
  $current_url = $_SERVER['PHP_SELF'];
  
  // new Page Class
  require(ROOT_PATH.'include/class/class_gspage/class_gspage.php');	
  
  $page = new gsPage;
	$page->current_url = $current_url;	      // current url for pages
	$page->title = "Kaffakarma.com :: Item";	// page Title
	$page->page_name = 'item';		    // page name for menu and other purpose
	$page->layout = 'default.html';		// layout name

    $page->access_list = array("USERTYPE_REGISTERED_USER"); // authorisation          
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
    $page->connection_list = array("connection.php");
    $page->function_list = array("functions.php");
    $page->class_list = array("class_item.php","class_itemstatus.php", "class_itemtype.php","class_image.php");
    $page->pageconf_list = array("item.php");
    
    $page->css_list = array("form.css");
    $page->js_list = array("item.js");

	$index=0;
	$content_list[$index]['file_name']='inc_menu.php';
	$content_list[$index]['var_name']='menu';

	$page->content_list = $content_list;
  
    $page->plugin_path = 'plugins/item/';
    $page->plugin = 'my_item';


	$page->display(); // completed page with dynamic content will be displayed
?>
