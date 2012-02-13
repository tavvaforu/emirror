<?php
include('C:/wamp/www/emirror/inc/config.inc.php');
define("TEMP_ROOT",'C:/wamp/www/emirror/templates/');
require_once("C:/wamp/www/emirror/includes/header_signup.php");
require_once('recaptchalib.php');

$publickey = "6LfIbMwSAAAAAOgCEX_Cajs9Z8Movxqb9cToD8jK ";
$privatekey = "6LfIbMwSAAAAAP44_anBGzdcKvMoFxda2Y_TDFKv ";
$obj=new emirror_config;
$tpl_object = new Template("C:/wamp/www/emirror/templates/signup");
$tp = $tpl_object->getContent();

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
print_r($_POST);
# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
                echo "You got it!";
        } else {
                # set the error code so that we can display it
                $error = $resp->error;
        }
}exit;
$email=$_POST['email'];
$password=md5($_POST['pwd']);
$first_name=$_POST['firstname'];
$username=$_POST['username'];
$db=new myclass;
$db->myconnect();
$user_check=$db->member_check($email);
if($user_check=="yes")
{
echo "Email already exists";
exit;
}
else
{
//echo "sunitha";exit;
$reg=$db->member_register($first_name,$username,$password,$email);
if($reg=="yes")
{

$mail = new PHPGMailer();
$mail->IsHTML(true);
$mail->Username = 'eswar.a@varnatech.com';
$mail->Password = 'Amminenies007';
$mail->From = 'eswar.a@varnatech.com';
$mail->FromName = 'Emirror';
$mail->Subject = 'New Account Registration at Emirror';
$mail->AddAddress($email);
$mail->Body = "Hi  ".ucfirst($first_name).",
Thanks Much for your Interest in Emirror<br />
<br>
Thank you for registering.<br>
<br>    
If you have any queries / clarifications, please call us or write to our Mailid : contact@emirror.com
<br>
Please do not reply to this email.

<br>

Emirror Team

<br>
http://www.emirror.com/";
/*if($mail->Send())
{
	echo "Registration sucessful";
	
}
else
{
	echo "Registration unsucessful";
}*/

}
else
{

}
}
?>