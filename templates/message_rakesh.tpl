
<link href="{STYLE_URL}template.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
 <!--[if lte IE 7]>
<link href="{STYLE_URL}style.ie.css" rel="stylesheet" type="text/css" /><![endif]-->	
<script src="{SCRIPT_URL}jalerts/jquery.ui.draggable.js" type="text/javascript"></script>
<script src="{SCRIPT_URL}jalerts/jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="{SCRIPT_URL}common.js" ></script>
<link href="{SCRIPT_URL}jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<!-- Arquivos utilizados pelo jQuery lightBox plugin -->

    <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="{SCRIPT_URL}jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="{SCRIPT_URL}jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">
			$(function() {			
			if(document.getElementById("intensity").value!="")
			{
			   a=document.getElementById("intensity").value;
			}else{
			   a=1;
			 }
		$( "#slider-range-min" ).slider({
			range: "min",
			value: a,
			min: 1,
			max: 5,
			slide: function( event, ui ) {
				$( "#intensity" ).val(ui.value );
			}
		});
		$( "#intensity" ).val( $( "#slider-range-min" ).slider( "value" ) );
	});
		</script>
		<style type="text/css">
			/*demo page css*/
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>	

<!--[if lte IE 6]>
   <script type="text/javascript" src="{SCRIPT_URL}supersleight-min.js"></script>
<![endif]-->

	<!--<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>-->
<!-- Script End-->

<!--divs body section-->

    <div id="inner_screen">
   <div class="login_box">
     
    <div id="innerpage-wrap">
       <div id="maincontent">
<!--firstdiv Starts-->
	<div class="firstdiv">    
    	<div class="profilepic"><img src="{dsImage}" width="100" height="100" /></div>
        	<div class="edittext"><a href="index.php?file=s-profile">Edit profile pic</a></div>
<div>
  <h3>FAVORITES</h3>
</div>
<div class="favor">
	<ul>
    	<li><a href="messages.php#page=page-2" class="actv" ><img src="{IMG_URL}mail_icon.gif" width="16" height="11" class="actv" />Expressions</a></li>
        <li><a href="../trigger/trigger.php#page=page-2" ><img src="{IMG_URL}news_feed.gif" width="16" height="16" />Daily Trigger</a></li>
        <li><a href="../journal/journal.php#page=page-2" ><img src="{IMG_URL}journalicon.gif" width="16" height="16" />Journal</a></li>
        <li><img src="{IMG_URL}events_icon.gif" width="16" height="16" /><a href="memories.htm" >Memories</a></li>
   </ul>
</div>
<div>
    <h3>APPLICATIONS</h3>
    </div>
    <div class="favor">
	<ul>
    	<li><a href="photos.html" ><img src="{IMG_URL}camera.gif" width="16" height="16" />Photos</a></li>
        <li><a href="videos.html"><img src="{IMG_URL}video.gif" width="16" height="16" />Videos</a></li>
        <li><a href="events.html"><img src="{IMG_URL}events.gif" width="16" height="16" />Events</a></li>
    </ul>
   </div>
   
   <div>
    <h3>SETTINGS</h3>
    </div>
    <div class="favor">
	<ul>
        <li><a href="profile.html"><img src="{IMG_URL}profile_pic.gif" width="16" height="16" />Profile</a></li>
    	<li><a href="dashboard.html"  ><img src="{IMG_URL}dashboard.gif" width="16" height="16" />Dashboard</a></li>
  <!--      <li><a href="application.html"><img src="{IMG_URL}dicription_icon.gif" width="16" height="16" />Application </a></li>-->
        <!-- <li><a href="notification.hml"><img src="{IMG_URL}notification.gif" width="16" height="16" />Notification </a></li> -->
    </ul>
   </div>
</div>
 <!--firstdiv Ends-->
 <!--profiles Starts-->
 <div id="profiles">
 
  <div style="width:685px; background:#FFF; margin:10px; border:1px solid #5aa3bf; padding:10px; height:25px;">
    
    <ul style="list-style:none;">
    <span class="imgcapicons"><li><a id="various3" href="#"  rel="tooltip" title="Capture Image"><img src="{IMG_URL}webcam_icon.gif" width="20" height="20" alt="image capture" /></a></li>   
    </span>
   <span class="imgcapicons"> <li><a href="#"  rel="tooltip" title="Import"><img src="{IMG_URL}import.png" width="20" height="20" alt="Import" /></a></li>   
    </span>
   <span class="imgcapicons"> <li><a href="#"  rel="tooltip" title="Export"><img src="{IMG_URL}export.png" width="20" height="20" alt="Export" /></a></li>  
    </span></ul>
 
  </div>
 
  <div class="clear"></div>
  
   <div class="innerdiv">
  
    <div id="toc">  
     <ul>
      <li><a href="#page-1">{tab_name}</a></li>
      <li><a href="#page-2"><span>View</span></a></li>
      <li><a href="#page-3"><span>Analysis</span></a></li>
    </ul>
    </div>
