<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: EMOTIONS MIRROR ::</title>
<link href="<?php echo STYLES_ROOT; ?>template.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery.textshadow.js"></script>
<script src="<? echo SCRIPTS_ROOT;?>jalerts/jquery.alerts.js" type="text/javascript"></script>

<script type="text/javascript" src="<? echo SCRIPTS_ROOT;?>common.js" ></script>

<link href="<? echo SCRIPTS_ROOT;?>jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="header">
    <div class="logo_holder">
      <div class="logo"><img src="<? echo IMG_ROOT;?>logo.png" width="300" height="56" alt="Emotions Mirror" /></div>
      <div id="toprightpanel"><span style="color:#F00; font-weight:bold" align="right"><?=$msg?></span>
       <form action="index.php?file=u-login" method="POST" name="loginform" id="loginform" class="form">
        <label for="textfield"></label>
         <input name="Username" type="text" id="Username" value="" class="textfeild"/>
         <label for="textfield2"></label>
         <input name="pawd" type="password" class="textfeild" id="pawd" value="" maxlength="18" />
         <input type="submit" name="Login" id="button" value="Login" class="login_btn" onclick="return validate_login(document.loginform);"/>
         <div class="remember"><input name="Remember" type="checkbox" class="checkbox" id="Remember" /> 
		 <label for="Remember">         Remember me</label>
         </div>
         <div class="forgotpasssword"> <a href="index.php?file=u-fgtpass">Forgot Password?/a></div>
          <div class="signup"><a href="index.php?file=u-signup">Sign up</a></div>
       </form>    
    </div>
    </div>
  </div>
  
  <div class="clear"></div>