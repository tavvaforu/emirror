<?php


class student_address_details extends atkMetaNode
{
    protected $table      = "student_address_details";   
    protected $index      = "local_add";
    protected $order      = "local_add";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[local_add]";
    
    public static function meta($policy)
    {
	
	  $policy->get("local_add",AF_FORCE_LOAD); 
	   

    	
  	}
	
 }
?>