<form enctype="multipart/form-data" id="messageform" name="messageform" method="POST" action="messages.php" >
    <div class="content" id="page-1">
    <div class="dailytriggertabs">

<input type="hidden"  name="intensity" id="intensity"   value="{INTENSITY}"/>
<input type="hidden"  name="color_id" id="color_id"   value="{EMOTION}"/>
<input type="hidden"  name="draftid" id="draftid"   value="{DRAFTID}"/>
<input type="hidden" name="unums" value="1" id="unums"  />

<div>
<span class="left city">
<label class="desc" id="title1" for="Field1">Receiver Name
</label>
<input id="Field3" name="sname" type="text" class="fromfile" value="{REC_NAME}" tabindex="8" />
</span>
<span class="right state">
<label class="desc" id="title1" for="Field1">
Receiver Email Address
</label>
<input id="email" name="email" type="text" class="fromfile" value="{REC_EMAIL}" tabindex="9" />
</span></div>


<br />


<label style="width:450px; float:left; font-weight:bold;" id="title7" for="Field7">
Emotion Type</label>
<label  style="float:left; font-weight:bold;"id="title7" for="Field7">
Intensity</label>



      <div class="clear"></div>
      <div class="colorbg" style="margin-left:0px;">
       <ul id="mycolorband">
         <li><a href="javascript:void(0);" style="width:auto" onclick="document.getElementById('color_id').value=1;change_bg('anger');" id="anger" name="anger" >Anger</a></li>
         <li><a href="javascript:void(0);" style="width:80px" onclick="document.getElementById('color_id').value=2;change_bg('anticipation');" id="anticipation" name="anticipation" >Anticipation</a></li>
         <li><a href="javascript:void(0);" style="width:65px" onclick="document.getElementById('color_id').value=3;change_bg('joy');" id="joy" name="joy" >Joy</a></li>
         <li><a href="javascript:void(0);" style="width:65px" onclick="document.getElementById('color_id').value=4;change_bg('trust');" id="trust" name="trust" >Trust</a></li>
         <li><a href="javascript:void(0);" style="width:60px" onclick="document.getElementById('color_id').value=5;change_bg('fear');" id="fear" name="fear" >Fear</a></li>
         <li><a href="javascript:void(0);" style="width:70px" onclick="document.getElementById('color_id').value=6;change_bg('surprise');" id="surprise" name="surprise" >Surprise</a></li>
         <li><a href="javascript:void(0);"  onclick="document.getElementById('color_id').value=7;change_bg('sadness');" id="sadness" name="sadness" >Sadness</a></li>
       </ul></br>
	   <div class="imgtext"><a href="#">Help me Choose Emotion type?</a></div>
      </div>
      <div id="slider-range-min" style="width:230px; float:right; margin-top:10px;"></div>
<div style="width: 230px;float:right;padding-right: 1px;"> <div style="width: 55px;float:left;" alt="Low" title="Low">1</div> <div style="width: 55px;float:left;" title="Moderate" alt="Moderate">2</div><div style="width: 60px;float:left;" title="High" alt="High">3</div><div style="width:35px;float:left;" title="very High" alt="very High">4</div><div style="width:10px;float:right;" title="Extream" alt="Extream">5</div></div>    <br />
    <div class="clear"></div>
 


<label class="desc" id="title1" for="Field1">
Expression | <span >

Voice Recorder</span>
<span style="width:100px; float:left;"> <input id="" name="" class="v_icon" type="button" value=""/></span></label>

<div style="margin-top:5px;">
<span class="full addr1">
<textarea name="message" cols="62" class="fromfiletextarea" style="height:100px; overflow:auto;" id="message" tabindex="6">{MESSAGE}</textarea>
</span></div>

<ul>

<br />

<li id="foli1" class="complex">
{ATTACH}
  <label class="desc" id="title7" for="Field7">
Attachment(s)</label>
<input type="file" name="attachment_1" id="attachment_1" value="" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" />
<div id="moreUploads"></div>
<div id="moreUploadsLink" style="display:none;"><a style="line-height: 30px;
color: #333;
padding: 0 0 0 0px;
font-weight: normal;
text-decoration: underline;" href="javascript:addFileInput();">Attach another File</a></div>

</li>

<br />
<!--
<li id="foli1" class="complex">

