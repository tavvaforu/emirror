<?php
class menu extends atkmetanode
{
	protected $table      = "menu";
	protected $index      = "title";
	protected $order      = "title";
	protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA);
    protected $descriptor = "title";

	public static function meta($policy) 
    {
		
	
		$policy->hasone("article",array('filter'=>"article.status= '1'"));
		$policy->get("status")->setType("atkboolattribute");
		
	}
	
	public function postMeta()
	{
	//$this->getAttribute("article")->addDependee("article_id");
	//$this->getAttribute("status")->addDependee("status_id");	
	}
}
?>