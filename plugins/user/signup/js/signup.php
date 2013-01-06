$(function() {
$("#chk").click(function() {
    // getting the value that user typed
    var checkString    = $("#txtusername").val();
    // forming the queryString
    var data            = 'user='+ checkString;

    // if checkString is not empty
    if(checkString) {
        // ajax call
        $.ajax({
            type: "POST",
            url: "user_name_check.php",
            data: data,
            beforeSend: function(html) { // this happen before actual call
                $("#results").html('');
            },
            success: function(html){ // this happen after we get result
                $("#results").show();
                $("#results").append(html);
            }
        });
}
return false;
});
});

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

    function validate_signup(){
        error = "";
        frm = document.getElementById("frmsignup");
        if(frm.txtusername.value==""){
            error = "<?php echo $MSG_empty_username ?>\n";
        }
        else{
        pattern = /\w+@\w+\.\w+/;
         //pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
        result = pattern.test(Trim(frm.txtusername.value));
        if( result == false) {
           error = "<?php echo $MSG_invalid_username?>\n";
        }
        }
        if(document.getElementById("txtpasswd").value==""){
            error += "<?php echo $MSG_empty_password ?>\n";
        }
        else if(document.getElementById("txtrepasswd").value==""){
            error += "<?php echo $MSG_empty_retype_password ?>\n";
        }
        else if( document.getElementById("txtpasswd").value != document.getElementById("txtrepasswd").value ){
            error += "<?php echo $MSG_unmatching_passwords ?>\n";
        }
        else{
             pattern = /[a-zA-Z0-9_-]{5,}/;
             result = pattern.test(document.getElementById("txtpasswd").value);
             if(result == false)
             error += "<?php echo $MSG_length_password ?>\n" ;
        }
        if(frm.txtfirstname.value==""){
            error += "<?php echo $MSG_empty_firstname ?>\n";
        }
        if(frm.lstsec_que.value==-1){
            error += "<?php echo $MSG_empty_sec_que ?>\n";
        }
        else if(frm.txtsec_ans.value==""){
            error += "<?php echo $MSG_empty_sec_ans ?>\n";
        }
         if (Trim(frm.security_code.value) == "") {
              error += "<?php echo $MSG_empty_security_code ?>\n";
        }
        if ( error != "" ){
            alert(error);
            return false;
        }
        else{
            return true;
        }
    }
function createRequestObject_captcha(){
    //declare the variable to hold the object.
    var objRequest;
    //find the browser name
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer")
        objRequest = new ActiveXObject("Microsoft.XMLHTTP");
    else
        objRequest = new XMLHttpRequest();
    //return the object
    return objRequest;
}

var http_captcha = createRequestObject_captcha();

function captcha_reaload(){


//       http_captcha.open("POST", 'captcha_ajax.php?check=captcha');
         http_captcha.open("get", "plugins/user/signup/js/captcha_ajax.php");
             http_captcha.onreadystatechange = get_captcha_image;
             http_captcha.send(null);

    return false;
}

function get_captcha_image(){
    if(http_captcha.readyState == 4){ //Finished loading the response
        var response = http_captcha.responseText;
        document.getElementById("div_captcha").innerHTML=response;

    }

}
    -->

<?php /*    pattern = /^[a-zA-Z0-9_\-\.\,\:]+$/;
        if (Trim(frm.fleimage.value) != "") {
        result = pattern.test(Trim(frm.fleimage.value));
            if( result == false)
            error += "<?php echo $MSG_invalid_filename?>\n";
        }*/?>

