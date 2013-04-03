<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Customer {
    var $connection;
    var $id = gINVALID;
    var $first_name;
    var $last_name;
    var $address;
    var $street = "";
    var $city = "";
    var $state_id = gINVALID;
    var $country_id = gINVALID;
    var $postal_code = "";
    var $emailid = "";
    var $phone = "";
    var $ipaddress = "";
    var $gender_id = gINVALID;
    var $registrationdate = "";
    var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

    function Customer ( $id=gINVALID, $first_name="", $last_name="", $address="", $street="", $city="", $state_id=gINVALID, $country_id=gINVALID, $postal_code = "", $emailid = "", $phone = "", $ipaddress ="", $gender_id = gINVALID, $connection="" ){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->street = $street;
        $this->city = $city;
        $this->state_id = $state_id;
        $this->country_id = $country_id;
        $this->postal_code = $postal_code;
        $this->emailid = $emailid;
        $this->phone = $phone;
        $this->ipaddress = $ipaddress;
        $this->gender_id = $gender_id;

        $this->connection=$connection;

    }



    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
              $strSQL = "INSERT INTO customers  (first_name, last_name, address, street, city, state_id, country_id, postal_code, emailid, phone, registrationdate, ipaddress, gender_id) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->first_name))."','";
              $strSQL .= addslashes(trim($this->last_name))."','";
              $strSQL .= addslashes(trim($this->address))."','";
              $strSQL .= addslashes(trim($this->street))."','";
              $strSQL .= addslashes(trim($this->city))."','";
              $strSQL .= addslashes(trim($this->state_id))."','";
              $strSQL .= addslashes(trim($this->country_id))."','";
              $strSQL .= addslashes(trim($this->postal_code))."','";
              $strSQL .= addslashes(trim($this->emailid))."','";
              $strSQL .= addslashes(trim($this->phone))."',";
              $strSQL .= "now(),'";
              $strSQL .= $_SERVER['REMOTE_ADDR']."','";
              $strSQL .= addslashes(trim($this->gender_id))."')";
              $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();;
                    return true;
              }
              else{
                $this->error_description = "Registration Failed";
                return false;
              }

        }
        elseif($this->id > 0 ) {
            $strSQL = "UPDATE customers SET ";
            $strSQL .= "first_name = '".addslashes(trim($this->first_name))."',";
            $strSQL .= "last_name = '".addslashes(trim($this->last_name))."',";
            $strSQL .= "address = '".addslashes(trim($this->address))."',";
            $strSQL .= "street = '".addslashes(trim($this->street))."',";
            $strSQL .= "city = '".addslashes(trim($this->city))."',";
            $strSQL .= "state_id = '".addslashes(trim($this->state_id))."',";
            $strSQL .= "country_id = '".addslashes(trim($this->country_id))."',";
            $strSQL .= "postal_code = '".addslashes(trim($this->postal_code))."',";
            $strSQL .= "emailid = '".addslashes(trim($this->emailid))."',";
            $strSQL .= "phone = '".addslashes(trim($this->phone))."',";
            $strSQL .= "ipaddress = '".$_SERVER['REMOTE_ADDR']."',";
            $strSQL .= "gender_id = '".addslashes(trim($this->gender_id))."',";
            $strSQL .= " WHERE id = ".$this->id;//$this->id
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Customer Update Failed";
                return false;
            }
        }

    }



    function get_detail(){
        $strSQL = "SELECT * FROM customers WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->first_name = mysql_result($rsRES,0,'first_name');
                $this->last_name = mysql_result($rsRES,0,'last_name');
                $this->address = mysql_result($rsRES,0,'address');
                $this->street = mysql_result($rsRES,0,'street');
                $this->city = mysql_result($rsRES,0,'city');
                $this->state_id = mysql_result($rsRES,0,'state_id');
                $this->country_id = mysql_result($rsRES,0,'country_id');
                $this->postal_code = mysql_result($rsRES,0,'postal_code');
                $this->emailid = mysql_result($rsRES,0,'emailid');
                $this->phone = mysql_result($rsRES,0,'phone');
                $this->ipaddress = mysql_result($rsRES,0,'ipaddress');
                $this->registrationdate = mysql_result($rsRES,0,'registrationdate');
                $this->gender_id = mysql_result($rsRES,0,'gender_id');
                return true;
        }
        else{
            return false;
        }
    }


    function get_list_array(){
            $customers = array();$i=0;
            $strSQL = "SELECT id, first_name, last_name, address, street, city, state_id, country_id, postal_code, emailid, phone, ipaddress, gender_id, registrationdate FROM customers ORDER BY id";
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_num_rows($rsRES) > 0 ){
                while ( list ($id, $first_name, $last_name, $address, $street, $city, $state_id, $country_id, $postal_code, $emailid, $phone, $ipaddress, $gender_id, $registrationdate ) = mysql_fetch_row($rsRES) ){
                    $customers[$i]["id"] =  $id;
                    $customers[$i]["first_name"] = $first_name;
                    $customers[$i]["last_name"] = $last_name;
                    $customers[$i]["address"] = $address;
                    $customers[$i]["street"] = $street;
                    $customers[$i]["city"] = $city;
                    $customers[$i]["state_id"] = $state_id;
                    $customers[$i]["country_id"] = $country_id;
                    $customers[$i]["postal_code"] = $postal_code;
                    $customers[$i]["emailid"] = $emailid;
                    $customers[$i]["phone"] = $phone;
                    $customers[$i]["ipaddress"] = $ipaddress;
                    $customers[$i]["gender_id"] = $gender_id;
                    $customers[$i]["registrationdate"] = $registrationdate;
                    $i++;
                }
                return $customers;
            }else{
            $this->error_number = 4;
            $this->error_description="Can't list Customer";
            return false;
            }
    }


    function get_list_array_bylimit($id=-1,$first_name="", $last_name="", $address="", $street="", $city="",  $postal_code="", $emailid="", $phone="", $start_record = 0,$max_records = 25){

            $limited_data = array();
            $i=0;
            $str_condition = "";

            $strSQL = "id, first_name, last_name, address, street, city, state_id, country_id, postal_code, emailid, phone, ipaddress, gender_id, registrationdate FROM customers WHERE 1 ";
            if ( $id != "" && $id != -1 ) {
                $str_condition .= " AND id  = '" . $id . "'" ;
            }


            if ( $first_name != "" ) {
                $str_condition .= " AND first_name  LIKE '%" . $first_name . "%'" ;
            }


            if ( $last_name != "" ) {
                $str_condition .= " AND last_name  LIKE '%" . $last_name . "%'" ;
            }



            if ( $address != "" ) {
                $str_condition .= " AND address  LIKE '%" . $address . "%'" ;
            }



            if ( $street != "" ) {
                $str_condition .= " AND street  LIKE '%" . $street . "%'" ;
            }



            if ( $city != "" ) {
                $str_condition .= " AND city  LIKE '%" . $city . "%'" ;
            }



            if ( $postal_code != "" ) {
                $str_condition .= " AND postal_code  LIKE '%" . $postal_code . "%'" ;
            }




            if ( $emailid != "" ) {
                $str_condition .= " AND emailid  LIKE '%" . $emailid . "%'" ;
            }




            if ( $phone != "" ) {
                $str_condition .= " AND phone  LIKE '%" . $phone . "%'" ;
            }


            if (trim($str_condition) !="") {
                $strSQL .=  $str_condition . "  ";
            }
            $strSQL .= " ORDER BY id";
            //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
            $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
            $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

            if ( mysql_num_rows($rsRES) > 0 ){

                //without limit  , result of that in $all_rs
                if (trim($this->total_records)!="" && $this->total_records > 0) {
                    
                } else {
                    $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                    $this->total_records = mysql_num_rows($all_rs);
                }
        
                while ( $row = mysql_fetch_assoc($rsRES) ){
                    $limited_data[$i]["id"] = $row["id"];
                    $limited_data[$i]["first_name"] = $row["first_name"];
                    $limited_data[$i]["last_name"] = $row["last_name"];
                    $limited_data[$i]["address"] = $row["address"];
                    $limited_data[$i]["street"] = $row["street"];
                    $limited_data[$i]["city"] = $row["city"];
                    $limited_data[$i]["state_id"] = $row["state_id"];
                    $limited_data[$i]["country_id"] = $row["country_id"];
                    $limited_data[$i]["postal_code"] = $row["postal_code"];
                    $limited_data[$i]["emailid"] = $row["emailid"];
                    $limited_data[$i]["phone"] = $row["phone"];
                    $limited_data[$i]["ipaddress"] = $row["ipaddress"];
                    $limited_data[$i]["gender_id"] = $row["gender_id"];
                    $limited_data[$i]["registrationdate"] = $row["registrationdate"];
                    $i++;
                }
                return $limited_data;
            }else{
                $this->error_number = 5;
                $this->error_description="Can't get limited data";
                return false;
            }
    }


    function delete(){
        $strSQL = "DELETE FROM customers WHERE id =".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Can't Delete This Customer";
                return false;
            }
    }





    function get_xml(){
        if ( isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0 ) {
        echo '<?xml version="1.0" encoding="ISO-8859-1" ?>
        <root>';
        echo "<data>";
        echo "<row>";
        echo "<id>" .$this->id."</id>";
        echo "<user_name>".$this->user_name."</user_name>";
        echo "<first_name>".$this->first_name."</first_name>";
        echo "<last_name>".$this->last_name."</last_name>";
        echo "<address>".$this->address."</address>";
        echo "<street>".$this->street."</street>";
        echo "<city>".$this->city."</city>";
        echo "<state_id>".$this->state_id."</state_id>";
        echo "<country_id>".$this->country_id."</country_id>";
        echo "</row>";
        echo "</data>";
        echo "</root>";
        //return $data;
        }
        else{
        return false;
        }
    }
}
?>
