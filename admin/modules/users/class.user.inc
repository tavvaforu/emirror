<?php
useattrib("atkemailattribute");
useattrib("atkpasswordattribute");
userelation("atkonetomanyrelation");
userelation("atkmanytoonerelation");
 
class User extends atkNode
{
function User()
{
$this->atkNode("user", NF_ADD_LINK);
 
$this->add(new atkAttribute("user_id", AF_AUTOKEY));
$this->add(new atkAttribute("name", AF_OBLIGATORY|AF_SEARCHABLE));
 
$this->add(new atkAttribute("login", AF_OBLIGATORY|AF_UNIQUE|
AF_SEARCHABLE));
 
$this->add(new atkPasswordAttribute("password", false, AF_HIDE_LIST, 0, atkconfig("password_restrictions", array())));
 
//link to profiles
$this->add(new atkManyToOneRelation("profile_id", "users.profile", AF_RELATION_AUTOLINK));
 
$this->setOrder("name");
$this->setTable("user");
}
 
function descriptor_def()
{
return "[name]";
}
}
?>