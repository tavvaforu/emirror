<?php

require_once("includes/header.php");

$checkid=@implode(",",$_POST['check_list']);

$arr=explode(".",$_SERVER['HTTP_HOST']);



//echo '<pre>';print_r($_POST);exit;



//print_r($_GET);

$delid=$_GET['delid'];

$action=$_GET['action'];	

$db=new myclass;

$db->myconnect();

///Added by harinath
/////Unblock the inbox messages
if(isset($_GET['action']) && $_GET['action'] == "unblock")
{
	//echo '<pre>';print_r($_GET);exit;
	$stypeub = $_GET['stype'];
	$orderub = $_GET["order"];
	$session_idub = $_SESSION["sess_memberid"];
	$sql="delete from member_status where ifrom_memid=$session_idub";
	$msg = "Unblocked the expressions.";
	//exit;
	mysql_query($sql);
	header("location:index.php?file=m-messages&stype=2&order=create_time&msg=$msg#page=page-2");

}
////End


///check for displaying Inbox based on received 
$sql_profile_settings=mysql_query("select * from profile where user_id='".$_SESSION['sess_memberid']."'");
$inboxSettings=mysql_fetch_array($sql_profile_settings);
if($inboxSettings['messages'] == 0)
{
	$showExp= 0;
	$tpl_object = new Template("templates/message_disabled");
} else {
	$tpl_object = new Template("templates/message");
	$showExp = 1;
}
if($inboxSettings['messages_summary'] == 1)
{
	$showInbox = 1;

} else {
	$showInbox = 0;

}
if($inboxSettings['messages_sharing'] == 1)
{

	$showSent = 1;
} else {

	$showSent = 0;
}

	if(isset($_POST['anonymous']) && $_POST['anonymous']!=""){

	   $anonymous=$_POST['anonymous'];

	}else{

	  $anonymous=0;

	}

$sql_mem=mysql_query("select * from members where member_id='".$_SESSION['sess_memberid']."'");

$memar=mysql_fetch_array($sql_mem);

$nn=$memar['first_name'];

$tmail=$memar['email'];



$tp = $tpl_object->getContent();

/*if($_POST['mode']=="Delete"){

}*/

//$sql_block=mysql_query("select ito_memid from member_status where ifrom_memid='".$_SESSION['sess_memberid']."'");



//echo '<pre>';print_r($blockedusers);exit;
$blockedusers=$db->getblockedemails();
$blmail=implode(",",$blockedusers);
if($_GET['show'] == 'unblock')
{
	$show = $_GET['show'];
	$unblockGo = 1;
	if(count($blockedusers)>0){
		
		$blocksql =" and sender_email in(".$blmail.")";
	} else {
		$blocksql =" and 1=1";
	}
} else {
	if($_GET['show']=='')
	{
		$show = 'normal';
	} else {
		$show = $_GET['show'];
	}
	$unblockGo = 0;
	if(count($blockedusers)>0){
		$blocksql=" and sender_email not in(".$blmail.")";
	} else {
		$blocksql =" and 1=1";
	}
}
if(isset($_GET['id']) && $_GET['id']!="")

{
$id= $_GET['id'];
//echo '<pre>';print_r($_GET);exit;
//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and a.id='$id'";
  //echo "select a.*,b.message_intensity as color_id,b.desc as motion from messagetrigger a,message_intensity b where a.message_color_id=b.id and a.id='$id'";exit;
  $my_draft=mysql_query("select a.*,b.message_intensity as color_id,b.desc as motion from messagetrigger a,message_intensity b where a.message_color_id=b.id and a.id='$id'");

  $my_arrdraft=mysql_fetch_array($my_draft);

  $id=$my_arrdraft['id'];

  $motion= strtolower($my_arrdraft['motion']);

 $draftmessage=$my_arrdraft['message'];

 $emotion= strtolower($my_arrdraft['motion']);

 $condate=strtotime($my_arrdraft['create_time']);

 $draftdate=date('j M Y',$condate);

 $draftmessage_intensity=$my_arrdraft['message_intensity'];

 $col_id=$my_arrdraft['color_id'];

 $sender=$my_arrdraft['sender_name'];

$anonymous_u=$my_arrdraft['anonymous'];

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

$resattach.="<a href='media/trigger_files/".$fil."' target='_blank' >".$atchName."</a><br>" ;

$i++;



}

}

//echo "select id from messagetrigger where  sender_email='$tmail' and send_type=1  and status!='SDeleted' and status!='Deleted' ";

