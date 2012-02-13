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
$tpl_object = new Template("templates/addalbumvideos");
//creation of albums
//print_r($_POST);exit;
$video_title=$_POST['video_title'];
$video_code=$_POST['video_code'];
$video_status = '1';
$videoalbumid=$_GET['albumid'];
$Avideoid=$_GET['videoid'];
$vid=$_POST['videoid'];
//album name
if(isset($_GET['albumid']) && $_GET['albumid']!="")
{
$sql=mysql_query("select * from videos_cat where video_id=".$videoalbumid);
$abresult=mysql_fetch_array($sql);
$albumtitle=$abresult['video_title'];
$albummsg=$_GET['msg'];

}
if(isset($_GET['mode'])){
$mode=$_GET['mode'];
}else{
$mode="Add";
}

//disaply the photo details in edit mode
if(isset($_GET['videoid']) && $_GET['videoid']!="")
{
$sql=mysql_query("select * from videos where ivideo_id=".$Avideoid);
$abresult=mysql_fetch_array($sql);
$videotitle=$abresult['vvideo_title'];
$videoid=$abresult['ivideo_id'];
$videoalbumid=$abresult['cat_id'];
$albummsg=$_GET['msg'];
$video_code=$abresult['video_code'];

}
//echo $_POST['mode'];
//updation of videos
	if(isset($_POST['saveForm']) && $_POST['mode']=="Save"){
	$aid=$_POST['videoalbumid'];
             $video_title=$_POST['video_title'];
			$i_sql="update videos set vvideo_title='".$video_title."',video_code='".$video_code."',modified_date=now(),modified_by='".$tmail."' where ivideo_id='".$vid."' and cat_id='".$aid."'";
			$i_res=mysql_query($i_sql);
			$error = 'Videos Saved Successfully';
			 header("Location:index.php?file=v-videos_display&valbumid=$aid&msg=$error");
		    exit;
			}
			
//Insertion of photos into album
if(isset($_POST['saveForm']) && $_POST['saveForm']=="Add")
{
$aid=$_POST['videoalbumid'];
	
   $i_sql = "INSERT INTO videos(cat_id,vvideo_title,video_code,evideo_status,added_date,added_by) VALUES ('$aid','$video_title','$video_code','$video_status', now(),'" . $tmail . "')";	
   $i_res = mysql_query($i_sql);
   $photoid=mysql_insert_id();
	
		if ($photoid){
			$error = 'Video added Succesfully';
		    header("Location: index.php?file=v-videos_display&valbumid=$aid&msg=$error");
		    exit;
		} else {		
			$error = 'Problem in adding, try again';
		}			
}

$res2.='<input id="saveForm" name="saveForm" onclick="return valid_albumvideoform(document.albumvideoform);" class="inr_btn" type="submit" value="'.$mode.'"/>';

$tp = $tpl_object->getContent();
//album messages
$tp=str_replace("{MSG}",$albummsg,$tp);
$tp=str_replace("{PHOTOMSG}",$error,$tp);
$tp=str_replace("{videoalbumid}",$videoalbumid,$tp);

$tp=str_replace("{video_code}",$video_code,$tp);
$tp=str_replace("{videoid}",$videoid,$tp);
$tp=str_replace("{videotitle}",$videotitle,$tp);
$tp=str_replace("{albumtitle}",$albumtitle,$tp);
$tp=str_replace("{BTN}",$res2,$tp);
$tp=str_replace("{MODE}",$mode,$tp);
$tp=str_replace("{IMGVIEW}",$res1,$tp);
$tp=str_replace("{PHOTO}",$photo,$tp);
//end
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