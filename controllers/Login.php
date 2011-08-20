<?
class Login extends CI_Controller {

	function Login()
	{
		parent::CI_Controller();	
	}

	function index()
	{
	    if ($this->session->userdata('logged_in') == TRUE)
	    {
	        redirect('dashboard/index');
	    }

	    $data['title'] = 'Login';
	    $data['username'] = array('id' => 'username', 'name' => 'username');
	    $data['password'] = array('id' => 'password', 'name' => 'password');	        
	    $this->load->view('login', $data);
	}

	function process_login()
	{
	    $username = $this->input->post('username');    
	    $password  = $this->input->post('password');

	    if ($username == 'James' AND $password == 'James1:12')
	    {
	        $data = array(
                   'username'  => $username,
                   'logged_in'  => TRUE
                );

                $this->session->set_userdata($data);

                redirect('dashboard/index');
	    } 
	    else 
	    {
	        $this->session->set_flashdata('message', '<div id="message">Oopsie, it seems your username or password is incorrect, please try again.</div>');
	        redirect('login/index');
	    }
	}

	function logout()
	{
	    $this->session->sess_destroy();

	    redirect('login/index');
	}
}
?>