<?php
require_once("includes/header.php");

$db=new myclass;
$db->myconnect();
$tpl_object = new Template("templates/open_trigger");
$tp = $tpl_object->getContent();
$id=$_GET['id'];
$iId=$_POST['iId'];
$stype=$_GET['stype'];
if($_POST['saveForm']=="Delete")
{

$stype=$_POST['stype'];
//echo "delete from messagetrigger where id=".$iId;exit;
 $sql=mysql_query("update messagetrigger set status='Deleted' where id='".$iId."'");
 $msg="Record deleted succesfully";
  $tp=str_replace("{msg}",$msg,$tp);

 header("location:index.php?file=t-trigger&stype=$stype&msg=$msg#page=page-2");

}
if(isset($_GET['action']) && $_GET['action']=="Remove")
{
   $reid=$_GET['Reid'];
   $iid=$_GET['iid'];
   $stypes=$_GET['stype'];
   $sql_at=mysql_query("select attachments from trigger_attachments where id='".$reid."'");
   $my_at=mysql_fetch_array($sql_at);
   unlink("media/trigger_files/".$my_at['attachments']);
   $sql=mysql_query("delete from trigger_attachments where id='".$reid."'");
   $msg="Attachment deleted succesfully";
   
   $tp=str_replace("{msg}",$msg,$tp);
   header("location:index.php?file=t-open_trigger&id=$iid&stype=$stypes&msg=$msg#page=page-2");
}
$my_res=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and a.id='$id'");
$my_arr=mysql_fetch_array($my_res);
//echo '<pre>';print_r($my_arr);exit;
$id=$my_arr['id'];
$title_trigger=$my_arr['title'];
$message=$my_arr['message'];
$id=$my_arr['id'];
$date=$db->displayDateFormat($my_arr['create_time']);
$message_intensity=$my_arr['message_intensity'];
$col_id=$my_arr['color_id'];
$sender=$my_arr['sender_name'];
$attachres=mysql_query("select * from trigger_attachments where trigger_id=$id");
$i=1;
while($ar=mysql_fetch_array($attachres))
{
	$fil=$ar['attachments'];
	$flname = explode('_-_',$fil);
	//echo '<pre>';print_r($flname);exit;
	//echo count($flname);
	if(count($flname)>1)
	{
		$atchName = $flname[1];
	} else {
		$atchName = $fil;
	}$attachid=$ar['id'];
$res.="<a href='media/trigger_files/".$fil."' target='_blank' >".$atchName."</a>&nbsp;&nbsp;&nbsp" ;
$res.='<a href="#" onclick="return removetriggerfile('.$attachid.','.$id.')";>Remove</a><br>' ;
$i++;

}

$tp=str_replace("{MESSAGE}",nl2br($message),$tp);
$tp=str_replace("{DATE}",$date,$tp);
$tp=str_replace("{stype}",$stype,$tp);
$tp=str_replace("{INTENSITY}",$message_intensity,$tp);
if($stype == 2)
{
$tp=str_replace("{REC_NAME}",'From: '.$my_arr['sender_name'],$tp);
$tp=str_replace("{REC_EMAIL}",'  < '.$my_arr['sender_email'].' >',$tp);
} else {
//echo $my_arr['email'];exit;
$tp=str_replace("{REC_NAME}",'To: '.$my_arr['name'],$tp);
$tp=str_replace("{REC_EMAIL}",' < '.$my_arr['email'].'>',$tp);

}
$tp=str_replace("{msg}",$msg,$tp);
$tp=str_replace("{EMOTION}",'<span style="margin:0;padding:0 5px;height:10px;width:20px;background-color:#'.$col_id.'" >&nbsp;</span>',$tp);
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);
$tp=str_replace("{ATTACH}",$res,$tp);
$tp=str_replace("{iId}",$id,$tp);
$tp=str_replace("{TITLE}",$title_trigger,$tp);

//echo $tp;
//require_once(SITE_ROOT."includes/footer.php");
?>