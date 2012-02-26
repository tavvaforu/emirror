<?php
require_once("inc/config.inc.php");
$obj=new emirror_config;
$db=new myclass;
$db->myconnect();

$file =$_REQUEST['file'];
if(isset($file) && $file != ""){
	$var=explode("-",$file);
	$prefix=$var[0];
	$script=$var[1];
}
$r=$db->checkderogatory_words();
$str_words=implode(",",$r);
//print_r($_SESSION);
if($script==""){
if($_SESSION['sess_memberid']!="")
       {
           $script="messages";
		   $prefix="m";
		   
}else{
$script="main";
}
}
//following code finds out the modules from suffix and find out the script name
switch ($prefix){
	case "u":
		$module = "users";
		break;
    case "s":
		$module = "settings";
		break;
	case "m":
		$module = "messages";
		break;
       case "j":
		$module = "journal";
		break;
      case "t":
		$module = "trigger";
		break;
      case "me":
		$module = "memories";
		break;
      case "p":
             $module = "photos";
		break;
      case "v":
             $module = "videos";
		break;
      case "e":
		$module = "events";
		break;
      case "fr":
		$module = "referfriend";
		break;
	default:
		$module = "users";
		break;
}
 $include_script =USER_MODULE.$module."/".$script.".php";
 if(file_exists($include_script))
		include_once($include_script);	
//display photo
$photo=$_SESSION['sess_profilephoto'];
	   if($photo!=""){
			$photopath=MEDIA_ROOT.'members/'.$photo;
	   }else{
			$photopath=IMG_ROOT.'profile.jpg';
			}	
	$flname = explode('_-_',$photo);
	if(count($flname)>1)
	{
		$atchName = $flname[1];
	} else {
		$atchName = $fil;
	}

$dsphoto="<a href='media/members/".$photo."' target='_blank' >".$atchName."</a>&nbsp;&nbsp;&nbsp;" ;
$dsImage= $photopath;
$tp=str_replace("{dsImage}",$dsImage,$tp);
//end
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{STYLE_URL}",STYLES_ROOT,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);
echo $tp;

require_once("includes/footer_signup.php");
?>
<div id="basicddd-modal-content"></div>
