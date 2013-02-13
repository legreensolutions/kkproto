<?php

	$mesg = "";
	$error_mesg = "";

    $mystate = new State($myconnection);
    $mystate->connection = $myconnection;
    $chk_state = $mystate->get_list_array_canada_and_us();



    $mycountry = new Country($myconnection);
    $mycountry->connection = $myconnection;
    $chk_country = $mycountry->get_list_array();

    $Mypagination = new Pagination(20);

    $mybusiness = new Business($myconnection);
    $mybusiness->connection = $myconnection;
    $chk = $mybusiness->get_list_array();

    //for pagination
    $mybusiness->total_records = $Mypagination->total_records;
	
	if (isset($_POST) && $_POST['h_feedback'] == md5("feedback")) {
		$period = 7; //  days
		$check_date = mktime(0,0,0,date("m"),date("d")-$period, date("Y"));
		$check_date = date("Y-m-d H:m:s",$check_date); 
		

        $check_existing = $mybusiness->get_list_array_bylimit(-1, "", "","",$check_date,$_SERVER['REMOTE_ADDR'], $Mypagination->start_record,$Mypagination->max_records);
        
        if ( $check_existing != false ){
            $_SESSION[SESSION_TITLE.'flash'] = "Thank You! We have already received your request and someone will contact you soon";
            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
            header( "Location: gfwflash.php");
            exit();
        }

		if (trim($_POST[txtphone])=="") {
			$error_mesg = "Phone Number cannot be empty<br>";
		}
		if (trim($_POST[txtemail])=="") {
			$error_mesg = "Email  cannot be empty<br>".$error_mesg;
		}
		if (trim($_POST[txtname])=="") {
			$error_mesg = "Name cannot be empty<br>".$error_mesg;
		}
		
		if (trim($error_mesg)=="") {
			$strTo_F =EMAIL_NO_REPLY;
			$strFrom = EMAIL_INFO;
			$strState = "None";
			$strContent = "None";
			if ($_POST[lststate]!=-1) {
				$strState = $_POST[lststate];
			}
			if (trim($_POST[txtcontent])!=""){
				$strContent = $_POST[txtcontent];
			}
			
			$strSubject="Contact request from ".$_POST[txtname];
			
			$strMailbody  = " Comments or Questions     :: ".$strContent." <br/><br/>";
			$strMailbody .= " Name       :: ".$_POST[txtname]." <br/>";
			$strMailbody .= " Phone       :: ".$_POST[txtphone]." <br/>";
			$strMailbody .= " Day       :: ".$_POST[lstday]." <br/>";
			$strMailbody .= " Time       :: ".$_POST[lsttime]." <br/>";
			$strMailbody .= " Time Zone   :: ".$_POST[lsttime_zone]." <br/><br/>";
			$strMailbody .= " State/Province       :: ".$strState." <br>";
			$strMailbody .= " Country     :: ".$_POST[lstcountry]." <br><br>";
			$strMailbody .= " Email       :: ".$_POST[txtemail]." <br>";

			//Set the headers
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Additional headers
			//$headers .= "To: Sales<".$strTo_F.">\r\n";
			$headers .= 'From: '.$_POST[txtname].'<'.$strFrom.'>'."\r\n";	   
			$headers .= 'Reply-To: <'.$_POST[txtemail].'>'."\r\n";
			
			mail($strTo_F,$strSubject,stripslashes($strMailbody),$headers);
			


            $mybusiness->id = gINVALID;
            $mybusiness->user_id = 0;
            $mybusiness->name = $_POST[txtname];
            $mybusiness->phone = $_POST[txtphone];
            $mybusiness->day = $_POST[lstday];
            $mybusiness->time = $_POST[lsttime];
            $mybusiness->time_zone = $_POST[lsttime_zone];
            $mybusiness->state = $_POST[lststate];
            $mybusiness->country = $_POST[lstcountry];
            $mybusiness->email = $_POST[txtemail];
            $mybusiness->comments = $strContent;
            $mybusiness->ipaddress = $_SERVER['REMOTE_ADDR'];

            $chk = $mybusiness->update();
            if ($chk == true){
                $_SESSION[SESSION_TITLE.'flash'] = " Thank you for contacting us.<br/><br/>We will be in touch soon and we look forward to speaking with you.";
                $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
                header( "Location: gfwflash.php");
                exit();
            }elseif ($chk == false){
                $_SESSION[SESSION_TITLE.'flash'] = "<strong>Unable to send information, Please Try Later.</strong><br/>";
                $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "contactus.php";
                header( "Location: gfwflash.php");
                exit();
            }

		}else{
                $_SESSION[SESSION_TITLE.'flash'] = "<strong>Please correct the following errors to submit the Contact us form.</strong><br/>".$error_mesg;
                $_SESSION[SESSION_TITLE.'flash_redirect_page'] = "contactus.php";
                header( "Location: gfwflash.php");
                exit();
		}
	}

?>

