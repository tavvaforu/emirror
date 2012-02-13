<?php
require_once("includes/header.php");
$checkid=@implode(",",$_POST['check_list']);

//print_r($_GET);
/*include("classes/config.php");
include("classes/pagination1.php");*/
$arr=explode(".",$_SERVER['HTTP_HOST']);

//echo '<pre>';print_r($_POST);exit;
//print_r($_GET);
$delid=$_GET['delid'];
$action=$_GET['action'];	
//echo $_POST['keyword'];

$db=new myclass;
$db->myconnect();
$tpl_object = new Template("templates/videos");
//$tpl_object = new Template(TEMP_ROOT."videos");
$tp = $tpl_object->getContent();

//echo "select * from album_cat order by added_date desc";

$delvideoid=$_GET['delvideo'];
///deletion of album
if($_GET['action']=="Delete")
{
	//echo "update album_cat set album_status=0 where album_id=".$delalbumid;
	//exit;
	$sql_up=mysql_query("update videos_cat set video_status='0' where video_id=".$delvideoid);
	if($sql_up)
	{
		$msg="Video Album deleted successfully";
	}
	else{
		$msg="Error-in deleting the Video album";
	}
	header("location:index.php?file=v-videos&msg=$msg");
		exit;
}

//list of video albums
$sql="select * from videos_cat where video_status='1' and member_id=".$_SESSION["sess_memberid"]." order by added_date desc";
$rowsPerPage =4; ///for paging
 $query=$db->getPagingQuery($sql, $rowsPerPage);
 $videoalbum_result  = mysql_query($query);
 $pagingLink =$db->getPagingLink($sql, $rowsPerPage);
if(mysql_num_rows($videoalbum_result)>0)
{
	$rcnt=0;
	while($videoresult=mysql_fetch_array($videoalbum_result))
	{
	  $videoid=$videoresult['video_id'];
	  $videotitle=$videoresult['video_title'];
	  $videophoto=$videoresult['videoalbum_photo'];
	   if($videophoto!=""){
			$videopath=MEDIA_ROOT.'videos/'.$videophoto;
	   }else{
			$videopath=IMG_ROOT.'album.gif';
			}
	$res.='<div style="width:660px; padding:10px;">
     <div style="width:120px; float:left"><a href="index.php?file=v-videos_display&valbumid='.$videoid.'">
<img src="'.$videopath.'" width="111" height="111" alt="Emotions Mirror" /></a></div>
     <div style="width:500px; float:right; padding:10px 0;">
      <span style="font-size:14px; font-weight:bold; color:#0075b7;">'.$videotitle.'</span>
      <br />
      <span style="font-size:12px; color:#0075b7;">
<a href="index.php?file=v-videos_display&valbumid='.$videoid.'">View Album </a> |  <a href="index.php?file=v-addalbumvideos&albumid='.$videoid.'">Add Videos</a>
|  <a href="index.php?file=v-videoalbum&mode=Save&videoalbumid='.$videoid.'">Edit Album </a> |   <a href="#" onclick="return videoalbumdelete('.$videoid.');">Delete Album</a></span>
     </div>
     
    </div>
    <div class="clear"></div>';   
	   
	}
}
if ($pagingLink){
$link=$pagingLink;
}else{
$link='';
}
 $res.='<br><div align="center"><b>'.$link.'</b></div>';
//echo getPagingQuery($gal_sql, $rowsPerPage);

//end list of albums
//photos messages added here
$tp=str_replace("{MSG}",$_GET['msg'],$tp);
$tp=str_replace("{PHOTOS}",$res,$tp);
//ending
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);
//echo $tp;
//require_once(SITE_ROOT."includes/footer.php");
?>