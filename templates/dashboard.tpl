
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

    	<li><a href="index.php?file=s-dashboard"><img src="{IMG_URL}dashboard.gif" width="16" height="16" /><span  class="actv">Dashboard</span></a></li>

        <!-- <li><a href="notification.hml"><img src="{IMG_URL}notification.gif" width="16" height="16" />Notification </a></li> -->

    </ul>

   </div>

  </div>
 <!--firstdiv Ends-->
 <!--profiles Starts-->
 <div id="profiles">  
   <div class="innerdiv">
    <div class="content" id="page-1">
		<div class="dailytriggertabs">
			   <div style="width:700px; padding:10px 0;">

						<div style="width:660px; float:left; padding:5px 10px; background:#eceded; margin-bottom:20px;">
							<span style="font-size:12px; font-weight:bold; color:#0075b7;">Dashboard Settings</span>
						</div>
						<div > 
							<span> <font color="red"><b>&nbsp;&nbsp;&nbsp;{msg}</b></font></span>
						</div>
						<form action="index.php?file=s-dashboard" name="dashboardform" method="POST" enctype="multipart/form-data">

							<div class="clear"></div>
							<span style="color:red">{MSG}</span><br /><br />
							<div style="width:500px; margin:0 auto; padding:0;">
							{data}
							<input id="saveForm" name="saveForm" class="inr_btn" type="submit" value="Save"/>
							</div>
						</form>

				</div>
		</div>
   </div>
</div>
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
$('input[name=message]').change(function () 
{      
if(this.value != '1'){  
        $('input[name=msummary]').attr('disabled', 'disabled').attr('checked', false); 
		$('input[name=mIntensity]').attr('disabled', 'disabled').attr('checked', false); 
		$('input[name=mSent]').attr('disabled', 'disabled').attr('checked', false);      
		} 
		else {          $('input[name=msummary]').removeAttr('disabled');  
						 $('input[name=mIntensity]').removeAttr('disabled');
						  $('input[name=mSent]').removeAttr('disabled');    
		}  
		}); 
		$('input[name=Journals]').change(function () 
{      
if(this.value != '1'){  
        $('input[name=jSummary]').attr('disabled', 'disabled').attr('checked', false); 
		$('input[name=jShared]').attr('disabled', 'disabled').attr('checked', false);  
		} 
		else {          $('input[name=jSummary]').removeAttr('disabled');  
						 $('input[name=jShared]').removeAttr('disabled');
		}  
		}); 
		$('input[name=Triggers]').change(function () 
{      
if(this.value != '1'){  
        $('input[name=tSummary]').attr('disabled', 'disabled').attr('checked', false); 
		$('input[name=tShared]').attr('disabled', 'disabled').attr('checked', false); 
		$('input[name=tIntensity]').attr('disabled', 'disabled').attr('checked', false);      
		} 
		else {          $('input[name=tSummary]').removeAttr('disabled');  
						 $('input[name=tShared]').removeAttr('disabled');
						  $('input[name=tIntensity]').removeAttr('disabled');    
		}  
		}); 
/*function changemsgrd()
{

	if(document.getElementById("message").checked==false)
	{
		document.getElementById("msummary").disabled = true; 
		document.getElementById("mIntensity").disabled = true; 
		document.getElementById("mSent").disabled = true; 
	}else
	{
		document.getElementById("msummary").disabled = false; 
		document.getElementById("mIntensity").disabled = false; 
		document.getElementById("mSent").disabled = false; 
	}

}*/
</script>