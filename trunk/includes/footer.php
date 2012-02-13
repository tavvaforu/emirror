  <div id="footer">
    <div class="footer_wrap"><a href="index.php">Home</a>
     <?php
	
	$res=mysql_query("select * from menu where status='1'");
	while($ar=mysql_fetch_array($res))
	{
		echo "| <a href='index.php?file=u-article&art_id=".$ar['article_id']."' >".ucwords($ar['title'])."</a>";
	}
	?>
           
       </div>
    <div class="copywrite">&copy; 2011 Emotions Mirror All Rights Reserved</div>
  </div>
  
</body>
</html>
<?php
if($_SESSION["sess_firstname"]!="" ){
?>
<script src="<?php echo SCRIPTS_ROOT; ?>activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['page-1', 'page-2', 'page-3']);
</script>

<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>
<? } ?>
