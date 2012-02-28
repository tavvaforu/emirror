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
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29451841-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
