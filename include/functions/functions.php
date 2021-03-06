<?php 
// Function to populate values in a dropdown list
function populatelist ($lstname, $str_query, $str_firstvalue="-1", $str_firstoption = "", $str_selected = "", $bln_disabled = false, $str_event = "", $str_style = "") {

    $rsRES = mysql_query($str_query) or die (mysql_error() . $str_query);
    $str_disable = "";
    if ($bln_disabled == true){
        $str_disable = "disabled";
    }
    echo '<select name="' . $lstname . '" id="' . $lstname . '"' . $str_disable . ' ' . $str_event .  ' ' . $str_style . '>';
    if ( trim($str_firstoption) != "" && is_null($str_firstoption) == false ) {
        if ( $str_selected == $str_firstvalue ) {
            echo '<option selected="selected" value="' . $str_firstvalue . '">';
            echo $str_firstoption;
            echo '"';
        }
        else {
            echo '<option value="' . $str_firstvalue . '">' . $str_firstoption . '"';
        }
    }
    while ($arrRES = mysql_fetch_array($rsRES)) {
        if ( $str_selected == $arrRES[0] ) {
            echo '<option selected="selected" value="' . $arrRES[0] . '">';
            echo $arrRES[1];
            echo '"';
        }
        else {
            echo '<option value="' . $arrRES[0] . '">' . $arrRES[1] . '"';
        }
    }
    echo '</select>';
}


function populate_list_array($objname, $array_list, $value_array, $display_array, $defaultvalue=-1,$disable=false, $style=""){ 
// function used to populate list from associative array  
GLOBAL $g_obj_select_default_text;
?>	
<select  name="<?php echo $objname; ?>"  id="<?php echo $objname; ?>" <?php if ($disable == true){?> disabled="true"<?php } ?> <?php echo $style; ?> >
	<option selected="selected" value="-1"><?php echo $g_obj_select_default_text ?></option>
	<?php foreach ($array_list as $value) { ?><option <?php if( $defaultvalue == $value[$value_array]){ ?> selected="selected"<?php } ?> value="<?php echo $value[$value_array]; ?>"><?php echo $value[$display_array]; ?></option>
	<?php } //--end for ?>

</select>
	
<?php }	


function loadlanguage($lstname, $firstvalue=-1, $firstoption="Select Language", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, language_name FROM  languages WHERE publish='".CONF_PUBLISH."' ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}


function loadlanguage_admin($lstname, $firstvalue=-1, $firstoption="Select Language", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, language_name FROM  languages ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}


function loadconfigurationtypes($lstname, $firstvalue=-1, $firstoption="Select Configuration Type", $selectedvalue,$disable=false, $strevent="" ){
    $query = "SELECT id, configurationtype_name FROM  configurationtypes ORDER BY id" ;
    populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
}


// function loadstate($lstname, $firstvalue=-1, $firstoption="Select state", $selectedvalue, $strevent="" ,$disable=false){
//     $query = "SELECT id, state_name FROM  states ORDER BY id" ;
//     populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
// }
// 
// 
// function loadcountry($lstname, $firstvalue=-1, $firstoption="Select Country", $selectedvalue=-1, $disable=false, $jsevent="", $style=""){
//     $strSQL = "SELECT id, country FROM  countries ORDER BY country";
//     populatelist ($lstname, $strSQL, $firstvalue, $firstoption, $selectedvalue, $disable, $jsevent, $style);
// }
// 	
// 	
// function loadusertype($lstname, $firstvalue=-1, $firstoption="Select usertype", $selectedvalue, $strevent="" ,$disable=false){
//     $query = "SELECT id, usertype_name FROM  usertypes ORDER BY id" ;
//     populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
// }
// function loaduserstatus($lstname, $firstvalue=-1, $firstoption="Select userstatus", $selectedvalue, $strevent="" ,$disable=false){
//     $query = "SELECT id, userstatus_name FROM  userstatuses ORDER BY id" ;
//     populatelist ($lstname, $query, $firstvalue, $firstoption, $selectedvalue, $disable,$strevent);
// }




