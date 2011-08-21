<?php

class Menu {

    function show_menu() {
        $obj = & get_instance();
        $obj->load->helper('url');
        $obj->load->library('ion_auth');
        $obj->load->library('session');
        $menu = "<ul class=\"ui-menu ui-widget ui-widget-content ui-corner-all\">";
        $menu .= "<li class=\"ui-menu-item\">";
        $menu .= anchor("main/main", "Home");
        $menu .= "</li>";
        $menu .= "<li class=\"ui-menu-item\">";
        $menu .= anchor("character", "Characters");
        $menu .= "</li>";
        $menu .= "<li class=\"ui-menu-item\">";
        $menu .= anchor("groups", "Raid Groups");
        $menu .= "</li>";
        $menu .= "<li class=\"ui-menu-item\">";
        $menu .= anchor("raid", "Recent Raids");
        $menu .= "</li>";
        if ($obj->ion_auth->is_admin()) {
            $menu .= "<li class=\"ui-menu-item\">";
            $menu .= anchor("main/characteradd", "Add Character");
            $menu .= "</li>";
            $menu .= "<li class=\"ui-menu-item\">";
            $menu .= anchor("raiddump", "Add New Raid");
            $menu .= "</li>";
            $menu .= "<li class=\"ui-menu-item\">";
            $menu .= anchor("upload", "Add Guild Roster");
            $menu .= "</li>";
        }
        if ($obj->ion_auth->is_admin() || !$obj->ion_auth->logged_in()) {
            $menu .= "<li class=\"ui-menu-item\">";
            $menu .= anchor("auth", "Admin");
            $menu .= "</li>";
        }
        if ($obj->ion_auth->logged_in()) {
            $menu .= "<li class=\"ui-menu-item\">";
            $menu .= anchor("auth/logout", "Logout");
            $menu .= "</li>";
        }
        $menu .= "</ul>";
        $menu .= "<script type=\"text/javascript\">
            $('.ui-menu-item').hover(
  function () {
    $(this ).addClass(\"ui-state-active\");
  },
  function () {
    $(this ).removeClass(\"ui-state-active\");
  }
);
            
        </script>";


        return $menu;
    }

}

?>
