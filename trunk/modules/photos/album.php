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
$tpl_object = new Template("templates/album");
//$tpl_object = new Template(TEMP_ROOT."album");
//edit of album
if(isset($_GET['mode'])){
$mode=$_GET['mode'];
}else{
$mode="Add";
}
if($_GET['mode']=="Save"){
$mode1="Edit";
}else{
$mode1="Add";
}
//disaply the album details in edit mode
if(isset($_GET['albumid']) && $_GET['albumid']!="")
{

//echo $_GET['albumid'];exit;
$sql=mysql_query("select * from album_cat where album_id=".$_GET['albumid']." and member_id=".$_SESSION["sess_memberid"]);
$abresult=mysql_fetch_array($sql);
$albumtitle=$abresult['album_title'];
$albumid=$abresult['album_id'];
$albummsg=$_GET['msg'];
/*$albumphoto=$abresult['album_photo'];
	   if($albumphoto!=""){
			$albumpath=MEDIA_ROOT.'albums/'.$albumphoto;
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

$res1.="<a href='media/albums/".$albumphoto."' target='_blank' >".$atchName."</a>&nbsp;&nbsp;&nbsp;" ;*/
}

//echo $_POST['saveForm'];exit;
//update albums
$album_title=$_POST['album_title'];
$album_status = '1';
	if(isset($_POST['saveForm']) && $_POST['mode']=="Save"){
	 /*if($_FILES['album_photo']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['album_photo']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['album_photo']['tmp_name'],"media/albums/".$fsname);					
			}else{
			  $fsname=$_POST['Aphoto'];
			}*/
			$i_sql="update album_cat set album_title='".$album_title."',modified_date=now(),modified_by='".$tmail."' where album_id='".$_POST['alid']."'";
			$i_res=mysql_query($i_sql);
			$error = 'Album Saved Successfully';
			 header("Location: index.php?file=p-photos&msg=$error");
		    exit;
			}
			
///Creation of albums			
if(isset($_POST['saveForm']) && $_POST['saveForm']=="Add")
{
   	  /* if($_FILES['album_photo']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['album_photo']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['album_photo']['tmp_name'],"media/albums/".$fsname);					
			}*/
    $memid=$_SESSION["sess_memberid"];
   $i_sql = "INSERT INTO album_cat(member_id,album_title,album_status, added_date,added_by) VALUES ('$memid','$album_title','$album_status', now(),'" . $tmail . "')";		
   $i_res = mysql_query($i_sql);$albumid=mysql_insert_id();
   	
		if ($albumid){
			$error = 'Album Created Successfully';
		    header("Location: index.php?file=p-addalbumphotos&albumid=$albumid&msg=$error");
		    exit;
		} else {		
			$error = 'Problem in adding, try again';
		}			
}
$res2.='<input id="saveForm" name="saveForm" onclick="return valid_albumform(document.albumform);" class="inr_btn" type="submit" value="'.$mode.'"/>';
$tp = $tpl_object->getContent();

//edition of album content
$tp=str_replace("{ALBUM_TITLE}",$albumtitle,$tp);
$tp=str_replace("{BTN}",$res2,$tp);
$tp=str_replace("{ALBUM_ID}",$albumid,$tp);
$tp=str_replace("{IMGVIEW}",$res1,$tp);
$tp=str_replace("{MODE}",$mode,$tp);
$tp=str_replace("{ALBUMPHOTO}",$albumphoto,$tp);
$tp=str_replace("{MODE1}",$mode1,$tp);
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