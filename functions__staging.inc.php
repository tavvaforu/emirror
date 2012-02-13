<?php
class myclass{
public $cn;
public $cn1;
public $host="localhost";
public $user="vdevserv_root";
public $pwd="Varna123";
public $db="vdevserv_emirror";
public $myp=1;

	public function myconnect(){
		$this->cn=mysql_pconnect($this->host,$this->user,$this->pwd) or die();
		mysql_select_db($this->db,$this->cn) or dir(mysql_error());
		return $this->cn;
	}
	
	public function myconnect1(){
		$this->cn1=mysql_pconnect($this->host,$this->user,$this->pwd) or die();
		mysql_select_db($this->db1,$this->cn1) or dir(mysql_error());
		return $this->cn1;
	}
	 
	public function pushquery($sql)
	{
		$this->myconnect();
		$r=mysql_query($sql,$this->cn) or die(mysql_error());
		return $r;
	}
	
	public function mtable_pwd($sql,$stid,$edl,$pwd){
		$this->myconnect();
		$r=mysql_query($sql,$this->cn) or die(mysql_error());
		$nf=mysql_num_fields($r);
		$nr=mysql_num_rows($r);
		if($nr>0){
		$t.="<div class=".$stid.">\n";
		$t.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
		$t.="<tr>";
		
		for($i=0;$i<$nf;$i++){
			$t.="<th>".mysql_field_name($r,$i)."</th>";
		}
		$t.="<th>edit</th><th>Password</th>";
		$t.="</tr>";
		
		while($v=mysql_fetch_assoc($r)){
			$t.="<tr>";
				for($i=0;$i<$nf;$i++){
				$t.="<td>".$v[mysql_field_name($r,$i)]."</td>";
				}
				$t.="<td><a href=\"".$edl."?id=".$v[mysql_field_name($r,0)]."\">Edit</a></td>\n";
				$t.="<td class=\"del\"><a onclick=\"(confirm('Do you want to change password')?location.replace('".$pwd."?id=".$v[mysql_field_name($r,0)]."'):'');\"\">Change</a></td>\n";
			$t.="</tr>";
		}
		
		$t.="</table></div>";
		}else{
			$t.="<div class=".$stid.">\n";
			$t.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
			$t.="<tr><td align=\"center\">";
			$t.="No Data Found";
			$t.="</td></tr>";
			$t.="</div>";
		}
		return $t;
	}//mtable_pwd ends

public function mtablespan($sql,$class,$ppr=20,$nrs=1,$mgt=NULL,$edt=NULL,$delt=NULL,$target="_parent",$bwr=NULL){
$this->myconnect();
$r1=mysql_query($sql,$this->cn) or die(mysql_error());

$rec=mysql_num_rows($r1);
$p=ceil($rec/$ppr);

$l=(isset($_GET['pg_id'])?($_GET['pg_id']-1)*$ppr:0);

$sql=$sql." limit $l,$ppr";
$r=mysql_query($sql,$this->cn) or die(mysql_error()." at two");

$nf=mysql_num_fields($r);

$prev=(isset($_GET['pg_id']))?(($_GET['pg_id']-1)<=0?1:($_GET['pg_id']-1)):1;
$next=(isset($_GET['pg_id']))?(($_GET['pg_id']+1)>=$p?$p:($_GET['pg_id']+1)):2;

$pageGoTo = $_SESSION['page'];

if(!isset($_GET['pg_id'])){
if($_SESSION['qst']!=$_SERVER['QUERY_STRING']){
 if (isset($_SERVER['QUERY_STRING'])) {
   // $qstr .= (strpos($pageGoTo, '?')) ? "&" : "?";
   $_SESSION['qst'] = $_SERVER['QUERY_STRING'];
    $_SESSION['qstr'] = "&".$_SESSION['qst'];
  }
}
}
$rcount=$l+1;
// setting target for edit link
if($target!=""){
 $target=" target=\"$target\"";
}


$t="";


$nf=mysql_num_fields($r);
if(mysql_num_rows($r)>0){
$nrow=0;	
$t.="<table cellpadding=\"0\" cellspacing=\"0\" class=\"".$class."\" border=\"0\" width=\"100%\">";
while($v=mysql_fetch_assoc($r)){
if($nrow % $nrs == 0)
{
	$t.="<tr";
if($nrow % ($nrs*2) == 0 )
	{
		$t.=" style='background-color:#F8F9FD;'  ";
	}
	$t.=" >";
	
}
$nrow++;
for($i=0;$i < $nf;$i++)
{
$t.="<td>".$v[mysql_field_name($r,$i)]."</td>";



}	
if($nrow % $nrs == 0)
{
	$t.="</tr>";
}		
		
		
		
}
if($rec % $nrs!=0)
{
	$rem=$rec % $nrs;
	$rem1=$nrs-$rem;
	for($re=1;$re <= $rem1;$re++)
	{
		$t.="<td>&nbsp;</td>";
	}
	$t.="</tr>";
}


$t.="</table>";


$t.="<table cellpadding=\"1\" cellspacing=\"0\" border=\"0\" align=\"right\">";
$t.="<tr>";
	if($rec>$ppr):
		$t.="<td width=\"14\"><a href=\"".$pageGoTo."?pg_id=".$prev.$_SESSION['qstr']."\" title=\"Previous\">&laquo;</a></td><td>";
		foreach(range(1,$p) as $v){
			$t.="<a href=\"".$pageGoTo."?pg_id=".$v.$_SESSION['qstr']."\">".$v."</a>";
		  }
		 $t.="</td><td width=\"14\"><a href=\"".$pageGoTo."?pg_id=".$next.$_SESSION['qstr']."\" title=\"Next\">&raquo;</a></td>";
	endif;


$t.="</tr></table>";

}else{
	$t.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
	$t.="<tr><th>No Records Found</th></tr>";
	$t.="</table>";
}

return $t;
}//mtablespan ends



