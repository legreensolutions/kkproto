<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Faq {
    var $connection;
    var $id = gINVALID;
    var $question = "";
    var $answer = "";
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function get_id(){
    $strSQL = "SELECT id,question FROM faq WHERE question = '".$this->question."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->question = mysql_result($rsRES,0,'question');
        return $this->id;
    }else{
        $this->error_number = 1;
        $this->error_description="This FAQ doesn't exist";
        return false;
    }
}



function get_detail(){
    $strSQL = "SELECT id,question,answer FROM faq WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->question = mysql_result($rsRES,0,'question');
        $this->answer = mysql_result($rsRES,0,'answer');
        return $this->id;
    }else{
        $this->error_number = 2;
        $this->error_description="Contact administrator to get its details";
        return false;
    }
}


function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO faq (question, answer) VALUES ('";
    $strSQL .= addslashes(trim($this->question)) ."','";
    $strSQL .= addslashes(trim($this->answer)) ."')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't insert this question";
              return false;
          }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE faq SET question = '".addslashes(trim($this->question))."',";
    $strSQL .= "answer = '".addslashes(trim($this->answer))."'";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this FAQ";
                return false;
            }
    }
}

function get_list_array(){
        $faqs = array();$i=0;
        $strSQL = "SELECT id,question,answer FROM faq ORDER BY id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list ($id,$question,$answer) = mysql_fetch_row($rsRES) ){
                $faqs[$i]["id"] =  $id;
                $faqs[$i]["question"] = $question;
                $faqs[$i]["answer"] = $answer;
                $i++;
            }
            return $faqs;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list FAQs";
        return false;
        }
}

function get_list_array_bylimit($id=-1,$question="", $answer="", $start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT id,question,answer FROM faq WHERE 1 ";
        if ( $id != "" && $id != -1 ) {
            $str_condition .= " AND id  = '" . $id . "'" ;
        }


        if ( $question != "" ) {
            $str_condition .= " AND question  LIKE '%" . $question . "%'" ;
        }


        if ( $answer != "" ) {
            $str_condition .= " AND answer  LIKE '%" . $answer . "%'" ;
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
                $limited_data[$i]["question"] = $row["question"];
                $limited_data[$i]["answer"] = $row["answer"];
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
        $strSQL = " DELETE FROM faq WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't deltete this FAQ";
            return  false;
        }
    }
}
}


?>
