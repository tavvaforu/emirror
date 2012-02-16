

 <div id="inner_screen">

   <div class="login_box">


    <div id="innerpage-wrap">



       <div id="maincontent">



<!--firstdiv Starts-->



	<div class="firstdiv">    
    	<div class="profilepic"><a href="" target="_blank"><img src="{dsImage}" width="100" height="100" /></a></div>
        	<div class="edittext"><a href="index.php?file=s-profile">Edit profile pic</a></div>



<div>



  <h3>FAVORITES</h3>



</div>



<div class="favor">



	<ul>



    	<li><a href="index.php?file=m-messages"  ><img src="{IMG_URL}mail_icon.gif" width="16" height="11" />Expressions</a></li>



        <li><a href="index.php?file=t-trigger" ><img src="{IMG_URL}news_feed.gif" width="16" height="16" />Daily Trigger</a></li>



        <li><a href="index.php?file=j-journal" ><img src="{IMG_URL}journalicon.gif" width="16" height="16" />Journal</a></li>



        <li><a href="index.php?file=me-memories" ><img src="{IMG_URL}events_icon.gif" width="16" height="16" />Memories</a></li>



   </ul>



</div>



<div>



    <h3>APPLICATIONS</h3>



    </div>



    <div class="favor">



	<ul>



    	<li><a href="index.php?file=p-photos" ><img src="{IMG_URL}camera.gif" width="16" height="16" />Photos</a></li>



        <li><a href="index.php?file=v-videos"><img src="{IMG_URL}video.gif" width="16" height="16" />Videos</a></li>



        <li><a href="index.php?file=e-eventcal"><img src="{IMG_URL}events.gif" width="16" height="16" />Events</a></li>



    </ul>



   </div>



   



   <div>



    <h3>SETTINGS</h3>



    </div>



    <div class="favor">



	<ul>



        <li><a href="index.php?file=s-profile" ><img src="{IMG_URL}profile_pic.gif" width="16" height="16" /><span  class="actv">Profile</span></a></li>



    	<li><a href="index.php?file=s-dashboard"  ><img src="{IMG_URL}dashboard.gif" width="16" height="16" />Dashboard</a></li>



  <!--      <li><a href="application.html"><img src="{IMG_URL}dicription_icon.gif" width="16" height="16" />Application </a></li>-->



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

   

    <div style="width:690px; padding:10px 0;">

      <div style="width:660px; float:left; padding:5px 10px; background:#eceded; margin-bottom:20px;">

        <span style="font-size:12px; font-weight:bold; color:#0075b7;">{ART_TITLE} </span>
        
      </div>   <div > {ART_DESC}</div>




      </div>

    <div class="clear"></div>

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
			<!--- calendar setups-->

    <script src="{SCRIPT_URL}JSCal2-1.9/src/js/jscal2.js"></script>

    <script src="{SCRIPT_URL}JSCal2-1.9/src/js/lang/en.js"></script>

	<link rel="stylesheet" type="text/css" href="{SCRIPT_URL}JSCal2-1.9/src/css/jscal2.css" />

<script>


//<![CDATA[
      var cal = Calendar.setup({

          onSelect: function(cal) { cal.hide() },

          showTime: true

      });
      cal.manageFields("f_btn1", "employee_sdate", "%b %e %Y");
      cal.manageFields("f_btn2", "employee_edate", "%b %e %Y");
	  cal.manageFields("f_btn3", "education_sdate", "%b %e %Y");
	  cal.manageFields("f_btn4", "education_edate", "%b %e %Y");
    //]]
</script>
<script type="text/javascript">

$(document).ready(function(){
 
    var counter = document.getElementById("teno").value;
 	//var counter=5-document.getElementById("teno").value;
    $("#addButton").click(function () {
 
	if(counter>5){
            alert("Only 5 textboxes allow");
            return false;
	}   
 
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
     newTextBoxDiv.attr("class", 'field');
	newTextBoxDiv.html('<label for="fname">Secondary Email'+ counter + ' : </label>' +
	      '<input type="text" class="xsmall" size="30" name="sec_email[]" id="textbox' + counter + '" value="" >');
 
	newTextBoxDiv.appendTo("#TextBoxesGroup");
	counter++;	
	 document.getElementById("teno").value=counter;
     });
 
     $("#removeButton").click(function () {
	if(counter==2){
          alert("No more textbox to remove");
          return false;
       }   
 
	counter--;
     document.getElementById("teno").value=counter;
        $("#TextBoxDiv" + counter).remove();
		

     });
 

  });
</script>
 <script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>

<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>