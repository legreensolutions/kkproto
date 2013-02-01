<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class ItemType {
    var $connection;
    var $id = gINVALID;
    var $name = "";
    var $description = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT id,name FROM itemtypes WHERE name = '".$this->name."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This ItemType doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT id,name,description FROM itemtypes WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->description = mysql_result($rsRES,0,'description');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO itemtypes (name, description) VALUES ('";
    $strSQL .= addslashes(trim($this->name)) ."','";
    $strSQL .= addslashes(trim($this->description)) ."')";
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
    $strSQL = "UPDATE itemtypes SET name = '".addslashes(trim($this->name))."',";
    $strSQL .= "description = '".addslashes(trim($this->description))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this ItemType";
                return false;
            }
    }
}

function get_list_array(){
        $itemtypes = array();$i=0;
        $strSQL = "SELECT id,name,description FROM itemtypes ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$name,$description) = mysql_fetch_row($rsRES) ){
                $itemtypes[$i]["id"] =  $id;
                $itemtypes[$i]["name"] = $name;
                $itemtypes[$i]["description"] = $description;
                $i++;
            }
            return $itemtypes;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list ItemType";
        return false;
        }
}

function get_list_array_bylimit($id=-1,$name="", $description="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT id,name,description FROM itemtypes WHERE 1 ";
        if ( $id != "" && $id != -1 ) {
            if (trim($str_condition) =="") {
                $str_condition = "  id  = '" . $id . "'" ;
            }else{
                $str_condition .= " AND id  = '" . $id . "'" ;
            } 
        }


        if ( $name != "" ) {
            if (trim($str_condition) =="") {
                $str_condition = "  name  LIKE '%" . $name . "%'" ;
            }else{
                $str_condition .= " AND name  LIKE '%" . $name . "%'" ;
            } 
        }


        if ( $description != "" ) {
            if (trim($str_condition) =="") {
                $str_condition = "  description  LIKE '%" . $description . "%'" ;
            }else{
                $str_condition .= " AND description  LIKE '%" . $description . "%'" ;
            } 
        }


        if (trim($str_condition) !="") {
            $strSQL .= " AND  " . $str_condition . "  ";
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
                $limited_data[$i]["description"] = $row["description"];
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
        $strSQL = " DELETE FROM itemtypes WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this ItemType";
            return  false;
        }
    }
}
}


?>
