<?php
require_once("includes/header.php");
$obj=new emirror_config;
$tpl_object = new Template("templates/tell");
$tp = $tpl_object->getContent();
$db=new myclass;
$db->myconnect();
if(isset($_GET['msg']))
{
	$msg = $_GET['msg'];
}
$message=$_POST['message'];
$sql=mysql_query("select * from members where member_id='".$_SESSION["sess_memberid"]."'");
$res=mysql_fetch_array($sql);
$name=$res['first_name'];
$email=$res['email'];
$memid=$_SESSION["sess_memberid"];
$message=$_POST['message'];
$subject=$_POST['subject'];
//insesrtion of feedback
//echo '<pre>';print_r($_POST);exit;
if($_POST['saveForm']=="Send")
{
   mysql_query("insert into feedback(memberid,name,email,subject,message,created_time)values('$memid','$name','$email','$subject','$message',now())");
	$insid=mysql_insert_id();
	if($insid)
	{
		$mailto="registration@emotionsmirror.com";
		if($subject!='') {
			$mailsubject= $subject;
		} else {
			$mailsubject=" Feedback from Emotions Mirror ";
		}
		$mailbody="Dear Emotion Mirror team,<br/><br/>
		Please check the feedback from emotions mirror site.
		<br/><br/>
		".$message."
		<br/><br/>
			
		Emotions Mirror Team
		 ";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: emotionsmirror.com <registration@emotionsmirror.com>' . "\r\n";
	    $headers .= 'from: <'.$email.'>' . "\r\n";
					if(mail($mailto,$mailsubject,$mailbody,$headers))
						{
						   $msg="feedback sent succesfully";
						}
						else{
						$msg="Error-in sending the feedback";
					}
	  
	}
	else{
	$msg="Error-in sending the feedback";
	}
	//header("location:index.php?file=u-feedback&msg=$msg");
	//exit;
}
$tp=str_replace("{MESSAGE}",$msg,$tp);
$tp=str_replace("{name}",$name,$tp);
$tp=str_replace("{email}",$email,$tp);
$tp=str_replace("{BTN}",'<input id="saveForm" onclick="return validateFormnew();" name="saveForm" class="inr_btn" type="submit" value="Send"/>',$tp);

?>