	public function my_getvalue($field,$table,$where=NULL,$limit=NULL){
		$this->myconnect();
		$sql="select $field from $table";
			if($where!=NULL){
			$sql.=" where $where";
			}
    if($limit!=NULL){
			$sql.=" LIMIT $limit";
			}
		$r=mysql_query($sql,$this->cn) or die(mysql_error());
		
		if(mysql_num_rows($r)>0){
		$v=mysql_fetch_assoc($r);
		return $v[$field];
		}else{
		return NULL;
		}
	}///my_getvalue ends



	public function my_getresult($sql,$ty='object'){
		$this->myconnect();
		$r=mysql_query($sql,$this->cn) or die(mysql_error());
			//	$nf=mysql_num_fields($r);
		if($ty=="assoc"){
			while($v=mysql_fetch_assoc($r)){
				$a[]=$v;
			}
		}elseif($ty=="object"){
			while($v=mysql_fetch_object($r)){
				$a[]=$v;
			}
		}elseif($ty=="row"){
			while($v=mysql_fetch_row($r)){
				$a[]=$v;
			}
		}
			
		return $a;
	}//my_getresult ends
	
	public function logout(){
  $_SESSION="";
  session_destroy();
  return 1;
	}

public function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
{
    $chars_length = (strlen($chars) - 1);
    $string = $chars{rand(0, $chars_length)};
    for ($i = 1; $i < $length; $i = strlen($string))
    {
     $r = $chars{rand(0, $chars_length)};
     if ($r != $string{$i - 1}) $string .=  $r;
    }
    return $string;
}

function my_plist($sql,$ppr,$rpr,$tot=NULL){
$this->myconnect();
if($tot!=NULL){
$sql1=$sql." limit 0,$tot";
}else{
$sql1=$sql;
}
$r1=mysql_query($sql,$this->cn) or die(mysql_error());

$rec=mysql_num_rows($r1);
$p=ceil($rec/$ppr);

$l=(isset($_GET['pg_id'])?($_GET['pg_id']-1)*$ppr:0);

$sql=$sql." limit $l,$ppr";
$r=mysql_query($sql,$this->cn) or die(mysql_error()." at two");

$nr=mysql_num_rows($r);
$nf=mysql_num_fields($r);


$prev=(isset($_GET['pg_id']))?(($_GET['pg_id']-1)<=0?1:($_GET['pg_id']-1)):1;
$next=(isset($_GET['pg_id']))?(($_GET['pg_id']+1)>=$p?$p:($_GET['pg_id']+1)):2;
	
	$pageGoTo = $_SERVER['PHP_SELF'];

if(!isset($_GET['pg_id'])){
if($_SESSION['qst']!=$_SERVER['QUERY_STRING']){
 if (isset($_SERVER['QUERY_STRING'])) {
   // $qstr .= (strpos($pageGoTo, '?')) ? "&" : "?";
   $_SESSION['qst'] = $_SERVER['QUERY_STRING'];
    $_SESSION['qstr'] = "&".$_SESSION['qst'];
  }
}
}
	
$t="<div align=\"center\">";
if($rec>$ppr):
$t.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">"."\n";
$t.="<tr>";
	
		$t.="<td width=\"14\"><a href=\"".$pageGoTo."?pg_id=".$prev.$_SESSION['qstr']."\" title=\"Previous\">&laquo;</a></td><td>";
		foreach(range(1,$p) as $v){
			$t.="<a href=\"".$pageGoTo."?pg_id=".$v.$_SESSION['qstr']."\">".$v."</a>";
		  }
		 $t.="</td><td width=\"14\"><a href=\"".$pageGoTo."?pg_id=".$next.$_SESSION['qstr']."\" title=\"Next\">&raquo;</a></td>";
	

$t.="</tr>";
$t.="</table>";
endif;
$t.="<div id=\"".mypid.($this->myp++)."\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">"."\n";
$cc=0;
	if(mysql_num_rows($r)>0){
	$t.='<tr><td>';
	while($row_rnew = mysql_fetch_object($r)){
	$t.=''."\n";
	$t.='		<div class="p_vert">
							<table width="140" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td>';
	$t.='<a href="pview.php?id='.$row_rnew->productid.'">
	<img src="thumbnail.php?src=images/products/'.$row_rnew->image.'&w=140" width="140" />
	</a></td>
	</tr>
	<tr><td class="pname">
	<a href="pview.php?id='.$row_rnew->productid.'">'.$row_rnew->productname.'</a>
	</td></tr>
	 	 <tr>
			<td><strong>Category :&nbsp;</strong>'.$row_rnew->cn.'</td>
		  </tr>
		  <tr>
			<td><strong>Brand :&nbsp;</strong>'.$row_rnew->bn.'</td>
		 </tr>
		 <tr>
			<td><strong>Rs/-</strong>&nbsp;'.$row_rnew->price.'</td>
		 </tr>
		</table>

                           </div>';
$cc++;
if($cc==$rpr){
echo "</td></tr><tr><td>";
$cc=0;
}						
}
						
	$t.='</td></tr>';
	}else{
	$t.='<tr><td align="center">No Records Found</td></tr>';
	}
	$t.='</table></div>';
	$t.='</div>';
	return $t;
	}//my_plist ends



public function dbcombodisplay($prefix,$table,$eventaction="",$style="",$defaultvalue=0,$suffix="",$where="") {
	
	$sql="select * from $table";
	if($where)
	{
		$sql.="  where $where  ";
	}
	$this->myconnect();
	$r=mysql_query($sql,$this->cn) or die(mysql_error());
	if(mysql_num_rows($r) > 0)
	{
		$table_id=$table."_id";
		$table_name=$table."_name";
	 
	 $t='<select name="'.$prefix.$table_id.$suffix.'" id="'.$prefix.$table_id.$suffix.'"';
	   if($eventaction) 
	  	{ 
	  		$t.='onchange="'.$eventaction.'"'; 
	  	} 
	  	if($style) { $t.= 'style="'.$style.'"'; } 
	   
	  	$t.=' >
	  <option value="0" ';
	   if($defaultvalue==0 ) { $t.='  selected  ';   } $t.=' >Select  '.ucfirst($table).'  </option>	 ';
	  
	  while($ar=mysql_fetch_assoc($r))
	  {
	  	
	  	$t.='<option value="'.$ar[$table_id].'"' ;
	  	 if($defaultvalue==$ar[$table_id]) $t.= " selected ";  
	  	 
	  	 $t.=' />';
	  	 $t.=ucfirst($ar[$table_name]); 	
	  $t.= '</option>';	
	  	
	  }	
	  
	  $t.= '</select>	   ';
	  
	  

	}
	
	return $t;
	
}



	

	

	

			
		public function mtablespan1($sql,$class,$ppr=20,$nrs=1,$mgt=NULL,$edt=NULL,$delt=NULL,$target="_parent",$bwr=NULL){
$this->myconnect();
$r1=mysql_query($sql,$this->cn) or die(mysql_error());

$rec=mysql_num_rows($r1);
$p=ceil($rec/$ppr);

$l=(isset($_GET['pg_id'])?($_GET['pg_id']-1)*$ppr:0);

$sql=$sql." limit $l,$ppr";
$r=mysql_query($sql,$this->cn) or die(mysql_error()." at two");

$nf=mysql_num_fields($r);

if(isset($_GET['pg_id']) && $_GET['pg_id']<=1)
{
	$prevclass="class='disabled'";
}
else
{
	$prevclass="";
}
if(isset($_GET['pg_id']) && $_GET['pg_id']==$p)
{
	$nextclass="class='disabled'";
}
else
{
	$nextclass="";
}


$prev=(isset($_GET['pg_id']))?(($_GET['pg_id']-1)<=0?1:($_GET['pg_id']-1)):1;
$next=(isset($_GET['pg_id']))?(($_GET['pg_id']+1)>=$p?$p:($_GET['pg_id']+1)):2;

$pageGoTo = $_SESSION['page'];

if(!isset($_GET['pg_id'])){
if($_SESSION['qst']!=$_SERVER['QUERY_STRING']){
 if (isset($_SERVER['QUERY_STRING'])) {
   // $qstr .= (strpos($pageGoTo, '?')) ? "&" : "?";
   $_SESSION['qst'] = $_SERVER['QUERY_STRING'];
    $_SESSION['qstr'] = "&".$_SESSION['qst'];
  }
}
}
$rcount=$l+1;
// setting target for edit link
if($target!=""){
 $target=" target=\"$target\"";
}


$t="";


$nf=mysql_num_fields($r);
if(mysql_num_rows($r)>0){
$nrow=0;	
$t.="<table cellpadding=\"0\" cellspacing=\"0\" class=\"".$class."\" border=\"0\" width=\"100%\">";
$t.="<tr>";
for($k=0; $k < $nrs; $k++)
{
for($i=0; $i < $nf; $i++)
{
	$t.="<th align='left'>".ucwords(str_replace('_',' ',mysql_field_name($r,$i)))."</th>";
}
}
$t.="</tr>";
while($v=mysql_fetch_assoc($r)){
$nrow++;
for($i=0;$i < $nf;$i++)
{
$t.="<td align='left'>".$v[mysql_field_name($r,$i)]."</td>";



}	
if($nrow % $nrs == 0)
{
	$t.="</tr>";
}		
		
		
		
}
if($rec % $nrs!=0)
{
	$rem=$rec % $nrs;
	$rem1=$nrs-$rem;
	for($re=1;$re <= $rem1;$re++)
	{
		$t.="<td>&nbsp;</td>";
	}
	$t.="</tr>";
}


$t.="</table>";



		            
		            
		              
	   if($rec>$ppr):            
	              
$t.="<table cellpadding=\"1\" cellspacing=\"0\" border=\"0\" width=\"99%\">";
$t.="<tr><td colspan='3'><div class='pagination pagination-left'><ul class='pager'>";
	
	if($prevclass)
	{
		$t.="<li $prevclass >&laquo; prev</li>";
	}
	else
	{
		$t.="<li><a href=\"".$pageGoTo."?pg_id=".$prev.$_SESSION['qstr']."\" title=\"Previous\">&laquo; prev</a></li>";
	}
	foreach(range(1,$p) as $v){
		if(isset($_GET['pg_id']) && $_GET['pg_id']==$v)
		{
			$t.="<li class='current' >".$v."</li>";
		}
		else
		{
			$t.="<li><a href=\"".$pageGoTo."?pg_id=".$v.$_SESSION['qstr']."\">".$v."</a></li>";
		}
		 }
	if($nextclass)
	{
		 $t.="<li $nextclass >next &raquo;</li></ul></div>";
	}
	else
	{
		$t.="<li><a href=\"".$pageGoTo."?pg_id=".$next.$_SESSION['qstr']."\" title=\"Next\">next &raquo;</a></li></ul></div>";
	}
	


$t.="</tr></table>";
endif;
}else{
	$t.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
	$t.="<tr>";
for($k=0; $k < $nrs; $k++)
{
for($i=0; $i < $nf; $i++)
{
	$t.="<th align='left'>".ucwords(str_replace('_',' ',mysql_field_name($r,$i)))."</th>";
}
}
$t.="</tr>";
$t.="<tr><td colspan=$nf align='center' height='10' ></td></tr>";
	$t.="<tr><td colspan=$nf align='center' >No Records Found</td></tr>";
	$t.="<tr><td colspan=$nf align='center' height='10' ></td></tr>";
	$t.="</table>";
}

return $t;
}//mtablespan ends




//permission checking starts here











	
		function parse_feed($feed) {
$stepOne = explode("<content type=\"html\">", $feed);
$stepTwo = explode("</content>", $stepOne[1]);
$tweet = $stepTwo[0];
$tweet = str_replace("&lt;", "<", $tweet);
$tweet = str_replace("&gt;", ">", $tweet);
return $tweet;
}
 

function table_tr()
{
 
			  $query=mysql_query("select * from state");
             $nrows=mysql_num_rows($query);
					$cnt=0;
			 while($query1=mysql_fetch_assoc($query))
              
              {
			  
			  
			  if($cnt % 2 ==0)
					{
					echo "<tr>";
					}$cnt++;
					
			  
			 
					?>
			  
			  <td height="15" align="left" valign="middle">
            <a href="#"><?php echo $query1[state_name];?></a>
                  </td>     
					 
					<?php
					
    	        		if($cnt % 2 ==0)
					{
					echo "</tr>";
					}
					
				
				 }
				 
				
    	        	
             }


function twitter_get_status($twitter_id, $hyperlinks = true) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, "http://twitter.com/statuses/user_timeline/$twitter_id.xml?count=2");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    $src = curl_exec($c);
    curl_close($c);
    preg_match('/<text>(.*)<\/text>/', $src, $m);
    $status = htmlentities($m[1]);
    if( $hyperlinks ) $status = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", '<a href="%5C%22%5C%5C0%5C%22">\\0</a>', $status);
    return($status);
}





