<?php
if(!session_is_registered("sess_memberid") || $_SESSION["sess_memberid"] == ""){
require_once("includes/header_signup.php");
} else {
	require_once("includes/header.php");
}

$tpl_object = new Template("templates/article");
$tp = $tpl_object->getContent();

$art_id=$_GET['art_id'];
$res=mysql_query("select * from article where id='$art_id'");
$arr=mysql_fetch_array($res);
$tp=str_replace("{ART_TITLE}",$arr['title'],$tp);
$tp=str_replace("{ART_DESC}",$arr['description'],$tp);
?>