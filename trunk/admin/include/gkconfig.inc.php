<?php
	// created 2/23/06

	$controller_url = "main.php";
	
     // dev info
     $base_site = "http://localhost"; // /dev/garinet
     $config_atkroot = "atkdemo-main-branch/";//"../../admin/garinet/"; // atk appears to be in your admin subdir 
	$config_atkurl = "/dev/garinet/atkdemo-main-branch/modules/";//"/gktools/atk/gn/modules/";//"/admin/garinet/modules/"; // atk appears to be in your admin subdir 

 // production info 
/*
	$base_site = "http://www.garinet.com";
     $config_atkroot = "admin/";//"../../admin/garinet/"; // atk appears to be in your admin subdir 
	$config_atkurl = "/admin/modules/";//"/gktools/atk/gn/modules/";//"/admin/garinet/modules/"; // atk appears to be in your admin subdir 
*/
	$modules_path = $config_atkroot."modules/";
	include_once($config_atkroot."atk/include/initial.inc"); 

	
	/* start: module file paths*/

	/* end: module file paths*/
?>
