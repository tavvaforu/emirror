<?php
require_once("includes/header_signup.php");
$tpl_object = new Template("templates/fgtpass");
$tp = $tpl_object->getContent();

if($_POST)
{
$email=$_POST[email];
if($email!="")
{
$res=mysql_query("select * from members where email='$email'");
if(mysql_num_rows($res) > 0)
{
$arr=mysql_fetch_assoc($res);
$pwdlength = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $newpass ='';    
    for ($pwd = 0; $pwd < $pwdlength; $pwd++) {
        $newpass .= $characters[mt_rand(0, strlen($characters))];
    }
mysql_query("update members set password='".md5($newpass)."' where email='$email'");	
$mailto=$email;
$mailsubject="Password reset from Emotions Mirror";
$mailbody="Dear ".($arr['username']).",<br>
Please find your new password.
<br>
".$newpass."
<br>
Please change your password after login.
<br>

Emotions Mirror Team
 ";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'To: <'.$email.'>' . "\r\n";
$headers .= 'From: emotionsmirror.com <registration@emotionsmirror.com>' . "\r\n";
				if(mail($mailto,$mailsubject,$mailbody,$headers))
				{
				$msg="Your password is reset and sent to your email";
}

}
else
{
$msg="Please Enter Valid Email";
}

}
else
{
$msg="Please Enter Valid Email";
}
}


$tp=str_replace("{MSG}",$msg,$tp);
?>