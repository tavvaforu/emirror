<?php
require_once("includes/header.php");
$checkid=@implode(",",$_POST['check_list']);

$arr=explode(".",$_SERVER['HTTP_HOST']);

//echo '<pre>';print_r($_POST);exit;
//print_r($_GET);
$delid=$_GET['delid'];
$action=$_GET['action'];	
//echo $_POST['keyword'];

$db=new myclass;
$db->myconnect();
$tpl_object = new Template("templates/photos");
//$tpl_object = new Template(TEMP_ROOT."photos");
$tp = $tpl_object->getContent();

//echo "select * from album_cat order by added_date desc";

$delalbumid=$_GET['delalbumid'];
///deletion of album
if($_GET['action']=="Delete")
{
	//echo "update album_cat set album_status=0 where album_id=".$delalbumid;
	//exit;
$memid=$_SESSION["sess_memberid"];
	$sql_up=mysql_query("update album_cat set album_status='0' where album_id=".$delalbumid." and member_id=".$memid);
	if($sql_up)
	{
		$msg="Album deleted successfully";
	}
	else{
		$msg="Error-in deleting the album";
	}
	header("location:index.php?file=p-photos&msg=$msg");
		exit;
}
//list of albums
$sql="select * from album_cat where album_status='1' and member_id=".$_SESSION["sess_memberid"]." order by added_date desc";
$rowsPerPage =4; ///for paging
$query=$db->getPagingQuery($sql, $rowsPerPage);
$album_result  = mysql_query($query);
$pagingLink =$db->getPagingLink($sql, $rowsPerPage);
if(mysql_num_rows($album_result)>0)
{
	$rcnt=0;
	while($abresult=mysql_fetch_array($album_result))
	{
	   $albumid=$abresult['album_id'];
	   $albumtitle=$abresult['album_title'];
	     $albumphoto=$db->getphoto($albumid);
	   if($albumphoto!=""){
			$albumpath=MEDIA_ROOT.'albums/thumbs/'.$albumphoto;
	   }else{
			$albumpath=IMG_ROOT.'album.gif';
			}
	$res.='<div style="width:660px; padding:10px;">
     <div style="width:120px; float:left"><a href="index.php?file=p-photos_display&albumid='.$albumid.'">
<img src="'.$albumpath.'" width="111" height="111" alt="Emotions Mirror" /></a></div>
     <div style="width:500px; float:right; padding:10px 0;">
      <span style="font-size:14px; font-weight:bold; color:#0075b7;">'.$albumtitle.'</span>
      <br />
      <span style="font-size:12px; color:#0075b7;">
<a href="index.php?file=p-photos_display&albumid='.$albumid.'">View Album </a> |  <a href="index.php?file=p-addalbumphotos&albumid='.$albumid.'">Add Photos</a>
|  <a href="index.php?file=p-album&mode=Save&albumid='.$albumid.'">Edit Album </a> |   <a href="#" onclick="return albumdelete('.$albumid.');">Delete Album</a></span>
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