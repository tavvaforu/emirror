<?php
$email=$_GET['email'];
$password=$_GET['pwd'];
$log=$db->checkloginconfirm($email,$password);
if($log=="yes")
{
$sql=mysql_query("select * from members where email='$email' and password='$password'");
 $members=mysql_fetch_array($sql);
 mysql_query("INSERT INTO log (memberid,ipaddress,loggeddate,status) VALUES ('$memid', '$ip', '$date', '1')");
//store values in session
$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + (30* 60) ; //session expires in 30 minutes
 $_SESSION["sess_memberid"]=$members['member_id'];
 $_SESSION["sess_firstname"]=$members['first_name'];
 $_SESSION["sess_username"]=$members['username'];
 $_SESSION["sess_email"]=$members['email'];
 header("Location:index.php?file=m-messages");
 exit;
 header("Location:index.php?file=u-confirm_success");
}
else
{
header("Location:index.php?file=u-confirm_error");
}
?>
