<?php
require_once("includes/header.php");
$obj=new emirror_config;
$tpl_object = new Template("templates/dashboard");
$tp = $tpl_object->getContent();
$memid=$_SESSION["sess_memberid"];
$msg="";
$row=$db->dashboard();

//db data
$dmessage=$row[0]['messages'];
$dmsummary=$row[0]['messages_summary'];
$dmIntensity=$row[0]['messages_intensity'];
$dmSent=$row[0]['messages_sharing'];
$dJournals=$row[0]['journals'];
$djSummary=$row[0]['journals_summary'];
$djShared=$row[0]['journals_shared'];
$dTriggers=$row[0]['triggers'];
$dtSummary=$row[0]['triggers_summary'];
$dtShared=$row[0]['triggers_sharing'];
$dtIntensity=$row[0]['triggers_intensity'];

//post data
$message=$_POST['message'];
$msummary=$_POST['msummary'];
$mIntensity=$_POST['mIntensity'];
$mSent=$_POST['mSent'];
$Journals=$_POST['Journals'];
$jSummary=$_POST['jSummary'];
$jShared=$_POST['jShared'];
$Triggers=$_POST['Triggers'];
$tSummary=$_POST['tSummary'];
$tShared=$_POST['tShared'];
$tIntensity=$_POST['tIntensity'];
if($_POST['saveForm']=="Save")
{
    if(count($row)>0){

	   mysql_query("update profile set journals='$Journals',journals_summary='$jSummary',journals_shared='$jShared',messages='$message',messages_summary='$msummary',
	   messages_sharing='$mSent',messages_intensity='$mIntensity',triggers='$Triggers',triggers_summary='$tSummary',triggers_sharing='$tShared',
	   triggers_intensity='$tIntensity' where user_id='".$memid."'");
		$insid=$row[0]['profile_id'];
	}
	else{
	/*echo "insert into profile(user_id,journals,journals_summary,journals_shared,messages,messages_summary,messages_sharing,messages_intensity,triggers,triggers_summary,triggers_sharing,triggers_intensity)values('$memid','$Journals','$jSummary','$jShared','$message','$msummary','$mSent','$mIntensity','$Triggers','$tSummary','$tShared','$tIntensity')";*/
  		mysql_query("insert into profile(user_id,journals,journals_summary,journals_shared,messages,messages_summary,messages_sharing,messages_intensity,triggers,triggers_summary,triggers_sharing,triggers_intensity)values('$memid','$Journals','$jSummary','$jShared','$message','$msummary','$mSent','$mIntensity','$Triggers','$tSummary','$tShared','$tIntensity')");
		$insid=mysql_insert_id(); 
	}
	if($insid){
		$msg="Record Saved Succesfully";
		}else{
		$msg="Error -in Saving the Record";
		}
	header("location:index.php?file=s-dashboard&msg=$msg");
	exit;
}
if($dmessage==0){
$mflag="disabled";
}
else{
$mflag="";
}
if($dJournals==0){
$jflag="disabled";
}
else{
$jflag="";
}
if($dTriggers==0){
$tflag="disabled";
}
else{
$tflag="";
}
$res.='<ul>';
$res.='<li id="foli0" >
<div style="width:500px; float:left">
<span style="padding-left:5px; width:60px; float:left;"> <strong>Message</strong></span>
<span style="padding-left:5px; width:50px; float:left;">
<input id="message" name="message" type="radio" class="field radio" value="1" ';
if($dmessage==1){
$res.=' checked ';
}
$res.=' /><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;">
<input id="message" name="message" type="radio" class="field radio" value="0" ';
if($dmessage==0){

$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
<br />

<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;"> Messages Summary</span>
<span style="padding-left:5px; width:50px; float:left;"><input id="msummary" name="msummary" type="radio" class="field radio" value="1" '.$mflag;
if($dmsummary==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="msummary" name="msummary" type="radio" class="field radio" value="0" '.$mflag;
if($dmsummary==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>

<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;"> Messages Intensity </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="mIntensity" name="mIntensity" type="radio" class="field radio" value="1" '.$mflag;
if($dmIntensity==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="mIntensity" name="mIntensity" type="radio" class="field radio" value="0" '.$mflag;
if($dmIntensity==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>

<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;"> Messages Sent </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="mSent" name="mSent" type="radio" class="field radio" value="1" '.$mflag;
if($dmSent==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="mSent" name="mSent" type="radio" class="field radio" value="0" '.$mflag;
if($dmSent==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>
</div>
</li>';

$res.='
<li id="foli0" >
<div style="width:500px; float:left">
<span style="padding-left:5px; width:60px; float:left;"> <strong>Journals</strong></span>
<span style="padding-left:5px; width:50px; float:left;"><input id="Journals" name="Journals" type="radio" class="field radio" value="1"';
if($dJournals==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="Journals" name="Journals" type="radio" class="field radio" value="0"';
if($dJournals==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
<br />
<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;"> Journals Summary</span>
<span style="padding-left:5px; width:50px; float:left;"><input id="jSummary" name="jSummary" type="radio" class="field radio" value="1" '.$jflag;
if($djSummary==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="jSummary" name="jSummary" type="radio" class="field radio" value="0" '.$jflag;
if($djSummary==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>

<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;"> Journals Shared </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="jShared" name="jShared" type="radio" class="field radio" value="1" '.$jflag;
if($djShared==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="jShared" name="jShared" type="radio" class="field radio" value="0" '.$jflag;
if($djShared==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>
</div>
</li>

<li id="foli0" >
<div style="width:500px; float:left">
<span style="padding-left:5px; width:60px; float:left;"> <strong>Triggers</strong></span>
<span style="padding-left:5px; width:50px; float:left;"><input id="Triggers" name="Triggers" type="radio" class="field radio" value="1"';
if($dTriggers==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="Triggers" name="Triggers" type="radio" class="field radio" value="0"';
if($dTriggers==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
<br />
<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;"> Triggers  Summary</span>
<span style="padding-left:5px; width:50px; float:left;"><input id="tSummary" name="tSummary" type="radio" class="field radio" value="1"'.$tflag;
if($dtSummary==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="tSummary" name="tSummary" type="radio" class="field radio" value="0"'.$tflag;
if($dtSummary==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>

<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;"> Triggers Shared </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="tShared" name="tShared" type="radio" class="field radio" value="1"'.$tflag;
if($dtShared==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="tShared" name="tShared" type="radio" class="field radio" value="0"'.$tflag;
if($dtShared==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>

<div style="width:300px; padding-left:70px; padding-top:10px; float:left;">
<span style="padding-left:5px; width:120px; float:left;">Triggers Intensity </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="tIntensity" name="tIntensity" type="radio" class="field radio" value="1"'.$tflag;
if($dtIntensity==1){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > Yes</label> </span>
<span style="padding-left:5px; width:50px; float:left;"><input id="tIntensity" name="tIntensity" type="radio" class="field radio" value="0"'.$tflag;
if($dtIntensity==0){
$res.=' checked';
}
$res.='/><label class="choice" for="Field0_0" > No</label> </span>
</div>
</div>
</li>
</ul>';
$tp=str_replace("{MSG}",$_GET['msg'],$tp);
$tp=str_replace("{data}",$res,$tp);
?>
