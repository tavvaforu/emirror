<?php


class list_religion extends atkMetaNode
{
    protected $table      = "list_religion";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
	
		
  	}
	
	
	
 }
?>