<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserItem {
    var $connection;
    var $id = gINVALID;
    var $name = "";
    var $description = "";
    var $item_status_id = gINVALID;
    var $item_status_name = "";
    var $item_type_id = gINVALID;
    var $item_type_name = "";
    var $image = "";
    var $keywords = "";
    var $unit_price = 0.00;
    var $tax_item = 0.00;
    var $tax_shipping = 0.00;

    var $user_id = gINVALID;
    var $user_price = 0.00;

    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT UI.id, I.name, I.description, I.item_status_id, I.item_type_id, I.image, I.keywords, I.unit_price, I.tax_item, I.tax_shipping, UI.user_id, UI.item_id, UI.unit_price as user_price FROM items I, useritems UI WHERE UI.item_id = I.id AND I.name = '".addslashes(trim($this->name))."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->description = mysql_result($rsRES,0,'description');
        $this->item_status_id = mysql_result($rsRES,0,'item_status_id');
        $this->item_status_name = mysql_result($rsRES,0,'item_status_name');
        $this->item_type_id = mysql_result($rsRES,0,'item_type_id');
        $this->item_type_name = mysql_result($rsRES,0,'item_type_name');
        $this->image = mysql_result($rsRES,0,'image');
        $this->keywords = mysql_result($rsRES,0,'keywords');
        $this->unit_price = mysql_result($rsRES,0,'unit_price');
        $this->tax_item = mysql_result($rsRES,0,'tax_item');
        $this->tax_shipping = mysql_result($rsRES,0,'tax_shipping');
        $this->user_id = mysql_result($rsRES,0,'user_id');
        $this->item_id = mysql_result($rsRES,0,'item_id');
        $this->user_price = mysql_result($rsRES,0,'user_price');


        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This items doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT UI.id, I.name, I.description, I.item_status_id, S.name as item_status_name, I.item_type_id, T.name as item_type_name, I.image, I.keywords, I.unit_price, I.tax_item, I.tax_shipping, , UI.user_id, UI.item_id, UI.unit_price AS user_price FROM items I,itemstatuses S, itemtypes T, useritems UI WHERE I.item_status_id = S.id AND I.item_type_id = T.id AND UI.item_id = I.id AND UI.id = '".addslashes(trim($this->id))."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->description = mysql_result($rsRES,0,'description');
        $this->item_status_id= mysql_result($rsRES,0,'item_status_id');
        $this->item_type_id= mysql_result($rsRES,0,'item_type_id');
        $this->image= mysql_result($rsRES,0,'image');
        $this->keywords= mysql_result($rsRES,0,'keywords');
        $this->unit_price= mysql_result($rsRES,0,'unit_price');
        $this->tax_item= mysql_result($rsRES,0,'tax_item');
        $this->tax_shipping= mysql_result($rsRES,0,'tax_shipping');
        $this->user_id= mysql_result($rsRES,0,'user_id');
        $this->item_id= mysql_result($rsRES,0,'item_id');
        $this->user_price= mysql_result($rsRES,0,'user_price');

        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO useritems (user_id, item_id, unit_price) VALUES ('";
    $strSQL .= addslashes(trim($this->user_id)) ."','";
    $strSQL .= addslashes(trim($this->item_id)) ."','";
    $strSQL .= addslashes(trim($this->user_price))."')";

    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this Record";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE useritems SET user_id = '".addslashes(trim($this->user_id))."',";
    $strSQL .= "item_id = '".addslashes(trim($this->item_id))."',";
    $strSQL .= "unit_price = ".addslashes(trim($this->user_price));
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Cant update this Record";
                return false;
            }
    }
}

