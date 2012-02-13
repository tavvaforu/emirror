<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: EMOTIONS MIRROR ::</title>
<link href="<?php echo STYLES_ROOT; ?>template.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>favorites.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>tab.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>form.css" rel="stylesheet" type="text/css" />

<!--[if lte IE 7]>
     <link href="css/style.ie.css" rel="stylesheet" type="text/css" /><![endif]-->
<!--<script type="text/JavaScript" src="<?php echo SCRIPTS_ROOT; ?>curvycorners.src.js"></script>-->
<!--<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery.textshadow.js"></script>-->
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jsDatePick.jquery.min.1.3.js"></script>
<script src="<?php echo SCRIPTS_ROOT; ?>swfobject.js" language="javascript"></script>
<!-- Arquivos utilizados pelo jQuery lightBox plugin -->

    <link type="text/css" href="<?php echo STYLES_ROOT; ?>/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link href="<?php echo STYLES_ROOT; ?>form.css" rel="stylesheet" type="text/css" />	
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>common.js" ></script>

<!--<script type="text/javascript">
			$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: 3,
			min: 1,
			max: 7,
			slide: function( event, ui ) {
				$( "#hid_slide" ).val(ui.value );
			}
		});
		$( "#hid_slide" ).val( $( "#slider-range-min" ).slider( "value" ) );
	});
		</script> -->
		<style type="text/css">
			/*demo page css*/
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>	

<!--[if lte IE 6]>
   <script type="text/javascript" src="js/supersleight-min.js"></script>
<![endif]-->


<!--<script type="text/JavaScript">

  curvyCorners.addEvent(window, 'load', initCorners);

  function initCorners() {
    var settings = {
      tl: { radius: 10 },
      tr: { radius: 10 },
      bl: { radius: 10 },
      br: { radius: 10 },
      antiAlias: true
    }

    curvyCorners(settings, "#form-wrap");
  }

</script> -->

</head>

<body>

  <div id="header">
    <div class="logo_holder">
      <div class="logo"><a href="index.php"><img src="<?php echo IMG_ROOT; ?>logo.png" width="300" height="56" alt="Emotions Mirror" /></a></div>
      <div class="welcomtext">
    <div class="welcome"><h2>Welcome <?=$_SESSION["sess_firstname"]?></h2>&nbsp;| <a href="helpandforms.html">Help & Forums</a></div>
    
<div class="chromestyle" id="chromemenu">
<ul>
<li><a href="#" rel="dropmenu1"></a></li>
</ul>
</div>

<!--1st drop down menu -->                                                   
<div id="dropmenu1" class="dropmenudiv">
<a href="#">Account Settings</a>
<a href="#">Privacy Settings</a>
<a href="index.php?file=u-chpass">Change Password</a>
<a href="index.php?file=u-logout">Logout</a>
<a href="#">Help Center</a>
</div>
  </div>
  
        <div id="filenrContainer">
						<div class="clear"></div>
						<form action="">
								<input type="text" placeholder="Search">
								<input type="submit" value="" name="submit-search"> 
						</form>
				</div>
    </div>
  </div>
  
  <div class="clear"></div>