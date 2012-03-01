<?php 
if($_SESSION["sess_memberid"]!="")
{
        session_destroy();
		session_unset();
		//$msg = "Logout Successfully";
        header("Location:index.php?file=u-main");
}
else
  header("Location:index.php");
?>