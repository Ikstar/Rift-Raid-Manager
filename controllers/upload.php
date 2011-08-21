<?php

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $data["error"] = '';
        $this->load->view('upload_form', $data);
    }

    function do_upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xml';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $data['error'] = $this->upload->display_errors();
            $this->load->view('upload_form', $data);
        } else {
            $upload_data = $this->upload->data();
            $data = array('upload_data' => $upload_data);
            $xmlFile = "./uploads/" . $upload_data["file_name"];
            $xmlstr = file_get_contents($xmlFile);
            $xml = new SimpleXMLElement($xmlstr);
            $data["xml"] = $xml;
            $Count = 0;
                  foreach ($xml as $XMLitem => $XMLsubItem) {
                        if ($XMLitem == "Members") {
                            foreach ($XMLsubItem as $Member => $Values) {
                                if ($Values->Level == 50) {

                                    switch ($Values->Calling) {
                                        case "Warrior": $Class = 1;
                                            break;
                                        case "Mage":    $Class = 2;
                                            break;
                                        case "Cleric":  $Class = 3;
                                            break;
                                        case "Rogue":   $Class = 4;
                                            break;
                                        default : $Class = 0; 
                                            break;
                                    }
                                    $this->load->model('character_model');
                                    $this->character_model->addEntrySafe($Values->Name, $Class);
                                    $Count++;
                                }
                            }
                        }
                    }
            
            $data['count'] = $Count;
            $this->load->view('upload_success', $data);
        }
    }
}
?>