<span style="float:left; width:150px; margin-top:10px; padding-bottom:10px;">
<a href="#"><img src="{IMG_URL}facebook_icon.gif" width="16" height="16"  style="margin: 0 2px;"/></a>
<a href="#"><img src="{IMG_URL}twitter_icon.gif" width="16" height="16" style="margin: 0 2px;" /></a>
    </span>
    </li>-->
    
    
<li class="buttons ">

  <div>{DRAFT_BTN}
  <input id="saveForm" onclick="javascript:window.location='messages.php?id={DRAFTID}';" name="saveForm" class="inr_btn" type="button" value="Cancel"
 />


 </div>
</li>
</ul>
</form>
    </div>
    </div><form name="frmsearch" id="frmsearch">
	<input type="hidden" name="mode" id="mode" value="">
  <!--<form enctype="multipart/form-data" id="messageform1" name="messageform1" method="POST" action="messages.php?stype={stype}#page=page-2" >-->
    <div class="content" id="page-2">
    <div class="dailytriggertabs">
    <div style="margin:0 auto; padding:10px 10px; height:30px;">
    <fieldset>
    <label id="title1" for="Field1"> Search </label>
    <input id="keyword" name="keyword" type="text" class="field text" value="{keyword}" size="38" tabindex="1" style="margin-right:10px;" />
    <label id="title1" for="Field1"> Date Range </label>
    <input  type="text" id="fromdate" name="fromdate"class="field text ln" value="{fromdate}" size="12" tabindex="3" />&nbsp;<a href="#" style="margin-right:10px;" id="f_btn1"><img src="{IMG_URL}cal1.gif" width="16" height="16" /></a>
    <label id="title1" for="Field1"> To</label>
    <input id="todate" name="todate" type="text" class="field text ln" value="{todate}" size="12" tabindex="3" />&nbsp;<a href="#" style="margin-right:10px;" id="f_btn2"><img src="{IMG_URL}cal31.gif" width="16" height="16" /></a>
   <input  id="saveForm" name="saveForm" class="inr_btn" type="button" value="Go" onclick="return valid_search('messages.php?stype=1');"/>
   </fieldset>
   </div>
   <div class="clear"></div>
 </form>
<form method="POST" action="messages.php">

<input type="hidden" name="stype" id="stype" value='{stype}'>
<ul>
<li id="foli7">
<div>

<div class="editr">  {PAGING}</div>
<div class="mlinks">{RECEIVED} l  {SENT} l {DRAFT}  </div>
<span><font color="red"><b>{msg}</b></font></span>
</div>
</li>



<div class="clearall"></div>
<li id="foli1" class="complex">
<div style="margin:10px 0; padding:0;">
<input  id="saveForm" name="saveForm" class="inr_btn" type="submit" value="Delete"/>
</div>
<div style="height:30px; background-color:#749abe;">
<span style="margin:0px 0px 2px 0px; padding:5px 0px 0px 0px; width:120px;">
<label class="choice" for="Field0_0" style="padding-left:10px; padding-right:5px; margin:0px;" ><input name="Check_All" type="checkbox"   id="Check_All" onClick="CheckAll(document.getElementsByName('check_list[]'))"  style="margin-right:5px;"/><strong>Expressions</strong>
 {MSG_SORT}
</label></span>
 
<div style="float:left; width:auto; margin:0px 0px 0px 15px; padding:7px 0px 0px 50px; color:#000;"  >
<strong>{SENDER_HEAD}</strong>
{SENDER_SORT}
</div>
<div style="float:left; width:auto; margin:0px 0px 0px 40px; padding:7px 0px 0px 20px; color:#000;" >
<strong>Date</strong>
{TIME_SORT}
</div>
<div style="float:left; width:auto; margin:0px 0px 0px 20px; padding:7px 0px 0px 20px; color:#000;" >
<strong> Emotion Type</strong>

</div>
<div style="float:left; width:auto; margin:0px 0px 0px 10px; padding:7px 0px 0px 10px; color:#000;" >
<strong> Intensity{INTENSITY_SORT}</strong>

</div>
<div style="float:left; width:auto; margin:0px 0px 0px 20px; padding:7px 0px 0px 20px; color:#000;" >
<strong>Actions</strong>

</div>
</div><!--<input type="text" name="mid" id="mid" value="">
<input type="text" name="mode" id="mode" value="">-->
{MESSAGES}
<div class="clear"></div>

<div style="margin:10px 0; padding:0;">
<input  id="saveForm" name="saveForm" class="inr_btn" type="submit" value="Delete"/>
</div>

<div class="clearall"></div>


<div class="clearall"></div>
</li>

