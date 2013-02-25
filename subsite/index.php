<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_gspage/class_gspage.php');	// new Page Class

$page = new gsPage;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Kaffakarma.com";	// page Title
	$page->page_name = 'index';		// page name for menu and other purpose
	$page->layout = 'k_coffee_sub_site.html';		// layout name

        $page->use_gsconf = true;                 // enable GS conf

        $page->conf_list = array("conf.php");
        $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");

	$page->function_list = array("functions.php");
	$page->class_list = array("class_user.php","class_useritem.php", "class_gspagination.php");
	$page->pageconf_list = array("index.php");

	$index=0;
	$content_list[$index]['file_name']='subsite/inc_left_menu.php';
	$content_list[$index]['var_name']='left_menu';
	$index++;
	$content_list[$index]['file_name']='subsite/inc_conf.php';
	$content_list[$index]['var_name']='content';
	$index++;
	$content_list[$index]['file_name']='subsite/inc_index.php';
	$content_list[$index]['var_name']='content';

	$page->content_list = $content_list;


	$page->display(); //completed page with dynamic cintent will be displayed
?>
