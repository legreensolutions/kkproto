<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_gspage/class_gspage.php');   // new Page Class

$page = new gsPage;
    
    $page->current_url = $current_url;  // current url for pages
    $page->title = "Kaffakarma.com";   // page Title
    $page->page_name = 'user_list';     // page name for menu and other purpose
    $page->layout = 'k_coffee.html';     // layout name
    
    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");

    $page->connection_list = array("connection.php",);

    $page->function_list = array("functions.php","image.php");
    $page->class_list = array("class_user.php","class_gspagination.php","class_securityquestion.php","class_country.php","class_city.php","class_usertype.php","class_userstatus.php");

    $index=0;
    $content_list[$index]['file_name']='inc_language.php';
    $content_list[$index]['var_name']='language';
    $index++;
    $content_list[$index]['file_name']='inc_menu.php';
    $content_list[$index]['var_name']='menu';

    $page->content_list = $content_list;

    $page->plugin_path = 'plugins/user/';
    $page->plugin = 'search_charity';
	$page->display(); //completed page with dynamic cintent will be displayed
?>                                `
