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
$tpl_object = new Template(TEMP_ROOT."albumphotos");

//creation of albums
$album_title=$_POST['album_title'];
$album_status = '1';
if(isset($_POST['saveForm']) && $_POST['saveForm']=="Create")
{
   	   if($_FILES['album_photo']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['album_photo']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['album_photo']['tmp_name'],"media/albums/".$fsname);				
			}
   $i_sql = "INSERT INTO album_cat(album_title,album_photo,album_status, added_date, added_by) VALUES ('$album_title','$fsname','$album_status', now(),'" . $tmail . "')";		
   $i_res = mysql_query($i_sql);
   $albumid=mysql_insert_id();
	
		if ($albumid){
			$error = 'Album Created Successfully';
		    header("Location: photos.php?msg=$error");
		    exit;
		} else {		
			$error = 'Problem in adding, try again';
		}			
}
$tp = $tpl_object->getContent();
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