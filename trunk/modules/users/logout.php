<?php 
if($_SESSION["sess_memberid"]!="")
{
        session_destroy();
		session_unset();
		$msg = "Logout Successfully";
        header("Location:index.php?file=u-main&msg=$msg");
}
else
  header("Location:index.php");
?>