<?php


class state extends atkMetaNode
{
    protected $table      = "state";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
	    $policy->hasone("country");
	
    	/*$policy->setType("status", "atkBoolAttribute");
    	$policy->hasMany("subject");
		$policy->hasMany("chapter");
		$policy->hasMany("topic");
    	
    	$policy->removeFlag("id",AF_OBLIGATORY);
    	$policy->removeFlag("id",AF_AUTO_INCREMENT);
    	$policy->removeFlag("id",AF_PRIMARY);
    	$policy->addFlag("id",AF_HIDE);
    	*/
  	}
	
 }
?>