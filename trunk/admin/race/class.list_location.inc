<?php


class list_location extends atkMetaNode
{
    protected $table      = "list_location";   
    protected $index      = "name";
    protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD,NF_NO_EXTENDED_SEARCH, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[organisation_id.name]-[name]";
    
    public static function meta($policy)
    {
	$policy->hasone("organisation");
	$policy->get("name")->addFlag(AF_SEARCHABLE);
	//$policy->get("zipcode")->setRange(4,6);
	$policy->hasone("list_state",array('filter'=>"country= '[country.country]'"));
	}
	public function postMeta()
	{
	
	$this->getAttribute("country")->addDependee("list_state_id");
	//$this->add(new atkNumberAttribute("zipcode", 10, 4));
	}
	 
 }
?>