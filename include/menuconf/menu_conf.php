<?php
$i=0;

GLOBAL $menu_list;
GLOBAL $g_msg_unauthorized_request;

$menu_list[$i][caption] = "Home";
$menu_list[$i][url]="index.php";
$menu_list[$i][usertype] = 0;
$menu_list[$i][submenu] = "";
$i++;


$menu_list[$i][caption] = "Administration";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_ADMIN;
$menu_list[$i][submenu] = "administration_menu";
$i++;


$menu_list[$i][caption] = "Contents";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_ADMIN;
$menu_list[$i][submenu] = "contents_menu";
$i++;


$g_menu_user_menu = "User Menu";

$menu_list[$i][caption] = $g_menu_user_menu;
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_ADMIN;
$menu_list[$i][submenu] = "user_menu_admin";
$i++;




$menu_list[$i][caption] = $g_menu_user_menu;
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_REGISTERED_USER;
$menu_list[$i][submenu] = "user_menu_registered_user";
$i++;

$menu_list[$i][caption] = $g_menu_user_menu;
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_EMPLOYEE;
$menu_list[$i][submenu] = "user_menu_employee";
$i++;


$menu_list[$i][caption] = "Kaffakarma";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = 0;
$menu_list[$i][submenu] = "kaffakarma_menu";

$i++;


$menu_list[$i][caption] = "Sales";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_ADMIN;
$menu_list[$i][submenu] = "sales_menu_admin";
$i++;

$menu_list[$i][caption] = "Reports";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_ADMIN;
$menu_list[$i][submenu] = "reports_menu_admin";
$i++;



$menu_list[$i][caption] = "Downloads";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = 0;
$menu_list[$i][submenu] = "download_menu";
$i++;

$menu_list[$i][caption] = $g_menu_Login; 
$menu_list[$i][url]="login.php";
$menu_list[$i][usertype] = 0;
$menu_list[$i][submenu] = "";
$i++;

$menu_list[$i][caption] = "Sign Up";
$menu_list[$i][url]="signup.php";
$menu_list[$i][usertype] = -1;
$menu_list[$i][submenu] = "";
$i++;


GLOBAL $contents_menu;

$contents_menu[$i][caption] = "Web Content";
$contents_menu[$i][url]="gsconf_search.php";
$contents_menu[$i][usertype] = USERTYPE_ADMIN;
$i++;


$contents_menu[$i][caption] = "Publish Content (ALL)";
$contents_menu[$i][url]="gsconf_publishall.php";
$contents_menu[$i][usertype] = USERTYPE_ADMIN;
$i++;

$contents_menu[$i][caption] = "Import Content";
$contents_menu[$i][url]="gsconf_import.php";
$contents_menu[$i][usertype] = USERTYPE_ADMIN;
$i++;

GLOBAL $administration_menu;

$administration_menu[$i][caption] ="Settings";
$administration_menu[$i][url]="gsconf_settings.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;

$administration_menu[$i][caption] = "Languages";
$administration_menu[$i][url]="language_search.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;

$administration_menu[$i][caption] = "Add Language";
$administration_menu[$i][url]="language.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;

$administration_menu[$i][caption] = "Images";
$administration_menu[$i][url]="image_upload.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;


$administration_menu[$i][caption] = "FAQ search";
$administration_menu[$i][url]="faq_search.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;

$administration_menu[$i][caption] = "Add FAQ";
$administration_menu[$i][url]="faq_update.php"; 
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;


$administration_menu[$i][caption] = "Contact Us Forms Submitted";
$administration_menu[$i][url]="business_search.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;

$administration_menu[$i][caption] = "Prohibited Words";
$administration_menu[$i][url]="keywords.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;


$administration_menu[$i][caption] = "Add Security Question";
$administration_menu[$i][url]="securityquestion.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;

