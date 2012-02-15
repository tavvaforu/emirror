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
		$( "#slider-range-min" ).slider({
			range: "min",
			value: 2,
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
   
    	    <li><a href="index.php?file=m-messages" class="actv" ><img src="{IMG_URL}expression.gif" width="16" height="11" class="actv" />Expressions</a></li>

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
  <!--<div style="width:685px; background:#FFF; margin:10px; border:1px solid #5aa3bf; padding:10px; height:25px;">
    
    <ul style="list-style:none;">
    <span class="imgcapicons"><li><a id="various3" href="./came.html"  rel="tooltip" title="Capture Image"><img src="{IMG_URL}webcam_icon.gif" width="20" height="20" alt="image capture" /></a></li>   
    </span>
   <span class="imgcapicons"> <li><a href="#"  rel="tooltip" title="Import"><img src="{IMG_URL}import.png" width="20" height="20" alt="Import" /></a></li>   
    </span>
   <span class="imgcapicons"> <li><a href="#"  rel="tooltip" title="Export"><img src="{IMG_URL}export.png" width="20" height="20" alt="Export" /></a></li>  
    </span>
	 <span class="imgcapicons"> <li><a href="#"  rel="tooltip" title="print" onclick="return mypopupMessagePrint({iId},{stype});"/><img src="{IMG_URL}Print _icon.png" width="20" height="20"></a></li>  
    </span></ul>
 
  </div> -->
   <div class="clear"></div>
  
   <div class="innerdiv">
  
    <div class="content" id="page-2">
    <div class="dailytriggertabs">
   
     <form id="form66" name="form66" method="POST" action="index.php?file=m-open_message">
<input type="hidden" name="iId" id="iId" value="{iId}">
<input type="hidden" name="stype" id="stype" value="{stype}">

<ul>

<li id="foli1" class="complex">

<div style="margin:0 0 10px 0; padding:0; width:400px">
<input onclick="window.location.href='index.php?file=m-messages&show={show}&stype={stype}#page=page-2';" id="saveForm" name="saveForm" class="inr_btn" type="button" value="Back to View" /> 
  <input  id="saveForm" name="saveForm" class="inr_btn" type="submit" value="Delete" /> 
{blbtn}
</div>

<div style="  border:2px solid #749abe; padding:5px;">
<div style=" height:20px; padding:5px; width:650px;">
<div><font color="red"><b>{msg}</b></font></div>
<div style=" width:150px; font-size:12px; font-weight:bold; float:right;">{DATE} </div>
</div>
<div class="clear"></div>

 {senderdetails}

  <label class="desc" id="title1" for="Field1" style="margin-top:5px; width:600px; float:left;">Intensity<span style=" padding:0 20px; margin-right:20px; color:#999">{INTENSITY}</span>
  Emotion Type<span style=" padding-left:20px">{EMOTION}</span>
  </label>

<div class="clear"></div>

 <p style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; margin:15px 0;">
 {MESSAGE}
 
 </p>
 <div style="margin:10px 0;">{ATTACH} </div>

<div class="clear"></div>

</div>

<div style="margin:10px 0 10px 0; padding:0; width:400px">
<input onclick="window.location.href='index.php?file=m-messages&stype={stype}#page=page-2';"  id="saveForm" name="saveForm" class="inr_btn" type="button" value="Back to View" /> 
  <input  id="saveForm" name="saveForm" class="inr_btn" type="submit" value="Delete" /> 
{blbtn}
</div>

<div class="clear"></div>

</li>

</ul>
</form>

    </div>
    </div>
    
  <div class="clear"></div>
  
   </div>

   <div class="clear"></div>
   
 </div> 
 

 <!--profiles Ends-->
 <div class="thirdiv"><img src="{IMG_URL}ADD.jpg" width="120" height="450" /></div>
  	
 <!--third div starts-->     
</div>

<div class="clearall"></div>

</div>

    </div>
    </div>
<script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>
<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
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



</script>