function cURL($url, $header=NULL, $cookie=NULL, $p=NULL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_NOBODY, $header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    if ($p) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
    }
    $result = curl_exec($ch);

    if ($result) {
        return $result;
    } else {
        return curl_error($ch);
    }
    curl_close($ch);
}


public function getuser($user_group_id="")
{
$this->myconnect();

$forusergroup=$this->pushquery("select * from user_group where user_group_id!=1");
$usergroup='<option value="" ';
if($user_group_id=="")
{
$usergroup.=" selected ";
}
$usergroup.=">Select Group</option>";

while($forusergroup1=mysql_fetch_assoc($forusergroup))
{

$usergroup.="<option value='".$forusergroup1['user_group_id']."'";
if($user_group_id==$forusergroup1['user_group_id'])
{
$usergroup.=" selected ";
} 
$usergroup.="  >".ucfirst($forusergroup1['user_group_name'])."</option>";
}

return $usergroup;

}
public function getmenu($art_id="")
{
$this->myconnect();

$forusergroup=$this->pushquery("select * from article");
$usergroup='<option value="" ';
if($art_id=="")
{
$usergroup.=" selected ";
}
$usergroup.=">Select Article</option>";

while($forusergroup1=mysql_fetch_assoc($forusergroup))
{

$usergroup.="<option value='".$forusergroup1['art_id']."'";
if($art_id==$forusergroup1['art_id'])
{
$usergroup.=" selected ";
} 
$usergroup.="  >".ucfirst($forusergroup1['art_title'])."</option>";
}

return $usergroup;

}



