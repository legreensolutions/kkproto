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

    function validate_item(){
        error = "";
        frm = document.getElementById("frmItem");
        if(Trim(frm.txtname.value) == ""){
           error += "<?php echo $MSG_empty_name ?>\n";
        }

        if(Trim(frm.txtdescription.value) == ""){
           error += "<?php echo $MSG_empty_description ?>\n";
        }

        if ( error != "" ){
            alert(error);
            return false;
        }
        else{
            return true;
        }
    }
    function confirm_delete(){
    var ans = confirm("This will delete item Permanently");
    if ( ans == true )
        return true;
    else
        return false;
    }
    -->