$r1=mysql_query("select id from messagetrigger where  sender_email='$tmail' and send_type=1  and status!='SDeleted' and status!='Deleted' ");

$tot_sent=mysql_num_rows($r1);

//echo "select id from messagetrigger where  email='$tmail' and status!='RDeleted' and status!='Deleted' ";

$r2=mysql_query("select id from messagetrigger where  email='$tmail' $blocksql and send_type=1 and status!='RDeleted' and status!='Deleted' and anonymous='0'");

$tot_received=mysql_num_rows($r2);





$colorsQuery = mysql_query("SELECT * FROM message_intensity");

$totalColors = mysql_num_rows($colorsQuery);



/////////# of messages sent Graph Code///////////////

$chsent = '';

while($my_colors=mysql_fetch_array($colorsQuery))

{

	$ch1=mysql_query("SELECT message_color_id FROM messagetrigger  where  sender_email='$tmail' and status!='SDeleted' and send_type =1 and status!='Deleted' and message_color_id=".$my_colors['id']);

	

	if(mysql_num_rows($ch1)!=0)

	{

		$nr=mysql_num_rows($ch1);

		if($i1!=$totalColors)

		{

		$chsent.=$nr.",";

		$chcolorCode.=$my_colors['message_intensity'].",";

		$chcolorType.=$my_colors['desc']."|";

		$chcolorcounts.=$nr."|";

		}

		else

		{

		$chsent.=$nr;

		}



	}

}

if($chsent!='')

{

	$chsent = trim($chsent,',');

	$chcolorCode = trim($chcolorCode,',');

	$chcolorType = trim($chcolorType,'|');

	$chcolorcounts = trim($chcolorcounts,'|');

}

/////////////////End//////////////////////





/////////# of messages sent Graph Code///////////////

$chrec = '';

//echo 'inside';exit;

$colorsQuery1 = mysql_query("SELECT * FROM message_intensity");

while($my_colors1=mysql_fetch_array($colorsQuery1))

