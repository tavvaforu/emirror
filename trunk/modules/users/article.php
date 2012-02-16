<?php
require_once("includes/header.php");

$tpl_object = new Template("templates/articles");
$tp = $tpl_object->getContent();

$art_id=$_GET['art_id'];
$res=mysql_query("select * from article where id='$art_id'");
$arr=mysql_fetch_array($res);
$tp=str_replace("{ART_TITLE}",$arr['title'],$tp);
$tp=str_replace("{ART_DESC}",$arr['description'],$tp);
?>