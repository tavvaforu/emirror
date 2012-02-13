<?php
require_once("includes/header_signup.php");
$obj=new emirror_config;
$tpl_object = new Template("templates/main");
$tp = $tpl_object->getContent();
$msg=$_GET['msg'];
$tp=str_replace("{MSG}",$msg,$tp);
//require_once("includes/footer_signup.php");
?>