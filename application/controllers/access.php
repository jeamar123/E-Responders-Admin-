<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', 1);

class Access extends CI_Controller {

 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('model_auth', 'mod_auth');
 	}

	public function index()
	{
		$this->load->view('index');
	}

	public function authentication()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$user = array( 
					'username' => $credentials->username, 
					'password' => md5($credentials->password) ,
					'logged_in'=> true
				);
		$this->session->set_userdata($user);
		$data = $this->mod_auth->check_account($user);
		echo json_encode($data);
	}

	public function sign_out()
	{
		$this->session->sess_destroy();
		header("location: ".base_url());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */