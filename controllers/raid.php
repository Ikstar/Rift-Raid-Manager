<?php

class raid extends CI_Controller {
            function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    function index()
    {
        $this->load->model('raid_model');
        $data = $this->raid_model->general();
        $data["raids"] = $this->raid_model->getRaids();
         $this->load->view('raid_view', $data);
    }
    
    function raidDetails()
    {
        $this->load->model('raid_model');
        $data = $this->raid_model->general();
        $data['raiddetails']= $this->raid_model->getRaidDetails($this->input->post('RaidId'));
        $data["raidroster"] = $this->raid_model->getRaid($this->input->post('RaidId'));
        $this->load->view('raid_detail_view', $data);
    }
}
?>
