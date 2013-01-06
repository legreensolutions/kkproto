<script>
$(function() {
$("#sugg_first").click(function() {
    $("#txtusername").val($("#sugg_first").val());
    return true;

});

$("#sugg_sec").click(function() {
    $("#txtusername").val($("#sugg_sec").val());
    return true;

});
$("#sugg_third").click(function() {
    $("#txtusername").val($("#sugg_third").val());
    return true;

});
});
</script>
<?php
$myuser = new User();
if (isset($_POST['user'])) {
    $myuser->connection = $myconnection;
    $myuser->user_name = addslashes(trim($_POST['user']));
    $chk = $myuser->exist();
    if ($chk == true) {
        echo 'Username <em>'.$username.'</em> is already taken!<br />';
        echo "Suggested user names are  <br />";
        $current_year = date("Y");
        $suggest = "";
        $suggest = $myuser->user_name . $current_year;
        echo "<input type='radio' name ='first' id='sugg_first' value=$suggest>";
        echo $suggest = $myuser->user_name . $current_year  ."<br />";
        $current_year += 1;
        $suggest = $myuser->user_name . $current_year;
        echo "<input type='radio' name ='first' id='sugg_sec' value=$suggest>";
        echo $suggest = $myuser->user_name . $current_year."<br />";
        $current_year += 1;
        $suggest = $myuser->user_name . $current_year;
        echo "<input type='radio' name ='first' id='sugg_third' value=$suggest>";
        echo $suggest = $myuser->user_name . $current_year ."<br />";

    } else {
         echo 'Username <em>'.$username.'</em> is available!';
    }
}
?>

