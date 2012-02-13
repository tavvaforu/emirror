
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>jQuery Alert Dialogs</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="This is a demonstration page." />
		<meta name="keywords" content="alert, confirm, prompt, demo" />
		
		<style type="text/css">
			
			/* Custom dialog styles */
			#popup_container.style_1 {
				font-family: Georgia, serif;
				color: #A4C6E2;
				background: #005294;
				border-color: #113F66;
			}
			
			#popup_container.style_1 #popup_title {
				color: #FFF;
				font-weight: normal;
				text-align: left;
				background: #76A5CC;
				border: solid 1px #005294;
				padding-left: 1em;
			}
			
			#popup_container.style_1 #popup_content {
				background: none;
			}
			
			#popup_container.style_1 #popup_message {
				padding-left: 0em;
			}
			
			#popup_container.style_1 INPUT[type='button'] {
				border: outset 2px #76A5CC;
				color: #A4C6E2;
				background: #3778AE;
			}
			
		</style>
		
		<!-- Dependencies -->
		<script src="jquery.js" type="text/javascript"></script>
		<script src="jquery.ui.draggable.js" type="text/javascript"></script>
		
		<!-- Core files -->
		<script src="jquery.alerts.js" type="text/javascript"></script>
		<link href="jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
		
		<!-- Example script -->

	</head>
	
	<body>
		
		
			<p>
				<input id="alert_button_with_html" onclick="jAlert('testing');" type="button" value="Show Alert" />
			</p>
		
		
	</body>
	
</html>