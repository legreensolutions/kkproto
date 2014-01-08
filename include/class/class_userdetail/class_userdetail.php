<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class UserDetail {
    var $connection;
    var $id = gINVALID;  //user ID
    var $user_id = gINVALID;  //user ID

    var $phone = "";
    var $fax = "";
    var $dob = "";
    var $description = "";
    var $gender_id = "";

    var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

    function UserDetails ($connection=""){
        $this->connection=$connection;
    }


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
              $strSQL = "INSERT INTO userdetails (id,phone, fax, dob, description, gender_id) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->user_id))."','";
              $strSQL .= addslashes(trim($this->phone))."','";
              $strSQL .= addslashes(trim($this->fax))."','";
              $strSQL .= addslashes(trim($this->dob))."','";
              $strSQL .= addslashes(trim($this->description))."','";
              $strSQL .= addslashes(trim($this->gender_id))."')";
              $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();;
                    return true;
              }
              else{
                $this->error_description = "Insert Failed";
                return false;
              }

        }elseif($this->id > 0 ) {
            $strSQL = "UPDATE userdetails SET ";
            $strSQL .= "phone = '".addslashes(trim($this->phone))."',";
            $strSQL .= "fax = '".addslashes(trim($this->fax))."',";
            $strSQL .= "dob = '".addslashes(trim($this->dob))."',";
            $strSQL .= "description = '".addslashes(trim($this->description))."',";
            $strSQL .= "gender_id = '".addslashes(trim($this->gender_id))."'";
            $strSQL .= " WHERE id = ".$this->id; //$this->id = user_id
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Update Failed";
                return false;
            }
        }

    }

    function exist(){
        $strSQL = "SELECT 1 FROM userdetails WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            return true;
        }
        else{
            return false;
        }
    }

    function get_detail(){
        $strSQL = "SELECT * FROM userdetails WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->phone = mysql_result($rsRES,0,'phone');
                $this->fax = mysql_result($rsRES,0,'fax');
                $this->dob = mysql_result($rsRES,0,'dob');
                $this->description = mysql_result($rsRES,0,'description');
                $this->gender_id = mysql_result($rsRES,0,'gender_id');
                return true;
        }
        else{
            return false;
        }
    }


}
?>
