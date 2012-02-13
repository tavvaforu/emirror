<?php
  
  class mod_test_race extends atkModule
  {    
 
    function getMenuItems()
    {    
      $this->menuitem("test_race"); 
      
      //$this->menuitem("Organization", dispatch_url("test_race.organisation", "admin"), "test_race"); 
	 // $this->menuitem("Location", dispatch_url("test_race.list_location", "admin"), "test_race");
	  //$this->menuitem("Branch", dispatch_url("test_race.list_branch", "admin"), "test_race");
	  //$this->menuitem("Academic_Year", dispatch_url("test_race.list_academicyear", "admin"), "test_race");
	  //$this->menuitem("State", dispatch_url("test_race.list_state", "admin"), "test_race");
	  //$this->menuitem("City", dispatch_url("test_race.list_city", "admin"), "test_race");
	  
	  //$this->menuitem("Student Academic Details", dispatch_url("test_race.student_academic_details", "admin"), "test_race");
	  $this->menuitem("Class", dispatch_url("test_race.list_class", "admin"), "test_race");
	  //$this->menuitem("Section", dispatch_url("test_race.section", "admin"), "test_race");
	  //$this->menuitem("Syllabus", dispatch_url("test_race.list_syllabus", "admin"), "test_race"); 
	  $this->menuitem("Subject", dispatch_url("test_race.academic_subject", "admin"), "test_race"); 
	  //$this->menuitem("Religion", dispatch_url("test_race.list_religion", "admin"), "test_race");
	  //$this->menuitem("Reservation", dispatch_url("test_race.list_reservation", "admin"), "test_race");
	  
	 
	  //$this->menuitem("Medium", dispatch_url("test_race.list_medium", "admin"), "test_race");
	  //$this->menuitem("Student_Address", dispatch_url("test_race.student_address_details", "admin"), "test_race");
	  
      //$this->menuitem("Sequence_No", dispatch_url("test_race.settings_sequence", "admin"), "test_race");
      //$this->menuitem("Chapter", dispatch_url("test_race.chapter", "admin"), "test_race");
      // $this->menuitem("Topic", dispatch_url("test_race.topic", "admin"), "test_race");
//$this->menuitem("Example", dispatch_url("test_race.ex_tab", "admin"), "test_race");
      

    $this->menuitem("Settings"); 
	 
	 $this->menuitem("Location", dispatch_url("test_race.list_location", "admin"), "Settings");
	  $this->menuitem("Branch", dispatch_url("test_race.list_branch", "admin"), "Settings");
	  
           $this->menuitem("Student");
		 $this->menuitem("Admission", dispatch_url("test_race.student", "admin"), "Student");  
		 //$this->menuitem("Health Conditions", dispatch_url("test_race.student_health", "admin"), "Student");   
 
  }
  
  
  
}

?>
