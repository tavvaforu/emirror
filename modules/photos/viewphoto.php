<?php
define(SITE_ROOT,$_SERVER['DOCUMENT_ROOT']."/emirror/");
include(SITE_ROOT.'/inc/config.inc.php');
include(SITE_ROOT.'/inc/pagination1.php');
define(TEMP_ROOT,SITE_ROOT.'/templates/');

require_once(SITE_ROOT."includes/header.php");
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
$tpl_object = new Template(TEMP_ROOT."viewphoto");
$tp = $tpl_object->getContent();

$albumid=$_GET['albumid'];
$photoid=$_GET['photoid'];
//list of photos
//echo "select * from album_cat order by added_date desc";
//echo "select * from photos where album_id='".$albumid." order by added_date desc";
if(isset($_GET['albumid']) && $_GET['albumid']!="")
{
$sql=mysql_query("select * from album_cat where album_id=".$albumid);
$abresult=mysql_fetch_array($sql);
$albumtitle=$abresult['album_title'];
}
	$res.='<span style="font-size:12px; color:#0075b7;"><a href="photos.php">Album</a>  >> '.$albumtitle .'</span>
    <br /><br />
    <h3>'.$albumtitle.'</h3>';
//for paging
$queryString = "albumid=$albumid";
$sql="select p.* from photos p where  p.album_id='".$albumid."' order by p.added_date desc";
$rowsPerPage =1; ///for paging
$query=$db->getPagingQuery($sql,$rowsPerPage);
$photo_result  = mysql_query($query);
$pagingLink =$db->getPagingLink($sql, $rowsPerPage,$queryString);

//$photo_result=mysql_query("select p.* from photos p where  p.album_id='".$albumid."' order by p.added_date desc");
if(mysql_num_rows($photo_result)>0)
{

	$rcnt=0;
	while($phresult=mysql_fetch_array($photo_result))
	{
	   $photoid=$phresult['photo_id'];
	   $phototitle=$phresult['photo_title'];
	   $photo=$phresult['photo'];
	   if($photo!=""){
			$photopath=MEDIA_ROOT.'albums/'.$photo;
	   }else{
			$photopath=IMG_ROOT.'album.gif';
			}

    
      
   $res.=' <div style="width:700px;  text-align:center;">
     <div><img src='.$photopath.' widht="300px" height="400px" />
     <br /><br />
     <span><a href="'.$photopath.'" rel="lightbox[roadtrip]">'.$phototitle.'</a></span>
     <br /><br />
     <span style="font-size:12px; color:#0075b7; text-align:center">';
  $res.='<a href="addalbumphotos.php?mode=Edit&photoid='.$photoid.'&albumid='.$albumid.'">Edit</a>  |  Delete </span>
     </div></div>';
	
	}
}
if ($pagingLink){
$link=$pagingLink;
}else{
$link='';
}
$res.='<div class="clear"></div><div align="center" style="margin-top:20px; "><b>'.$link.'</b></div>';
//end list of albums
//photos messages added here
$tp=str_replace("{MSG}",$_GET['msg'],$tp);
$tp=str_replace("{PHOTOS}",$res,$tp);
$tp=str_replace("{ALBUMID}",$albumid,$tp);

//ending


$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);
echo $tp;
require_once(SITE_ROOT."includes/footer.php");
?>