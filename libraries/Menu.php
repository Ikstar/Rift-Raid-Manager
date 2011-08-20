<?php
class Menu{
   function show_menu(){
          $obj =& get_instance();
          $obj->load->helper('url');
          $menu  = "<ul>";
          $menu .= "<li>";
          $menu .= anchor("main/main","Home");
          $menu .= "</li>";
          $menu .= "<li>";      
          $menu .= anchor("main/characteradd","Add Character");        
          $menu .= "</li>";
          $menu .= "<li>";      
          $menu .= anchor("groups","Raid Groups");        
          $menu .= "</li>";   
          $menu .= "<li>";      
          $menu .= anchor("raiddump","Add New Raid");        
          $menu .= "</li>";   
          $menu .= "</ul>";      
          return $menu;

   }

}

?>
