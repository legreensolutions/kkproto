<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Business {
    var $connection;
    var $id = gINVALID;
    var $name = "";
    var $user_id= gINVALID;
    var $phone= "";
    var $day= "";
    var $time= "";
    var $time_zone= "";
    var $state= "";
    var $country= "";
    var $email= "";
    var $comments= "";
    var $date= "Now()";
    var $ipaddress = "";


    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";


function get_detail(){
    $strSQL = "SELECT B.id, B.name, B.user_id, B.phone, B.day, B.time, B.time_zone, B.state, B.country, B.email, B.comments, B.date, B.ipaddress FROM business B WHERE B.id = ". addslashes(trim($this->id))."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->user_id = mysql_result($rsRES,0,'user_id');
        $this->phone = mysql_result($rsRES,0,'phone');
        $this->day = mysql_result($rsRES,0,'day');
        $this->time = mysql_result($rsRES,0,'time');
        $this->time_zone = mysql_result($rsRES,0,'time_zone');
        $this->state = mysql_result($rsRES,0,'state');
        $this->country = mysql_result($rsRES,0,'country');
        $this->email = mysql_result($rsRES,0,'email');
        $this->comments = mysql_result($rsRES,0,'comments');
        $this->date = mysql_result($rsRES,0,'date');
        $this->ipaddress = mysql_result($rsRES,0,'ipaddress');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO business (name, user_id, phone, day, time, time_zone, state, country, email, comments, date, ipaddress) VALUES ('";
    $strSQL .= addslashes(trim($this->name)) ."','";
    $strSQL .= addslashes(trim($this->user_id)) ."','";
    $strSQL .= addslashes(trim($this->phone)) ."','";
    $strSQL .= addslashes(trim($this->day)) ."','";
    $strSQL .= addslashes(trim($this->time)) ."','";
    $strSQL .= addslashes(trim($this->time_zone)) ."','";
    $strSQL .= addslashes(trim($this->state)) ."','";
    $strSQL .= addslashes(trim($this->country)) ."','";
    $strSQL .= addslashes(trim($this->email)) ."','";
    $strSQL .= addslashes(trim($this->comments)) ."',";
    $strSQL .= addslashes(trim($this->date)) .",'";
    $strSQL .= addslashes(trim($this->ipaddress)) ."')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this name";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE business SET name = '".addslashes(trim($this->name))."',";
    $strSQL .= "user_id = '".addslashes(trim($this->user_id))."'";
    $strSQL .= "phone = '".addslashes(trim($this->phone))."'";
    $strSQL .= "day = '".addslashes(trim($this->day))."'";
    $strSQL .= "time = '".addslashes(trim($this->time))."'";
    $strSQL .= "time_zone = '".addslashes(trim($this->time_zone))."'";
    $strSQL .= "state = '".addslashes(trim($this->state))."'";
    $strSQL .= "country = '".addslashes(trim($this->country))."'";
    $strSQL .= "email = '".addslashes(trim($this->email))."'";
    $strSQL .= "comments = '".addslashes(trim($this->comments))."'";
    $strSQL .= "date = '".addslashes(trim($this->date))."'";
    $strSQL .= "ipaddress = '".addslashes(trim($this->ipaddress))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Information";
                return false;
            }
    }
}

function get_list_array(){
        $business = array();$i=0;
        $strSQL = "SELECT B.id, B.name, B.user_id, B.phone, B.day, B.time, B.time_zone, B.state, B.country, B.email, B.comments, B.date, B.ipaddress FROM business B ";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id, $name, $user_id, $phone, $day, $time, $time_zone, $state, $country, $email, $comments, $date, $ipaddress) = mysql_fetch_row($rsRES) ){
                $business[$i]["id"] =  $id;
                $business[$i]["name"] = $name;
                $business[$i]["user_id"] = $user_id;
                $business[$i]["phone"] = $phone;
                $business[$i]["day"] = $day;
                $business[$i]["time"] = $time;
                $business[$i]["time_zone"] = $time_zone;
                $business[$i]["state"] = $state;
                $business[$i]["country"] = $country;
                $business[$i]["email"] = $email;
                $business[$i]["comments"] = $comments;
                $business[$i]["date"] = $date;
                $business[$i]["ipaddress"] = $ipaddress;
                $i++;
            }
            return $business;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Information";
        return false;
        }
}

function get_list_array_bylimit($id=-1,$name="", $phone="", $email="", $date= "", $ipaddress="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT B.id, B.name, B.user_id, B.phone, B.day, B.time, B.time_zone, B.state, B.country, B.email, B.comments, B.date, B.ipaddress FROM business B WHERE 1 ";

        if ( $id != "" && $id != -1 ) {
            $str_condition .= " AND id  = '" . $id . "'" ;
        }


        if ( $name != "" ) {
            $str_condition .= " AND B.name  LIKE '%" . $name . "%'" ;
        }


        if ( $phone != "" ) {
            $str_condition .= " AND phone  LIKE '%" . $phone . "%'" ;
        }

        if ( $email != "" ) {
            $str_condition .= " AND email  LIKE '%" . $email . "%'" ;
        }

        if ( $date != "" ) {
            $str_condition .= " AND date  >= '" . $date . "'" ;
        }

        if ( $ipaddress != "" ) {
            $str_condition .= " AND ipaddress  = '" . $ipaddress . "'" ;
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
                $limited_data[$i]["name"] = $row["name"];
                $limited_data[$i]["user_id"] = $row["user_id"];
                $limited_data[$i]["phone"] = $row["phone"];
                $limited_data[$i]["day"] = $row["day"];
                $limited_data[$i]["time"] = $row["time"];
                $limited_data[$i]["time_zone"] = $row["time_zone"];
                $limited_data[$i]["state"] = $row["state"];
                $limited_data[$i]["country"] = $row["country"];
                $limited_data[$i]["email"] = $row["email"];
                $limited_data[$i]["comments"] = $row["comments"];
                $limited_data[$i]["date"] = $row["date"];
                $limited_data[$i]["ipaddress"] = $row["ipaddress"];
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
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM business WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this Information";
            return  false;
        }
    }
}
}


?>
