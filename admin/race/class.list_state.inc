<?php


class list_state extends atkMetaNode
{
    protected $table      = "list_state";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
	//$this->getAttribute("country")->addDependee("list_state");
	// $this->getAttribute("list_state")->addDependee("list_city");   

    	
  	}
	
 }
?>