$administration_menu[$i][caption] = "Search Security Question";
$administration_menu[$i][url]="sec_que_search.php";
$administration_menun[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;


$administration_menu[$i][caption] = "Backup Data";
$administration_menu[$i][url]="backup.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;


$administration_menu[$i][caption] = "Restore Data";
$administration_menu[$i][url]="restore.php";
$administration_menu[$i][usertype] = USERTYPE_ADMIN;
$administration_menu[$i][submenu] = "";
$i++;




GLOBAL $user_menu_admin;
$user_menu_admin[$i][caption] = "Profile";
$user_menu_admin[$i][url]="profile.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;
$user_menu_admin[$i][caption] = "Change Password";
$user_menu_admin[$i][url]="change_passwd.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;





GLOBAL $user_menu_registered_user;
$user_menu_registered_user[$i][caption] = "Profile";
$user_menu_registered_user[$i][url]="profile.php";
$user_menu_registered_user[$i][usertype] = USERTYPE_REGISTERED_USER;
$user_menu_registered_user[$i][submenu] = "";
$i++;




GLOBAL $user_menu_employee;
$user_menu_employee[$i][caption] = "Profile";
$user_menu_employee[$i][url]="profile.php";
$user_menu_employee[$i][usertype] = USERTYPE_EMPLOYEE;
$user_menu_employee[$i][submenu] = "";
$i++;



GLOBAL $download_menu;
//$download_menu[$i][caption] = "Download Source";
//$download_menu[$i][url]="download.php?download=greenFW.zip"; 
//$download_menu[$i][usertype] = 0;
//$download_menu[$i][submenu] = "";
//$i++;
$download_menu[$i][caption] = "Download DB";
$download_menu[$i][url]="download.php?download=gfw.sql.zip";
$download_menu[$i][usertype] = 0;
$download_menu[$i][submenu] = "";
$i++;


GLOBAL $kaffakarma_menu;




$kaffakarma_menu[$i][caption] = "Add User";
$kaffakarma_menu[$i][url]="add_user.php";
$kaffakarma_menu[$i][usertype] = USERTYPE_ADMIN;
$kaffakarma_menu[$i][submenu] = "";
$i++;

$kaffakarma_menu[$i][caption] = "User List";
$kaffakarma_menu[$i][url]="user_list.php";
$kaffakarma_menu[$i][usertype] = USERTYPE_ADMIN;
$kaffakarma_menu[$i][submenu] = "";
$i++;


$kaffakarma_menu[$i][caption] = "Item Search";
$kaffakarma_menu[$i][url]="item_search.php"; 
$kaffakarma_menu[$i][usertype] = USERTYPE_ADMIN;
$kaffakarma_menu[$i][submenu] = "";
$i++;

$kaffakarma_menu[$i][caption] = "Add Item";
$kaffakarma_menu[$i][url]="item.php"; 
$kaffakarma_menu[$i][usertype] = USERTYPE_ADMIN;
$kaffakarma_menu[$i][submenu] = "";
$i++;



GLOBAL $sales_menu_admin;

$sales_menu_admin[$i][caption] = "Cash Sale";
$sales_menu_admin[$i][url]="cash_sale.php";
$sales_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$sales_menu_admin[$i][submenu] = "";
$i++;


$sales_menu_admin[$i][caption] = "Carity Fundus";
$sales_menu_admin[$i][url]="#";
$sales_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$sales_menu_admin[$i][submenu] = "";
$i++;

GLOBAL $reports_menu_admin;

$reports_menu_admin[$i][caption] = "Cash Sale list";
$reports_menu_admin[$i][url]="#";
$reports_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$reports_menu_admin[$i][submenu] = "";
$i++;

$reports_menu_admin[$i][caption] = "Online Sale List";
$reports_menu_admin[$i][url]="#";
$reports_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$reports_menu_admin[$i][submenu] = "";
$i++;

$reports_menu_admin[$i][caption] = "Online Sale  Pending";
$reports_menu_admin[$i][url]="#";
$reports_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$reports_menu_admin[$i][submenu] = "";
$i++;



?>