public function getstate($state_id="")
{
$this->myconnect();
$forstate=$this->pushquery("select * from state");
$state='<option value="" ';
if($state_id=="")
{
$state.=" selected ";
}
$state.=">Select State</option>";

while($forstate1=mysql_fetch_assoc($forstate))
{

$state.="<option value='".$forstate1['id']."'";
if($state_id==$forstate1['id'])
{
$state.=" selected ";
} 
$state.="  >".ucfirst($forstate1['state_name'])."</option>";
}

return $state;

}


public function getbcat($bcat_id="")
{
$this->myconnect();
$forstate=$this->pushquery("select * from business_category");
$state='<option value="" ';
if($bcat_id=="")
{
$state.=" selected ";
}
$state.=">Select Category</option>";

while($forstate1=mysql_fetch_assoc($forstate))
{

$state.="<option value='".$forstate1['id']."'";

if($bcat_id==$forstate1['id'])
{
$state.=" selected ";
} 
$state.="  >".ucfirst($forstate1['business_name'])."</option>";
}

return $state;

}

public function getparent($bcat_id="")
{
$this->myconnect();
$forstate=$this->pushquery("select * from admin_menu");
$state='<option value="0" ';
if($bcat_id=="")
{
$state.=" selected ";
}
$state.=">Top Level</option>";

while($forstate1=mysql_fetch_assoc($forstate))
{

$state.="<option value='".$forstate1['menu_id']."'";

if($bcat_id==$forstate1['menu_id'])
{
$state.=" selected ";
} 
$state.="  >".ucfirst($forstate1['menu_name'])."</option>";
}

return $state;

}

