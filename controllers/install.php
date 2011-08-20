<?php
Class install extends CI_Controller
{
    function index()
    {
       $this->load->dbforge(); 
       
       if ($this->dbforge->create_database('rift_manager'))
    {
        $data['messages'] =  '<li>Database (rift_manager) created!</li>';
    }
    else
    {
        $data['messages'] =  '<li>Database (rift_manager) failed to created!</li>';
        $this->load->view('install_view',$data);
        exit();
    }

    }
}

?>
