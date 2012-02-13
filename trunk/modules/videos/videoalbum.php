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
$tpl_object = new Template("templates/videoalbum");
//edit of album

if(isset($_GET['mode'])){
$mode=$_GET['mode'];
}else{
$mode="Add";
}
if($mode=="Save"){
$mode1="Edit";
}else{
$mode1="Add";
}
$albumid=$_GET['videoalbumid'];
//disaply the album details in edit mode
if(isset($_GET['videoalbumid']) && $_GET['videoalbumid']!="")
{
$sql=mysql_query("select * from videos_cat where video_id=".$albumid." and member_id=".$_SESSION["sess_memberid"]);
$abresult=mysql_fetch_array($sql);
$albumtitle=$abresult['video_title'];
$albumid=$abresult['video_id'];
$albummsg=$_GET['msg'];
$albumphoto=$abresult['videoalbum_photo'];
	   if($albumphoto!=""){
			$albumpath=MEDIA_ROOT.'videos/'.$albumphoto;
	   }else{
			$albumpath=IMG_ROOT.'album.gif';
			}	
	$flname = explode('_-_',$albumphoto);
	if(count($flname)>1)
	{
		$atchName = $flname[1];
	} else {
		$atchName = $fil;
	}

$res1.="<a href='media/videos/".$albumphoto."' target='_blank' >".$atchName."</a>&nbsp;&nbsp;&nbsp;" ;
}

//echo $_POST['saveForm'];exit;
//update albums
$video_title=$_POST['video_title'];
$video_status = '1';
	if(isset($_POST['saveForm']) && $_POST['mode']=="Save"){
	 if($_FILES['video_photo']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['video_photo']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['video_photo']['tmp_name'],"media/videos/".$fsname);					
			}else{
			  $fsname=$_POST['Aphoto'];
			}
			 $i_sql="update videos_cat set video_title='".$video_title."',videoalbum_photo='".$fsname."',modified_date=now(),	modified_by='".$tmail."' where video_id='".$_POST['vid']."'";
			$i_res=mysql_query($i_sql);
			$error = 'Album Saved Successfully';
			 header("Location: index.php?file=v-videos&msg=$error");
		    exit;
			}
			
///Creation of albums			
if(isset($_POST['saveForm']) && $_POST['saveForm']=="Add")
{
   	   if($_FILES['video_photo']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['video_photo']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['video_photo']['tmp_name'],"media/videos/".$fsname);					
			}
            $memid=$_SESSION["sess_memberid"];
//echo  "INSERT INTO videos_cat(video_title,videoalbum_photo,video_status, added_date, added_by) VALUES ('$video_title','$fsname','$video_status', now(),'" . $tmail ."')";exit;
   $i_sql = "INSERT INTO videos_cat(member_id,video_title,videoalbum_photo,video_status, added_date, added_by) VALUES ('$memid','$video_title','$fsname','$video_status', now(),'" . $tmail . "')";		
   $i_res = mysql_query($i_sql);
   $videoalbumid=mysql_insert_id();
   	
		if ($videoalbumid){
			$error = 'Video Album Created Successfully';
		    header("Location: index.php?file=v-addalbumvideos&albumid=$videoalbumid&msg=$error");
		    exit;
		} else {		
			$error = 'Problem in adding, try again';
		}			
}
$res2.='<input id="saveForm" name="saveForm" onclick="return valid_videoalbumform(document.videoalbumform);" class="inr_btn" type="submit" value="'.$mode.'"/>';
$tp = $tpl_object->getContent();

//edition of album content
$tp=str_replace("{ALBUM_TITLE}",$albumtitle,$tp);
$tp=str_replace("{BTN}",$res2,$tp);
$tp=str_replace("{ALBUM_ID}",$albumid,$tp);
$tp=str_replace("{IMGVIEW}",$res1,$tp);
$tp=str_replace("{MODE}",$mode,$tp);
$tp=str_replace("{MODE1}",$mode1,$tp);
$tp=str_replace("{ALBUMPHOTO}",$albumphoto,$tp);

//end
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);

?>