public function getperselect($arr="")
{
$this->myconnect();

$forusergroup=$this->pushquery("select * from user_group where user_group_id > 1");

while($forusergroup1=mysql_fetch_assoc($forusergroup))
{

$usergroup.="<option value='".$forusergroup1['user_group_id']."'";
if(in_array($forusergroup1['user_group_id'],$arr))
{
$usergroup.=" selected ";
} 
$usergroup.="  >".ucfirst($forusergroup1['user_group_name'])."</option>";
}

return $usergroup;
}






public function gethoop($id=""){

$hop="";
$hop.="<option value='' ";
if($id=="")
{
$hop.=" selected ";
}
$hop.=" >Select Hours</option>";
for($i=1;$i<=24;$i++)
{
$hop.="<option value='$i' ";
if($id==$i)
{
$hop.=" selected ";
}
$hop.=" >$i</option>";
}
return $hop;
}



public function select_status($val="1")
{
	
	$t.="<option value='1' ";
	if($val==1)
	{
	$t.=" selected ";
  } 
  $t.=" >Active </option>";
  $t.="<option value='2' ";
	if($val==2)
	{
	$t.=" selected ";
  } 
  $t.=" >Inactive </option>";
  
	
		return $t;

}
public function select_position($val="1")
{
	
	$t.="<option value='1' "; //1 for left
	if($val==1)
	{
	$t.=" selected ";
  } 
  $t.=" >Left </option>";
  $t.="<option value='2' ";   //2 for right
	if($val==2)
	{
	$t.=" selected ";
  } 
  $t.=" >Right</option>";
  
	
		return $t;

}

