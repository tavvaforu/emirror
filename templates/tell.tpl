
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
   
    	    <li><a href="index.php?file=m-messages" ><img src="{IMG_URL}expression.gif" width="16" height="11" />Expressions</a></li>

            <li><a href="index.php?file=t-trigger" ><img src="{IMG_URL}news_feed.gif" width="16" height="16" />Daily Trigger</a></li>

            <li><a href="index.php?file=j-journal" ><img src="{IMG_URL}journalicon.gif" width="16" height="16" />Journal</a></li>

            <li><img src="{IMG_URL}events_icon.gif" width="16" height="16" /><a href="index.php?file=me-memories" >Memories</a></li>

         </ul>

       </div>

      <div><h3>APPLICATIONS</h3></div>

     <div class="favor">

	  <ul>

    	<li><a href="index.php?file=p-photos" ><img src="{IMG_URL}camera.gif" width="16" height="16" />Photos</a></li>

        <li><a href="index.php?file=v-videos"><img src="{IMG_URL}video.gif" width="16" height="16" />Videos</a></li>

        <li><a href="index.php?file=e-eventcal"><img src="{IMG_URL}events.gif" width="16" height="16" />Events</a></li>

    </ul>

    </div>

 
    <div><h3>SETTINGS</h3></div>

    <div class="favor">

	<ul>

        <li><a href="index.php?file=s-profile"><img src="{IMG_URL}profile_pic.gif" width="16" height="16" />Profile</a></li>

    	<li><a href="index.php?file=s-dashboard"  ><img src="{IMG_URL}dashboard.gif" width="16" height="16" />Dashboard</a></li>

        <!-- <li><a href="notification.hml"><img src="{IMG_URL}notification.gif" width="16" height="16" />Notification </a></li> -->

    </ul>

   </div>

  </div>
 <!--firstdiv Ends-->
 <!--profiles Starts-->
 <div id="profiles">

  <div class="clear"></div>
  
   <div class="innerdiv">
    <div class="content" id="page-1">
    <div class="dailytriggertabs">
    <div style="width:700px; padding:10px 0;">
      <div style="width:690px; float:left; padding:5px 10px; background:#eceded; margin-bottom:20px;">
      <span style="font-size:12px; font-weight:bold; color:#0075b7;">Refer Friend(s) </span>
      </div>   
      <form name="profileform" method="POST" class="form label-inline" action="index.php?file=fr-sent"  enctype="multipart/form-data">
<div > <span> <font color="red"><b>&nbsp;&nbsp;&nbsp;{MESSAGE}</b></font></span></div>
		<input type="hidden" name="alid" value="{ALBUM_ID}">
		<input type="hidden" name="mode" id="mode" value="{MODE}">
		<input type="hidden" name="Aphoto" value="{ALBUMPHOTO}">
		
       <div class="field"><label for="fname">Name </label> <input id="name" name="name" size="50" type="text" class="medium" value="{name}" readonly="readonly" /></div>
	   <div class="field"><label for="fname">Email </label> <input id="email" name="email" size="50" type="text" class="medium" value="{email}" readonly="readonly" /></div>
	   <div class="field"><label for="description">Friend's Email </label> <textarea rows="7" cols="45" name="cemails" id="cemails"></textarea></div>
	   <div class="field"><label for="fname">Subject </label> <input id="subject" name="subject" size="50" type="text" class="medium" value=""/></div>
       <div class="field"><label for="description">Message</label> <textarea rows="7" cols="45" name="message" id="message"></textarea></div>

</div>
</div>
{BTN}
        <input id="Cancel" name="Cancel" class="inr_btn" type="button" value="Cancel" onclick="window.location.href='index.php?file=m-messages';" />
</form>
    <div class="clear"></div>
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
 <script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>
<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>
<script type="text/javascript">
//<![CDATA[
function validInput(string)
{
re=/[<>]/;
return re.test(string);
}
	
function validateFormnew()
{
if($('#cemails').val()==''){
alert('Please enter email address(es)');
$('#cemails').focus();
return false;
} else {
if(validInput($('#cemails').val()))
{
alert("Please enter valid email address(es)");

$('#cemails').val('sss');
$('#cemails').focus();
return false;
}
else
{
}
}
email=$('#cemails').val();
emails=email.split(',');
len=emails.length;
val=0;
for(i=0;i<len;i++)
{
	emailid=emails[0];
	if(isValidEmailAddress(emailid))
	{

	} 
	else {
	alert('Please enter valid email address');
	//val=1;
	//break;
	return false;
	}

}
if($('#subject').val()==''){
alert('Please enter subject');
$('#subject').focus();
return false;
}
if($('#message').val()==''){
alert('Please enter message');
$('#message').focus();
return false;
}


/* if($('#emailAddress').val()==''){
$('#divEmailAddress').html($('#emailAddress').attr("title"));
$('#divEmailAddress').show('slow');
$('#emailAddress').focus();
return false;
} else {
if(isValidEmailAddress($('#emailAddress').val()))
{
$('#divEmailAddress').html('');
} else {
$('#divEmailAddress').html('Please enter valid email address');
return false;
}

}*/

}
	

//]]>
</script>



