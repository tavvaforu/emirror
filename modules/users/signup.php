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
		//echo '<pre>';print_r($_POST);exit;
		if (isset($_POST)) {
		//if ($_POST["recaptcha_response_field"])
        //$resp = recaptcha_check_answer ($privatekey,
        //                                $_SERVER["REMOTE_ADDR"],
        //                                $_POST["recaptcha_challenge_field"],
         //                               $_POST["recaptcha_response_field"]);
		////Added By harinath
		//if ($resp->is_valid) replaced with if(1==1)
        if (1==1) {
              
	    $reg=$db->member_register($first_name,$username,$password,$email);
		mysql_query("insert into profile(user_id)values('".mysql_insert_id()."')");
		if($reg=="yes")
			{

	//			$mail = new phpmailer();
//$mail->IsSMTP(false );
//$mail->SMTPDebug = 0; // 1 tells it to display SMTP errors and messages, 0 turns off all errors and messages, 2 prints messages only.
//$mail->SMTPAuth = false;
//$mail->SMTPSecure = 'ssl';
//$mail->Host = 'smtpout.secureserver.net';
//$mail->Port = 465;

//$mail->Username = 'registration@emotionsmirror.com';
//$mail->Password = 'registration1';

$mailFrom = 'registration@emotionsmirror.com';
$mailFromName = 'Emotions Mirror';
//$mail->AddAddress($email);
//$mail->AddReplyTo(“Email Address HERE”, “Name HERE”); // Adds a “Reply-to” address. Un-comment this to use it.

$mailsubject = 'New Account Registration With Emotions Mirror';
$mailto=$email;
$mailbody = "Hi  ".ucfirst($first_name).",
Thank you for your Interest in Emotions Mirror<br />
          
          
    <br>
To activate your account ,perform the following steps:<br>
1. click the below link to activate your account
<br>
2. A web browser opens and displays your account is activated. Click Login.<br>
<br>
3. Type your user ID and Password and then click Login.
<br>
<a href='http://".$_SERVER['HTTP_HOST']."/index.php?file=u-confirm_user&email=".$email."&pwd=".$password." '> Activate now </a>
<br>
<br>    
In case you have any queries / clarifications, please call us or write to our Mailid : contactus@emotionsmirror.com
<br>
Please do not reply to this email.
<br>
Thank you for registering.<br>
<br>

Emotions Mirror Team";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: <'.$email.'>' . "\r\n";
$headers .= 'From: emotionsmirror.com <registration@emotionsmirror.com>' . "\r\n";
				if(mail($mailto,$mailsubject,$mailbody,$headers))
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
                     $msg="Registration unsucessful(database error)";
				}
			}	 
			else {
                # set the error code so that we can display it
                $error = $resp->error;
				}


		}else
				{
					$msg="Registration unsucessful(captcha error)";
				}
	
		}
}
if($msg!='')
{
 echo "<script>jAlert('$msg.<br/>A confirmation email was sent to email adress .You must check your email and click the link to confirm your email address.');</script>";
 
}
//end user registeration
$res=recaptcha_get_html($publickey, $error);
$tp=str_replace("{CAPTCHA}",$res,$tp);
$tp=str_replace("{MSG}",$msg,$tp);
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
header("location:index.php");

?>