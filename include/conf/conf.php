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

//User ITEM Status
define("USER_ITEM_ACTIVE", 1);
define("USER_ITEM_INACTIVE", 2);

//Payment Options
define("CASH_PAYMENT", 1);
define("PAYPAL_PAYMENT", 2);
$g_paymentoptions[1] = "Cash Payment";
$g_paymentoptions[2] = "Paypal";

//Payment STATUS
define("PAYMENT_PENDING", 1);
define("PAID", 2);
$g_paymentstatuses[1] = "Payment Pending";
$g_paymentstatuses[2] = "Paid";

// ORDER Status
define("ORDER_APPROVED", 1);
define("ORDER_BILLED", 2);
define("ORDER_SHIPPED", 3);
define("ORDER_DELIVERED", 4);
define("ORDER_CANCELLED", 5);
define("ORDER_REJECTED", 6);
$g_orderstatuses[1] = "Approved";
$g_orderstatuses[2] = "Billed";
$g_orderstatuses[3] = "Shipped";
$g_orderstatuses[4] = "Delivered";
$g_orderstatuses[5] = "Cancelled";
$g_orderstatuses[6] = "Rejected";
// BILL Status
define("BILLED", 1);
define("BILL_CANCELLED", 2);
$g_billstatus[1] = "Billed";
$g_billstatus[2] = "Bill Cancelled";

// shipping Status
define("SHIPPING", 1);
define("NO_SHIPPING", 2);
$g_shipping[1] = "Shipping";
$g_shipping[2] = "No Shipping";


GLOBAL $g_msg_unauthorized_request;
$g_msg_unauthorized_request = "<strong>Unauthorized Page Request</strong><br/> <br/> You are not authorized to access this page. This attempt will be reported to the system Administrator. ";

GLOBAL $g_msg_unauthorized_request_redirect_page;
$g_msg_unauthorized_request_redirect_page = "index.php";



//Email 
define("EMAIL_NO_REPLY", "noreply@kaffakarma.local");
define("EMAIL_INFO", "noreply@kaffakarma.local");
define("EMAIL_SUPPORT", "noreply@kaffakarma.local");


define("WEB_URL", "http://kaffakarma.local");
define("SUBSITE_WEB_URL", "http://kaffakarma.local/subsite");
define("WEB_NAME", "kaffakarma.local");
define("ORG_NAME", "Kaffakarma");


//paypal
 define("PAYPAL_URL", 'https://www.sandbox.paypal.com/cgi-bin/webscr');
//define("PAYPAL_URL", 'https://www.paypal.com/cgi-bin/webscr');

 define("PAYPAL_BUSINESS_ACCOUNT", 'business-test@kaffakarma.com');
//define("PAYPAL_BUSINESS_ACCOUNT", 'admin@kaffakarma.com');

 define("PAYPAL_RETURN_URL", 'http://kaffakarma.legreensolutions.com/paypal.php');
//define("PAYPAL_RETURN_URL", 'http://kaffakarma.com/paypal.php');


?>
