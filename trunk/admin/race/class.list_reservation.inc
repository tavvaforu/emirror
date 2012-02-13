<?php


class list_reservation extends atkMetaNode
{
    protected $table      = "list_reservation";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
   

    	
  	}
	
 }
?>