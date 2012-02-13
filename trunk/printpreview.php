<?php
require_once("inc/config.inc.php");
$obj=new emirror_config;
$db=new myclass;
$db->myconnect();

$id=$_GET['messageid'];
$my_res=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and a.id='$id'");
$my_arr=mysql_fetch_array($my_res);
//echo '<pre>';print_r($my_arr);exit;
$id=$my_arr['id'];
$message=$my_arr['message'];
$title=$my_arr['title'];
$anonymous=$my_arr['anonymous'];
if($_GET['stype'] == 2)
{
	if($anonymous != 1)
	{
	$email=$my_arr['sender_email'];
	$sender=$my_arr['sender_name'];
	} else {
	$email='';
	$sender='';
	}
} else {
	$email=$my_arr['email'];
	$sender=$my_arr['name'];
}
$id=$my_arr['id'];
$date=$db->displayDateFormat($my_arr['create_time']);

$message_intensity=$my_arr['message_intensity'];
$colid=$my_arr['color_id'];


$attachres=mysql_query("select * from trigger_attachments where trigger_id=$id");
$i=1;
while($ar=mysql_fetch_array($attachres))
{
	$fil=$ar['attachments'];
	$flname = explode('_-_',$fil);
	//echo '<pre>';print_r($flname);exit;
	//echo count($flname);
	if(count($flname)>1)
	{
		$atchName = $flname[1];
	} else {
		$atchName = $fil;
	}
	$attachid=$ar['id'];
$res.="<a href='media/trigger_files/".$fil."' target='_blank' >".$atchName."</a>&nbsp;&nbsp;&nbsp;" ;
//$res.='<a href="#" onclick="return removefile('.$attachid.','.$id.')";>Remove</a><br>' ;
$i++;

}
?>
<link href="<?php echo STYLES_ROOT; ?>template.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>tab.css" rel="stylesheet" type="text/css" />
<link href="<?php echo STYLES_ROOT; ?>form.css" rel="stylesheet" type="text/css" />
<body  onload="javascript:window.print();">
  <div class="innerdiv">
    <div class="dailytriggertabs">
     <form id="form66" name="form66" >
<ul>
  <div class="clearall"></div>
<li id="foli1" class="complex">


<div style=" background-color:#FFF; border:2px solid #749abe; padding:5px;">
 
<div style=" width:120px; font-size:12px; font-weight:bold; float:right;"><?=$date?></div>
<div style="font-size:14px; font-weight:bold; float:left; "><?php echo $title;?> </div>
 <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:300px; float:left;" ><span><?php echo $sender;?></span> <span style="color:#666; padding-left:20px"><span style="color:#666; padding-left:20px"><?php echo $email;?><span> </span>
</label>

  <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:600px; float:left;">Message Intensity<span style=" padding:0 20px; margin-right:20px; color:#999"><span style="color:#666; padding-left:20px"><?php echo $message_intensity;?></span></span>
  Emotion Type&nbsp;<?php echo "<span style='margin:0;padding:0 5px;height:10px;width:20px;background-color:#$colid'>&nbsp;</span>";?></span>
  </label>


</label>
<div class="clear"></div>
<label>
<span>
<?php echo nl2br($message);?>
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
document.getElementById('email').innerHTML = '<span style="color:#666; padding-left:20px">'+email+'<span>';
document.getElementById('intensity').innerHTML = '<span style="color:#666; padding-left:20px">'+intensity+'</span>';

document.getElementById('message_pr').innerHTML ='<p style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; margin-top:15px;">'+message+'</p>';

</script>

