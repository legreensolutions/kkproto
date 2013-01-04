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

GLOBAL $g_msg_unauthorized_request;
$g_msg_unauthorized_request = "<strong>Unauthorized Page Request</strong><br/> <br/> You are not authorized to access this page. This attempt will be reported to the system Administrator. ";

GLOBAL $g_msg_unauthorized_request_redirect_page;
$g_msg_unauthorized_request_redirect_page = "index.php";

?>
