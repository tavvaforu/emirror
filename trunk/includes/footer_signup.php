  <div id="footer">
    <div class="footer_wrap"><a href="index.php">Home</a>
     <?php
	
	$res=mysql_query("select * from menu where status='1'");
	$fooLink ='';
	while($ar=mysql_fetch_array($res))
	{
		$fooLink.= "| <a href='index.php?file=u-article&art_id=".$ar['article_id']."' >".ucwords($ar['title'])."</a>";
		//echo "| <a href='index.php?file=u-article&art_id=".$ar['article_id']."' >".ucwords($ar['title'])."</a>";
	}
	  $fooLink=$fooLink."| <a href='http://faq.emotionsmirror.com/' target='_blank'>FAQ's</a> | <a href='#' target='_blank'>Forums</a>";
	  //$fooLink=$fooLink."| <a href='javascript:alert('')' target='_blank'>Forums</a>";
	?>
           
       <?php echo $fooLink;?></div>
    <div class="copywrite">&copy; 2011 Emotions Mirror LLC.All Rights Reserved</div>
  </div>
  
</body>
</html>
