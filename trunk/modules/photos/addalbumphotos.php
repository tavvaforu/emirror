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
$tpl_object = new Template("templates/addalbumphotos");

//creation of albums
$photo_title=$_POST['photo_title'];
$photo_status = '1';
$albumid=$_GET['albumid'];
$photoid=$_GET['photoid'];
//album name
if(isset($_GET['albumid']) && $_GET['albumid']!="")
{
$sql=mysql_query("select * from album_cat where album_id=".$albumid);
$abresult=mysql_fetch_array($sql);
$albumtitle=$abresult['album_title'];
$albummsg=$_GET['msg'];

}
if(isset($_GET['mode'])){
$mode=$_GET['mode'];
}else{
$mode="Add";
}

//disaply the photo details in edit mode
if(isset($_GET['photoid']) && $_GET['photoid']!="")
{
$sql=mysql_query("select * from photos where photo_id=".$photoid);
$abresult=mysql_fetch_array($sql);
$phototitle=$abresult['photo_title'];
$albumid=$abresult['album_id'];
$photoid=$abresult['photo_id'];
$albummsg=$_GET['msg'];
$photo=$abresult['photo'];
	   if($albumphoto!=""){
			$albumpath=MEDIA_ROOT.'albums/'.$photo;
	   }else{
			$albumpath=IMG_ROOT.'album.gif';
			}	
	$flname = explode('_-_',$photo);
	if(count($flname)>1)
	{
		$atchName = $flname[1];
	} else {
		$atchName = $fil;
	}

$res1.="<a href='media/albums/".$photo."' target='_blank' >".$atchName."</a>&nbsp;&nbsp;&nbsp;" ;
}
//echo $_POST['mode'];
//updation of photos
	if(isset($_POST['saveForm']) && $_POST['mode']=="Save"){
	
	$alid=$_POST['albumid'];
	$photoid=$_POST['photoid'];
	 if($_FILES['galphoto']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['galphoto']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['galphoto']['tmp_name'],"media/albums/".$fsname);					
			}else{
			  $fsname=$_POST['pphoto'];
			}
			$i_sql="update photos set photo_title='".$photo_title."',photo='".$fsname."',modified_date=now(),modifiedby='".$tmail."' where photo_id='".$photoid."' and album_id='".$alid."'";
			$i_res=mysql_query($i_sql);
			$error = 'Photo Saved Successfully';
			 header("Location: index.php?file=p-photos_display&albumid=$alid&msg=$error");
		    exit;
			}
			
//Insertion of photos into album
if(isset($_POST['saveForm']) && $_POST['saveForm']=="Add")
{
$aid=$_POST['albumid'];
//echo $_FILES['galphoto']['name'];
   	  /* if($_FILES['galphoto']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['galphoto']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['galphoto']['tmp_name'],"media/albums/".$fsname);				
			}*/
			//echo "INSERT INTO photos(album_id,photo_title,photo,photo_status,added_date,added_by) VALUES ('$aid','$photo_title','$fsname','$photo_status', now(),'" . $tmail . "')";exit;		
		$uploaddir = 'media/albums/';
		$thumbdir="media/albums/thumbs/";
    foreach ($_FILES["pic"]["error"] as $key => $error)
    {
        if ($error == UPLOAD_ERR_OK)
        {
            $tmp_name = $_FILES["pic"]["tmp_name"][$key];
			$fileName = str_replace(' ', '_', $_FILES["pic"]["name"][$key]);
				$fsname=date('Ymdhis').'_-_'.$fileName;
            $uploadfile = $uploaddir.$fsname;			
            move_uploaded_file($tmp_name,$uploadfile);
			$db->mycreatethumb($uploadfile,$thumbdir.$fsname,111,111);
}
    
			//echo "INSERT INTO photos(album_id,photo_title,photo,photo_status,added_date,added_by) VALUES ('$aid','$photo_title','$fsname','$photo_status', now(),'" . $tmail . "')";exit;		
   $i_sql = "INSERT INTO photos(album_id,photo_title,photo,photo_status,added_date,addedby) VALUES ('$aid','$photo_title','$fsname','$photo_status', now(),'" . $tmail . "')";		
   $i_res = mysql_query($i_sql);
   $photoid=mysql_insert_id();
	}
	
		if ($photoid){
			$error = 'photos Uploaded Succesfully';
		    header("Location: index.php?file=p-photos_display&albumid=$aid&msg=$error");
		    exit;
		} else {		
			$error = 'Problem in adding, try again';
		}			
}
if($mode=="Add"){
$photoup.='<input type="file" name="pic[]" id="galphoto"  class="multi" maxlength="1" accept="gif|jpg|jpeg|png" style="width:200px;margin-left:10px;"/>';
}else{
$photoup.='<input name="galphoto" id="galphoto" type="file" style="width:300px;margin-left:10px;" />';
}
$res2.='<input id="saveForm" name="saveForm" class="inr_btn" value="'.$mode.'" onclick="return valid_photoform(document.albumphotoform);" type="submit" />';

$tp = $tpl_object->getContent();
//album messages
$tp=str_replace("{MSG}",$albummsg,$tp);
$tp=str_replace("{Photo_upload}",$photoup,$tp);

$tp=str_replace("{PHOTOMSG}",$error,$tp);
$tp=str_replace("{albumid}",$albumid,$tp);
$tp=str_replace("{photoid}",$photoid,$tp);
$tp=str_replace("{phototitle}",$phototitle,$tp);
$tp=str_replace("{BTN}",$res2,$tp);
$tp=str_replace("{MODE}",$mode,$tp);
$tp=str_replace("{IMGVIEW}",$res1,$tp);
$tp=str_replace("{PHOTO}",$photo,$tp);
//end
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{ALBUM_TITLE}",$albumtitle,$tp);
$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);
//echo $tp;
//require_once(SITE_ROOT."includes/footer.php");
?>