<?php
define(SITE_ROOT,$_SERVER['DOCUMENT_ROOT']."/emirror/");
include(SITE_ROOT.'/inc/config.inc.php');
include(SITE_ROOT.'/inc/pagination1.php');
define(TEMP_ROOT,SITE_ROOT.'/templates/');
$db=new myclass;
$db->myconnect();
$colorid=$_GET['colorid'];
$curdate=date("Y-m-d");
$date=$db->displayDateFormat($curdate);
$my_res=mysql_query("select message_intensity from 	message_intensity where id=".$colorid);
$my_arr=mysql_fetch_array($my_res);
$colid=$my_arr['message_intensity'];
$tp=str_replace("{ATTACH}",$res,$tp);
?>
<link href="<?php echo STYLES_ROOT; ?>template.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>tab.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>form.css" rel="stylesheet" type="text/css" />

  <div class="innerdiv">
    <div class="dailytriggertabs">
     <form id="form66" name="form66" >
<ul>
  <div class="clearall"></div>
<li id="foli1" class="complex">


<div style=" background-color:#FFF; border:2px solid #749abe; padding:5px;">
<div style="background:#F3F3F3; height:20px; padding:5px; width:650px;">

<div style="font-size:14px; font-weight:bold; float:left; ">Title </div>
<div style=" width:100px; font-size:12px; font-weight:bold; float:right;"><?=$date?></div>

</div>
 <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:300px; float:left;" >To: <span id="nameid"></span> <span style="color:#666; padding-left:20px" id="email"> </span>
</label>

  <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:600px; float:left;">Message Intensity<span style=" padding:0 20px; margin-right:20px; color:#999" id="intensity"></span>
  Emotion Type&nbsp;<?php echo "<span style='margin:0;padding:0 5px;height:10px;width:20px;background-color:#$colid'>&nbsp;</span>";?></span>
  </label>


</label>
<div class="clear"></div>
<label>
<span id="message_pr">

</span></label>
</div>
<div class="clear"></div>
<div class="clearall"></div>
</li>
</ul>
</form>
    </div>
    </div>    
  <div class="clear"></div>
   </div>
   <div class="clear"></div>
</body>
</html>
<script>
var name=window.opener.document.getElementById('Field3').value;
var email=window.opener.document.getElementById('email').value;
var intensity=window.opener.document.getElementById('intensity').value;
var color_id=window.opener.document.getElementById('color_id').value;
//alert(color_id);
var message=window.opener.document.getElementById('message').value;
document.getElementById('nameid').innerHTML = name;
document.getElementById('email').innerHTML = '<span style="color:#666; padding-left:20px"><'+email+'><span>';
document.getElementById('intensity').innerHTML = '<span style="color:#666; padding-left:20px">'+intensity+'</span>';

document.getElementById('message_pr').innerHTML ='<p style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; margin-top:15px;">'+message+'</p>';

</script>
