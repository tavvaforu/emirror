<?php
$username=$_POST['Username'];
$password=md5($_POST['pawd']);
$sql=mysql_query("select * from members where username='$username' and password='$password'");
$members=mysql_fetch_array($sql);
$log=$db->checklogin($username,$password);
if($log=="yes")
{
//store values in session
$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + (30* 60) ; //session expires in 15 minutes
 $_SESSION["sess_memberid"]=$members['member_id'];
 $_SESSION["sess_firstname"]=$members['first_name'];
  $_SESSION["sess_profilephoto"]=$members['photo'];
  
 $_SESSION["sess_username"]=$members['username'];
 $_SESSION["sess_email"]=$members['email'];
 header("Location:index.php?file=m-messages");
 exit;
}
else
{
 $msg="Login failed";
 header("Location:index.php?msg=$msg");
 exit;
}

?>
