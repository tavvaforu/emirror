<?php
useattrib("atkdummyattribute");
useattrib("atkprofileattribute");
 
class profile extends atkNode
{
function profile()
{
$this->atkNode("profile", NF_EDITAFTERADD|NF_NO_VIEW|NF_ADD_LINK);
 
$this->add(new atkAttribute("profile_id",AF_AUTOKEY));
 
$this->add(new atkAttribute("name",AF_OBLIGATORY|AF_UNIQUE|
AF_SEARCHABLE, 50));
 
$this->add(new atkDummyAttribute("profile_explanation",text
("profile_explanation"),AF_HIDE_LIST|AF_HIDE_ADD));
 
$this->add(new atkProfileAttribute("accessrights",AF_HIDE_LIST|
AF_HIDE_ADD|AF_BLANKLABEL));
 
$this->setTable("profile1");
 
$this->setOrder("name");
 
}
function descriptor_def()
{
return "[name]";
}
}
?>