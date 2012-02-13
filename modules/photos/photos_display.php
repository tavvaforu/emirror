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
//$tpl_object = new Template("templates/message");
$tpl_object = new Template("templates/photos_display");
$tp = $tpl_object->getContent();

$albumid=$_GET['albumid'];

$delphotoid=$_GET['delphotoid'];
///deletion of album
if($_GET['action']=="Delete")
{
	//echo "update album_cat set album_status=0 where album_id=".$delalbumid;
	//exit;
	$sql_up=mysql_query("update photos set photo_status='0' where photo_id=".$delphotoid);
	if($sql_up)
	{
		$msg="Photo deleted successfully";
	}
	else{
		$msg="Error-in deleting the Photo";
	}
	header("location:index.php?file=p-photos_display&albumid=$albumid&msg=$msg");
		exit;
}

//list of photos
//echo "select * from album_cat order by added_date desc";
//echo "select * from photos where album_id='".$albumid." order by added_date desc";
if(isset($_GET['albumid']) && $_GET['albumid']!="")
{
$sql=mysql_query("select * from album_cat where album_id=".$albumid);
$abresult=mysql_fetch_array($sql);
$albumtitle=$abresult['album_title'];
}
	$res4.='<span style="font-size:12px; color:#0075b7;"><a href="index.php?file=p-photos">Album</a> >>'.$albumtitle .'</span>
    <br /><br />';
	$res5.= '<h3>'.$albumtitle.'</h3>';
//for paging
$queryString = "albumid=$albumid";
$sql="select p.* from photos p where  p.album_id='".$albumid."' and photo_status='1' order by p.added_date desc";
$rowsPerPage =10; ///for paging
$query=$db->getPagingQuery($sql,$rowsPerPage);
$photo_result  = mysql_query($query);
$pagingLink =$db->getPagingLink($sql, $rowsPerPage,$queryString);

//$photo_result=mysql_query("select p.* from photos p where  p.album_id='".$albumid."' order by p.added_date desc");
if(mysql_num_rows($photo_result)>0)
{
$res.=' <div style="width:700px;  text-align:center;">';
	$rcnt=0;
	while($phresult=mysql_fetch_array($photo_result))
	{
	   $photoid=$phresult['photo_id'];
	   $phototitle=$phresult['photo_title'];
	   $photo=$phresult['photo'];
	   if($photo!=""){
			$photopath=MEDIA_ROOT.'albums/'.$photo;
			$thumbpath=MEDIA_ROOT.'albums/thumbs/'.$photo;
	   }else{
			$photopath=IMG_ROOT.'album.gif';
			}

    
      
   
     $res.='<div style="width:130px; height:130px; margin-bottom:10px; float:left; margin-top:10px;">
	 <div style="height:112px;">
	<a href="'.$photopath.'" rel="example_group1"><img src='.$thumbpath.'  alt="Emotions Mirror" /></a></div>
     <div>';	
	 $res.='<a href="'.$photopath.'" rel="example_group">'.$phototitle.'</a></div>
     <div style="font-size:12px; color:#0075b7; text-align:center">';
  $res.='<a href="index.php?file=p-addalbumphotos&mode=Save&photoid='.$photoid.'&albumid='.$albumid.'">Edit</a>  | <a href="#" onclick="return photodelete('.$albumid.','.$photoid.');"> Delete</a> </div>
     </div>';
	
	}
	$res.="</div>";
}
if ($pagingLink){
$link=$pagingLink;
}else{
$link='';
}
// $res.='<a rel="example_group" href="../../3_b.jpg" title="Lorem ipsum dolor sit amet"><img alt="" src="../../3_b.jpg" /></a>';
$res.='<div class="clear"></div><div align="center" style="margin-top:20px; "><b>'.$link.'</b></div><div class="clear"></div>';
//end list of albums
//photos messages added here
$tp=str_replace("{MSG}",$_GET['msg'],$tp);
$tp=str_replace("{PHOTOS}",$res,$tp);
$tp=str_replace("{ALBUMID}",$albumid,$tp);

//ending

$tp=str_replace("{albumdisplay}",$res4,$tp);
$tp=str_replace("{album_display}",$res5,$tp);
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{MEDIA_URL}",MEDIA_ROOT,$tp);
$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);
//echo $tp;
//require_once(SITE_ROOT."includes/footer.php");
?>