<div class="clearall"></div>
</ul>
</form>
    </div>
    </div>

    <div class="content" id="page-3">
    <div class="dailytriggertabs">
	 <form id="form" name="form66" >
	           <div class="messagesdivv">
	    	  <h2>&nbsp;&nbsp;Expressions</h2>
              <div class="nuumbers"><img src="{IMG_URL}mail_icon.gif" width="16" height="11" />Number of Expressions Received: {TOT_RECEIVED}</div>
              <div class="nuumbers"><img src="{IMG_URL}received_icon.gif" width="16" height="15" />Number of Expressions Posted: {TOT_SENT}</div><div class="clearall"></div>
	           </div> 
               
               <div class="charts">
  <div class="chartbox">
  <h3>Sent</h3>
  <h4>{SENT_CHT}</h4></div>
  <div class="chartbox">
  <h3>Received</h3>
  <h4>{REC_CHT}</h4>
  </div>
</div>
	       			  
	        </form>
    </div>
    </div>
  
  </div>

 </div> 
 <!--profiles Ends-->
 <!--<div class="thirdiv"><img src="{IMG_URL}ADD.jpg" width="120" height="450" /></div>-->
  	
 <!--third div starts-->     
</div>

<div class="clearall"></div>

</div> 

    </div>
    </div>
		<!--- calendar setups-->
  <script src="{SCRIPT_URL}JSCal2-1.9/src/js/jscal2.js"></script>
    <script src="{SCRIPT_URL}JSCal2-1.9/src/js/lang/en.js"></script>
	<link rel="stylesheet" type="text/css" href="{SCRIPT_URL}JSCal2-1.9/src/css/jscal2.css" />
<script src="{SCRIPT_URL}activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['page-1', 'page-2', 'page-3']);
</script>
<script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>
<script type="text/javascript">
cssdropdown.startchrome("chromemenu");

function CheckAll(chk)
{

if(document.getElementById('Check_All').checked)
{
var ids="";
for (i = 0; i < chk.length; i++){
chk[i].checked = true ;
//ids=chk[i].value ;
//ids+=',';
}

}
else
{
for (i = 0; i < chk.length; i++)
chk[i].checked = false ;
}
}

var upload_number = 2;
function addFileInput() {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", "attachment_"+upload_number);
 	d.appendChild(file);
 	document.getElementById("moreUploads").appendChild(d);
	document.getElementById("unums").value=upload_number;
 	upload_number++;
	
}

//<![CDATA[

      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: true
      });
      cal.manageFields("f_btn1", "fromdate", "%Y-%m-%d");
      cal.manageFields("f_btn2", "todate", "%Y-%m-%d");
    //]]
	

</script>
<script>
//alert(document.frmsearch.keyword.value);
function valid_search(actPath)
{
	if(document.frmsearch.fromdate.value=="" && document.frmsearch.keyword.value=="" && document.frmsearch.todate.value=="")
	{
		alert("Please Enter alteast one text field for Search.");
		document.frmsearch.keyword.focus();
		return false;
	}
	if(document.frmsearch.keyword.value=="")
	{
		if(document.frmsearch.fromdate.value=="")
		{
			alert("Please Select the From date.");
			document.frmsearch.fromdate.focus();
			return false;
		}
		if(document.frmsearch.todate.value=="")
		{
		 alert("Please Select the Todate.");
		 document.frmsearch.todate.focus();
		 return false;
		}
		var start = document.frmsearch.fromdate.value;
		var end = document.frmsearch.todate.value;
		var stDate = new Date(start);
		var enDate = new Date(end);
		var compDate = enDate - stDate;
		//alert(compDate);
		if(compDate >= 0)
		{
			//alert('true');
			//return true;
		}
		else
		{
		jAlert("Please Enter the correct date ");
		return false;
		}

		
	}
	//alert(actPath);
	document.frmsearch.mode.value="Search";

	if(actPath)
	{
		
		window.location=actPath+"&mode=Search&keyword="+document.frmsearch.keyword.value+"&fromdate="+document.frmsearch.fromdate.value+"&todate="+document.frmsearch.todate.value+"#page=page-2";
		return false;
	}
}	
	

	</script>
	
<script type="text/javascript">
  function change_bg(liid)
  {
	//alert(liid);
	 var arr=document.getElementById("mycolorband").getElementsByTagName("a");
	 //alert(arr.length);
	 for(var i=0;i<arr.length;i++)
	 {
		 aid=arr[i].id;
		 if(aid==liid)
		 {
			 document.getElementById(aid).style.background="url(../../media/images/color_image/"+aid+".png)";
		 }
		 else
		 {
			 document.getElementById(aid).style.background="";
		 }
	 }
  }
cssdropdown.startchrome("chromemenu")
</script>
