<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$sess = unserialize($_COOKIE['ci_session']);
ini_set('display_errors', 1);
class Access extends CI_Controller {

 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('model_auth', 'mod_auth');
 	}

	public function index()
	{
		$this->load->view('landing-page');
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
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		header("location: ".base_url());
	}
}

/* End of file access.php */
/* Location: ./application/controllers/access.php */