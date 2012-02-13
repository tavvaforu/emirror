<?php

atkimport("module.race.listenerbranch");
class list_branch extends atkMetaNode
{
    protected $table      = "list_branch";   
    protected $index      = "name";
    protected $order      = "list_branch_code";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD,NF_NO_EXTENDED_SEARCH, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	$policy->hasone("list_location");
    //$policy->hasone("list_location",array("filter"=>"organisation_id='[organisation_id.id]'"));
	$policy->hasone("organisation")->addFlag(AF_SEARCHABLE);
	$policy->get("name")->addFlag(AF_SEARCHABLE);
	$policy->setTypeandParams("address","atkTextAttribute",array(array("cols"=>50,"rows"=>5)));
    $policy->setTabs("address",".address");
	$policy->addFlag("organisation_id",AF_HIDE_LIST);
	$policy->get("list_branch_code")->addFlag(AF_READONLY_ADD|AF_READONLY_EDIT);
	
  	}
	
	 public function postMeta()
    {
        $this->addListener(new listenerbranch());
        //$this->getAttribute("organisation_id")->addDependee("list_location_id");
		$this->addUniqueFieldset(array("name"));
		//$rel=$this->add(new atkmanytoonerelation("name","race.branch");
		$this->getAttribute("phone_no")->setColumn(1);
		$this->getAttribute("list_branch_code")->setColumn(1);
		//$this->getAttribute("email")->setColumn(1);
		$this->getAttribute("organisation_id")->addFlag(AF_HIDE);
    }
	
 }
?>