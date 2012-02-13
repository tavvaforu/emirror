<?php
  
  class mod_emirror extends atkModule
  {    
  
  function getNodes()
  {
    registerNode("emirror.article", array("admin", "add", "edit", "delete"));
    registerNode("emirror.banner", array("admin", "add", "edit", "delete"));
	registerNode("emirror.banner_position", array("admin", "add", "edit", "delete"));
    registerNode("emirror.menu", array("admin", "add", "edit", "delete"));
  }
 
    function getMenuItems()
    {    
         
		 
	$this->menuitem("Static_Pages");
	$this->menuitem("menu", dispatch_url("emirror.menu", "admin"),"main");
		  
	 $this->menuitem("derogatory_words", dispatch_url("emirror.derogatory_words", "admin"),"main");

	  $this->menuitem("articles", dispatch_url("emirror.article", "admin"),"Static_Pages");
 
 $this->menuitem("Banner_ads");
 
        $this->menuitem("banner",dispatch_url("emirror.banner","admin"),"Banner_ads");

	$this->menuitem("banner_position", dispatch_url("emirror.banner_position", "admin"),"Banner_ads");  
        
 
  }
  
  
  
}

?>
