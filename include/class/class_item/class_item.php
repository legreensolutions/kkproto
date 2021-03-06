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
    var $item_status_id = gINVALID;
    var $item_status_name = "";
    var $item_type_id = gINVALID;
    var $item_type_name = "";
    var $image = "";
    var $keywords = "";
    var $unit_price = 0.00;

    var $unit_weight = 0.000;
    var $max_shipping_unit = 0.000;
    var $shipping_rate = 0.00;

    var $tax_item = 0.00;
    var $tax_shipping = 0.00;
    var $commission = 1.00;


    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT id,name, description, item_status_id, item_type_id, image, keywords, unit_price, unit_weight, max_shipping_unit, shipping_rate, tax_item, tax_shipping, commission FROM items WHERE name = '".addslashes(trim($this->name))."'";
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
        $this->unit_weight = mysql_result($rsRES,0,'unit_weight');
        $this->max_shipping_unit = mysql_result($rsRES,0,'max_shipping_unit');
        $this->shipping_rate = mysql_result($rsRES,0,'shipping_rate');
        $this->tax_item = mysql_result($rsRES,0,'tax_item');
        $this->tax_shipping = mysql_result($rsRES,0,'tax_shipping');
        $this->commission = mysql_result($rsRES,0,'commission');

        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This items doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT I.id, I.name, I.description, I.item_status_id, S.name as item_status_name, I.item_type_id, T.name as item_type_name, I.image, I.keywords, I.unit_price, I.unit_weight, I.max_shipping_unit, I.shipping_rate,  I.tax_item, I.tax_shipping, I.commission FROM items I,itemstatuses S, itemtypes T WHERE I.item_status_id = S.id AND I.item_type_id = T.id AND I.id = '".addslashes(trim($this->id))."'";
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
        $this->unit_weight= mysql_result($rsRES,0,'unit_weight');
        $this->max_shipping_unit= mysql_result($rsRES,0,'max_shipping_unit');
        $this->shipping_rate= mysql_result($rsRES,0,'shipping_rate');
        $this->tax_item= mysql_result($rsRES,0,'tax_item');
        $this->tax_shipping= mysql_result($rsRES,0,'tax_shipping');
        $this->commission= mysql_result($rsRES,0,'commission');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO items (name, description, item_status_id, item_type_id, image, keywords, unit_price, unit_weight, max_shipping_unit, shipping_rate,  tax_item, tax_shipping, commission) VALUES ('";
    $strSQL .= addslashes(trim($this->name)) ."','";
    $strSQL .= addslashes(trim($this->description)) ."',";
    $strSQL .= addslashes(trim($this->item_status_id)) .",";
    $strSQL .= addslashes(trim($this->item_type_id)) .",'";
    $strSQL .= addslashes(trim($this->image)) ."','";
    $strSQL .= addslashes(trim($this->keywords)) ."',";
    $strSQL .= addslashes(trim($this->unit_price)) .",";
    $strSQL .= addslashes(trim($this->unit_weight)) .",";
    $strSQL .= addslashes(trim($this->max_shipping_unit)) .",";
    $strSQL .= addslashes(trim($this->shipping_rate)) .",";
    $strSQL .= addslashes(trim($this->tax_item)) .",";
    $strSQL .= addslashes(trim($this->tax_shipping)) .",";
    $strSQL .= addslashes(trim($this->commission)) .")";

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
    $strSQL .= "description = '".addslashes(trim($this->description))."',";
    $strSQL .= "item_status_id = ".addslashes(trim($this->item_status_id)).",";
    $strSQL .= "item_type_id = ".addslashes(trim($this->item_type_id)).",";
if ( $this->image != "" ){
    $strSQL .= "image = '".addslashes(trim($this->image))."',";
}
    $strSQL .= "keywords = '".addslashes(trim($this->keywords))."',";
    $strSQL .= "unit_price = ".addslashes(trim($this->unit_price)).",";
    $strSQL .= "unit_weight = ".addslashes(trim($this->unit_weight)).",";
    $strSQL .= "max_shipping_unit = ".addslashes(trim($this->max_shipping_unit)).",";
    $strSQL .= "shipping_rate = ".addslashes(trim($this->shipping_rate)).",";
    $strSQL .= "tax_item = ".addslashes(trim($this->tax_item)).",";
    $strSQL .= "tax_shipping = ".addslashes(trim($this->tax_shipping)).",";
    $strSQL .= "commission = ".addslashes(trim($this->commission));
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
        $items = array();$i=0;
        $strSQL = "SELECT I.id, I.name, I.description, I.item_status_id, S.name as item_status_name, I.item_type_id, T.name as item_type_name, I.image, I.keywords, I.unit_price, I.unit_weight, I.max_shipping_unit, I.shipping_rate, I.tax_item, I.tax_shipping, I.commission FROM items I,itemstatuses S, itemtypes T WHERE I.item_status_id = S.id AND I.item_type_id = T.id ORDER BY I.id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$name,$description, $item_status_id, $item_status_name, $item_type_id, $item_type_name, $image, $keywords, $unit_price, $unit_weight, $max_shipping_unit, $shipping_rate, $tax_item, $tax_shipping,$commission) = mysql_fetch_row($rsRES) ){
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
                $items[$i]["unit_weight"] = $unit_weight;
                $items[$i]["max_shipping_unit"] = $max_shipping_unit;
                $items[$i]["shipping_rate"] = $shipping_rate;
                $items[$i]["tax_item"] = $tax_item;
                $items[$i]["tax_shipping"] = $tax_shipping;
                $items[$i]["commission"] = $commission;
				$items[$i]["details"] = $name . ", $".$unit_price;
                $i++;
            }
            return $items;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list items";
        return false;
        }
}

function get_list_array_bylimit($id=gINVALID,$name="", $description="", $item_status_id=gINVALID, $item_type_id=gINVALID, $keywords="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT I.id, I.name, I.description, I.item_status_id, S.name as item_status_name, I.item_type_id, T.name as item_type_name, I.image, I.keywords, I.unit_price, I.unit_weight, I.max_shipping_unit, I.shipping_rate, I.tax_item, I.tax_shipping, I.commission FROM items I,itemstatuses S, itemtypes T WHERE I.item_status_id = S.id AND I.item_type_id = T.id ";
        if ( $id != "" && $id != gINVALID ) {
                $str_condition .= " AND I.id  = '" . addslashes(trim($id)) . "'" ;
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
                $str_condition .= " AND I.item_type_id = ".addslashes(trim($item_type_id));
        }


        if (trim($str_condition) !="") {
            $strSQL .=  $str_condition . "  ";
        }
        $strSQL .= " ORDER BY I.id";
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
                $limited_data[$i]["unit_weight"] = $row["unit_weight"];
                $limited_data[$i]["max_shipping_unit"] = $row["max_shipping_unit"];
                $limited_data[$i]["shipping_rate"] = $row["shipping_rate"];
                $limited_data[$i]["tax_item"] = $row["tax_item"];
                $limited_data[$i]["tax_shipping"] = $row["tax_shipping"];
                $limited_data[$i]["commission"] = $row["commission"];
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


function delete_image_fromDB(){
    $strSQL = "UPDATE items SET image='' WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_affected_rows($this->connection) > 0 ) {
        return true;
    }else{
        return false;
        $this->error_description = "Image not deleted";
     }
}



}


?>