{

	
//echo "SELECT message_color_id FROM messagetrigger  where  email='$tmail' and send_type=1 and status!='SDeleted' and status!='Deleted' $blocksql and  anonymous='0' and 

//message_color_id=".$my_colors1['id'];exit;
	$ch1=mysql_query("SELECT message_color_id FROM messagetrigger  where  email='$tmail' and send_type=1 and status!='SDeleted' and status!='Deleted' $blocksql and  anonymous='0' and 

message_color_id=".$my_colors1['id']);

	

	if(mysql_num_rows($ch1)!=0)

	{

		$nr1=mysql_num_rows($ch1);

		if($i1!=$totalColors)

		{

		$chrec.=$nr1.",";

		$chcolorCodeRec.=$my_colors1['message_intensity'].",";

		$chcolorTypeRec.=$my_colors1['desc']."|";

		$chcolorcount.=$nr1."|";

		}

		else

		{

		$chrec.=$nr1;

		}



	}

}

if($chrec!='')

{

	$chrec = trim($chrec,',');

	$chcolorCodeRec = trim($chcolorCodeRec,',');

	$chcolorTypeRec = trim($chcolorTypeRec,'|');

	$chcolorcount = trim($chcolorcount,'|');

}

/////////////////End//////////////////////





//echo $chsent.'----'.$chcolorCode.'------'.$chcolorType;exit;



if($chsent != '')

{
	
	/////Dashboard Settings
	if($showSent == 0)
	{
		$sent_cht = "Disabled";
	}
	else {
		$sent_cht="<img src='http://chart.apis.google.com/chart?cht=p&chs=300x150&chd=t:".$chsent."&chco=".$chcolorCode."&chl=".$chcolorType."&chdl=".$chcolorcounts."' >";
	}
	///End
	

} else {



	$sent_cht = '&nbsp;&nbsp;&nbsp;No data available';

}







if($chrec != '')

{
/////Dashboard Settings
if($showInbox == 0)
{
	$rec_cht = "Disabled";
} else 
{
	$rec_cht="<img src='http://chart.apis.google.com/chart?cht=p&chs=300x150&chd=t:".$chrec."&chco=".$chcolorCodeRec."&chl=".$chcolorTypeRec."&chdl=".$chcolorcount."' >";
}
///End

	

} else {

	$rec_cht="&nbsp;&nbsp;&nbsp;No data available";

}







if($action="Delete" && $delid!="")

{

$sql=mysql_query("update messagetrigger set status='Deleted' where id='".$delid."'");

 $msg="Record deleted succesfully";

 // header("location:index.php?file=m-messages&msg=$msg");

}



if(isset($_GET['msg']))

{

  $msg=$_GET['msg'];

}
if($msg!='')
{
 echo "<script>alert('$msg');</script>";
}

$tp=str_replace("{msg}",$msg,$tp);

if(!isset($_GET['order']))

{

	$order='create_time';

}else{

$order=$_GET['order'];

}

$otype=$_GET['otype'];

if(isset($_GET['otype']) && $_GET['otype']!="")

{

	$otype=$_GET['otype'];

} else {

	$otype="d";

}

if($otype=='a')

{

$ot="asc";	

}

else

{

$ot="desc";

}

//echo $otype;

//echo $ot;exit;



//echo  $_POST['saveForm'];exit;







if($_POST['saveForm']=="Save" || $_POST['saveForm']=="Send")

{

//echo '<PRE>';print_r($_POST);exit;

	$name=$_POST['sname'];

	$email=$_POST['email'];

	$message=$_POST['message'];

	$message_intensity=$_POST['intensity'];

	$message_color_id=$_POST['color_id'];

	$message_type_id=3;

	$sender_name="$nn";

	$sender_email="$tmail";

	//print_r($_POST);

	/*if($_POST['saveForm']=="Save"){

	$send_type="3";

	$saveType = 3;

	$msg="Message Saved succesfully to Personal.";

	}else */

	if($_POST['saveForm']=='Save'){

		$send_type = "0";

		$msg="Message Saved as Draft succesfully.";

		$saveType = 0;

	} else {

	$send_type="1";

	$msg="Message Sent succesfully.";

	$saveType = 1;

    }

	//echo "insert into messagetrigger(sender_name,sender_email,message,message_intensity,name,email,message_type_id,send_type,message_color_id)values('$nn','$tmail','$message','$message_intensity','$name','$email','$message_type_id','$send_type','$message_color_id')";

	

	//echo "update messagetrigger set sender_name='".$nn."',sender_email='".$tmail."',message='".$message."', message_intensity='".$message_intensity."',name='".$name."',email='".$email."',message_type_id='".$message_type_id."',send_type='".$send_type."',message_color_id='".$message_color_id."'  where id='".$_POST['draftid']."'";exit;

//	echo $_GET['id'];exit;

	if(isset($_POST['draftid']) && $_POST['draftid']!=""){

	//echo "update messagetrigger set sender_name='".$nn."',sender_email='".$tmail."',message='".$message."', message_intensity='".$message_intensity."',name='".$name."',email='".$email."',message_type_id='".$message_type_id."',send_type='".$send_type."',message_color_id='".$message_color_id."' where id='".$_POST['draftid']."'";exit;

	mysql_query("update messagetrigger set sender_name='".$nn."',sender_email='".$tmail."',message='".$message."', message_intensity='".$message_intensity."',name='".$name."',email='".$email."',message_type_id='".$message_type_id."',send_type='".$send_type."',message_color_id='".$message_color_id."',anonymous='".$anonymous."' where id='".$_POST['draftid']."'");

	$insid=$_POST['draftid'];

	}else{

	//echo 'insert';exit;

	mysql_query("insert into messagetrigger(sender_name,sender_email,message,message_intensity,name,email,message_type_id,send_type,message_color_id,anonymous)values('$nn','$tmail','$message','$message_intensity','$name','$email','$message_type_id','$send_type','$message_color_id','$anonymous')");

	$insid=mysql_insert_id();

	}

	//$msg="Message sent succesfully";

	if($insid)

	  header("location:index.php?file=m-messages&msg=$msg&stype=$saveType#page=page-2");

	?>

<?php

require_once("includes/header.php");

//$mail = new PHPGMailer();

//$mail->IsHTML(true);

//$mail->Username = 'eswar.a@sergeinfo.com';

//$mail->Password = 'eswara123';

$mailFrom = 'notifications@emotionsmirror.com';

if($anonymous=='1'){

$mailFromName = 'anonymous';

$mailsubject = 'New Message From Emotions Mirror';

}else{

$mailFromName=$sender_name;

$mailsubject = 'New Message From '.$sender_name.' Through Emotions Mirror';

}

$mailto=$email;

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



// Additional headers

$headers .= 'To: <'.$email.'>' . "\r\n";

if($anonymous=='1'){

$headers .= 'From: anonymous <notifications@emotionsmirror.com>' . "\r\n";

}else{

$headers .= 'From: '.$sender_name.' <notifications@emotionsmirror.com>' . "\r\n";

}

$mailbody .= '



 <div style="width:620px;background:#c4ddeb;margin:0 auto;padding:10px;overflow:auto;">

 <div style="width:600px;background:#FFFFFF;margin:0 auto;padding:10px;overflow:auto;">

   

   <div style="width:600px;height:47px;">

      <img src="http://emirror.vdevserver.co.cc/emirror/media/images/inner_logo.png" width="229" height="47" alt="Emotions Mirror" />

   </div>

   

   <div style="width:600px;margin:10px 0;padding:0;" >

    

	<div style="width:120px;margin:0;padding:0;float:left;">

	

    <img src="http://emirror.vdevserver.co.cc/emirror/media/images/profile.jpg" width="120" height="120" alt="Emotions Mirror" />   

	

	</div>

	

   <div style="width:470px;margin:0 0 0 10px;padding:0;float:right;">

   <h5  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#a7a4a4;font-style:normal;padding:0;margin:0;">This message is sent to you from Emotions Mirror site</h5>

   <p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#333;font-style:normal;"><strong>Name :</strong> ';

if($anonymous=='1'){

$mailbody.='anonymous';

}else{

   $mailbody.=$sender_name;    

} 

  $mailbody.='<h6  style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#333333;font-weight:bold;padding:0;margin:0;">Dear '.$name.',</h6>

   <p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#333;font-style:normal;">

'.substr($message,0,20).'<br />

<br />

To View the message 

<a href="http:'.$_SERVER['HTTP_HOST'].'/index.php?file=m-open_message&stype='.$send_type.'&id='.$insid.'">Click Here</a>

</p>

   <h6 style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#333333;font-weight:bold;padding:0;margin:0;">Thanks,</h6>

   <h5 style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#a7a4a4;font-style:normal;padding:0;margin:0;">Emotions Mirror Team</h5>

   </div>

   </div>

  </div>

 </div>

';

	

	if($_POST['unums']>=1)

	{

		for($i=1;$i<=$_POST['unums'];$i++)

		{

			 $fname="attachment_".$i;

			if($_FILES[$fname]['name']!="")

			{

				$fileName = str_replace(' ', '_', $_FILES[$fname]['name']);

				$fsname=date('Ymdhis').'_-_'.$fileName;

				move_uploaded_file($_FILES[$fname]['tmp_name'],"media/trigger_files/".$fsname);

				mysql_query("insert into trigger_attachments(trigger_id,attachments)values($insid,'$fsname')");

				$mail->AddAttachment("media/trigger_files/".$fsname);

				

			}

		}

	}

	

	if($_POST['saveForm']=="Send")

	{

	 $email_array=array("tavvaforu@gmail.com","sandhyarani.kotaru@gmail.com","suni449@gmail.com","rajeshkanuri@gmail.com","sunithareddy09@gmail.com","drlakkim@gmail.com","jbr_r@yahoo.com","naveenboga@gmail.com","npogula@gmail.com","rkjindal2@yahoo.com","hasjindal2@gmail.com","rajdaggubati@gmail.com","sakella@emotionsmirror.com","spingili@emotionsmirror.com","spogula@emotionsmirror.com","nandueverurs@gmail.com"

	 );

	 ///send to any person
	 mail($mailto,$mailsubject,$mailbody,$headers);
	 
	 
	 if(in_array(strtolower($mailto),$email_array))

	 {

	  //mail($mailto,$mailsubject,$mailbody,$headers);

	 }	

	}			

}



if(isset($_GET['stype']) && $_GET['stype']!="")

{

	$send_type=$_GET['stype'];

}

else

{

	$send_type=1;

}



if($send_type==2)

		{

			$osender="sender_name";

			$tp=str_replace("{SENDER_HEAD}","Sender",$tp);

		}

		else

		{

			$osender="name";

			$tp=str_replace("{SENDER_HEAD}","Receiver",$tp);

		}



	//for searching

	//print_r($_GET);exit;

	



	$keyword=$_GET['keyword'];

	$fromdate=$_GET['fromdate'];

	$todate=$_GET['todate'];

	

	

	if(isset($_GET['keyword']) && $_GET['keyword']!=""){
		////Added By Harinath
	   	if($send_type == 2)
		{
			$msql=" and (a.message like '%".$_GET['keyword']."%' or a.sender_name like '%".$_GET['keyword']."%'  or a.sender_email like '%".$_GET['keyword']."%')";
		} else
		{
			$msql=" and (a.message like '%".$_GET['keyword']."%' or a.name like '%".$_GET['keyword']."%'  or a.email like '%".$_GET['keyword']."%')";
		} 
		//end
	   
	   //$msql=" and a.message like '%".$_GET['keyword']."%'";

	}

	else{

	$msql=" and 1=1";

	}

	if($_GET['fromdate']!="" && $_GET['todate']!=""){

	$dsql=" and DATE_FORMAT(create_time, '%Y-%m-%d') between '".date("Y-m-d", strtotime($_GET['fromdate']))."'and '".date("Y-m-d", strtotime($_GET['todate']))."'";

	}

	else{

	$dsql=" and 1=1";

	}

	

	//print_r($_POST);

	//print_r($_GET);

	if($_POST['saveForm']=="Delete")

{

  if($checkid!="")

  {

     //echo "update messagetrigger set status='Deleted' where id in ('".$checkid."')";

     $sql=mysql_query("update messagetrigger set status='Deleted' where id in (".$checkid.")");

     $msg="Record(s) deleted succesfully";

	  

  }

  else

  {

    $msg="Error-in deleting the Record";

  }$stype=$_POST['stype'];

  header("location:index.php?file=m-messages&stype=$stype&msg=$msg&show=$show#page=page-2");

}



/////Pagination code starts here//////////

if($send_type=='2')

{

//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='3' and email='$tmail' $msql $dsql and status!='Deleted' and status!='RDeleted'";
/*echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='3' $blocksql and email='$tmail' and send_type=1  $msql $dsql and status!='Deleted' and status!='RDeleted'";*/

$my_res1=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='3' $blocksql and email='$tmail' and send_type=1  $msql $dsql and status!='Deleted' and status!='RDeleted'");

}else{

//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='3' and sender_email='$tmail' and send_type=$send_type $msql $dsql and status!='Deleted' and status!='SDeleted'";

$my_res1=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='3' and sender_email='$tmail' and send_type=$send_type $msql $dsql and status!='Deleted' and status!='SDeleted'");

}

/*paging statrs */

$totalRecords = mysql_num_rows($my_res1);

$limit = 10;

$totalPages = ceil ($totalRecords/$limit); 

$page   = intval($_GET['page']);

$start = $page* $limit;

if($page == '')

{

	$start = 0;

} else {

	$start = ($start - $limit);

}





$tpages = ($_GET['tpages']) ? intval($totalPages ) : $totalPages; // 20 by default

$adjacents  = intval($_GET['adjacents']);



if($page<=0)  $page  = 1;

if($adjacents<=0) $adjacents = 4;



$reload = $_SERVER['PHP_SELF'] . "?file=m-messages&stype=".$stype."&tpages=" . $tpages . "&amp;adjacents=" . $adjacents;



/*  eends*/

//echo $start;

$next=$start+$limit;

//echo $totalRecords.'----'.$next;exit;

if($totalRecords < $next)

{ 

	$last = $totalRecords;

} else {

	$last  = $next;

}

$pagerecords=$start."-". $last." of ".$totalRecords;

//////ENd/////////



if($send_type=='2')

{

//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='3' $blocksql and email='$tmail' and send_type=1  $msql $dsql and status!='Deleted' and status!='RDeleted' order by $order $ot LIMIT $start,$limit";

$my_res=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='3' $blocksql and email='$tmail' and send_type=1  $msql $dsql and status!='Deleted' and status!='RDeleted' order by $order $ot LIMIT $start,$limit");

}

else

{

//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='3' and send_type=$send_type $msql $dsql and status!='Deleted' and status!='SDeleted' order by $order $ot LIMIT $start,$limit";

$my_res=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='3' and sender_email='$tmail' and send_type=$send_type $msql $dsql and status!='Deleted' and status!='SDeleted' order by $order $ot LIMIT $start,$limit");

}

//echo "select * from messagetrigger where message_type_id='3' and send_type='$send_type'  and status!='Deleted'";

//echo mysql_num_rows($my_res);exit;
//echo mysql_num_rows($my_res);
///check for displaying Inbox based on received 
$sql_profile_settings=mysql_query("select * from profile where user_id='".$_SESSION['sess_memberid']."'");
$inboxSettings=mysql_fetch_array($sql_profile_settings);
if($inboxSettings['messages_summary'] == 1)
{
	$showInbox = 1;
	$received = "<a href='index.php?file=m-messages&stype=2&order=$order&show=normal#page=page-2' ".$classR .">Inbox</a>";
} else {
	$showInbox = 0;
	//$received = "<a href='javascript:void(0);' ".$classR ." onclick='javascript:alert(\"You currently disabled this feature\");'>Inbox</a>";
}
if($inboxSettings['messages_sharing'] == 1)
{
	$sent = "<a href='index.php?file=m-messages&stype=1&order=$order&show=$show#page=page-2' ".$classS .">Sent</a>";
	$showSent = 1;
} else {
	//$sent = "<a href='javascript:void(0);' ".$classS ."  onclick='javascript:alert(\"You currently disabled this feature\");'>Sent</a>";
	$showSent = 0;
}
//echo '<pre>';print_r($inboxSettings);exit;
///End
$tot_rows = mysql_num_rows($my_res);
if($tot_rows>0)
{
	if($send_type == 2 && $showInbox == 0)
	{
		$pems = "You currently disabled this feature for inbox";
		$tot_rows = 0;
		
	} else if($send_type == 1 && $showSent == 0)
	{
		$pems = "You currently disabled this feature for sent";
		$tot_rows = 0;
	}
} else {
	$pems = "no expressions found";
}	
if($tot_rows>0)

{

	$rcnt=0;

	while($my_arr=mysql_fetch_array($my_res))

	{

		$id=$my_arr['id'];

		$message=substr($my_arr['message'],0,8);

		$id=$my_arr['id'];

		//$condate=strtotime($my_arr['create_time']);

		//$date=date('j M Y',$condate);

		$date=$db->displayDateFormat($my_arr['create_time']);

		//=displayDateFormat($my_arr['create_time']);

		$message_intensity=$my_arr['message_intensity'];

		$col_id=$my_arr['color_id'];



$sql_type=mysql_query("select * from message_intensity where message_intensity='".$col_id."'");

		$res_type=mysql_fetch_array($sql_type);

	      $desc=$res_type['desc'];



		/*if($message_color_id==1)

		{

		  $s="<img src='intensity3.gif'>";

		 }if($message_color_id==2)

		{

		  $s="<img src='intensity2.gif'>";

		 }*/

		$ancheck=$my_arr['anonymous'];

		if($send_type==2)

		{

			$sender=substr($my_arr['sender_name'],0,8);

			$osender="sender_name";

			$tp=str_replace("{SENDER_HEAD}","Sender",$tp);

		}

		else

		{

			$sender=substr($my_arr['name'],0,8);

			$osender="name";

			$tp=str_replace("{SENDER_HEAD}","Receiver",$tp);

		}

		

		$attachres=mysql_query("select * from trigger_attachments where trigger_id=$id");

		



$res.='		<div class="clearall"></div>';

$rcnt++;

//echo $id;

if($rcnt % 2=='0')

{

$res.='	<div style="height:26px; background-color:#e0e8ef;">';

}

else

{

	$res.='	<div style="height:26px; background-color:#eeeeee;">';

}

$res.='	<span style="float:left;margin:0px 0px 5px 0px; padding:0px; width:150px;">

  <input name="check_list[]" type="checkbox"  id="check_list[]"  value="'.$id.'" style="margin-right:5px; margin-top:4px;"/>';

  if(mysql_num_rows($attachres) > 0)

  {

 $res.='<img src="{IMG_URL}attachemtn.gif" width="16" height="14" alt="attachemet" />';

  } else {

	$res.='<img src="{IMG_URL}1.gif" width="16" height="14" alt="attachemet" />';

  }

   if($send_type==0) { 

  $res.='<a href="index.php?file=m-messages&id='.$id.'">'.$message.'</a>';

   } 

   else {
	
  $res.='<a href="index.php?file=m-open_message&show='.$show.'&stype='.$send_type.'&id='.$id.'">'.$message.'</a></label>';

  }

$res.='</span>

  <div style="float:left; width:80px; margin:0px 0px 0px 0px; padding:6px 0px 0px 40px" > ';

				  if($_GET['stype'] == 2 && $ancheck==1){

				  $res.="----";

				  }else{

				  $res.=$sender;

				  }

$res.=' </div>

                    <div style="float:left; width:auto; margin:0px 0px 0px 10px; padding:6px 0px 0px 15px" > '.$date.'</div>

					                    <div style="float:left; width:auto; margin:0px 0px 0px 10px; padding:6px 0px 0px 40px" >

							  <a href="#" rel="tooltip" title='.$desc.'><span style="height:0px;width:10px;background-color:#'.$col_id.'" >&nbsp;</span></a>

							    

							    </div>



                    <div style="float:left; width:26px; height:20px; margin:0px 0px 0px 50px; padding:6px 0px 0px 22px" >					

					'.$message_intensity.'</div>                

  <div  style="padding:6px 0px 0px 15px;margin-right:40px;" class="socialicons">';



  $res.='<a href="#" onclick="return checkDelete('.$id.')";><img src="{IMG_URL}delete.gif" width="13" flot="right"height="13" /></a></div>

</div>';

		

	}

	

}

else{

$res='<div style="text-align:center; padding:30px 0px 0px 0px; font-waight:bold; font-size:12px;" ><strong>'.$pems.'</stropng></div>';

}





//echo $send_type;

if(isset($_GET['stype']))

{

	if($_GET['stype'] == 2 && $_GET['show']!='unblock')

	{

		$classR = 'class="active"';

	} else {

		$classR = '';

	}

	if($_GET['stype'] == 0)

	{

		$classD = 'class="active"';

	} else {

		$classD = '';

	}

	if($_GET['stype'] == 1)

	{

		$classS = 'class="active"';

	} else {

		$classS = '';

	}

	if($_GET['stype'] == 2 && $_GET['show']=='unblock')

	{

		$classP = 'class="active"';

	} else {

		$classP = '';

	}

} else {

	$classS = 'class="active"';

}

$res1='<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'#page=page-2">All</a>&nbsp;&nbsp;&nbsp;';

$res1.= $pagerecords.paginate_one($reload,$page,$tpages);

//echo $order;

if($order=="message" && $otype=="a")

{

$tp=str_replace("{MSG_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message&otype=d#page=page-2" >

<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

else

{

$tp=str_replace("{MSG_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message&otype=a#page=page-2" >

<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

if($order=="$osender" && $otype=="a")

{

$tp=str_replace("{SENDER_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order='.$osender.'&otype=d#page=page-2" >

<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

else

{

$tp=str_replace("{SENDER_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order='.$osender.'&otype=a#page=page-2" >

<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

if($order=="create_time" && $otype=="a")

{

$tp=str_replace("{TIME_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=create_time&otype=d#page=page-2" >

<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

else

{

$tp=str_replace("{TIME_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=create_time&otype=a#page=page-2" >

<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

if($order=="message_intensity" && $otype=="a")

{

$tp=str_replace("{INTENSITY_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message_intensity&otype=d#page=page-2" >

<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

else

{

$tp=str_replace("{INTENSITY_SORT}",'<a href="index.php?file=m-messages&show='.$show.'&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message_intensity&otype=a#page=page-2" >

<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);

}

if($my_arrdraft['id']!=""){

$tp=str_replace("{DRAFT_BTN}",'<input id="saveForm" onclick="return valid_messageform(document.messageform,\''.$str_words.'\');" name="saveForm" class="inr_btn" type="submit" value="Send"/>

   ',$tp);

 $tp=str_replace("{tab_name}",'<span>Edit</span>',$tp);



}else{

$tp=str_replace("{DRAFT_BTN}",'<input id="saveForm" name="saveForm" class="inr_btn" type="button" value="Preview" onclick="return mypopupMessage(document.messageform,prv);"/>

   <input id="saveForm" onclick="return valid_messageform(document.messageform,\''.$str_words.'\');" name="saveForm" class="inr_btn" type="submit" value="Save"/>

   <input id="saveForm" onclick="return valid_messageform(document.messageform,\''.$str_words.'\');" name="saveForm" class="inr_btn" type="submit" value="Send"/>

   ',$tp);

 $tp=str_replace("{tab_name}",'<span>Compose</span>',$tp);

}

if(isset($anonymous_u) && $anonymous_u==1){

$res3.='<input type="checkbox" name="anonymous" value="1" checked="checked">';

}else{

$res3.='<input type="checkbox" name="anonymous" value="1">';

}
$draftid=$my_arrdraft['id'];


if($_GET['id']!=""){

$ur='index.php?file=m-messages&stype=0#page=page-2';
}else{
$ur='index.php?file=m-messages#page=page-1';
}
$btn='<input id="saveForm" onclick="javascript:window.location=\''.$ur.'\';" name="saveForm" class="inr_btn" type="button" value="Cancel"/>';

$tp=str_replace("{dr_can}",$btn,$tp);

$tp=str_replace("{an_check}",$res3,$tp);
///check for displaying Inbox based on received 
$sql_profile_settings=mysql_query("select * from profile where user_id='".$_SESSION['sess_memberid']."'");
$inboxSettings=mysql_fetch_array($sql_profile_settings);
if($inboxSettings['messages_summary'] == 1)
{
	$showInbox = 1;
	$received = "<a href='index.php?file=m-messages&show=normal&stype=2&order=$order#page=page-2' ".$classR .">Inbox</a>";
} else {
	$showInbox = 0;
	$received = "<a href='javascript:void(0);' ".$classR ." onclick='javascript:alert(\"You currently disabled this feature\");'>Inbox</a>";
}
if($inboxSettings['messages_sharing'] == 1)
{
	$sent = "<a href='index.php?file=m-messages&stype=1&order=$order#page=page-2' ".$classS .">Sent</a>";
	$showSent = 1;
} else {
	$sent = "<a href='javascript:void(0);' ".$classS ."  onclick='javascript:alert(\"You currently disabled this feature\");'>Sent</a>";
	$showSent = 0;
}
//echo '<pre>';print_r($inboxSettings);exit;
///End

$tp=str_replace("{RECEIVED}",$received,$tp);

$tp=str_replace("{SENT}",$sent,$tp);

if($send_type == 2)
{
	//$tp=str_replace("{PERSONAL}","l <a href='javascript:void(0);' onclick='return checkunblock(2);' ".$classP .">Unblock</a>",$tp);
} else {
	//$tp=str_replace("{PERSONAL}","",$tp);
}

$tp=str_replace("{DRAFT}","<a href='index.php?file=m-messages&stype=0&order=$order#page=page-2' ".$classD .">Draft</a>",$tp);

$tp=str_replace("{PERSONAL}","l <a href='index.php?file=m-messages&stype=2&show=unblock&order=$order#page=page-2' ".$classP .">Unblock</a>",$tp);
//$tp=str_replace("{PERSONAL}","<a href='index.php?file=m-messages&stype=3&order=$order#page=page-2' ".$classP .">Personal</a>",$tp);

$tp=str_replace("{stype}",$send_type,$tp);

$tp=str_replace("{STYPE}",$send_type,$tp);

$tp=str_replace("{TOT_SENT}",$tot_sent,$tp);

$tp=str_replace("{TOT_RECEIVED}",$tot_received,$tp);

$tp=str_replace("{MESSAGES}",$res,$tp);

$tp=str_replace("{SENT_CHT}",$sent_cht,$tp);

$tp=str_replace("{REC_CHT}",$rec_cht,$tp);

$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);

$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);

$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);

$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);

$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);

$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);

$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);

$tp=str_replace("{pagerecords}",$pagerecords,$tp);

//draft mesages editing

//echo $message;

$tp=str_replace("{DRAFTID}",$my_arrdraft['id'],$tp);

$tp=str_replace("{MESSAGE}",$draftmessage,$tp);

$tp=str_replace("{DATE}",$draftdate,$tp);

$tp=str_replace("{stype}",$stype,$tp);

$tp=str_replace("{INTENSITY}",$draftmessage_intensity,$tp);

$tp=str_replace("{REC_NAME}",$my_arrdraft['name'],$tp);

$tp=str_replace("{REC_EMAIL}",$my_arrdraft['email'],$tp);

$tp=str_replace("{EMOTION}",$my_arrdraft['message_color_id'],$tp);

$tp=str_replace("{ATTACH}",$resattach,$tp);

if($motion!='')

{

	$motion = '<script>change_bg("'.$motion.'");</script>';

}

$tp=str_replace("{motion}",$emotion,$tp);



/*--------*/

//echo $keyword;
////Disable Go for unblock
$tp=str_replace("{unblockGo}",$unblockGo,$tp);
 
//End
$tp=str_replace("{keyword}",$keyword,$tp);

$tp=str_replace("{fromdate}",$fromdate,$tp);

$tp=str_replace("{todate}",$todate,$tp);

//echo $res1;

$tp=str_replace("{PAGING}",$res1,$tp);

//echo "hi";exit;rec_cht

//echo $tp;



?>