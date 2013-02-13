function Trim(inputString) {
	while (1) {
		if (inputString.substring(0, 1) != " ")
			break;
		inputString = inputString.substring(1, inputString.length);
	}
	while (1) {
		if (inputString.substring(inputString.length - 1, inputString.length) != " ")
			break;
		inputString = inputString.substring(0, inputString.length - 1);
	}
	return inputString;
}

// form object validations
function validate_me(myform) {
	var strERR = "";
	var objFocus;	
	var phone_exp = /^([\d\(])+([-\s]?[\).\d\(.\)]*)+(\d)+$/;
	
	if (Trim(myform.txtphone.value) == "" ){
		strERR = " -- Phone Number can\'t be empty\n"+ strERR; 
		objFocus = myform.txtphone; 
	}
	else if (!(phone_exp.test(Trim(myform.txtphone.value))))  {
		strERR = " -- Invalid Phone Number\n"+ strERR; 
		objFocus = myform.txtphone;
	}
	if (Trim(myform.txtemail.value) == ""){ 
		strERR = " -- Email cannot be empty\n" + strERR;
		objFocus = myform.txtemail;
	}
	else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(myform.txtemail.value))) {
		strERR = " -- You must enter a valid email address\n" + strERR;
		objFocus = myform.txtemail;
	}
	if (Trim(myform.txtname.value) == ""){ 
		strERR = " -- Name cannot be empty\n" + strERR;
		objFocus = myform.txtname;
	}
	
	if (strERR == "") {
		return (true);
	}
	else {
		strERR = "Please correct the following errors\n" + strERR;
		alert(strERR);
		objFocus.focus();
		return (false);
	}
}
