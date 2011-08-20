<?php

class raiddump extends CI_Controller {

    function index() {
         $this->load->helper('form');
        $this->load->model('raiddump_model');
        $Count = 0;
        $xmlFile = file_get_contents("../dump.xml");
        $xml = simplexml_load_string($xmlFile);
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
        $Characters = $this->raiddump_model->matchAttendees($Attendees);
        $data["Characters"] = $Characters;
        
        $this->load->view('raiddump_view', $data);
    }

    function addRaid()
    {
        
    }
}

?>