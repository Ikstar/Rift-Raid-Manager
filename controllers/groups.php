<?php

class groups extends CI_Controller {

    function index($error='') {
        $this->load->helper('form');
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $data['error'] = $error;
        $this->load->model('rgroups_model');
        $data["Groups"] = $this->rgroups_model->getGroups();
        if(!$data["Groups"])
            $data["Groups"] = '';
        $this->load->view('groups_view', $data);
    }

    function general() {
        $this->load->library('Menu');
        $menu = new Menu;
        $data['menu'] = $menu->show_menu();
        $data['webtitle'] = "Raid Manager";
        $data['websubtitle'] = "Raid Groups";
        $data['webfooter'] = 'Created by Ikstars.com';
        return $data;
    }

    function viewGroup() {
        $this->load->helper('form');
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $this->load->model('rgroups_model');
        $data["Roster"] = $this->rgroups_model->getRoster($this->input->post('idGroups'));
        $data["idGroups"] = $this->input->post('idGroups');
        $data['GroupName'] = $this->rgroups_model->getGroupName((int)$this->input->post('idGroups'));
       // echo $this->input->post('idGroups');

        $this->load->view('roster_view', $data);
    }
    function addGroup(){
        $this->load->library('form_validation');
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $this->load->model('rgroups_model');
        
        $this->form_validation->set_rules('name', 'Group Name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('size', 'Group Size', 'trim|required|numeric');
        
         if ($this->form_validation->run() == FALSE)
		{
			$this->index( validation_errors());
                        
		}
		else
		{
                        $this->rgroups_model->addGroup($this->input->post('name'),$this->input->post('size'));
			$this->index();
		}
        
        
    }
    function editGroup() {
        $this->load->helper('form');
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $this->load->model('rgroups_model');
        $data["Roster"] = $this->rgroups_model->getRoster($this->input->post('idGroups'));
        $data["idGroups"] = $this->input->post('idGroups');
        $data['GroupName'] = $this->rgroups_model->getGroupName((int)$this->input->post('idGroups'));
        $this->load->view('roster_edit_view', $data);
    }

    function editRoster() {
        $this->load->model('rgroups_model');
        switch ($this->input->post('action')) {
            case 'Add':

                $IdChar = $this->rgroups_model->getCharId($this->input->post('CharName'));

                $data = array(
                    'groups_idgroups' => $this->input->post('idGroups'),
                    'chars_idchars' => $IdChar,
                    'role' => $this->input->post('role'),
                    'status' => $this->input->post('status'),
                    'attendance' => 0,
                    'joined' => date('Y-m-d H:i:s'),
                    'updated' => date('Y-m-d H:i:s'),
                );

                $this->rgroups_model->addCharToRoster($data, $this->input->post('idGroups'));
                $this->editGroup();
                break;
            case 'Save' :
                $data = array(

                'groups_idgroups' => $this->input->post('idGroups'),
                'chars_idchars' => $this->input->post('CharId'),
                'role' => $this->input->post('role'),
                'status' => $this->input->post('status'),
                );
                $this->rgroups_model->updateUserOnRoster($data,$this->input->post('idRoster'),$this->input->post('idGroups'));
                $this->editGroup();
                break;
            case 'Remove' :
                $this->rgroups_model->removeUserFromRoster($this->input->post('idRoster'),$this->input->post('idGroups'));
                $this->editGroup();
                break;
            default:
                $this->editGroup();
        }
    }

}

?>
