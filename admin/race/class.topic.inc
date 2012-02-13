<?php


class topic extends atkMetaNode
{
    protected $table      = "topic";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD,NF_ADD_DIALOG, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
	$policy->hasone("chapter");
		
		
		//$policy->addFlag("list_class_id",AF_HIDE_LIST|AF_HIDE_ADD);
		
		
  	}
	
	 public function postMeta()
    {
        
		  
		
    }
	
	
	
	
 }
?>