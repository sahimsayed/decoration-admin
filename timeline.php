<?php
if(isset($_POST['dob']))
 { 
    $dob = $_POST['dob'];
    list($date,$time) = explode(" ", $dob);
    list($year,$month,$day) = explode("-",$date);
    $years  = date("Y") - $year;
    $months = date("m") - $month;
    $days   = date("d") - $day;
    if (($years > 21) || ($years == 21 && $months > 0) || ($years == 21 && $months == 0 && $days >= 0))
    {
        header("Location: welcome.php");
    } else 
    {
        header("Location: notwelcome.php");
    }
 }





$sql = "SELECT * FROM bookings " .
    "WHERE DATE(date) > DATE(NOW()) " .
    "AND dateofquote != '' " .
    "AND email != '' " .
    "AND confirmed = 0";
$result = mysql_query($sql);
$num_rows = mysql_numrows($result);
$today = date('Y-m-d');
$count = 2;
if($num_rows){
while($row = mysql_fetch_assoc($result)){
    $date_of_quote = $row['dateofquote'];
    $datetime1 = new DateTime($today);
    $datetime2 = new DateTime($date_of_quote);
    $interval = $datetime1->diff($datetime2);
    $diff = $interval->format('%a');
    if($diff == '2'){
        // send email
    } else {
        echo 'something went wrong';
    }
}