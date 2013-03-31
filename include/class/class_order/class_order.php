<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Order {
    var $connection;
    var $id = gINVALID;
    var $order_number = "";
    var $order_date = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT id,order_number FROM orders WHERE order_number = '".$this->order_number."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->order_number = mysql_result($rsRES,0,'order_number');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This Order doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT id,order_number,order_date FROM orders WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->order_number = mysql_result($rsRES,0,'order_number');
        $this->order_date = mysql_result($rsRES,0,'order_date');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO orders (order_number, order_date) VALUES ('";
    $strSQL .= addslashes(trim($this->order_number)) ."','";
    $strSQL .= addslashes(trim($this->order_date)) ."')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this order_number";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE orders SET order_number = '".addslashes(trim($this->order_number))."',";
    $strSQL .= "order_date = '".addslashes(trim($this->order_date))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this Order";
                return false;
            }
    }
}

function get_list_array(){
        $orders = array();$i=0;
        $strSQL = "SELECT id,order_number,order_date FROM orders ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$order_number,$order_date) = mysql_fetch_row($rsRES) ){
                $orders[$i]["id"] =  $id;
                $orders[$i]["order_number"] = $order_number;
                $orders[$i]["order_date"] = $order_date;
                $i++;
            }
            return $orders;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Orders";
        return false;
        }
}

function get_list_array_bylimit($id=-1,$order_number="", $order_date="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT id,order_number,order_date FROM orders WHERE 1 ";
        if ( $id != "" && $id != -1 ) {
            $str_condition .= " AND id  = '" . $id . "'" ;
        }


        if ( $order_number != "" ) {
            $str_condition .= " AND order_number  LIKE '%" . $order_number . "%'" ;
        }


        if ( $order_date != "" ) {
            $str_condition .= " AND order_date  LIKE '%" . $order_date . "%'" ;
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
                $limited_data[$i]["order_number"] = $row["order_number"];
                $limited_data[$i]["order_date"] = $row["order_date"];
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
        $strSQL = " DELETE FROM orders WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this Order";
            return  false;
        }
    }
}
}


?>