function get_filenames($dir_name,$ext="",$file_end_with="",$from_dir="",$recur=false){

$files = array();
$i = 0;
$dirs = dir ($dir_name);
if ( $i == NULL ) {$i = 0;}
$j=0;$k=0;
while ( ( $file = $dirs->read() ) != false ){
    //For recursive calling in the case of subdirectories
    if ( is_dir($dir_name."/".$file) && $recur == true ) {
            //to avoid parent dirs
            if( $file == "." || $file == ".." ){
            }
            else{

							$subfiles = get_filenames($dir_name."/".$file,$ext,$file_end_with,$from_dir,$recur);
							$files = array_merge($files,$subfiles);
							$i = sizeof($files);

				}
    }
    //
    else{
		$ext1 = explode('.', $file);

		$curr_dir = explode('/', $dir_name);
		$curr_dir = $curr_dir[count($curr_dir)-1];
	
		if($from_dir !="" ){
			if($curr_dir==$from_dir){

				if ( $ext != "" && $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$ext1 = $ext1[count($ext1)-1];
									if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
							}
				}
				elseif ( $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$files[$i] = $dir_name."/".$file; $i++;
							}
				}
				elseif ( $ext != "" ){
								$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
				}
				else{
					$files[$i] = $file; $i++;
				}
		
				}
			}else{
	
		
				if ( $ext != "" && $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
							}
				}
				elseif ( $file_end_with !="" ){
							if ( stristr($ext1[0],$file_end_with) != false ){
									$files[$i] = $dir_name."/".$file; $i++;
							}
				}
				elseif ( $ext != "" ){
								$ext1 = $ext1[count($ext1)-1];
								if (strcasecmp($ext,$ext1) == 0){
									$files[$i] = $dir_name."/".$file; $i++;
								}
				}
				else{
					$files[$i] = $file; $i++;
				}
		
	
		}




    }
}


$dirs->close();

return $files;
}



function generate_language_links($admin_check=false){ 
    GLOBAL $myconnection;
	if($admin_check==false){
		$query = "SELECT id, language_name FROM  languages WHERE publish='".CONF_PUBLISH."' ORDER BY id" ;
	}else{
		$query = "SELECT id, language_name FROM  languages ORDER BY id" ;
	}
    $rsRES = mysql_query($query) or die (mysql_error() . $query);
		if(mysql_num_rows($rsRES)==0){
// 			$this->debug_output.="From Function  generate_language_links :: No language is Published. <br/>";
		}else{
			while ($arrRES = mysql_fetch_array($rsRES)) {
				if($arrRES['id']== $_SESSION[SESSION_TITLE.'gLANGUAGE']){
					echo '&nbsp;'.$arrRES['language_name'].'&nbsp;';
				}else{
					echo '&nbsp;<a href="set_language.php?h_c='.md5("CONF_LANG").'&lang='.$arrRES['id'].'&url='.$_SERVER['REQUEST_URI'].' " >'.$arrRES['language_name'].'</a>&nbsp;';
				}
			}
			echo "&nbsp;&nbsp;&nbsp;";
		}

  }





function time_array (){
$time_array = array();$i=0;
	/* -- Time Range 12:00 AM - 11:00 PM -- */
    $time_array[$i]["time"] = "12:00 AM"; 
    $i++;
	for ( $i=1; $i <= 11; $i++) {
		$time_array[$i]["time"] =  $i . ":00 AM"; 
	}
	$time_array[$i]["time"] = "12:00 PM"; 
    $i++;
	for ( $i=13; $i <= 23; $i++) {
		$time_array[$i]["time"]  = ($i%12) . ":00 PM";
	}
  return $time_array;
}
 


function weekdays_array (){
$weekdays_array = array();$i=0;
    $weekdays_array[$i]["day"] = "Sunday"; $i++;
    $weekdays_array[$i]["day"] = "Monday"; $i++;
    $weekdays_array[$i]["day"] = "Tuesday"; $i++;
    $weekdays_array[$i]["day"] = "Wednesday"; $i++;
    $weekdays_array[$i]["day"] = "Thursday"; $i++;
    $weekdays_array[$i]["day"] = "Friday"; $i++;
    $weekdays_array[$i]["day"] = "Saturday"; $i++;
return $weekdays_array;
}
 
function time_zone_array (){
$time_zone_array = array();$i=0;
    $time_zone_array[$i]["zone"] = "Pacific Standard Time (PST)"; $i++;
    $time_zone_array[$i]["zone"] = "Mountain Standard Time (MST)"; $i++;
    $time_zone_array[$i]["zone"] = "Central Standard Time (CST)"; $i++;
    $time_zone_array[$i]["zone"] = "Eastern Standard Time(EST)"; $i++;
    $time_zone_array[$i]["zone"] = "Atlantic Standard Time (AST)"; $i++;
    $time_zone_array[$i]["zone"] = "Other Time Zones"; $i++;
return $time_zone_array;
}


?>
