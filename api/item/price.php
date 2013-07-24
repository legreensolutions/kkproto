<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/connection/connection.php');	
require(ROOT_PATH.'include/conf/conf.php');	
require(ROOT_PATH.'include/conf/system_conf.php');	
require(ROOT_PATH.'include/class/class_item/class_item.php');
if (isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
	$myitem = new Item($myconnection);
    $myitem->connection = $myconnection;
    $myitem->id = $_REQUEST["id"];
	$myitem->get_detail();
	echo $myitem->unit_price;
}	

?>