public function select_payment($val="1")
{
	
	$t.="<option value='1' "; //1 for left
	if($val==1)
	{
	$t.=" selected ";
  } 
  $t.=" >Monthly Payment-$5.00 </option>";
  $t.="<option value='2' ";   //2 for right
	if($val==2)
	{
	$t.=" selected ";
  } 
  $t.=" >Yearly  Payment-$50.00</option>";
  
	
		return $t;

}




public function select_bustype($val="1")
{
	
	$t.="<option value='1' "; //1 for image
	if($val==1)
	{
	$t.=" selected ";
  } 

  
  $t.=" >Image </option>";
    

  $t.="<option value='2' ";   //2 for script
	if($val==2)
	{
	$t.=" selected ";
  } 
  $t.=" >Script</option>";
  
	
		return $t;

}


public function rating($user_id)
{
$this->myconnect();
$rating=0;
$ret="";
$ratingqry=$this->pushquery("select * from rating where front_user_id=$user_id");
$numrows=mysql_num_rows($ratingqry);
if(mysql_num_rows($ratingqry) > 0) 
{
  while($arr=mysql_fetch_assoc($ratingqry))
  {
    $rating+=$arr['rating_value'];
  }
  $rating=$rating/$numrows; 
}
else
{
$rating=0;
}
$ret.="<ul class='star' >";
for($i=1;$i<=5;$i++)
{
$j=$i-1;
$ret.="<li><a href='javascript:void(0)' onclick='getrating(\"".$user_id."\",\"".$i."\");' >";

if($rating <= $j)
{
$ret.="<img src='images/star_full_white.jpg' border='0' onmouseover=\"this.src='images/star_full.jpg';\" onmouseout=\"this.src='images/star_full_white.jpg';\" >";
}
else if($j<$rating && $rating<$i)
{
$ret.="<img src='images/star_half.jpg' border='0' onmouseover=\"this.src='images/star_full.jpg';\" onmouseout=\"this.src='images/star_half.jpg';\" >";
}
elseif($i<= $rating)
{
$ret.="<img src='images/star_full.jpg' border='0' onmouseover=\"this.src='images/star_full.jpg';\" onmouseout=\"this.src='images/star_full.jpg';\" >";
}
$ret.="</a></li>";

}
$ret.="</ul>";
$ret.=$numrows." votes";
return $ret;
}


