<?php


class organisation extends atkMetaNode
{
    protected $table      = "organisation";   
    protected $index      = "name";
    //protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {

	//$policy->hasMany("list_branch");
	$policy->hasone("list_state",array('filter'=>"country= '[country.id]'"));
	//$policy->hasone("list_city",array('filter'=>"list_state_id= '[list_state_id.id]'"));
	//$policy->setOrder("address",2);
	$policy->setOrder("name","phone_no","email","country","list_state","list_city","zipcode","address");
	$policy->setTabs("address","country","list_state","list_city","zipcode","Address_Details");
  	}
	
	
	public function postMeta()
	{
	//$this->addFieldSet("test","[country.label] [country.field] [list_state.label] [list_state.field] ",AF_SEARCHABLE,NULL,300 );
	$this->getAttribute("country")->addDependee("list_state");
	
	$this->getAttribute("list_state")->addDependee("list_city");
	//$this->setColumnAttribs(array("name","zipcode"));
	}
	
 }
?>