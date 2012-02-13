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
	$policy->hasMany('list_class', array('through' => 'branch_class'));
	$policy->hasMany('branch_class');
    //$policy->hasone("list_location",array("filter"=>"organisation_id='[organisation_id.id]'"));
	$policy->hasone("organisation")->addFlag(AF_SEARCHABLE);
	//$policy->get("name")->addFlag(AF_SEARCHABLE|AF_RELATION_AUTOCOMPLETE);
	$policy->setTypeandParams("address","atkTextAttribute",array(array("cols"=>50,"rows"=>5)));
    $policy->setTabs("address",".address");
	$policy->addFlag("organisation_id",AF_HIDE_LIST);
	$policy->get("list_branch_code")->addFlag(AF_READONLY_ADD|AF_READONLY_EDIT);
	//$policy->add(new atkMultiSelectAttribute(class, $optionArray, $valueArray="", $cols="", $flags=0, $size="")
	
	
	
  	}
	
	 public function postMeta()
    {
	
        $this->addListener(new listenerbranch());
        //$this->getAttribute("organisation_id")->addDependee("list_location_id");
		//$rel=$this->add(new atkmanytoonerelation("name","race.branch");
		$this->getAttribute("phone_no")->setColumn(1);
		$this->getAttribute("list_branch_code")->setColumn(1);
		//$this->getAttribute("email")->setColumn(1);
		$this->getAttribute("organisation_id")->addFlag(AF_HIDE);
		$this->addUniqueFieldset(array("list_location_id","name"));
		//$this->add(new atkManyToOneRelation("list_class_id","list_class", AF_LARGE),NULL,400);
		//$this->$actions["edit"] = dispatch_url("list_class", "edit"));
		
    }
	
	
 }
?>