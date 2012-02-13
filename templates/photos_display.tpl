<meta http-equiv="imagetoolbar" content="no" />

<!--[if lte IE 7]>

 <!--[if lte IE 7]>

<link href="{STYLE_URL}style.ie.css" rel="stylesheet" type="text/css" /><![endif]-->	

<script src="{SCRIPT_URL}jalerts/jquery.ui.draggable.js" type="text/javascript"></script>

<script src="{SCRIPT_URL}jalerts/jquery.alerts.js" type="text/javascript"></script>

<script type="text/javascript" src="{SCRIPT_URL}common.js" ></script>

<link href="{SCRIPT_URL}jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<!-- JQUERY LITEBOX-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	
	<script type="text/javascript" src="{SCRIPT_URL}jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="{SCRIPT_URL}jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="{SCRIPT_URL}jquery.fancybox-1.3.4.css" media="screen" />

	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/
			
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
                   $("a[rel=example_group1]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			
		});
	</script>
	<!---jquery END-->	
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
   
    	    <li><a href="index.php?file=m-messages"><img src="{IMG_URL}expression.gif" width="16" height="11" />Expressions</a></li>

            <li><a href="index.php?file=t-trigger" ><img src="{IMG_URL}news_feed.gif" width="16" height="16" />Daily Trigger</a></li>

            <li><a href="index.php?file=j-journal" ><img src="{IMG_URL}journalicon.gif" width="16" height="16" />Journal</a></li>

            <li><img src="{IMG_URL}events_icon.gif" width="16" height="16" /><a href="index.php?file=me-memories" >Memories</a></li>

         </ul>

       </div>

      <div><h3>APPLICATIONS</h3></div>

     <div class="favor">

	  <ul>

    	<li><a href="index.php?file=p-photos" class="actv" ><img src="{IMG_URL}camera.gif" width="16" height="16" />Photos</a></li>

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
    {albumdisplay}<span style="color:#FF0000; font-size:12px;font-weight:bold;">{MSG}</span><br /><br />
	{album_display}
	{PHOTOS}
    <form name="album" method="POST" action="index.php?file=p-album">
       <input type="hidden" name="albumid" id="albumid" value="{ALBUMID}" />
		
    </form>
	
    <div class="clear"></div>
    </div>
	 <div class="clear"></div>
	<div><input id="Addmore" name="Addmore" class="inr_btn" type="button" value="Add Photos" onclick="window.location.href='index.php?file=p-addalbumphotos&albumid={ALBUMID}';" />
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
</script>