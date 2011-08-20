<?php

class groups extends CI_Controller {
    
    function index()
    {
        $this->load->helper('form');
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $this->load->model('rgroups_model');
        $data["Groups"]= $this->rgroups_model->getGroups();
        $this->load->view('groups_view',$data);
    }
    function viewGroup()
    {
        $this->load->helper('form');
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $this->load->model('rgroups_model');
        $data["Roster"]= $this->rgroups_model->getRoster($this->input->post('idGroups'));
       //echo $this->input->post('idGroups');
        $this->load->view('Roster_view',$data);
    }
    
    
    function editGroup()
    {
        $this->load->helper('form');
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $this->load->model('rgroups_model');
        $data["Roster"]= $this->rgroups_model->getRoster($this->input->post('idGroups'));
        $data["GroupId"] = $this->input->post('idGroups');
        $this->load->view('roster_edit_view',$data);
    }
    
    
}
?>
