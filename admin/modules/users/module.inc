<?php
class mod_users extends atkModule
{
  function getNodes()
  {
    registerNode("users.user", array("admin", "add", "edit", "delete"));
    registerNode("users.profile", array("admin", "add", "edit", "delete"));
  }
 
  function getMenuItems()
  {
    
    menuitem("user_administration");
    menuitem("users", dispatch_url("users.user", "admin"),"user_administration",array("users.user","admin"));
    menuitem("groups", dispatch_url("users.profile", "admin"),"user_administration",array("users.profile","admin") );
  }
}
?>