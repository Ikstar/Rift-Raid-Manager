<?php

class raiddump extends CI_Controller {

        function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    
    function index($error = NULL){
        $this->load->model('raiddump_model');
        $data = $this->raiddump_model->general();
        $data['error'] = $error ? $error : ' ';
        $data['Groups'] = $this->raiddump_model->getGroups();
        
        $this->load->view('upload_raid_form', $data);
    }
    function do_upload() {
        
    
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xml';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
            $this->index($error);
            
        } else {
            $upload_data = $this->upload->data();
            $data = array('upload_data' => $upload_data);
            $xmlFile = "uploads/" . $upload_data["file_name"];
            $xmlstr = file_get_contents($xmlFile);
            $xml = new SimpleXMLElement($xmlstr);
            $data["xml"] = $xml;
       
        $this->load->model('raiddump_model');
        $data = $this->raiddump_model->general();
        $Count = 0;
        foreach ($xml as $xmlL2 => $xmlL3) {
            //L5 is Party
            foreach ($xmlL3 as $xmlL4 => $xmlL5) {
                foreach ($xmlL5 as $xmlL6 => $xmlL7) {
                    foreach ($xmlL7 as $xmlL8 => $xmlL9) {                   
                        $Attendees[] = $xmlL9->Name;
                        $Count++;
                       
                    }
                }
            }
        }
        //$this->raiddump_model->addAttendees($Attendees);
        $Characters = $this->raiddump_model->matchAttendees($Attendees,$this->input->post("idGroups"));
        $data["Characters"] = $Characters;
        $data["AttendeeCount"] = $Count;
        $data["idGroups"] = $this->input->post('idGroups');
        $this->load->view('raiddump_view', $data);
    }
    }
    function addRaid()
    { 
        if (!$this->input->post("RaidDate") || !$this->input->post("idGroups") )
                return $this->index("Missing Date or Group ID");
       $this->load->model('raiddump_model');
       // $data = $this->raiddump_model->general(); 
       $RaidID = $this->raiddump_model->addRaid($this->input->post("RaidDate"),$this->input->post("idGroups"));
       //echo $this->input->post('CharIds[]');
      // print_r($this->input->post());
       echo "<br/>";
       print_r($_POST);
       foreach ($this->input->post('CharIds') as $CharId) 
       {
           $loot =($this->input->post("loot_$CharId") == 'on') ? 1 : 0;
                   
           
           $data[] = array(                  
                  'raid_raidid' => $RaidID,
	          'chars_idchars'=> $CharId,
                  'role'=>$this->input->post("role_$CharId"),
                  'Loot'=>$loot,
                  
	        );
        
       }
        $this->raiddump_model->addAttendees($data);
        $this->raiddump_model->incrementAttendance($RaidID,$this->input->post("idGroups"));
       // redirect('/raid/','location');
    }
}

?>