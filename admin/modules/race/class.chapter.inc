<?php


class chapter extends atkMetaNode
{
    protected $table      = "chapter";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	$policy->hasMany("topic");
	//$policy->setTabs($a1,"test");

	
    	$policy->hasone("academic_subject");
	
	
  	}
	
	 public function postMeta()
    {
        
        
		
		
		
    }
	
 }
?>