function get_list_array(){
        $items = array();$i=0;
        $strSQL = "SELECT UI.id, I.name, I.description, I.item_status_id, S.name as item_status_name, I.item_type_id, T.name as item_type_name, I.image, I.keywords, I.unit_price, I.tax_item, I.tax_shipping , UI.user_id, UI.item_id ,UI.unit_price AS user_price FROM items I,itemstatuses S, itemtypes T, useritems UI WHERE I.item_status_id = S.id AND I.item_type_id = T.id AND UI.item_id = I.id  ORDER BY UI.id";

        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$name,$description, $item_status_id, $item_status_name, $item_type_id, $item_type_name, $image, $keywords, $unit_price, $tax_item, $tax_shipping, $user_id, $item_id, $user_price) = mysql_fetch_row($rsRES) ){
                $items[$i]["id"] =  $id;
                $items[$i]["name"] = $name;
                $items[$i]["description"] = $description;
                $items[$i]["item_status_id"] = $item_status_id;
                $items[$i]["item_status_name"] = $item_status_name;
                $items[$i]["item_type_id"] = $item_type_id;
                $items[$i]["item_type_name"] = $item_type_name;
                $items[$i]["image"] = $image;
                $items[$i]["keywords"] = $keywords;
                $items[$i]["unit_price"] = $unit_price;
                $items[$i]["tax_item"] = $tax_item;
                $items[$i]["tax_shipping"] = $tax_shipping;
                $items[$i]["user_id"] = $user_id;
                $items[$i]["item_id"] = $item_id;
                $items[$i]["user_price"] = $user_price;
                $i++;
            }
            return $items;
        }else{
            $this->error_number = 4;
            $this->error_description="Can't list items";
            return false;
        }
            
        
}


function get_list_array_bylimit($id=gINVALID,$name="", $description="", $item_status_id=gINVALID, $item_type_id=gINVALID, $user_id=gINVALID, $item_id=gINVALID, $keywords="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT UI.id, I.name, I.description, I.item_status_id, S.name as item_status_name, I.item_type_id, T.name as item_type_name, I.image, I.keywords, I.unit_price, I.tax_item, I.tax_shipping , UI.user_id, UI.item_id ,UI.unit_price AS user_price FROM items I,itemstatuses S, itemtypes T, useritems UI WHERE I.item_status_id = S.id AND I.item_type_id = T.id AND UI.item_id = I.id ";
        if ( $id != "" && $id != gINVALID ) {
                $str_condition .= " AND UI.id  = '" . addslashes(trim($id)) . "'" ;
        }


        if ( $name != "" ) {
                $str_condition .= " AND I.name  LIKE '%" . addslashes(trim($name)) . "%'" ;
        }


        if ( $description != "" ) {
                $str_condition .= " AND I.description  LIKE '%" . addslashes(trim($description)) . "%'" ;

        }


        if ( $item_status_id != gINVALID && $item_status_id != ""){
                $str_condition .= " AND I.item_status_id = ".addslashes(trim($item_status_id));
        }

        if ( $item_type_id != gINVALID && $item_type_id != ""){
                $str_condition .= " AND I.item_type_id = ".addslashes(trim($item_status_id));
        }

        if ( $user_id != gINVALID && $user_id != ""){
                $str_condition .= " AND UI.user_id = ".addslashes(trim($user_id));
        }

        if ( $item_id != gINVALID && $item_id != ""){
                $str_condition .= " AND UI.item_id = ".addslashes(trim($item_id));
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
                
            }else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
    
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $limited_data[$i]["id"] = $row["id"];
                $limited_data[$i]["name"] = $row["name"];
                $limited_data[$i]["description"] = $row["description"];
                $limited_data[$i]["item_status_id"] = $row["item_status_id"];
                $limited_data[$i]["item_status_name"] = $row["item_status_name"];
                $limited_data[$i]["item_type_id"] = $row["item_type_id"];
                $limited_data[$i]["item_type_name"] = $row["item_type_name"];
                $limited_data[$i]["image"] = $row["image"];
                $limited_data[$i]["keywords"] = $row["keywords"];
                $limited_data[$i]["unit_price"] = $row["unit_price"];
                $limited_data[$i]["tax_item"] = $row["tax_item"];
                $limited_data[$i]["tax_shipping"] = $row["tax_shipping"];
                $limited_data[$i]["user_id"] = $row["user_id"];
                $limited_data[$i]["item_id"] = $row["item_id"];
                $limited_data[$i]["user_price"] = $row["user_price"];

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
        }else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this items";
            return  false;
        }
    }
}




}


?>
