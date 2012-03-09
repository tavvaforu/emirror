<?php
require_once("includes/header.php");
$obj=new emirror_config;
$tpl_object = new Template("templates/tell");
$tp = $tpl_object->getContent();
$db=new myclass;
$db->myconnect();
if(isset($_POST))
{
		//echo '<pre>';print_r($_POST);exit;
		 $_POST['name']=stripslashes($_POST['name']);
	  	$fromName = ucwords($_POST['name']);
		$fromAddress =$_POST['email'];
		$txtEmails = $_POST['cemails'];
		$Emails = trim($txtEmails,',');	

		$serverAddress = $link = $_SESSION['domain_name']; 	
        $message = nl2br($_POST['message']) ;
		$host = "http:".$_SERVER['HTTP_HOST'];
		$message = str_replace('Click here',"<a href='http://".$_SERVER['HTTP_HOST']."/index.php?file=u-signup'>Click here<a/>",$message);
		$subject = $_POST['subject'] ;		
		$emailsList = explode(',',$Emails);	
		$sql=mysql_query("select * from members where member_id='".$_SESSION["sess_memberid"]."'");
		$res=mysql_fetch_array($sql);
		$name=$res['first_name'];
		$email=$res['email'];
		$memid=$_SESSION["sess_memberid"];
		//echo '<pre>';print_r($emailsList);exit;
			foreach($emailsList as $toEmail)
			 {	 	
					if( $toEmail != '')
					 {
						$from = $_SESSION['sess_memberid'];
						//echo "insert into invitefriend(friend_email,user_id,invitedate)values('$toEmail','$from',now())";exit;
						mysql_query("insert into invitefriend(friend_email,user_id,invitedate)values('$toEmail','$from',now())");
						$insid=mysql_insert_id();					
						if( $insid > 0 )
						 {			
							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'To: emotionsmirror.com <registration@emotionsmirror.com>' . "\r\n";
							$headers .= 'from: <'.$email.'>' . "\r\n";
							//echo $toEmail;exit;	
							if(mail($toEmail,$subject,$message,$headers))
							{
							$msg="invitation sent succesfully";
							//exit;
							}
							else{
							$msg="Error-in sending the invitation";
							}
						 }
					}
		   	}

}
header("location:index.php?file=fr-refer&msg=$msg");
?>
