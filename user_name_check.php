<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_gspage/class_gspage.php');	// new Page Class

$page = new gsPage;

	$page->current_url = $current_url;	// current url for pages
	$page->title = "Kaffakarma.com";	// page Title
	$page->page_name = 'gfwcaptcha';		// page name for menu and other purpose
	$page->layout = 'null.html';		// layout name

    $page->conf_list = array("conf.php");

	$page->connection_list = array("connection.php");

	$page->function_list = array("functions.php");
	$page->class_list = array("class_user.php");


	$index=0;

	$content_list[$index]['file_name']='inc_user_name_check.php';
	$content_list[$index]['var_name']='content';

	$page->content_list = $content_list;


	$page->display(); //completed page with dynamic cintent will be displayed
?>
