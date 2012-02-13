<?php
include("includes/header.php");
$tpl_object = new Template("templates/chpass");
$tp = $tpl_object->getContent();
$sql=mysql_query("select * from members where member_id='".$_SESSION['sess_memberid']."'");
$members=mysql_fetch_array($sql);

$oldpass=$members["password"];
if($_POST)
{
	$sql="update members set password='".md5($_POST['newpassword'])."' where member_id=".$_SESSION['sess_memberid'];
	$res=$db->pushquery($sql);
	if($res)
	{
		$sucmsg="Update Successful";
	}
}





 
 $tp = str_replace("{SESSBASEDCTRLSTART}",$sessbasedctrlstart,$tp);
$tp = str_replace("{SESSBASEDCTRLEND}",$sessbasedctrlend,$tp);
$tp = str_replace("{oldpass}",$oldpass,$tp);
$tp = str_replace("{MSG}",$sucmsg,$tp);

$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{STYLE_URL}",STYLES_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);



?>