function mycreatethumb($name,$filename,$new_w,$new_h){
	$system1=explode('/',$name);
	$count=count($system1);
	$i=$count-1;
	$system=explode('.',$system1[$i]);
	if (preg_match('/jpg|jpeg/',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}
	else if (preg_match('/png|PNG/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}
	else if(preg_match('/gif|GIF/',$system[1])){
		$src_img=imagecreatefromgif($name);
	}
	list($old_x, $old_y) = getimagesize($name);
	if($old_x < $new_w)
	{
	$new_w=$old_x;
	}
	if($old_y < $new_h)
	{
	$new_h=$old_y;
	}
	if ($old_x > $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y) {
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	 $dst_img=imagecreatetruecolor ($thumb_w,$thumb_h);
	imagecopyresized($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	
	if (preg_match("/gif|GIF/",$system[1]))
	{
		imagegif($dst_img,$filename); 
	} else
	  if (preg_match("/png|PNG/",$system[1]))
	{
		imagepng($dst_img,$filename); 
	} else {
		imagejpeg($dst_img,$filename);
	}
//echo $dst_img;
	imagedestroy($dst_img); 
	imagedestroy($src_img); 
}





public function getadbanners($pos)
{
	$this->myconnect();
$rating=0;
$ret="";
$ratingqry=$this->pushquery("select * from advertisement where position='$pos'");
while($arr=mysql_fetch_assoc($ratingqry))
{
	$type=$arr['type'];
	if($type==1)
	{
		if(substr($arr['image_link'],0,7)!="http://")
		{
			$link="http://".$arr['image_link'];
		}
		else
		{
			$link=$arr['image_link'];
		}
	 $ret.="<a onclick='getajaxupdate(".$pos.")'  href='".$link."' target='_blank' ><img src='admin/add_images/".$arr['images']."' border='0' /></a>";
	 
	}
	else
    {
		$ret.=$arr['script'];
	}
}
return $ret;
}

public function getmer($mer="")
{
	$ret="<option value='am' ";
	if($mer=="am" || $mer=="")
	{
		$ret.=" selected ";
	}
	$ret.=">AM</option>";
		$ret.="<option value='pm' ";
	if($mer=="pm")
	{
		$ret.=" selected ";
	}
	$ret.=">PM</option>";

return $ret;
}
public function getweekdays($day="")
{
	$ret="";
	if($day=="")
	{
		$day=1;
	}
	for($i=1;$i<=7;$i++)
	{
      $ret.="<option value='".$i."' ";
	  if($i==$day)
	  {
		  $ret.=" selected ";
	  }
	  $ret.=">".$i."</option>";
	}
return $ret;	
}



public function sorority_cat($sorority_cat_id="")
{
	$this->myconnect();
	$ret="";
	$res=$this->pushquery("select * from sorority_cat");
	$ret.="<option value='' >Select Sorority Category</option>";
	while($arr=mysql_fetch_assoc($res))
	{
       $ret.="<option value='".$arr['sorority_cat_id']."'";
	   if($arr['sorority_cat_id']==$sorority_cat_id)
	   {
		   $ret.=" selected ";
	   }
	   $ret.=" >".$arr['sorority_cat_name']."</option>";
	}return $ret;
}
// added by sunitha

public function displayDateFormat($givendate="")
{
  $convdate=strtotime($givendate);
  return date('M d Y H:i:s',$convdate);
}
/**************************
	Paging Functions
***************************/

function getPagingQuery($sql, $itemPerPage = 3)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
}
/*
	Get the links to navigate between one result page to another.
	Supply a value for $strGet if the page url already contain some
	GET values for example if the original page url is like this :
	
	
	use "c=12" as the value for $strGet. But if the url is like this :
	
	
	then there's no need to set a value for $strGet
	
	
*/
function getPagingLink($sql, $itemPerPage = 10, $strGet = '')
{
	$file=$_REQUEST['file'];
	$sCountSQL = '';
	$iTmpI = strpos(strtolower($sql), "select");
	$iTmpJ = strpos(strtolower($sql), "from") - 1;
	$sCountSQL = str_replace(substr($sql, $iTmpI + 6, $iTmpJ - $iTmpI - 6), " count(*) AS cnt ", $sql);
	$iTmpI = strpos(strtolower($sCountSQL), "order by");
	if($iTmpI > 1) 
		$sCountSQL = substr($sCountSQL, 0, $iTmpI - 1);

	$result        = mysql_query($sCountSQL);
	$row 				=@mysql_fetch_assoc($result);
	$noofrows 		= $row['cnt']; 

	$pagingLink    = '';
	$totalResults  = $noofrows;
	$totalPages    = ceil($totalResults / $itemPerPage);
	
	// how many link pages to show
	$numLinks      = 10;

		
	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
	
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']."?file=".$file;
		

		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
			$pageNumber = (int)$_GET['page'];
		} else {
			$pageNumber = 1;
		}
		
		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = " <a href=\"$self&page=$page&$strGet/\" class=\"blacklink11\">[Prev]</a> ";
			} else {
				$prev = " <a href=\"$self&$strGet\" class=\"blacklink11\">[Prev]</a> ";
			}	
				
			$first = " <a href=\"$self&$strGet\" class=\"blacklink11\">[First]</a> ";
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self&page=$page&$strGet\" class=\"blacklink11\">[Next]</a> ";
			$last = " <a href=\"$self&page=$totalPages&$strGet\" class=\"blacklink11\">[Last]</a> ";
		} else {
			$next = ''; // we're on the last page, don't show 'next' link
			$last = ''; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
				$pagingLink[] = " $page ";   // no need to create a link to current page
			} else {
				if ($page == 1) {
					$pagingLink[] = " <a href=\"$self&$strGet\" class=\"blacklink11\">$page</a> ";
				} else {	
					$pagingLink[] = " <a href=\"$self&page=$page&$strGet\" class=\"blacklink11\">$page</a> ";
				}	
			}
	
		}
		
		$pagingLink = implode(' | ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
	}
	
	return $pagingLink;
}
///ends
public function getsorority($sorority_cat_id="",$sorority_id="")
{
	$this->myconnect();
	$ret="";
	$ret.="<option value='0'>Select Sorority</option>";
	if($sorority_cat_id=="")
	{
		return $ret;
	}
	else
	{
	    $res=$this->pushquery("select * from sorority where sorority_cat_id=$sorority_cat_id");
		while($arr=mysql_fetch_assoc($res))
		{
			$ret.="<option value='".$arr['sorority_id']."'";
	   if($arr['sorority_id']==$sorority_id)
	   {
		   $ret.=" selected ";
	   }
	   $ret.=" >".$arr['sorority_name']."</option>";
		}
	}return $ret;
}

