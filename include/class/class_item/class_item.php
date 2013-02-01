<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Item {
    var $connection;
    var $id = gINVALID;
    var $name = "";
    var $description = "";
    var $item_status_id = -1;
    var $item_type_id = -1;
    var $image = "";
    var $keywords = "";
    var $unit_price = 0.00;
    var $tax_item = 0.00;
    var $tax_shipping = 0.00;


    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT id,name FROM items WHERE name = '".$this->name."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->description = mysql_result($rsRES,0,'description');
        $this->item_status_id = mysql_result($rsRES,0,'item_status_id');
        $this->item_type_id = mysql_result($rsRES,0,'item_type_id');
        $this->image = mysql_result($rsRES,0,'image');
        $this->keywords = mysql_result($rsRES,0,'keywords');
        $this->unit_price = mysql_result($rsRES,0,'unit_price');
        $this->tax_item = mysql_result($rsRES,0,'tax_item');
        $this->tax_shipping = mysql_result($rsRES,0,'tax_shipping');

        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This items doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT id,name,description FROM items WHERE id = '".$this->id."'";
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
    $strSQL = "INSERT INTO items (name, description) VALUES ('";
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
    $strSQL = "UPDATE items SET name = '".addslashes(trim($this->name))."',";
    $strSQL .= "description = '".addslashes(trim($this->description))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this items";
                return false;
            }
    }
}

function get_list_array(){
        $itemss = array();$i=0;
        $strSQL = "SELECT id,name,description FROM items ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$name,$description) = mysql_fetch_row($rsRES) ){
                $itemss[$i]["id"] =  $id;
                $itemss[$i]["name"] = $name;
                $itemss[$i]["description"] = $description;
                $i++;
            }
            return $itemss;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list itemss";
        return false;
        }
}

function get_list_array_bylimit($id=-1,$name="", $description="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT id,name,description FROM items WHERE 1 ";
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
        $strSQL = " DELETE FROM items WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this items";
            return  false;
        }
    }
}
}


?>












?>
