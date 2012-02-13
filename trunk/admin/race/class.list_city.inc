<?php


class list_city extends atkMetaNode
{
    protected $table      = "list_city";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
	   $policy->hasone("list_state");
      
	}
	public function postmeta()
	{
	$this->addUniqueFieldset(array("name","list_state_id"));
	}
	
 }
?>