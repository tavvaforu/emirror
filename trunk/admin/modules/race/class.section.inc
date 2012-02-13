<?php


class section extends atkMetaNode
{
    protected $table      = "section";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	$policy->hasone("list_class");
	//$policy->hasone("section");
    $policy->addFlag("name",AF_UNIQUE);	
  	}
	
	
	
 }
?>