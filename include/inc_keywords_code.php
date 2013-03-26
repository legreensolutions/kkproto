<?php

	$page_headding = "Prohibited Words";
	$int_id =-1;

	if(isset($_POST["h_id"]) && $_POST["h_id"] != "" && $_POST["submit"] == 'Update Prohibited Words' && $_POST["h_wordinfo"] == md5("WORD_INFO") ){
		$int_id = $_POST["h_id"];
	
		if ($int_id == -1) {
			$strSQL = "INSERT INTO keywords (words) ";
			$strSQL .= "VALUES ('" . $_POST["txt_words"]. "')";
			$result = mysql_query($strSQL, $myconnection) or die (mysql_error() . $strSQL);
			
			
		}else {
			$strSQL = "UPDATE keywords ";
			$strSQL .= "SET words = '" . $_POST["txt_words"] . "' ";
			$strSQL .= "WHERE id = '" . $int_id."'";
			$result = mysql_query($strSQL, $myconnection) or die (mysql_error() . $strSQL);
		}
		$error_msg = "Prohibited Words Updated";
	}

		$strSQL = "SELECT * FROM keywords ORDER BY id DESC";
		$result1 = mysql_query($strSQL, $myconnection)or die (mysql_error() . $strSQL);
		if (mysql_num_rows($result1) > 0) {
			$row_words = mysql_fetch_assoc($result1);
			$strwords =stripcslashes($row_words["words"]);
			$int_id = $row_words["id"];
		}else{
			$strwords ="";
			$int_id = -1;
		}

 ?>