public function getcity($sorority_cat_id="",$sorority_id="")
{
	
	
	$this->myconnect();
	$ret="";
	$ret.="<option value='0'>Select City</option>";
	if($sorority_cat_id=="")
	{
		return $ret;
	}
	else
	{
	    $res=$this->pushquery("select * from city where state_id=$sorority_cat_id and status=1");
		while($arr=mysql_fetch_assoc($res))
		{
			$ret.="<option value='".$arr['id']."'";
	   if($arr['id']==$sorority_id)
	   {
		   $ret.=" selected ";
	   }
	   $ret.=" >".$arr['city']."</option>";
		}
	}return $ret;
}
function member_check($email)
{
$this->myconnect();
$sql=$this->pushquery("select * from members where email='$email'");
if(mysql_num_rows($sql)> 0)
{
return 'yes';
}
else
{
return '';
}
}function member_usernamecheck($username)
{
$this->myconnect();
$sql=$this->pushquery("select * from members where username='$username'");
if(mysql_num_rows($sql)> 0)
{
return 'yes';
}
else
{
return '';
}
}

function member_register($first_name,$username,$password,$email)
{
$this->myconnect();
$sql="insert into members(first_name,username,password,email,status,created_time)values('$first_name','$username','$password','$email','0','".date('Y-m-d H:i:s')."')";
if($this->pushquery($sql)>0)
{
return 'yes';
}
else
{
return '';
}
}		
//member login checking
function checklogin($user,$password)
{
$this->myconnect();
$sql=$this->pushquery("select * from members where username='$user' and password='$password' and status='1'");
if(mysql_num_rows($sql)> 0)
{
return 'yes';
}
else
{
return '';
}
}	
function checkloginconfirm($email,$password){
$this->myconnect();
$sql=$this->pushquery("update members set status='1' where email='$email' and password='$password'");
if($sql)
{
return 'yes';
}
else
{
return '';
}
}
function checkderogatory_words(){
   $this->myconnect();
   $results=$this->pushquery("select name from derogatory_words");
   $count = 0;
		$data = array();
		while($row = mysql_fetch_assoc($results))
		{
			$data[$count] = $row['name'];
			$count++;
		}
		mysql_free_result($results);
        return $data;
}	

function memsecemails()
{
  $this->myconnect();
    //echo "select sec_email from memberemails where member_id='".$_SESSION["sess_memberid"]."'";
	$results=$this->pushquery("select * from memberemails where member_id='".$_SESSION["sess_memberid"]."' order by iid asc");
   	$count = 0;
		$data = array();
		while($row=mysql_fetch_assoc($results))
		{
			$data[$count]=$row;
			$count++;
		}
		mysql_free_result($results);

		return $data;
}
function dashboard()
{
  $this->myconnect();
    //echo "select * from profile where user_id='".$_SESSION["sess_memberid"]."'";
	$results=$this->pushquery("select * from profile where user_id='".$_SESSION["sess_memberid"]."'");
   	$count = 0;
		$data = array();
		while($row=mysql_fetch_assoc($results))
		{
			$data[$count]=$row;
			$count++;
		}
		mysql_free_result($results);

		return $data;
}
function blockedusers(){
   $this->myconnect();
   $results=$this->pushquery("select ito_memid from member_status where ifrom_memid='".$_SESSION['sess_memberid']."'");
   $count = 0;
		$data = array();
		while($row = mysql_fetch_assoc($results))
		{
			$data[$count] = $row['ito_memid'];
			$count++;
		}
		mysql_free_result($results);
		if(count($data)>0){
		  $bids=implode(",",$data);
		}else{
		$bids='';
		}
        return $bids;
}	
function getblockedemails(){
   $this->myconnect();
   $bids=$this->blockedusers();
   if($bids!=""){
   	$msql=" where member_id in(".$bids.")";
   	$results=$this->pushquery("select email from members $msql");
      $count = 0;
		$data = array();
		while($row = mysql_fetch_assoc($results))
		{
			$data[$count] = "'".$row['email']."'";
			$count++;
		}
		mysql_free_result($results);
		return $data;
	}
	else{
		$data=array();
	}
   
}
function getphoto($albumid)
{
   $this->myconnect();
   //echo "select photo from photos where album_id=".$albumid." and photo_status=1 limit 1";
   $results=$this->pushquery("select photo from photos where album_id=".$albumid." and photo_status='1' order by added_date desc limit 1");
   $photors=mysql_fetch_array($results);
    return $photors['photo'];
   
}	
			 
}//dbclass ends 



?>