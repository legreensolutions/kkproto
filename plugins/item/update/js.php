<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>
    <!--
function Trim(strInput) {
while (true) {
    if (strInput.substring(0, 1) != " ")
        break;
    strInput = strInput.substring(1, strInput.length);
}
while (true) {
    if (strInput.substring(strInput.length - 1, strInput.length) != " ")
        break;
    strInput = strInput.substring(0, strInput.length - 1);
}
return strInput;
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function validate_item(){
    error = "";
    frm = document.getElementById("frmItem");
    if(Trim(frm.txtname.value) == ""){
       error += "<?php echo $MSG_empty_name ?>\n";
    }

    if(Trim(frm.txtdescription.value) == ""){
       error += "<?php echo $MSG_empty_description ?>\n";
    }

    if(frm.lstitem_status_id.value==-1){
        error += "<?php echo $MSG_empty_item_status ?>\n";
    }

    if(frm.lstitem_type_id.value==-1){
        error += "<?php echo $MSG_empty_item_type ?>\n";
    }


    if(Trim(frm.txtkeywords.value) == ""){
       error += "<?php echo $MSG_empty_keywords ?>\n";
    }


    if(!isNumber(frm.txtunit_price .value)){
       error += "<?php echo $MSG_empty_unit_price ?>\n";
    }

    if(!isNumber(frm.txttax_item .value)){
       error += "<?php echo $MSG_empty_tax_item ?>\n";
    }

    if(!isNumber(frm.txttax_shipping .value)){
       error += "<?php echo $MSG_empty_tax_shipping ?>\n";
    }

    if ( error != "" ){
        alert(error);
        return false;
    }
    else{
        return true;
    }
}
function confirm_delete_image(){
var ans = confirm("This will delete Image Permanently");
if ( ans == true )
    return true;
else
    return false;
}
function confirm_delete(){
var ans = confirm("This will delete item Permanently");
if ( ans == true )
    return true;
else
    return false;
}
    -->
