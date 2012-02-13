<?php
     include_once("include/gkconfig.inc.php");
     	 
     $action = $_REQUEST["action"];
     $module = $_REQUEST["module"];
 

     if($module == "users"){ // http://localhost/dev/garinet/main.php?module=users&action=get_form
          include_once($modules_path."users/class.user_front.inc");          
          $object = new user_front("main.php");
          $my_content = $object->execute($action);         
     }
	 
	 
     
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Users Test</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">td img {display: block;}

</style>
<!--Fireworks 8 Dreamweaver 8 target.  Created Tue May 29 10:07:22 GMT-0700 (Pacific Daylight Time) 2007-->
</head>
<body>
     <?=$my_content;?>
</body>
</html>
