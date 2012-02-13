<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: EMOTIONS MIRROR ::</title>
<link href="<?php echo STYLES_ROOT; ?>template.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>tab.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>form.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo STYLES_ROOT; ?>paginate.css">

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<!--[if lte IE 7]>
     <link href="css/style.ie.css" rel="stylesheet" type="text/css" /><![endif]-->
<script type="text/JavaScript" src="<?php echo SCRIPTS_ROOT; ?>curvycorners.src.js"></script>
<!--<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery.textshadow.js"></script>-->
<script src="js/activatables.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jsDatePick.jquery.min.1.3.js"></script>
<script src="<?php echo SCRIPTS_ROOT; ?>swfobject.js" language="javascript"></script>
<!-- Arquivos utilizados pelo jQuery lightBox plugin -->

    <link type="text/css" href="<?php echo STYLES_ROOT; ?>/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link href="<?php echo STYLES_ROOT; ?>form.css" rel="stylesheet" type="text/css" />	
		<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">
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
		</script>
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
<script  type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>slate/slate.js"></script>
<script  type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>slate/slate.portlet.js"></script>
<script  type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>plugin.js"></script>

<script type="text/javascript" charset="utf-8">
$(function () 
{
	slate.init ();
	slate.portlet.init ();	
});
</script>
	<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>
	
	<script type="text/javascript" src="<?php echo SCRIPTS_ROOT; ?>fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo SCRIPTS_ROOT; ?>fancybox/jquery.fancybox-1.3.4.css" media="screen" />

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});
	</script>
<script type="text/JavaScript">

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

</script>

</head>

<body>

  <div id="header">
    <div class="logo_holder">
      <div class="logo"><img src="<?php echo IMG_ROOT; ?>logo.png" width="300" height="56" alt="Emotions Mirror" /></div>
    
<div class="chromestyle" id="chromemenu">
<ul>
<li><a href="#" rel="dropmenu1"></a></li>
</ul>
</div>
