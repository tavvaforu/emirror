<?php

class list_academicyear extends atkMetaNode
{
    protected $table      = "list_academicyear";   
    
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
   protected $descriptor = "[from_date]";
    
    public static function meta($policy)
    {
	
	  // $policy->setTypeAndParams("from_date", "atkdateattribute");
       //$policy->setFlag("from_date",AF_DATE_STRING); 
    	
  	}
	
 }
?>