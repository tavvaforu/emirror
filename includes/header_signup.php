<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: EMOTIONS MIRROR ::</title>
<link href="<?php echo STYLES_ROOT; ?>template.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery.textshadow.js"></script>
<link href="<?php echo STYLES_ROOT; ?>tab.css" rel="stylesheet" type="text/css" />
<script src="<? echo SCRIPTS_ROOT;?>jalerts/jquery.alerts.js" type="text/javascript"></script>
<link href="<?php echo STYLES_ROOT; ?>jquery.fancybox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery.fancybox.js" ></script>

<script type="text/javascript" src="<? echo SCRIPTS_ROOT;?>common.js" ></script>

<link href="<? echo SCRIPTS_ROOT;?>jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
	jQuery(document).ready(function() {
	$(".fancybox-effects-d ").click(function() {
		$.fancybox({
			'width'			: 853,
			'height'		: 510,
			'display'       : 'block',
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			'allowfullscreen'	: 'true'
			}
			
		});

		return false;
	});
});

	</script>
<script type="text/javascript">
		$(document).ready(function() {
			/*
				Simple image gallery. Uses default settings
			*/

			$('.fancybox').fancybox();

			/*
				Different effects
			*/

			// Change title type, overlay opening speed and opacity
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedIn : 500,
						opacity : 0.95
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background-color' : '#eee'	
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
				Button helper. Disable animations, hide close button, change title type and content
			*/

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
				Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			*/

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : { 
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});


			/*
				Open manually
			*/

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50	
						}
					}	
				});
			});


		});
	</script>
</head>
<body>
<div id="header">
    <div class="logo_holder">
      <div class="logo"><a href="index.php"><img src="<? echo IMG_ROOT;?>logo.png" width="300" height="56" alt="Emotions Mirror" /></a></div>
      <div id="toprightpanel"><span style="color:#F00; font-weight:bold" align="right"><?=$msg?></span>
       <form action="index.php?file=u-login" method="POST" name="loginform" id="loginform" class="form">
        <span style="padding-right:105px;">Username</span>
         <label for="textfield2"></label>
         Password
        <div class="clear"></div>
		<label for="textfield"></label>
         <input name="Username" type="text" id="Username" value="" class="textfeild" />
         <label for="textfield2"></label>
         <input name="pawd" type="password" class="textfeild" id="pawd" value="" maxlength="18"  />
         <input type="submit" name="Login" id="button" value="Login" class="login_btn" onclick="return validate_login(document.loginform);"/>
         <div class="remember"><input name="Remember" type="checkbox" class="checkbox" id="Remember" /> 
		 <label for="Remember">         Remember me</label>
         </div>
         <div class="forgotpasssword"> <a href="index.php?file=u-fgtpass">Forgot Password?</a></div>
          
       </form>    
    </div>
    </div>
  </div>
  
  <div class="clear"></div>
<script type="text/javascript">
  function ChangeToPassField() {
   document.getElementById('pawd').type="password";
  }
/*function ChangeTotextField(){
  
if(document.getElementById('pawd').value=='') 
	{
		document.getElementById('pawd').value='Password';
	}

}*/
  </script>