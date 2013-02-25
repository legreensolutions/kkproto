<?php

//User Types
define("USERTYPE_ADMIN", 1);
define("USERTYPE_REGISTERED_USER", 2);
define("USERTYPE_EMPLOYEE", 3);

//User Status
define("USERSTATUS_ACTIVE", 1);
define("USERSTATUS_TO_BE_ACTIVATED", 2);
define("USERSTATUS_CANCELED", 3);
define("USERSTATUS_ADMIN_CANCELED", 4);



//ITEM Types
define("ITEMTYPE_KAFFAKARMA", 1);
define("ITEMTYPE_ALL", 2);

//ITEM Status
define("ITEMSTATUS_IN_STOCK", 1);
define("ITEMSTATUS_OUT_OF_STOCK", 2);


GLOBAL $g_msg_unauthorized_request;
$g_msg_unauthorized_request = "<strong>Unauthorized Page Request</strong><br/> <br/> You are not authorized to access this page. This attempt will be reported to the system Administrator. ";

GLOBAL $g_msg_unauthorized_request_redirect_page;
$g_msg_unauthorized_request_redirect_page = "index.php";



//Email 
define("EMAIL_NO_REPLY", "noreply@kaffakarma.legreensolutions.com");
define("EMAIL_INFO", "noreply@kaffakarma.legreensolutions.com");
define("EMAIL_SUPPORT", "noreply@kaffakarma.legreensolutions.com");


define("WEB_URL", "http://kaffakarma.legreensolutions.com");
define("SUBSITE_WEB_URL", "http://kaffakarma.legreensolutions.com/subsite");
define("WEB_NAME", "kaffakarma.legreensolutions.com");
define("ORG_NAME", "Kaffakarma");
?>
