<?php
require_once("includes/header_signup.php");
require_once('recaptchalib.php');
$publickey = "6LfIbMwSAAAAAOgCEX_Cajs9Z8Movxqb9cToD8jK ";
$privatekey = "6LfIbMwSAAAAAP44_anBGzdcKvMoFxda2Y_TDFKv ";
$tpl_object = new Template("templates/signup");
$tp = $tpl_object->getContent();

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

$email=$_POST['email'];
$password=md5($_POST['pwd']);
$first_name=$_POST['firstname'];
$username=$_POST['username'];

//user registration
if(isset($_POST['Signup']) && $_POST['Signup']=="Signup") 
{
    $checkusername=$db->member_usernamecheck($username);
    $user_check=$db->member_check($email);
	if($user_check=="yes")
	{
		$msg="Email already exists";
		
	}  else if($checkusername=="yes"){
               $msg="Username already exists";

       }
	else{
	    # was there a reCAPTCHA response?
		if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
              
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
Thanks Much for your Interest in Emotions Mirror<br />
          
          
 <br>
Your account is currently inactive. You cannot use it until you visit the following link:
    <br><br>

Activate Your Account Here:
<br>
<a href='http://".$_SERVER['HTTP_HOST']."/emirror/index.php?file=u-confirm_user&email=".$email."&pwd=".$password." '> activate </a>
<br>
<br>    
In case you have any queries / clarifications, please call us or write to our Mailid : contact@emirror.com
<br>
Please do not reply to this email.
<br>
Thank you for registering.<br>
<br>

Emotions Mirror Team";
				if($mail->Send())
				{
					$msg="Registration sucessful";
					
				}
				else
				{
					$msg="Registration unsucessful";
				}

			}
				else
				{
                     $msg="Registration unsucessful";
				}
			}	 
			else {
                # set the error code so that we can display it
                $error = $resp->error;
				}


		}else
				{
					$msg="Registration unsucessful";
				}
	
		}
}
//end user registeration
$res=recaptcha_get_html($publickey, $error);
$tp=str_replace("{CAPTCHA}",$res,$tp);
$tp=str_replace("{MSG}",$msg,$tp);
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);


?>