// validation for mailid
function isValidEmailAddress(emailAddress)
{

var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
return pattern.test(emailAddress);
}
// validation for unique mailid
function checkUniqueEmail(email,objid)
{
	if(email!='' && isValidEmailAddress(email)){
		$.ajax({
		type: "POST",
		url: "/register/index/uniqemail/",
		data: "email="+email,
		success: function(msg){
			//alert(msg);
			if(trim(msg)!=''){
				$('#uniqEmail').val(1);
				$('#divEmailAddress').html(msg);
				document.getElementById('uniqEmail').value = 1; 
			} else {
				$('#divEmailAddress').html(msg);
				$('#uniqEmail').val(0);
				document.getElementById('uniqEmail').value = 0; 
			}
		}
		});
	} else {
		$('#divEmailAddress').html($('#'+objid).attr("title3"));
	}	

}



/*******  06-06-2011 start ******/
//validation for selecting value in dropdown
function checkDropdown(objid,divid)
{
	if($('#'+objid).val()==0){
		$('#'+divid).html($('#'+objid).attr("title"));
		$('#'+divid).show('slow');
		$('#'+objid).focus();
		return false;
	} else {
		$('#'+divid).html('');
		return true;
	}
}




function checkmultiDropdown(formname,objid,divid)
{
	val=eval('document.'+formname+'.elements["'+objid+'[]"].selectedIndex');
	if(val==-1)
	{
		$('#'+divid).html($('#'+objid).attr("title"));
		$('#'+divid).show('slow');
		$('#'+objid).focus();
		return false;
	} else {
		$('#'+divid).html('');
		return true;
	}	
}
// validation for non empty in text box
function checkEmpty(objid,divid)
{
	if(trim($('#'+objid).val())==''){
		$('#'+divid).html($('#'+objid).attr("title"));
		$('#'+divid).show('slow');
		$('#'+objid).val('');
		$('#'+objid).focus();
		return false;
	} else {		
		if(validInput($('#'+objid).val()))
		{
			$('#'+divid).html($('#'+objid).attr("title2"));
			$('#'+divid).show('slow');
			$('#'+objid).val('');
			$('#'+objid).focus();
			return false;
		}
		else
		{
		$('#'+divid).html('');
		return true;
		}		
			
	}
}
// validation for mailid
function checkEmail(objid,divid)
{
	if($('#'+objid).val()==''){
		$('#'+divid).html($('#'+objid).attr("title"));
		$('#'+divid).show('fast');
		$('#'+objid).val('');
		$('#'+objid).focus();
		return false;
	} else {
		if(isValidEmailAddress($('#'+objid).val()))
		{
			$('#'+divid).html('');
			return true;
		} else {
			$('#'+divid).html($('#'+objid).attr("title2"));
			$('#'+objid).focus();
			return false;
		}
		
	}
}
// validation for length
function checkLength(objid,divid,len) 
{
	var passwordval1 =	$('#'+objid).val();
	val=$('#'+objid).attr("title2");
	val2=$('#'+objid).attr("title3");
	if(passwordval1.length < len){
		$('#'+divid).html(val+len+val2);
		$('#'+divid).show('slow');
		$('#'+objid).focus();
		return false;
	} else {
		$('#'+divid).html('');
		return true;
	}
}

// valadation for matching of password and confirm password
function checkPasswords(objid1,objid2,divid)
{
	val=$('#'+objid1).attr("title4");
	if( $('#'+objid1).val() != $('#'+objid2).val() ){
		$('#'+objid1).val('')  ;
		$('#'+objid2).val('')  ;
		$('#'+divid).html(val);
		$('#'+objid1).focus();
		return false;
	} else {
		$('#'+divid).html('');
		return true;
	}
}
// validation for zip code
function checkZip(objid,divid)
{
	
	if($('#'+objid).val()==''){
		$('#'+divid).html($('#'+objid).attr("title"));
		$('#'+divid).show('slow');
		$('#'+objid).focus();
		return false;
	} else {
		$('#'+divid).html('');
		return true;
	}
	
}
// validation for city
function checkCity(objid,divid)
{
	if($('#'+objid).val()=='undefined' || $('#'+objid).val()==''){
		$('#'+divid).html($('#'+objid).attr("title2"));
		$('#'+divid).show('slow');
		$('#'+objid).focus();
		return false;
	} else {
		$('#'+divid).html('');
		return true;
	}
}

// validation for upload
function checkUpload( objid,divid,pattern )
{
    if($('#'+objid).val()==''){
        $('#'+divid).html($('#'+objid).attr("title"));
	$('#'+divid).show('fast');
	$('#'+objid).val('');
	$('#'+objid).focus();
	return false;
    }else if( pattern != '' )
    {
        if(!pattern.test($('#'+objid).val()))
        {
            $('#'+divid).html($('#'+objid).attr("title2"));
            $('#'+divid).show('fast');
            $('#'+objid).val('');
            $('#'+objid).focus();
            return false;
        }
        return true;
    }
}
function alertUpload( objid,objid1,objid2,divid )
{
    if( $('#'+objid).val()=='' && $('#'+objid1).val()=='' && $('#'+objid2).val()=='' )
    {
        $('#'+divid).html($('#'+objid).attr("title"));
	$('#'+divid).show('fast');
	$('#'+objid).val('');
	$('#'+objid).focus();
	return false;
    }
    var myfiles=new Array('.jpeg','.jpg','.gif','.JPEG','.GIF','.JPG','.doc','.ppt','.xls','.pdf','.pptx','.docx','.xlsx');
    fileOK = 0;
    var logo = $('#'+objid).val();
    if( logo != '')
    {
        for(var i = 0; i < myfiles.length; i++)
        {
            if (logo.indexOf(myfiles[i]) != -1)
            {
            	fileOK = 1; // one of the file extensions found
            }
	}
        if(fileOK != 1)
        {
            $('#'+divid).html($('#'+objid).attr("title1"));
            $('#'+divid).show('fast');
            $('#'+objid).val('');
            $('#'+objid).focus();
            return false;
        }
    }

    logo = $('#'+objid1).val();
    fileOK = 0;
    if( logo != '')
    {
        for(i = 0; i < myfiles.length; i++)
        {
            if (logo.indexOf(myfiles[i]) != -1)
            {
            	fileOK = 1; // one of the file extensions found
            }
	}
        if(fileOK != 1)
        {
            $('#'+divid).html($('#'+objid1).attr("title"));
            $('#'+divid).show('fast');
            $('#'+objid1).val('');
            $('#'+objid1).focus();
            return false;
        }
    }

    logo = $('#'+objid2).val();
    fileOK = 0;
    if( logo != '')
    {
        for(i = 0; i < myfiles.length; i++)
        {
            if (logo.indexOf(myfiles[i]) != -1)
            {
            	fileOK = 1; // one of the file extensions found
            }
	}
        if(fileOK != 1)
        {
            $('#'+divid).html($('#'+objid2).attr("title"));
            $('#'+divid).show('fast');
            $('#'+objid2).val('');
            $('#'+objid2).focus();
            return false;
        }
    }
    return true;
    
}
/******  06-06-2011 ending ******/
