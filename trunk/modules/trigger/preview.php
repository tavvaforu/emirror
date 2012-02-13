<?php
$date=date("Y-m-d");

?>
<link href="css/template.css" rel="stylesheet" type="text/css" />

<div style="margin:0 0 10px 0; padding:0; width:400px">
<div style="background:#F3F3F3; height:20px; padding:5px; width:400px;">

<div style="font-size:14px; font-weight:bold; float:left; ">Preview </div>
<div style=" width:100px; font-size:12px; font-weight:bold; float:right;"><?=$date?> </div>

</div>
 <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:300px; float:left;" ><b>&nbsp;&nbsp;&nbsp;&nbsp;Name:</b>&nbsp;&nbsp;<span id="nameid"></span></label>
<label class="desc" id="title1" for="Field1" style="margin-top:5px; width:300px; float:left;" >&nbsp;&nbsp; <b>Email Id:</b><span style="color:#666; padding-left:20px" id="email"> </span></label>


  <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:600px; float:left;">&nbsp;&nbsp;<b>Message Intensity</b>
  <span style=" padding:0 20px; margin-right:20px; color:#999" id="color_id"></span>
  </label>
  
 <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:600px; float:left;"><b>&nbsp;&nbsp; Emotion Type</b><span style=" padding-left:20px" id="intensity"></span>
 </label>
<div class="clear"></div>
<label class="desc" id="title1" >&nbsp;&nbsp;<b>Message:</b>&nbsp;&nbsp;
<span id="message">
 <pre style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; margin-top:15px;">
 
 
 </pre>
 </span></label>
 <div> 


<div class="clear"></div>
<div class="clearall"></div>
<script>
var name=window.opener.document.getElementById('Field3').value;
var email=window.opener.document.getElementById('email').value;
var intensity=window.opener.document.getElementById('intensity').value;
var color_id=window.opener.document.getElementById('color_id').value;
//alert(color_id);
var message=window.opener.document.getElementById('message').value;
document.getElementById('nameid').innerHTML = name;
document.getElementById('email').innerHTML = email;
document.getElementById('intensity').innerHTML = intensity;
document.getElementById('color_id').innerHTML =color_id;
document.getElementById('message').innerHTML = message;
</script>

   